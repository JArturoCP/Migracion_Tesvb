<?php

namespace App\Services\Panel;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil TITULACIÓN (sesión "titulacion": tipo_usuario 2 y
 * gnral_personales.id_departamento 9, HomeController.php:645-652). Ver docs/DASHBOARD_TITULACION.md.
 *
 * Las tablas ti_* no tienen periodo escolar: los pendientes y las etapas se calculan con el ESTADO ACTUAL (como las
 * pantallas) y las gráficas por mes usan el año calendario. Cada indicador replica la regla de una pantalla del rol:
 *
 *  - Requisitos por revisar (1.ª etapa): Ti_autorizar_doc_departamentoController@index → ti_requisitos_titulacion
 *    con id_estado_enviado 1 (enviado) o 3 (reenviado), del alumno registrado (ti_descuentos_alum, gnral_alumnos).
 *  - Datos personales por autorizar (2.ª etapa): Ti_autorizar_dat_personalesController@carrera_alum_reg_datos →
 *    ti_reg_datos_alum con estado 1 o 3 y carrera existente.
 *  - Jurados por revisar (3.ª etapa): Ti_autorizar_juradoController@index → ti_fecha_jurado_alumn con estado 1 o 3.
 *  - Por validar para agendar jurado: Ti_registro_juradoController@validacion_agregar_jurado_alumnos →
 *    id_enviado_biblioteca = 1 e id_autorizar_agendar_jurado = 0.
 *  - Titulaciones por autorizar: Ti_formulario_datostituladoController@autorizar_titulacion_alumnos → jurado
 *    autorizado (estado 4) y ti_datos_alumno_reg_dep.id_autorizacion = 0.
 *  - Próximas titulaciones: calendario (Ti_calendario_estudianteController) → jurado autorizado con fecha_titulacion
 *    entre hoy y hoy + 30 días.
 *  - Liberados: Ti_liberacion_tituladoController → ti_datos_alumno_reg_dep.id_liberado_titulado = 1 (por año según
 *    ti_descuentos_alum.fecha_liberacion).
 *
 * Las fechas son columnas de texto capturadas en formularios (el calendario usa d-m-Y; hay registros en Y-m-d): se
 * leen en PHP con ambos formatos y las que no se pueden leer no entran en los conteos por fecha.
 * NUNCA se seleccionan datos personales del alumno (nombre, número de cuenta, CURP, correo, teléfono, domicilio).
 * Caché de 10 minutos por año. Si algo falla se devuelve null y la vista muestra el estado vacío.
 */
class DatosTitulacion
{
    public const MINUTOS_CACHE = 10;

    public const DIAS_PROXIMAS = 30;

    public const PROXIMAS_TABLA = 5;

    /** Estados de cada etapa (según el código que los asigna; los catálogos no tienen nombres reales). */
    public const ESTADOS_POR_REVISAR = [1, 3];   // enviado y reenviado

    public const ESTADO_AUTORIZADO = 4;

    public const ESTADOS_DATOS_AUTORIZADOS = [4, 5]; // 2.ª etapa: autorizado y entrega final autorizada

    public const AUTORIZACION_TITULACION_COMPLETA = 4; // ti_datos_alumno_reg_dep.id_autorizacion

    public const MESES = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
        7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'];

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
                'panel:titulacion:anio:' . $anio,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($anio))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel titulación: no se pudieron calcular los datos del dashboard', [
                'anio' => $anio,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /** "05-02-2026", "2026-02-05" o "05/02/2026" → fecha; null si no se puede leer. */
    public static function leerFecha(?string $texto): ?CarbonImmutable
    {
        $texto = trim((string) $texto);
        foreach (['/^\d{2}-\d{2}-\d{4}$/' => 'd-m-Y', '/^\d{4}-\d{2}-\d{2}$/' => 'Y-m-d', '/^\d{2}\/\d{2}\/\d{4}$/' => 'd/m/Y'] as $patron => $formato) {
            if (preg_match($patron, $texto)) {
                $fecha = CarbonImmutable::createFromFormat('!' . $formato, $texto);
                if ($fecha && $fecha->format($formato) === $texto) {
                    return $fecha;
                }
            }
        }

        return null;
    }

    public function calcular(): array
    {
        $hoy = CarbonImmutable::today();
        $limite = $hoy->addDays(self::DIAS_PROXIMAS);

        // Actos con jurado autorizado (fecha en texto: se lee en PHP). Sin datos personales.
        $actos = DB::table('ti_fecha_jurado_alumn as f')
            ->join('ti_reg_datos_alum as a', 'a.id_alumno', '=', 'f.id_alumno')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
            ->leftJoin('ti_horarios_dias as h', 'h.id_horarios_dias', '=', 'f.id_horarios_dias')
            ->leftJoin('ti_sala as s', 's.id_sala', '=', 'f.id_sala')
            ->leftJoin('ti_opciones_titulacion as o', 'o.id_opcion_titulacion', '=', 'a.id_opcion_titulacion')
            ->where('f.id_estado_enviado', self::ESTADO_AUTORIZADO)
            ->get(['f.id_fecha_jurado_alumn', 'f.fecha_titulacion', 'h.horario_dia', 's.nombre_sala', 'c.siglas', 'c.nombre as carrera', 'o.opcion_titulacion']);

        $titulacionesMes = array_fill(1, 12, 0);
        $proximas = [];
        foreach ($actos as $acto) {
            $fecha = self::leerFecha($acto->fecha_titulacion);
            if (! $fecha) {
                continue;
            }
            if ($fecha->year === $this->anio) {
                $titulacionesMes[$fecha->month]++;
            }
            if ($fecha->betweenIncluded($hoy, $limite)) {
                $proximas[] = [
                    'fecha' => $fecha->format('d/m/Y'),
                    'orden' => $fecha->format('Y-m-d') . ' ' . ($acto->horario_dia ?? ''),
                    'horario' => $acto->horario_dia ?: '—',
                    'sala' => $acto->nombre_sala ?: '—',
                    'carrera' => (string) $acto->siglas,
                    'carrera_nombre' => (string) $acto->carrera,
                    'opcion' => $acto->opcion_titulacion ?: '—',
                ];
            }
        }
        usort($proximas, fn ($x, $y) => strcmp($x['orden'], $y['orden']));

        // Liberados: total y por mes del año (fecha de liberación en ti_descuentos_alum).
        $liberados = DB::table('ti_datos_alumno_reg_dep as r')
            ->leftJoin('ti_descuentos_alum as d', 'd.id_alumno', '=', 'r.id_alumno')
            ->where('r.id_liberado_titulado', 1)
            ->get(['r.id_alumno', 'd.fecha_liberacion']);
        $liberacionesMes = array_fill(1, 12, 0);
        $liberadosAnio = 0;
        foreach ($liberados as $liberado) {
            $fecha = self::leerFecha($liberado->fecha_liberacion);
            if ($fecha && $fecha->year === $this->anio) {
                $liberadosAnio++;
                $liberacionesMes[$fecha->month]++;
            }
        }

        $meses = [];
        foreach (self::MESES as $n => $nombre) {
            $meses[] = ['mes' => $nombre, 'titulaciones' => $titulacionesMes[$n], 'liberaciones' => $liberacionesMes[$n]];
        }

        $pendientes = [
            'requisitos' => $this->requisitosPorRevisar(),
            'datos_personales' => $this->datosPorAutorizar(),
            'jurados' => $this->juradosPorRevisar(),
            'titulaciones' => $this->titulacionesPorAutorizar(),
        ];

        return [
            'anio' => $this->anio,
            'pendientes' => $pendientes,
            'por_validar_jurado' => $this->porValidarAgendarJurado(),
            'proximas' => [
                'total' => count($proximas),
                'dias' => self::DIAS_PROXIMAS,
                'lista' => array_map(fn ($p) => array_diff_key($p, ['orden' => true]), array_slice($proximas, 0, self::PROXIMAS_TABLA)),
            ],
            'liberados' => ['anio' => $liberadosAnio, 'total' => $liberados->count()],
            'etapas' => $this->etapas($liberados->count()),
            'meses' => $meses,
            'carreras' => $this->enProcesoPorCarrera(),
        ];
    }

    /** "?, ?" para listas fijas en cláusulas IN (los valores van como parámetros enlazados). */
    private function marcas(array $valores): string
    {
        return implode(', ', array_fill(0, count($valores), '?'));
    }

    private function requisitosPorRevisar(): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT r.id_alumno) AS total
               FROM ti_requisitos_titulacion r
               JOIN ti_descuentos_alum d ON d.id_alumno = r.id_alumno
               JOIN gnral_alumnos g ON g.id_alumno = d.id_alumno
              WHERE r.id_estado_enviado IN (' . $this->marcas(self::ESTADOS_POR_REVISAR) . ')',
            self::ESTADOS_POR_REVISAR
        );

        return (int) ($fila->total ?? 0);
    }

    private function datosPorAutorizar(): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT a.id_alumno) AS total
               FROM ti_reg_datos_alum a
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
              WHERE a.id_estado_enviado IN (' . $this->marcas(self::ESTADOS_POR_REVISAR) . ')',
            self::ESTADOS_POR_REVISAR
        );

        return (int) ($fila->total ?? 0);
    }

    private function juradosPorRevisar(): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT f.id_alumno) AS total
               FROM ti_reg_datos_alum a
               JOIN ti_fecha_jurado_alumn f ON f.id_alumno = a.id_alumno
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
              WHERE f.id_estado_enviado IN (' . $this->marcas(self::ESTADOS_POR_REVISAR) . ')',
            self::ESTADOS_POR_REVISAR
        );

        return (int) ($fila->total ?? 0);
    }

    private function titulacionesPorAutorizar(): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT f.id_alumno) AS total
               FROM ti_descuentos_alum d
               JOIN ti_reg_datos_alum a ON a.id_alumno = d.id_alumno
               JOIN ti_fecha_jurado_alumn f ON f.id_alumno = a.id_alumno
               JOIN ti_datos_alumno_reg_dep r ON r.id_alumno = f.id_alumno
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
              WHERE f.id_estado_enviado = ?
                AND r.id_autorizacion = 0',
            [self::ESTADO_AUTORIZADO]
        );

        return (int) ($fila->total ?? 0);
    }

    private function porValidarAgendarJurado(): int
    {
        $fila = DB::selectOne(
            'SELECT COUNT(DISTINCT f.id_alumno) AS total
               FROM ti_reg_datos_alum a
               JOIN ti_fecha_jurado_alumn f ON f.id_alumno = a.id_alumno
              WHERE a.id_enviado_biblioteca = 1
                AND f.id_autorizar_agendar_jurado = 0'
        );

        return (int) ($fila->total ?? 0);
    }

    /** Alumnos que alcanzaron cada etapa (estado actual). */
    private function etapas(int $liberados): array
    {
        $contar = fn (string $sql, array $params = []) => (int) (DB::selectOne($sql, $params)->total ?? 0);

        return [
            ['etapa' => 'Registrados', 'total' => $contar('SELECT COUNT(DISTINCT id_alumno) AS total FROM ti_descuentos_alum')],
            ['etapa' => 'Requisitos autorizados', 'total' => $contar('SELECT COUNT(DISTINCT id_alumno) AS total FROM ti_requisitos_titulacion WHERE id_estado_enviado = ?', [self::ESTADO_AUTORIZADO])],
            ['etapa' => 'Datos personales autorizados', 'total' => $contar('SELECT COUNT(DISTINCT id_alumno) AS total FROM ti_reg_datos_alum WHERE id_estado_enviado IN (' . $this->marcas(self::ESTADOS_DATOS_AUTORIZADOS) . ')', self::ESTADOS_DATOS_AUTORIZADOS)],
            ['etapa' => 'Jurado autorizado', 'total' => $contar('SELECT COUNT(DISTINCT id_alumno) AS total FROM ti_fecha_jurado_alumn WHERE id_estado_enviado = ?', [self::ESTADO_AUTORIZADO])],
            ['etapa' => 'Titulación autorizada', 'total' => $contar('SELECT COUNT(DISTINCT id_alumno) AS total FROM ti_datos_alumno_reg_dep WHERE id_autorizacion = ?', [self::AUTORIZACION_TITULACION_COMPLETA])],
            ['etapa' => 'Liberados', 'total' => $liberados],
        ];
    }

    /** Alumnos en proceso (con datos de titulación y sin liberar) por carrera: [['siglas', 'nombre', 'total']]. */
    private function enProcesoPorCarrera(): array
    {
        $filas = DB::select(
            'SELECT c.id_carrera, c.siglas, c.nombre, COUNT(DISTINCT a.id_alumno) AS total
               FROM ti_reg_datos_alum a
               JOIN gnral_carreras c ON c.id_carrera = a.id_carrera
               LEFT JOIN ti_datos_alumno_reg_dep r ON r.id_alumno = a.id_alumno
              WHERE COALESCE(r.id_liberado_titulado, 0) <> 1
              GROUP BY c.id_carrera, c.siglas, c.nombre
              ORDER BY c.id_carrera'
        );

        return array_map(fn ($f) => ['siglas' => (string) $f->siglas, 'nombre' => (string) $f->nombre, 'total' => (int) $f->total], $filas);
    }
}
