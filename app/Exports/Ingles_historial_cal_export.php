<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class Ingles_historial_cal_export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_carrera;

    public function __construct($carr){
        //dd($carreras);
        $this->id_carrera=$carr->id_carrera;
     //   $this->id_asigna_generacion=$tutor->id_asigna_generacion;
        //$this->id_carrera=$carreras->id_carrera;
    }
    public function view(): View
    {
        $alumnos=DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
       gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno
from gnral_alumnos,in_validar_carga where gnral_alumnos.id_alumno = in_validar_carga.id_alumno
AND gnral_alumnos.id_carrera = ?
GROUP BY gnral_alumnos.id_alumno ORDER BY `gnral_alumnos`.`apaterno`,
                                          `gnral_alumnos`.`amaterno`, `gnral_alumnos`.`nombre` DESC
', [$this->id_carrera]);
        $periodo_actual=DB::selectOne('SELECT in_periodos.* from in_periodos where estado_historial=1 ');

        $array_alumnos = array();
        $numero=0;
        foreach ($alumnos as $alumno) {
            $numero++;
            $dat_alumnos['numero'] = $numero;
            $dat_alumnos['id_alumno'] = $alumno->id_alumno;
            $dat_alumnos['cuenta'] = $alumno->cuenta;
            $dat_alumnos['nombre'] = mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
            $periodos = DB::select('SELECT in_periodos.* from in_periodos where id_periodo_ingles <= ? and id_periodo_ingles >1', [$periodo_actual->id_periodo_ingles]);

            $array_periodo = array();
            foreach ($periodos as $periodo) {
                $validacion_carga = DB::selectOne('SELECT count(in_validar_carga.id_validar_carga) validacion
              from in_validar_carga where id_alumno= ?
              and id_periodo= ? and id_estado=2 ', [$alumno->id_alumno, $periodo->id_periodo_ingles]);
                if ($validacion_carga->validacion == 0) {
                    $cal['id_periodo'] = $periodo->id_periodo_ingles;
                    $cal['estado_periodo'] = 0;
                    $cal['calificacion'] = 0;
                    $cal['descripcion'] = "";
                } else {
                    $carga = DB::selectOne('SELECT * FROM `in_carga_academica_ingles`
                   WHERE `id_alumno` = ? AND `id_periodo_ingles` = ? ', [$alumno->id_alumno, $periodo->id_periodo_ingles]);
                    $nivel = DB::selectOne('SELECT * FROM `in_niveles_ingles` WHERE `id_niveles_ingles` = ? ', [$carga->id_nivel]);
                    $nivel = $nivel->descripcion;
                    $calificacion = DB::selectOne('SELECT SUM(calificacion) calificacion
                  from in_evaluar_calificacion where id_carga_ingles= ?', [$carga->id_carga_ingles]);
                    if ($calificacion->calificacion == 0) {
                        $cali = 0;
                    } else {
                        $cali = ($calificacion->calificacion) / 4;
                        $cali = round($cali, 0);
                    }
                    $cal['id_periodo'] = $periodo->id_periodo_ingles;
                    $cal['estado_periodo'] = 1;
                    $cal['calificacion'] = $cali;
                    $cal['descripcion'] = "Nivel: " . $nivel . " Grupo: " . $carga->id_grupo;

                }
                array_push($array_periodo, $cal);


            }
            $dat_alumnos['calificaciones'] = $array_periodo;

            array_push($array_alumnos, $dat_alumnos);
        }
        return view('ingles.departamento.concentrado_historial_cal',compact('array_alumnos','periodos'));
     //   dd($array_alumnos);


    }
}
