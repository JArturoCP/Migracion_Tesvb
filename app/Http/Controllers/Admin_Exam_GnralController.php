<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Admin_Exam_GnralController extends Controller
{
    public function index() {

       $docentes = DB::table('gnral_personales')
    ->select('id_personal', 'nombre', 'escolaridad')
    ->where(function ($query) {
        $query->where('estado_docente_inv', 0)
              ->orWhereNull('estado_docente_inv');
    })
    ->get();

$plantilla_docentes = DB::table('gnral_personales')
    ->select('id_personal', 'nombre', 'escolaridad')
    ->where('estado_docente_inv', 1)
    ->get();

         return view('examen_gnral_con.admin.resultados',compact('docentes','plantilla_docentes'));
    }

   public function guardar_docente_investigacion(Request $request)
{
    $this->validate($request, [
        'docente' => 'required'
    ]);

    $id_docente = $request->docente;

    // Verificar que el docente exista
    $estado_docente = DB::table('gnral_personales')
        ->where('id_personal', $id_docente)
        ->first();

    if ($estado_docente) {

        DB::table('gnral_personales')
            ->where('id_personal', $id_docente)
            ->update([
                'estado_docente_inv' => 1
            ]);

        return redirect()->back()->with('success', 'Docente agregado correctamente.');
    }

    return redirect()->back()->with('error', 'El docente no existe.');
}

public function eliminar_docente_investigacion(Request $request)
{
    $request->validate([
        'docente' => 'required|integer'
    ]);

    DB::table('gnral_personales')
        ->where('id_personal', $request->docente)
        ->update([
            'estado_docente_inv' => 0
        ]);

    return redirect()->back()->with('success', 'Docente eliminado de la plantilla.');
}

   public function ver_resultados_docentes()
{
    // Docentes del sistema anterior
    $docentesAnteriores = DB::table('gnral_personales')
        ->select(
            'id_personal',
            'nombre',
            'escolaridad'
        )
        ->where('estado_docente_inv', 1)
        ->get()
        ->map(function ($docente) {
            $docente->es_nuevo = false;
            return $docente;
        });

    // Nuevos docentes
    $docentesNuevos = DB::table('egel_nuevos_docentes')
        ->select(
            'id_egel_nuevo_docente',
            'nombre_docente'
        )
        ->get()
        ->map(function ($docente) {
            return (object)[
                'id_personal' => $docente->id_egel_nuevo_docente,
                'nombre'      => $docente->nombre_docente,
                'escolaridad' => 'N/D',
                'es_nuevo'    => true
            ];
        });

    // Unir ambas colecciones
    $docentes = $docentesAnteriores->concat($docentesNuevos);

    return view('examen_gnral_con.admin.docentes_resultados', compact('docentes'));
}

public function guardar_docentes_nuevos(Request $request)
{
    
    $nombre = trim($request->input('nombre_docente'));
    $correo = trim($request->input('correo'));
    $password = trim($request->input('password'));
    $id_carrera = $request->input('id_carrera');


    if ($nombre == '' || $correo == '' || $password == '') {
        return back();
    }


    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return back();
    }


    $existe = DB::table('egel_nuevos_docentes')
        ->where('correo', $correo)
        ->first();


    if ($existe) {
        return back();
    }


    DB::table('egel_nuevos_docentes')->insert([
        'nombre_docente' => $nombre,
        'correo' => $correo,
        // recomendable cifrar la contraseña
       'password' => $password,
        'id_carrera' => $id_carrera
    ]);

    // Guarda datos para login
    DB::table('users')->insert([
        'name' => $nombre,
        'email' => $correo,
        'password' => bcrypt($password),
        'tipo_usuario' => 2,
        'created_at' => now(),
        'updated_at' => now()
    ]);


    return redirect('/admin/examen_general/resultados');
}
public function vista_docentes_nuevos()
{
    $docentes_registrados = DB::table('egel_nuevos_docentes')
    ->leftJoin('gnral_carreras', 'egel_nuevos_docentes.id_carrera', '=', 'gnral_carreras.id_carrera')
    ->select(
        'egel_nuevos_docentes.*',
        'gnral_carreras.nombre'
    )
    ->orderBy('egel_nuevos_docentes.nombre_docente')
    ->get();

         $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->where('id_carrera', '!=', 16)
            ->get();

    return view('examen_gnral_con.admin.guardar_docentes',compact('docentes_registrados','carreras'));
}
}
