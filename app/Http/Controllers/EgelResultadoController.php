<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EgelResultadoController extends Controller
{
public function generarResultado($id_alumno)
{
    // =========================
    // OBTENER ALUMNO
    // =========================
    $alumno = DB::table('gnral_alumnos')
        ->where('id_alumno', $id_alumno)
        ->first();

    if (!$alumno) {
        \Log::warning("EGEL: Alumno no encontrado", ['id_alumno' => $id_alumno]);
        return false;
    }

    // =========================
    // OBTENER EXAMEN
    // =========================
    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->where('id_carrera', $alumno->id_carrera)
        ->value('id_examen_egel');

    if (!$id_examen_egel) {
        \Log::warning("EGEL: Examen no encontrado", ['id_carrera' => $alumno->id_carrera]);
        return false;
    }

    // =========================
    // TOTAL POSIBLE
    // =========================
    $total = DB::table('egel_preguntas')
        ->where('id_examen_egel', $id_examen_egel)
        ->sum('valor');
//dd($total);
    if ($total == 0) {
        \Log::warning("EGEL: Total de examen es 0", ['id_examen_egel' => $id_examen_egel]);
        return false;
    }

    // =========================
    // PUNTAJE OBTENIDO
    // =========================
    $obtenido = DB::table('egel_respuestas_alumno as ra')
        ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'ra.id_pregunta')
        ->where('ra.id_alumno', $id_alumno)
        ->where('ra.id_examen_egel', $id_examen_egel)
        ->where('ra.es_correcta', 1)
        ->sum('p.valor');
//dd($obtenido);
    // Si no hay respuestas
    if ($obtenido === null) {
        \Log::warning("EGEL: Alumno sin respuestas", [
            'id_alumno' => $id_alumno,
            'id_examen_egel' => $id_examen_egel
        ]);
        return false;
    }

    // =========================
    // CALIFICACIÓN
    // =========================
    $calificacion = round(($obtenido / $total) * 100, 2);

    // =========================
    // NIVEL
    // =========================
    if ($calificacion >= 80) {
        $nivel = 'Sobresaliente';
    } elseif ($calificacion >= 60) {
        $nivel = 'Satisfactorio';
    } else {
        $nivel = 'No satisfactorio';
    }

    // =========================
    // GUARDAR RESULTADO
    // =========================
    DB::table('egel_resultados')->updateOrInsert(
        [
            'id_alumno' => $id_alumno,
            'id_examen_egel' => $id_examen_egel
        ],
        [
            'calificacion_general' => $calificacion,
            'nivel' => $nivel,
            'updated_at' => now(),
            'created_at' => now()
        ]
    );

    \Log::info("EGEL: Resultado generado correctamente", [
        'id_alumno' => $id_alumno,
        'calificacion' => $calificacion,
        'nivel' => $nivel
    ]);

    return true;
}   

    public function dashboard()
    {
        $alumno = DB::table('gnral_alumnos')
            ->where('id_usuario', auth()->id())
            ->first();

        if(!$alumno){
            abort(403,'Alumno no encontrado');
        }

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $alumno->id_carrera)
            ->value('id_examen_egel');

        if(!$id_examen_egel){
            abort(403,'Examen no encontrado');
        }

        $this->generarResultado($alumno->id_alumno);

        // =========================
        // RESULTADO GENERAL
        // =========================
        $resultado = DB::table('egel_resultados')
            ->where('id_alumno',$alumno->id_alumno)
            ->where('id_examen_egel',$id_examen_egel)
            ->first();

        // =========================
        // POR MÓDULO
        // =========================
        $porModulo = DB::table('egel_respuestas_alumno as ra')
        ->join('egel_preguntas as p','p.id_pregunta','=','ra.id_pregunta')
        ->join('egel_modulos as m','m.id_modulo','=','p.id_modulo')
        ->where('ra.id_alumno',$alumno->id_alumno)
        ->where('ra.id_examen_egel',$id_examen_egel)
        ->groupBy('m.id_modulo','m.nombre')
        ->selectRaw('
            m.nombre,
            COUNT(*) as total,
            SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
            SUM(p.valor) as total_valor,
            ROUND(
                (
                    SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END)
                    / NULLIF(SUM(p.valor),0)
                ) * 100,
            2) as porcentaje
        ')
        ->get();
    //dd($porModulo);

        // =========================
        // POR SECCIÓN
        // =========================
        $porSeccion = DB::table('egel_respuestas_alumno as ra')
        ->join('egel_preguntas as p','p.id_pregunta','=','ra.id_pregunta')
        ->where('ra.id_alumno',$alumno->id_alumno)
        ->where('ra.id_examen_egel',$id_examen_egel)
        ->groupBy('ra.id_seccion')
        ->selectRaw('
            ra.id_seccion,
            COUNT(*) as total,
            SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
            SUM(p.valor) as total_valor,
            ROUND(
                (
                    SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END)
                    / NULLIF(SUM(p.valor),0)
                ) * 100,
            2) as porcentaje
        ')
        ->get();
        return view('examen_egel.dashboard-resultados', compact(
            'resultado',
            'porModulo',
            'porSeccion'
        ));
    }

    public function reporte()
    {
        $alumno = DB::table('gnral_alumnos')
            ->where('id_usuario', auth()->id())
            ->first();

        if(!$alumno){
            abort(403,'Alumno no encontrado');
        }

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $alumno->id_carrera)
            ->value('id_examen_egel');

        if(!$id_examen_egel){
            abort(403,'Examen no encontrado');
        }

        $resultado = DB::table('egel_resultados')
            ->where('id_alumno',$alumno->id_alumno)
            ->where('id_examen_egel',$id_examen_egel)
            ->first();

        $porModulo = DB::table('egel_respuestas_alumno as ra')
        ->join('egel_preguntas as p','p.id_pregunta','=','ra.id_pregunta')
        ->join('egel_modulos as m','m.id_modulo','=','p.id_modulo')
        ->where('ra.id_alumno',$alumno->id_alumno)
        ->where('ra.id_examen_egel',$id_examen_egel)
        ->groupBy('m.id_modulo','m.nombre')
        ->selectRaw('
            m.nombre,
            COUNT(*) as total,
            SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
            SUM(p.valor) as total_valor,
            ROUND(
                (
                    SUM(CASE WHEN ra.es_correcta = 1 THEN p.valor ELSE 0 END)
                    / NULLIF(SUM(p.valor),0)
                ) * 100,
            2) as porcentaje
        ')
        ->get();

        return view('examen_egel.reporte_resultados', compact('resultado','porModulo','alumno'));
    }
}