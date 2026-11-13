<?php

namespace App\Http\Controllers;

use App\Exports\Distribucion_hrs_profesorExport;
use App\Exports\Distribucion_total_personalExport;
use App\Exports\Ingles_voucher_val_export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class HrsDistribucionHorasDocController extends Controller
{
    public function index(){

        $id_periodo=Session::get('periodotrabaja');
        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);

        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $estado=0;

        return view('reportes_profesores.distribucion_hrs_profesores',compact('categorias','estado'));

    }

    public function distribucion_profesores_categoria($id_categoria){

        $id_periodo=Session::get('periodotrabaja');
        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $docentes = DB::select('select distinct gnral_personales.nombre, gnral_personales.clave,gnral_personales.id_personal,
        gnral_cargos.cargo, gnral_perfiles.descripcion perfil FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos,
        gnral_cargos,gnral_perfiles WHERE
                                          gnral_personales.id_cargo = ? and
                                          gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
        AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
        AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ?
        ORDER BY `gnral_personales`.`nombre` ASC', [$id_categoria, $id_periodo]);
       //dd($docentes);
        $array_docentes=array();

        foreach ($docentes  as $docente){
             $estado_profesor=DB::selectOne('select  count(gnral_horas_profesores.id_hrs_profesor) contar  from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                where gnral_periodos.id_periodo= ?
                and gnral_horarios.id_personal= ?
                and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                and gnral_horarios.id_personal=gnral_personales.id_personal
                and gnral_materias.id_semestre=gnral_semestres.id_semestre', [$id_periodo, $docente->id_personal]);

             if($estado_profesor->contar != 0){
                 $dat['id_personal']=$docente->id_personal;
                 $dat['nombre']=$docente->nombre;
                 $dat['clave']=$docente->clave;
                 $dat['cargo']=$docente->cargo;
                 $dat['perfil']=$docente->perfil;

                 array_push($array_docentes,$dat);
             }
        }
        $estado=1;
        return view('reportes_profesores.distribucion_hrs_profesores',compact('array_docentes','estado','categorias','id_categoria'));

    }
    public function distribucion_horas_prof_mat($id_personal){
        $profesor=DB::selectOne('SELECT gnral_personales.id_personal,abreviaciones.titulo, gnral_personales.nombre,
       gnral_personales.id_cargo, gnral_cargos.cargo,gnral_personales.id_perfil,gnral_perfiles.descripcion perfil
       from gnral_personales, gnral_cargos, gnral_perfiles, abreviaciones_prof,abreviaciones where
       abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and abreviaciones_prof.id_personal = gnral_personales.id_personal
      and gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_perfil = gnral_perfiles.id_perfil
      and gnral_personales.id_personal= ?', [$id_personal]);
        $id_categoria=$profesor->id_cargo;

        $id_periodo=Session::get('periodotrabaja');

        $materias=DB::select('select distinct gnral_carreras.nombre carrera,gnral_materias_perfiles.id_materia_perfil mpf,gnral_materias.id_materia idm,
gnral_materias.nombre,gnral_materias.hrs_practicas hrs_p,gnral_materias.hrs_teoria hrs_t,
gnral_materias.hrs_practicas totales,"" actividad
FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
gnral_periodo_carreras,gnral_periodos, gnral_carreras,hrs_rhps
                                WHERE
                                gnral_materias_perfiles.id_personal= ? AND
                                gnral_periodos.id_periodo= ? AND
                                hrs_rhps.id_cargo= ? AND
                                gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                                gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor', [$id_personal, $id_periodo, $profesor->id_cargo]);
        //dd($materias);
         $array_materia=array();

        foreach ($materias as $materia){
            $dat['carrera']=$materia->carrera;
            $dat['id_materia']=$materia->idm;
            $dat['materia']=$materia->nombre;
            $dat['horas_totales']=$materia->hrs_p+$materia->hrs_t;

            $total_grupos=DB::selectOne('select count(gnral_horas_profesores.grupo)total
                        from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                        where gnral_periodos.id_periodo= ?
                        and gnral_materias.id_materia= ?
                        and gnral_horarios.id_personal= ?
                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                        and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                        and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                        and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                        and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                        and gnral_horarios.id_personal=gnral_personales.id_personal
                        and gnral_materias.id_semestre=gnral_semestres.id_semestre ', [$id_periodo, $materia->idm, $id_personal]);
            $dat['total_grupos']=$total_grupos->total;
            $dat['total_horas_grupos']=($materia->hrs_p+$materia->hrs_t)*$total_grupos->total;

            array_push($array_materia,$dat);
        }
       // dd($array_materia);
        return view('reportes_profesores.distribucion_materias',compact('array_materia','profesor','id_categoria'));
       // dd($array_materia);
    }
    public function distribucion_horas_prof_total(){
        $id_periodo=Session::get('periodotrabaja');
        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);

        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $estado=0;

        return view('reportes_profesores.distribucion_total_materias',compact('categorias','periodo','estado'));
    }
    public function distribucion_totales_prof($id_categoria){
        $id_periodo=Session::get('periodotrabaja');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);
      //  dd($periodo);
        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $docentes = DB::select('select distinct gnral_personales.horas_maxima, gnral_personales.nombre, gnral_personales.clave,gnral_personales.id_personal, gnral_cargos.id_cargo,
        gnral_cargos.cargo, gnral_perfiles.descripcion perfil FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos,
        gnral_cargos,gnral_perfiles WHERE
                                          gnral_personales.id_cargo = ? and
        gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
        AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
        AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ?
        ORDER BY `gnral_personales`.`nombre` ASC', [$id_categoria, $id_periodo]);

        $array_materia=array();

        foreach ($docentes  as $docente){
            $estado_profesor=DB::selectOne('select  count(gnral_horas_profesores.id_hrs_profesor) contar  from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                where gnral_periodos.id_periodo= ?
                and gnral_horarios.id_personal= ?
                and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                and gnral_horarios.id_personal=gnral_personales.id_personal
                and gnral_materias.id_semestre=gnral_semestres.id_semestre', [$id_periodo, $docente->id_personal]);
            $dat['id_personal']=$docente->id_personal;
            $dat['nombre']=$docente->nombre;
            $total_horas=0;
            $totales_horas=0;
            if($estado_profesor->contar != 0){



                $materias=DB::select('select distinct gnral_carreras.nombre carrera,gnral_materias_perfiles.id_materia_perfil mpf,gnral_materias.id_materia idm,
gnral_materias.nombre,gnral_materias.hrs_practicas hrs_p,gnral_materias.hrs_teoria hrs_t,
gnral_materias.hrs_practicas totales,"" actividad
FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
gnral_periodo_carreras,gnral_periodos, gnral_carreras,hrs_rhps
                                WHERE
                                gnral_materias_perfiles.id_personal= ? AND
                                gnral_periodos.id_periodo= ? AND
                                hrs_rhps.id_cargo= ? AND
                                gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                                gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor', [$docente->id_personal, $id_periodo, $docente->id_cargo]);



                foreach ($materias as $materia){

                    $total_grupos=DB::selectOne('select count(gnral_horas_profesores.grupo)total
                        from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                        where gnral_periodos.id_periodo= ?
                        and gnral_materias.id_materia= ?
                        and gnral_horarios.id_personal= ?
                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                        and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                        and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                        and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                        and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                        and gnral_horarios.id_personal=gnral_personales.id_personal
                        and gnral_materias.id_semestre=gnral_semestres.id_semestre ', [$id_periodo, $materia->idm, $docente->id_personal]);

                    $total_horas= ($materia->hrs_p+$materia->hrs_t)*$total_grupos->total;
                      $totales_horas+=$total_horas;

                }



            }
            $dat['horas_asignatura']=$totales_horas;
            $total_horas_apoyo=DB::selectOne(' select COUNT(hrs_horario_extra_clase.id_semana) totales FROM
                                hrs_actividades_extras,hrs_act_extra_clases,hrs_extra_clase,gnral_horarios,gnral_periodos,gnral_carreras,
                                hrs_horario_extra_clase,
                                gnral_periodo_carreras WHERE
                                gnral_periodos.id_periodo= ? AND
                                gnral_horarios.id_personal= ? AND
                                hrs_horario_extra_clase.id_cargo= ? AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                                hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra AND
                                hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase
                                ', [$id_periodo, $docente->id_personal, $docente->id_cargo]);
          // dd($total_horas);

            $dat['horas_apoyo']=$total_horas_apoyo->totales;
            $dat['totales_horas']=$totales_horas+$total_horas_apoyo->totales;
            $dat['horas_profesor']=$docente->horas_maxima;
            array_push($array_materia,$dat);


        }
        //dd($array_materia);
      //  dd($array_materia);
        $estado=1;
        return view('reportes_profesores.distribucion_total_materias',compact('array_materia','periodo','estado','categorias','id_categoria'));
    }
    public function distribucion_excel_totales_profesor($id_categoria){
        $id_periodo=Session::get('periodotrabaja');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);
        return Excel::download(new Distribucion_total_personalExport($id_categoria), $periodo->periodo.'.xlsx');
    }
    public function distribucion_horas_prof_totales(){
        $id_periodo=Session::get('periodotrabaja');
        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);

      $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

      $estado=0;

        return view('reportes_profesores.distribucion_totales',compact('categorias','periodo','estado'));
    }
    public function distribucion_profesores_categorias($id_categoria){
        set_time_limit(120);
        $id_periodo=Session::get('periodotrabaja');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);
        //  dd($periodo);
        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $docentes = DB::select('select distinct gnral_personales.nombre, gnral_personales.clave,gnral_personales.id_personal, gnral_cargos.id_cargo,
        gnral_cargos.cargo, gnral_perfiles.descripcion perfil FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos,
        gnral_cargos,gnral_perfiles WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo
                                      and gnral_personales.id_cargo = ?
                                      and gnral_personales.id_personal = gnral_horarios.id_personal
        AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
        AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ?
        ORDER BY `gnral_personales`.`nombre` ASC', [$id_categoria, $id_periodo]);
       // dd($docentes);
        //dd($docentes);
        $array_materia=array();

        foreach ($docentes  as $docente){
            $estado_profesor=DB::selectOne('select  count(gnral_horas_profesores.id_hrs_profesor) contar  from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                where gnral_periodos.id_periodo= ?
                and gnral_horarios.id_personal= ?
                and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                and gnral_horarios.id_personal=gnral_personales.id_personal
                and gnral_materias.id_semestre=gnral_semestres.id_semestre', [$id_periodo, $docente->id_personal]);

            if($estado_profesor->contar != 0){


                $materias=DB::select('select distinct gnral_carreras.nombre carrera,gnral_materias_perfiles.id_materia_perfil mpf,gnral_materias.id_materia idm,
gnral_materias.nombre,gnral_materias.hrs_practicas hrs_p,gnral_materias.hrs_teoria hrs_t,
gnral_materias.hrs_practicas totales,"" actividad
FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
gnral_periodo_carreras,gnral_periodos, gnral_carreras,hrs_rhps
                                WHERE
                                gnral_materias_perfiles.id_personal= ? AND
                                gnral_periodos.id_periodo= ? AND
                                hrs_rhps.id_cargo= ? AND
                                gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                                gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor', [$docente->id_personal, $id_periodo, $docente->id_cargo]);



                foreach ($materias as $materia){
                    $dat['id_personal']=$docente->id_personal;
                    $dat['nombre']=$docente->nombre;
                    $dat['clave']=$docente->clave;
                    $dat['id_cargo']=$docente->id_cargo;
                    $dat['cargo']=$docente->cargo;
                    $dat['perfil']=$docente->perfil;
                    $dat['carrera']=$materia->carrera;
                    $dat['id_materia']=$materia->idm;
                    $dat['materia']=$materia->nombre;
                    $dat['horas_totales']=$materia->hrs_p+$materia->hrs_t;

                    $total_grupos=DB::selectOne('select count(gnral_horas_profesores.grupo)total
                        from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                        where gnral_periodos.id_periodo= ?
                        and gnral_materias.id_materia= ?
                        and gnral_horarios.id_personal= ?
                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                        and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                        and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                        and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                        and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                        and gnral_horarios.id_personal=gnral_personales.id_personal
                        and gnral_materias.id_semestre=gnral_semestres.id_semestre ', [$id_periodo, $materia->idm, $docente->id_personal]);
                    $dat['total_grupos']=$total_grupos->total;
                    $dat['total_horas_grupos']=($materia->hrs_p+$materia->hrs_t)*$total_grupos->total;

                    array_push($array_materia,$dat);
                }
            }
        }
        $estado=1;

        return view('reportes_profesores.distribucion_totales',compact('categorias','periodo','estado','id_categoria','array_materia'));

    }
    public function distribucion_profesores_cat_excel($id_categoria){
        $id_periodo=Session::get('periodotrabaja');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);
        return Excel::download(new Distribucion_hrs_profesorExport($id_categoria), $periodo->periodo.'.xlsx');
    }
}
