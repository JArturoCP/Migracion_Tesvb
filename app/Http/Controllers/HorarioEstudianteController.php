<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioEstudianteController extends Controller
{
    public function index(Request $request)
    {
        abort_unless((int) $request->user()->tipo_usuario === 1, 403);
        $alumno = DB::table('gnral_alumnos')->where('id_usuario', $request->user()->id)->first();
        $periodo = DB::table('gnral_periodos')
            ->whereDate('fecha_inicio', '<=', today())->whereDate('fecha_termino', '>=', today())
            ->orderByDesc('fecha_inicio')->orderByDesc('id_periodo')->first();
        $clases = collect();
        $pendientes = collect();
        $carrera = $alumno ? DB::table('gnral_carreras')->where('id_carrera', $alumno->id_carrera)->value('nombre') : null;

        if ($alumno && $periodo) {
            // La carga individual determina materia y grupo, incluso para recursamientos.
            // No se aceptan IDs de alumnos ni grupos desde la URL o desde la sesión.
            $carga = DB::table('eva_carga_academica as c')
                ->join('gnral_materias as m', 'm.id_materia', '=', 'c.id_materia')
                ->where('c.id_alumno', $alumno->id_alumno)->where('c.id_periodo', $periodo->id_periodo)
                ->select('c.id_materia', 'c.grupo', 'm.nombre')->distinct()->get();
            $clases = DB::table('eva_carga_academica as c')
                ->join('gnral_materias_perfiles as mp', 'mp.id_materia', '=', 'c.id_materia')
                ->join('gnral_horas_profesores as hp', function ($join) {
                    $join->on('hp.id_materia_perfil', '=', 'mp.id_materia_perfil')->on('hp.grupo', '=', 'c.grupo');
                })
                ->join('gnral_horarios as h', 'h.id_horario_profesor', '=', 'hp.id_horario_profesor')
                ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
                ->join('gnral_materias as m', 'm.id_materia', '=', 'c.id_materia')
                ->join('gnral_personales as p', 'p.id_personal', '=', 'h.id_personal')
                ->join('hrs_rhps as rh', 'rh.id_hrs_profesor', '=', 'hp.id_hrs_profesor')
                ->join('hrs_semanas as s', 's.id_semana', '=', 'rh.id_semana')
                ->leftJoin('hrs_aulas as a', 'a.id_aula', '=', 'rh.id_aula')
                ->where('c.id_alumno', $alumno->id_alumno)->where('c.id_periodo', $periodo->id_periodo)
                ->where('pc.id_periodo', $periodo->id_periodo)->where('pc.id_carrera', $alumno->id_carrera)
                ->select('c.id_materia', 'c.grupo', 'm.nombre as materia', 'p.nombre as docente',
                    's.dia', 's.hora', 'a.nombre as aula', 'h.aprobado')
                ->distinct()->orderBy('s.hora')->get();
            $pendientes = $carga->reject(fn ($materia) => $clases->contains(
                fn ($clase) => $clase->id_materia == $materia->id_materia && $clase->grupo == $materia->grupo
            ));
        }

        $dias = ['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO'];
        $tabla = [];
        foreach ($clases as $clase) {
            $dia = mb_strtoupper(trim($clase->dia), 'UTF-8');
            $dia = strtr($dia, ['MIERCOLES' => 'MIÉRCOLES', 'SABADO' => 'SÁBADO']);
            if (!in_array($dia, $dias, true)) { $dias[] = $dia; }
            $tabla[$clase->hora][$dia][] = $clase;
        }
        // Conserva las franjas sin clase del formato institucional y cualquier horario fuera de ellas.
        $horas = [];
        for ($hora = 7; $hora < 22; $hora++) {
            $horas[] = sprintf('%02d:00-%02d:00', $hora, $hora + 1);
        }
        $horas = array_values(array_unique(array_merge($horas, array_keys($tabla))));
        usort($horas, fn ($a, $b) => ((int) explode(':', $a)[0] * 60 + (int) substr(explode(':', $a)[1], 0, 2))
            <=> ((int) explode(':', $b)[0] * 60 + (int) substr(explode(':', $b)[1], 0, 2)));
        $materiasDocentes = $clases->unique(fn ($clase) => json_encode([$clase->id_materia, $clase->docente, $clase->grupo]))->values();
        return view('alumnos.horario', compact('alumno', 'periodo', 'carrera', 'tabla', 'dias', 'pendientes', 'horas', 'materiasDocentes'));
    }
}
