<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil PLANEACIÓN Y CONSULTAS (sesión "consultas", departamento 3).
 * Ver docs/DASHBOARD_CONSULTAS.md.
 *
 * Solo consultas de lectura con parámetros enlazados. Cada indicador replica la regla de una pantalla que el rol
 * ya tiene en su menú, para que los números coincidan:
 *
 *  - Docentes con horario: HrsDocentesController@index (Horarios › Ver Horarios Docentes); misma regla que
 *    DatosDirectivo::totalDocentes.
 *  - Horas frente a grupo y aulas en uso: bloques de hrs_rhps de los horarios del periodo
 *    (Horarios › Horas por carrera / Ver Horarios Aulas, Formatos › Concentrado estructura educativa).
 *  - Avance de la evaluación docente: Buscar_alumnos@index (Evaluación Doc. › Alumnos). Alumnos con la carga
 *    validada (estado 2) y una carga con status 1; terminaron si no_pregunta = preguntas + 1.
 *  - Solicitudes de complementarias: SolicitudAlumnosSubController@index (Complementarias › Solicitud Alumnos):
 *    liberacion = 1 (por liberar) y 2 (liberadas) de actividades con estado 1.
 *  - Actividades complementarias vigentes: actividades con estado 1 asignadas a un docente en el periodo.
 *
 * Los resultados se guardan en caché 10 minutos por periodo (no dependen del usuario). Si algo falla se devuelve
 * null y la vista muestra el estado vacío (nunca números inventados). El encabezado (cargo y unidad del usuario)
 * se lee aparte, por usuario y sin caché.
 */
class DatosConsultas
{
    /** Carreras que la pantalla de Evaluación Doc. › Alumnos excluye (Buscar_alumnos@index). */
    public const CARRERAS_EXCLUIDAS = [9, 11, 15];

    /** Materias que Buscar_alumnos excluye al contar los alumnos por evaluar ($alumnostodos). */
    public const MATERIAS_EXCLUIDAS_TOTAL = [773, 845, 853, 1160, 1263, 1264, 1265, 1443, 1496, 1502, 1565, 1566, 1567, 1568, 1569, 1571,
        774, 818, 846, 1161, 1497, 1570, 1771, 2201, 2251, 2258, 2516];

    /** Materias que Buscar_alumnos excluye al contar los alumnos que ya evaluaron ($alumnosya). */
    public const MATERIAS_EXCLUIDAS_YA = [773, 845, 853, 1160, 1263, 1264, 1265, 1443, 1496, 1502, 1565, 1566, 1567, 1568, 1569, 1571,
        774, 818, 846, 1161, 1497, 1570, 1771, 2201, 2251, 2258];

    public const MINUTOS_CACHE = 10;

    /** Periodos que muestra la gráfica de carga docente (el actual y los 5 anteriores). */
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
                'panel:consultas:periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel consultas: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Datos del encabezado del usuario: cargo y unidad administrativa (por usuario, sin caché).
     * Si algo falla devuelve valores null (el encabezado los omite). Delega en EncabezadoPersonal.
     */
    public static function encabezado(?int $idPersonal): array
    {
        $datos = EncabezadoPersonal::datos($idPersonal, false);

        return ['cargo' => $datos['cargo'], 'unidad' => $datos['unidad']];
    }

    /** "PAOLA FLORES ROJAS" → "PF". Delega en EncabezadoPersonal. */
    public static function iniciales(?string $nombre): ?string
    {
        return EncabezadoPersonal::iniciales($nombre);
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->first(['id_periodo', 'periodo']);
        $anterior = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo - 1)->first(['id_periodo', 'periodo']);

        $docentesCarrera = $this->docentesPorCarrera($this->idPeriodo);
        $horasCarrera = $this->horasPorCarrera($this->idPeriodo);
        $evaluacionCarrera = $this->evaluacionPorCarrera($this->idPeriodo);

        $carreras = [];
        foreach ($this->carreras() as $c) {
            $total = $evaluacionCarrera[$c->id_carrera]['total'] ?? 0;
            $ya = $evaluacionCarrera[$c->id_carrera]['ya'] ?? 0;
            $carreras[] = [
                'id_carrera' => (int) $c->id_carrera,
                'siglas' => $c->siglas,
                'nombre' => $c->nombre,
                'color' => $c->COLOR ?: null,
                'docentes' => $docentesCarrera[$c->id_carrera] ?? 0,
                'horas' => $horasCarrera[$c->id_carrera] ?? 0,
                'evaluacion_total' => $total,
                'evaluacion_terminaron' => $ya,
                'evaluacion' => $total > 0 ? round($ya * 100 / $total, 1) : null,
            ];
        }

        $evalTotal = array_sum(array_column($carreras, 'evaluacion_total'));
        $evalYa = array_sum(array_column($carreras, 'evaluacion_terminaron'));
        $solicitudes = $this->solicitudesComplementarias($this->idPeriodo);

        return [
            'periodo' => $periodo?->periodo,
            'periodo_anterior' => $anterior?->periodo,
            'docentes' => [
                'valor' => $this->totalDocentes($this->idPeriodo),
                'anterior' => $anterior ? $this->totalDocentes($anterior->id_periodo) : null,
            ],
            'horas' => [
                'valor' => $this->totalHoras($this->idPeriodo),
                'anterior' => $anterior ? $this->totalHoras($anterior->id_periodo) : null,
            ],
            'aulas' => [
                'en_uso' => $this->aulasEnUso($this->idPeriodo),
                'total' => (int) DB::table('hrs_aulas')->count(),
            ],
            'evaluacion' => [
                'total' => $evalTotal,
                'terminaron' => $evalYa,
                'pendientes' => $evalTotal - $evalYa,
                'porcentaje' => $evalTotal > 0 ? round($evalYa * 100 / $evalTotal, 1) : null,
                'activa' => DB::table('eva_activa_evaluacion')->where('id', 1)->value('estado') == 2,
            ],
            'complementarias' => [
                'por_liberar' => $solicitudes[1] ?? 0,
                'liberadas' => $solicitudes[2] ?? 0,
                'vigentes' => $this->actividadesVigentes($this->idPeriodo),
            ],
            'carreras' => $carreras,
            'historico' => $this->historico(),
        ];
    }

    /** Carreras de la pantalla de Evaluación Doc. › Alumnos. */
    private function carreras(): array
    {
        return DB::table('gnral_carreras')
            ->whereNotIn('id_carrera', self::CARRERAS_EXCLUIDAS)
            ->orderBy('id_carrera')
            ->get(['id_carrera', 'siglas', 'nombre', 'COLOR'])
            ->all();
    }

    /** Docentes distintos con horario en el periodo (regla de HrsDocentesController@index). */
    private function totalDocentes(int $idPeriodo): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT h.id_personal) AS total
               FROM gnral_horarios h
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
              WHERE pc.id_periodo = ?',
            [$idPeriodo]
        );

        return (int) ($fila->total ?? 0);
    }

    /** id_carrera => docentes distintos con horario en esa carrera. */
    private function docentesPorCarrera(int $idPeriodo): array
    {
        return $this->porCarrera(DB::select(
            'SELECT pc.id_carrera, COUNT(DISTINCT h.id_personal) AS total
               FROM gnral_horarios h
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
              WHERE pc.id_periodo = ?
              GROUP BY pc.id_carrera',
            [$idPeriodo]
        ));
    }

    /** Bloques de clase (hrs_rhps) de los horarios del periodo. */
    private function totalHoras(int $idPeriodo): int
    {
        return array_sum($this->horasPorCarrera($idPeriodo));
    }

    /** id_carrera => bloques de clase (hrs_rhps) de los horarios del periodo. */
    private function horasPorCarrera(int $idPeriodo): array
    {
        return $this->porCarrera(DB::select(
            'SELECT pc.id_carrera, COUNT(r.id_rhps) AS total
               FROM hrs_rhps r
               JOIN gnral_horas_profesores hp ON hp.id_hrs_profesor = r.id_hrs_profesor
               JOIN gnral_horarios h ON h.id_horario_profesor = hp.id_horario_profesor
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
              WHERE pc.id_periodo = ?
              GROUP BY pc.id_carrera',
            [$idPeriodo]
        ));
    }

    /** Aulas distintas con al menos un bloque de clase en el periodo. */
    private function aulasEnUso(int $idPeriodo): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT r.id_aula) AS total
               FROM hrs_rhps r
               JOIN gnral_horas_profesores hp ON hp.id_hrs_profesor = r.id_hrs_profesor
               JOIN gnral_horarios h ON h.id_horario_profesor = hp.id_horario_profesor
               JOIN gnral_periodo_carreras pc ON pc.id_periodo_carrera = h.id_periodo_carrera
              WHERE pc.id_periodo = ?',
            [$idPeriodo]
        );

        return (int) ($fila->total ?? 0);
    }

    /**
     * id_carrera => ['total' => alumnos por evaluar, 'ya' => alumnos que terminaron] (regla de Buscar_alumnos@index,
     * en dos consultas agrupadas en lugar de dos por carrera).
     */
    private function evaluacionPorCarrera(int $idPeriodo): array
    {
        $terminada = (int) DB::table('eva_pregunta')->count() + 1;

        $totales = DB::select(
            'SELECT a.id_carrera, COUNT(DISTINCT v.id_alumno) AS total
               FROM eva_validacion_de_cargas v
               JOIN gnral_alumnos a ON a.id_alumno = v.id_alumno
               JOIN eva_carga_academica ca ON ca.id_alumno = a.id_alumno
              WHERE v.id_periodo = ?
                AND v.estado_validacion = 2
                AND ca.id_periodo = ?
                AND ca.id_status_materia = 1
                AND ca.id_materia NOT IN (' . $this->marcas(self::MATERIAS_EXCLUIDAS_TOTAL) . ')
              GROUP BY a.id_carrera',
            array_merge([$idPeriodo, $idPeriodo], self::MATERIAS_EXCLUIDAS_TOTAL)
        );
        $terminaron = DB::select(
            'SELECT a.id_carrera, COUNT(DISTINCT a.cuenta) AS total
               FROM eva_validacion_de_cargas v
               JOIN gnral_alumnos a ON a.id_alumno = v.id_alumno
               JOIN eva_carga_academica ca ON ca.id_alumno = v.id_alumno AND ca.id_periodo = v.id_periodo
              WHERE v.id_periodo = ?
                AND v.estado_validacion = 2
                AND v.no_pregunta = ?
                AND ca.id_materia NOT IN (' . $this->marcas(self::MATERIAS_EXCLUIDAS_YA) . ')
              GROUP BY a.id_carrera',
            array_merge([$idPeriodo, $terminada], self::MATERIAS_EXCLUIDAS_YA)
        );

        $resultado = [];
        foreach ($this->porCarrera($totales) as $carrera => $n) {
            $resultado[$carrera]['total'] = $n;
        }
        foreach ($this->porCarrera($terminaron) as $carrera => $n) {
            // Igual que la pantalla: sin alumnos por evaluar, la carrera queda en 0.
            if (! empty($resultado[$carrera]['total'])) {
                $resultado[$carrera]['ya'] = $n;
            }
        }

        return $resultado;
    }

    /** liberacion => solicitudes del periodo (regla de SolicitudAlumnosSubController@index). */
    private function solicitudesComplementarias(int $idPeriodo): array
    {
        $filas = DB::select(
            'SELECT ra.liberacion, COUNT(DISTINCT ra.id_registro_alumno) AS total
               FROM actcomple_registro_alumnos ra
               JOIN actcomple_docente_actividad da ON da.id_docente_actividad = ra.id_docente_actividad
               JOIN actividades_complementarias ac ON ac.id_actividad_comple = da.id_actividad_comple
               JOIN actcomple_categorias cat ON cat.id_categoria = ac.id_categoria
               JOIN gnral_personales p ON p.id_personal = da.id_personal
               JOIN abreviaciones_prof ap ON ap.id_personal = p.id_personal
               JOIN abreviaciones ab ON ab.id_abreviacion = ap.id_abreviacion
               JOIN gnral_alumnos a ON a.cuenta = ra.cuenta
               JOIN gnral_semestres s ON s.id_semestre = a.id_semestre
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
              WHERE ra.id_periodo = ?
                AND ac.estado = 1
                AND ra.liberacion IN (1, 2)
              GROUP BY ra.liberacion',
            [$idPeriodo]
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->liberacion] = (int) $f->total;
        }

        return $resultado;
    }

    /** Actividades complementarias con estado 1 asignadas a un docente en el periodo. */
    private function actividadesVigentes(int $idPeriodo): int
    {
        return (int) DB::table('actividades_complementarias as ac')
            ->join('actcomple_docente_actividad as da', 'da.id_actividad_comple', '=', 'ac.id_actividad_comple')
            ->where('ac.estado', 1)
            ->where('da.id_periodo', $idPeriodo)
            ->distinct()
            ->count('ac.id_actividad_comple');
    }

    /** Docentes con horario y horas frente a grupo del periodo actual y los 5 anteriores que existan. */
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
                'docentes' => $this->totalDocentes((int) $p->id_periodo),
                'horas' => $this->totalHoras((int) $p->id_periodo),
            ];
        }

        return $resultado;
    }

    /** Filas (id_carrera, total) → [id_carrera => total]. */
    private function porCarrera(array $filas): array
    {
        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera] = (int) $f->total;
        }

        return $resultado;
    }

    /** "?, ?, ?" para listas fijas en cláusulas IN (los valores van como parámetros enlazados). */
    private function marcas(array $valores): string
    {
        return implode(', ', array_fill(0, count($valores), '?'));
    }
}
