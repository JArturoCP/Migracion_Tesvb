<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Examen_GnralReporteDocentesExport implements
    FromCollection,
    WithHeadings,
    WithEvents
{

    public function collection()
    {

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado',1)
            ->value('id_examen_egel');


        return DB::table('gnral_personales as p')
            ->join('gnral_horarios as h',
                'h.id_personal','=','p.id_personal')

            ->join('gnral_periodo_carreras as pc',
                'pc.id_periodo_carrera','=','h.id_periodo_carrera')

            ->join('gnral_carreras as c',
                'c.id_carrera','=','pc.id_carrera')

            ->join('egel_resultados_docentes as r',
                function($join) use($id_examen_egel){

                    $join->on('r.id_docente','=','p.id_personal')
                         ->where('r.id_examen_egel',$id_examen_egel);

                })

            ->select(
                'p.nombre',
                'p.escolaridad',
                DB::raw('MIN(c.nombre) as carrera'),
                'r.calificacion_general'
            )

            ->groupBy(
                'p.id_personal',
                'p.nombre',
                'p.escolaridad',
                'r.calificacion_general'
            )

            ->orderBy('p.nombre')

            ->get();

    }


    public function headings(): array
    {
        return [
            'DOCENTE',
            'GRADO ACADÉMICO',
            'CARRERA',
            'CALIFICACIÓN GENERAL (%)'
        ];
    }



    public function registerEvents(): array
    {

        return [

            AfterSheet::class => function(AfterSheet $event){

                $sheet = $event->sheet->getDelegate();


                /*
                |--------------------------------------------------------------------------
                | INSERTAR TITULO
                |--------------------------------------------------------------------------
                */

                $sheet->insertNewRowBefore(1,3);


                $sheet->mergeCells('A1:D1');

                $sheet->setCellValue(
                    'A1',
                    'REPORTE DE RESULTADOS DEL EXAMEN DE CONOCIMIENTOS GENERALES'
                );


                $sheet->mergeCells('A2:D2');

                $sheet->setCellValue(
                    'A2',
                    'Fecha de generación: '.date('d/m/Y H:i')
                );


                $sheet->mergeCells('A3:D3');

                $sheet->setCellValue(
                    'A3',
                    'Listado general de docentes evaluados'
                );



                /*
                |--------------------------------------------------------------------------
                | TITULO
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1:D1')
                ->applyFromArray([

                    'font'=>[
                        'bold'=>true,
                        'size'=>16,
                        'color'=>[
                            'rgb'=>'FFFFFF'
                        ]
                    ],

                    'fill'=>[
                        'fillType'=>Fill::FILL_SOLID,
                        'startColor'=>[
                            'rgb'=>'1F4E78'
                        ]
                    ],

                    'alignment'=>[
                        'horizontal'=>Alignment::HORIZONTAL_CENTER
                    ]

                ]);



                $sheet->getStyle('A2:D3')
                ->applyFromArray([

                    'font'=>[
                        'italic'=>true,
                        'size'=>10
                    ],

                    'alignment'=>[
                        'horizontal'=>Alignment::HORIZONTAL_CENTER
                    ]

                ]);




                /*
                |--------------------------------------------------------------------------
                | ENCABEZADOS
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A4:D4')
                ->applyFromArray([

                    'font'=>[
                        'bold'=>true,
                        'color'=>[
                            'rgb'=>'FFFFFF'
                        ]
                    ],


                    'fill'=>[
                        'fillType'=>Fill::FILL_SOLID,
                        'startColor'=>[
                            'rgb'=>'305496'
                        ]
                    ],

                    'alignment'=>[
                        'horizontal'=>Alignment::HORIZONTAL_CENTER
                    ]

                ]);



                /*
                |--------------------------------------------------------------------------
                | TAMAÑO COLUMNAS
                |--------------------------------------------------------------------------
                */

                $sheet->getColumnDimension('A')->setWidth(38);
                $sheet->getColumnDimension('B')->setWidth(22);
                $sheet->getColumnDimension('C')->setWidth(50);
                $sheet->getColumnDimension('D')->setWidth(25);



                $ultimaFila=$sheet->getHighestRow();



                /*
                |--------------------------------------------------------------------------
                | FILTRO
                |--------------------------------------------------------------------------
                */

                $sheet->setAutoFilter(
                    'A4:D'.$ultimaFila
                );



                /*
                |--------------------------------------------------------------------------
                | CONGELAR ENCABEZADO
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A5');



                /*
                |--------------------------------------------------------------------------
                | BORDES
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A4:D'.$ultimaFila
                )
                ->applyFromArray([

                    'borders'=>[

                        'allBorders'=>[

                            'borderStyle'=>Border::BORDER_THIN,

                            'color'=>[
                                'rgb'=>'D0D0D0'
                            ]

                        ]

                    ]

                ]);



                /*
                |--------------------------------------------------------------------------
                | FILAS ALTERNADAS
                |--------------------------------------------------------------------------
                */

                for($i=5;$i<=$ultimaFila;$i++){

                    if($i%2==0){

                        $sheet->getStyle("A{$i}:D{$i}")
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB('F4F8FC');

                    }

                }



                /*
                |--------------------------------------------------------------------------
                | SEMAFORO CALIFICACION
                |--------------------------------------------------------------------------
                */

                for($i=5;$i<=$ultimaFila;$i++){


                    $celda="D{$i}";


                    $valor=$sheet->getCell($celda)->getValue();



                    if($valor>=80){

                        $color='C6EFCE';

                    }elseif($valor>=60){

                        $color='FFEB9C';

                    }else{

                        $color='FFC7CE';

                    }



                    $sheet->getStyle($celda)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB($color);



                    $sheet->getStyle($celda)
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );

                }



            }

        ];

    }


}