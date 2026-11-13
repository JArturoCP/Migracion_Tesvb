<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Dual_Gestion_Direccion_Academica extends Controller
{
    public function index()
    {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        return view('duales.Gestion_Academica.carreras_duales',compact('carreras'));
    }
    public function ver_docentes_duales($id_carrera)
    {
        $carrera = $id_carrera;
        //dd($carrera);
        $carr = DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ?', [$id_carrera]);
        $nombre_carrera = $carr->nombre;
        $id_periodo=Session::get('periodotrabaja');
        $docentes = DB::table('cal_duales_actuales')
        ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'cal_duales_actuales.id_alumno')
        ->join('gnral_personales', 'cal_duales_actuales.id_personal', '=', 'gnral_personales.id_personal')
        ->join('abreviaciones_prof', 'gnral_personales.id_personal', '=', 'abreviaciones_prof.id_personal')
        ->join('abreviaciones', 'abreviaciones_prof.id_abreviacion', '=', 'abreviaciones.id_abreviacion')
        ->join('gnral_carreras', 'gnral_alumnos.id_carrera', '=', 'gnral_carreras.id_carrera')
        ->select('gnral_personales.id_personal','gnral_personales.nombre as profesor', 'abreviaciones.titulo')
        ->distinct()
        ->where('cal_duales_actuales.id_periodo', $id_periodo)
        ->where('gnral_alumnos.id_carrera', $carrera)
        ->get();
        /*$datos = DB::select('SELECT DISTINCT gnral_personales.nombre as profesor, abreviaciones.titulo, cal_duales_actuales.*
        FROM cal_duales_actuales, gnral_alumnos,gnral_personales, abreviaciones_prof, abreviaciones
        WHERE gnral_alumnos.id_alumno = cal_duales_actuales.id_alumno
          AND cal_duales_actuales.id_personal = gnral_personales.id_personal
          AND gnral_personales.id_personal = abreviaciones_prof.id_personal
          AND gnral_alumnos.id_carrera='.$id_carrera.'
          AND cal_duales_actuales.id_periodo = '.$id_periodo.'
          AND abreviaciones_prof.id_abreviacion
          AND abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion');*/
        //dd($datos);

        return view('duales.Gestion_Academica.docentes_duales', compact('docentes','nombre_carrera'));
    }
    public function ver_alumnos_duales($id_personal)
    {
        $docente = $id_personal;
        $doc = DB::selectOne('SELECT * FROM gnral_personales WHERE id_personal = ? ', [$id_personal]);
        $nombre_docente = $doc->nombre;
        $id_periodo = Session::get('periodo_actual');
        $alumnos = DB::select('SELECT gnral_alumnos.id_alumno,  gnral_alumnos.cuenta,  gnral_alumnos.nombre,  gnral_alumnos.apaterno,  gnral_alumnos.amaterno,
        cal_duales_actuales.id_duales_actuales, eva_validacion_de_cargas.estado_validacion,
        eva_validacion_de_cargas.id
        FROM  gnral_alumnos
        JOIN cal_duales_actuales ON gnral_alumnos.id_alumno = cal_duales_actuales.id_alumno
        JOIN eva_carga_academica ON gnral_alumnos.id_alumno = eva_carga_academica.id_alumno
        JOIN gnral_materias ON eva_carga_academica.id_materia = gnral_materias.id_materia
        JOIN gnral_reticulas ON gnral_materias.id_reticula = gnral_reticulas.id_reticula
        LEFT JOIN eva_validacion_de_cargas ON eva_carga_academica.id_alumno = eva_validacion_de_cargas.id_alumno
        AND eva_validacion_de_cargas.id_periodo = eva_carga_academica.id_periodo
        WHERE cal_duales_actuales.id_periodo = ?
        AND eva_carga_academica.id_status_materia = 1
        AND eva_carga_academica.id_periodo = ?
        AND cal_duales_actuales.id_personal = ?
        AND eva_validacion_de_cargas.estado_validacion= 8
        GROUP BY gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
        ORDER BY gnral_alumnos.apaterno, gnral_alumnos.amaterno, gnral_alumnos.nombre ASC', [$id_periodo, $id_periodo, $docente]);
        //dd($alumnos);

        $docentes = DB::table('cal_duales_actuales')
        ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'cal_duales_actuales.id_alumno')
        ->join('gnral_personales', 'cal_duales_actuales.id_personal', '=', 'gnral_personales.id_personal')
        ->join('abreviaciones_prof', 'gnral_personales.id_personal', '=', 'abreviaciones_prof.id_personal')
        ->join('abreviaciones', 'abreviaciones_prof.id_abreviacion', '=', 'abreviaciones.id_abreviacion')
        ->join('gnral_carreras', 'gnral_alumnos.id_carrera', '=', 'gnral_carreras.id_carrera')
        ->select('gnral_personales.id_personal','gnral_personales.nombre as profesor', 'abreviaciones.titulo')
        ->distinct()
        ->where('cal_duales_actuales.id_periodo', $id_periodo)
        ->get();
        //dd($docentes);
        return view('duales.Gestion_Academica.alumnos_duales',compact('alumnos','docentes','nombre_docente'));
    }
    public function ver_calificaciones_alumnos_duales($id_carga)
    {

    $validar_carga = DB::table('eva_validacion_de_cargas')
            ->where('id', '=', $id_carga)
            ->get();

        $id_alumno = $validar_carga[0]->id_alumno;
        $id_periodo = $validar_carga[0]->id_periodo;
        $alum = DB::table('gnral_alumnos')
            ->where('id_alumno', '=', $id_alumno)
            ->get();
        $nombre_alumno = $alum[0]->cuenta . " " . mb_strtoupper($alum[0]->apaterno, 'utf-8') . " " . mb_strtoupper($alum[0]->amaterno, 'utf-8') . " " . mb_strtoupper($alum[0]->nombre, 'utf-8');
        $calificar_dual = DB::table('cal_duales_actuales')
            ->select(DB::raw('count(*) as calificado'))
            ->where('id_alumno', '=', $id_alumno)
            ->where('id_periodo', '=', $id_periodo)
            ->where('id_estado','>', 0)
            ->get();
        $calificar_dual=$calificar_dual[0]->calificado;
        $profesores=DB::select('SELECT gnral_personales.id_personal,gnral_personales.nombre,abreviaciones.titulo
        FROM abreviaciones_prof,abreviaciones,gnral_personales where
        gnral_personales.id_personal=abreviaciones_prof.id_personal and
        abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion ORDER BY `gnral_personales`.`nombre` ASC');

        if($calificar_dual == 0){
            $calificar_dual=0;
            $mentor=0;
        }
        else{
            $profesor = DB::table('cal_duales_actuales')
                ->where('cal_duales_actuales.id_alumno', '=', $id_alumno)
                ->where('cal_duales_actuales.id_periodo', '=', $id_periodo)
                ->get();
            $mentor=$profesor[0]->id_personal;
            $calificar_dual=1;
        }
        $materias=DB::select('select  gnral_materias.id_materia,gnral_materias.nombre as materias,gnral_materias.unidades,gnral_materias.id_materia,eva_tipo_curso.nombre_curso,
        eva_carga_academica.id_carga_academica,eva_carga_academica.grupo,gnral_materias.id_semestre,
        gnral_materias.creditos,eva_status_materia.nombre_status from
                                gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos,eva_validacion_de_cargas
                                where eva_carga_academica.id_materia=gnral_materias.id_materia
                                and eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia
                                and eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso
                                and eva_carga_academica.id_periodo=gnral_periodos.id_periodo
                                and eva_carga_academica.grupo=gnral_grupos.id_grupo
                                and eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                                and gnral_periodos.id_periodo= ?
                                and eva_carga_academica.id_materia  NOT IN (773,845,853,1160,1263,1264,1265,1443,1496,1502,1565,1566,1567,1568,1569,1571)
                                and gnral_alumnos.id_alumno=eva_validacion_de_cargas.id_alumno
                                and gnral_periodos.id_periodo=eva_validacion_de_cargas.id_periodo
                                and eva_validacion_de_cargas.id_alumno= ?
                                and eva_status_materia.id_status_materia=1', [$id_periodo, $id_alumno]);
        $array_materias=array();
        $mayor_unidades=0;
        $esc_alumno=false;
        foreach ($materias as $dat_alumno)
        {
            $esc_alumno=false;
            $suma_unidades=0;
            $unidades_evaluadas=0;
            $promedio_general=0;
            $dat_materia['id_carga_academica']=$dat_alumno->id_carga_academica;
            $dat_materia['id_materia']=$dat_alumno->id_materia;
            $dat_materia['curso']=$dat_alumno->nombre_curso;
            $dat_materia["materia"]=$dat_alumno->materias;
            $dat_materia["unidades"]=$dat_alumno->unidades;
            $mayor_unidades= $mayor_unidades > $dat_alumno->unidades ? $mayor_unidades : $dat_alumno->unidades;
            $array_calificaciones=array();
            $calificaciones=DB::select('SELECT * FROM cal_evaluaciones
                      WHERE id_carga_academica= ?
                      ORDER BY cal_evaluaciones.id_unidad', [$dat_alumno->id_carga_academica]);
            $calificaciones != null ? $unidades_evaluadas=0 : $unidades_evaluadas=1;
            foreach ($calificaciones as $calificacion)
            {
                $dat_calificaciones['id_evaluacion']=$calificacion->id_evaluacion;
                $dat_calificaciones['calificacion']=$calificacion->calificacion;
                $dat_calificaciones['id_unidad']=$calificacion->id_unidad;
                if ($calificacion->calificacion<70 || $calificacion->esc==1)
                {
                    $esc_alumno=true;
                }
                if ($calificacion->calificacion<70 )
                {
                    $promedio_general++;
                    //dd($promedio_general);
                }
                $unidades_evaluadas++;
                $suma_unidades+=$calificacion->calificacion>=70 ? $calificacion->calificacion : 0;
                array_push($array_calificaciones,$dat_calificaciones);
            }
            if($promedio_general == 0){

                $dat_materia['promedio'] = intval(round($suma_unidades / $unidades_evaluadas) + 0);

            }
            else {
                $dat_materia['promedio']=0;
            }
            //  $dat_materia['promedio']=intval(round($suma_unidades/$unidades_evaluadas)+0);
            $dat_materia['esc_alumno']=$esc_alumno;
            $dat_materia["calificaciones"]=$array_calificaciones;
            array_push($array_materias,$dat_materia);
            //dd($dat_materia["calificaciones"]);
        }

        return view('duales.Gestion_Academica.mostrar_calificaciones_duales',compact('mentor','profesores','id_alumno','id_periodo','array_materias','mayor_unidades','nombre_alumno','calificar_dual'));
    }

}
