<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;

class Reporte_Docentes_ComentariosController extends Controller
{
    public function index($id_docente)
    {
        $periodo = Session::get('periodo_actual');
        $docentes = DB::select("SELECT DISTINCT gnral_personales.nombre, gnral_personales.id_personal
        FROM gnral_personales
        JOIN gnral_horarios ON gnral_horarios.id_personal = gnral_personales.id_personal
        JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
        JOIN gnral_periodos ON gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
        JOIN gnral_carreras ON gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
        JOIN gnral_horas_profesores ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
        WHERE gnral_periodos.id_periodo = ?
        AND gnral_personales.id_personal = ?", [$periodo, $id_docente]);

        //dd($docentes);

        $datos = (explode(',', $id_docente));
        $id_hrs = $datos[0];
        //dd($id_hrs);
        $id_docente = $datos[0];/////para consultar con id_hrs_pro
        $carreras = DB::select('SELECT DISTINCT (gnral_carreras.nombre) carrera,gnral_carreras.id_carrera
                      FROM gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                      WHERE gnral_periodos.id_periodo= ?
                      AND gnral_horarios.id_personal= ?
                      AND gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                      AND gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                      AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                      AND gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                      AND gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                      AND gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                      AND gnral_horarios.id_personal=gnral_personales.id_personal
                      AND gnral_materias.id_semestre=gnral_semestres.id_semestre', [$periodo, $id_docente]);

        $dat_mat = DB::Select('SELECT id_materia FROM gnral_materias WHERE id_materia = id_materia');
        //dd($dat_mat);
        // Acceder al primer valor de cuenta:
        // Obtener todos los valores de cuenta en un array:
        $id_materia = array_map(function ($item) {
            return $item->id_materia;  // Extrae solo los valores de cuenta
        }, $dat_mat);
        //dd($id_materia);
        $semestres = DB::Select('SELECT DISTINCT gnral_materias.id_materia,gnral_materias.nombre AS materia,gnral_semestres.id_semestre,
    gnral_semestres.descripcion AS semestre,gnral_carreras.id_carrera,gnral_carreras.nombre AS carrera,gnral_personales.nombre AS profesor,
    GROUP_CONCAT(gnral_grupos.grupo ORDER BY gnral_grupos.grupo ASC) AS grupos
FROM     gnral_materias
INNER JOIN gnral_semestres ON gnral_materias.id_semestre = gnral_semestres.id_semestre
INNER JOIN gnral_materias_perfiles ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
INNER JOIN gnral_horas_profesores ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
INNER JOIN gnral_horarios ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
INNER JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
INNER JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
INNER JOIN gnral_periodos ON gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
INNER JOIN gnral_carreras ON gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
INNER JOIN gnral_grupos  ON gnral_horas_profesores.grupo = gnral_grupos.id_grupo
WHERE   gnral_personales.id_personal = ?
    AND gnral_periodos.id_periodo = ?
GROUP BY
    gnral_semestres.descripcion,
    gnral_materias.nombre
ORDER BY
    gnral_semestres.descripcion DESC,
    gnral_materias.nombre DESC;', [$id_hrs, $periodo]);
        //dd($semestres);



       $grupos =DB::Select('SELECT DISTINCT gnral_materias.id_materia,gnral_materias.nombre AS materia,gnral_semestres.id_semestre,
    gnral_semestres.descripcion AS semestre,gnral_carreras.id_carrera,gnral_carreras.nombre AS carrera,gnral_personales.nombre AS profesor,gnral_personales.id_personal,
    gnral_grupos.id_grupo,gnral_grupos.grupo
FROM     gnral_materias
INNER JOIN gnral_semestres ON gnral_materias.id_semestre = gnral_semestres.id_semestre
INNER JOIN gnral_materias_perfiles ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
INNER JOIN gnral_horas_profesores ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
INNER JOIN gnral_horarios ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
INNER JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
INNER JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
INNER JOIN gnral_periodos ON gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
INNER JOIN gnral_carreras ON gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
INNER JOIN gnral_grupos  ON gnral_horas_profesores.grupo = gnral_grupos.id_grupo
WHERE   gnral_personales.id_personal = ?
    AND gnral_periodos.id_periodo = ?
ORDER BY
    gnral_semestres.id_semestre ASC,
    gnral_materias.nombre ASC', [$id_hrs, $periodo]);
        //dd($grupos);
        $datos_grupos = array();

        foreach ($grupos as $grupo) {
            // Cambié la clave 'nombre' de carrera para evitar la sobrescritura
            $dat = [
                'id_materia' => $grupo->id_materia,
                'materia' => $grupo->materia, // Nombre de la materia
                'id_semestre' => $grupo->id_semestre,
                'semestre' => $grupo->semestre, // Descripción del semestre
                'id_carrera' => $grupo->id_carrera,
                'carrera' => $grupo->carrera, // Nombre de la carrera
                'id_personal' => $grupo->id_personal,
                'id_grupo' => $grupo->id_grupo,
                'grupo' => $grupo->grupo,
            ];
            array_push($datos_grupos, $dat);
        }

        // Filtrar solo los grupos correspondientes al semestre y materia
        $datos_grupos_filtrados = array_filter($datos_grupos, function($grupo) use ($periodo, $id_materia) {
            return $grupo['id_semestre'] == $periodo && in_array($grupo['id_materia'], $id_materia);
        });


        //dd($datos_grupos);
        return view('evaluacion_docente.Admin.reporte_comentario_docente', compact('docentes', 'id_docente','id_materia',
            'carreras', 'semestres','grupos','datos_grupos','datos_grupos_filtrados'));
    }

    public function ver_grupos($id_docente,$id_grupo,$grupo,$id_materia)
    {
        $periodo = Session::get('periodo_actual');
        $profesores = DB::select("SELECT DISTINCT gnral_personales.nombre, gnral_personales.id_personal
        FROM gnral_personales
        JOIN gnral_horarios ON gnral_horarios.id_personal = gnral_personales.id_personal
        JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
        JOIN gnral_periodos ON gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
        JOIN gnral_carreras ON gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
        JOIN gnral_horas_profesores ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
        WHERE gnral_periodos.id_periodo = ?
        AND gnral_personales.id_personal = ?", [$periodo, $id_docente]);

        //dd($profesores);

        $datos_profesores = (explode(',', $id_docente));
        $id_hrs = $datos_profesores[0];
        //dd($id_hrs);
        $id_docente = $datos_profesores[0];/////para consultar con id_hrs_pro
        $datos_materias = DB::Select('SELECT gnral_materias.id_materia, gnral_materias.nombre FROM gnral_materias WHERE gnral_materias.id_materia = gnral_materias.id_materia');
        //dd($datos_materias);
        // Acceder al primer valor de cuenta:
        // Obtener todos los valores de cuenta en un array:
        $materias = array_map(function ($item) {
            return $item->id_materia;// Extrae solo los valores de cuenta
        }, $datos_materias);
        //dd($dat_mat);

        $datos_semestres = DB::Select('SELECT DISTINCT
                gnral_materias.id_materia,
                gnral_materias.nombre AS materia,
                gnral_semestres.id_semestre,
                gnral_semestres.descripcion AS semestre,
                gnral_carreras.id_carrera,
                gnral_carreras.nombre AS carrera,
                gnral_personales.nombre AS profesor,
                gnral_grupos.id_grupo,
                gnral_grupos.grupo
        FROM gnral_semestres,gnral_materias,gnral_grupos,gnral_horarios,gnral_horas_profesores,gnral_periodo_carreras,gnral_materias_perfiles,
             gnral_periodos,gnral_carreras,gnral_personales
        WHERE gnral_materias.id_semestre = gnral_semestres.id_semestre
        AND gnral_periodos.id_periodo= ?
        AND gnral_horarios.id_personal=gnral_personales.id_personal
        AND gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
        AND gnral_periodo_carreras.id_carrera= gnral_carreras.id_carrera
        AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
        AND gnral_materias_perfiles.id_materia=gnral_materias.id_materia
        AND gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
        AND gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
        AND gnral_personales.id_personal = ?
        AND gnral_carreras.id_carrera = gnral_carreras.id_carrera
        AND gnral_horas_profesores.grupo = gnral_grupos.id_grupo
        GROUP BY gnral_semestres.id_semestre ASC, gnral_materias.nombre ASC', [$periodo, $id_hrs]);

        //dd($datos_semestres);

        $grupos_materias = Collect(DB::Select('SELECT DISTINCT gnral_materias.id_materia,gnral_materias.nombre AS materia,gnral_semestres.id_semestre,
    gnral_semestres.descripcion AS semestre,gnral_carreras.id_carrera,gnral_carreras.nombre AS carrera,gnral_personales.nombre AS profesor,gnral_personales.id_personal,
    gnral_grupos.id_grupo,gnral_grupos.grupo
FROM     gnral_materias
INNER JOIN gnral_semestres ON gnral_materias.id_semestre = gnral_semestres.id_semestre
INNER JOIN gnral_materias_perfiles ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
INNER JOIN gnral_horas_profesores ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
INNER JOIN gnral_horarios ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
INNER JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
INNER JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
INNER JOIN gnral_periodos ON gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
INNER JOIN gnral_carreras ON gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
INNER JOIN gnral_grupos  ON gnral_horas_profesores.grupo = gnral_grupos.id_grupo
WHERE   gnral_personales.id_personal = ?
    AND gnral_periodos.id_periodo = ?
    AND gnral_materias.id_materia = ?
    AND gnral_grupos.id_grupo = ?
ORDER BY
    gnral_semestres.id_semestre ASC,
    gnral_materias.nombre ASC', [$id_hrs, $periodo, $id_materia, $id_grupo]));

       $eva_comentarios = DB::Select('SELECT DISTINCT
    hrs_rhps.id_hrs_profesor,
    gnral_personales.id_personal AS indice,
    gnral_personales.nombre AS p,
    gnral_materias.id_materia,
    gnral_materias.nombre AS ma,
    gnral_grupos.id_grupo,
    gnral_grupos.grupo,
    eva_alumno_materias.id_alumno_materia,
    COALESCE(eva_docente_comentarios.comentario, \'SIN COMENTARIO\') as comentario,
    gnral_semestres.id_semestre
FROM eva_alumno_materias
INNER JOIN hrs_rhps ON eva_alumno_materias.id_hrs_profesor = hrs_rhps.id_hrs_profesor
INNER JOIN gnral_horas_profesores ON hrs_rhps.id_hrs_profesor = gnral_horas_profesores.id_hrs_profesor
INNER JOIN gnral_horarios ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
INNER JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
INNER JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
INNER JOIN gnral_materias_perfiles ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
INNER JOIN gnral_materias ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
INNER JOIN gnral_grupos ON gnral_horas_profesores.grupo = gnral_grupos.id_grupo
LEFT JOIN eva_docente_comentarios ON eva_alumno_materias.id_alumno_materia = eva_docente_comentarios.id_alumno_materia
INNER JOIN gnral_semestres ON gnral_materias.id_semestre = gnral_semestres.id_semestre
WHERE gnral_periodo_carreras.id_periodo = ?
  AND gnral_personales.id_personal = ?
  AND gnral_materias.id_materia = ?
  AND gnral_grupos.id_grupo = ?
GROUP BY
    hrs_rhps.id_hrs_profesor,
    gnral_personales.id_personal,
    gnral_personales.nombre,
    gnral_materias.id_materia,
    gnral_materias.nombre,
    gnral_grupos.id_grupo,
    gnral_grupos.grupo,
    eva_alumno_materias.id_alumno_materia,
    eva_docente_comentarios.comentario,
    gnral_semestres.id_semestre
ORDER BY
    hrs_rhps.id_hrs_profesor,
    gnral_personales.nombre,
    gnral_materias.nombre,
    gnral_grupos.grupo', [$periodo, $id_hrs, $id_materia, $id_grupo]);

       //dd($eva_comentarios);

        return view('evaluacion_docente.Admin.ver_comentarios_eva_doc',
            compact('profesores','id_docente','id_grupo','grupo','periodo','grupos_materias','eva_comentarios','datos_materias','datos_semestres'));
    }
}
