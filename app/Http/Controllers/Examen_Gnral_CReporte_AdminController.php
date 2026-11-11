<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use App\Exports\Examen_GnralReporteDocentesExport;
use Maatwebsite\Excel\Facades\Excel;


class Examen_Gnral_CReporte_AdminController extends Controller
{
    public function generar($id_docente)
    {

    //dd($id_docente);
       
    $periodo=Session::get('periodo_actual');

        // =========================
        // DOCENTE
        // =========================
        /*$docente = DB::table('gnral_personales as p')
            ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
            ->where('p.id_personal', $id_docente)
             ->where('p.estado_docente_inv', 1)
            ->select('p.*', 'c.nombre as carrera')
            ->distinct()
            ->first();*/

        $carreras = DB::table('gnral_carreras')
        ->where('id_carrera', '!=', 11)
        ->where('id_carrera', '!=', 15)
        ->pluck('id_carrera');

        $nuevoUsuario = DB::table('egel_nuevos_docentes as nd')
        ->join('users as u', 'nd.correo', '=', 'u.email')
        ->join('gnral_carreras as c', 'nd.id_carrera', '=', 'c.id_carrera')
        ->select(
            'nd.*',
            'u.*',
            'c.nombre as carrera'
        )
        ->where('nd.id_egel_nuevo_docente', $id_docente)
        ->whereIn('nd.id_carrera', $carreras)
        ->first();

        if ($nuevoUsuario) {

        // =========================
        // EXAMEN ACTIVO
        // =========================
        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $nuevoUsuario->id_carrera)
            ->value('id_examen_egel');

        // =========================
        // RESULTADO GENERAL
        // =========================


        
        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente', $nuevoUsuario->id_egel_nuevo_docente)
            ->where('id_examen_egel', $id_examen_egel)
            ->first();

            /*dd([
    'nuevo_docente' => $nuevoUsuario,
    'id_examen' => $id_examen_egel,
    'resultado' => $resultado
]);*/
//dd($resultado);
        // =========================
        // POR MÓDULO
        // =========================
        $porModulo = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
            ->join('egel_modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
            ->where('rp.id_docente', $nuevoUsuario->id_egel_nuevo_docente)
            ->where('rp.id_examen_egel', $id_examen_egel)
            ->groupBy('m.id_modulo', 'm.nombre')
            ->selectRaw("
                m.nombre,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) / SUM(p.valor)) * 100,2) as porcentaje
            ")
            ->get();

        // =========================
        // POR SECCIÓN
        // =========================
        $porSeccion = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
            ->where('rp.id_docente', $nuevoUsuario->id_egel_nuevo_docente)
            ->where('rp.id_examen_egel', $id_examen_egel)
            ->groupBy('rp.id_seccion')
            ->selectRaw("
                rp.id_seccion,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) / SUM(p.valor)) * 100,2) as porcentaje
            ")
            ->get();

         }

         else {

            $docente = DB::table('gnral_personales as p')
            ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
            ->join('gnral_horas_profesores as hp', 'hp.id_horario_profesor', '=', 'h.id_horario_profesor')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
            ->where('p.id_personal', $id_docente)
            ->where('pc.id_periodo', $periodo)
            ->where('p.estado_docente_inv', 1)
            ->select('p.*', 'c.nombre as carrera')
            ->distinct()
            ->first();

        if (!$docente) {
            abort(404, 'Docente no encontrado');
        }

        // =========================
        // EXAMEN ACTIVO
        // =========================
        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->value('id_examen_egel');

        // =========================
        // RESULTADO GENERAL
        // =========================
        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente', $docente->id_personal)
            ->where('id_examen_egel', $id_examen_egel)
            ->first();

        // =========================
        // POR MÓDULO
        // =========================
        $porModulo = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
            ->join('egel_modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
            ->where('rp.id_docente', $docente->id_personal)
            ->where('rp.id_examen_egel', $id_examen_egel)
            ->groupBy('m.id_modulo', 'm.nombre')
            ->selectRaw("
                m.nombre,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) / SUM(p.valor)) * 100,2) as porcentaje
            ")
            ->get();

        // =========================
        // POR SECCIÓN
        // =========================
        $porSeccion = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
            ->where('rp.id_docente', $docente->id_personal)
            ->where('rp.id_examen_egel', $id_examen_egel)
            ->groupBy('rp.id_seccion')
            ->selectRaw("
                rp.id_seccion,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) / SUM(p.valor)) * 100,2) as porcentaje
            ")
            ->get();
         }

        // =========================
        // PDF
        // =========================
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();

        // =========================
        // ENCABEZADO INSTITUCIONAL
        // =========================
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 6, utf8_decode('TECNOLOGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, utf8_decode('Reporte de Resultados'), 0, 1, 'C');

        $pdf->Ln(5);
        $pdf->Cell(0, 0, '', 'T', 1);
        $pdf->Ln(5);

       if ($nuevoUsuario) {

        // =========================
        // DATOS DOCENTE
        // =========================
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Docente:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($nuevoUsuario->nombre_docente), 0, 1);

        /*$pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Grado Academico:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($docente->escolaridad), 0, 1);*/

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Carrera:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($nuevoUsuario->carrera), 0, 1);

        $pdf->Ln(5);

        // =========================
        // RESULTADO GENERAL
        // =========================
        $pdf->SetFillColor(30, 55, 90);
        $pdf->SetTextColor(255);
        $pdf->SetFont('Arial', 'B', 13);

        $pdf->Cell(0, 8, 'RESULTADO GENERAL', 1, 1, 'C', true);

        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', 'B', 26);
        $pdf->Cell(0, 18, $resultado->calificacion_general . '%', 1, 1, 'C');

        $pdf->Ln(6);

        // =========================
        // TABLA MÓDULOS
        // =========================
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(70, 7, 'Modulo', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Puntos', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Total', 1, 0, 'C', true);
        $pdf->Cell(40, 7, '%', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);

        foreach ($porModulo as $m) {
            $pdf->Cell(70, 7, utf8_decode($m->nombre), 1,0,'C');
            $pdf->Cell(40, 7, number_format($m->puntos, 2), 1, 0, 'C');
            $pdf->Cell(40, 7, number_format($m->total_valor, 2), 1, 0, 'C');
            $pdf->Cell(40, 7, $m->porcentaje . '%', 1, 1, 'C');
        }

        $pdf->Ln(6);

        // =========================
        // PIE
        // =========================
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(0, 5, utf8_decode('Documento generado automáticamente'), 0, 1, 'C');
        $pdf->Cell(0, 5, utf8_decode('Fecha: ' . date('d/m/Y H:i')), 0, 1, 'C');

        $pdf->Output('I', 'Resultado_Examen_General.pdf');
        exit;

       }
       else {
         // =========================
        // DATOS DOCENTE
        // =========================
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Docente:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($docente->nombre), 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Grado Academico:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($docente->escolaridad), 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 7, 'Carrera:', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 7, utf8_decode($docente->carrera), 0, 1);

        $pdf->Ln(5);

        // =========================
        // RESULTADO GENERAL
        // =========================
        $pdf->SetFillColor(30, 55, 90);
        $pdf->SetTextColor(255);
        $pdf->SetFont('Arial', 'B', 13);

        $pdf->Cell(0, 8, 'RESULTADO GENERAL', 1, 1, 'C', true);

        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', 'B', 26);
        $pdf->Cell(0, 18, $resultado->calificacion_general . '%', 1, 1, 'C');

        $pdf->Ln(6);

        // =========================
        // TABLA MÓDULOS
        // =========================
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(70, 7, 'Modulo', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Puntos', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Total', 1, 0, 'C', true);
        $pdf->Cell(40, 7, '%', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);

        foreach ($porModulo as $m) {
            $pdf->Cell(70, 7, utf8_decode($m->nombre), 1,0,'C');
            $pdf->Cell(40, 7, number_format($m->puntos, 2), 1, 0, 'C');
            $pdf->Cell(40, 7, number_format($m->total_valor, 2), 1, 0, 'C');
            $pdf->Cell(40, 7, $m->porcentaje . '%', 1, 1, 'C');
        }

        $pdf->Ln(6);

        // =========================
        // PIE
        // =========================
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(0, 5, utf8_decode('Documento generado automáticamente'), 0, 1, 'C');
        $pdf->Cell(0, 5, utf8_decode('Fecha: ' . date('d/m/Y H:i')), 0, 1, 'C');

        $pdf->Output('I', 'Resultado_Examen_General.pdf');
        exit;
       }
    }

    public function exportarExcel()
{
    return Excel::download(
        new Examen_GnralReporteDocentesExport(),
        'Reporte_Docentes.xlsx'
    );
}
}