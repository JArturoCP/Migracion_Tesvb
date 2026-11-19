<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /ingles para el PROFESOR DE INGLÉS (misma forma de uso que DatosDirectivo).
 *
 * Solo consultas de lectura con parámetros enlazados. Profesor = Session id_profesor_ingles y
 * periodo = Session periodo_ingles, como In_inicioController. Cada dato replica una pantalla existente:
 *
 *  - Mis grupos (M1): In_inicioController@inicio_calificaciones (/ingles/Calificaciones): filas de
 *    in_hrs_ingles_profesor del profesor y periodo unidas con in_niveles_ingles e in_grupo_ingles.
 *  - Alumnos inscritos (M2), por grupo: In_inicioController@mostrar_alumnos ($alumnos_inscritos):
 *    count(in_validar_carga.id_validar_carga) con las mismas uniones, mismo nivel, grupo y periodo,
 *    in_validar_carga.id_periodo = periodo e id_estado = 2.
 *  - Captura de calificaciones (M3/M4): In_inicioController@periodos_ingles: evaluaciones de la
 *    unidad 1 y 4 en in_cal_periodo; evaluada 1 = capturada, 0 = pendiente; un grupo con menos de
 *    2 registros tiene evaluaciones sin fecha ("Asignar fecha").
 *  - Histórico: M1 y M2 con las mismas reglas en los últimos periodos de in_periodos.
 *
 * Caché de 10 minutos por profesor y periodo. Si algo falla devuelve null y la vista muestra "Sin datos".
 */
class DatosIngles
{
    public const MINUTOS_CACHE = 10;

    /** Unidades de evaluación que muestra la pantalla de periodos. */
    public const UNIDADES_EVALUACION = [1, 4];

    /** Evaluaciones por grupo (unidad 1 y unidad 4). */
    public const EVALUACIONES_POR_GRUPO = 2;

    /** Periodos de inglés de la gráfica de línea (el actual y los anteriores). */
    public const PERIODOS_HISTORICO = 6;

    /** Colores de la lista por nivel (paleta del panel). */
    public const COLORES = ['#465FFF', '#12B76A', '#F79009', '#7A5AF8', '#EE46BC', '#0BA5EC', '#F04438', '#667085'];

    public function __construct(private readonly int $idProfesor, private readonly int $idPeriodo)
    {
    }

    public static function paraProfesor(mixed $idProfesor, mixed $idPeriodo): ?array
    {
        if (! is_numeric($idProfesor) || ! is_numeric($idPeriodo) || (int) $idPeriodo <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:ingles:profesor:' . (int) $idProfesor . ':periodo:' . (int) $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self((int) $idProfesor, (int) $idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel inglés: no se pudieron calcular los datos del dashboard del profesor', [
                'profesor' => $idProfesor,
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /** "INGLÉS FEBRERO-JULIO 2028" → "FEB – JUL 2028". */
    public static function periodoCorto(?string $periodo): string
    {
        $meses = ['ENERO' => 'ENE', 'FEBRERO' => 'FEB', 'MARZO' => 'MAR', 'ABRIL' => 'ABR', 'MAYO' => 'MAY', 'JUNIO' => 'JUN',
            'JULIO' => 'JUL', 'AGOSTO' => 'AGO', 'SEPTIEMBRE' => 'SEP', 'OCTUBRE' => 'OCT', 'NOVIEMBRE' => 'NOV', 'DICIEMBRE' => 'DIC'];

        return trim(preg_replace('/\s*-\s*/', ' – ', strtr(preg_replace('/^\s*INGL[ÉE]S\s*/u', '', mb_strtoupper((string) $periodo)), $meses)));
    }

    public function calcular(): array
    {
        $periodos = DB::table('in_periodos')
            ->where('id_periodo_ingles', '<=', $this->idPeriodo)
            ->orderBy('id_periodo_ingles', 'desc')
            ->limit(self::PERIODOS_HISTORICO)
            ->get(['id_periodo_ingles', 'periodo_ingles'])
            ->reverse()
            ->values();
        $actual = $periodos->firstWhere('id_periodo_ingles', $this->idPeriodo);
        $anterior = $periodos->count() > 1 ? $periodos[$periodos->count() - 2] : null;

        $grupos = [];
        $capturadas = 0;
        $porCapturar = 0;
        $sinFecha = 0;
        foreach ($this->grupos($this->idPeriodo) as $g) {
            $evaluaciones = $this->evaluaciones((int) $g->id_nivel, (int) $g->id_grupo);
            $cap = count(array_filter($evaluaciones, fn ($e) => (int) $e->evaluada === 1));
            $pen = count(array_filter($evaluaciones, fn ($e) => (int) $e->evaluada === 0));
            $falta = max(0, self::EVALUACIONES_POR_GRUPO - $this->registrosPeriodo((int) $g->id_nivel, (int) $g->id_grupo));
            $capturadas += $cap;
            $porCapturar += $pen;
            $sinFecha += $falta;

            $grupos[] = [
                'id_nivel' => (int) $g->id_nivel,
                'id_grupo' => (int) $g->id_grupo,
                'nivel' => $g->nivel,
                'grupo' => $g->grupo,
                'inscritos' => $this->inscritos((int) $g->id_nivel, (int) $g->id_grupo, $this->idPeriodo),
                'capturadas' => $cap,
                'por_capturar' => $pen,
                'sin_fecha' => $falta,
            ];
        }

        // Alumnos por nivel (para la lista), en el orden de los grupos.
        $niveles = [];
        foreach ($grupos as $g) {
            $niveles[$g['id_nivel']] ??= ['nombre' => $g['nivel'], 'grupos' => 0, 'inscritos' => 0];
            $niveles[$g['id_nivel']]['grupos']++;
            $niveles[$g['id_nivel']]['inscritos'] += $g['inscritos'];
        }
        $i = 0;
        foreach ($niveles as &$n) {
            $n['color'] = self::COLORES[$i++ % count(self::COLORES)];
        }
        unset($n);

        // Histórico: grupos e inscritos del profesor en cada periodo (mismas reglas).
        $historico = [];
        foreach ($periodos as $p) {
            $id = (int) $p->id_periodo_ingles;
            if ($id === $this->idPeriodo) {
                $historico[] = ['id' => $id, 'periodo' => self::periodoCorto($p->periodo_ingles), 'grupos' => count($grupos), 'inscritos' => array_sum(array_column($grupos, 'inscritos'))];
                continue;
            }
            $gruposPeriodo = $this->grupos($id);
            $historico[] = [
                'id' => $id,
                'periodo' => self::periodoCorto($p->periodo_ingles),
                'grupos' => count($gruposPeriodo),
                'inscritos' => array_sum(array_map(fn ($g) => $this->inscritos((int) $g->id_nivel, (int) $g->id_grupo, $id), $gruposPeriodo)),
            ];
        }
        $historicoAnterior = $anterior ? collect($historico)->firstWhere('id', (int) $anterior->id_periodo_ingles) : null;

        $esperadas = count($grupos) * self::EVALUACIONES_POR_GRUPO;

        return [
            'periodo' => $actual?->periodo_ingles,
            'periodo_anterior' => $anterior?->periodo_ingles,
            'mis_grupos' => ['valor' => count($grupos), 'anterior' => $historicoAnterior['grupos'] ?? null],
            'alumnos_inscritos' => ['valor' => array_sum(array_column($grupos, 'inscritos')), 'anterior' => $historicoAnterior['inscritos'] ?? null],
            'captura' => [
                'esperadas' => $esperadas,
                'capturadas' => $capturadas,
                'por_capturar' => $porCapturar,
                'sin_fecha' => $sinFecha,
                'porcentaje' => $esperadas > 0 ? round($capturadas * 100 / $esperadas, 2) : null,
            ],
            'grupos' => $grupos,
            'niveles' => array_values($niveles),
            'historico' => $historico,
        ];
    }

    /** M1: misma consulta que In_inicioController@inicio_calificaciones. */
    private function grupos(int $idPeriodo): array
    {
        return DB::table('in_hrs_ingles_profesor')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
            ->where('in_hrs_ingles_profesor.id_profesor', '=', $this->idProfesor)
            ->where('in_hrs_ingles_profesor.id_periodo', '=', $idPeriodo)
            ->select('in_niveles_ingles.descripcion as nivel', 'in_grupo_ingles.descripcion as grupo', 'in_hrs_ingles_profesor.id_nivel', 'in_hrs_ingles_profesor.id_grupo')
            ->orderBy('in_niveles_ingles.id_niveles_ingles', 'ASC')
            ->orderBy('in_grupo_ingles.id_grupo_ingles', 'ASC')
            ->get()
            ->all();
    }

    /** M2: misma consulta que In_inicioController@mostrar_alumnos ($alumnos_inscritos). */
    private function inscritos(int $idNivel, int $idGrupo, int $idPeriodo): int
    {
        return (int) DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->join('eva_tipo_curso', 'eva_tipo_curso.id_tipo_curso', '=', 'in_carga_academica_ingles.estado_nivel')
            ->where('in_carga_academica_ingles.id_grupo', '=', $idGrupo)
            ->where('in_carga_academica_ingles.id_nivel', '=', $idNivel)
            ->where('in_carga_academica_ingles.id_periodo_ingles', '=', $idPeriodo)
            ->where('in_validar_carga.id_periodo', '=', $idPeriodo)
            ->where('in_validar_carga.id_estado', '=', 2)
            ->count('in_validar_carga.id_validar_carga');
    }

    /** M4: misma cuenta que In_inicioController@periodos_ingles ($cuenta_periodos). */
    private function registrosPeriodo(int $idNivel, int $idGrupo): int
    {
        return (int) DB::table('in_cal_periodo')
            ->where('in_cal_periodo.id_periodo', '=', $this->idPeriodo)
            ->where('in_cal_periodo.id_nivel', '=', $idNivel)
            ->where('in_cal_periodo.id_grupo', '=', $idGrupo)
            ->count('in_cal_periodo.id_cal_periodo');
    }

    /** M3: evaluaciones de la unidad 1 y 4 que muestra In_inicioController@periodos_ingles. */
    private function evaluaciones(int $idNivel, int $idGrupo): array
    {
        return DB::table('in_cal_periodo')
            ->where('in_cal_periodo.id_periodo', '=', $this->idPeriodo)
            ->where('in_cal_periodo.id_nivel', '=', $idNivel)
            ->where('in_cal_periodo.id_grupo', '=', $idGrupo)
            ->whereIn('in_cal_periodo.id_unidad', self::UNIDADES_EVALUACION)
            ->get(['in_cal_periodo.id_unidad', 'in_cal_periodo.evaluada'])
            ->all();
    }
}
