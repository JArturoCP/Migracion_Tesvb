<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers\PeriodoEGELController;

class EgelSeccionUnoController extends Controller
{
    // Vista de instrucciones
    public function index($id_seccion)
    {
        // 🔒 VALIDAR PERIODO
        if (!PeriodoEGELController::enAplicacion()) {
            return redirect()->route('dashboard')
                ->with('error', 'El examen no está disponible fuera del periodo de aplicación.');
        }

        return view('examen_egel.seccion1.index', compact('id_seccion'));
    }

    // Mostrar preguntas
    public function pregunta(Request $request, $id_seccion)
    {
        // 🔒 VALIDAR PERIODO
        if (!PeriodoEGELController::enAplicacion()) {
            return redirect()->route('dashboard')
                ->with('error', 'El examen no está disponible.');
        }

        $alumno = DB::table('gnral_alumnos')
            ->where('id_usuario', Auth::id())
            ->first();

            //dd($alumno);

        if (!$alumno) abort(403);

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $alumno->id_carrera)
            ->value('id_examen_egel');

        $paginaActual = $request->input('page', 1);

        $modulos = DB::table('egel_modulos')
            ->where('id_seccion', $id_seccion)
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get();

            //dd($id_examen_egel,$modulos);

        $moduloActual = $modulos->get($paginaActual - 1);

        if (!$moduloActual) {
            return redirect()->route('egel.seccion.finalizada', $id_seccion);
        }

       DB::table('egel_preguntas')
    ->where('id_modulo', $moduloActual->id_modulo)
    ->where('activo', 1)
    ->where('id_examen_egel', $id_examen_egel)
    ->update([
        'valor' => 0.99
    ]);

$preguntas = DB::table('egel_preguntas')
    ->where('id_modulo', $moduloActual->id_modulo)
    ->where('activo', 1)
    ->where('id_examen_egel', $id_examen_egel)
    ->orderBy('numero_pregunta')
    ->get();

        $respuestas = DB::table('egel_respuestas')
            ->whereIn('id_pregunta', $preguntas->pluck('id_pregunta'))
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('orden')
            ->get()
            ->groupBy('id_pregunta');

        return view('examen_egel.seccion1.pregunta', compact(
            'preguntas',
            'respuestas',
            'moduloActual',
            'paginaActual',
            'id_seccion'
        ));
    }

    public function responder(Request $request)
{
    // 🔒 VALIDAR PERIODO
    if (!PeriodoEGELController::enAplicacion()) {
        return redirect()->route('dashboard')
            ->with('error', 'No puedes responder fuera del periodo.');
    }

    $userId = Auth::id();

    $alumno = DB::table('gnral_alumnos')
        ->where('id_usuario', $userId)
        ->first();

    if (!$alumno) {
        abort(403);
    }

    $idAlumno = $alumno->id_alumno;
    $id_seccion = $request->id_seccion;

    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->where('id_carrera', $alumno->id_carrera)
        ->value('id_examen_egel');

    // 🔥 GUARDAR / ACTUALIZAR RESPUESTAS
    foreach ($request->respuestas as $id_pregunta => $id_respuesta) {

        $respuesta = DB::table('egel_respuestas')
            ->where('id_respuesta', $id_respuesta)
            ->first();

        if (!$respuesta) {
            continue;
        }

        DB::table('egel_respuestas_alumno')->updateOrInsert(
            [
                'id_alumno' => $idAlumno,
                'id_pregunta' => $id_pregunta,
                'id_examen_egel' => $id_examen_egel
            ],
            [
                'id_seccion' => $id_seccion,
                'id_respuesta' => $id_respuesta,
                'es_correcta' => $respuesta->es_correcta,
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

        DB::table('egel_secciones_estado')->updateOrInsert(
            [
                'id_alumno' => $idAlumno,
                'id_seccion' => $id_seccion,
                'id_examen_egel' => $id_examen_egel
            ],
            [
                'completada' => 1,
                'fecha_fin' => now(),
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return redirect()->route('egel.seccion.finalizada', $id_seccion);
    }

    $moduloActual = $modulos->get($paginaActual - 1);

    return view('examen_egel.seccion1.transicion', compact(
        'moduloActual',
        'nextPage',
        'id_seccion'
    ));
}

    public function finalizada($id_seccion)
    {
        return view('examen_egel.seccion1.finalizada', compact('id_seccion'));
    }
}