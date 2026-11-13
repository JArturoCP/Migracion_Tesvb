<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Personal;
use App\ActividadesComplementarias;
use App\EvaluacionEvidencias;
use Session;

class LiberaActividadJefeController extends Controller
{

    public function index()
    {
        $carrera = Session::get('carrera');
        //dd($carrera);
        $periodo = Session::get('periodo_actual');

        $liberacion_evaluacion_si = DB::select('Select DISTINCT actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno,
                                        CONCAT(gnral_semestres.id_semestre,"0",gnral_grupos.id_grupo) grupo,ROUND(AVG(actcomple_evaluaciones.calificacion)) promedio,abreviaciones.titulo,gnral_personales.nombre docente,actividades_complementarias.creditos,gnral_carreras.nombre carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,gnral_semestres.descripcion semestre
                                        from abreviaciones,abreviaciones_prof,actcomple_evaluaciones,gnral_periodos,gnral_alumnos,gnral_grupos,gnral_carreras,actividades_complementarias,actcomple_registros_coordinadores,actcomple_evidencias_alumno,gnral_periodo_carreras,gnral_semestres,actcomple_docente_actividad,actcomple_registro_alumnos,gnral_personales
                                        where gnral_alumnos.grupo=gnral_grupos.id_grupo
                                        and actividades_complementarias.id_actividad_comple=actcomple_docente_actividad.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registro_alumnos.id_docente_actividad
                                        and actcomple_docente_actividad.id_actividad_comple=actividades_complementarias.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registros_coordinadores.id_docente_actividad
                                        and actcomple_evaluaciones.id_evidencia_alumno=actcomple_evidencias_alumno.id_evidencia_alumno
                                        and actcomple_evidencias_alumno.id_registro_alumno=actcomple_registro_alumnos.id_registro_alumno
                                        and actcomple_registros_coordinadores.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                                        and actcomple_registro_alumnos.cuenta=gnral_alumnos.cuenta
                                        and gnral_periodos.id_periodo= ?
                                        and gnral_carreras.id_carrera= ?
                                        and actcomple_docente_actividad.id_periodo= ?
                                        and gnral_personales.id_personal=actcomple_docente_actividad.id_personal
                                        and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
                                        and abreviaciones_prof.id_personal=gnral_personales.id_personal
                                        and gnral_alumnos.id_semestre=gnral_semestres.id_semestre
                                        and actcomple_evaluaciones.estado=0
                                        group by actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.amaterno,
                                        gnral_alumnos.apaterno,gnral_semestres.id_semestre,gnral_grupos.id_grupo,gnral_personales.nombre, docente,actividades_complementarias.creditos,carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,semestre,abreviaciones.titulo
                                       ', [$periodo, $carrera, $periodo]);

        $liberacion_evaluacion_no = DB::select(' select * from (Select DISTINCT actcomple_evaluaciones.estado,actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno,
                                        CONCAT(gnral_semestres.id_semestre,"0",gnral_grupos.id_grupo) grupo,ROUND(AVG(actcomple_evaluaciones.calificacion)) promedio,abreviaciones.titulo,gnral_personales.nombre docente,actividades_complementarias.creditos,gnral_carreras.nombre carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,gnral_semestres.descripcion semestre
                                        from abreviaciones,abreviaciones_prof,actcomple_evaluaciones,gnral_periodos,gnral_alumnos,gnral_grupos,gnral_carreras,actividades_complementarias,actcomple_registros_coordinadores,actcomple_evidencias_alumno,gnral_periodo_carreras,gnral_semestres,actcomple_docente_actividad,actcomple_registro_alumnos,gnral_personales
                                        where

                                        gnral_alumnos.grupo=gnral_grupos.id_grupo
                                        and actividades_complementarias.id_actividad_comple=actcomple_docente_actividad.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registro_alumnos.id_docente_actividad
                                        and actcomple_docente_actividad.id_actividad_comple=actividades_complementarias.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registros_coordinadores.id_docente_actividad
                                        and actcomple_evaluaciones.id_evidencia_alumno=actcomple_evidencias_alumno.id_evidencia_alumno
                                        and actcomple_evidencias_alumno.id_registro_alumno=actcomple_registro_alumnos.id_registro_alumno
                                        and actcomple_registros_coordinadores.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                                        and actcomple_registro_alumnos.cuenta=gnral_alumnos.cuenta
                                        and gnral_periodos.id_periodo= ?
                                        and gnral_carreras.id_carrera= ?

                                        and actcomple_docente_actividad.id_periodo= ?

                                        and gnral_personales.id_personal=actcomple_docente_actividad.id_personal
                                        and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
                                        and abreviaciones_prof.id_personal=gnral_personales.id_personal
                                        and gnral_alumnos.id_semestre=gnral_semestres.id_semestre
                                        and actcomple_evaluaciones.estado=1
                                        group by actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.amaterno,
                                        gnral_alumnos.apaterno,gnral_semestres.id_semestre,gnral_grupos.id_grupo,gnral_personales.nombre, docente,actividades_complementarias.creditos,carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,semestre,actcomple_evaluaciones.estado,abreviaciones.titulo) as resultado where resultado.promedio >69', [$periodo, $carrera, $periodo]);


        $promedio_cero = DB::select('Select DISTINCT actcomple_evaluaciones.estado,actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno,
                                        CONCAT(gnral_semestres.id_semestre,"0",gnral_grupos.id_grupo) grupo,ROUND(AVG(actcomple_evaluaciones.calificacion)) promedio,abreviaciones.titulo,gnral_personales.nombre docente,actividades_complementarias.creditos,gnral_carreras.nombre carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,gnral_semestres.descripcion semestre
                                        from abreviaciones,abreviaciones_prof,actcomple_evaluaciones,gnral_periodos,gnral_alumnos,gnral_grupos,gnral_carreras,actividades_complementarias,actcomple_registros_coordinadores,actcomple_evidencias_alumno,gnral_periodo_carreras,gnral_semestres,actcomple_docente_actividad,actcomple_registro_alumnos,gnral_personales
                                        where gnral_alumnos.grupo=gnral_grupos.id_grupo
                                        and actividades_complementarias.id_actividad_comple=actcomple_docente_actividad.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registro_alumnos.id_docente_actividad
                                        and actcomple_docente_actividad.id_actividad_comple=actividades_complementarias.id_actividad_comple
                                        and actcomple_docente_actividad.id_docente_actividad=actcomple_registros_coordinadores.id_docente_actividad
                                        and actcomple_evaluaciones.id_evidencia_alumno=actcomple_evidencias_alumno.id_evidencia_alumno
                                        and actcomple_evidencias_alumno.id_registro_alumno=actcomple_registro_alumnos.id_registro_alumno
                                        and actcomple_registros_coordinadores.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                                        and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                                        and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                                        and actcomple_registro_alumnos.cuenta=gnral_alumnos.cuenta
                                        and gnral_periodos.id_periodo= ?
                                        and gnral_carreras.id_carrera= ?


                                        and actcomple_docente_actividad.id_periodo= ?


                                        and gnral_personales.id_personal=actcomple_docente_actividad.id_personal
                                        and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
                                        and abreviaciones_prof.id_personal=gnral_personales.id_personal
                                        and gnral_alumnos.id_semestre=gnral_semestres.id_semestre
                                        and actcomple_evaluaciones.estado=1
                                        group by actcomple_registro_alumnos.id_registro_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.amaterno,
                                        gnral_alumnos.apaterno,gnral_semestres.id_semestre,gnral_grupos.id_grupo,gnral_personales.nombre, docente,actividades_complementarias.creditos,carrera,actividades_complementarias.descripcion,actividades_complementarias.horas,
                                        actcomple_registros_coordinadores.no_evidencias,semestre,actcomple_evaluaciones.estado,abreviaciones.titulo', [$periodo, $carrera, $periodo]);

        return view('actividades_complementarias.jefatura.imprimir_constancias', compact('promedio_cero', 'liberacion_evaluacion_no', 'liberacion_evaluacion_si'));
    }

    public function constancias_si(Request $request, $arreglo)
    {
        $datoss = explode(',', $arreglo);
        $tamaño = count($datoss);
        $ciclos = $tamaño / 2;

        for ($j = $ciclos; $j < $tamaño; $j++) {

            $registro = $datoss[$j];

            DB::update("
            UPDATE actcomple_evaluaciones
            SET estado = 1
            WHERE id_evidencia_alumno IN (
                SELECT id_evidencia_alumno
                FROM actcomple_evidencias_alumno
                WHERE id_registro_alumno = ?
            )
            AND estado = 0
        ", [$registro]);

        }

        return redirect()->route('constancias.index');
    }
}
