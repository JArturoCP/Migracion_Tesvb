<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEgelController extends Controller
{

    public function index()
    {

     $alumnos = DB::table('gnral_alumnos as a')
    ->join('egel_resultados as r','r.id_alumno','=','a.id_alumno')
    ->select(
        'a.id_alumno',
        'a.nombre',
        'a.apaterno',
        'a.amaterno',
        'a.cuenta',
        'a.id_carrera',
        'r.calificacion_general',
        'r.nivel'
    )
    ->get();

    //dd($alumnos);

        return view('examen_egel.admin.resultados',compact('alumnos'));
    }

public function verAlumno()
{
    // Alumnos que NO han hecho examen (calificacion_general null)
    $alumnos_sin_examen = DB::table('gnral_alumnos as a')
        ->leftJoin('egel_resultados as r', 'r.id_alumno', '=', 'a.id_alumno')
        ->whereIn('a.id_carrera',[6,8])
        ->whereNull('r.calificacion_general')
        ->select(
            'a.id_alumno',
            'a.nombre',
            'a.apaterno',
            'a.amaterno',
            'a.cuenta',
            'a.correo_al'
        )
        ->orderBy('a.nombre')
        ->paginate(10, ['*'], 'sin'); // paginación personalizada

    // Alumnos que SÍ han hecho examen (calificacion_general NOT null)
    $alumnos_con_examen = DB::table('gnral_alumnos as a')
        ->join('egel_resultados as r', 'r.id_alumno', '=', 'a.id_alumno')
        ->whereIn('a.id_carrera',[6,8])
        ->whereNotNull('r.calificacion_general')
        ->select(
            'a.id_alumno',
            'a.nombre',
            'a.apaterno',
            'a.amaterno',
            'a.cuenta',
            'a.correo_al',
            'r.calificacion_general',
            'r.nivel'
        )
        ->orderBy('a.nombre')
        ->paginate(10, ['*'], 'con'); // paginación personalizada

    return view('examen_egel.admin.alumno', compact('alumnos_sin_examen', 'alumnos_con_examen'));
}
}