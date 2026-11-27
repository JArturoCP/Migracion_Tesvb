<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil DESARROLLO ACADÉMICO (sesión "desa": tipo_usuario 2 y
 * gnral_personales.id_departamento 4, HomeController.php:599-608; el mismo bloque pone "jefe_division" con la carrera 17,
 * que no existe, por eso el dashboard se asigna por "desa"). Ver docs/DASHBOARD_DESARROLLO.md.
 *
 * Todo es del PERIODO seleccionado:
 *  - Evaluación docente (avance) y horarios: la MISMA regla que ya calcula DatosConsultas (Evaluación Docente › Alumnos,
 *    Horarios), reutilizada con DatosConsultas::paraPeriodo() y su caché; así no se repite la consulta más pesada
 *    (eva_carga_academica). Si ese servicio devuelve null, esos bloques muestran su estado vacío y el resto sigue.
 *  - Tutorías (Tutorias_inicioController): exp_asigna_tutor / exp_asigna_alumnos sin borrar, unidos a
 *    gnral_jefes_periodos.id_periodo por su grupo (exp_asigna_generacion).
 *  - PIASE: casos (ar_casos_estudiantes, estado 'abierto' → 'en_proceso' → 'cerrado'), canalizaciones
 *    (ar_caso_canalizaciones) por área de destino y áreas activas con responsable en el periodo
 *    (ar_area_responsables_periodo; DesarrolloAcademicoAreasAtencionController).
 *
 * NUNCA se leen resultados ni comentarios de la evaluación de un docente, ni nombres, cuentas u otros datos de alumnos y
 * docentes, ni el motivo o resultado de los casos (observaciones, resultado_cierre, causas): solo ids, conteos, carrera,
 * área (catálogo) y periodo, siempre agregados en la base. Caché de 10 minutos por periodo. Si algo falla, null.
 */
class DatosDesarrollo
{
    public const MINUTOS_CACHE = 10;

    public const PERIODOS_HISTORICO = 6;

    /** ar_casos_estudiantes.estado de un caso terminado. */
    public const CASO_CERRADO = 'cerrado';

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
                'panel:desarrollo:periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel desarrollo académico: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');

        // Evaluación docente y horarios: misma regla y caché que el dashboard de Planeación y Consultas.
        $consultas = DatosConsultas::paraPeriodo($this->idPeriodo);
        $evaluacion = $consultas['evaluacion'] ?? null;
        $carrerasEvaluacion = array_map(fn ($c) => [
            'siglas' => (string) $c['siglas'],
            'nombre' => (string) $c['nombre'],
            'total' => (int) $c['evaluacion_total'],
            'terminaron' => (int) $c['evaluacion_terminaron'],
        ], $consultas['carreras'] ?? []);

        // Tutorías del periodo.
        $tutores = DB::table('exp_asigna_tutor as t')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 't.id_jefe_periodo')
            ->where('jp.id_periodo', $this->idPeriodo)
            ->whereNull('t.deleted_at')
            ->selectRaw('COUNT(DISTINCT t.id_personal) as tutores, COUNT(DISTINCT t.id_asigna_generacion) as grupos')
            ->first();
        $alumnosTutoria = (int) DB::table('exp_asigna_alumnos as al')
            ->join('exp_asigna_generacion as g', 'g.id_asigna_generacion', '=', 'al.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'g.id_jefe_periodo')
            ->where('jp.id_periodo', $this->idPeriodo)
            ->whereNull('al.deleted_at')
            ->whereNull('g.deleted_at')
            ->distinct()
            ->count('al.id_alumno');

        // PIASE: casos del periodo, por carrera, canalizaciones por área y áreas con responsable.
        $casos = DB::table('ar_casos_estudiantes')
            ->where('id_periodo', $this->idPeriodo)
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN estado = ? THEN 1 ELSE 0 END) as cerrados', [self::CASO_CERRADO])
            ->first();
        $casosCarrera = DB::table('ar_casos_estudiantes')
            ->where('id_periodo', $this->idPeriodo)
            ->groupBy('id_carrera')
            ->selectRaw('id_carrera, COUNT(*) as total')
            ->pluck('total', 'id_carrera');
        $canalizaciones = DB::table('ar_caso_canalizaciones as cc')
            ->join('ar_casos_estudiantes as c', 'c.id_ar_caso', '=', 'cc.id_ar_caso')
            ->join('ar_areas_atencion as a', 'a.id_area_atencion', '=', 'cc.id_area_destino')
            ->where('c.id_periodo', $this->idPeriodo)
            ->groupBy('a.id_area_atencion', 'a.nombre')
            ->orderByDesc('total')->orderBy('a.nombre')
            ->selectRaw('a.nombre as area, COUNT(*) as total')
            ->get()
            ->map(fn ($f) => ['area' => (string) $f->area, 'total' => (int) $f->total])
            ->all();
        $areas = DB::table('ar_areas_atencion as a')
            ->where('a.activo', 1)
            ->selectRaw('COUNT(*) as activas, SUM(CASE WHEN EXISTS (
                    SELECT 1 FROM ar_area_responsables_periodo r
                     WHERE r.id_area_atencion = a.id_area_atencion AND r.id_periodo = ? AND r.activo = 1
                ) THEN 1 ELSE 0 END) as con_responsable', [$this->idPeriodo])
            ->first();

        // Resumen por carrera: avance de la evaluación (de DatosConsultas) y casos PIASE.
        $carreras = [];
        foreach ($consultas['carreras'] ?? [] as $i => $c) {
            $carreras[] = $carrerasEvaluacion[$i] + ['casos' => (int) ($casosCarrera[$c['id_carrera']] ?? 0)];
        }

        return [
            'periodo' => $periodo,
            'evaluacion' => $evaluacion,
            'docentes' => $consultas === null ? null : (int) $consultas['docentes']['valor'],
            'horas' => $consultas === null ? null : (int) $consultas['horas']['valor'],
            'tutorias' => ['tutores' => (int) ($tutores->tutores ?? 0), 'grupos' => (int) ($tutores->grupos ?? 0), 'alumnos' => $alumnosTutoria],
            'casos' => ['total' => (int) ($casos->total ?? 0), 'cerrados' => (int) ($casos->cerrados ?? 0)],
            'areas' => ['activas' => (int) ($areas->activas ?? 0), 'con_responsable' => (int) ($areas->con_responsable ?? 0)],
            'canalizaciones' => $canalizaciones,
            'carreras' => $carreras,
            'historico' => $this->historico(),
        ];
    }

    /** Casos y canalizaciones PIASE del periodo y los 5 anteriores que existan (una consulta agrupada). */
    private function historico(): array
    {
        $periodos = DB::table('gnral_periodos')
            ->whereBetween('id_periodo', [$this->idPeriodo - (self::PERIODOS_HISTORICO - 1), $this->idPeriodo])
            ->orderBy('id_periodo')
            ->get(['id_periodo', 'periodo']);

        $conteos = DB::table('ar_casos_estudiantes as c')
            ->leftJoin('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'c.id_ar_caso')
            ->whereIn('c.id_periodo', $periodos->pluck('id_periodo')->all())
            ->groupBy('c.id_periodo')
            ->selectRaw('c.id_periodo, COUNT(DISTINCT c.id_ar_caso) as casos, COUNT(cc.id_ar_caso) as canalizaciones')
            ->get()
            ->keyBy('id_periodo');

        return $periodos->map(fn ($p) => [
            'periodo' => (string) $p->periodo,
            'casos' => (int) ($conteos[$p->id_periodo]->casos ?? 0),
            'canalizaciones' => (int) ($conteos[$p->id_periodo]->canalizaciones ?? 0),
        ])->all();
    }
}
