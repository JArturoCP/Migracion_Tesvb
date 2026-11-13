<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;
class Distribucion_hrs_profesorExport implements FromView
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
        $categoria=DB::selectOne('SELECT * FROM `gnral_cargos` WHERE `id_cargo` = ?', [$id_categoria]);
        return view('reportes_profesores.excel_distribucion_hrs_profesor',compact('categoria','periodo','id_categoria','array_materia'));

    }
}
