<?php

namespace App\Http\Controllers;

use App\Exports\Distribucion_total_personalExport;
use App\Exports\HrsIndicesRepExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;
class HrsIndicesRep_ProfController extends Controller
{
    public function index(){
        $nombre_periodo = Session::get('nombre_periodo');
        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
            ->where('gnral_carreras.id_carrera','!=',11)
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
        $estado=0;

        return view('reportes_profesores.indice_reprobacion.indice_carrera', compact('nombre_periodo','carreras','estado'));

    }
    public function indice_repro_carrera_categoria($id_carrera){
        $id_periodo=Session::get('periodotrabaja');
        $nombre_periodo = Session::get('nombre_periodo');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);

        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera= ?', [$id_carrera]);

        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

      $estado=1;

        return view('reportes_profesores.indice_reprobacion.indice_carrera', compact('nombre_periodo','carreras','estado','categorias'));

    }
    public  function indice_repro_carrera_cat_docente($id_carrera,$id_categoria){
        set_time_limit(600);
        $id_periodo=Session::get('periodotrabaja');
        $nombre_periodo = Session::get('nombre_periodo');
        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera= ?', [$id_carrera]);

        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $materias = DB::select('select  DISTINCT(gnral_horas_profesores.id_hrs_profesor),gnral_materias.id_materia,gnral_materias.unidades,gnral_materias.nombre mat, gnral_semestres.id_semestre idsem,gnral_carreras.nombre,gnral_carreras.id_carrera,gnral_semestres.descripcion semestre,
                gnral_horas_profesores.grupo grupo, gnral_personales.nombre nombrepro, gnral_personales.id_personal
                from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                where gnral_periodos.id_periodo= ?
                and gnral_carreras.id_carrera= ?
                and gnral_personales.id_cargo= ?
                and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                and gnral_horarios.id_personal=gnral_personales.id_personal
                and gnral_materias.id_semestre=gnral_semestres.id_semestre
ORDER BY `nombrepro` ASC,`semestre` ASC,`grupo` ASC', [$id_periodo, $id_carrera, $id_categoria]);

//dd($materias);
        $array_materias=array();
        foreach ($materias as $materia){
            $dat['id_hrs_profesor']=$materia->id_hrs_profesor;
            $dat['id_materia']=$materia->id_materia;
            $dat['materia']=$materia->mat;
            $dat['id_semestre']=$materia->idsem;
            $dat['semestre']=$materia->semestre;
            $dat['grupo']=$materia->grupo;
            $dat['id_personal']=$materia->id_personal;
            $dat['profesor']=$materia->nombrepro;
            $dat['unidades_mat']=$materia->unidades;

            $estado_unidades=DB::selectOne('SELECT count(id_materia) contar from cal_periodos_califica
            where id_periodos= ? and id_materia= ? and id_grupo= ? and evaluada=1', [$id_periodo, $materia->id_materia, $materia->grupo]);

            if($estado_unidades->contar == 0){
                $dat['estado_unidad']=0;
                $dat['total_estudiantes']=0;
                $dat['max_unidad']=0;
                $dat['unidades']=0;
            }
            else{
                $dat['estado_unidad']=1;
                $max_unidades=DB::selectOne('SELECT max(id_unidad)unidad from cal_periodos_califica
            where id_periodos= ? and id_materia= ? and id_grupo= ? and evaluada=1', [$id_periodo, $materia->id_materia, $materia->grupo]);

                $dat['max_unidad']=$max_unidades->unidad;
                $unidades=DB::select('SELECT *from cal_periodos_califica
            where id_periodos= ? and id_materia= ? and id_grupo= ? and evaluada=1', [$id_periodo, $materia->id_materia, $materia->grupo]);


                $total_estudiantes=DB::selectOne('SELECT count(eva_carga_academica.id_carga_academica)contar
                 from gnral_alumnos,eva_carga_academica,eva_validacion_de_cargas
                where eva_carga_academica.grupo= ? and gnral_alumnos.id_alumno=eva_carga_academica.id_alumno
                and eva_carga_academica.id_materia= ? and eva_carga_academica.id_status_materia=1
                and eva_carga_academica.id_periodo= ? and eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno
                and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                  and eva_validacion_de_cargas.estado_validacion in (2,9)', [$materia->grupo, $materia->id_materia, $id_periodo]);

                $dat['total_estudiantes']=$total_estudiantes->contar;

                $contar_reprobados=0;
                $array_unidades= array();
                foreach ($unidades as $unidad){
                    $contar_reprobados=DB::selectOne('SELECT count(eva_carga_academica.id_carga_academica)contar
                from gnral_alumnos,eva_carga_academica,eva_validacion_de_cargas,cal_evaluaciones
                where eva_carga_academica.grupo= ? and gnral_alumnos.id_alumno=eva_carga_academica.id_alumno and
                eva_carga_academica.id_carga_academica = cal_evaluaciones.id_carga_academica and
                cal_evaluaciones.id_unidad = ? AND
                cal_evaluaciones.calificacion < 70
                and eva_carga_academica.id_materia= ? and eva_carga_academica.id_status_materia=1
                and eva_carga_academica.id_periodo= ? and eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno
                and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                  and eva_validacion_de_cargas.estado_validacion in (2,9)', [$materia->grupo, $unidad->id_unidad, $materia->id_materia, $id_periodo]);

                    if($contar_reprobados->contar == 0){
                        $dat_mat['unidad']=$unidad->id_unidad;
                        $dat_mat['total_est_r_u']=0;
                        $dat_mat['porcentaje_reprobacion'] =0;
                    }else {
                        $dat_mat['total_est_r_u'] = $contar_reprobados->contar;
                        $porcentaje=($contar_reprobados->contar * 100)/$total_estudiantes->contar;
                        $dat_mat['porcentaje_reprobacion']=round($porcentaje,2);

                    }
                    array_push($array_unidades,$dat_mat);
                  //  dd($contar_reprobados);
                }
                $dat['unidades']=$array_unidades;

            }

            array_push($array_materias,$dat);
        }
        $estado=3;
      //  dd($array_materias);


        return view('reportes_profesores.indice_reprobacion.indice_carrera', compact('array_materias','nombre_periodo','carreras','estado','categorias','id_categoria'));

///dd($array_materias);

    }
    public function excel_indice_rep_prof($id_carrera,$id_categoria){
        $id_periodo=Session::get('periodotrabaja');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);
        return Excel::download(new HrsIndicesRepExport($id_carrera,$id_categoria), "Indice_Rep_".$periodo->periodo.'.xlsx');

    }
    public function carrera_categoria_jefe($id_carrera){
        $id_periodo=Session::get('periodotrabaja');
        $nombre_periodo = Session::get('nombre_periodo');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$id_periodo]);

        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera= ?', [$id_carrera]);

        $categorias=DB::select('select distinct gnral_cargos.id_cargo, gnral_cargos.cargo
      FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos, gnral_cargos,gnral_perfiles
WHERE gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal
  AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
  AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo = ? ORDER BY `gnral_cargos`.`cargo` ASC', [$id_periodo]);

        $estado=1;
        return view('reportes_profesores.indice_reprobacion.indice_carrera_jefe', compact('nombre_periodo','carreras','estado','categorias'));


    }
}
