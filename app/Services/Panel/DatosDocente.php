<?php

namespace App\Services\Panel;

use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el DOCENTE (sesión "profesor_sinact" o "profesor_conact": tipo_usuario 2 y
 * gnral_personales.id_departamento 0, HomeController.php:411-527). Ver docs/DASHBOARD_DOCENTE.md.
 *
 * TODO es del docente de la sesión (session('id_perso'), nunca un id de la URL ni el correo) y del PERIODO seleccionado,
 * con el id_personal SIEMPRE dentro del WHERE: nunca se leen datos de otros docentes. Caché por docente y periodo
 * (panel:docente:{id_personal}:periodo:{id_periodo}).
 *
 * Relación con sus datos (las mismas que usan sus módulos, DocentesAgController@carreras / @calificarunidad):
 *  gnral_horarios (id_personal, id_periodo_carrera) → gnral_horas_profesores (grupo, materia) → hrs_rhps (horario);
 *  sus alumnos: eva_carga_academica con la misma materia, grupo y periodo (id_status_materia = 1);
 *  calificaciones por unidad: cal_evaluaciones; evaluación docente: eva_alumno_materias (+ no_pregunta, igual que
 *  DatosConsultas); tutoría: exp_asigna_tutor → exp_asigna_generacion → gnral_jefes_periodos (mismo criterio que el
 *  sidebar para PIASE, con el periodo seleccionado).
 *
 * El horario se guarda completo (por día) y "hoy" se filtra al mostrar (conHoy()), para que no quede fijo en la caché.
 * NUNCA se seleccionan nombres ni cuentas de alumnos ni calificaciones por alumno: solo conteos y promedios por
 * materia-grupo y catálogos (materia, carrera, aula). Si algo falla, null.
 */
class DatosDocente
{
    public const MINUTOS_CACHE = 10;

    public const APROBATORIA = 70;

    /** Estados de carga aceptada (DatosDirectivo::VALIDACION_INSCRITO), para los tutorados con carga. */
    public const CARGA_ACEPTADA = [2, 8, 9];

    public const CASO_CERRADO = 'cerrado';

    /**
     * Zona horaria del TESVB (Valle de Bravo) solo para saber qué día es "hoy". La aplicación está en UTC
     * (config/app.php, sin cambios): después de las 18:00 hora local, now() ya marcaría el día siguiente.
     */
    public const ZONA_HORARIA = 'America/Mexico_City';

    /** Nombres de hrs_semanas.dia por día ISO (1 = lunes). */
    public const DIAS = [1 => 'LUNES', 2 => 'MARTES', 3 => 'MIÉRCOLES', 4 => 'JUEVES', 5 => 'VIERNES', 6 => 'SÁBADO', 7 => 'DOMINGO'];

    public function __construct(private readonly int $idPersonal, private readonly int $idPeriodo)
    {
    }

    /** Datos del dashboard del docente para un periodo (caché de 10 minutos por docente y periodo). */
    public static function paraDocente(int $idPersonal, int $idPeriodo): ?array
    {
        if ($idPersonal <= 0 || $idPeriodo <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:docente:' . $idPersonal . ':periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPersonal, $idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel docente: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /** Agrega lo del día (fuera de la caché): clases de hoy y su lista ordenada por hora. */
    public static function conHoy(array $tablero, ?CarbonInterface $fecha = null): array
    {
        $fecha ??= now(self::ZONA_HORARIA);
        $dia = self::DIAS[$fecha->dayOfWeekIso];
        $hoy = array_values(array_filter($tablero['horario'], fn ($b) => $b['dia'] === $dia));
        usort($hoy, fn ($a, $b) => [$a['orden'], $a['hora']] <=> [$b['orden'], $b['hora']]);

        return $tablero + ['hoy' => ['dia' => mb_convert_case($dia, MB_CASE_TITLE), 'clases' => $hoy]];
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');
        $grupos = $this->grupos();
        $alumnos = $this->alumnosDistintos();
        $horario = $this->horario();

        $porDia = [];
        foreach (array_slice(self::DIAS, 0, 6, true) as $dia) {
            $porDia[] = ['dia' => mb_convert_case($dia, MB_CASE_TITLE), 'total' => count(array_filter($horario, fn ($b) => $b['dia'] === $dia))];
        }

        $inscripciones = array_sum(array_column($grupos, 'inscripciones'));
        $esperadas = array_sum(array_column($grupos, 'esperadas'));
        $capturadas = array_sum(array_column($grupos, 'capturadas'));
        $aprobadas = array_sum(array_column($grupos, 'aprobadas'));

        return [
            'periodo' => $periodo,
            'grupos' => $grupos,
            'materias' => count(array_unique(array_column($grupos, 'id_materia'))),
            'alumnos' => $alumnos,
            'inscripciones' => $inscripciones,
            'captura' => [
                'capturadas' => $capturadas,
                'esperadas' => $esperadas,
                'porcentaje' => $esperadas > 0 ? round(min($capturadas, $esperadas) * 100 / $esperadas, 1) : null,
                'aprobadas' => $aprobadas,
                'aprobacion' => $capturadas > 0 ? round($aprobadas * 100 / $capturadas, 1) : null,
            ],
            'horario' => $horario,
            'por_dia' => $porDia,
            'evaluacion' => $this->evaluacion(),
            'tutoria' => $this->tutoria(),
        ];
    }

    /** Base: horarios del docente en el periodo (id_personal y periodo como parámetros). */
    private function base()
    {
        return DB::table('gnral_horarios as h')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->join('gnral_horas_profesores as hp', 'hp.id_horario_profesor', '=', 'h.id_horario_profesor')
            ->join('gnral_materias_perfiles as mp', 'mp.id_materia_perfil', '=', 'hp.id_materia_perfil')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'mp.id_materia')
            ->where('h.id_personal', $this->idPersonal)
            ->where('pc.id_periodo', $this->idPeriodo);
    }

    /** Materias-grupo del docente con conteos de alumnos y de calificaciones por unidad (sin datos por alumno). */
    private function grupos(): array
    {
        $grupos = $this->base()
            ->leftJoin('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
            ->orderBy('m.nombre')->orderBy('hp.grupo')
            ->get(['hp.id_hrs_profesor', 'hp.grupo', 'm.id_materia', 'm.nombre as materia', 'm.unidades', 'c.siglas'])
            ->unique('id_hrs_profesor');

        $conteos = $this->base()
            ->join('eva_carga_academica as ca', function ($j) {
                $j->on('ca.id_materia', '=', 'mp.id_materia')
                    ->on('ca.grupo', '=', 'hp.grupo')
                    ->on('ca.id_periodo', '=', 'pc.id_periodo')
                    ->where('ca.id_status_materia', '=', 1);
            })
            ->leftJoin('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->groupBy('hp.id_hrs_profesor')
            ->selectRaw('hp.id_hrs_profesor, COUNT(DISTINCT ca.id_carga_academica) as inscripciones, COUNT(ev.id_evaluacion) as capturadas,
                SUM(CASE WHEN ev.calificacion >= ? THEN 1 ELSE 0 END) as aprobadas, AVG(ev.calificacion) as promedio', [self::APROBATORIA])
            ->get()
            ->keyBy('id_hrs_profesor');

        $resultado = [];
        foreach ($grupos as $g) {
            $c = $conteos[$g->id_hrs_profesor] ?? null;
            $inscripciones = (int) ($c->inscripciones ?? 0);
            $resultado[] = [
                'id_materia' => (int) $g->id_materia,
                'materia' => (string) $g->materia,
                'carrera' => (string) ($g->siglas ?? ''),
                'grupo' => (string) $g->grupo,
                'unidades' => (int) $g->unidades,
                'inscripciones' => $inscripciones,
                'esperadas' => $inscripciones * (int) $g->unidades,
                'capturadas' => (int) ($c->capturadas ?? 0),
                'aprobadas' => (int) ($c->aprobadas ?? 0),
                'promedio' => ($c->promedio ?? null) === null ? null : round((float) $c->promedio, 1),
            ];
        }

        return $resultado;
    }

    /** Alumnos distintos inscritos en sus grupos. */
    private function alumnosDistintos(): int
    {
        return (int) $this->base()
            ->join('eva_carga_academica as ca', function ($j) {
                $j->on('ca.id_materia', '=', 'mp.id_materia')
                    ->on('ca.grupo', '=', 'hp.grupo')
                    ->on('ca.id_periodo', '=', 'pc.id_periodo')
                    ->where('ca.id_status_materia', '=', 1);
            })
            ->distinct()
            ->count('ca.id_alumno');
    }

    /** Bloques de clase de la semana: día, hora, materia, grupo y aula (catálogos; sin alumnos). */
    private function horario(): array
    {
        return $this->base()
            ->join('hrs_rhps as r', 'r.id_hrs_profesor', '=', 'hp.id_hrs_profesor')
            ->join('hrs_semanas as s', 's.id_semana', '=', 'r.id_semana')
            ->leftJoin('hrs_aulas as a', 'a.id_aula', '=', 'r.id_aula')
            ->orderBy('s.id_semana')
            ->get(['s.id_semana', 's.dia', 's.hora', 'm.nombre as materia', 'hp.grupo', 'a.nombre as aula'])
            ->map(fn ($b) => [
                'dia' => mb_strtoupper(trim((string) $b->dia)),
                'hora' => (string) $b->hora,
                'orden' => (int) $b->id_semana,
                'materia' => (string) $b->materia,
                'grupo' => (string) $b->grupo,
                'aula' => (string) ($b->aula ?? ''),
            ])
            ->all();
    }

    /** Alumnos que deben evaluarlo y cuántos ya terminaron (no_pregunta = preguntas + 1, igual que DatosConsultas). */
    private function evaluacion(): array
    {
        $terminada = (int) DB::table('eva_pregunta')->count() + 1;
        $fila = DB::table('eva_alumno_materias as am')
            ->join('gnral_horas_profesores as hp', 'hp.id_hrs_profesor', '=', 'am.id_hrs_profesor')
            ->join('gnral_horarios as h', 'h.id_horario_profesor', '=', 'hp.id_horario_profesor')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->join('gnral_alumnos as a', 'a.cuenta', '=', 'am.cuenta')
            ->leftJoin('eva_validacion_de_cargas as v', function ($j) {
                $j->on('v.id_alumno', '=', 'a.id_alumno')->on('v.id_periodo', '=', 'pc.id_periodo');
            })
            ->where('h.id_personal', $this->idPersonal)
            ->where('pc.id_periodo', $this->idPeriodo)
            ->selectRaw('COUNT(DISTINCT am.cuenta) as deben, COUNT(DISTINCT CASE WHEN v.no_pregunta = ? THEN am.cuenta END) as terminaron', [$terminada])
            ->first();

        return ['deben' => (int) ($fila->deben ?? 0), 'terminaron' => (int) ($fila->terminaron ?? 0)];
    }

    /** Sección de tutor: null si no es tutor en el periodo. */
    private function tutoria(): ?array
    {
        $asignaciones = DB::table('exp_asigna_tutor as t')
            ->join('exp_asigna_generacion as g', 'g.id_asigna_generacion', '=', 't.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'g.id_jefe_periodo')
            ->where('t.id_personal', $this->idPersonal)
            ->where('jp.id_periodo', $this->idPeriodo)
            ->whereNull('t.deleted_at')
            ->whereNull('g.deleted_at')
            ->get(['t.id_asigna_tutor', 't.id_asigna_generacion']);
        if ($asignaciones->isEmpty()) {
            return null;
        }
        $generaciones = $asignaciones->pluck('id_asigna_generacion')->unique()->values()->all();

        $tutorados = DB::table('exp_asigna_alumnos as al')
            ->leftJoin('eva_validacion_de_cargas as v', function ($j) {
                $j->on('v.id_alumno', '=', 'al.id_alumno')->where('v.id_periodo', '=', $this->idPeriodo);
            })
            ->whereIn('al.id_asigna_generacion', $generaciones)
            ->whereNull('al.deleted_at')
            ->selectRaw('COUNT(DISTINCT al.id_alumno) as total, COUNT(DISTINCT CASE WHEN v.estado_validacion IN ('
                . implode(', ', self::CARGA_ACEPTADA) . ') THEN al.id_alumno END) as con_carga')
            ->first();

        $casos = DB::table('ar_casos_estudiantes')
            ->where('id_periodo', $this->idPeriodo)
            ->where(fn ($q) => $q->where('id_personal_tutor', $this->idPersonal)
                ->orWhereIn('id_asigna_tutor', $asignaciones->pluck('id_asigna_tutor')->all()))
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN estado = ? THEN 1 ELSE 0 END) as cerrados', [self::CASO_CERRADO])
            ->first();

        return [
            'tutorados' => (int) ($tutorados->total ?? 0),
            'grupos' => count($generaciones),
            'con_carga' => (int) ($tutorados->con_carga ?? 0),
            'casos' => (int) ($casos->total ?? 0),
            'casos_cerrados' => (int) ($casos->cerrados ?? 0),
        ];
    }
}
