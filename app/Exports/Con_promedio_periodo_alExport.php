<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\View\View;
use Session;

class Con_promedio_periodo_alExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_carrera;
    protected $id_semestre;

    public function __construct($id_carrera,$id_semestre){
        $this->id_carrera=$id_carrera;
        $this->id_semestre=$id_semestre;

    }
    public function view():View
    {
        $id_periodo=Session::get('periodo_actual');



        $alumnos = DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.apaterno,
gnral_alumnos.amaterno,eva_validacion_de_cargas.estado_validacion from gnral_alumnos,eva_validacion_de_cargas
where gnral_alumnos.id_carrera= ? and gnral_alumnos.id_semestre= ? and
gnral_alumnos.id_alumno=eva_validacion_de_cargas.id_alumno and
eva_validacion_de_cargas.id_periodo= ? and
eva_validacion_de_cargas.estado_validacion in (2,9,10)
ORDER BY gnral_alumnos.apaterno ASC,gnral_alumnos.amaterno ASC,gnral_alumnos.nombre ASC', [$this->id_carrera, $this->id_semestre, $id_periodo]);
        $array_datos_alumnos = array();
        $numero1=0;
        foreach ($alumnos as $alumno) {
            $numero1++;
            $datos_alumnos['numero1'] = $numero1;
            $datos_alumnos['id_alumno'] = $alumno->id_alumno;
            $datos_alumnos['cuenta'] = $alumno->cuenta;
            $datos_alumnos['nombre'] = $alumno->nombre;
            $datos_alumnos['apaterno'] = $alumno->apaterno;
            $datos_alumnos['amaterno'] = $alumno->amaterno;
            $datos_alumnos['estado'] = $alumno->estado_validacion;

            $carga_academica = DB::table('eva_carga_academica')
                ->join('gnral_materias','gnral_materias.id_materia','=','eva_carga_academica.id_materia')
                ->join('eva_tipo_curso','eva_tipo_curso.id_tipo_curso','=','eva_carga_academica.id_tipo_curso')
                ->join('gnral_semestres','gnral_semestres.id_semestre','=','gnral_materias.id_semestre')
                ->where('id_periodo', '=', $id_periodo)
                ->where('id_alumno', '=', $alumno->id_alumno)
                ->where('id_status_materia', '=', 1)
                ->select('eva_carga_academica.id_carga_academica','eva_carga_academica.id_tipo_curso','eva_tipo_curso.nombre_curso','gnral_materias.*','gnral_semestres.descripcion as semestre')
                ->get();
            $suma_promedio_final=0;
            $suma_materia=0;
            $alumnos= array();
            foreach($carga_academica as $materias){
                $suma_materia++;
                $datos_alumnos['numero']=$suma_materia;
                $datos_alumnos['id_carga_academica']=$materias->id_carga_academica;
                $datos_alumnos['id_materia']=$materias->id_materia;
                $datos_alumnos['nombre_materia']=$materias->nombre;
                $datos_alumnos['semestre']=$materias->semestre;
                $datos_alumnos['clave']=$materias->clave;

                $materia_promedio=DB::selectOne('SELECT SUM(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$materias->id_carga_academica]);
                $materia_promedio=$materia_promedio->suma;

                $contar_unidades_pasadas=DB::selectOne('SELECT count(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$materias->id_carga_academica]);
                $contar_unidades_pasadas=$contar_unidades_pasadas->suma;
                if($contar_unidades_pasadas ==$materias->unidades){
                    if($materia_promedio == 0){
                        $promedio=0;
                    }
                    else{
                        $promedio=round($materia_promedio/$materias->unidades);
                    }
                    if($materias->id_tipo_curso ==1){
                        $te='O';
                    }

                    if($materias->id_tipo_curso ==2){
                        $te='O2';
                    }
                    if($materias->id_tipo_curso ==3){
                        $te='CE';
                    }
                    if($materias->id_tipo_curso ==4){
                        $te='EG';
                    }
                }
                else{

                    if($materia_promedio == 0){
                        $promedio=0;
                    }
                    else{
                        $promedio=0;
                    }
                    if($materias->id_tipo_curso ==1){
                        $te='ESC';
                    }
                    if($materias->id_tipo_curso ==2){
                        $te='ESC2';
                    }
                    if($materias->id_tipo_curso ==3){
                        $te='EG';
                    }
                    if($materias->id_tipo_curso ==4){
                        $te='EG';
                    }



                }
                $datos_alumnos['promedio']=$promedio;
                $datos_alumnos['te']=$te;
                $suma_promedio_final+=$promedio;
                array_push($alumnos,$datos_alumnos);
            }
            if($suma_promedio_final > 0){
                $promedio_final=($suma_promedio_final/$suma_materia);
                $promedio_final = number_format($promedio_final, 2, '.', ' ');
            }
            else{
                $promedio_final=0;
            }
            $datos_alumnos['promedio_final']=$promedio_final;
            array_push($array_datos_alumnos, $datos_alumnos);

        }

        $i=3;



        $id_carrera=$this->id_carrera;
        $id_semestre=$this->id_semestre;

       return view('servicios_escolares.promedio_al_periodo.promedio_alumnos_excel',compact('id_semestre','id_carrera','array_datos_alumnos'))
            ;



    }
}
