<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil CENTRO DE CÓMPUTO (sesión "computo": tipo_usuario 2 y
 * gnral_personales.id_departamento 7, HomeController.php:627-635). Ver docs/DASHBOARD_COMPUTO.md.
 *
 * Base temporal mixta, igual que las pantallas del rol:
 *  - PERIODO seleccionado: Servicios Escolares › Calificar (Computo_calificarController@index: eva_validacion_de_cargas
 *    del periodo con estado_validacion 2, 8 o 9) y los horarios fijos de Laboratorios
 *    (Lb_laboratoriosController@laboratorios: lb_profesores_materia del periodo con un profesor existente).
 *  - AÑO en curso: apartados de laboratorio (lb_registro_laboratorio.fecha_registro, texto 'Y-m-d') y la encuesta de
 *    satisfacción del servicio de mantenimiento (Enc_mantenimientoController / Enc_servicioController, por year y mes:
 *    id_estado 0 registrado, 1 encuesta enviada, 2 contestada, 3 cerrada sin contestar).
 *  - Sin base temporal: cuentas por tipo y cuentas sin registro (Computo_calificarController@ver_usuario_estudiante,
 *    ver_usuario_personal_tesvb y ver_usuario_facilitadores), con una consulta agrupada en lugar de una por cuenta.
 *
 * NUNCA se seleccionan correos, contraseñas (computo_user no se lee), nombres o cuentas de alumnos, nombres de
 * profesores ni textos libres (descripcion_utilizar, servicio_solicita, sugerencias): solo ids, conteos, carrera,
 * laboratorio (catálogo), día y mes. Caché de 10 minutos por periodo y año. Si algo falla se devuelve null.
 */
class DatosComputo
{
    public const MINUTOS_CACHE = 10;

    /** Carreras que las pantallas del rol no listan. */
    public const CARRERAS_EXCLUIDAS = [9, 11, 15];

    /** eva_validacion_de_cargas.estado_validacion que lista "Calificar". */
    public const CARGA_VALIDADA = [2, 8, 9];

    /** enc_servicio_mantenimiento.id_estado. */
    public const ENCUESTA_ENVIADA = 1;

    public const ENCUESTA_CONTESTADA = 2;

    /** users.tipo_usuario que revisan las pantallas de Herramientas. */
    public const TIPOS_CUENTA = [1 => 'Estudiantes', 2 => 'Personal TESVB', 3 => 'Facilitadores'];

    public const DIAS = ['LUNES' => 'Lunes', 'MARTES' => 'Martes', 'MIÉRCOLES' => 'Miércoles', 'JUEVES' => 'Jueves',
        'VIERNES' => 'Viernes', 'SÁBADO' => 'Sábado'];

    public const MESES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'];

    public function __construct(private readonly int $idPeriodo, private readonly int $anio)
    {
    }

    /** Datos del dashboard para un periodo y un año (con caché de 10 minutos). */
    public static function paraPeriodo(int $idPeriodo, int $anio): ?array
    {
        if ($idPeriodo <= 0 || $anio <= 0) {
            return null;
        }

        try {
            return Cache::remember(
                'panel:computo:periodo:' . $idPeriodo . ':anio:' . $anio,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo, $anio))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel cómputo: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'anio' => $anio,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');
        $porCalificar = $this->porCalificar();
        $laboratorios = $this->laboratorios();
        $apartados = $this->apartadosPorMes();
        $mantenimiento = $this->mantenimiento();
        $cuentas = $this->cuentas();

        $meses = [];
        foreach (self::MESES as $i => $mes) {
            $meses[] = ['mes' => $mes, 'apartados' => $apartados[$i + 1] ?? 0, 'servicios' => $mantenimiento['por_mes'][$i + 1] ?? 0];
        }

        return [
            'periodo' => $periodo,
            'anio' => $this->anio,
            'por_calificar' => $porCalificar['total'],
            'laboratorios' => [
                'total' => count($laboratorios['lista']),
                'en_uso' => count(array_filter($laboratorios['lista'], fn ($l) => $l['horas'] > 0)),
                'horas' => array_sum(array_column($laboratorios['lista'], 'horas')),
                'apartados' => array_sum($apartados),
            ],
            'encuestas' => ['por_contestar' => $mantenimiento['por_contestar'], 'contestadas' => $mantenimiento['contestadas']],
            'cuentas' => $cuentas,
            'dias' => $laboratorios['dias'],
            'meses' => $meses,
            'carreras' => $porCalificar['carreras'],
            'lista_laboratorios' => $laboratorios['lista'],
        ];
    }

    /** Alumnos con carga validada del periodo (los que lista "Calificar"), total y por carrera. */
    private function porCalificar(): array
    {
        $filas = DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', self::CARGA_VALIDADA)
            ->groupBy('c.id_carrera', 'c.siglas', 'c.nombre')
            ->orderBy('c.id_carrera')
            ->selectRaw('c.id_carrera, c.siglas, c.nombre, COUNT(DISTINCT v.id_alumno) as total')
            ->get();

        $carreras = [];
        foreach ($filas as $f) {
            if (! in_array((int) $f->id_carrera, self::CARRERAS_EXCLUIDAS, true)) {
                $carreras[] = ['siglas' => (string) ($f->siglas ?: $f->nombre), 'nombre' => (string) $f->nombre, 'total' => (int) $f->total];
            }
        }

        // El total es el de la pantalla "Calificar", que no excluye carreras.
        $total = (int) DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', self::CARGA_VALIDADA)
            ->distinct()
            ->count('v.id_alumno');

        return ['total' => $total, 'carreras' => $carreras];
    }

    /** Horarios fijos de laboratorio del periodo (profesor existente), por laboratorio y por día. */
    private function laboratorios(): array
    {
        $filas = DB::table('lb_profesores_materia as pm')
            ->join('gnral_personales as g', 'g.id_personal', '=', 'pm.id_profesor')
            ->leftJoin('hrs_semanas as s', 's.id_semana', '=', 'pm.id_semana')
            ->where('pm.id_periodo', $this->idPeriodo)
            ->groupBy('pm.id_laboratorio', 's.dia')
            ->selectRaw('pm.id_laboratorio, s.dia, COUNT(*) as total')
            ->get();

        $apartadosLab = DB::table('lb_registro_laboratorio')
            ->where('fecha_registro', 'like', $this->anio . '-%')
            ->groupBy('id_laboratorio')
            ->selectRaw('id_laboratorio, COUNT(*) as total')
            ->pluck('total', 'id_laboratorio');

        $horasLab = [];
        $dias = array_fill_keys(array_keys(self::DIAS), 0);
        foreach ($filas as $f) {
            $horasLab[$f->id_laboratorio] = ($horasLab[$f->id_laboratorio] ?? 0) + (int) $f->total;
            $dia = mb_strtoupper(trim((string) $f->dia));
            if ($dia !== '') {
                $dias[$dia] = ($dias[$dia] ?? 0) + (int) $f->total;
            }
        }

        $lista = [];
        foreach (DB::table('lb_laboratorios')->orderBy('id_laboratorio')->get(['id_laboratorio', 'descripcion']) as $l) {
            $lista[] = [
                'laboratorio' => (string) $l->descripcion,
                'horas' => $horasLab[$l->id_laboratorio] ?? 0,
                'apartados' => (int) ($apartadosLab[$l->id_laboratorio] ?? 0),
            ];
        }

        $porDia = [];
        foreach ($dias as $dia => $total) {
            $porDia[] = ['dia' => self::DIAS[$dia] ?? mb_convert_case($dia, MB_CASE_TITLE), 'total' => $total];
        }

        return ['lista' => $lista, 'dias' => $porDia];
    }

    /** Apartados de laboratorio del año, por mes (fecha_registro es texto 'Y-m-d'). */
    private function apartadosPorMes(): array
    {
        $porMes = [];
        foreach (DB::table('lb_registro_laboratorio')->where('fecha_registro', 'like', $this->anio . '-%')->pluck('fecha_registro') as $fecha) {
            $mes = (int) substr((string) $fecha, 5, 2);
            if ($mes >= 1 && $mes <= 12) {
                $porMes[$mes] = ($porMes[$mes] ?? 0) + 1;
            }
        }

        return $porMes;
    }

    /** Servicios de mantenimiento del año (por mes) y encuestas enviadas sin contestar y contestadas. */
    private function mantenimiento(): array
    {
        $filas = DB::table('enc_servicio_mantenimiento')
            ->where('year', $this->anio)
            ->groupBy('mes', 'id_estado')
            ->selectRaw('mes, id_estado, COUNT(*) as total')
            ->get();

        $porMes = [];
        $porContestar = 0;
        $contestadas = 0;
        foreach ($filas as $f) {
            $mes = (int) $f->mes;
            if ($mes >= 1 && $mes <= 12) {
                $porMes[$mes] = ($porMes[$mes] ?? 0) + (int) $f->total;
            }
            if ((int) $f->id_estado === self::ENCUESTA_ENVIADA) {
                $porContestar += (int) $f->total;
            } elseif ((int) $f->id_estado === self::ENCUESTA_CONTESTADA) {
                $contestadas += (int) $f->total;
            }
        }

        return ['por_mes' => $porMes, 'por_contestar' => $porContestar, 'contestadas' => $contestadas];
    }

    /** Cuentas por tipo y cuántas no tienen su registro (solo id y tipo_usuario de users). */
    private function cuentas(): array
    {
        $filas = DB::select(
            'SELECT u.tipo_usuario, COUNT(*) AS cuentas,
                    SUM(CASE u.tipo_usuario
                          WHEN 1 THEN NOT EXISTS (SELECT 1 FROM gnral_alumnos a WHERE a.id_usuario = u.id)
                          WHEN 2 THEN NOT EXISTS (SELECT 1 FROM gnral_personales p WHERE p.tipo_usuario = u.id)
                          WHEN 3 THEN NOT EXISTS (SELECT 1 FROM in_profesores_ingles f WHERE f.id_tipo_usuario = u.id)
                        END) AS sin_registro
             FROM users u
             WHERE u.tipo_usuario IN (1, 2, 3)
             GROUP BY u.tipo_usuario'
        );
        $porTipo = collect($filas)->keyBy(fn ($f) => (int) $f->tipo_usuario);

        $tipos = [];
        foreach (self::TIPOS_CUENTA as $tipo => $etiqueta) {
            $tipos[] = [
                'tipo' => $etiqueta,
                'cuentas' => (int) ($porTipo[$tipo]->cuentas ?? 0),
                'sin_registro' => (int) ($porTipo[$tipo]->sin_registro ?? 0),
            ];
        }

        return [
            'total' => array_sum(array_column($tipos, 'cuentas')),
            'sin_registro' => array_sum(array_column($tipos, 'sin_registro')),
            'tipos' => $tipos,
        ];
    }
}
