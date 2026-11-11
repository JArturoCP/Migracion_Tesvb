<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Session;

class RelacionPersonalDocenteExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $id_periodo=Session::get('periodotrabaja');
        $periodo = DB::selectOne('select gnral_periodos.periodo from gnral_periodos where gnral_periodos.id_periodo='.$id_periodo.'');
        $periodo=($periodo->periodo);

        $id_carrera=Session::get('carrera_aa');

        $ncarrera=DB::selectOne('select gnral_carreras.nombre from gnral_carreras where gnral_carreras.id_carrera='.$id_carrera.'');
        $ncarrera=($ncarrera->nombre);

        $docentes=DB::select('select DISTINCT gnral_horarios.id_personal,gnral_personales.clave,gnral_personales.nombramiento,gnral_personales.fch_ingreso_tesvb,  gnral_horarios.id_horario_profesor, gnral_personales.nombre,gnral_personales.horas_maxima,hrs_situaciones.abrevia,hrs_rhps.id_cargo 
            FROM gnral_horarios, gnral_horas_profesores, hrs_rhps, gnral_personales,gnral_periodo_carreras,gnral_periodos,gnral_carreras,hrs_situaciones
            WHERE 
            gnral_carreras.id_carrera='.$id_carrera.' AND
            gnral_periodos.id_periodo='.$id_periodo.' AND
            gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
            and gnral_horarios.id_personal=gnral_personales.id_personal
            AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
            AND gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            gnral_personales.id_situacion=hrs_situaciones.id_situacion AND
            hrs_rhps.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor
            union
            SELECT DISTINCT gnral_horarios.id_personal, gnral_personales.clave,gnral_personales.nombramiento,gnral_personales.fch_ingreso_tesvb, gnral_horarios.id_horario_profesor,gnral_personales.nombre,gnral_personales.horas_maxima,hrs_situaciones.abrevia,hrs_horario_extra_clase.id_cargo
            FROM gnral_horarios,hrs_extra_clase, gnral_personales,gnral_periodo_carreras,gnral_periodos,gnral_carreras,hrs_situaciones,hrs_horario_extra_clase
            WHERE
            gnral_carreras.id_carrera='.$id_carrera.' 
            AND gnral_periodos.id_periodo='.$id_periodo.' 
            AND hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor
            and gnral_horarios.id_personal=gnral_personales.id_personal
            AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
            AND gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera 
            AND gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            gnral_personales.id_situacion=hrs_situaciones.id_situacion AND
            hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase');

        $datos_docente=array();
        $t_nombra=0;
        $t_hrs=0;
        $t_t=0;
        $t_p=0;
        $total_lic=0;
        $tru=0;
        $fals=0;

        foreach($docentes as $docente)
        {
            $materias=DB::select('select distinct gnral_materias_perfiles.id_materia_perfil mpf,gnral_materias.id_materia idmat,
            gnral_materias.nombre,gnral_materias.hrs_practicas P,gnral_materias.hrs_teoria T,
            (gnral_materias.hrs_practicas+gnral_materias.hrs_teoria) totales
            FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,gnral_periodo_carreras,
            gnral_periodos, gnral_carreras
            WHERE
            gnral_materias_perfiles.id_personal='.$docente->id_personal.' AND
            gnral_carreras.id_carrera='.$id_carrera.' AND
            gnral_periodos.id_periodo='.$id_periodo.' AND
            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
            UNION
            SELECT distinct hrs_actividades_extras.id_hrs_actividad_extra mpf,hrs_actividades_extras.id_hrs_actividad_extra idmat,
            hrs_actividades_extras.descripcion nombre,
            COUNT(hrs_horario_extra_clase.id_semana) P,"0" T,COUNT(hrs_horario_extra_clase.id_semana) totales FROM
            hrs_actividades_extras,hrs_act_extra_clases,hrs_extra_clase,gnral_horarios,gnral_periodos,gnral_carreras,
            hrs_horario_extra_clase,
            gnral_periodo_carreras WHERE
            gnral_carreras.id_carrera='.$id_carrera.' AND
            gnral_periodos.id_periodo='.$id_periodo.' AND
            gnral_horarios.id_personal='.$docente->id_personal.' AND
            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
            hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
            hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
            hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra AND
            hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase
            GROUP BY hrs_act_extra_clases.id_hrs_actividad_extra,mpf,idmat,hrs_actividades_extras.descripcion');

            $datos_materias=array();

            foreach($materias as $materia)
            {
                $t_hrs=$t_hrs+$materia->totales;
                $nombrem['id_materia']=$materia->idmat;
                $nombrem['nombre_materia']=$materia->nombre;
                $nombrem['hrs_practica']=$materia->P;
                $nombrem['hrs_teoria']=$materia->T;

                if($materia->idmat <20000)
                {
                    $grupos=DB::select('select DISTINCT gnral_horas_profesores.grupo 
                            FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
                            gnral_periodo_carreras,gnral_periodos,hrs_rhps,gnral_carreras
                            WHERE
                            gnral_materias_perfiles.id_materia_perfil='.$materia->mpf.' AND
                            gnral_periodos.id_periodo='.$id_periodo.' AND
                            gnral_carreras.id_carrera='.$id_carrera.' AND 
                            gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                            gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                            gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera');
                    $no_grupos=count($grupos);
                    $t_lic=$no_grupos*$materia->totales;
                }
                else
                {
                    $hrs_extra=DB::selectOne('select COUNT(hrs_horario_extra_clase.id_hr_extra)T from hrs_horario_extra_clase,
                            gnral_horarios,hrs_extra_clase,hrs_act_extra_clases,gnral_periodo_carreras,gnral_carreras,gnral_periodos
                            ,hrs_actividades_extras WHERE 
                            gnral_periodos.id_periodo='.$id_periodo.' AND 
                            gnral_carreras.id_carrera='.$id_carrera.' AND 
                            hrs_actividades_extras.id_hrs_actividad_extra='.$materia->mpf.' AND 
                            gnral_horarios.id_personal='.$docente->id_personal.' AND 
                            gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND 
                            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND 
                            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND 
                            hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND 
                            hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase AND 
                            hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                            hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra ');
                    $hrs_extra=($hrs_extra->T);
                    $materia->T=$hrs_extra;

                    $grupos=DB::select('select DISTINCT hrs_extra_clase.grupo
                            FROM hrs_act_extra_clases,hrs_extra_clase,
                            gnral_periodo_carreras,gnral_periodos,gnral_horarios,hrs_actividades_extras
                            WHERE
                            hrs_actividades_extras.id_hrs_actividad_extra='.$materia->mpf.' AND
                            gnral_periodo_carreras.id_periodo='.$id_periodo.' AND
                            gnral_horarios.id_personal='.$docente->id_personal.' AND
                            gnral_periodo_carreras.id_carrera='.$id_carrera.' AND
                            gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                            gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                            hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                            hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                            hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra');
                    $no_grupos=count($grupos);
                    $t_lic=$no_grupos*$hrs_extra;
                }
                $nombrem['no_grupos']=$no_grupos;
                $nombrem['t_lic']=$t_lic;

                array_push($datos_materias,$nombrem);
                $t_nombra=$t_nombra+$docente->horas_maxima;
                $total_lic=$total_lic+$t_lic;
            }
            $nombre["materias"]=$datos_materias;

            $casoc=DB::selectOne('select DISTINCT hrs_personal_docentes.caso
                    FROM hrs_personal_docentes 
                    WHERE hrs_personal_docentes.id_horario='.$docente->id_horario_profesor.'');

            $causac=DB::selectOne('select hrs_personal_docentes.id_caso_factibilidad id,
                hrs_casos_factibilidades.descripcion from hrs_personal_docentes,hrs_casos_factibilidades where 
                hrs_personal_docentes.id_horario='.$docente->id_horario_profesor.' AND 
                hrs_personal_docentes.id_caso_factibilidad=hrs_casos_factibilidades.id_caso UNION 
                select hrs_personal_docentes.id_caso_factibilidad,"0" descripcion from 
                hrs_personal_docentes where hrs_personal_docentes.id_horario='.$docente->id_horario_profesor.' AND 
                hrs_personal_docentes.id_caso_factibilidad not IN (SELECT id_caso from hrs_casos_factibilidades)');

            if($casoc->caso==0)
                $casoc=" ";
            else
                $casoc=($casoc->caso);

            if($causac->id==0)
                $causac=" ";
            else
                $causac=$causac->descripcion;

            if($docente->id_cargo==1 || $docente->id_cargo==7)
            {
                $nombre['codigo']='E13010';
            }
            else if($docente->id_cargo==2)
            {
                $nombre['codigo']='E13003';
            }
            else if($docente->id_cargo==3)
            {
                $nombre['codigo']='E13001';
            }
            else if($docente->id_cargo==5 || $docente->id_cargo==6)
            {
                $nombre['codigo']='DIRAD';
            }
            else if($docente->id_cargo==9)
            {
                $nombre['codigo']='TITUA';
            }
            else if($docente->id_cargo==11)
            {
                $nombre['codigo']='E13012';
            }


            $nombre['clave']= $docente->clave;
            $nombre['nombramiento']= $docente->nombramiento;
            $nombre['fecha_ingreso']= $docente->fch_ingreso_tesvb;
            $nombre['nombre']= $docente->nombre;
            $nombre['hrs_max']= $docente->horas_maxima;
            $nombre['escolaridad']= $docente->abrevia;
            $nombre['caso']= $casoc;
            $nombre['causa']= $causac;
            $nombre['id_horario']= $docente->id_horario_profesor;
            array_push($datos_docente,$nombre);
        }
        //dd($datos_docente);
        return view('formatos.partials.relacion_admin',compact(
            'periodo','docentes','ncarrera','t_nombra','t_hrs','total_lic'))->with(['docentes' => $datos_docente]);
    }
}
