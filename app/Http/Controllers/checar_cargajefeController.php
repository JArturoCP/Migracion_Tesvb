<?php

namespace App\Http\Controllers;

use App\ValidacionCarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class checar_cargajefeController extends Controller
{
    public function index(){
        $id_periodo=Session::get('periodo_actual');

        $estudiantes= DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta, gnral_alumnos.nombre,
       gnral_alumnos.apaterno, gnral_alumnos.amaterno, gnral_carreras.nombre as carrera, gnral_alumnos.id_semestre, gnral_alumnos.grupo  FROM
       eva_validacion_de_cargas, gnral_alumnos, gnral_carreras WHERE eva_validacion_de_cargas.id_periodo = '.$id_periodo.'
       AND eva_validacion_de_cargas.estado_validacion = 100 and gnral_alumnos.id_carrera= gnral_carreras.id_carrera
    and eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno ');

      //dd($estudiantes);
       //dd($id_periodo);

        $periodo_act=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `estado` =1');
         $estudiantes_ins=array();
        foreach ($estudiantes as $estudiante)
        {
            $est['id_alumno']=$estudiante->id_alumno;
            $est['cuenta']=$estudiante->cuenta;
            $est['nombre']=$estudiante->apaterno.' '.$estudiante->amaterno.' '.$estudiante->nombre;
            $est['carrera']=$estudiante->carrera;

            $estado_contar=DB::selectOne('SELECT count(id_alumno)contar from eva_semestre_alumno where id_alumno='.$estudiante->id_alumno.'');

            if($estado_contar->contar == 0){
                $semestres_cursados=$estudiante->id_semestre;
            }else{
                $period_ins=DB::selectOne('SELECT * FROM `eva_semestre_alumno` WHERE `id_alumno` = '.$estudiante->id_alumno.'');
                $periodo_ins=$period_ins->id_periodo;

                $semestresins=$period_ins->id_semestre;
                $semestres_cursados=$periodo_act->id_periodo-$periodo_ins;
                if($semestres_cursados == 0){
                    $semestres_cursados=1;

                }else{
                    $semestres_cursados=$semestres_cursados+$semestresins;
                }
            }
            $semest=DB::selectOne('SELECT * FROM `gnral_semestres` WHERE `id_semestre` = '.$semestres_cursados.' ');

            $est['id_semestre']=$semest->id_semestre;
            $est['semestre']=$semest->descripcion;
            $est['grupo']=$estudiante->id_semestre.'0'.$estudiante->grupo;

            array_push($estudiantes_ins,$est);
        }

        return view('jefe_carrera.carga_academicas.ver_cargas_academicas',compact('estudiantes_ins'));


    }
    public function revicion_carga_estudiante($id_alumno,$id_semestre){

        $periodo=Session::get('periodo_actual');
        $validaciones=DB::select('select eva_validacion_de_cargas.id,eva_validacion_de_cargas.descripcion,eva_validacion_de_cargas.estado_validacion, eva_validacion_de_cargas.id_alumno 
                                    from eva_validacion_de_cargas 
                                    WHERE eva_validacion_de_cargas.id_alumno='.$id_alumno.' 
                                    AND eva_validacion_de_cargas.id_periodo='.$periodo.'');
        $reg_alumno= DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_alumno` ='.$id_alumno.'');
        $grupo=$reg_alumno->grupo;

        $semestre=DB::selectOne('SELECT * FROM `gnral_semestres` WHERE `id_semestre` ='.$id_semestre.'');
         $semestre=$semestre->descripcion;

         $grup_sem=$id_semestre.'0'.$grupo;

        $alumno=($validaciones[0]->id_alumno);
        $id=$validaciones[0]->id;
        $correcciones=$validaciones[0]->descripcion;


        $datos_carga=array();

        $consulta=DB::select('select eva_carga_academica.id_carga_academica,gnral_materias.clave,gnral_materias.nombre,gnral_materias.id_materia,
                            gnral_materias.id_semestre,gnral_materias.creditos,eva_status_materia.nombre_status,
                            eva_tipo_curso.nombre_curso,eva_carga_academica.grupo
                            from
                            gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos
                            where eva_carga_academica.id_materia=gnral_materias.id_materia
                            and eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia
                            and eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso
                            and eva_carga_academica.id_periodo=gnral_periodos.id_periodo
                            and eva_carga_academica.grupo=gnral_grupos.id_grupo
                            and eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                            and eva_status_materia.id_status_materia=1
                            and gnral_periodos.id_periodo='.$periodo.'
                            and eva_carga_academica.id_alumno='.$alumno.'');

        foreach ($consulta as $cons) {
            $dat['id_carga_academica'] = $cons->id_carga_academica;
            $dat['clave'] = $cons->clave;
            $dat['nombre'] = $cons->nombre;
            $dat['id_materia'] = $cons->id_materia;
            $dat['id_semestre'] = $cons->id_semestre;
            $dat['creditos'] = $cons->creditos;
            $dat['nombre_status'] = $cons->nombre_status;
            $dat['nombre_curso'] = $cons->nombre_curso;
            $dat['grupo'] = $cons->grupo;

            $profesor=array();

            $profesores = DB::select('select DISTINCT gnral_materias.id_materia, gnral_materias.nombre, gnral_horarios.id_horario_profesor,
            gnral_reticulas.clave,gnral_personales.nombre docente, abreviaciones.titulo
            FROM
            gnral_horarios,gnral_horas_profesores,gnral_materias_perfiles,gnral_materias,gnral_personales,
            gnral_periodo_carreras,gnral_reticulas, abreviaciones_prof, abreviaciones WHERE
            gnral_periodo_carreras.id_periodo='.$periodo.' AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_horarios.id_personal=gnral_personales.id_personal AND
            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
            gnral_materias.id_reticula = gnral_reticulas.id_reticula and 
            gnral_horas_profesores.grupo = '.$cons->grupo.' and 
            gnral_personales.id_personal = abreviaciones_prof.id_personal
            and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion and 
            gnral_materias.id_materia = '.$cons->id_materia.'');


            foreach ($profesores as $prof){
                $pro['nombre_profesor'] = $prof->docente;
                $pro['titulo'] = $prof->titulo;
                array_push($profesor,$pro);
            }
            $dat['profesores'] = $profesor;
            array_push($datos_carga, $dat);

        }
       // dd($datos_carga);

        $suma=0;
        foreach ($consulta as $cons){
            if($cons->id_materia != 2258) {
                $suma = $suma + $cons->creditos;
            }
        }

        $estudiante=DB::selectOne("select gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno,gnral_alumnos.amaterno from gnral_alumnos where gnral_alumnos.id_alumno=".$alumno."");
        $no_cuenta=$estudiante->cuenta;

        $nombre_estudiante= $estudiante->apaterno." ".$estudiante->amaterno." ".$estudiante->nombre;
        $nombre_estudiante=mb_strtoupper($nombre_estudiante);

        return view('jefe_carrera.carga_academicas.carga_estudiante',compact('no_cuenta','nombre_estudiante','datos_carga','suma','id','grup_sem',"correcciones"));

    }
    public function validacion_de_jefe_estudiante(Request $request,$id){
        $optradio=$request->get('optradio');

        if($optradio == 1){

            DB::table('eva_validacion_de_cargas')
                ->where('id', $id)
                ->update([
                    'estado_validacion' => 1,
                ]);

        }else{
            $obser=$request->get('obser');

            DB::table('eva_validacion_de_cargas')
                ->where('id', $id)
                ->update([
                    'estado_validacion' => 3,
                    'descripcion'=>$obser,
                ]);
        }
        return redirect('/revicion_carga_jefe/');

    }
}
