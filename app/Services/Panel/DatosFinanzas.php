<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil FINANZAS (sesión "finanzas", departamento 10).
 * Ver docs/DASHBOARD_FINANZAS.md.
 *
 * Las pantallas de presupuesto trabajan por EJERCICIO FISCAL (año calendario), no por periodo escolar:
 * presupuesto autorizado = date('Y') y anteproyecto = date('Y') + 1. Este servicio usa la misma regla.
 * Solo consultas de lectura con parámetros enlazados; cada indicador replica la regla de una pantalla del rol:
 *
 *  - Autorizado: Presupuesto autorizado › Agregar presupuesto autorizado (Pres_aut_agregar_presuController@index):
 *    suma de las 12 columnas mensuales de pres_aut_presupuesto_aut del año.
 *  - Vigente (PM), ejercido (PE) y disponible (PS): Presupuesto autorizado para modificar (…@presupesto_partida_copia):
 *    PM = columnas mensuales de pres_aut_presupuesto_aut_copia; PE = presupuesto_dado de las solicitudes del año, por
 *    partida del presupuesto y mes 1-12, sin filtrar por estado; PS = PM - PE.
 *  - Solicitudes por estado: Revisión de solicitudes (estado 2) y Solicitudes autorizadas liberadas (estado 4)
 *    (Pres_aut_revisionController), con sus mismas condiciones (unidad con jefe registrado, proyecto, meta y mes);
 *    se cuentan solicitudes distintas.
 *  - Requisiciones del anteproyecto por revisar: Revisión de requisiciones (Pres_revision_req_anteController@index):
 *    año + 1, estado 1 (enviada) o 3 (reenviada con modificaciones).
 *
 * Caché de 10 minutos por año (no depende del usuario). Si algo falla se devuelve null y la vista muestra el estado
 * vacío. No se leen ni se muestran nombres de personas.
 */
class DatosFinanzas
{
    public const MINUTOS_CACHE = 10;

    public const MESES = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
        7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'];

    /** Columnas mensuales de pres_aut_presupuesto_aut(_copia), en orden. */
    public const COLUMNAS_MES = ['enero_pres', 'febrero_pres', 'marzo_pres', 'abril_pres', 'mayo_pres', 'junio_pres',
        'julio_pres', 'agosto_pres', 'septiembre_pres', 'octubre_pres', 'noviembre_pres', 'diciembre_pres'];

    /** pres_aut_solicitudes.id_estado_enviado (según el código que los asigna; los catálogos no tienen nombres reales). */
    public const ESTADOS_SOLICITUD = [
        'captura' => [0, 1],   // en captura del departamento o registrada por Finanzas
        'por_revisar' => [2],  // enviada a Finanzas (Revisión de solicitudes)
        'devueltas' => [3],    // devuelta para modificar
        'autorizadas' => [4],  // autorizada y liberada
    ];

    /** pres_req_mat_ante.id_estado_requisicion que revisa Finanzas (1 enviada, 3 reenviada). */
    public const ESTADOS_REQUISICION_POR_REVISAR = [1, 3];

    public const PARTIDAS_GRAFICA = 8;

    public const SOLICITUDES_TABLA = 5;

    public function __construct(private readonly int $anio)
    {
    }

    /** Datos del dashboard para un ejercicio fiscal (con caché de 10 minutos). */
    public static function paraAnio(int $anio): ?array
    {
        if ($anio <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:finanzas:anio:' . $anio,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($anio))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel finanzas: no se pudieron calcular los datos del dashboard', [
                'anio' => $anio,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $autorizadoMeses = $this->mensual('pres_aut_presupuesto_aut');
        $vigenteMeses = $this->mensual('pres_aut_presupuesto_aut_copia');
        $ejercidoMeses = $this->ejercidoPorMes();

        $vigente = round(array_sum($vigenteMeses), 2);
        $ejercido = round(array_sum($ejercidoMeses), 2);
        $solicitudes = $this->solicitudesPorEstado();

        $meses = [];
        foreach (self::MESES as $n => $nombre) {
            $meses[] = ['mes' => $nombre, 'vigente' => $vigenteMeses[$n], 'ejercido' => $ejercidoMeses[$n]];
        }

        return [
            'anio' => $this->anio,
            'anio_anteproyecto' => $this->anio + 1,
            'autorizado' => round(array_sum($autorizadoMeses), 2),
            'vigente' => $vigente,
            'ejercido' => $ejercido,
            'disponible' => round($vigente - $ejercido, 2),
            'porcentaje_ejercido' => $vigente > 0 ? round($ejercido * 100 / $vigente, 2) : null,
            'solicitudes' => $solicitudes,
            'requisiciones_por_revisar' => $this->requisicionesPorRevisar(),
            'meses' => $meses,
            'partidas' => $this->ejercidoPorPartida(),
            'por_revisar' => $this->solicitudesPorRevisar(),
        ];
    }

    /** [1..12 => suma del mes] de las columnas mensuales de la tabla de presupuesto (autorizado o copia) del año. */
    private function mensual(string $tabla): array
    {
        $sumas = implode(', ', array_map(fn ($c) => "COALESCE(SUM($c), 0) AS $c", self::COLUMNAS_MES));
        $fila = DB::selectOne("SELECT $sumas FROM $tabla WHERE year_presupuesto = ?", [$this->anio]);

        $resultado = [];
        foreach (self::COLUMNAS_MES as $i => $columna) {
            $resultado[$i + 1] = round((float) ($fila->{$columna} ?? 0), 2);
        }

        return $resultado;
    }

    /** [1..12 => presupuesto ejercido] (regla "PE" de Presupuesto autorizado para modificar). */
    private function ejercidoPorMes(): array
    {
        $filas = DB::select(
            'SELECT s.id_mes, SUM(sp.presupuesto_dado) AS total
               FROM pres_aut_solicitudes s
               JOIN pres_aut_solicitudes_partidas sp ON sp.id_solicitud = s.id_solicitud
               JOIN pres_aut_presupuesto_aut_copia c ON c.id_partida = sp.id_partida_pres AND c.year_presupuesto = s.year_presupuesto
              WHERE s.year_presupuesto = ?
                AND s.id_mes BETWEEN 1 AND 12
              GROUP BY s.id_mes',
            [$this->anio]
        );

        $resultado = array_fill(1, 12, 0.0);
        foreach ($filas as $f) {
            $resultado[(int) $f->id_mes] = round((float) $f->total, 2);
        }

        return $resultado;
    }

    /** Las partidas con más presupuesto ejercido del año: [['clave', 'nombre', 'ejercido']]. */
    private function ejercidoPorPartida(): array
    {
        $filas = DB::select(
            'SELECT p.clave_presupuestal AS clave, p.nombre_partida AS nombre, SUM(sp.presupuesto_dado) AS total
               FROM pres_aut_solicitudes s
               JOIN pres_aut_solicitudes_partidas sp ON sp.id_solicitud = s.id_solicitud
               JOIN pres_aut_presupuesto_aut_copia c ON c.id_partida = sp.id_partida_pres AND c.year_presupuesto = s.year_presupuesto
               JOIN pres_partida_pres p ON p.id_partida_pres = sp.id_partida_pres
              WHERE s.year_presupuesto = ?
                AND s.id_mes BETWEEN 1 AND 12
              GROUP BY p.id_partida_pres, p.clave_presupuestal, p.nombre_partida
             HAVING SUM(sp.presupuesto_dado) > 0
              ORDER BY total DESC, p.clave_presupuestal
              LIMIT ' . self::PARTIDAS_GRAFICA,
            [$this->anio]
        );

        return array_map(fn ($f) => ['clave' => (string) $f->clave, 'nombre' => (string) $f->nombre, 'ejercido' => round((float) $f->total, 2)], $filas);
    }

    /**
     * Condiciones de las pantallas de revisión para una solicitud "s": unidad, proyecto, meta y mes existentes, y una
     * persona con abreviación registrada en la unidad (las pantallas la usan para mostrar al jefe; aquí solo se exige
     * que exista, sin leer su nombre).
     */
    private function condicionesSolicitud(): string
    {
        return 'JOIN gnral_unidad_administrativa ua ON ua.id_unidad_admin = s.id_unidad_admin
                JOIN pres_proyectos pr ON pr.id_proyecto = s.id_proyecto
                JOIN pres_metas me ON me.id_meta = s.id_meta
                JOIN pres_mes ms ON ms.id_mes = s.id_mes
               WHERE s.year_presupuesto = ?
                 AND EXISTS (SELECT 1 FROM gnral_unidad_personal up
                               JOIN gnral_personales gp ON gp.id_personal = up.id_personal
                               JOIN abreviaciones_prof ap ON ap.id_personal = gp.id_personal
                               JOIN abreviaciones ab ON ab.id_abreviacion = ap.id_abreviacion
                              WHERE up.id_unidad_admin = s.id_unidad_admin)';
    }

    /** ['captura' => n, 'por_revisar' => n, 'devueltas' => n, 'autorizadas' => n] (solicitudes distintas del año). */
    private function solicitudesPorEstado(): array
    {
        $filas = DB::select(
            'SELECT s.id_estado_enviado AS estado, COUNT(DISTINCT s.id_solicitud) AS total
               FROM pres_aut_solicitudes s ' . $this->condicionesSolicitud() . '
              GROUP BY s.id_estado_enviado',
            [$this->anio]
        );
        $porEstado = [];
        foreach ($filas as $f) {
            $porEstado[(int) $f->estado] = (int) $f->total;
        }

        $resultado = [];
        foreach (self::ESTADOS_SOLICITUD as $clave => $estados) {
            $resultado[$clave] = array_sum(array_map(fn ($e) => $porEstado[$e] ?? 0, $estados));
        }

        return $resultado;
    }

    /** Las solicitudes por revisar más recientes: departamento, proyecto, mes e importe (sin nombres de personas). */
    private function solicitudesPorRevisar(): array
    {
        $filas = DB::select(
            'SELECT s.id_solicitud, ua.nom_departamento AS departamento, pr.nombre_proyecto AS proyecto, s.id_mes, s.fecha_enviado,
                    (SELECT COALESCE(SUM(sp.importe_total), 0) FROM pres_aut_solicitudes_partidas sp WHERE sp.id_solicitud = s.id_solicitud) AS importe
               FROM pres_aut_solicitudes s ' . $this->condicionesSolicitud() . '
                AND s.id_estado_enviado = 2
              ORDER BY s.fecha_enviado DESC, s.id_solicitud DESC
              LIMIT ' . self::SOLICITUDES_TABLA,
            [$this->anio]
        );

        return array_map(fn ($f) => [
            'departamento' => (string) $f->departamento,
            'proyecto' => (string) $f->proyecto,
            'mes' => self::MESES[(int) $f->id_mes] ?? '—',
            'importe' => round((float) $f->importe, 2),
        ], $filas);
    }

    /** Requisiciones del anteproyecto (año + 1) que Finanzas tiene por revisar (Revisión de requisiciones). */
    private function requisicionesPorRevisar(): int
    {
        $marcas = implode(', ', array_fill(0, count(self::ESTADOS_REQUISICION_POR_REVISAR), '?'));
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT r.id_req_mat_ante) AS total
               FROM pres_req_mat_ante r
               JOIN gnral_unidad_administrativa ua ON ua.id_unidad_admin = r.id_unidad_admin
              WHERE r.year_requisicion = ?
                AND r.id_estado_requisicion IN (' . $marcas . ')
                AND EXISTS (SELECT 1 FROM gnral_unidad_personal up
                              JOIN gnral_personales gp ON gp.id_personal = up.id_personal
                              JOIN abreviaciones_prof ap ON ap.id_personal = gp.id_personal
                              JOIN abreviaciones ab ON ab.id_abreviacion = ap.id_abreviacion
                             WHERE up.id_unidad_admin = r.id_unidad_admin)',
            array_merge([$this->anio + 1], self::ESTADOS_REQUISICION_POR_REVISAR)
        );

        return (int) ($fila->total ?? 0);
    }
}
