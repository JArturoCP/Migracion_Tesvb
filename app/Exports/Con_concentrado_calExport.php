<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\View\View;
use Session;

class Con_concentrado_calExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_carrera;
    protected $id_semestre;
    protected $grupo;

    public function __construct($id_carrera,$id_semestre,$grupo){
        $this->id_carrera=$id_carrera;
        $this->id_semestre=$id_semestre;
        $this->grupo=$grupo;

    }

    public function collection()
    {
        $datos = DB::table('alumnos')
            ->where('carrera_id', $this->id_carrera)
            ->get();

        // Sanitiza los datos
        return collect($datos)->map(function ($row) {
            return array_map(function ($value) {
                return strip_tags((string) $value); // Elimina etiquetas HTML
            }, (array) $row);
        });
    }

    public function view():View
    {

        $id_periodo=Session::get('periodo_actual');

        $alumnos = DB::select('SELECT  gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,
gnral_alumnos.apaterno,gnral_alumnos.amaterno,eva_validacion_de_cargas.estado_validacion FROM eva_carga_academica,gnral_materias, gnral_alumnos,
eva_validacion_de_cargas,gnral_reticulas WHERE  gnral_materias.id_semestre= ?
and gnral_reticulas.id_carrera= ? and gnral_materias.id_reticula=gnral_reticulas.id_reticula and
eva_carga_academica.id_materia = gnral_materias.id_materia AND eva_carga_academica.id_status_materia = 1
AND eva_carga_academica.id_periodo = ? AND eva_carga_academica.grupo =  ?
and gnral_alumnos.id_alumno=eva_carga_academica.id_alumno and
  eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
  and eva_carga_academica.id_materia NOT IN (845,1160,1263,1264,1265,1443,1496,1502,1565,1566,1567,1568,1569,1571,1939)
  and eva_validacion_de_cargas.estado_validacion in (2,9,10) GROUP by gnral_alumnos.id_alumno
ORDER BY gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.nombre  ASC', [$this->id_semestre, $this->id_carrera, $id_periodo, $this->grupo]);

        /*
        $alumnos = DB::select('SELECT  gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,
gnral_alumnos.apaterno,gnral_alumnos.amaterno,eva_validacion_de_cargas.estado_validacion FROM eva_carga_academica,gnral_materias, gnral_alumnos,
eva_validacion_de_cargas,gnral_reticulas WHERE  gnral_materias.id_semestre=' .$this->id_semestre . '
and gnral_reticulas.id_carrera=' .  $this->id_carrera . ' and gnral_materias.id_reticula=gnral_reticulas.id_reticula and
eva_carga_academica.id_materia = gnral_materias.id_materia AND eva_carga_academica.id_status_materia = 1
AND eva_carga_academica.id_periodo = ' . $id_periodo . ' AND eva_carga_academica.grupo = ' .  $this->grupo . '
and gnral_alumnos.id_alumno=eva_carga_academica.id_alumno and
  eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo and
eva_validacion_de_cargas.estado_validacion in (2,9,10) GROUP by gnral_alumnos.id_alumno
ORDER BY gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.nombre  ASC');
        */
        // dd($alumnos);

        $materias = DB::select('select DISTINCT  gnral_periodo_carreras.id_carrera,gnral_horas_profesores.grupo,gnral_materias.creditos,gnral_materias.id_semestre,gnral_materias.unidades,gnral_materias.id_materia, gnral_materias.clave,gnral_materias.nombre materia,abreviaciones.titulo,gnral_personales.nombre,gnral_horarios.aprobado FROM
            gnral_horarios,gnral_horas_profesores,gnral_materias_perfiles,gnral_materias,gnral_personales,
            hrs_rhps,gnral_periodo_carreras,abreviaciones_prof,abreviaciones WHERE
            gnral_periodo_carreras.id_carrera= ? AND
            gnral_periodo_carreras.id_periodo= ? AND
            gnral_materias.id_semestre= ? AND
            gnral_horas_profesores.grupo= ? AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_horarios.id_personal=gnral_personales.id_personal AND
            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
            hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor and abreviaciones_prof.id_personal=gnral_personales.id_personal
            and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion  order by gnral_materias.nombre ASC ', [$this->id_carrera, $id_periodo, $this->id_semestre, $this->grupo]);

        $array_mat=array();
        $array_mat_sin=array();
        $mat_calificada=0;
        $mat_sin_cal=0;
        foreach ($materias as $materia) {
            $calificada=DB::selectOne('SELECT count(id_calificar_sumativas) contar_sumativas FROM `gnral_calificar_sumativas`
           WHERE `id_materia` = ? AND `id_grupo` = ? AND `id_estado` = 1 AND `id_periodo` = ?', [$materia->id_materia, $materia->grupo, $id_periodo]);
            $calificada=$calificada->contar_sumativas;



            if($calificada == 0) {
                $mat_sin_cal++;
                $dat_mater['id_materia'] = $materia->id_materia;
                $dat_mater['clave'] = $materia->clave;
                $dat_mater['nombre'] =$materia->titulo.' '.$materia->nombre;
                $dat_mater['nombre_materia'] = $materia->materia;

                array_push($array_mat_sin,$dat_mater);
            }
            else{
                $dat_materiass['id_materia'] = $materia->id_materia;
                $dat_materiass['clave'] = $materia->clave;
                $dat_materiass['nombre'] =$materia->titulo.' '.$materia->nombre;
                $dat_materiass['nombre_materia'] = $materia->materia;
                $dat_materiass['creditos'] = $materia->creditos;
                $dat_materiass['te'] = 'TE';
                $dat_materiass['unidades'] = $materia->unidades;
                $mat_calificada++;
                $dat_materiass['status'] =1;
                array_push($array_mat,$dat_materiass);
            }

        }

        if($mat_calificada ==0){
            return view('servicios_escolares.concentrado_calificaciones.concentrado_materias', compact('mat_calificada'));

        }
        else {


            $numero = 0;
            $materias_calificaciones = array();
            $estado_materias = 0;
            $numero_alumno = 0;
            $promedio_general = 0;
            $numero_promedio_aprobado = 0;
            $numero_promedio_reprobado = 0;
            $porcentaje_final_aprobado = 0;
            $porcentaje_final_reprobado = 0;
            foreach ($alumnos as $alumno) {
                $numero++;
                $dat_l['numero'] = $numero;
                $dat_l['id_alumno'] = $alumno->id_alumno;
                $dat_l['cuenta'] = $alumno->cuenta;
                $dat_l['estado_validacion'] = $alumno->estado_validacion;
                $dat_l['nombre'] = mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
                $cal_al = array();
                $suma_promedio_final = 0;
                $suma_materia = 0;
                $estado_materia = 0;
                foreach ($array_mat as $materiass) {

                    $inscrito = DB::selectOne('SELECT * FROM `eva_carga_academica`
                  WHERE `id_materia` = ? AND `id_status_materia` = 1
                  AND `id_periodo` = ? AND `grupo` = ? and id_alumno= ?', [$materiass['id_materia'], $id_periodo, $this->grupo, $alumno->id_alumno]);
//dd($inscrito);
                    if ($inscrito == null) {
                        $datos_alumnos['id_carga_academica'] = 0;
                        $datos_alumnos['id_materia'] = $materiass['id_materia'];
                        $datos_alumnos['nombre_materia'] = '';
                        $datos_alumnos['estado'] = 1;
                        $datos_alumnos['promedio'] = '';
                        $datos_alumnos['te'] = '';
                    } else {
                        $suma_materia++;
                        $datos_alumnos['id_carga_academica'] = $inscrito->id_carga_academica;
                        $datos_alumnos['id_materia'] = $inscrito->id_materia;
                        $datos_alumnos['nombre_materia'] = $materiass['nombre_materia'];
                        $datos_alumnos['estado'] = 2;


                        $materia_promedio = DB::selectOne('SELECT SUM(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$inscrito->id_carga_academica]);
                        $materia_promedio = $materia_promedio->suma;

                        $contar_unidades_pasadas = DB::selectOne('SELECT count(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$inscrito->id_carga_academica]);
                        $contar_unidades_pasadas = $contar_unidades_pasadas->suma;

                        $contar_unidades_sumativas = DB::selectOne('SELECT count(calificacion) num FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and esc=1', [$inscrito->id_carga_academica]);
                        $contar_unidades_sumativas = $contar_unidades_sumativas->num;

                        if ($contar_unidades_pasadas == $materiass['unidades']) {
                            if ($materia_promedio == 0) {
                                $promedio = 0;
                            } else {
                                $promedio = round($materia_promedio / $materiass['unidades']);
                            }
                            if ($inscrito->id_tipo_curso == 1 and $contar_unidades_sumativas == 0) {
                                $te = 'O';
                                $valor = 10;
                                $estado_materia += $valor;
                            } elseif ($inscrito->id_tipo_curso == 1 and $contar_unidades_sumativas > 0) {
                                $te = 'ESC';
                                $valor = 10;
                                $estado_materia += $valor;
                            } elseif ($inscrito->id_tipo_curso == 2 and $contar_unidades_sumativas == 0) {
                                $te = 'O2';
                                $valor = 100;
                                $estado_materia += $valor;
                            } elseif ($inscrito->id_tipo_curso == 2 and $contar_unidades_sumativas > 0) {
                                $te = 'ESC2';
                                $valor = 100;
                                $estado_materia += $valor;
                            }
                            if ($inscrito->id_tipo_curso == 3 and $contar_unidades_sumativas == 0) {
                                $te = 'CE';
                                $valor = 1000;
                                $estado_materia += $valor;
                            }
                            if ($inscrito->id_tipo_curso == 3 and $contar_unidades_sumativas > 0) {
                                $te = 'EG';
                                $valor = 1000;
                                $estado_materia += $valor;
                            }
                            if ($inscrito->id_tipo_curso == 4) {
                                $te = 'EG';
                                $valor = 10000;
                                $estado_materia += $valor;
                            }
                        } else {

                            if ($materia_promedio == 0) {
                                $promedio = 0;
                            } else {
                                $promedio = 0;
                            }
                            if ($inscrito->id_tipo_curso == 1) {
                                $te = 'ESC';
                                $valor = 10;
                                $estado_materia += $valor;
                            }
                            if ($inscrito->id_tipo_curso == 2) {
                                $te = 'ESC2';
                                $valor = 100;
                                $estado_materia += $valor;
                            }
                            if ($inscrito->id_tipo_curso == 3) {
                                $valor = 1000;
                                $estado_materia += $valor;
                                $te = 'EG';
                            }
                            if ($inscrito->id_tipo_curso == 4) {
                                $valor = 10000;
                                $estado_materia += $valor;
                                $te = 'EG';
                            }


                        }
                        $datos_alumnos['promedio'] = $promedio;
                        $datos_alumnos['te'] = $te;
                        $suma_promedio_final += $promedio;

                    }

                    array_push($cal_al, $datos_alumnos);
                }
                $estado_materias = $estado_materia;
                if ($estado_materias < 100) {
                    $estado_al = 1;

                } elseif ($estado_materias < 1000) {
                    $estado_al = 2;
                } elseif ($estado_materias < 10000) {
                    $estado_al = 3;
                } elseif ($estado_materias < 100000) {
                    $estado_al = 4;
                }
                if ($suma_promedio_final == 0) {
                    $promedio_f = 0;
                } else {
                    $promedio_f = $suma_promedio_final / $suma_materia;
                }
                if ($alumno->estado_validacion != 10) {
                    $numero_alumno++;
                    $promedio_general += number_format($promedio_f, 2, '.', ' ');
                    $pro_al = number_format($promedio_f, 2, '.', ' ');
                    if ($pro_al >= 70) {
                        $numero_promedio_aprobado++;
                    } else {
                        $numero_promedio_reprobado++;
                    }

                }
                $dat_l['promedio_f'] = number_format($promedio_f, 2, '.', ' ');
                $dat_l['l'] = $cal_al;
                $dat_l['estado_alumno'] = $estado_al;
                array_push($materias_calificaciones, $dat_l);
            }
            $promedio_general = $promedio_general / $numero_alumno;
            // dd($array_mat);

//dd($materias_calificaciones);
            $com = array();
            foreach ($array_mat as $mater) {
                $esta = false;

                $contar_alumnos = 0;
                $contar_reprobados = 0;
                $contar_aprobados = 0;
                $suma_promedioss = 0;
                $bajas = 0;
                foreach ($materias_calificaciones as $cal) {
                    if ($cal['estado_validacion'] != 10) {
                        foreach ($cal['l'] as $mate) {
                            if ($mater['id_materia'] == $mate['id_materia']) {
                                if ($mate['estado'] == 2) {
                                    $contar_alumnos++;
                                    if ($mate['promedio'] < 70) {
                                        $contar_reprobados++;
                                    } else {
                                        $contar_aprobados++;
                                    }
                                    $suma_promedioss += $mate['promedio'];
                                    if ($mate['te'] == 'EG') {
                                        $bajas++;
                                    }
                                }
                                $esta = true;
                                break;
                            } // esta es la que se me olvidaba
                        }
                    } else {
                        $bajas++;
                    }
                }
                $compra['id_materia'] = $mater['id_materia'];
                $compra['nombre_materia'] = $mater['nombre_materia'];
                $compra['creditos'] = $mater['creditos'];
                $compra['aprobados'] = $contar_aprobados;
                $compra['reprobados'] = $contar_reprobados;
                $compra['suma_promedios'] = $suma_promedioss;
                $compra['bajas'] = $bajas;
                $compra['total'] = $contar_alumnos;
                array_push($com, $compra);
            }
            $i=3;



            $id_carrera= $this->id_carrera;
            $id_semestre= $this->id_semestre;
            $grupo=$this->grupo;

            $carr=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ?', [$id_carrera]);

            $nombre_carrera=$carr->nombre;

            //dd($nombre_carrera, $id_semestre, $grupo, $id_carrera);


            return view('servicios_escolares.concentrado_calificaciones.concentrado_excel', [
                'numero_promedio_reprobado' => $numero_promedio_reprobado,
                'alumnos'=> $alumnos,
                'numero_promedio_aprobado' => $numero_promedio_aprobado,
                'numero_alumno' => $numero_alumno,
                'promedio_general' => $promedio_general,
                'mat_sin_cal' => $mat_sin_cal,
                'array_mat_sin' => $array_mat_sin,
                'com' => $com,
                'array_mat' => $array_mat,
                'mat_calificada' => $mat_calificada,
                'materias_calificaciones' => $materias_calificaciones,
                'bajas' => $bajas,
                'nombre_carrera' => (string) $nombre_carrera,
                'id_semestre' => (string) $id_semestre,
                'grupo' => (string) $grupo,
            ]);





            //dd($array_carreras);
        }

    }
}
