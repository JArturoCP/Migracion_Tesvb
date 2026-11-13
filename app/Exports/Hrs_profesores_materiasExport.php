<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;

class Hrs_profesores_materiasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {

        $id_periodo=Session::get('periodotrabaja');
        $id_carrera=Session::get('carrera');

        $relacion=DB::select('select DISTINCT gnral_perfiles.descripcion,gnral_personales.nombre,
            gnral_personales.cedula,gnral_materias.nombre materia,gnral_materias.unidades,
            concat(gnral_materias.id_semestre,"0",gnral_horas_profesores.grupo)grupo
            FROM gnral_personales,gnral_perfiles,gnral_horarios,gnral_horas_profesores,hrs_rhps,gnral_materias,
            gnral_materias_perfiles,
            gnral_periodo_carreras
            WHERE
            gnral_personales.id_perfil=gnral_perfiles.id_perfil AND
            gnral_periodo_carreras.id_carrera= ? AND
            gnral_periodo_carreras.id_periodo= ? AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_horarios.id_personal=gnral_personales.id_personal AND
            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor AND
            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
            gnral_materias_perfiles.id_personal=gnral_personales.id_personal
            ORDER BY gnral_personales.nombre,grupo', [$id_carrera, $id_periodo]);

                  return view('horarios.partialsh.prof_mat_exel',compact('relacion'));

    }
}
