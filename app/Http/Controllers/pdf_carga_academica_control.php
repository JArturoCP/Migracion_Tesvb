<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Session;


class PDFCargaAcademicaControl extends FPDF
{

    //CABECERA DE LA PAGINA
    function Header()
    {
        $this->Image(public_path('img/tes.png'), 120, 5, 40);
        $this->SetXY(0,20);
        $this->SetFont('Arial','B',8);
        $this->Ln(2);
        $this->Cell(270,5,utf8_decode('TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'),0,0,'C');
        $this->Ln(4);
        $this->Ln(10);
    }
    //PIE DE PAGINA
    function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial','B',8);
        $this->Cell(100);
        $this->Cell(150,-2,utf8_decode('F39-PSGOE-07  V.1  14-12-2023'),0,0,'R');
    }

    public function tableRow(array $widths, array $values, array $alignments, bool $fill = false, bool $pageCheck = true): bool
    {
        $values = array_map(
            static fn ($value) => mb_convert_encoding((string) $value, 'Windows-1252', 'UTF-8'),
            $values
        );

        // Medir con el mismo algoritmo y la misma fuente que imprimen el texto.
        $measure = clone $this;
        $measure->SetAutoPageBreak(false);
        $height = 5;
        foreach ($widths as $i => $width) {
            $measure->SetXY($this->lMargin, 0);
            $measure->MultiCell($width, 5, $values[$i], 0, $alignments[$i]);
            $height = max($height, $measure->GetY());
        }

        // Reservar espacio para el total y las firmas.
        if ($pageCheck && $this->GetY() + $height > 150) {
            return false;
        }

        $x = $this->lMargin;
        $y = $this->GetY();
        foreach ($widths as $i => $width) {
            $this->Rect($x, $y, $width, $height, $fill ? 'DF' : 'D');
            $this->SetXY($x, $y);
            $this->MultiCell($width, 5, $values[$i], 0, $alignments[$i]);
            $x += $width;
        }
        $this->SetY($y + $height);

        return true;
    }
}

class pdf_carga_academica_control extends Controller
{
    public function index($id)
    {
        $periodo = Session::get('periodo_actual');
        abort_unless($periodo, 422, 'No hay un ciclo escolar activo.');

        $validacion = DB::table('eva_validacion_de_cargas')
            ->where('id_alumno', $id)
            ->where('id_periodo', $periodo)
            ->exists();
        abort_unless($validacion, 404, 'No se encontró la carga académica del estudiante en este ciclo.');

        $alumno = DB::table('gnral_alumnos')->where('id_alumno', $id)->first();
        abort_if($alumno === null, 404, 'No se encontró al estudiante.');
        $carrera = DB::table('gnral_carreras')->where('id_carrera', $alumno->id_carrera)->value('nombre');
        $ciclo = DB::table('gnral_periodos')->where('id_periodo', $periodo)->value('periodo');
        abort_if($carrera === null || $ciclo === null, 404, 'No se encontró el programa académico o el ciclo escolar.');

        $materias = DB::select('SELECT eva_carga_academica.id_carga_academica,gnral_materias.id_materia,gnral_materias.clave,gnral_materias.nombre,gnral_materias.id_semestre,gnral_materias.creditos,eva_status_materia.nombre_status,eva_tipo_curso.nombre_curso,eva_carga_academica.grupo
                                FROM
                                gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos
                                WHERE eva_carga_academica.id_materia=gnral_materias.id_materia
                                AND eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia
                                AND eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso
                                AND eva_carga_academica.id_periodo=gnral_periodos.id_periodo
                                AND eva_carga_academica.grupo=gnral_grupos.id_grupo
                                AND eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                                AND gnral_periodos.id_periodo= ?
                                AND eva_carga_academica.id_alumno= ?', [$periodo, $id]);


        $pdf = new PDFCargaAcademicaControl('L', 'mm', 'Letter');
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(0, 5, mb_convert_encoding('Carga Académica', 'Windows-1252', 'UTF-8'), 0, 1, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetLineWidth(0.3);
        $pdf->tableRow([31, 59, 50, 119], [
            'CICLO ESCOLAR', $ciclo, 'PROGRAMA ACADÉMICO', $carrera,
        ], ['L', 'L', 'L', 'L'], pageCheck: false);
        $pdf->tableRow([31, 59, 50, 119], [
            'No. DE CUENTA', $alumno->cuenta, 'NOMBRE DEL ESTUDIANTE',
            trim($alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno),
        ], ['L', 'L', 'L', 'L'], pageCheck: false);
        $pdf->Ln(5);

        $columnas = [30, 104, 22, 40, 43, 20];
        $encabezado = static function () use ($pdf, $columnas): void {
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetFillColor(166, 166, 166);
            $pdf->tableRow($columnas, [
                'CLAVE DE LA MATERIA', 'NOMBRE DE LA MATERIA', 'CRÉDITOS',
                "ESTATUS DE LA\nMATERIA", 'TIPO DE CURSO', 'GRUPO',
            ], ['C', 'C', 'C', 'C', 'C', 'C'], fill: true, pageCheck: false);
            $pdf->SetFont('Arial', '', 9);
        };
        $encabezado();

        $creditos = 0;
        foreach ($materias as $materia) {
            $esMateriaSinCreditos = (int) $materia->id_materia === 2258;
            $valores = [
                $materia->clave, $materia->nombre, $esMateriaSinCreditos ? '' : $materia->creditos,
                $materia->nombre_status, $materia->nombre_curso,
                $esMateriaSinCreditos ? '' : $materia->id_semestre.'0'.$materia->grupo,
            ];
            $alineacion = ['C', 'L', 'C', 'C', 'C', 'C'];
            if (!$pdf->tableRow($columnas, $valores, $alineacion)) {
                $pdf->AddPage();
                $encabezado();
                $pdf->tableRow($columnas, $valores, $alineacion, pageCheck: false);
            }
            if (!$esMateriaSinCreditos) {
                $creditos += $materia->creditos;
            }
        }

        $pdf->Cell(134, 5, mb_convert_encoding('TOTAL DE CRÉDITOS', 'Windows-1252', 'UTF-8'), 0, 0, 'R');
        $pdf->Cell(22, 5, $creditos, 1, 1, 'C');

        $pdf->SetFillColor(230, 230, 230);
        $pdf->Rect(40, 158, 100, 25, 'DF');
        $pdf->Line(60, 175, 120, 175);
        $pdf->Rect(145, 158, 100, 25, 'DF');
        $pdf->Line(165, 175, 225, 175);
        $pdf->Text(82, 180, 'ESTUDIANTE');
        $pdf->Text(160, 180, mb_convert_encoding('SUBDIRECCIÓN DE SERVICIOS ESCOLARES', 'Windows-1252', 'UTF-8'));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(186, 162, mb_convert_encoding('AUTORIZÓ', 'Windows-1252', 'UTF-8'));
        $pdf->Text(83, 162, mb_convert_encoding('ELABORÓ', 'Windows-1252', 'UTF-8'));

        return response($pdf->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="doc.pdf"',
        ]);
    }
}
