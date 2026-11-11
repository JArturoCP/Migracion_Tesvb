<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Examen_GnralC_ResultadosController extends Controller
{
public function generarResultado($id_docente)
{
    $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->pluck('id_carrera');
           

        $usuario = auth()->user();

        $nuevoDocente = DB::table('egel_nuevos_docentes')
            ->where('correo', $usuario->email)
            ->whereIn('id_carrera', $carreras)
            ->first();

        if ($nuevoDocente) {// Es aspirante
    $esAspirante = true;

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $nuevoDocente->id_carrera)
            ->value('id_examen_egel');

    if (!$id_examen_egel) {
        return false;
    }

    $total = DB::table('egel_respuestas_docente as rp')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
    ->where('rp.id_docente', $nuevoDocente->id_egel_nuevo_docente)
    ->where('rp.id_examen_egel', $id_examen_egel)
    ->sum('p.valor');
    //dd($total);
    if ($total == 0) {
        return false;
    }

   $obtenido = DB::table('egel_respuestas_docente as rp')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
    ->where('rp.id_docente', $nuevoDocente->id_egel_nuevo_docente)
    ->where('rp.id_examen_egel', $id_examen_egel)
    ->where('rp.es_correcta', 1)
    ->sum('p.valor');

    $calificacion = round(($obtenido / $total) * 100, 2);

    if ($calificacion >= 80) {
        $nivel = 'Sobresaliente';
    } elseif ($calificacion >= 60) {
        $nivel = 'Satisfactorio';
    } else {
        $nivel = 'No satisfactorio';
    }

    DB::table('egel_resultados_docentes')->updateOrInsert(
        [
            'id_docente' => $nuevoDocente->id_egel_nuevo_docente,
            'id_examen_egel' => $id_examen_egel
        ],
        [
            'calificacion_general' => $calificacion,
            'nivel' => $nivel,
            'updated_at' => now(),
            'created_at' => now()
        ]
    );

    return true;


        } 

    else{
        $docente = DB::table('gnral_personales as p')
        ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
        ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
        ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
        ->where('p.id_personal', $id_docente)
        ->where('p.estado_docente_inv', 1)
        ->select(
            'p.*',
            'c.id_carrera',
            'c.nombre as carrera'
        )
        ->first();

    if (!$docente) {
        return false;
    }

    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->value('id_examen_egel');

    if (!$id_examen_egel) {
        return false;
    }

    $total = DB::table('egel_respuestas_docente as rp')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
    ->where('rp.id_docente', $docente->id_personal)
    ->where('rp.id_examen_egel', $id_examen_egel)
    ->sum('p.valor');
    //dd($total);
    if ($total == 0) {
        return false;
    }

   $obtenido = DB::table('egel_respuestas_docente as rp')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'rp.id_pregunta')
    ->where('rp.id_docente', $docente->id_personal)
    ->where('rp.id_examen_egel', $id_examen_egel)
    ->where('rp.es_correcta', 1)
    ->sum('p.valor');

    $calificacion = round(($obtenido / $total) * 100, 2);

    if ($calificacion >= 80) {
        $nivel = 'Sobresaliente';
    } elseif ($calificacion >= 60) {
        $nivel = 'Satisfactorio';
    } else {
        $nivel = 'No satisfactorio';
    }

    DB::table('egel_resultados_docentes')->updateOrInsert(
        [
            'id_docente' => $docente->id_personal,
            'id_examen_egel' => $id_examen_egel
        ],
        [
            'calificacion_general' => $calificacion,
            'nivel' => $nivel,
            'updated_at' => now(),
            'created_at' => now()
        ]
    );

    return true;
    }
}

    public function dashboard()
    {
        $id_docente = Session::get('id_perso');
        //dd($id_docente);
        $docente = DB::table('gnral_personales as p')
        ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
        ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
        ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
        ->where('p.id_personal', $id_docente)
        ->where('p.estado_docente_inv', 1)
        ->select(
            'p.*',
            'c.id_carrera',
            'c.nombre as carrera'
        )
        ->first();
//dd($docente);
        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->value('id_examen_egel');

        if(!$id_examen_egel){
            abort(403,'Examen no encontrado');
        }

       // $this->generarResultado($docente->id_personal);
        //$ok = $this->generarResultado($docente->id_personal);
        //dd($ok);
        // =========================
        // RESULTADO GENERAL
        // =========================
        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente',$docente->id_personal)
            ->where('id_examen_egel',$id_examen_egel)
            ->first();

        // =========================
        // POR MÓDULO
        // =========================
        $porModulo = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p','p.id_pregunta','=','rp.id_pregunta')
            ->join('egel_modulos as m','m.id_modulo','=','p.id_modulo')
            ->where('rp.id_docente',$docente->id_personal)
            ->where('rp.id_examen_egel',$id_examen_egel)
            ->groupBy('m.id_modulo','m.nombre')
            ->selectRaw('
                m.nombre,
                COUNT(*) as total,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END)/SUM(p.valor))*100,2) as porcentaje
            ')
            ->get();

        // =========================
        // POR SECCIÓN
        // =========================
        $porSeccion = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p','p.id_pregunta','=','rp.id_pregunta')
            ->where('rp.id_docente',$docente->id_personal)
            ->where('rp.id_examen_egel',$id_examen_egel)
            ->groupBy('rp.id_seccion')
            ->selectRaw('
                rp.id_seccion,
                COUNT(*) as total,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END)/SUM(p.valor))*100,2) as porcentaje
            ')
            ->get();

        return view('examen_gnral_con.dashboard-resultados', compact(
            'resultado',
            'porModulo',
            'porSeccion'
        ));
    }

    public function reporte()
    {
        $id_docente = Session::get('id_perso');
        //dd($id_docente);
        $docente = DB::table('gnral_personales as p')
        ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
        ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
        ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
        ->where('p.id_personal', $id_docente)
        ->where('p.estado_docente_inv', 1)
        ->select('p.*','c.id_carrera','c.nombre as carrera')
        ->first();

         $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->value('id_examen_egel');

        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente',$docente->id_personal)
            ->where('id_examen_egel',$id_examen_egel)
            ->first();

        $porModulo = DB::table('egel_respuestas_docente as rp')
            ->join('egel_preguntas as p','p.id_pregunta','=','rp.id_pregunta')
            ->join('egel_modulos as m','m.id_modulo','=','p.id_modulo')
            ->where('rp.id_docente',$docente->id_personal)
            ->where('rp.id_examen_egel',$id_examen_egel)
            ->groupBy('m.id_modulo','m.nombre')
            ->selectRaw('
                m.nombre,
                COUNT(*) as total,
                SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END) as puntos,
                SUM(p.valor) as total_valor,
                ROUND((SUM(CASE WHEN rp.es_correcta = 1 THEN p.valor ELSE 0 END)/SUM(p.valor))*100,2) as porcentaje
            ')
            ->get();

        return view('examen_general_con.reporte_resultados', compact('resultado','porModulo','alumno'));
    }
}