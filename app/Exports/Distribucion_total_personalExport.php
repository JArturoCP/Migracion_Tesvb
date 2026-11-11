<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;
class Distribucion_total_personalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_categoria;

    public function __construct($id_categoria)
    {
        $this->id_categoria=$id_categoria;
    }
    public function view():View
    {
        $id_periodo=Session::get('periodotrabaja');
        $id_categoria=$this->id_categoria;
        $categoria=DB::selectOne('SELECT * FROM `gnral_cargos` WHERE `id_cargo` ='.$id_categoria.'');

        $periodo=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` ='.$id_periodo.'');
        //  dd($periodo);


        $docentes = DB::select('select distinct gnral_personales.horas_maxima, gnral_personales.nombre, gnral_personales.clave,gnral_personales.id_personal, gnral_cargos.id_cargo,
        gnral_cargos.cargo, gnral_perfiles.descripcion perfil FROM gnral_personales, gnral_horarios, gnral_periodo_carreras, gnral_periodos,
        gnral_cargos,gnral_perfiles WHERE
                                          gnral_personales.id_cargo ='.$id_categoria.' and
        gnral_personales.id_cargo = gnral_cargos.id_cargo and gnral_personales.id_personal = gnral_horarios.id_personal 
        AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo 
        AND gnral_personales.id_perfil = gnral_perfiles.id_perfil and gnral_periodos.id_periodo ='.$id_periodo.' 
        ORDER BY `gnral_personales`.`nombre` ASC');

        $array_materia=array();

        foreach ($docentes  as $docente){
            $estado_profesor=DB::selectOne('select  count(gnral_horas_profesores.id_hrs_profesor) contar  from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                where gnral_periodos.id_periodo='.$id_periodo.'
                and gnral_horarios.id_personal='.$docente->id_personal.'
                and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                and gnral_horarios.id_personal=gnral_personales.id_personal
                and gnral_materias.id_semestre=gnral_semestres.id_semestre');
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
                                gnral_materias_perfiles.id_personal='.$docente->id_personal.' AND
                                gnral_periodos.id_periodo='.$id_periodo.' AND
                                hrs_rhps.id_cargo='.$docente->id_cargo.' AND
                                gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                                gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor');



                foreach ($materias as $materia){

                    $total_grupos=DB::selectOne('select count(gnral_horas_profesores.grupo)total
                        from gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                        where gnral_periodos.id_periodo='.$id_periodo.'
                        and gnral_materias.id_materia='.$materia->idm.'
                        and gnral_horarios.id_personal='.$docente->id_personal.'
                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                        and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                        and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                        and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                        and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                        and gnral_horarios.id_personal=gnral_personales.id_personal
                        and gnral_materias.id_semestre=gnral_semestres.id_semestre ');

                    $total_horas= ($materia->hrs_p+$materia->hrs_t)*$total_grupos->total;
                    $totales_horas+=$total_horas;

                }



            }
            $dat['horas_asignatura']=$totales_horas;
            $total_horas_apoyo=DB::selectOne(' select COUNT(hrs_horario_extra_clase.id_semana) totales FROM
                                hrs_actividades_extras,hrs_act_extra_clases,hrs_extra_clase,gnral_horarios,gnral_periodos,gnral_carreras,
                                hrs_horario_extra_clase,
                                gnral_periodo_carreras WHERE
                                gnral_periodos.id_periodo='.$id_periodo.' AND
                                gnral_horarios.id_personal='.$docente->id_personal.' AND
                                hrs_horario_extra_clase.id_cargo='.$docente->id_cargo.' AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                                hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra AND
                                hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase
                                ');
            // dd($total_horas);

            $dat['horas_apoyo']=$total_horas_apoyo->totales;
            $dat['totales_horas']=$totales_horas+$total_horas_apoyo->totales;
            $dat['horas_profesor']=$docente->horas_maxima;
            array_push($array_materia,$dat);


        }
        return view('reportes_profesores.excel_distribucion_totales',compact('array_materia','periodo','categoria','id_categoria'));

    }
}
