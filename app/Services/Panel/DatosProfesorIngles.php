<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Métricas del dashboard de /ingles para el PROFESOR DE INGLÉS (solo lectura).
 *
 * Profesor = Session id_profesor_ingles y periodo = Session periodo_ingles, como In_inicioController.
 * Cada dato replica la consulta de una pantalla que ya existe, para que los números coincidan:
 *
 *  - M1 Mis grupos: In_inicioController@inicio_calificaciones (/ingles/Calificaciones): filas de
 *    in_hrs_ingles_profesor del profesor y periodo, unidas con in_niveles_ingles e in_grupo_ingles.
 *  - M2 Alumnos inscritos: In_inicioController@mostrar_alumnos, por grupo: count(in_validar_carga.id_validar_carga)
 *    con las mismas uniones (gnral_alumnos, in_carga_academica_ingles, in_niveles_ingles, in_grupo_ingles,
 *    eva_tipo_curso), mismo nivel y grupo, id_periodo_ingles y in_validar_carga.id_periodo = periodo, id_estado = 2.
 *  - M3 Evaluaciones por capturar / M4 sin fecha: In_inicioController@periodos_ingles
 *    (/ingles/Calificaciones/periodos_ingles/{nivel}/{grupo}): registros de in_cal_periodo del grupo y periodo;
 *    la pantalla muestra las evaluaciones de la unidad 1 y la 4, cada una "evaluada" (1) o por capturar (0),
 *    y "Asignar fecha" mientras el grupo tenga menos de 2 registros.
 *
 * Caché de 5 minutos por profesor y periodo. Si algo falla devuelve null y la vista muestra "Sin datos".
 */
class DatosProfesorIngles
{
    public const MINUTOS_CACHE = 5;

    /** Unidades de evaluación que muestra la pantalla de periodos (In_inicioController@periodos_ingles). */
    public const UNIDADES_EVALUACION = [1, 4];

    /** Evaluaciones por grupo (unidad 1 y unidad 4). */
    public const EVALUACIONES_POR_GRUPO = 2;

    public function __construct(private readonly int $idProfesor, private readonly int $idPeriodo)
    {
    }

    public static function para(mixed $idProfesor, mixed $idPeriodo): ?array
    {
        if (! is_numeric($idProfesor) || ! is_numeric($idPeriodo)) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:ingles:profesor:' . (int) $idProfesor . ':periodo:' . (int) $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self((int) $idProfesor, (int) $idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel inglés: no se pudieron calcular las métricas del profesor', [
                'profesor' => $idProfesor,
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $grupos = [];
        $porCapturar = 0;
        $sinFecha = 0;
        $inscritosTotal = 0;

        foreach ($this->grupos() as $g) {
            $evaluaciones = $this->evaluaciones((int) $g->id_nivel, (int) $g->id_grupo);
            $registradas = $this->registrosPeriodo((int) $g->id_nivel, (int) $g->id_grupo);
            $inscritos = $this->inscritos((int) $g->id_nivel, (int) $g->id_grupo);

            $capturadas = count(array_filter($evaluaciones, fn ($e) => (int) $e->evaluada === 1));
            $pendientes = count(array_filter($evaluaciones, fn ($e) => (int) $e->evaluada === 0));
            $faltanFecha = max(0, self::EVALUACIONES_POR_GRUPO - $registradas);

            $porCapturar += $pendientes;
            $sinFecha += $faltanFecha;
            $inscritosTotal += $inscritos;

            $grupos[] = [
                'id_nivel' => (int) $g->id_nivel,
                'id_grupo' => (int) $g->id_grupo,
                'nivel' => $g->nivel,
                'grupo' => $g->grupo,
                'inscritos' => $inscritos,
                'capturadas' => $capturadas,
                'por_capturar' => $pendientes,
                'sin_fecha' => $faltanFecha,
            ];
        }

        return [
            'mis_grupos' => count($grupos),
            'alumnos_inscritos' => $inscritosTotal,
            'por_capturar' => $porCapturar,
            'sin_fecha' => $sinFecha,
            'grupos' => $grupos,
        ];
    }

    /** M1: misma consulta que In_inicioController@inicio_calificaciones. */
    private function grupos(): array
    {
        return DB::table('in_hrs_ingles_profesor')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
            ->where('in_hrs_ingles_profesor.id_profesor', '=', $this->idProfesor)
            ->where('in_hrs_ingles_profesor.id_periodo', '=', $this->idPeriodo)
            ->select('in_niveles_ingles.descripcion as nivel', 'in_grupo_ingles.descripcion as grupo', 'in_hrs_ingles_profesor.id_nivel', 'in_hrs_ingles_profesor.id_grupo')
            ->orderBy('in_niveles_ingles.id_niveles_ingles', 'ASC')
            ->orderBy('in_grupo_ingles.id_grupo_ingles', 'ASC')
            ->get()
            ->all();
    }

    /** M2: misma consulta que In_inicioController@mostrar_alumnos (alumnos_inscritos). */
    private function inscritos(int $idNivel, int $idGrupo): int
    {
        return (int) DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->join('eva_tipo_curso', 'eva_tipo_curso.id_tipo_curso', '=', 'in_carga_academica_ingles.estado_nivel')
            ->where('in_carga_academica_ingles.id_grupo', '=', $idGrupo)
            ->where('in_carga_academica_ingles.id_nivel', '=', $idNivel)
            ->where('in_carga_academica_ingles.id_periodo_ingles', '=', $this->idPeriodo)
            ->where('in_validar_carga.id_periodo', '=', $this->idPeriodo)
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
