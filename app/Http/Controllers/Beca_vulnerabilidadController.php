<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Beca_vulnerabilidadController extends Controller
{
    public function index(Request $request){
        //1 es vulnerable madre de familia
        //2 es vulnerable con discapacidad
        //no es vulnerable

        $pregunta = $request->input('pregunta1');

        $id_periodo = Session::get('periodo_actual');
        $fecha_hoy=date("Y-m-d ");

        $id_usuario = Session::get('usuario_alumno');
        $datosalumno = DB::table('gnral_alumnos')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->select('gnral_alumnos.*', 'gnral_semestres.descripcion as semestre', 'gnral_carreras.nombre as carrera')
            ->where('id_usuario', '=', $id_usuario)
            ->get();


        $id_alumno = $datosalumno[0]->id_alumno;

        DB:: table('beca_vulnerabilidad')
            ->insert(['id_alumno'=>$id_alumno,
                'id_estado'=>$pregunta,
                'id_periodo'=>$id_periodo,
                'fecha_registro'=>$fecha_hoy]);
        return back();

    }
}
