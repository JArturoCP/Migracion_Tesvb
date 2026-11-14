<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Controllers\Examen_GnralC_PeriodoController;

class Examen_GnralC_FormController extends Controller
{
    // Vista de instrucciones
    public function index($id_seccion)
    {
        //dd($id_seccion);
        // 🔒 VALIDAR PERIODO
        if (!Examen_GnralC_PeriodoController::enAplicacion()) {
            return redirect()->route('examen_conocimientos')
                ->with('error', 'El examen no está disponible fuera del periodo de aplicación.');
        }

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
        return view('examen_gnral_con.seccion1.index', compact('id_seccion'));
        }
        else{
        $id_docente = Session::get('id_perso');

        $carreras = DB::table('gnral_personales as p')
            ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
            ->where('p.id_personal', $id_docente)
            ->whereNotIn('c.id_carrera', [9, 11, 15, 16, 17])
            ->distinct()
            ->select('c.id_carrera', 'c.nombre as carrera')
            ->get();

//dd($carreras);

        return view('examen_gnral_con.seccion1.index', compact('id_seccion','carreras'));
        }
     
    }

    // Mostrar preguntas
    public function pregunta(Request $request, $id_seccion)
    {
        // 🔒 VALIDAR PERIODO
        if (!Examen_GnralC_PeriodoController::enAplicacion()) {
            return redirect()->route('examen_conocimientos')
                ->with('error', 'El examen no está disponible.');
        }

         $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->pluck('id_carrera');
           

        $usuario = auth()->user();

        $nuevoDocente = DB::table('egel_nuevos_docentes')
            ->where('correo', $usuario->email)
            ->whereIn('id_carrera', $carreras)
            ->first();
//dd($nuevoDocente);
        if ($nuevoDocente) {
    // Es aspirante
    $esAspirante = true;

     /*$id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->value('id_examen_egel');*/

            $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $nuevoDocente->id_carrera)
            ->value('id_examen_egel');
           //dd($id_examen_egel);

        $paginaActual = $request->input('page', 1);

        //  dd($id_seccion);

        $modulos = DB::table('egel_modulos')
            ->where('id_seccion', $id_seccion)
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get();

            //dd($id_examen_egel,$modulos);
            //dd($modulos);

        $moduloActual = $modulos->get($paginaActual - 1);

        if (!$moduloActual) {
            return redirect()->route('examen_general.seccion.finalizada', $id_seccion);
        }

       DB::table('egel_preguntas')
    ->where('id_modulo', $moduloActual->id_modulo)
    ->where('activo', 1)
    ->where('id_examen_egel', $id_examen_egel)
    ->update([
        'valor' => 2.0
    ]);

        $sessionKey = "preguntas_modulo_{$id_seccion}_{$moduloActual->id_modulo}";

        if (!session()->has($sessionKey)) {

            $preguntas = DB::table('egel_preguntas')
                ->where('id_modulo', $moduloActual->id_modulo)
                ->where('activo', 1)
                ->where('id_examen_egel', $id_examen_egel)
                ->inRandomOrder()
                ->limit(5)
                ->get();

            session([$sessionKey => $preguntas->pluck('id_pregunta')]);
        }

        $ids = session($sessionKey);

    $preguntas = DB::table('egel_preguntas')
        ->whereIn('id_pregunta', $ids)
        ->get();

        $respuestas = DB::table('egel_respuestas')
            ->whereIn('id_pregunta', $preguntas->pluck('id_pregunta'))
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get()
            ->groupBy('id_pregunta');

        return view('examen_gnral_con.seccion1.pregunta', compact(
            'preguntas',
            'respuestas',
            'moduloActual',
            'paginaActual',
            'id_seccion'
        ));
        
        }
        else{
              $id_docente = Session::get('id_perso');
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

        if (!$docente) abort(403);

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->value('id_examen_egel');
//dd($id_examen_egel);
        $paginaActual = $request->input('page', 1);

        $modulos = DB::table('egel_modulos')
            ->where('id_seccion', $id_seccion)
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get();

            //dd($id_examen_egel,$modulos);

        $moduloActual = $modulos->get($paginaActual - 1);

        if (!$moduloActual) {
            return redirect()->route('examen_general.seccion.finalizada', $id_seccion);
        }

       DB::table('egel_preguntas')
    ->where('id_modulo', $moduloActual->id_modulo)
    ->where('activo', 1)
    ->where('id_examen_egel', $id_examen_egel)
    ->update([
        'valor' => 2.0
    ]);

        $sessionKey = "preguntas_modulo_{$id_seccion}_{$moduloActual->id_modulo}";

        if (!session()->has($sessionKey)) {

            $preguntas = DB::table('egel_preguntas')
                ->where('id_modulo', $moduloActual->id_modulo)
                ->where('activo', 1)
                ->where('id_examen_egel', $id_examen_egel)
                ->inRandomOrder()
                ->limit(50)
                ->get();

            session([$sessionKey => $preguntas->pluck('id_pregunta')]);
        }

        $ids = session($sessionKey);

    $preguntas = DB::table('egel_preguntas')
        ->whereIn('id_pregunta', $ids)
        ->get();

        $respuestas = DB::table('egel_respuestas')
            ->whereIn('id_pregunta', $preguntas->pluck('id_pregunta'))
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get()
            ->groupBy('id_pregunta');

        return view('examen_gnral_con.seccion1.pregunta', compact(
            'preguntas',
            'respuestas',
            'moduloActual',
            'paginaActual',
            'id_seccion'
        ));
        }
    }

    public function responder(Request $request)
{
     // 🔒 VALIDAR PERIODO
        if (!Examen_GnralC_PeriodoController::enAplicacion()) {
            return redirect()->route('examen_conocimientos')
                ->with('error', 'El examen no está disponible.');
        }

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


    $id_docente = $nuevoDocente->id_egel_nuevo_docente;
    $id_seccion = $request->id_seccion;

      $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $nuevoDocente->id_carrera)
            ->value('id_examen_egel');

    // 🔥 GUARDAR / ACTUALIZAR RESPUESTAS
    foreach ($request->respuestas as $id_pregunta => $id_respuesta) {

        $respuesta = DB::table('egel_respuestas')
            ->where('id_respuesta', $id_respuesta)
            ->first();

        if (!$respuesta) {
            continue;
        }

        DB::table('egel_respuestas_docente')->updateOrInsert(
            [
                'id_docente' => $id_docente,
                'id_pregunta' => $id_pregunta,
                'id_examen_egel' => $id_examen_egel,
            ],
            [
                'id_seccion' => $id_seccion,
                'id_respuesta' => $id_respuesta,
                'es_correcta' => $respuesta->es_correcta,
                'id_examen_egel' => $id_examen_egel,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );
    }

    // 📄 PAGINACIÓN
    $paginaActual = $request->input('page', 1);
    $nextPage = $paginaActual + 1;

    $modulos = DB::table('egel_modulos')
        ->where('id_seccion', $id_seccion)
        ->where('id_examen_egel', $id_examen_egel)
        ->orderBy('orden')
        ->get();

    // 🏁 FIN DEL EXAMEN
    if ($nextPage > $modulos->count()) {

        DB::table('egel_secciones_estado_docentes')->updateOrInsert(
            [
                'id_docente' => $id_docente,
                'id_seccion' => $id_seccion,
                'id_examen_egel' => $id_examen_egel
            ],
            [
                'completada' => 1,
                'fecha_fin' => now(),
                'updated_at' => now(),
                'created_at' => now(),
                'id_examen_egel' => $id_examen_egel
            ]
        );

         // Generar resultado
    app(\App\Http\Controllers\Examen_GnralC_ResultadosController::class)
        ->generarResultado($id_docente);

        return redirect()->route('examen_general.seccion.finalizada', $id_seccion);
    }

    $moduloActual = $modulos->get($paginaActual - 1);

    return view('examen_gnral_con.seccion1.transicion', compact(
        'moduloActual',
        'nextPage',
        'id_seccion'
    ));

        } 
        else{
            $id_docente = Session::get('id_perso');
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
        abort(403);
    }

    $id_docente = $docente->id_personal;
    $id_seccion = $request->id_seccion;

    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->value('id_examen_egel');

    // 🔥 GUARDAR / ACTUALIZAR RESPUESTAS
    foreach ($request->respuestas as $id_pregunta => $id_respuesta) {

        $respuesta = DB::table('egel_respuestas')
            ->where('id_respuesta', $id_respuesta)
            ->first();

        if (!$respuesta) {
            continue;
        }

        DB::table('egel_respuestas_docente')->updateOrInsert(
            [
                'id_docente' => $id_docente,
                'id_pregunta' => $id_pregunta,
                'id_examen_egel' => $id_examen_egel,
            ],
            [
                'id_seccion' => $id_seccion,
                'id_respuesta' => $id_respuesta,
                'es_correcta' => $respuesta->es_correcta,
                'id_examen_egel' => $id_examen_egel,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );
    }

    // 📄 PAGINACIÓN
    $paginaActual = $request->input('page', 1);
    $nextPage = $paginaActual + 1;

    $modulos = DB::table('egel_modulos')
        ->where('id_seccion', $id_seccion)
        ->where('id_examen_egel', $id_examen_egel)
        ->orderBy('orden')
        ->get();

    // 🏁 FIN DEL EXAMEN
    if ($nextPage > $modulos->count()) {

        DB::table('egel_secciones_estado_docentes')->updateOrInsert(
            [
                'id_docente' => $id_docente,
                'id_seccion' => $id_seccion,
                'id_examen_egel' => $id_examen_egel
            ],
            [
                'completada' => 1,
                'fecha_fin' => now(),
                'updated_at' => now(),
                'created_at' => now(),
                'id_examen_egel' => $id_examen_egel
            ]
        );

         // Generar resultado
    app(\App\Http\Controllers\Examen_GnralC_ResultadosController::class)
        ->generarResultado($id_docente);

        return redirect()->route('examen_general.seccion.finalizada', $id_seccion);
    }

    $moduloActual = $modulos->get($paginaActual - 1);

    return view('examen_gnral_con.seccion1.transicion', compact(
        'moduloActual',
        'nextPage',
        'id_seccion'
    ));
        }
}

    public function finalizada($id_seccion)
    {
        return view('examen_gnral_con.seccion1.finalizada', compact('id_seccion'));
    }
}