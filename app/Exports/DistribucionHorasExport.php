<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Session;
class DistribucionHorasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $id_carrera=Session::get('carrera_s');
        $carreran=DB::selectOne('select gnral_carreras.nombre from gnral_carreras where id_carrera= ?', [$id_carrera]);
        $carreran=($carreran->nombre);

        $id_periodo=Session::get('periodotrabaja');
        $periodo=DB::selectOne('select gnral_periodos.periodo from gnral_periodos where gnral_periodos.id_periodo= ?', [$id_periodo]);
        $periodo=($periodo->periodo);

        $resi_hrs=DB::selectOne('select COUNT(hrs_act_extra_clases.id_act_extra_clase) hrs_resi FROM
            gnral_horarios,hrs_act_extra_clases,hrs_extra_clase,hrs_horario_extra_clase, hrs_actividades_extras,
            gnral_periodo_carreras,gnral_carreras,gnral_periodos WHERE
            hrs_actividades_extras.id_hrs_actividad_extra=20001 AND
            gnral_periodos.id_periodo= ? AND gnral_carreras.id_carrera= ? AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
            hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase AND
            hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra ', [$id_periodo, $id_carrera]);
        $resi_hrs=($resi_hrs->hrs_resi);

        $claves_resi=DB::select('select DISTINCT gnral_personales.clave FROM
            gnral_horarios,hrs_act_extra_clases,hrs_extra_clase,hrs_horario_extra_clase, hrs_actividades_extras,
            gnral_periodo_carreras,gnral_carreras,gnral_periodos,gnral_personales WHERE
            hrs_actividades_extras.id_hrs_actividad_extra=20001 AND gnral_periodos.id_periodo= ? AND
            gnral_carreras.id_carrera= ? AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
            hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase AND
            hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra AND
            gnral_horarios.id_personal=gnral_personales.id_personal', [$id_periodo, $id_carrera]);

        $datos_resi=array();

        foreach($claves_resi as $clr)
        {
            $nombrer['claver']= $clr->clave;
            array_push($datos_resi, $nombrer);
        }

        $materias= DB::select('select DISTINCT gnral_materias_perfiles.id_materia_perfil mpf,
            gnral_materias.id_materia idm,gnral_materias.nombre,
            gnral_materias.id_semestre,gnral_materias.hrs_practicas hrs_p, gnral_materias.hrs_teoria hrs_t,
            gnral_materias_perfiles.id_materia_perfil totales
            FROM
            gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,
            gnral_periodos,gnral_carreras WHERE
            gnral_carreras.id_carrera= ?
            AND gnral_periodos.id_periodo= ? AND
            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera ORDER BY id_semestre', [$id_carrera, $id_periodo]);

        $nombre_materias=array();

        $cuenta=count($materias);
        for ($i=0; $i < $cuenta; $i++)
        {
            $materias[$i]->totales=($materias[$i]->hrs_p+$materias[$i]->hrs_t);
        }
        $total_mat=0;
        $t_t=0;
        $t_alum=0;
        $tru=0;
        $fals=0;
        foreach($materias as $materia)
        {
            $idmateria=$materia->idm;

            $cantidad=DB::selectOne('select hrs_distribucion_horas.id_distribucion_hora,hrs_distribucion_horas.no_alum from hrs_distribucion_horas,gnral_periodo_carreras,
                gnral_carreras,gnral_periodos WHERE
                hrs_distribucion_horas.id_materia= ? AND
                gnral_carreras.id_carrera= ? AND
                gnral_periodos.id_periodo= ? AND
                hrs_distribucion_horas.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo', [$idmateria, $id_carrera, $id_periodo]);
            //$cantidad=($cantidad->no_alum);

            $grupos=DB::select('select DISTINCT gnral_horas_profesores.grupo
                    FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
                    gnral_periodo_carreras,gnral_periodos
                    WHERE
                    gnral_materias_perfiles.id_materia_perfil= ? AND
                    gnral_periodo_carreras.id_periodo= ? AND
                    gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                    gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                    gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                    gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                    gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo', [$materia->mpf, $id_periodo]);

            $no_grupos=count($grupos);
            $total=$no_grupos*$materia->totales;

            $total_mat=$total_mat+$materia->totales;
            $t_t=$t_t+$total;
            $t_alum=$t_alum+$cantidad->no_alum;

            $nombrem['nombre_materia']= $materia->nombre;
            $nombrem['id_materia']= $materia->idm;
            $nombrem['id_semestre']= $materia->id_semestre;
            $nombrem['no_grupos']=$no_grupos;
            $nombrem['horas_totales']=$materia->totales;
            $nombrem['id_distribucion']=$cantidad->id_distribucion_hora;
            $nombrem['cantidad']=$cantidad->no_alum;
            $nombrem['total']=$total;


            $claves=DB::select('select distinct gnral_personales.clave from gnral_personales,gnral_horarios,gnral_horas_profesores,
                                    gnral_materias_perfiles, gnral_periodo_carreras, gnral_carreras,
                                    gnral_periodos where
                                    gnral_materias_perfiles.id_materia= ? AND
                                    gnral_carreras.id_carrera= ? AND
                                    gnral_periodos.id_periodo= ? AND
                                    gnral_materias_perfiles.id_personal=gnral_personales.id_personal AND
                                    gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                    gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                    gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                    gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                    gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo', [$idmateria, $id_carrera, $id_periodo]);
            $nombre_claves=array();
            $contra_clave=0;
            foreach($claves as $clave)
            {
                $contra_clave++;
                $nombrec['clave']= $clave->clave;
                array_push($nombre_claves, $nombrec);
            }
            $nombrem['claves']=$nombre_claves;
            $nombrem['contra_clave']=$contra_clave;
            array_push($nombre_materias, $nombrem);
        }
        $total_matr=$total_mat+$resi_hrs;
        $t_tr=$t_t+$resi_hrs;
        $materiass=$nombre_materias;
        $residencia=$datos_resi;
       // dd($materiass);
        //dd($total_matr);
        return view('formatos.partials.distribucion_admin',compact('resi_hrs','total_matr','t_tr',
            't_alum','periodo','carreran','materiass','residencia'));

    }
}
