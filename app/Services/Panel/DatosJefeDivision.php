<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil JEFE DE DIVISIÓN (sesión "jefe_division" sin "desa": tipo_usuario 2 y
 * gnral_personales.id_departamento 2, HomeController.php:543-587). Ver docs/DASHBOARD_JEFE_DIVISION.md.
 *
 * TODO se filtra por UNA carrera (la de session('carrera'), la misma que usan los módulos del jefe) y el PERIODO
 * seleccionado, con la carrera SIEMPRE dentro del WHERE: nunca se calculan ni se cargan datos de otras divisiones.
 * Antes de consultar, el composer valida con carreraPermitida() que esa carrera sea del jefe en gnral_jefes_periodos
 * (por id_personal de la sesión, nunca por correo): /recarga_personal/{id} cambia la carrera de la sesión sin validar.
 * La caché va por carrera y periodo (panel:jefe:carrera:{c}:periodo:{p}), así dos jefes de carreras distintas nunca
 * comparten datos.
 *
 * Reglas (mismas que las pantallas y los dashboards existentes, con la carrera en el WHERE):
 *  - Inscritos: carga aceptada (DatosDirectivo::VALIDACION_INSCRITO), alumnos distintos.
 *  - Docentes y horas: gnral_horarios / hrs_rhps de la carrera (misma regla que DatosConsultas).
 *  - Aprobación: cargas sin unidades < 70 (misma subconsulta que DatosDirectivo, VALIDACION_REPROBACION).
 *  - Residencia (Asignar Revisores, Resi_Jefes_residenciaController): revisores de la carrera; la pantalla pide 3.
 *    Residentes: anteproyecto con estado_enviado 3 y asesor en el periodo.
 *  - Complementarias (SolicitudAlumnosJefeController, LiberaPlaneacionJefeController): solicitudes de alumnos con
 *    liberacion 0 / 1 y planeaciones docentes con estado_evidencias 1 (por liberar) / 2 (liberadas).
 *  - Tutorías: tutores y grupos de la carrera en el periodo (gnral_jefes_periodos).
 *
 * NUNCA se seleccionan nombres, cuentas, calificaciones individuales ni resultados de la evaluación de un docente:
 * solo conteos. Si algo falla, null.
 */
class DatosJefeDivision
{
    public const MINUTOS_CACHE = 10;

    public const PERIODOS_HISTORICO = 6;

    /** Revisores de residencia que pide la pantalla "Asignar Revisores". */
    public const REVISORES_REQUERIDOS = 3;

    public const ANTEPROYECTO_AUTORIZADO = 3;

    public const PLANEACION_POR_LIBERAR = 1;

    public const PLANEACION_LIBERADA = 2;

    public function __construct(private readonly int $idCarrera, private readonly int $idPeriodo)
    {
    }

    /** ¿La carrera es (o fue) del jefe según gnral_jefes_periodos? Sin caché: una consulta indexada. */
    public static function carreraPermitida(?int $idPersonal, ?int $idCarrera): bool
    {
        if (! $idPersonal || ! $idCarrera) {
            return false;
        }

        try {
            return DB::table('gnral_jefes_periodos')
                ->where('id_personal', $idPersonal)
                ->where('id_carrera', $idCarrera)
                ->exists();
        } catch (\Throwable $e) {
            Log::warning('Panel jefe de división: no se pudo validar la carrera', ['error' => $e->getMessage()]);

            return false;
        }
    }

    /** Datos del dashboard para una carrera y un periodo (con caché de 10 minutos por carrera y periodo). */
    public static function paraCarrera(int $idCarrera, int $idPeriodo): ?array
    {
        if ($idCarrera <= 0 || $idPeriodo <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:jefe:carrera:' . $idCarrera . ':periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idCarrera, $idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel jefe de división: no se pudieron calcular los datos del dashboard', [
                'carrera' => $idCarrera,
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');
        $carrera = DB::table('gnral_carreras')->where('id_carrera', $this->idCarrera)->first(['siglas', 'nombre']);

        $semestres = $this->inscritosPorSemestre();
        $aprobacion = $this->aprobacion();
        $revisores = (int) DB::table('resi_revisores')
            ->where('id_carrera', $this->idCarrera)->where('id_periodo', $this->idPeriodo)->count();

        return [
            'carrera' => ['id' => $this->idCarrera, 'siglas' => (string) ($carrera->siglas ?? ''), 'nombre' => (string) ($carrera->nombre ?? '')],
            'periodo' => $periodo,
            'inscritos' => $this->inscritos($this->idPeriodo),
            'docentes' => $this->docentes($this->idPeriodo),
            'horas' => $this->horas(),
            'aprobacion' => $aprobacion,
            'revisores' => ['asignados' => $revisores, 'requeridos' => self::REVISORES_REQUERIDOS],
            'residentes' => $this->residentes(),
            'solicitudes' => $this->solicitudesComplementarias(),
            'planeaciones' => $this->planeaciones(),
            'tutorias' => $this->tutorias(),
            'semestres' => $semestres,
            'historico' => $this->historico(),
        ];
    }

    /** Alumnos distintos de la carrera con carga aceptada en el periodo. */
    private function inscritos(int $idPeriodo): int
    {
        return (int) DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->where('v.id_periodo', $idPeriodo)
            ->whereIn('v.estado_validacion', DatosDirectivo::VALIDACION_INSCRITO)
            ->where('a.id_carrera', $this->idCarrera)
            ->distinct()
            ->count('v.id_alumno');
    }

    private function inscritosPorSemestre(): array
    {
        return DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', DatosDirectivo::VALIDACION_INSCRITO)
            ->where('a.id_carrera', $this->idCarrera)
            ->whereNotNull('a.id_semestre')
            ->groupBy('a.id_semestre')
            ->orderBy('a.id_semestre')
            ->selectRaw('a.id_semestre, COUNT(DISTINCT v.id_alumno) as total')
            ->get()
            ->map(fn ($f) => ['semestre' => (int) $f->id_semestre . '.º', 'total' => (int) $f->total])
            ->all();
    }

    /** Docentes distintos con horario en la carrera y el periodo. */
    private function docentes(int $idPeriodo): int
    {
        return (int) DB::table('gnral_horarios as h')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->where('pc.id_periodo', $idPeriodo)
            ->where('pc.id_carrera', $this->idCarrera)
            ->distinct()
            ->count('h.id_personal');
    }

    /** Bloques de clase (hrs_rhps) de los horarios de la carrera en el periodo. */
    private function horas(): int
    {
        return (int) DB::table('hrs_rhps as r')
            ->join('gnral_horas_profesores as hp', 'hp.id_hrs_profesor', '=', 'r.id_hrs_profesor')
            ->join('gnral_horarios as h', 'h.id_horario_profesor', '=', 'hp.id_horario_profesor')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->where('pc.id_periodo', $this->idPeriodo)
            ->where('pc.id_carrera', $this->idCarrera)
            ->count('r.id_rhps');
    }

    /** Cargas del periodo y cuántas sin unidades reprobadas (misma subconsulta que DatosDirectivo, solo esta carrera). */
    private function aprobacion(): array
    {
        $estados = DatosDirectivo::VALIDACION_REPROBACION;
        $fila = DB::selectOne(
            'SELECT COUNT(*) AS cargas, SUM(CASE WHEN t.reprobadas = 0 THEN 1 ELSE 0 END) AS aprobadas
               FROM (SELECT ca.id_carga_academica,
                            COALESCE(SUM(CASE WHEN ev.calificacion < 70 THEN 1 ELSE 0 END), 0) AS reprobadas
                       FROM eva_carga_academica ca
                       JOIN gnral_alumnos a ON a.id_alumno = ca.id_alumno AND a.id_carrera = ?
                       JOIN eva_validacion_de_cargas v
                         ON v.id_alumno = ca.id_alumno
                        AND v.id_periodo = ca.id_periodo
                        AND v.estado_validacion IN (' . implode(', ', array_fill(0, count($estados), '?')) . ')
                       LEFT JOIN cal_evaluaciones ev ON ev.id_carga_academica = ca.id_carga_academica
                      WHERE ca.id_periodo = ?
                        AND ca.id_status_materia = 1
                      GROUP BY ca.id_carga_academica) t',
            array_merge([$this->idCarrera], $estados, [$this->idPeriodo])
        );
        $cargas = (int) ($fila->cargas ?? 0);
        $aprobadas = (int) ($fila->aprobadas ?? 0);

        return [
            'cargas' => $cargas,
            'aprobadas' => $aprobadas,
            'reprobadas' => $cargas - $aprobadas,
            'porcentaje' => $cargas > 0 ? round($aprobadas * 100 / $cargas, 1) : null,
        ];
    }

    /** Residentes de la carrera: anteproyecto autorizado y asesor en el periodo (Calificaciones de los residentes). */
    private function residentes(): int
    {
        return (int) DB::table('resi_anteproyecto as ra')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ra.id_alumno')
            ->join('resi_asesores as s', 's.id_anteproyecto', '=', 'ra.id_anteproyecto')
            ->where('a.id_carrera', $this->idCarrera)
            ->where('s.id_periodo', $this->idPeriodo)
            ->where('ra.estado_enviado', self::ANTEPROYECTO_AUTORIZADO)
            ->distinct()
            ->count('ra.id_anteproyecto');
    }

    /** Solicitudes de alumnos en actividades complementarias de la jefatura de la carrera (liberacion 0 / 1). */
    private function solicitudesComplementarias(): array
    {
        $filas = DB::table('actcomple_registro_alumnos as ra')
            ->join('actcomple_docente_actividad as da', 'da.id_docente_actividad', '=', 'ra.id_docente_actividad')
            ->join('actividades_complementarias as ac', 'ac.id_actividad_comple', '=', 'da.id_actividad_comple')
            ->join('actcomple_jefaturas as j', 'j.id_jefatura', '=', 'ac.id_jefatura')
            ->where('j.id_carrera', $this->idCarrera)
            ->where('ac.estado', 1)
            ->whereIn('ra.liberacion', [0, 1])
            ->groupBy('ra.liberacion')
            ->selectRaw('ra.liberacion, COUNT(DISTINCT ra.id_registro_alumno) as total')
            ->pluck('total', 'liberacion');

        return ['por_liberar' => (int) ($filas[0] ?? 0), 'liberadas' => (int) ($filas[1] ?? 0)];
    }

    /** Planeaciones docentes de la carrera en el periodo (estado_evidencias 1 por liberar, 2 liberadas). */
    private function planeaciones(): array
    {
        $filas = DB::table('actcomple_registros_coordinadores as rc')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'rc.id_periodo_carrera')
            ->where('pc.id_periodo', $this->idPeriodo)
            ->where('pc.id_carrera', $this->idCarrera)
            ->whereIn('rc.estado_evidencias', [self::PLANEACION_POR_LIBERAR, self::PLANEACION_LIBERADA])
            ->groupBy('rc.estado_evidencias')
            ->selectRaw('rc.estado_evidencias, COUNT(DISTINCT rc.id_reg_coordinador) as total')
            ->pluck('total', 'estado_evidencias');

        return [
            'por_liberar' => (int) ($filas[self::PLANEACION_POR_LIBERAR] ?? 0),
            'liberadas' => (int) ($filas[self::PLANEACION_LIBERADA] ?? 0),
        ];
    }

    /** Tutores y grupos de tutoría de la carrera en el periodo. */
    private function tutorias(): array
    {
        $fila = DB::table('exp_asigna_tutor as t')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 't.id_jefe_periodo')
            ->where('jp.id_carrera', $this->idCarrera)
            ->where('jp.id_periodo', $this->idPeriodo)
            ->whereNull('t.deleted_at')
            ->selectRaw('COUNT(DISTINCT t.id_personal) as tutores, COUNT(DISTINCT t.id_asigna_generacion) as grupos')
            ->first();

        return ['tutores' => (int) ($fila->tutores ?? 0), 'grupos' => (int) ($fila->grupos ?? 0)];
    }

    /** Inscritos y docentes de la carrera en el periodo y los 5 anteriores (dos consultas agrupadas por periodo). */
    private function historico(): array
    {
        $periodos = DB::table('gnral_periodos')
            ->whereBetween('id_periodo', [$this->idPeriodo - (self::PERIODOS_HISTORICO - 1), $this->idPeriodo])
            ->orderBy('id_periodo')
            ->get(['id_periodo', 'periodo']);
        $ids = $periodos->pluck('id_periodo')->all();

        $inscritos = DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->whereIn('v.id_periodo', $ids)
            ->whereIn('v.estado_validacion', DatosDirectivo::VALIDACION_INSCRITO)
            ->where('a.id_carrera', $this->idCarrera)
            ->groupBy('v.id_periodo')
            ->selectRaw('v.id_periodo, COUNT(DISTINCT v.id_alumno) as total')
            ->pluck('total', 'id_periodo');
        $docentes = DB::table('gnral_horarios as h')
            ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
            ->whereIn('pc.id_periodo', $ids)
            ->where('pc.id_carrera', $this->idCarrera)
            ->groupBy('pc.id_periodo')
            ->selectRaw('pc.id_periodo, COUNT(DISTINCT h.id_personal) as total')
            ->pluck('total', 'id_periodo');

        return $periodos->map(fn ($p) => [
            'periodo' => (string) $p->periodo,
            'inscritos' => (int) ($inscritos[$p->id_periodo] ?? 0),
            'docentes' => (int) ($docentes[$p->id_periodo] ?? 0),
        ])->all();
    }
}
