<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil DIRECTIVO.
 *
 * Solo consultas de lectura con parámetros enlazados. Cada indicador replica la regla de una
 * pantalla que ya existe en el sistema, para que los números coincidan:
 *
 *  - Estudiantes inscritos: SEscolaresController@estadisticas_genero (Servicios Escolares › Estadísticas):
 *    alumnos con carga validada (eva_validacion_de_cargas.estado_validacion 2, 8 o 9) en el periodo,
 *    contados como SUM(genero = 'M') + SUM(genero = 'F'), solo semestres de gnral_semestres y sin las
 *    carreras 9, 11 y 15.
 *  - Docentes con horario: HrsDocentesController@index (Horarios › Ver Horarios Docentes):
 *    docentes distintos con registro en gnral_horarios en el periodo.
 *  - Aprobación: SEscolaresController@estadisticas_indice_reprobacion_sem (índice de reprobación):
 *    cargas con id_status_materia = 1 de alumnos con validación 2 o 9; una carga está reprobada si
 *    alguna de sus unidades (cal_evaluaciones) tiene calificación < 70.
 *
 * Los resultados se guardan en caché 10 minutos por periodo. Si algo falla, se devuelve null y la
 * vista muestra "Sin datos" (nunca números inventados).
 */
class DatosDirectivo
{
    /** Carreras que la pantalla de Estadísticas excluye (SEscolaresController@estadisticas_genero). */
    public const CARRERAS_EXCLUIDAS = [9, 11, 15];

    /** Validaciones de carga que cuentan como inscrito (estadisticas_genero). */
    public const VALIDACION_INSCRITO = [2, 8, 9];

    /** Validaciones de carga que entran al índice de reprobación (estadisticas_indice_reprobacion_sem). */
    public const VALIDACION_REPROBACION = [2, 9];

    public const MINUTOS_CACHE = 10;

    /** Periodos que muestra la gráfica de matrícula (el actual y los 5 anteriores). */
    public const PERIODOS_HISTORICO = 6;

    public function __construct(private readonly int $idPeriodo)
    {
    }

    /** Datos del dashboard para un periodo (con caché de 10 minutos). */
    public static function paraPeriodo(int $idPeriodo): ?array
    {
        if ($idPeriodo <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:directivo:periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel directivo: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->first(['id_periodo', 'periodo']);
        $anterior = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo - 1)->first(['id_periodo', 'periodo']);

        $inscritosCarrera = $this->inscritosPorCarrera($this->idPeriodo);
        $docentesCarrera = $this->docentesPorCarrera($this->idPeriodo);
        $aprobacionCarrera = $this->aprobacionPorCarrera($this->idPeriodo);

        $carreras = [];
        foreach ($this->carreras() as $c) {
            $cargas = $aprobacionCarrera[$c->id_carrera]['cargas'] ?? 0;
            $aprobadas = $aprobacionCarrera[$c->id_carrera]['aprobadas'] ?? 0;
            $carreras[] = [
                'id_carrera' => (int) $c->id_carrera,
                'siglas' => $c->siglas,
                'nombre' => $c->nombre,
                'color' => $c->COLOR ?: null,
                'inscritos' => $inscritosCarrera[$c->id_carrera] ?? 0,
                'docentes' => $docentesCarrera[$c->id_carrera] ?? 0,
                'cargas' => $cargas,
                'aprobadas' => $aprobadas,
                'aprobacion' => $cargas > 0 ? round($aprobadas * 100 / $cargas, 2) : null,
            ];
        }

        $totalInscritos = array_sum(array_column($carreras, 'inscritos'));
        $totalCargas = array_sum(array_column($carreras, 'cargas'));
        $totalAprobadas = array_sum(array_column($carreras, 'aprobadas'));

        return [
            'periodo' => $periodo?->periodo,
            'periodo_anterior' => $anterior?->periodo,
            'inscritos' => [
                'valor' => $totalInscritos,
                'anterior' => $anterior ? array_sum($this->inscritosPorCarrera($anterior->id_periodo)) : null,
            ],
            'docentes' => [
                'valor' => $this->totalDocentes($this->idPeriodo),
                'anterior' => $anterior ? $this->totalDocentes($anterior->id_periodo) : null,
            ],
            'aprobacion' => [
                'cargas' => $totalCargas,
                'aprobadas' => $totalAprobadas,
                'reprobadas' => $totalCargas - $totalAprobadas,
                'porcentaje' => $totalCargas > 0 ? round($totalAprobadas * 100 / $totalCargas, 2) : null,
            ],
            'carreras' => $carreras,
            'historico' => $this->historico(),
        ];
    }

    /** Carreras que muestra la pantalla de Estadísticas. */
    private function carreras(): array
    {
        return DB::table('gnral_carreras')
            ->whereNotIn('id_carrera', self::CARRERAS_EXCLUIDAS)
            ->orderBy('id_carrera')
            ->get(['id_carrera', 'siglas', 'nombre', 'COLOR'])
            ->all();
    }

    /** id_carrera => inscritos (regla de SEscolaresController@estadisticas_genero). */
    private function inscritosPorCarrera(int $idPeriodo): array
    {
        $filas = DB::select(
            'SELECT a.id_carrera,
                    SUM(a.genero = \'M\') + SUM(a.genero = \'F\') AS total
               FROM gnral_alumnos a
               JOIN eva_validacion_de_cargas v ON v.id_alumno = a.id_alumno
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
              WHERE v.id_periodo = ?
                AND v.estado_validacion IN (' . $this->marcas(self::VALIDACION_INSCRITO) . ')
                AND a.id_carrera NOT IN (' . $this->marcas(self::CARRERAS_EXCLUIDAS) . ')
                AND a.id_semestre IN (SELECT id_semestre FROM gnral_semestres)
              GROUP BY a.id_carrera',
            array_merge([$idPeriodo], self::VALIDACION_INSCRITO, self::CARRERAS_EXCLUIDAS)
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera] = (int) $f->total;
        }

        return $resultado;
    }

    /** Total de docentes distintos con horario (regla de HrsDocentesController@index). */
    private function totalDocentes(int $idPeriodo): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT p.id_personal) AS total
               FROM gnral_personales p
               JOIN gnral_horarios h ON h.id_personal = p.id_personal
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
               JOIN gnral_periodos g ON g.id_periodo = pc.id_periodo
              WHERE g.id_periodo = ?',
            [$idPeriodo]
        );

        return (int) ($fila->total ?? 0);
    }

    /** id_carrera => docentes distintos con horario en esa carrera. */
    private function docentesPorCarrera(int $idPeriodo): array
    {
        $filas = DB::select(
            'SELECT pc.id_carrera, COUNT(DISTINCT p.id_personal) AS total
               FROM gnral_personales p
               JOIN gnral_horarios h ON h.id_personal = p.id_personal
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
              WHERE pc.id_periodo = ?
              GROUP BY pc.id_carrera',
            [$idPeriodo]
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera] = (int) $f->total;
        }

        return $resultado;
    }

    /** id_carrera => ['cargas' => n, 'aprobadas' => m] (regla del índice de reprobación). */
    private function aprobacionPorCarrera(int $idPeriodo): array
    {
        $filas = DB::select(
            'SELECT a.id_carrera, COUNT(*) AS cargas, SUM(t.reprobadas = 0) AS aprobadas
               FROM (SELECT ca.id_carga_academica, ca.id_alumno,
                            COALESCE(SUM(ev.calificacion < 70), 0) AS reprobadas
                       FROM eva_carga_academica ca
                       JOIN eva_validacion_de_cargas v
                         ON v.id_alumno = ca.id_alumno
                        AND v.id_periodo = ca.id_periodo
                        AND v.estado_validacion IN (' . $this->marcas(self::VALIDACION_REPROBACION) . ')
                       LEFT JOIN cal_evaluaciones ev ON ev.id_carga_academica = ca.id_carga_academica
                      WHERE ca.id_periodo = ?
                        AND ca.id_status_materia = 1
                      GROUP BY ca.id_carga_academica, ca.id_alumno) t
               JOIN gnral_alumnos a ON a.id_alumno = t.id_alumno
              GROUP BY a.id_carrera',
            array_merge(self::VALIDACION_REPROBACION, [$idPeriodo])
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera] = ['cargas' => (int) $f->cargas, 'aprobadas' => (int) $f->aprobadas];
        }

        return $resultado;
    }

    /** Inscritos y docentes del periodo actual y los 5 anteriores que existan en gnral_periodos. */
    private function historico(): array
    {
        $periodos = DB::table('gnral_periodos')
            ->whereBetween('id_periodo', [$this->idPeriodo - (self::PERIODOS_HISTORICO - 1), $this->idPeriodo])
            ->orderBy('id_periodo')
            ->get(['id_periodo', 'periodo']);

        $resultado = [];
        foreach ($periodos as $p) {
            $resultado[] = [
                'periodo' => $p->periodo,
                'inscritos' => array_sum($this->inscritosPorCarrera((int) $p->id_periodo)),
                'docentes' => $this->totalDocentes((int) $p->id_periodo),
            ];
        }

        return $resultado;
    }

    /** "?, ?, ?" para listas fijas en cláusulas IN (los valores van como parámetros enlazados). */
    private function marcas(array $valores): string
    {
        return implode(', ', array_fill(0, count($valores), '?'));
    }
}
