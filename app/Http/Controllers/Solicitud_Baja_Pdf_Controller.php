<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PDFBaja extends FPDF
{
    function Header()
    {
        
        $this->Image(public_path('assets/img/logo.png'), 13, 8, 45);

        $this->SetFillColor(198, 40, 40);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 15);
        $this->SetXY(131, 7);
        $this->Cell(72, 10, utf8_decode('Solicitud de baja'), 0, 0, 'C', true);
        $this->SetTextColor(0, 0, 0);

        $this->Image(public_path('img/servicios.png'), 161, 14, 40);

        
        $this->SetFont('Arial', 'B', 11);
        $this->SetXY(13, 42);
        $this->Cell(190, 6, utf8_decode('TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'), 0, 1, 'C');
    }

    function Footer()
    {
        /**$this->SetY(-15);
        $this->SetFont('Arial', '', 7);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(0, 5, utf8_decode('TESVB - Servicios Escolares'), 0, 0, 'C');
        $this->SetTextColor(0, 0, 0);**/
    }

    
    function SectionBox($x, $y, $w, $h)
    {
        $this->SetDrawColor(160, 160, 160);
        $this->Rect($x, $y, $w, $h);
        $this->SetDrawColor(0, 0, 0);
    }

    
    function CampoDato($x, $y, $w, $h, $valor, $etiqueta)
    {
        $this->SetDrawColor(0, 0, 0);
        $this->Rect($x, $y, $w, $h);

        $this->SetFont('Arial', '', 10);
        $this->SetXY($x + 2, $y);
        $this->Cell($w - 4, $h, utf8_decode($valor), 0, 0, 'L', false);

        $this->SetFont('Arial', '', 7.5);
        $this->SetXY($x, $y + $h + 1);
        $this->Cell($w, 4, utf8_decode($etiqueta), 0, 0, 'C');
    }

    
    function Checkbox($x, $y, $checked = false)
    {
        $this->Rect($x, $y, 4, 4);
        if ($checked) {
            $this->SetFont('Arial', 'B', 9);
            $this->SetXY($x, $y - 0.6);
            $this->Cell(4, 4.6, 'X', 0, 0, 'C');
        }
    }
}

class Solicitud_Baja_Pdf_Controller extends Controller
{
    
    public function imprimir($id_alumno, $id, $tipo)
    {
        $periodoActual = DB::selectOne('SELECT id_periodo FROM gnral_periodos WHERE estado = 1 LIMIT 1');

        if (!$periodoActual) {
            return response('<h3 style="font-family:Arial;color:#c62828;text-align:center;margin-top:60px;">'
                . 'No se encontró un periodo activo para validar el adeudo del alumno.</h3>');
        }

        if ($this->tieneSancion($id_alumno, $periodoActual->id_periodo)) {
            return response('<h3 style="font-family:Arial;color:#c62828;text-align:center;margin-top:60px;">'
                . 'No se puede generar la solicitud de baja: el alumno tiene adeudo pendiente en departamento o carrera.</h3>');
        }

        $alumno = DB::selectOne('SELECT * FROM gnral_alumnos WHERE id_alumno = ' . (int) $id_alumno);
        $carrera = DB::selectOne('SELECT * FROM gnral_carreras WHERE id_carrera = ' . (int) $alumno->id_carrera);
        $seguroSocial = DB::selectOne('SELECT * FROM gnral_seguro_social WHERE id_seguro_social = ' . (int) $alumno->id_seguro_social);

        $validacion = DB::table('eva_validacion_de_cargas')
            ->where('id', $id)
            ->where('id_alumno', $id_alumno)
            ->first();

        $motivo = $validacion->descripcion ?? '';
        $fecha = Carbon::now();
        $tipoBajaTexto = $tipo === 'definitiva' ? 'Definitiva' : 'Temporal';
        $nombreSeguro = $seguroSocial->descripcion ?? '';

        $pdf = new PDFBaja('P', 'mm', 'Letter');
        $pdf->SetMargins(13, 10, 13);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        
        $pdf->SectionBox(13, 54, 190, 50);

        $pdf->CampoDato(15, 57, 186, 8,
            $alumno->apaterno . ' ' . $alumno->amaterno . ' ' . $alumno->nombre,
            'Apellido Paterno, Apellido Materno, Nombre(s)');

        $pdf->CampoDato(15, 73, 186, 8,
            $carrera->nombre ?? '', 'Carrera');

        $pdf->CampoDato(15, 89, 90, 8,
            $alumno->cuenta, 'Número de cuenta');

        $pdf->CampoDato(111, 89, 90, 8,
            $tipoBajaTexto, 'Tipo de baja (Temporal o Definitiva)');

        
        $pdf->SectionBox(13, 108, 190, 32);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(13, 113);
        $pdf->Cell(190, 5, utf8_decode('CONSTANCIA DE NO ADEUDO'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 8.5);
        $pdf->SetXY(18, 121);
        $pdf->MultiCell(180, 5, utf8_decode(
            'Se hace constar que el estudiante cuyo nombre aparece en la solicitud, NO tiene adeudos en las áreas de: '
            . 'Dirección General, Direcciones de Área, Subdirecciones, Jefaturas de División, Jefaturas de Departamento, '
            . 'Bolsa de Trabajo y Seguimiento de Egresados, Centro de Información y Centro de Cómputo.'
        ), 0, 'C');

        
        $pdf->SectionBox(13, 142, 190, 36);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(25, 155);
        $pdf->MultiCell(80, 4.5, utf8_decode('¿A QUÉ INSTITUCIÓN SE' . "\n" . 'ENCUENTRA AFILIADO?'), 0, 'L');

        $instituciones = ['IMSS', 'ISSSTE', 'ISSEMYM', 'OTRO'];
        $yCheck = 147;
        $pdf->SetFont('Arial', '', 9);
        foreach ($instituciones as $inst) {
            $marcado = strtoupper(trim($nombreSeguro)) === $inst
                || ($inst === 'OTRO' && $nombreSeguro !== '' && !in_array(strtoupper(trim($nombreSeguro)), ['IMSS', 'ISSSTE', 'ISSEMYM']));

            $pdf->Checkbox(80, $yCheck, $marcado);
            $pdf->SetXY(85, $yCheck - 0.5);
            $texto = ($inst === 'OTRO' && $marcado) ? 'OTRO: ' . $nombreSeguro : $inst;
            $pdf->Cell(90, 5, utf8_decode($texto), 0, 0, 'L');
            $yCheck += 7;
        }

        $pdf->SetFillColor(235, 235, 235);
        $pdf->Rect(149, 147, 53, 28, 'DF');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(151, 154);
        $pdf->Cell(51, 8, utf8_decode($alumno->numero_seguro_social ?? ''), 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetTextColor(140, 140, 140);
        $pdf->SetXY(151, 168);
        $pdf->Cell(51, 4, utf8_decode('NÚMERO DE SEGURIDAD SOCIAL'), 0, 0, 'C');
        $pdf->SetTextColor(0, 0, 0);


        $pdf->SectionBox(13, 180, 190, 38);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(13, 184);
        $pdf->Cell(190, 5, utf8_decode('MOTIVO DE LA BAJA'), 0, 1, 'C');

        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Rect(15, 191, 186, 24);
        $pdf->SetFont('Arial', '', 9.5);
        $pdf->SetXY(18, 194);
        $pdf->MultiCell(180, 5.5, utf8_decode($motivo), 0, 'L');

    
        $pdf->SectionBox(13, 220, 190, 8);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(13, 220);
        $pdf->Cell(190, 8, utf8_decode(
            'Valle de Bravo, Estado de México, a ' . $fecha->day . ' de ' .
            $fecha->translatedFormat('F') . ' del ' . $fecha->year
        ), 0, 0, 'C');

       
        $pdf->SectionBox(13, 232, 60, 28);
        $pdf->Line(18, 250, 68, 250);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(13, 253);
        $pdf->Cell(60, 4, utf8_decode('Firma del estudiante'), 0, 0, 'C');

        // Nota central (solo aplica a baja temporal)
        $pdf->SectionBox(76, 232, 64, 28);
        $pdf->SetFont('Arial', 'I', 6.8);
        $pdf->SetXY(78, 235);
        $pdf->MultiCell(60, 3.6, utf8_decode(
            'Si el estudiante que solicita la baja temporal está en un plan de estudios en liquidación, deberá sujetarse a los lineamientos que marque el nuevo plan de estudios cuando reingrese.'
        ), 0, 'C');

        
        $pdf->SectionBox(143, 232, 60, 28);
        $pdf->Line(148, 250, 198, 250);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(143, 253);
        $pdf->Cell(60, 4, utf8_decode('Vo. Bo. Jefatura de división'), 0, 0, 'C');

        $pdf->Output();
        exit();
    }

    public function verificarAdeudo($id_alumno)
    {
        $periodoActual = DB::selectOne('SELECT id_periodo FROM gnral_periodos WHERE estado = 1 LIMIT 1');

        if (!$periodoActual) {
            return response()->json([
                'tiene_adeudo' => true,
                'mensaje' => 'No se encontró un periodo activo para validar el adeudo del alumno.',
                'departamentos' => [],
            ]);
        }

        $departamentosAdeudo = DB::select("
            SELECT DISTINCT gnral_unidad_administrativa.nom_departamento, adeudo_departamento.id_departamento
            FROM adeudo_departamento
            LEFT JOIN gnral_unidad_administrativa
                ON gnral_unidad_administrativa.id_unidad_admin = adeudo_departamento.id_departamento
            WHERE adeudo_departamento.id_alumno = ?
              AND adeudo_departamento.id_periodo = ?
        ", [$id_alumno, $periodoActual->id_periodo]);

        $tieneAdeudoCarrera = DB::selectOne("
            SELECT COUNT(id_adeudo_carrera) AS total
            FROM adeudo_carrera
            WHERE id_alumno = ?
              AND id_periodo = ?
        ", [$id_alumno, $periodoActual->id_periodo]);

        // IDs especiales que no existen en gnral_unidad_administrativa 
        $unidadesEspeciales = [
            50  => 'Centro de Información',
            100 => 'Bolsa de Trabajo y Seguimiento de Egresados',
        ];

        $detalle = array_map(function ($d) use ($unidadesEspeciales) {
            if ($d->nom_departamento) {
                return $d->nom_departamento;
            }
            return $unidadesEspeciales[$d->id_departamento] ?? 'Departamento no identificado';
        }, $departamentosAdeudo);

        $tieneAdeudo = count($detalle) > 0 || ($tieneAdeudoCarrera->total ?? 0) > 0;

        if ($tieneAdeudoCarrera->total > 0) {
            $detalle[] = 'Carrera / Programa académico';
        }

        return response()->json([
            'tiene_adeudo' => $tieneAdeudo,
            'departamentos' => $detalle,
        ]);
    }

    private function tieneSancion($id_alumno, $id_periodo)
    {
        $adeudo_depto = DB::selectOne("
            SELECT COUNT(id_adeudo_departamento) AS total
            FROM adeudo_departamento
            WHERE id_alumno  = ?
              AND id_periodo = ?
        ", [$id_alumno, $id_periodo]);

        if ($adeudo_depto->total > 0) {
            return true;
        }

        $adeudo_carrera = DB::selectOne("
            SELECT COUNT(id_adeudo_carrera) AS total
            FROM adeudo_carrera
            WHERE id_alumno  = ?
              AND id_periodo = ?
        ", [$id_alumno, $id_periodo]);

        return $adeudo_carrera->total > 0;
    }
}