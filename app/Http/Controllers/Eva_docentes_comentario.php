<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class Eva_docentes_comentario extends Controller
{
    public function index(){

        $periodo=Session::get('periodo_actual');

        $docentes = DB::Select('SELECT DISTINCT(gnral_personales.nombre),gnral_personales.id_personal 
                                FROM gnral_personales, gnral_horarios,gnral_horas_profesores,gnral_periodos,gnral_periodo_carreras,gnral_carreras 
                                WHERE gnral_periodos.id_periodo= ? 
                                AND gnral_periodo_carreras.id_carrera= gnral_carreras.id_carrera
                                AND gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo 
                                AND gnral_horarios.id_personal=gnral_personales.id_personal 
                                AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera 
                                AND gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor', [$periodo]);
        //dd($docentes);


        return view('evaluacion_docente.Admin.reporte_comentarios',compact('docentes'));
    }
}
