<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil RESIDENCIAS PROFESIONALES (sesión "residencia": tipo_usuario 2 y
 * gnral_personales.id_departamento 8, HomeController.php:637-644). Ver docs/DASHBOARD_RESIDENCIA.md.
 *
 * Todo se filtra por el PERIODO seleccionado (las tablas resi_* tienen id_periodo y las pantallas usan
 * Session::get('periodo_actual')). Cada indicador replica la regla de una pantalla del rol:
 *
 *  - Anteproyectos por estado: Seg. Anteproyecto › Anteproyectos autorizados por los revisores
 *    (Resi_documentacionfinal_depController): estado_enviado 1 = en revisión, 0 y 2 = en modificación, 3 = autorizado.
 *  - Documentación de alta por autorizar: Seg. Anteproyecto › Autorizar documentación de alta
 *    (Resi_departamento_autorizar_anteproyectoController): resi_alta_residencia.id_estado_solicitud 1 (enviada) o 4
 *    (reenviada con cambios).
 *  - Residentes, por carrera y por giro, y empresas: Seg. Residencia › Estadísticas
 *    (Resi_departamento_residenciaController@institucional_estadisticas / giro_estadisticas): proyecto con asesor,
 *    empresa, alumno, asesor y proyecto existentes y alta autorizada por el departamento (autorizacion_departamento = 1).
 *  - Actas: Seg. Residencia › Autorizar impresión de acta (Resi_seguimientoController@autorizar_imprimir_acta):
 *    resi_promedio_general_residencia.id_calificar_departamento 0 = pendiente, 1 = autorizada.
 *  - Asesores y revisores: docentes distintos en resi_asesores y resi_revisores del periodo.
 *
 * NUNCA se seleccionan nombres, cuentas, correos o teléfonos de alumnos, nombres de asesores ni datos de contacto de
 * empresas: solo ids, conteos, carrera, giro y periodo. Caché de 10 minutos por periodo. Si algo falla se devuelve null.
 */
class DatosResidencia
{
    public const MINUTOS_CACHE = 10;

    public const PERIODOS_HISTORICO = 6;

    /** Carreras que las pantallas de residencias no listan. */
    public const CARRERAS_EXCLUIDAS = [9, 11, 15];

    /** resi_anteproyecto.estado_enviado (según el código que los asigna). */
    public const ANTEPROYECTO_EN_REVISION = [1];

    public const ANTEPROYECTO_EN_MODIFICACION = [0, 2];

    public const ANTEPROYECTO_AUTORIZADO = [3];

    /** resi_alta_residencia.id_estado_solicitud que revisa el departamento (1 enviada, 4 reenviada). */
    public const ALTA_POR_AUTORIZAR = [1, 4];

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
                'panel:residencia:periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel residencias: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');

        $anteproyectos = $this->anteproyectosPorCarreraYEstado();
        $altas = $this->porCarrera($this->altasPorAutorizar());
        $residentesCarrera = $this->porCarrera($this->residentes('ra.id_carrera'));
        $actas = $this->actasPorCarrera();

        $carreras = [];
        foreach ($this->carreras() as $c) {
            $id = (int) $c->id_carrera;
            $carreras[] = [
                'siglas' => (string) $c->siglas,
                'nombre' => (string) $c->nombre,
                'anteproyectos' => array_sum($anteproyectos[$id] ?? []),
                'en_revision' => $this->sumaEstados($anteproyectos[$id] ?? [], self::ANTEPROYECTO_EN_REVISION),
                'altas_por_autorizar' => $altas[$id] ?? 0,
                'residentes' => $residentesCarrera[$id] ?? 0,
                'actas_autorizadas' => $actas[$id][1] ?? 0,
            ];
        }

        $totalPorEstado = [];
        foreach ($anteproyectos as $estados) {
            foreach ($estados as $estado => $n) {
                $totalPorEstado[$estado] = ($totalPorEstado[$estado] ?? 0) + $n;
            }
        }
        $actasTotal = [0 => 0, 1 => 0];
        foreach ($actas as $porEstado) {
            foreach ([0, 1] as $e) {
                $actasTotal[$e] += $porEstado[$e] ?? 0;
            }
        }

        return [
            'periodo' => $periodo,
            'anteproyectos' => [
                'en_revision' => $this->sumaEstados($totalPorEstado, self::ANTEPROYECTO_EN_REVISION),
                'en_modificacion' => $this->sumaEstados($totalPorEstado, self::ANTEPROYECTO_EN_MODIFICACION),
                'autorizados' => $this->sumaEstados($totalPorEstado, self::ANTEPROYECTO_AUTORIZADO),
            ],
            'altas_por_autorizar' => array_sum($altas),
            'residentes' => $this->totalResidentes($this->idPeriodo),
            'actas' => ['por_autorizar' => $actasTotal[0], 'autorizadas' => $actasTotal[1]],
            'asesores' => $this->docentesDistintos('resi_asesores'),
            'revisores' => $this->docentesDistintos('resi_revisores'),
            'empresas' => $this->empresas(),
            'carreras' => $carreras,
            'giros' => $this->residentesPorGiro(),
            'historico' => $this->historico(),
        ];
    }

    /** "?, ?" para listas fijas en cláusulas IN (los valores van como parámetros enlazados). */
    private function marcas(array $valores): string
    {
        return implode(', ', array_fill(0, count($valores), '?'));
    }

    private function sumaEstados(array $porEstado, array $estados): int
    {
        return array_sum(array_map(fn ($e) => $porEstado[$e] ?? 0, $estados));
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

    /** Carreras que muestran las pantallas de residencias. */
    private function carreras(): array
    {
        return DB::table('gnral_carreras')
            ->whereNotIn('id_carrera', self::CARRERAS_EXCLUIDAS)
            ->orderBy('id_carrera')
            ->get(['id_carrera', 'siglas', 'nombre'])
            ->all();
    }

    /** [id_carrera => [estado_enviado => anteproyectos]] del periodo (carrera del alumno). */
    private function anteproyectosPorCarreraYEstado(): array
    {
        $filas = DB::select(
            'SELECT g.id_carrera, a.estado_enviado, COUNT(DISTINCT a.id_anteproyecto) AS total
               FROM resi_anteproyecto a
               JOIN resi_proyecto p ON p.id_proyecto = a.id_proyecto
               JOIN gnral_alumnos g ON g.id_alumno = a.id_alumno
              WHERE a.id_periodo = ?
                AND g.id_carrera NOT IN (' . $this->marcas(self::CARRERAS_EXCLUIDAS) . ')
              GROUP BY g.id_carrera, a.estado_enviado',
            array_merge([$this->idPeriodo], self::CARRERAS_EXCLUIDAS)
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera][(int) $f->estado_enviado] = (int) $f->total;
        }

        return $resultado;
    }

    private function altasPorAutorizar(): array
    {
        return DB::select(
            'SELECT g.id_carrera, COUNT(DISTINCT r.id_alta_residencia) AS total
               FROM resi_alta_residencia r
               JOIN gnral_alumnos g ON g.id_alumno = r.id_alumno
              WHERE r.id_periodo = ?
                AND r.id_estado_solicitud IN (' . $this->marcas(self::ALTA_POR_AUTORIZAR) . ')
                AND g.id_carrera NOT IN (' . $this->marcas(self::CARRERAS_EXCLUIDAS) . ')
              GROUP BY g.id_carrera',
            array_merge([$this->idPeriodo], self::ALTA_POR_AUTORIZAR, self::CARRERAS_EXCLUIDAS)
        );
    }

    /** Uniones de la estadística de residentes (Estadísticas › Institucional). */
    private function uniones(): string
    {
        return 'FROM resi_asesores ra
                JOIN resi_anteproyecto rap ON rap.id_anteproyecto = ra.id_anteproyecto
                JOIN resi_proy_empresa pe ON pe.id_anteproyecto = ra.id_anteproyecto
                JOIN gnral_alumnos g ON g.id_alumno = rap.id_alumno
                JOIN gnral_personales p ON p.id_personal = ra.id_profesor
                JOIN resi_proyecto pr ON pr.id_proyecto = rap.id_proyecto
               WHERE ra.id_periodo = ?
                 AND rap.autorizacion_departamento = 1';
    }

    /** Residentes agrupados por una columna (p. ej. ra.id_carrera): filas (id_carrera, total). */
    private function residentes(string $columna): array
    {
        return DB::select(
            'SELECT ' . $columna . ' AS id_carrera, COUNT(DISTINCT ra.id_anteproyecto) AS total ' . $this->uniones() . ' GROUP BY ' . $columna,
            [$this->idPeriodo]
        );
    }

    private function totalResidentes(int $idPeriodo): int
    {
        $fila = DB::selectOne('SELECT COUNT(DISTINCT ra.id_anteproyecto) AS total ' . $this->uniones(), [$idPeriodo]);

        return (int) ($fila->total ?? 0);
    }

    private function empresas(): int
    {
        $fila = DB::selectOne('SELECT COUNT(DISTINCT pe.id_empresa) AS total ' . $this->uniones(), [$this->idPeriodo]);

        return (int) ($fila->total ?? 0);
    }

    /** [['giro', 'total']] (catálogo resi_giro). */
    private function residentesPorGiro(): array
    {
        $filas = DB::select(
            'SELECT COALESCE(gi.descripcion, \'Sin giro\') AS giro, COUNT(DISTINCT ra.id_anteproyecto) AS total
               FROM resi_asesores ra
               JOIN resi_anteproyecto rap ON rap.id_anteproyecto = ra.id_anteproyecto
               JOIN resi_proy_empresa pe ON pe.id_anteproyecto = ra.id_anteproyecto
               JOIN gnral_alumnos g ON g.id_alumno = rap.id_alumno
               JOIN gnral_personales p ON p.id_personal = ra.id_profesor
               JOIN resi_proyecto pr ON pr.id_proyecto = rap.id_proyecto
               LEFT JOIN resi_giro gi ON gi.id_giro = pe.id_giro
              WHERE ra.id_periodo = ?
                AND rap.autorizacion_departamento = 1
              GROUP BY gi.id_giro, gi.descripcion
              ORDER BY total DESC, giro',
            [$this->idPeriodo]
        );

        return array_map(fn ($f) => ['giro' => (string) $f->giro, 'total' => (int) $f->total], $filas);
    }

    /** [id_carrera => [id_calificar_departamento => residentes]] (Autorizar impresión de acta). */
    private function actasPorCarrera(): array
    {
        $filas = DB::select(
            'SELECT ga.id_carrera, pg.id_calificar_departamento AS estado, COUNT(DISTINCT rap.id_anteproyecto) AS total
               FROM resi_asesores ra
               JOIN resi_anteproyecto rap ON rap.id_anteproyecto = ra.id_anteproyecto
               JOIN gnral_alumnos ga ON ga.id_alumno = rap.id_alumno
               JOIN gnral_carreras gc ON gc.id_carrera = ga.id_carrera
               JOIN resi_promedio_general_residencia pg ON pg.id_anteproyecto = rap.id_anteproyecto
              WHERE ra.id_periodo = ?
                AND pg.id_calificar_departamento IN (0, 1)
              GROUP BY ga.id_carrera, pg.id_calificar_departamento',
            [$this->idPeriodo]
        );

        $resultado = [];
        foreach ($filas as $f) {
            $resultado[(int) $f->id_carrera][(int) $f->estado] = (int) $f->total;
        }

        return $resultado;
    }

    private function docentesDistintos(string $tabla): int
    {
        return (int) DB::table($tabla)->where('id_periodo', $this->idPeriodo)->distinct()->count('id_profesor');
    }

    /** Anteproyectos y residentes del periodo actual y los 5 anteriores que existan. */
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
                'anteproyectos' => (int) DB::table('resi_anteproyecto')->where('id_periodo', $p->id_periodo)->distinct()->count('id_anteproyecto'),
                'residentes' => $this->totalResidentes((int) $p->id_periodo),
            ];
        }

        return $resultado;
    }
}
