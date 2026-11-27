<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del dashboard de /inicio para el perfil SERVICIOS ESCOLARES (sesión "escolar": tipo_usuario 2 y
 * gnral_personales.id_departamento 5, HomeController.php:609-617). Ver docs/DASHBOARD_ESCOLARES.md.
 *
 * Todo es del PERIODO seleccionado (Session::get('periodo_actual'), igual que las pantallas del rol). La tabla central es
 * eva_validacion_de_cargas (un renglón por alumno y periodo; validacion_de_cargaController y
 * Dual_Validar_Carga_Academica_Alumno): estado_validacion 1 y 888 = por revisar, 2 / 8 / 9 = aceptada (normal, dual
 * nueva, dual antigua), 3 = rechazada, 10 y 11 = baja temporal, 12 y 13 = baja definitiva.
 *  - Inscritos: carga aceptada (misma regla que DatosDirectivo::VALIDACION_INSCRITO, Estadísticas y Registrar semestre).
 *  - Sin semestre registrado: Registrar semestre al estudiante (Cal_semestre_regController@registrar_semestre_al):
 *    carga aceptada, gnral_alumnos.id_disponible = 0 y sin renglón en eva_semestre_alumno.
 *  - Becas: Solicitudes de beca (Beca_SolicitudController@escolares_autorizar): beca_autorizar.id_estado 1 = por revisar
 *    en Escolares, 5 = autorizada.
 *  - Encuestas de inscripción (Enc_incripcionController@encuesta_incripcion_periodo): enc_incripcion.id_estado 1 =
 *    enviada, 0 = sin enviar.
 *
 * No se toca cal_evaluaciones ni el historial académico (las tablas más grandes): solo conteos AGRUPADOS en la base
 * (nunca se traen alumnos a memoria). NUNCA se seleccionan nombre, cuenta, CURP, correo, domicilio, edad, género ni
 * municipio: solo ids, conteos, carrera, semestre y periodo. Caché de 10 minutos por periodo. Si algo falla, null.
 */
class DatosEscolares
{
    public const MINUTOS_CACHE = 10;

    public const PERIODOS_HISTORICO = 6;

    /** Carreras que las pantallas del rol no listan. */
    public const CARRERAS_EXCLUIDAS = [9, 11, 15];

    /** eva_validacion_de_cargas.estado_validacion. */
    public const CARGA_POR_REVISAR = [1, 888];

    public const CARGA_ACEPTADA = [2, 8, 9];

    public const CARGA_RECHAZADA = [3];

    public const BAJA_TEMPORAL = [10, 11];

    public const BAJA_DEFINITIVA = [12, 13];

    /** beca_autorizar.id_estado. */
    public const BECA_POR_REVISAR = 1;

    public const BECA_AUTORIZADA = 5;

    /** enc_incripcion.id_estado. */
    public const ENCUESTA_ENVIADA = 1;

    public const ENCUESTA_SIN_ENVIAR = 0;

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
                'panel:escolar:periodo:' . $idPeriodo,
                now()->addMinutes(self::MINUTOS_CACHE),
                fn () => (new self($idPeriodo))->calcular()
            );
        } catch (\Throwable $e) {
            Log::warning('Panel servicios escolares: no se pudieron calcular los datos del dashboard', [
                'periodo' => $idPeriodo,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function calcular(): array
    {
        $periodo = DB::table('gnral_periodos')->where('id_periodo', $this->idPeriodo)->value('periodo');

        // Alumnos distintos por estado de la carga (una consulta agrupada).
        $porEstado = DB::table('eva_validacion_de_cargas')
            ->where('id_periodo', $this->idPeriodo)
            ->whereIn('estado_validacion', $this->estadosUsados())
            ->groupBy('estado_validacion')
            ->selectRaw('estado_validacion, COUNT(DISTINCT id_alumno) as total')
            ->pluck('total', 'estado_validacion');
        $sumar = fn (array $estados) => (int) array_sum(array_map(fn ($e) => (int) ($porEstado[$e] ?? 0), $estados));

        // Un alumno puede tener más de un renglón con estados aceptados; el total de inscritos se cuenta por alumno.
        $inscritos = $this->alumnosDistintos(self::CARGA_ACEPTADA);
        $bajasTemporales = $this->alumnosDistintos(self::BAJA_TEMPORAL);
        $bajasDefinitivas = $this->alumnosDistintos(self::BAJA_DEFINITIVA);

        $becas = DB::table('beca_autorizar')->where('id_periodo', $this->idPeriodo)
            ->whereIn('id_estado', [self::BECA_POR_REVISAR, self::BECA_AUTORIZADA])
            ->groupBy('id_estado')->selectRaw('id_estado, COUNT(*) as total')->pluck('total', 'id_estado');
        $encuestas = DB::table('enc_incripcion')->where('id_periodo', $this->idPeriodo)
            ->whereIn('id_estado', [self::ENCUESTA_ENVIADA, self::ENCUESTA_SIN_ENVIAR])
            ->groupBy('id_estado')->selectRaw('id_estado, COUNT(*) as total')->pluck('total', 'id_estado');

        $porCarrera = $this->porCarrera();

        return [
            'periodo' => $periodo,
            'inscritos' => $inscritos,
            'por_revisar' => $this->alumnosDistintos(self::CARGA_POR_REVISAR),
            'bajas' => ['temporales' => $bajasTemporales, 'definitivas' => $bajasDefinitivas],
            'sin_semestre' => $this->sinSemestre(),
            'becas' => ['por_revisar' => (int) ($becas[self::BECA_POR_REVISAR] ?? 0), 'autorizadas' => (int) ($becas[self::BECA_AUTORIZADA] ?? 0)],
            'encuestas' => ['enviadas' => (int) ($encuestas[self::ENCUESTA_ENVIADA] ?? 0), 'sin_enviar' => (int) ($encuestas[self::ENCUESTA_SIN_ENVIAR] ?? 0)],
            'cargas' => [
                'por_revisar' => $sumar(self::CARGA_POR_REVISAR),
                'aceptadas' => $sumar(self::CARGA_ACEPTADA),
                'rechazadas' => $sumar(self::CARGA_RECHAZADA),
                'bajas' => $sumar(array_merge(self::BAJA_TEMPORAL, self::BAJA_DEFINITIVA)),
            ],
            'carreras' => $porCarrera,
            'semestres' => $this->porSemestre(),
            'historico' => $this->historico(),
        ];
    }

    private function estadosUsados(): array
    {
        return array_merge(self::CARGA_POR_REVISAR, self::CARGA_ACEPTADA, self::CARGA_RECHAZADA, self::BAJA_TEMPORAL, self::BAJA_DEFINITIVA);
    }

    /** Alumnos distintos del periodo con alguno de los estados. */
    private function alumnosDistintos(array $estados): int
    {
        return (int) DB::table('eva_validacion_de_cargas')
            ->where('id_periodo', $this->idPeriodo)
            ->whereIn('estado_validacion', $estados)
            ->distinct()
            ->count('id_alumno');
    }

    /** Inscritos con carga aceptada, activos y sin semestre registrado (regla de "Registrar semestre"). */
    private function sinSemestre(): int
    {
        return (int) DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', self::CARGA_ACEPTADA)
            ->where('a.id_disponible', 0)
            ->whereNotExists(fn ($q) => $q->select(DB::raw(1))->from('eva_semestre_alumno as s')->whereColumn('s.id_alumno', 'a.id_alumno'))
            ->distinct()
            ->count('v.id_alumno');
    }

    /** Por carrera (sin las excluidas): inscritos, bajas temporales y definitivas, y becas por revisar. */
    private function porCarrera(): array
    {
        $cargas = DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', array_merge(self::CARGA_ACEPTADA, self::BAJA_TEMPORAL, self::BAJA_DEFINITIVA))
            ->groupBy('a.id_carrera')
            ->selectRaw('a.id_carrera,
                COUNT(DISTINCT CASE WHEN v.estado_validacion IN (' . implode(',', self::CARGA_ACEPTADA) . ') THEN v.id_alumno END) as inscritos,
                COUNT(DISTINCT CASE WHEN v.estado_validacion IN (' . implode(',', self::BAJA_TEMPORAL) . ') THEN v.id_alumno END) as temporales,
                COUNT(DISTINCT CASE WHEN v.estado_validacion IN (' . implode(',', self::BAJA_DEFINITIVA) . ') THEN v.id_alumno END) as definitivas')
            ->get()
            ->keyBy('id_carrera');

        $becas = DB::table('beca_autorizar as b')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'b.id_alumno')
            ->where('b.id_periodo', $this->idPeriodo)
            ->where('b.id_estado', self::BECA_POR_REVISAR)
            ->groupBy('a.id_carrera')
            ->selectRaw('a.id_carrera, COUNT(*) as total')
            ->pluck('total', 'id_carrera');

        $resultado = [];
        $carreras = DB::table('gnral_carreras')->whereNotIn('id_carrera', self::CARRERAS_EXCLUIDAS)->orderBy('id_carrera')
            ->get(['id_carrera', 'siglas', 'nombre']);
        foreach ($carreras as $c) {
            $f = $cargas[$c->id_carrera] ?? null;
            $resultado[] = [
                'siglas' => (string) ($c->siglas ?: $c->nombre),
                'nombre' => (string) $c->nombre,
                'inscritos' => (int) ($f->inscritos ?? 0),
                'temporales' => (int) ($f->temporales ?? 0),
                'definitivas' => (int) ($f->definitivas ?? 0),
                'becas' => (int) ($becas[$c->id_carrera] ?? 0),
            ];
        }

        return $resultado;
    }

    /** Inscritos por semestre (solo semestres con inscritos). */
    private function porSemestre(): array
    {
        return DB::table('eva_validacion_de_cargas as v')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'v.id_alumno')
            ->where('v.id_periodo', $this->idPeriodo)
            ->whereIn('v.estado_validacion', self::CARGA_ACEPTADA)
            ->whereNotNull('a.id_semestre')
            ->groupBy('a.id_semestre')
            ->orderBy('a.id_semestre')
            ->selectRaw('a.id_semestre, COUNT(DISTINCT v.id_alumno) as total')
            ->get()
            ->map(fn ($f) => ['semestre' => (int) $f->id_semestre . '.º', 'total' => (int) $f->total])
            ->all();
    }

    /** Inscritos y bajas del periodo y los 5 anteriores que existan (una consulta agrupada). */
    private function historico(): array
    {
        $periodos = DB::table('gnral_periodos')
            ->whereBetween('id_periodo', [$this->idPeriodo - (self::PERIODOS_HISTORICO - 1), $this->idPeriodo])
            ->orderBy('id_periodo')
            ->get(['id_periodo', 'periodo']);

        $bajas = array_merge(self::BAJA_TEMPORAL, self::BAJA_DEFINITIVA);
        $conteos = DB::table('eva_validacion_de_cargas')
            ->whereIn('id_periodo', $periodos->pluck('id_periodo')->all())
            ->whereIn('estado_validacion', array_merge(self::CARGA_ACEPTADA, $bajas))
            ->groupBy('id_periodo')
            ->selectRaw('id_periodo,
                COUNT(DISTINCT CASE WHEN estado_validacion IN (' . implode(',', self::CARGA_ACEPTADA) . ') THEN id_alumno END) as inscritos,
                COUNT(DISTINCT CASE WHEN estado_validacion IN (' . implode(',', $bajas) . ') THEN id_alumno END) as bajas')
            ->get()
            ->keyBy('id_periodo');

        return $periodos->map(fn ($p) => [
            'periodo' => (string) $p->periodo,
            'inscritos' => (int) ($conteos[$p->id_periodo]->inscritos ?? 0),
            'bajas' => (int) ($conteos[$p->id_periodo]->bajas ?? 0),
        ])->all();
    }
}
