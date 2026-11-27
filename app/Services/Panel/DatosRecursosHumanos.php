<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil RECURSOS HUMANOS (sesión "personal": tipo_usuario 2 y
 * gnral_personales.id_departamento 6, HomeController.php:618-626; en el menú, $jefe_personal). Ver docs/DASHBOARD_RH.md.
 *
 * Ninguna pantalla del rol filtra por periodo escolar, así que la base temporal es el AÑO en curso:
 *  - Oficios de comisión: Validar Oficios (OcEvaluacionOficioController / OcRegOficioController),
 *    oc_oficio_personal.id_notificacion 1 enviado a RH (por validar), 2 aceptado, 3 rechazado, 4 devuelto para editar
 *    (5, enviado a subdirección, es un paso previo a RH y no se cuenta). El año es el de oc_oficio.fecha.
 *  - Oficios de incidencia: Incidencias › Historial de oficios de los departamentos (IncidenciasController@vista3),
 *    inc_solicitudes.id_estado_solicitud 2 = autorizado por el jefe; año de fecha_solicitud.
 *  - Evidencias de conocimiento: Incidencias › Validar evidencia (IncidenciasController@validar_evidencia_departamentos),
 *    inc_evidencias.id_autorizado 1 = por validar, 2 = validada, 3 = rechazada; año de fecha_envio.
 *  - Las bandejas pendientes (oficios y evidencias por validar) no se filtran por año, igual que sus pantallas.
 *  - Personal y plantilla (Personal del TESVB, Agregar / Ver Plantilla): estado actual, por perfil, categoría (cargo) y
 *    unidad administrativa (adscripcion_personal).
 *
 * NUNCA se seleccionan nombres, RFC, domicilio, fecha de nacimiento, teléfonos, cédula, correo, sexo, viáticos ni textos
 * libres (desc_comision, motivo_oficio, archivos): solo ids, conteos, fechas para agrupar por mes y catálogos (perfil,
 * cargo, unidad). Caché de 10 minutos por año. Si algo falla se devuelve null.
 */
class DatosRecursosHumanos
{
    public const MINUTOS_CACHE = 10;

    /** oc_oficio_personal.id_notificacion. */
    public const OFICIO_POR_VALIDAR = 1;

    public const OFICIO_ACEPTADO = 2;

    public const OFICIO_RECHAZADO = 3;

    public const OFICIO_DEVUELTO = 4;

    /** inc_solicitudes.id_estado_solicitud. */
    public const INCIDENCIA_AUTORIZADA = 2;

    /** inc_evidencias.id_autorizado. */
    public const EVIDENCIA_POR_VALIDAR = 1;

    public const MESES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'];

    public function __construct(private readonly int $anio)
    {
    }

    /** Datos del dashboard para un año (con caché de 10 minutos). */
    public static function paraAnio(int $anio): ?array
    {
        if ($anio <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:rh:anio:' . $anio,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($anio))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel recursos humanos: no se pudieron calcular los datos del dashboard', [
                'anio' => $anio,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $desde = $this->anio . '-01-01';
        $hasta = ($this->anio + 1) . '-01-01';

        // Personal y plantilla (estado actual).
        $personal = (int) DB::table('gnral_personales')->count();
        $sinAdscripcion = (int) DB::table('gnral_personales as p')
            ->whereNotExists(fn ($q) => $q->select(DB::raw(1))->from('adscripcion_personal as ap')->whereColumn('ap.id_personal', 'p.id_personal'))
            ->count();

        // Bandejas pendientes (sin filtro de año, igual que sus pantallas).
        $oficiosPorValidar = (int) DB::table('oc_oficio_personal')->where('id_notificacion', self::OFICIO_POR_VALIDAR)->count();
        $evidenciasPorValidar = (int) DB::table('inc_evidencias')->where('id_autorizado', self::EVIDENCIA_POR_VALIDAR)->count();

        // Oficios de comisión del año por estado.
        $oficiosEstado = DB::table('oc_oficio_personal as op')
            ->join('oc_oficio as o', 'o.id_oficio', '=', 'op.id_oficio')
            ->where('o.fecha', '>=', $desde)->where('o.fecha', '<', $hasta)
            ->whereIn('op.id_notificacion', [self::OFICIO_POR_VALIDAR, self::OFICIO_ACEPTADO, self::OFICIO_RECHAZADO, self::OFICIO_DEVUELTO])
            ->groupBy('op.id_notificacion')
            ->selectRaw('op.id_notificacion, COUNT(*) as total')
            ->pluck('total', 'id_notificacion');

        // Por mes del año: oficios de comisión (oc_oficio con comisionados), incidencias autorizadas y evidencias.
        $mesesOficios = $this->porMes(
            DB::table('oc_oficio as o')
                ->whereExists(fn ($q) => $q->select(DB::raw(1))->from('oc_oficio_personal as op')->whereColumn('op.id_oficio', 'o.id_oficio')),
            'o.fecha', $desde, $hasta
        );
        $mesesIncidencias = $this->porMes(
            DB::table('inc_solicitudes')->where('id_estado_solicitud', self::INCIDENCIA_AUTORIZADA),
            'fecha_solicitud', $desde, $hasta
        );
        $mesesEvidencias = $this->porMes(DB::table('inc_evidencias'), 'fecha_envio', $desde, $hasta);

        $meses = [];
        foreach (self::MESES as $i => $mes) {
            $meses[] = [
                'mes' => $mes,
                'oficios' => $mesesOficios[$i + 1] ?? 0,
                'incidencias' => $mesesIncidencias[$i + 1] ?? 0,
                'evidencias' => $mesesEvidencias[$i + 1] ?? 0,
            ];
        }

        return [
            'anio' => $this->anio,
            'personal' => $personal,
            'sin_adscripcion' => $sinAdscripcion,
            'oficios' => [
                'por_validar' => $oficiosPorValidar,
                'anio' => [
                    'por_validar' => (int) ($oficiosEstado[self::OFICIO_POR_VALIDAR] ?? 0),
                    'aceptados' => (int) ($oficiosEstado[self::OFICIO_ACEPTADO] ?? 0),
                    'rechazados' => (int) ($oficiosEstado[self::OFICIO_RECHAZADO] ?? 0),
                    'devueltos' => (int) ($oficiosEstado[self::OFICIO_DEVUELTO] ?? 0),
                ],
            ],
            'evidencias_por_validar' => $evidenciasPorValidar,
            'incidencias_autorizadas' => array_sum($mesesIncidencias),
            'meses' => $meses,
            'perfiles' => $this->porCatalogo('gnral_perfiles', 'id_perfil', 'descripcion', 'Sin perfil'),
            'categorias' => $this->porCatalogo('gnral_cargos', 'id_cargo', 'cargo', 'Sin categoría'),
            'unidades' => $this->porUnidad(),
        ];
    }

    /** Conteo por mes (1–12) de una consulta, por los 7 primeros caracteres de la fecha ('Y-m'). */
    private function porMes($consulta, string $columna, string $desde, string $hasta): array
    {
        $filas = $consulta->where($columna, '>=', $desde)->where($columna, '<', $hasta)
            ->groupByRaw("SUBSTR($columna, 1, 7)")
            ->selectRaw("SUBSTR($columna, 1, 7) as mes, COUNT(*) as total")
            ->get();

        $porMes = [];
        foreach ($filas as $f) {
            $mes = (int) substr((string) $f->mes, 5, 2);
            if ($mes >= 1 && $mes <= 12) {
                $porMes[$mes] = ($porMes[$mes] ?? 0) + (int) $f->total;
            }
        }

        return $porMes;
    }

    /** Personal por un catálogo (perfil o categoría), de mayor a menor. */
    private function porCatalogo(string $tabla, string $llave, string $columna, string $sinValor): array
    {
        $filas = DB::table('gnral_personales as p')
            ->leftJoin("$tabla as c", "c.$llave", '=', "p.$llave")
            ->groupBy("c.$llave", "c.$columna")
            ->selectRaw("c.$columna as nombre, COUNT(*) as total")
            ->get();

        $lista = [];
        foreach ($filas as $f) {
            $nombre = trim((string) $f->nombre) ?: $sinValor;
            $lista[$nombre] = ($lista[$nombre] ?? 0) + (int) $f->total;
        }
        $lista = array_map(fn ($nombre, $total) => ['nombre' => (string) $nombre, 'total' => $total], array_keys($lista), $lista);
        // De mayor a menor; a igual total, por nombre, y "sin perfil/categoría" al final.
        usort($lista, fn ($a, $b) => [$b['total'], $a['nombre'] === $sinValor, $a['nombre']] <=> [$a['total'], $b['nombre'] === $sinValor, $b['nombre']]);

        return $lista;
    }

    /** Personas adscritas por unidad administrativa (Ver Plantilla), de mayor a menor. */
    private function porUnidad(): array
    {
        return DB::table('adscripcion_personal as ap')
            ->join('gnral_unidad_personal as up', 'up.id_unidad_persona', '=', 'ap.id_unidad_persona')
            ->join('gnral_unidad_administrativa as ua', 'ua.id_unidad_admin', '=', 'up.id_unidad_admin')
            ->groupBy('ua.id_unidad_admin', 'ua.nom_departamento')
            ->selectRaw('ua.nom_departamento as unidad, COUNT(DISTINCT ap.id_personal) as total')
            ->orderByDesc('total')->orderBy('ua.nom_departamento')
            ->get()
            ->map(fn ($f) => ['unidad' => (string) $f->unidad, 'total' => (int) $f->total])
            ->all();
    }
}
