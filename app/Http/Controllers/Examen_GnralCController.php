<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Examen_GnralCController extends Controller
{
    // LISTAR
    public function index()
    {
        $examenes = DB::table('egel_examenes as e')
            ->join('gnral_carreras as c','c.id_carrera','=','e.id_carrera')
            ->select('e.*','c.nombre as carrera')
            ->get();

        return view('examen_gnral_con.admin.examenes.index', compact('examenes'));
    }

    // CREAR
    public function create()
    {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->where('id_carrera', '!=', 16)
            ->get();

        return view('examen_gnral_con.admin.examenes.create', compact('carreras'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        DB::table('egel_examenes')->insert([
            'id_carrera' => $request->id_carrera,
            'nombre' => $request->nombre,
            'id_periodo_examen' => $request->id_periodo_examen, // ✔ aquí
            'estado' => 1,
            'created_at' => now()
        ]);

        return redirect()->route('admin.examenes_generales.index')
            ->with('success','Examen creado correctamente');
    }

    // EDITAR
    public function edit($id_examen_egel)
    {
        $examen = DB::table('egel_examenes')
            ->where('id_examen_egel',$id_examen_egel)
            ->first();

         $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->where('id_carrera', '!=', 16)
            ->where('id_carrera', '!=', 17)
            ->get();


        return view('examen_gnral_con.admin.examenes.edit', compact('examen','carreras'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id_examen_egel)
    {
        DB::table('egel_examenes')
            ->where('id_examen_egel',$id_examen_egel)
            ->update([
                'id_carrera' => $request->id_carrera,
                'nombre' => $request->nombre,
                'id_periodo_examen' => $request->id_periodo_examen // ✔ aquí
            ]);

        return redirect()->route('admin.examenes_generales.index')
            ->with('success','Examen actualizado');
    }

    // ELIMINAR
    public function destroy($id_examen_egel)
    {
        DB::table('egel_examenes')
        ->where('id_examen_egel',$id_examen_egel)
        ->delete();

        return back()->with('success','Examen eliminado');
    }

    // FORM RAPIDO (SIN TOCAR PERIODO ❌)
    public function formRapido($id_examen_egel)
    {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->where('id_carrera', '!=', 16)
            ->where('id_carrera', '!=', 17)
            ->get();

        $examen = DB::table('egel_examenes as e')
            ->join('gnral_carreras as c','c.id_carrera','=','e.id_carrera')
            ->where('e.id_examen_egel', $id_examen_egel)
            ->select('e.*','c.nombre as carrera')
            ->first();

        return view('examen_gnral_con.admin.examenes.rapido', compact('carreras','examen'));
    }

   public function guardarRapido(Request $request)
{
    DB::beginTransaction();

    try {

        $id_examen_egel = $request->id_examen_egel;

        if (!$id_examen_egel) {
            return back()->with('error', 'Falta el examen');
        }

        // SECCIÓN
        $id_seccion = DB::table('egel_secciones')
            ->where('id_examen_egel', $id_examen_egel)
            ->where('nombre', $request->seccion)
            ->value('id_seccion');

        if (!$id_seccion) {
            $id_seccion = DB::table('egel_secciones')->insertGetId([
                'nombre' => $request->seccion,
                'id_examen_egel' => $id_examen_egel
            ]);
        }

        // MÓDULO
        $id_modulo = DB::table('egel_modulos')
            ->where('id_examen_egel', $id_examen_egel)
            ->where('id_seccion', $id_seccion)
            ->where('nombre', $request->modulo)
            ->value('id_modulo');

        if (!$id_modulo) {
            $id_modulo = DB::table('egel_modulos')->insertGetId([
                'nombre' => $request->modulo,
                'id_seccion' => $id_seccion,
                'id_examen_egel' => $id_examen_egel
            ]);
        }

        if (!$id_modulo || !$id_seccion) {
            return back()->with('error', 'Error en módulo o sección');
        }

        $bloques = array_filter(
            preg_split("/\r\n\r\n|\n\n|\r\r/", $request->contenido)
        );

        $numero = 1;

        foreach ($bloques as $bloque) {

            $lineas = explode("\n", trim($bloque));
            if (count($lineas) < 2) continue;

            $preguntaTexto = array_shift($lineas);

            $id_pregunta = DB::table('egel_preguntas')->insertGetId([
                'pregunta' => $preguntaTexto,
                'id_modulo' => $id_modulo,
                'id_seccion' => $id_seccion,
                'id_examen_egel' => $id_examen_egel,
                'numero_pregunta' => $numero++,
                'valor' => 2.0
            ]);

            foreach ($lineas as $i => $linea) {
                DB::table('egel_respuestas')->insert([
                    'id_pregunta' => $id_pregunta,
                    'respuesta' => trim(str_replace('*', '', $linea)),
                    'es_correcta' => str_contains($linea, '*') ? 1 : 0,
                    'id_examen_egel' => $id_examen_egel,
                    'orden' => $i + 1
                ]);
            }
        }

        DB::commit();

        return redirect()->route('admin.examenes_generales.index')
            ->with('success', 'Preguntas guardadas correctamente.');

    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage());
    }
}

    // PREGUNTAS
    public function preguntas($id_examen_egel)
    {
        $examen = DB::table('egel_examenes as e')   
            ->join('gnral_carreras as c','c.id_carrera','=','e.id_carrera')
            ->where('e.id_examen_egel', $id_examen_egel)
            ->select('e.*','c.nombre as carrera')
            ->first();

        $secciones = DB::table('egel_secciones')
            ->where('id_examen_egel', $id_examen_egel)
            ->get();

        $modulos = DB::table('egel_modulos')
            ->where('id_examen_egel', $id_examen_egel)
            ->get();

        $preguntas = DB::table('egel_preguntas')
            ->where('id_examen_egel', $id_examen_egel)
            ->orderBy('numero_pregunta')
            ->get();

        foreach ($preguntas as $p) {
            $p->respuestas = DB::table('egel_respuestas')
                ->where('id_pregunta', $p->id_pregunta)
                ->get();
        }

        return view('examen_gnral_con.admin.examenes.preguntas', compact('examen','secciones','modulos','preguntas'));
    }

     public function editPregunta($id_pregunta)
{
    $pregunta = DB::table('egel_preguntas')->where('id_pregunta', $id_pregunta)->first();
    $modulos = DB::table('egel_modulos')->get(); // Para seleccionar el módulo al editar

    return view('examen_gnral_con.admin.examenes.edit_pregunta', compact('pregunta', 'modulos'));
}

public function updatePregunta(Request $request, $id_pregunta)
{
    DB::table('egel_preguntas')
        ->where('id_pregunta', $id_pregunta)
        ->update([
            'pregunta' => $request->pregunta,
            'id_modulo' => $request->id_modulo,
            'numero_pregunta' => $request->numero_pregunta
        ]);

    // Ahora sí existe id_examen_egel en el request
    return redirect()->route('admin.examen_general.preguntas', $request->id_examen_egel)
        ->with('success', 'Pregunta actualizada correctamente');
}

public function deletePregunta($id_pregunta)
{
    DB::table('egel_preguntas')->where('id_pregunta', $id_pregunta)->delete();
    return back()->with('success', 'Pregunta eliminada');
}

// Mostrar formulario para editar respuesta
public function editRespuesta($id_respuesta)
{
    // Obtenemos la respuesta y datos de la pregunta
    $respuesta = DB::table('egel_respuestas as r')
        ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'r.id_pregunta')
        ->select('r.*', 'p.numero_pregunta', 'p.id_examen_egel')
        ->where('r.id_respuesta', $id_respuesta)
        ->first();

    return view('examen_gnral_con.admin.examenes.edit_respuesta', compact('respuesta'));
}

// Actualizar respuesta
public function updateRespuesta(Request $request, $id_respuesta)
{
    DB::table('egel_respuestas')
        ->where('id_respuesta', $id_respuesta)
        ->update([
            'respuesta' => $request->respuesta,
            'es_correcta' => $request->es_correcta
        ]);

    return redirect()->route('admin.examen_general.preguntas', $request->id_examen_egel)
        ->with('success', 'Respuesta actualizada correctamente');
}

// Eliminar respuesta
public function deleteRespuesta($id_respuesta, $id_examen_egel)
{
    DB::table('egel_respuestas')->where('id_respuesta', $id_respuesta)->delete();

    return redirect()->route('admin.examen_general.preguntas', $id_examen_egel)
        ->with('success', 'Respuesta eliminada correctamente');
}


}