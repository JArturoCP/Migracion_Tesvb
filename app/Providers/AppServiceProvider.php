<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as HtmlReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registrarExcelV2();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Compatibilidad con la API de maatwebsite/excel 2.x (Excel::create(...)->sheet(...)->export()),
     * usada por controladores heredados, implementada sobre PhpSpreadsheet (maatwebsite/excel 3.x).
     */
    private function registrarExcelV2()
    {
        Excel::macro('create', function ($nombre, ?callable $callback = null) {
            $libro = new class($nombre) {
                public $nombre;
                public $spreadsheet;
                private $hojas = 0;

                public function __construct($nombre)
                {
                    $this->nombre = $nombre;
                    $this->spreadsheet = new Spreadsheet();
                }

                public function setFilename($nombre)
                {
                    $this->nombre = $nombre;
                    return $this;
                }

                public function __call($metodo, $args)
                {
                    // setTitle, setCreator, setCompany, setDescription...: metadatos sin efecto en la descarga
                    return $this;
                }

                public function sheet($titulo, ?callable $callback = null)
                {
                    $ws = $this->hojas++ === 0 ? $this->spreadsheet->getActiveSheet() : $this->spreadsheet->createSheet();
                    $ws->setTitle(mb_substr(str_replace(['*', ':', '/', '\\', '?', '[', ']'], '', (string) $titulo), 0, 31) ?: 'Hoja' . $this->hojas);
                    $hoja = new class($ws, $this->spreadsheet) {
                        public $ws;
                        private $spreadsheet;

                        public function __construct(Worksheet $ws, Spreadsheet $spreadsheet)
                        {
                            $this->ws = $ws;
                            $this->spreadsheet = $spreadsheet;
                        }

                        private $vista;

                        // Como en 2.x, la vista se renderiza al final para admitir ->loadView(...)->with(...)
                        public function loadView($vista, $datos = [], $mergeData = [])
                        {
                            $this->vista = [$vista, array_merge((array) $mergeData, (array) $datos)];
                            return $this;
                        }

                        public function with($clave, $valor = null)
                        {
                            if ($this->vista) {
                                $this->vista[1] = array_merge($this->vista[1], is_array($clave) ? $clave : [$clave => $valor]);
                                return $this;
                            }
                            return $this->fromArray($clave);
                        }

                        public function renderizar()
                        {
                            if (!$this->vista) {
                                return;
                            }
                            [$vista, $datos] = $this->vista;
                            $this->vista = null;
                            $lector = new HtmlReader();
                            $lector->setSheetIndex($this->spreadsheet->getIndex($this->ws));
                            $lector->loadFromString(view($vista, $datos)->render(), $this->spreadsheet);
                        }

                        public function fromArray($datos, $nulo = null, $inicio = 'A1', $estricto = false, $encabezados = true)
                        {
                            $this->renderizar();
                            $filas = [];
                            foreach ($datos instanceof \Illuminate\Support\Collection ? $datos->all() : (array) $datos as $fila) {
                                $filas[] = is_object($fila) ? (method_exists($fila, 'toArray') ? $fila->toArray() : get_object_vars($fila)) : (array) $fila;
                            }
                            if ($encabezados && $filas && array_keys($filas[0]) !== range(0, count($filas[0]) - 1)) {
                                array_unshift($filas, array_keys($filas[0]));
                            }
                            if (!$inicio) {
                                $alto = $this->ws->getHighestRow();
                                $vacia = $alto === 1 && $this->ws->getCell('A1')->getValue() === null;
                                $inicio = 'A' . ($vacia ? 1 : $alto + 1);
                            }
                            $this->ws->fromArray(array_map('array_values', $filas), $nulo, $inicio, $estricto);
                            return $this;
                        }

                        public function row($fila, $valores)
                        {
                            $this->renderizar();
                            if (is_callable($valores)) {
                                return $this->cell($fila . ':' . $fila, $valores);
                            }
                            $this->ws->fromArray([array_values((array) $valores)], null, 'A' . $fila);
                            return $this;
                        }

                        public function appendRow($valores)
                        {
                            $this->renderizar();
                            return $this->fromArray([$valores], null, '', false, false);
                        }

                        public function cell($rango, $valor = null)
                        {
                            $this->renderizar();
                            if (is_callable($valor)) {
                                $valor(new class($this->ws, $rango) {
                                    private $ws;
                                    private $rango;

                                    public function __construct($ws, $rango)
                                    {
                                        $this->ws = $ws;
                                        $this->rango = $rango;
                                    }

                                    private function estilo()
                                    {
                                        return $this->ws->getStyle($this->rango);
                                    }

                                    public function setValue($v)
                                    {
                                        $this->ws->setCellValue(explode(':', $this->rango)[0], $v);
                                        return $this;
                                    }

                                    public function setFont($f)
                                    {
                                        $this->estilo()->getFont()->applyFromArray(array_intersect_key((array) $f, array_flip(['name', 'size', 'bold', 'italic', 'underline'])));
                                        return $this;
                                    }

                                    public function setFontWeight($w)
                                    {
                                        $this->estilo()->getFont()->setBold($w === 'bold');
                                        return $this;
                                    }

                                    public function setFontSize($s)
                                    {
                                        $this->estilo()->getFont()->setSize($s);
                                        return $this;
                                    }

                                    public function setFontFamily($n)
                                    {
                                        $this->estilo()->getFont()->setName($n);
                                        return $this;
                                    }

                                    public function setFontColor($c)
                                    {
                                        $this->estilo()->getFont()->getColor()->setRGB(ltrim($c, '#'));
                                        return $this;
                                    }

                                    public function setBackground($c)
                                    {
                                        $this->estilo()->getFill()->setFillType('solid')->getStartColor()->setRGB(ltrim($c, '#'));
                                        return $this;
                                    }

                                    public function setAlignment($a)
                                    {
                                        $this->estilo()->getAlignment()->setHorizontal($a);
                                        return $this;
                                    }

                                    public function setValignment($a)
                                    {
                                        $this->estilo()->getAlignment()->setVertical($a === 'middle' ? 'center' : $a);
                                        return $this;
                                    }

                                    public function setBorder(...$b)
                                    {
                                        $tipo = is_string($b[0] ?? null) && $b[0] !== 'none' ? $b[0] : 'thin';
                                        $this->estilo()->getBorders()->getAllBorders()->setBorderStyle($tipo);
                                        return $this;
                                    }

                                    public function __call($m, $a)
                                    {
                                        return $this;
                                    }
                                });
                            } elseif (func_num_args() > 1) {
                                $this->ws->setCellValue($rango, $valor);
                            }
                            return $this;
                        }

                        public function cells($rango, $callback)
                        {
                            $this->renderizar();
                            return $this->cell($rango, $callback);
                        }

                        public function mergeCells($rango)
                        {
                            $this->renderizar();
                            $this->ws->mergeCells($rango);
                            return $this;
                        }

                        public function setWidth($col, $ancho = null)
                        {
                            $this->renderizar();
                            foreach (is_array($col) ? $col : [$col => $ancho] as $c => $w) {
                                $this->ws->getColumnDimension(is_int($c) ? Coordinate::stringFromColumnIndex($c + 1) : $c)->setWidth($w);
                            }
                            return $this;
                        }

                        public function setHeight($fila, $alto = null)
                        {
                            $this->renderizar();
                            foreach (is_array($fila) ? $fila : [$fila => $alto] as $f => $h) {
                                $this->ws->getRowDimension($f)->setRowHeight($h);
                            }
                            return $this;
                        }

                        public function setStyle($estilo)
                        {
                            $this->renderizar();
                            $this->spreadsheet->getDefaultStyle()->applyFromArray($estilo);
                            return $this;
                        }

                        public function setFontFamily($nombre)
                        {
                            $this->renderizar();
                            $this->spreadsheet->getDefaultStyle()->getFont()->setName($nombre);
                            return $this;
                        }

                        public function setFontSize($tam)
                        {
                            $this->renderizar();
                            $this->spreadsheet->getDefaultStyle()->getFont()->setSize($tam);
                            return $this;
                        }

                        public function setFontBold($b = true)
                        {
                            $this->renderizar();
                            $this->spreadsheet->getDefaultStyle()->getFont()->setBold($b);
                            return $this;
                        }

                        public function setOrientation($o)
                        {
                            $this->renderizar();
                            $this->ws->getPageSetup()->setOrientation($o === 'landscape' ? PageSetup::ORIENTATION_LANDSCAPE : PageSetup::ORIENTATION_PORTRAIT);
                            return $this;
                        }

                        public function setAutoSize($v = true)
                        {
                            $this->renderizar();
                            return $this;
                        }

                        public function setBorder($rango = null, $estilo = 'thin')
                        {
                            $this->renderizar();
                            $this->ws->getStyle($rango ?: $this->ws->calculateWorksheetDimension())->getBorders()->getAllBorders()->setBorderStyle($estilo);
                            return $this;
                        }

                        public function setColumnFormat(array $formatos)
                        {
                            $this->renderizar();
                            foreach ($formatos as $rango => $fmt) {
                                $this->ws->getStyle($rango)->getNumberFormat()->setFormatCode($fmt);
                            }
                            return $this;
                        }

                        public function freezeFirstRow()
                        {
                            $this->renderizar();
                            $this->ws->freezePane('A2');
                            return $this;
                        }

                        public function __call($metodo, $args)
                        {
                            $this->renderizar();
                            return $this->ws->$metodo(...$args);
                        }
                    };
                    if ($callback) {
                        $callback($hoja);
                    }
                    $hoja->renderizar();
                    return $this;
                }

                public function respuesta($ext = 'xlsx')
                {
                    $ext = strtolower($ext);
                    $tipos = ['xlsx' => 'Xlsx', 'xls' => 'Xls', 'csv' => 'Csv', 'ods' => 'Ods', 'html' => 'Html'];
                    $this->spreadsheet->setActiveSheetIndex(0);
                    $writer = IOFactory::createWriter($this->spreadsheet, $tipos[$ext] ?? 'Xlsx');
                    return response()->streamDownload(function () use ($writer) {
                        $writer->save('php://output');
                    }, $this->nombre . '.' . $ext);
                }

                // En 2.x export()/download() enviaban el archivo y terminaban la petición;
                // los controladores heredados no retornan su resultado, así que se conserva ese comportamiento.
                public function export($ext = 'xlsx')
                {
                    $this->respuesta($ext)->send();
                    exit;
                }

                public function download($ext = 'xlsx')
                {
                    $this->export($ext);
                }
            };
            if ($callback) {
                $callback($libro);
            }
            return $libro;
        });
    }
}
