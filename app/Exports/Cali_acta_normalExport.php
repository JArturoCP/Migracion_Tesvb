<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Session;
use Illuminate\Support\Facades\DB;
class Cali_acta_normalExport implements FromView
{
    protected $id_docente;
    protected $id_materia;
    protected $id_grupo;
    public function __construct($id_docente,$id_materia,$id_grupo){
        $this->id_docente=$id_docente;
        $this->id_materia=$id_materia;
        $this->id_grupo=$id_grupo;
    }

    public function view():View
    {
        $nom_materia = $clave_m = $unidades = $imp_porcentaje = null;
        $id_docente=$this->id_docente;
        $id_materia=$this->id_materia;
       $id_grupo= $this->id_grupo;
        $mat = DB::selectOne('SELECT  *FROM gnral_materias WHERE id_materia = ?', [$this->id_materia]);

        $grupo = $mat->id_semestre.'0'. $this->id_grupo ;
        $nom_docente = DB::table('gnral_personales')->select('nombre')->where('id_personal', '=',$this->id_docente)->first();
        $nom_docente = $nom_docente->{'nombre'};
        $carrera= DB::selectOne('SELECT gnral_carreras.nombre from gnral_carreras,gnral_reticulas,gnral_materias WHERE gnral_carreras.id_carrera=gnral_reticulas.id_carrera and gnral_reticulas.id_reticula=gnral_materias.id_reticula and gnral_materias.id_materia= ?', [$this->id_materia]);
        $nom_carrera=$carrera->nombre;
        //accion 1 = periodos
        //accion 2 = calificaciones
        $periodo = Session::get('periodo_actual');
        $calificar_sumativa=DB::selectOne('SELECT count(id_calificar_sumativas) sumativa
FROM `gnral_calificar_sumativas`
WHERE `id_materia` = ? AND `id_grupo` = ? AND `id_estado` = 1 AND `id_periodo` = ?', [$id_materia, $id_grupo, $periodo]);
        $calificar_sumativa=$calificar_sumativa->sumativa;
        if($calificar_sumativa == 0) {

            $alumnos = DB::select('select gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre, gnral_alumnos.apaterno,gnral_alumnos.amaterno,eva_carga_academica.id_carga_academica, gnral_materias.clave,gnral_materias.nombre materia,gnral_materias.unidades,eva_tipo_curso.nombre_curso,eva_validacion_de_cargas.estado_validacion
                from gnral_alumnos,gnral_materias,eva_carga_academica, gnral_periodos,eva_tipo_curso,eva_validacion_de_cargas
                where gnral_periodos.id_periodo= ?
                and gnral_materias.id_materia= ?
                and eva_carga_academica.grupo= ?
                and eva_carga_academica.id_status_materia=1
                and eva_carga_academica.id_materia=gnral_materias.id_materia
                and eva_tipo_curso.id_tipo_curso=eva_carga_academica.id_tipo_curso
                and eva_carga_academica.id_periodo=gnral_periodos.id_periodo
				and eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                and eva_validacion_de_cargas.estado_validacion in (2,9,10)
                and eva_validacion_de_cargas.id_periodo= eva_validacion_de_cargas.id_periodo
                and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                ORDER BY gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.nombre', [$periodo, $id_materia, $id_grupo]);
//dd($alumnos);
            $array_alumnos = array();
            $num_alumnos = 0;
            $num_duales = 0;
            $numer_al = 0;
            $promed = 0;
            foreach ($alumnos as $alumno) {
                if ($alumno->estado_validacion != 10) {
                    $numer_al++;
                }
                if ($alumno->estado_validacion == 9) {
                    $num_duales++;
                }
                if ($alumno->estado_validacion == 10) {
                    $dat_alumnos["baja"] = 1;
                } else {
                    $dat_alumnos["baja"] = 0;
                }
                $sumativas = false;
                $esc_alumno = false;
                $num_alumnos++;
                $nom_materia = $alumno->materia;
                $clave_m = $alumno->clave;
                $unidades = $alumno->unidades;
                $dat_alumnos['np'] = $num_alumnos;
                $dat_alumnos['id_alumno'] = $alumno->id_alumno;
                $dat_alumnos['id_carga_academica'] = $alumno->id_carga_academica;
                $dat_alumnos['cuenta'] = $alumno->cuenta;
                $dat_alumnos['estado_validacion'] = $alumno->estado_validacion;
                $dat_alumnos['nombre'] = mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
                $array_calificaciones = array();
                $calificaciones = DB::select('SELECT * FROM cal_evaluaciones
                      WHERE id_carga_academica= ?
                      ORDER BY cal_evaluaciones.id_unidad', [$alumno->id_carga_academica]);
                $suma_unidades = 0;
                $calificaciones != null ? $numero_unidades = 0 : $numero_unidades = 1;
                $cont_unievaluadas = 0;
                foreach ($calificaciones as $calificacion) {
                    $bitacora_modificacion = DB::select('SELECT id_carga_academica FROM cal_bitacora_evaluaciones
                      WHERE id_evaluacion= ?
                      GROUP BY cal_bitacora_evaluaciones.id_carga_academica', [$calificacion->id_evaluacion]);
                    $dat_calificaciones['id_evaluacion'] = $calificacion->id_evaluacion;
                    $dat_calificaciones['calificacion'] = $calificacion->calificacion;
                    $dat_calificaciones['modificado'] = $bitacora_modificacion != null ? '1' : '2';
                    $dat_calificaciones['id_unidad'] = $calificacion->id_unidad;
                    $suma_unidades += $calificacion->calificacion >= 70 ? $calificacion->calificacion : 0;
                    if ($calificacion->calificacion < 70) {
                        $esc_alumno = true;
                    }
                    if ($calificacion->esc == 1) {
                        $esc_alumno = true;
                        $esc_pormateria = true;
                    }
                    if ($calificacion->calificacion < 70) {
                        $sumativas = true;

                    }


                    $numero_unidades++;
                    $cont_unievaluadas++;
                    array_push($array_calificaciones, $dat_calificaciones);
                }
                if ($alumno->estado_validacion == 10) {
                    $esc_alumno = true;
                }
                $dat_alumnos['sumativa'] = $sumativas;
                $dat_alumnos['esc_alumno'] = $esc_alumno;
                $dat_alumnos["especial_bloq"] = $esc_alumno == 1 && $alumno->nombre_curso == "ESPECIAL" ? 1 : 0;
                if ($alumno->estado_validacion == 10) {
                    $dat_alumnos['promedio'] = 0;

                } else {
                    $prome = intval(round($suma_unidades / $numero_unidades) + 0);
                    if ($prome >= 70) {
                        $promed++;
                    }
                    $dat_alumnos['promedio'] = intval(round($suma_unidades / $numero_unidades) + 0);

                }
                $dat_alumnos['calificaciones'] = $array_calificaciones;
                $dat_alumnos['curso'] = $alumno->nombre_curso;
                //$dat_alumnos['nombre']=ucwords(strtolower($alumno->nombre)." ".strtolower($alumno->apaterno)." ".strtolower($alumno->amaterno));
                array_push($array_alumnos, $dat_alumnos);
            }
            if ($promed > 0 and $numer_al > 0) {
                $imp_porcentaje = ($promed * 100) / $numer_al;
            } else {
                $imp_porcentaje = 0;
            }

            $no_unidades = DB::select('select gnral_materias.unidades
                from gnral_materias  where  gnral_materias.id_materia= ?
                ', [$id_materia]);
            $array_porcentajes = array();
            $porcent = 0;

            for ($i = 1; $i <= $no_unidades[0]->unidades; $i++) {
                $contar_alumnos = 0;
                $aprobados = 0;

                foreach ($array_alumnos as $alumnoss) {
                    foreach ($alumnoss['calificaciones'] as $cal) {
                        if ($cal['id_unidad'] == $i) {
                            if ($cal['calificacion'] >= 70) {
                                $contar_alumnos++;
                                $aprobados++;

                            } else {
                                $contar_alumnos++;

                            }
                            $esta = true;
                            break;
                        } // esta es la que se me olvidaba
                    }


                }

                $dat_porcentajes['id_unidad'] = $i;
                $dat_porcentajes['contar'] = $contar_alumnos;
                if ($contar_alumnos > 0 and $aprobados > 0) {
                    $porcentaje = ($aprobados * 100) / $contar_alumnos;

                } else {
                    $porcentaje = 0;
                }
                $porcent += $porcentaje;
                $dat_porcentajes['porcentaje'] = $porcentaje;
                array_push($array_porcentajes, $dat_porcentajes);
            }
        }
        else{
            $alumnos=DB::select('select gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre, gnral_alumnos.apaterno,gnral_alumnos.amaterno,eva_carga_academica.id_carga_academica, gnral_materias.clave,gnral_materias.nombre materia,gnral_materias.unidades,eva_tipo_curso.nombre_curso,eva_validacion_de_cargas.estado_validacion
                from gnral_alumnos,gnral_materias,eva_carga_academica, gnral_periodos,eva_tipo_curso,eva_validacion_de_cargas
                where gnral_periodos.id_periodo= ?
                and gnral_materias.id_materia= ?
                and eva_carga_academica.grupo= ?
                and eva_carga_academica.id_status_materia=1
                and eva_carga_academica.id_materia=gnral_materias.id_materia
                and eva_tipo_curso.id_tipo_curso=eva_carga_academica.id_tipo_curso
                and eva_carga_academica.id_periodo=gnral_periodos.id_periodo
				and eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                and eva_validacion_de_cargas.estado_validacion in (2,9,10)
                and eva_validacion_de_cargas.id_periodo= eva_validacion_de_cargas.id_periodo
                and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                ORDER BY gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.nombre', [$periodo, $id_materia, $id_grupo]);
//dd($alumnos);
            $array_alumnos=array();
            $num_alumnos=0;
            $num_duales=0;
            $numer_al=0;
            $promed=0;
            foreach ($alumnos as $alumno)
            {
                if($alumno->estado_validacion != 10)
                {
                    $numer_al++;
                }
                if($alumno->estado_validacion ==9)
                {
                    $num_duales++;
                }
                if($alumno->estado_validacion ==10)
                {
                    $dat_alumnos["baja"]=1;
                }
                else{
                    $dat_alumnos["baja"]=0;
                }
                $sumativas = false;
                $esc_alumno=false;
                $num_alumnos++;
                $nom_materia=$alumno->materia;
                $clave_m=$alumno->clave;
                $unidades=$alumno->unidades;
                $dat_alumnos['np']=$num_alumnos;
                $dat_alumnos['id_alumno']=$alumno->id_alumno;
                $dat_alumnos['id_carga_academica']=$alumno->id_carga_academica;
                $dat_alumnos['cuenta']=$alumno->cuenta;
                $dat_alumnos['estado_validacion']=$alumno->estado_validacion;
                $dat_alumnos['nombre']=mb_strtoupper($alumno->apaterno,'utf-8')." ".mb_strtoupper($alumno->amaterno,'utf-8')." ".mb_strtoupper($alumno->nombre,'utf-8');
                $array_calificaciones=array();
                $calificaciones=DB::select('SELECT * FROM cal_evaluaciones_sumativa
                      WHERE id_carga_academica= ?
                      ORDER BY cal_evaluaciones_sumativa.id_unidad', [$alumno->id_carga_academica]);
                $suma_unidades=0;
                $calificaciones!= null ? $numero_unidades=0 : $numero_unidades=1;
                $cont_unievaluadas=0;
                foreach ($calificaciones as $calificacion)
                {
                    $bitacora_modificacion=DB::select('SELECT id_carga_academica FROM cal_bitacora_evaluaciones
                      WHERE id_evaluacion= ?
                      GROUP BY cal_bitacora_evaluaciones.id_carga_academica', [$calificacion->id_evaluacion]);
                    $dat_calificaciones['id_evaluacion']=$calificacion->id_evaluacion;
                    $dat_calificaciones['calificacion']=$calificacion->calificacion;
                    $dat_calificaciones['modificado']=$bitacora_modificacion != null ? '1' : '2';
                    $dat_calificaciones['id_unidad']=$calificacion->id_unidad;
                    $suma_unidades+=$calificacion->calificacion>=70 ? $calificacion->calificacion : 0;
                    if ($calificacion->calificacion<70)
                    {
                        $esc_alumno=true;
                    }
                    if ($calificacion->esc==1)
                    {
                        $esc_alumno=true;
                        $esc_pormateria=true;
                    }
                    if ($calificacion->calificacion < 70) {
                        $sumativas = true;

                    }


                    $numero_unidades++;
                    $cont_unievaluadas++;
                    array_push($array_calificaciones,$dat_calificaciones);
                }
                if($alumno->estado_validacion ==10) {
                    $esc_alumno=true;
                }
                $dat_alumnos['sumativa'] = $sumativas;
                $dat_alumnos['esc_alumno']=$esc_alumno;
                $dat_alumnos["especial_bloq"]= $esc_alumno==1 && $alumno->nombre_curso=="ESPECIAL" ? 1: 0;
                if($alumno->estado_validacion ==10) {
                    $dat_alumnos['promedio']=0;

                }
                else{
                    $prome=intval(round($suma_unidades/$numero_unidades)+0);
                    if($prome >=70){
                        $promed++;
                    }
                    $dat_alumnos['promedio']=intval(round($suma_unidades/$numero_unidades)+0);

                }
                $dat_alumnos['calificaciones']=$array_calificaciones;
                $dat_alumnos['curso']=$alumno->nombre_curso;
                //$dat_alumnos['nombre']=ucwords(strtolower($alumno->nombre)." ".strtolower($alumno->apaterno)." ".strtolower($alumno->amaterno));
                array_push($array_alumnos,$dat_alumnos);
            }
            if($promed >0 and $numer_al >0){
                $imp_porcentaje=($promed*100)/$numer_al;
            }else{
                $imp_porcentaje=0;
            }
            //dd($array_alumnos);
            $no_unidades = DB::select('select gnral_materias.unidades
                from gnral_materias  where  gnral_materias.id_materia= ?
                ', [$id_materia]);
            $array_porcentajes=array();
            $porcent=0;

            for (   $i = 1 ; $i <= $no_unidades[0]->unidades ; $i++) {
                $contar_alumnos = 0;
                $aprobados=0;

                foreach ($array_alumnos as $alumnoss) {
                    foreach ($alumnoss['calificaciones'] as $cal) {
                        if ($cal['id_unidad'] == $i) {
                            if ($cal['calificacion'] >= 70) {
                                $contar_alumnos++;
                                $aprobados++;

                            } else {
                                $contar_alumnos++;

                            }
                            $esta = true;
                            break;
                        } // esta es la que se me olvidaba
                    }


                }

                $dat_porcentajes['id_unidad']=$i;
                $dat_porcentajes['contar']=$contar_alumnos;
                if($contar_alumnos >0 and $aprobados >0)
                {
                    $porcentaje=($aprobados*100)/$contar_alumnos;

                }
                else{
                    $porcentaje=0;
                }
                $porcent+=$porcentaje;
                $dat_porcentajes['porcentaje']=$porcentaje;
                array_push($array_porcentajes,$dat_porcentajes);
            }
        }

        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
        return  view('servicios_escolares.excel_acta',compact('id_docente','id_grupo','id_materia','grupo','nom_docente','nom_carrera','nom_materia','clave_m','unidades','imp_porcentaje'))->with(['alumnos'=>$array_alumnos,'porcentajes'=>$array_porcentajes]);
    }
}
