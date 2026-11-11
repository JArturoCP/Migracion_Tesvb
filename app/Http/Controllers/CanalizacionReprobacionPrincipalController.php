<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CanalizacionReprobacionPrincipalController extends Controller
{
    const CALIFICACION_MINIMA_APROBATORIA = 70;

    public function index(Request $request)
    {
        $personal = $this->resolverPersonalUsuario();

        if (!$personal) {
            return view('canalizacion_reprobacion_principal.index', array(
                'contexto' => array(
                    'permitido' => false,
                    'mensaje' => 'El usuario autenticado no está relacionado con un registro de personal.',
                    'personal' => null,
                    'periodo' => null,
                ),
                'periodosTutor' => collect(),
                'alumnos' => collect(),
                'causasReprobacion' => collect(),
                'areasAtencion' => collect(),
                'filtros' => array(
                    'id_periodo' => null,
                ),
            ));
        }

        // El periodo vigente se determina exclusivamente por la fecha del sistema.
        // No se toma de la sesión, de la URL ni del último periodo asignado al tutor.
        $periodoVigente = $this->obtenerPeriodoVigente();

        if (!$periodoVigente) {
            return view('canalizacion_reprobacion_principal.index', array(
                'contexto' => array(
                    'permitido' => false,
                    'mensaje' => 'No existe un periodo académico vigente para la fecha actual del sistema.',
                    'personal' => $personal,
                    'periodo' => null,
                ),
                'periodosTutor' => collect(),
                'alumnos' => collect(),
                'causasReprobacion' => collect(),
                'areasAtencion' => collect(),
                'filtros' => array(
                    'id_periodo' => null,
                ),
            ));
        }

        $periodoId = (int) $periodoVigente->id_periodo;
        $periodosTutor = $this->obtenerPeriodosTutor($personal->id_personal, $periodoId);

        if ($periodosTutor->isEmpty()) {
            return view('canalizacion_reprobacion_principal.index', array(
                'contexto' => array(
                    'permitido' => false,
                    'mensaje' => 'El usuario autenticado no tiene asignación activa como tutor en el periodo vigente: ' . $periodoVigente->periodo . '.',
                    'personal' => $personal,
                    'periodo' => null,
                ),
                'periodosTutor' => collect(),
                'alumnos' => collect(),
                'causasReprobacion' => collect(),
                'areasAtencion' => collect(),
                'filtros' => array(
                    'id_periodo' => null,
                ),
            ));
        }

        $periodoSeleccionado = $periodosTutor->first();

        $alumnos = $this->obtenerAlumnosReprobadosTutor($personal->id_personal, $periodoId);
        $causasReprobacion = $this->obtenerCausasReprobacion();
        $areasAtencion = $this->obtenerAreasAtencion();

        return view('canalizacion_reprobacion_principal.index', array(
            'contexto' => array(
                'permitido' => true,
                'mensaje' => null,
                'personal' => $personal,
                'periodo' => $periodoSeleccionado,
            ),
            'periodosTutor' => $periodosTutor,
            'alumnos' => $alumnos,
            'causasReprobacion' => $causasReprobacion,
            'areasAtencion' => $areasAtencion,
            'filtros' => array(
                'id_periodo' => $periodoId,
            ),
        ));
    }

    public function guardarCanalizacion(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_carrera' => 'required|integer',
            'id_alumno' => 'required|integer',
            'id_asigna_generacion' => 'required|integer',
            'id_asigna_tutor' => 'required|integer',
            'id_causa_reprobacion' => 'required|integer',
            'id_area_destino' => 'required|integer',
        ), array(
            'id_causa_reprobacion.required' => 'Selecciona la causa de reprobación.',
            'id_area_destino.required' => 'Selecciona el área de canalización.',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();

        if (!$personal) {
            return redirect()->back()->with('error', 'No se pudo identificar al tutor autenticado.');
        }

        $periodoId = (int) $request->get('id_periodo');

        // Impide guardar canalizaciones de periodos históricos o futuros,
        // incluso si el id_periodo del formulario fue modificado manualmente.
        $periodoVigente = $this->obtenerPeriodoVigente();
        if (!$periodoVigente || $periodoId !== (int) $periodoVigente->id_periodo) {
            return redirect()->route('canalizacion_reprobacion_principal.index')
                ->with('error', 'Solo se permiten canalizaciones del periodo académico vigente.');
        }

        $carreraId = (int) $request->get('id_carrera');
        $alumnoId = (int) $request->get('id_alumno');
        $asignaGeneracionId = (int) $request->get('id_asigna_generacion');
        $asignaTutorId = (int) $request->get('id_asigna_tutor');
        $causaId = (int) $request->get('id_causa_reprobacion');
        $areaDestinoId = (int) $request->get('id_area_destino');

        $columnaIdCausa = $this->obtenerColumnaIdCausaReprobacion();

        $consultaCausa = DB::table('ar_causas_reprobacion')
            ->where($columnaIdCausa, $causaId);

        if ($this->tablaTieneColumna('ar_causas_reprobacion', 'activo')) {
            $consultaCausa->where('activo', 1);
        }

        $causa = $consultaCausa->first();

        if (!$causa) {
            return redirect()->back()->withInput()->with('error', 'La causa seleccionada no es válida.');
        }

        // El destino de una canalización de tutoría se resuelve en servidor.
        // Nunca se acepta otro destino aunque el formulario haya sido manipulado.
        $areaDestino = $this->resolverAreaCanalizacion('destino_tutoria');
        if (!$areaDestino) {
            return redirect()->back()->withInput()->with('error',
                'No existe un área activa de Pedagogía general. Revise el catálogo de áreas de atención.');
        }
        if ($areaDestinoId !== (int) $areaDestino->id_area_atencion) {
            return redirect()->back()->withInput()->with('error',
                'El destino inicial debe ser Pedagogía general. Actualice la página y vuelva a intentarlo.');
        }

        // Una canalización de tutoría debe tener origen explícito. No guardar NULL.
        $areaOrigen = $this->resolverAreaCanalizacion('origen_tutoria');
        if (!$areaOrigen) {
            return redirect()->back()->withInput()->with('error',
                'No existe un área activa de Tutoría o Tutorías en ar_areas_atencion. Regístrela en el catálogo antes de canalizar. No se guardaron cambios.');
        }

        $alumnoValido = $this->validarAlumnoPerteneceTutor(
            $personal->id_personal,
            $periodoId,
            $carreraId,
            $alumnoId,
            $asignaGeneracionId,
            $asignaTutorId
        );

        if (!$alumnoValido) {
            return redirect()->back()->with('error', 'El estudiante no pertenece a la asignación activa del tutor en el periodo seleccionado.');
        }

        $tieneReprobacion = $this->alumnoTieneReprobacion($alumnoId, $periodoId);

        if (!$tieneReprobacion) {
            return redirect()->back()->with('error', 'El estudiante no tiene unidades reprobadas en el periodo seleccionado.');
        }

        $fechaActual = date('Y-m-d H:i:s');

        $resultado = DB::transaction(function () use ($periodoId, $carreraId, $alumnoId, $asignaGeneracionId, $asignaTutorId, $personal, $causaId, $areaDestinoId, $areaOrigen, $fechaActual) {
            $caso = DB::table('ar_casos_estudiantes')
                ->where('id_periodo', $periodoId)
                ->where('id_alumno', $alumnoId)
                ->where('origen_caso', 'reprobacion')
                ->first();

            if ($caso) {
                $casoId = $caso->id_ar_caso;
                $estadoCaso = $caso->estado == 'cerrado' ? 'abierto' : $caso->estado;

                DB::table('ar_casos_estudiantes')
                    ->where('id_ar_caso', $casoId)
                    ->update(array(
                        'id_carrera' => $carreraId,
                        'id_asigna_generacion' => $asignaGeneracionId,
                        'id_asigna_tutor' => $asignaTutorId,
                        'id_personal_tutor' => $personal->id_personal,
                        'estado' => $estadoCaso,
                        'updated_at' => $fechaActual,
                    ));
            } else {
                $casoId = DB::table('ar_casos_estudiantes')->insertGetId(array(
                    'id_periodo' => $periodoId,
                    'id_carrera' => $carreraId,
                    'id_alumno' => $alumnoId,
                    'id_asigna_generacion' => $asignaGeneracionId,
                    'id_asigna_tutor' => $asignaTutorId,
                    'id_personal_tutor' => $personal->id_personal,
                    'origen_caso' => 'reprobacion',
                    'estado' => 'abierto',
                    'fecha_apertura' => $fechaActual,
                    'id_usuario_registro' => Auth::id(),
                    'id_personal_registro' => $personal->id_personal,
                    'created_at' => $fechaActual,
                    'updated_at' => $fechaActual,
                ));
            }

            $duplicada = DB::table('ar_caso_canalizaciones')
                ->where('id_ar_caso', $casoId)
                ->where('id_area_destino', $areaDestinoId)
                ->whereIn('estado', array('canalizado', 'en_atencion', 'programado'))
                ->first();

            if ($duplicada) {
                return array(
                    'ok' => false,
                    'mensaje' => 'El estudiante ya fue canalizado a esa área en este periodo.',
                    'id_ar_caso' => $casoId,
                    'id_ar_caso_canalizacion' => $duplicada->id_ar_caso_canalizacion,
                );
            }

            $canalizacionId = DB::table('ar_caso_canalizaciones')->insertGetId(array(
                'id_ar_caso' => $casoId,
                'id_area_origen' => $areaOrigen->id_area_atencion,
                'id_area_destino' => $areaDestinoId,
                'id_causa_reprobacion' => $causaId,
                'id_personal_canaliza' => $personal->id_personal,
                'id_usuario_canaliza' => Auth::id(),
                'fecha_canalizacion' => $fechaActual,
                'estado' => 'canalizado',
                'observaciones' => null,
                'created_at' => $fechaActual,
                'updated_at' => $fechaActual,
            ));

            return array(
                'ok' => true,
                'mensaje' => 'Estudiante canalizado correctamente. Se registró la fecha de canalización.',
                'id_ar_caso' => $casoId,
                'id_ar_caso_canalizacion' => $canalizacionId,
            );
        });

        if (!$resultado['ok']) {
            return redirect()->route('canalizacion_reprobacion_principal.index')
                ->with('error', $resultado['mensaje']);
        }

        return redirect()->route('canalizacion_reprobacion_principal.index')
            ->with('success', $resultado['mensaje']);
    }

    /**
     * Resuelve los nombres funcionales sin identificadores estáticos.
     * Tutoría envía únicamente a Pedagogía general.
     */
    private function resolverAreaCanalizacion($tipo)
    {
        $areas = DB::table('ar_areas_atencion')->where('activo', 1)->get();
        foreach ($areas as $area) {
            $nombre = trim(strtolower(strtr((string) $area->nombre, array(
                'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
                'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u'
            ))));
            $nombre = preg_replace('/\s+/', ' ', $nombre);
            if ($tipo === 'origen_tutoria' && in_array($nombre, array('tutoria', 'tutorias'), true)) {
                return $area;
            }
            if ($tipo === 'destino_tutoria' && in_array($nombre, array(
                    'pedagogia'
                ), true)) {
                return $area;
            }
        }
        return null;
    }

    private function resolverPersonalUsuario()
    {
        $idUsuario = Auth::id();

        if (!$idUsuario) {
            return null;
        }

        $usuario = DB::table('users')
            ->where('id', $idUsuario)
            ->first();

        if (!$usuario) {
            return null;
        }

        $correo = '';
        if (isset($usuario->email) && trim($usuario->email) != '') {
            $correo = trim(strtolower($usuario->email));
        }

        $consulta = DB::table('gnral_personales')
            ->where('tipo_usuario', $usuario->id);

        if ($correo != '') {
            $consulta->orWhereRaw('LOWER(TRIM(correo)) = ?', array($correo));
        }

        return $consulta->first();
    }

    private function obtenerPeriodoVigente()
    {
        $fechaActual = \Carbon\Carbon::today(config('app.timezone'))->toDateString();

        // Se usan las fechas reales del calendario académico. No se utiliza
        // un periodo anterior si no hay uno que abarque la fecha actual.
        return DB::table('gnral_periodos')
            ->whereDate('fecha_inicio', '<=', $fechaActual)
            ->whereDate('fecha_termino', '>=', $fechaActual)
            ->orderBy('fecha_inicio', 'desc')
            ->orderBy('id_periodo', 'desc')
            ->first();
    }

    private function obtenerPeriodosTutor($personalId, $periodoId)
    {
        return DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
            ->join('gnral_periodos as gp', 'gp.id_periodo', '=', 'jp.id_periodo')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'jp.id_carrera')
            ->where('et.id_personal', $personalId)
            ->where('gp.id_periodo', $periodoId)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->select(
                'gp.id_periodo',
                'gp.periodo',
                DB::raw('GROUP_CONCAT(DISTINCT c.nombre ORDER BY c.nombre SEPARATOR ", ") as carreras'),
                DB::raw('GROUP_CONCAT(DISTINCT eg.grupo ORDER BY eg.grupo SEPARATOR ", ") as grupos')
            )
            ->groupBy('gp.id_periodo', 'gp.periodo')
            ->orderBy('gp.id_periodo', 'desc')
            ->get();
    }

    private function obtenerCausasReprobacion()
    {
        try {
            if (!DB::getSchemaBuilder()->hasTable('ar_causas_reprobacion')) {
                return collect();
            }

            $columnaIdCausa = $this->obtenerColumnaIdCausaReprobacion();

            $query = DB::table('ar_causas_reprobacion')
                ->select(
                    DB::raw($columnaIdCausa . ' as id_causa_reprobacion'),
                    'nombre'
                );

            if ($this->tablaTieneColumna('ar_causas_reprobacion', 'activo')) {
                $query->where('activo', 1);
            }

            if ($this->tablaTieneColumna('ar_causas_reprobacion', 'orden')) {
                $query->orderBy('orden');
            }

            return $query->orderBy('nombre')->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function obtenerAreasAtencion()
    {
        return DB::table('ar_areas_atencion')
            ->where('activo', 1)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();
    }

    private function obtenerAlumnosReprobadosTutor($personalId, $periodoId)
    {
        $alumnos = DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->join('exp_asigna_alumnos as ea', 'ea.id_asigna_generacion', '=', 'eg.id_asigna_generacion')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ea.id_alumno')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
            ->join('gnral_periodos as gp', 'gp.id_periodo', '=', 'jp.id_periodo')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'jp.id_carrera')
            ->join('eva_carga_academica as ca', function ($join) {
                $join->on('ca.id_alumno', '=', 'ea.id_alumno')
                    ->on('ca.id_periodo', '=', 'jp.id_periodo');
            })
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->where('et.id_personal', $personalId)
            ->where('jp.id_periodo', $periodoId)
            ->where('ev.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->whereNull('ea.deleted_at')
            ->where('ea.estado', 1)
            ->groupBy(
                'et.id_asigna_tutor',
                'eg.id_asigna_generacion',
                'eg.id_generacion',
                'eg.grupo',
                'jp.id_periodo',
                'gp.periodo',
                'jp.id_carrera',
                'c.nombre',
                'ea.id_alumno',
                'a.cuenta',
                'a.nombre',
                'a.apaterno',
                'a.amaterno'
            )
            ->orderBy(DB::raw('COUNT(DISTINCT ca.id_materia)'), 'desc')
            ->orderBy('a.apaterno')
            ->orderBy('a.amaterno')
            ->orderBy('a.nombre')
            ->select(
                'et.id_asigna_tutor',
                'eg.id_asigna_generacion',
                'eg.id_generacion',
                'eg.grupo as grupo_tutoria',
                'jp.id_periodo',
                'gp.periodo',
                'jp.id_carrera',
                'c.nombre as carrera',
                'ea.id_alumno',
                'a.cuenta',
                DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
                DB::raw('COUNT(DISTINCT ca.id_materia) as asignaturas_reprobadas'),
                DB::raw("CASE
                    WHEN COUNT(DISTINCT ca.id_materia) = 1 THEN 'verde'
                    WHEN COUNT(DISTINCT ca.id_materia) = 2 THEN 'amarillo'
                    ELSE 'rojo'
                END as semaforo"),
                DB::raw("GROUP_CONCAT(DISTINCT CONCAT(m.nombre, ' (', IFNULL(m.clave, 'S/C'), ')') ORDER BY m.nombre SEPARATOR ' | ') as asignaturas"),
                DB::raw("GROUP_CONCAT(DISTINCT CONCAT(m.nombre, ' - U', ev.id_unidad, ': ', ev.calificacion) ORDER BY m.nombre, ev.id_unidad SEPARATOR ' | ') as detalle_reprobacion")
            )
            ->get();

        return $this->agregarEstadoCanalizacion($alumnos, $periodoId);
    }

    private function agregarEstadoCanalizacion($alumnos, $periodoId)
    {
        if ($alumnos->isEmpty()) {
            return $alumnos;
        }

        $alumnoIds = $alumnos->pluck('id_alumno')->unique()->values()->all();

        $casos = DB::table('ar_casos_estudiantes')
            ->where('id_periodo', $periodoId)
            ->where('origen_caso', 'reprobacion')
            ->whereIn('id_alumno', $alumnoIds)
            ->get()
            ->keyBy('id_alumno');

        $casoIds = $casos->pluck('id_ar_caso')->unique()->values()->all();
        $canalizacionesPorCaso = collect();

        if (!empty($casoIds)) {
            $columnaIdCausa = $this->obtenerColumnaIdCausaReprobacion();

            $canalizacionesPorCaso = DB::table('ar_caso_canalizaciones as cc')
                ->join('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
                ->leftJoin('ar_causas_reprobacion as cr', 'cr.' . $columnaIdCausa, '=', 'cc.id_causa_reprobacion')
                ->whereIn('cc.id_ar_caso', $casoIds)
                ->orderBy('cc.fecha_canalizacion', 'desc')
                ->select(
                    'cc.id_ar_caso_canalizacion',
                    'cc.id_ar_caso',
                    'cc.fecha_canalizacion',
                    'cc.estado',
                    'ad.nombre as area_destino',
                    'cr.nombre as causa'
                )
                ->get()
                ->groupBy('id_ar_caso');
        }

        foreach ($alumnos as $alumno) {
            $alumno->id_ar_caso = null;
            $alumno->canalizaciones_periodo = 0;
            $alumno->ultima_area_destino = null;
            $alumno->ultima_causa = null;
            $alumno->fecha_ultima_canalizacion = null;
            $alumno->estado_ultima_canalizacion = null;

            $caso = $casos->get($alumno->id_alumno);

            if ($caso) {
                $alumno->id_ar_caso = $caso->id_ar_caso;
                $movimientos = $canalizacionesPorCaso->get($caso->id_ar_caso, collect());
                $alumno->canalizaciones_periodo = $movimientos->count();

                $ultima = $movimientos->first();
                if ($ultima) {
                    $alumno->ultima_area_destino = $ultima->area_destino;
                    $alumno->ultima_causa = $ultima->causa;
                    $alumno->fecha_ultima_canalizacion = $ultima->fecha_canalizacion;
                    $alumno->estado_ultima_canalizacion = $ultima->estado;
                }
            }
        }

        return $alumnos;
    }

    private function validarAlumnoPerteneceTutor($personalId, $periodoId, $carreraId, $alumnoId, $asignaGeneracionId, $asignaTutorId)
    {
        return DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->join('exp_asigna_alumnos as ea', 'ea.id_asigna_generacion', '=', 'eg.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
            ->where('et.id_personal', $personalId)
            ->where('et.id_asigna_tutor', $asignaTutorId)
            ->where('eg.id_asigna_generacion', $asignaGeneracionId)
            ->where('ea.id_alumno', $alumnoId)
            ->where('jp.id_periodo', $periodoId)
            ->where('jp.id_carrera', $carreraId)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->whereNull('ea.deleted_at')
            ->where('ea.estado', 1)
            ->exists();
    }

    private function alumnoTieneReprobacion($alumnoId, $periodoId)
    {
        return DB::table('eva_carga_academica as ca')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->where('ca.id_alumno', $alumnoId)
            ->where('ca.id_periodo', $periodoId)
            ->where('ev.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA)
            ->exists();
    }

    private function obtenerColumnaIdCausaReprobacion()
    {
        try {
            $schema = DB::getSchemaBuilder();

            if ($schema->hasColumn('ar_causas_reprobacion', 'id_causa_reprobacion')) {
                return 'id_causa_reprobacion';
            }

            if ($schema->hasColumn('ar_causas_reprobacion', 'id_ar_causa')) {
                return 'id_ar_causa';
            }
        } catch (\Exception $e) {
            // Si no se puede consultar el esquema, se conserva el nombre usado por el módulo original.
        }

        return 'id_causa_reprobacion';
    }

    private function tablaTieneColumna($tabla, $columna)
    {
        try {
            return DB::getSchemaBuilder()->hasColumn($tabla, $columna);
        } catch (\Exception $e) {
            return false;
        }
    }
}
