<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;


class Hrs_plantillaExport implements FromView
{
    protected $id_carr;
    protected $id_car;
    public function __construct($id_carr,$id_car){
        $this->id_carr=$id_carr;
        $this->id_car=$id_car;

    }
    public function view():View
    {
        $id_carrera= $this->id_carr;
        $id_cargo= $this->id_car;
        $impr_cargo="";
        $impr_cargo=DB::selectOne('select cargo from gnral_cargos where id_cargo= ?', [$id_cargo]);
        $impr_cargo=($impr_cargo->cargo);


        $jefatura="";
        $jefe=DB::selectOne('select DISTINCT concat(abreviaciones.titulo," ",gnral_personales.nombre)abre from
                gnral_personales,gnral_jefes_periodos,abreviaciones,abreviaciones_prof
                where gnral_jefes_periodos.id_carrera= ? AND
                gnral_jefes_periodos.id_personal=gnral_personales.id_personal AND
                abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion AND
                abreviaciones_prof.id_personal=gnral_personales.id_personal ORDER BY gnral_personales.id_personal DESC LIMIT 1', [$id_carrera]);
        $jefe=($jefe->abre);

        $carreran=DB::selectOne('select gnral_carreras.nombre from gnral_carreras where id_carrera= ?', [$id_carrera]);
        $carreran=($carreran->nombre);

        if($id_carrera==9 || $id_carrera==11)
            $jefatura=" JEFE DE DEPARTAMENTO DE ".$carreran;
        else
            $jefatura=" JEFATURA DE LA DIVISIÓN DE ".$carreran;


        $id_periodo=Session::get('periodotrabaja');
        $periodo=DB::selectOne('select gnral_periodos.periodo from gnral_periodos where gnral_periodos.id_periodo= ?', [$id_periodo]);
        $periodo=($periodo->periodo);

        $fecha_nuevo = DB::selectOne('select gp.fecha_inicio from gnral_periodos gp WHERE gp.id_periodo= ?', [$id_periodo]);
        $fecha_nuevo=($fecha_nuevo->fecha_inicio);

        $docentes= DB::select('select DISTINCT h.id_personal, h.id_horario_profesor, p.nombre, h.aprobado,
            p.rfc, p.clave,p.fch_ingreso_tesvb,gf.descripcion
FROM gnral_horarios h, gnral_horas_profesores hp, hrs_rhps rp, gnral_personales p,gnral_perfiles gf,
gnral_periodo_carreras gpc,gnral_periodos gp,
gnral_carreras gc
WHERE rp.id_hrs_profesor = hp.id_hrs_profesor
AND hp.id_horario_profesor = h.id_horario_profesor
and p.id_personal=h.id_personal
AND gp.id_periodo= ?
AND gc.id_carrera= ?
AND rp.id_cargo = ?
AND gf.id_perfil=p.id_perfil
AND h.id_periodo_carrera=gpc.id_periodo_carrera
AND gpc.id_carrera=gc.id_carrera AND
gpc.id_periodo=gp.id_periodo
UNION
SELECT DISTINCT h.id_personal, h.id_horario_profesor, p.nombre, h.aprobado,p.rfc, p.clave,
p.fch_ingreso_tesvb,gf.descripcion
FROM gnral_horarios h, hrs_extra_clase ec, hrs_horario_extra_clase hec, gnral_personales p,gnral_perfiles gf,gnral_periodo_carreras gpc,gnral_periodos gp,
gnral_carreras gc
WHERE hec.id_extra_clase= ec.id_extra_clase
AND ec.id_horario_profesor = h.id_horario_profesor
and p.id_personal=h.id_personal
AND gp.id_periodo= ?
AND gc.id_carrera= ?
AND hec.id_cargo = ?
AND gf.id_perfil=p.id_perfil
AND h.id_periodo_carrera=gpc.id_periodo_carrera
AND gpc.id_carrera=gc.id_carrera AND
gpc.id_periodo=gp.id_periodo order by nombre ', [$id_periodo, $id_carrera, $id_cargo, $id_periodo, $id_carrera, $id_cargo]);

        $datos_docente=array();
        $total_plantilla=0;
        foreach($docentes as $docente)
        {
            $fecha_actual=date('Y/m/d');
            $fecha_periodo=$fecha_nuevo;
            $fech_ingr=$docente->fch_ingreso_tesvb;
            $año_in=date("Y", strtotime($fech_ingr));
            $mes_in=date("m", strtotime($fech_ingr));
            $mes_ac=date("m", strtotime($fecha_periodo));
            $año_ac=date("Y", strtotime($fecha_periodo));

            $nombre['nombre']= $docente->nombre;
            $nombre['id_personal']= $docente->id_personal;
            $nombre['clave']= $docente->clave;
            $nombre['descripcion']= $docente->descripcion;

            // Condición que evalúa si es un nuevo ingreso o recontractado
            if (strtolower($mes_in) == strtolower($mes_ac) && strtolower($año_in) == strtolower($año_ac) || (strtolower($año_in) >= strtolower($año_ac))) {
                $contrato = 'NUEVO INGRESO';
                // Si es nuevo ingreso, asignar la fecha de ingreso
                $nombre['fch_ingreso_tesvb'] = $docente->fch_ingreso_tesvb;  // Mostrar solo si es nuevo ingreso
            } else {
                $contrato = 'RECONTRATADO';
            }

            $nombre['fch_ingreso_tesvb']= $docente->fch_ingreso_tesvb;
            $nombre['rfc']= $docente->rfc;
            $nombre['observaciones']= $contrato;
            //dd($nombre['fch_ingreso_tesvb']);
            $nombre['nuevo_c']= $fecha_nuevo;

            $materias = DB::select('select distinct gnral_materias_perfiles.id_materia_perfil mpf,gnral_materias.id_materia idm,
            gnral_materias.nombre,gnral_materias.hrs_practicas hrs_p,gnral_materias.hrs_teoria hrs_t,
            gnral_materias.hrs_practicas totales
            FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,gnral_periodo_carreras,gnral_periodos, gnral_carreras
                                WHERE
                                gnral_materias_perfiles.id_personal= ? AND
                                gnral_carreras.id_carrera= ? AND
                                gnral_periodos.id_periodo= ? AND
                                gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                                gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                                gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                                UNION
                                SELECT distinct hrs_actividades_extras.id_hrs_actividad_extra mpf,hrs_actividades_extras.id_hrs_actividad_extra idm,
                                hrs_actividades_extras.descripcion nombre,
                                COUNT(hrs_horario_extra_clase.id_semana) hrs_p,"0" hrs_t,COUNT(hrs_horario_extra_clase.id_semana) totales FROM
                                hrs_actividades_extras,hrs_act_extra_clases,hrs_extra_clase,gnral_horarios,gnral_periodos,gnral_carreras,
                                hrs_horario_extra_clase,
                                gnral_periodo_carreras WHERE
                                gnral_carreras.id_carrera= ? AND
                                gnral_periodos.id_periodo= ? AND
                                gnral_horarios.id_personal= ? AND
                                gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                                gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                                gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera AND
                                hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                                hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                                hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra AND
                                hrs_horario_extra_clase.id_extra_clase=hrs_extra_clase.id_extra_clase
                                GROUP BY hrs_act_extra_clases.id_hrs_actividad_extra,mpf,idm,hrs_actividades_extras.descripcion', [$docente->id_personal, $id_carrera, $id_periodo, $id_carrera, $id_periodo, $docente->id_personal]);

            $nombre_materias=array();

            $cuenta=count($materias);
            for ($i=0; $i < $cuenta; $i++)
            {
                $materias[$i]->totales=($materias[$i]->hrs_p+$materias[$i]->hrs_t);
            }

            $f_total=0;
            foreach($materias as $materia)
            {
                $idmateria=$materia->idm;
                if($idmateria<20000)
                {
                    $grupos=DB::select('select DISTINCT gnral_horas_profesores.grupo
                    FROM gnral_materias_perfiles,gnral_materias,gnral_horarios,gnral_horas_profesores,
                    gnral_periodo_carreras,gnral_periodos
                    WHERE
                    gnral_materias_perfiles.id_materia_perfil= ? AND
                    gnral_periodo_carreras.id_periodo= ? AND
                    gnral_periodo_carreras.id_carrera= ? AND
                    gnral_materias_perfiles.id_materia=gnral_materias.id_materia AND
                    gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND
                    gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                    gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                    gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo', [$materia->mpf, $id_periodo, $id_carrera]);

                    $no_grupos=count($grupos);
                    $total=$no_grupos*$materia->totales;
                }
                else
                {
                    $grupos=DB::select('select DISTINCT hrs_extra_clase.grupo
                    FROM hrs_act_extra_clases,hrs_extra_clase,
                    gnral_periodo_carreras,gnral_periodos,gnral_horarios,hrs_actividades_extras,hrs_horario_extra_clase
                    WHERE
                    hrs_actividades_extras.id_hrs_actividad_extra= ? AND
                    gnral_periodo_carreras.id_periodo= ? AND
                    gnral_horarios.id_personal= ? AND
                    gnral_periodo_carreras.id_carrera= ? AND
                    gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera AND
                    gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo AND
                    hrs_extra_clase.id_act_extra_clase=hrs_act_extra_clases.id_act_extra_clase AND
                    hrs_extra_clase.id_horario_profesor=gnral_horarios.id_horario_profesor AND
                    hrs_act_extra_clases.id_hrs_actividad_extra=hrs_actividades_extras.id_hrs_actividad_extra
                    and hrs_horario_extra_clase.id_extra_clase = hrs_extra_clase.id_extra_clase', [$materia->mpf, $id_periodo, $docente->id_personal, $id_carrera]);

                    $total=$materia->hrs_p;

                    if($idmateria==20001 || $idmateria==20003 || $idmateria==20006 || $idmateria==20005)
                    {
                        $no_grupos="N.A";
                    }
                    else
                    {
                        $no_grupos=count($grupos);
                    }
                }
                $f_total=$f_total+$total;
                $nombrem['nombre_materia']= $materia->nombre;
                $nombrem['id_materia']= $materia->idm;
                $nombrem['id_materia_perfil']= $materia->mpf;
                $nombrem['no_grupos']=$no_grupos;
                if($idmateria == 20002){
                    $nombrem['horas_totales']=2;
                }else{
                    $nombrem['horas_totales']=$materia->totales;
                }

                $nombrem['total']=$total;
                array_push($nombre_materias, $nombrem);
            }//foreach de materias
            $nombre['f_total']=$f_total;
            $nombre['materias']=$nombre_materias;
            array_push($datos_docente,$nombre);
            $total_plantilla=$total_plantilla+$f_total;
        }

        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
        return view('plantilla.partialsh.plantilla',compact('periodo','impr_cargo','fecha_nuevo','total_plantilla','jefatura','jefe','etiqueta'))->with(['docentes' => $datos_docente]);

    }

}
