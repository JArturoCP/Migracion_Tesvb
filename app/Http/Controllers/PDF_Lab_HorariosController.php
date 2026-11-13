<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * IMPORTANTE:
 * La clase PDF (extends FPDF) con Header()/Footer() institucional YA está
 * declarada en PdfHorariosController.php, dentro del mismo namespace
 * App\Http\Controllers. NO se vuelve a declarar aquí para evitar el error
 * "Cannot declare class App\Http\Controllers\PDF, because the name is
 * already in use". Simplemente se reutiliza con `new PDF(...)`.
 *
 * OJO: como PDF no tiene su propio archivo PDF.php, el autoload PSR-4 de
 * Composer no la encuentra por sí solo (solo indexa por nombre de archivo).
 * Por eso se incluye aquí manualmente el archivo que la contiene, antes de
 * usarla — si no, truena con "Class App\Http\Controllers\PDF not found".
 */
require_once __DIR__ . '/PdfHorariosController.php';


/**
 * Clase PDF específica para este reporte.
 *
 * Hereda el Header() institucional de PDF, pero omite el Footer().
 */
class PDF_Lab_Horarios extends PDF_PdfHorariosController
{
    public function Footer()
    {
        // Se omite el footer institucional para este PDF.
    }
}


class PDF_Lab_HorariosController extends Controller
{

    public function index($id_laboratorio, $fecha_inicial, $fecha_final)
    {
        $fecha_inicial = date('Y-m-d', strtotime($fecha_inicial));
        $fecha_final   = date('Y-m-d', strtotime($fecha_final));
        $id_periodo    = Session::get('periodotrabaja');

        $laboratorio = DB::selectOne(
            'SELECT * FROM lb_laboratorios WHERE id_laboratorio= ?', [$id_laboratorio]
        );

        $horarios = DB::select('SELECT lb_profesores_materia.id_semana
            FROM gnral_personales, lb_profesores_materia
            WHERE lb_profesores_materia.id_profesor = gnral_personales.id_personal
              AND lb_profesores_materia.id_periodo = ?
              AND lb_profesores_materia.id_laboratorio = ?
            UNION
            SELECT lb_registro_laboratorio.id_semana
            FROM lb_registro_laboratorio
            WHERE lb_registro_laboratorio.id_laboratorio = ?
              AND lb_registro_laboratorio.fecha_registro BETWEEN ? AND ?
            ORDER BY id_semana ASC', [$id_periodo, $id_laboratorio, $id_laboratorio, (string) ($fecha_inicial), (string) ($fecha_final)]);

        $array_horarios = [];
        foreach ($horarios as $horario) {
            $array_horarios[] = ['id_semana' => $horario->id_semana];
        }

        // Catálogo completo de franjas hora/día
        $sem = DB::select('SELECT id_semana FROM hrs_semanas');
        $array_semana = [];
        foreach ($sem as $s) {
            $array_semana[] = ['id_semana' => $s->id_semana];
        }

        // 2) Franjas SIN ocupar -> quedan vacías (ofp = 3)
        $array_laboratorios = [];
        foreach ($array_semana as $franja) {
            $ocupada = false;
            foreach ($array_horarios as $ocupado) {
                if ($franja['id_semana'] == $ocupado['id_semana']) {
                    $ocupada = true;
                    break;
                }
            }
            if (!$ocupada) {
                $array_laboratorios[] = [
                    'id_semana' => $franja['id_semana'],
                    'nombre'    => 0,
                    'carrera'   => 0,
                    'registro'  => 0,
                    'ofp'       => 3,
                ];
            }
        }

        // 3) Franjas OCUPADAS: asignación recurrente (ofp=2) y reservas por fecha (ofp=4)
        $horariosprofesor = DB::select('SELECT lb_profesores_materia.id_semana, lb_profesores_materia.descripcion,
                gnral_personales.nombre, 2 fop, lb_profesores_materia.id_profesores_materia registro
            FROM gnral_personales, lb_profesores_materia
            WHERE lb_profesores_materia.id_profesor = gnral_personales.id_personal
              AND lb_profesores_materia.id_periodo = ?
              AND lb_profesores_materia.id_laboratorio = ?
            UNION
            SELECT lb_registro_laboratorio.id_semana, lb_registro_laboratorio.descripcion_utilizar,
                gnral_personales.nombre, 4 fop, lb_registro_laboratorio.id_reg_laboratorio registro
            FROM lb_registro_laboratorio, gnral_personales
            WHERE lb_registro_laboratorio.id_usuario = gnral_personales.id_personal
              AND lb_registro_laboratorio.id_laboratorio = ?
              AND lb_registro_laboratorio.fecha_registro BETWEEN ? AND ?
            ORDER BY id_semana ASC', [$id_periodo, $id_laboratorio, $id_laboratorio, (string) ($fecha_inicial), (string) ($fecha_final)]);

        foreach ($horariosprofesor as $h) {
            $array_laboratorios[] = [
                'id_semana' => $h->id_semana,
                'nombre'    => $h->nombre,
                'carrera'   => $h->descripcion,
                'registro'  => $h->registro,
                'ofp'       => $h->fop,
            ];
        }

        $orden = array_column($array_laboratorios, 'id_semana');
        array_multisort($orden, SORT_ASC, $array_laboratorios);


        $contenido_semana = [];
        foreach ($array_laboratorios as $row) {
            if ($row['ofp'] == 3) {
                continue; // franja vacía
            }
            $tipo   = $row['ofp'] == 2 ? '' : '(Registro)';
            $texto  = trim($row['nombre'] . ' - ' . $row['carrera'] . ' ' . $tipo);
            $contenido_semana[$row['id_semana']][] = $texto;
        }


        $dias    = DB::select('SELECT DISTINCT dia FROM hrs_semanas');
        $horas   = DB::select('SELECT DISTINCT hora FROM hrs_semanas ORDER BY hora');
        $semanas = DB::select('SELECT * FROM hrs_semanas ORDER BY hora, id_semana');


        $indice_semanas = [];
        foreach ($semanas as $s) {
            $indice_semanas[$s->dia . '|' . $s->hora] = $s->id_semana;
        }


        $pdf = new PDF_Lab_Horarios('L', 'mm', 'Letter');
        $pdf->SetMargins(5, 20, 0);
        $pdf->SetAutoPageBreak(false); // el salto de página se controla a mano abajo
        $pdf->AddPage();
        $pdf->SetDrawColor(49, 49, 49);
        $pdf->SetLineWidth(0.2);

        $col_hora   = 20;
        $col_dia    = 41; // 20 + 6*41 = 266mm, cabe en Letter horizontal (279mm)
        $line_h     = 3;  // alto de línea en mm para fuente 6
        $limite_pie = 20; // margen inferior antes de forzar salto de página
        // Letter horizontal mide 215.9mm de alto. Si tu versión de FPDF trae
        // GetPageHeight() se usa esa (más exacto); si no, cae al valor fijo.
        $alto_pagina = method_exists($pdf, 'GetPageHeight') ? $pdf->GetPageHeight() : 215.9;

        $imprimirTitulo = function () use ($pdf, $laboratorio, $fecha_inicial, $fecha_final) {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(0, 7, utf8_decode('HORARIO DE OCUPACIÓN DE LABORATORIO'), 0, 1, 'C');
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(0, 4, utf8_decode('LABORATORIO: ' . ($laboratorio->descripcion ?? '')), 0, 1, 'L');
            $pdf->Cell(0, 4, utf8_decode('PERIODO DEL ' . $fecha_inicial . ' AL ' . $fecha_final), 0, 1, 'L');
            $pdf->Ln(2);
        };

        $imprimirEncabezadoTabla = function () use ($pdf, $dias, $col_hora, $col_dia) {
            $pdf->SetFont('Arial', 'B', 6.5);
            $pdf->Cell($col_hora, 6, utf8_decode('Hora / Día'), 1, 0, 'C');
            foreach ($dias as $dia) {
                $pdf->Cell($col_dia, 6, utf8_decode(ucfirst($dia->dia)), 1, 0, 'C');
            }
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 6);
        };

        $imprimirTitulo();
        $imprimirEncabezadoTabla();

        foreach ($horas as $hora) {
            // Texto de cada día para esta hora, ya resuelto
            $textos_dia = [];
            foreach ($dias as $dia) {
                $id_semana = $indice_semanas[$dia->dia . '|' . $hora->hora] ?? null;
                $textos_dia[] = ($id_semana !== null && isset($contenido_semana[$id_semana]))
                    ? implode("\n", $contenido_semana[$id_semana])
                    : '';
            }

            // Envolver cada texto en líneas reales según el ancho de columna
            $lineas_por_dia = [];
            $max_lineas = 1;
            foreach ($textos_dia as $texto) {
                $lineas = $texto === '' ? [] : $this->envolverTexto($pdf, utf8_decode($texto), $col_dia);
                $lineas_por_dia[] = $lineas;
                $max_lineas = max($max_lineas, count($lineas));
            }
            $alto_fila = max(6, $max_lineas * $line_h);

            // Salto de página manual si la fila no cabe
            if ($pdf->GetY() + $alto_fila > $alto_pagina - $limite_pie) {
                $pdf->AddPage();
                $imprimirTitulo();
                $imprimirEncabezadoTabla();
            }

            $y = $pdf->GetY();

            // Columna Hora
            $pdf->Rect(5, $y, $col_hora, $alto_fila);
            $pdf->SetXY(5, $y + ($alto_fila - $line_h) / 2);
            $pdf->Cell($col_hora, $line_h, utf8_decode($hora->hora), 0, 0, 'C');

            // Columnas de días, línea por línea (sin MultiCell, así la altura es exacta)
            $x = 5 + $col_hora;
            foreach ($lineas_por_dia as $lineas) {
                $pdf->Rect($x, $y, $col_dia, $alto_fila);
                foreach ($lineas as $i => $linea) {
                    $pdf->SetXY($x + 1, $y + ($i * $line_h));
                    $pdf->Cell($col_dia - 2, $line_h, $linea, 0, 0, 'C');
                }
                $x += $col_dia;
            }

            $pdf->SetXY(5, $y + $alto_fila);
        }

        $pdf->Output();
        exit();
    }



    private function envolverTexto($pdf, $texto, $ancho_mm)
    {
        $lineas = [];
        foreach (explode("\n", $texto) as $parrafo) {
            $parrafo = trim($parrafo);
            if ($parrafo === '') {
                continue;
            }
            $palabras = explode(' ', $parrafo);
            $actual = '';
            foreach ($palabras as $palabra) {
                $prueba = $actual === '' ? $palabra : $actual . ' ' . $palabra;
                if ($pdf->GetStringWidth($prueba) > ($ancho_mm - 2) && $actual !== '') {
                    $lineas[] = $actual;
                    $actual = $palabra;
                } else {
                    $actual = $prueba;
                }
            }
            if ($actual !== '') {
                $lineas[] = $actual;
            }
        }
        return $lineas;
    }
}
