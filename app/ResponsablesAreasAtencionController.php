<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ResponsablesAreasAtencionController extends Controller
{
    const CALIFICACION_MINIMA_APROBATORIA = 70;
    const MAX_SESIONES_POR_CASO_AREA = 4;

    public function index(Request $request)
    {
        // PIASE usa layouts.app, y ese layout incluye partials.periodos.
        // Ese partial depende de variables de sesión (arre_periodos, p1, p2, periodo_actual).
        // Por eso las aseguramos antes de regresar cualquier vista.
        $this->asegurarSesionPeriodosSistema((int) $request->get('id_periodo', 0));

        $personal = $this->resolverPersonalUsuario();

        if (!$personal) {
            return view('areas_atencion.mis_casos.index', $this->vistaBase(array(
                'permitido' => false,
                'mensaje' => 'El usuario autenticado no está relacionado con un registro de personal.',
            )));
        }

        $periodos = $this->obtenerPeriodosResponsable($personal->id_personal);

        if ($periodos->isEmpty()) {
            return view('areas_atencion.mis_casos.index', $this->vistaBase(array(
                'permitido' => false,
                'mensaje' => 'El usuario autenticado no tiene asignación activa como responsable de área en PIASE.',
                'personal' => $personal,
            )));
        }

        $idPeriodo = (int) $request->get('id_periodo', 0);
        if ($idPeriodo <= 0) {
            $idPeriodo = (int) $periodos->first()->id_periodo;
        }

        $periodoSeleccionado = $this->buscarPeriodoEnColeccion($periodos, $idPeriodo);
        if (!$periodoSeleccionado) {
            $periodoSeleccionado = $periodos->first();
            $idPeriodo = (int) $periodoSeleccionado->id_periodo;
        }

        $this->asegurarSesionPeriodosSistema($idPeriodo);

        $areasResponsable = $this->obtenerAreasResponsable($personal->id_personal, $idPeriodo);
        $idsAreasResponsable = $areasResponsable->pluck('id_area_atencion')->values()->all();

        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));
        $idAreaPedagogia = $areaPedagogia ? (int) $areaPedagogia->id_area_atencion : 0;
        $esResponsablePedagogia = $idAreaPedagogia > 0 && in_array($idAreaPedagogia, $idsAreasResponsable);

        $idCarrera = (int) $request->get('id_carrera', 0);
        $busquedaEstudiante = trim((string) $request->get('buscar_estudiante', ''));
        $tabActivo = $this->tabRetorno($request, 'tab-estudiantes');
        $focusActivo = $this->focusRetorno($request);
        $areasActivas = $this->obtenerAreasActivas();
        $horariosDisponibles = $this->obtenerHorariosDisponibles($idPeriodo);
        $resumenCarreras = $this->obtenerResumenCarrerasPedagogia($idPeriodo, $idAreaPedagogia);
        $categoriasActividades = $this->obtenerCategoriasActividades();
        $catalogoActividades = $this->obtenerCatalogoActividades();

        if ($esResponsablePedagogia) {
            $casosEstudiantes = $this->obtenerCasosEntradaPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia);
            $casosCanalizados = $this->obtenerCasosCanalizadosPorPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia);
            $casosCerrados = $this->obtenerCasosCerradosPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia);
        } else {
            $casosEstudiantes = collect();
            $casosCanalizados = $this->obtenerCasosCanalizadosResponsable($personal->id_personal, $idPeriodo, $idsAreasResponsable, $idCarrera);
            $casosCerrados = $this->obtenerCasosCerradosResponsable($personal->id_personal, $idPeriodo, $idsAreasResponsable, $idCarrera);
        }

        $resultadosBusquedaEstudiantes = $esResponsablePedagogia
            ? $this->buscarEstudiantesParaCanalizar($idPeriodo, $busquedaEstudiante, $idCarrera)
            : collect();

        $datosEstudiantes = $this->construirFilasPorMateria($casosEstudiantes, $idPeriodo);
        $datosCanalizados = $this->construirFilasPorMateria($casosCanalizados, $idPeriodo);
        $datosCerrados = $this->construirFilasPorMateria($casosCerrados, $idPeriodo);
        $unidades = $this->mezclarUnidades(array($datosEstudiantes['unidades'], $datosCanalizados['unidades'], $datosCerrados['unidades']));

        $citasAsignadas = $this->obtenerCitasAsignadas($personal->id_personal, $idPeriodo, $idsAreasResponsable, $idCarrera);
        $actividadesSeguimiento = $this->obtenerActividadesSeguimiento($personal->id_personal, $idPeriodo, $idsAreasResponsable, $idCarrera, $esResponsablePedagogia, $idAreaPedagogia);
        $rutasCasos = $this->obtenerRutasCasos($idPeriodo, $idCarrera, $esResponsablePedagogia, $personal->id_personal, $idsAreasResponsable, $idAreaPedagogia);
        $citasPorCanalizacion = $this->obtenerCitasPorCanalizacion($idPeriodo, $idCarrera, $esResponsablePedagogia, $personal->id_personal, $idsAreasResponsable);

        return view('areas_atencion.mis_casos.index', array(
            'permitido' => true,
            'mensaje' => null,
            'personal' => $personal,
            'periodos' => $periodos,
            'periodoSeleccionado' => $periodoSeleccionado,
            'areasResponsable' => $areasResponsable,
            'esResponsablePedagogia' => $esResponsablePedagogia,
            'areaPedagogia' => $areaPedagogia,
            'resumenCarreras' => $resumenCarreras,
            'areasActivas' => $areasActivas,
            'horariosDisponibles' => $horariosDisponibles,
            'horariosDisponiblesJson' => json_encode($horariosDisponibles->values()->all()),
            'categoriasActividades' => $categoriasActividades,
            'catalogoActividades' => $catalogoActividades,
            'citasAsignadas' => $citasAsignadas,
            'actividadesSeguimiento' => $actividadesSeguimiento,
            'rutasCasos' => $rutasCasos,
            'citasPorCanalizacion' => $citasPorCanalizacion,
            'resultadosBusquedaEstudiantes' => $resultadosBusquedaEstudiantes,
            'busquedaEstudiante' => $busquedaEstudiante,
            'citasOcupadasJson' => json_encode($this->obtenerCitasOcupadas($idPeriodo)),
            'periodoRangoJson' => json_encode($this->obtenerRangoPeriodo($idPeriodo)),
            'filasEstudiantes' => $datosEstudiantes['filas'],
            'filasCanalizados' => $datosCanalizados['filas'],
            'filasCerrados' => $datosCerrados['filas'],
            'graficasCerradosJson' => json_encode($datosCerrados['graficas']),
            'unidades' => $unidades,
            'filtros' => array(
                'id_periodo' => $idPeriodo,
                'id_carrera' => $idCarrera,
                'buscar_estudiante' => $busquedaEstudiante,
                'tab' => $tabActivo,
                'focus' => $focusActivo,
            ),
        ));
    }


    public function buscarEstudiantesAjax(Request $request)
    {
        $this->asegurarSesionPeriodosSistema((int) $request->get('id_periodo', 0));

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return response()->json(array(
                'items' => array(),
                'mensaje' => 'No se pudo identificar al usuario responsable.',
            ), 403);
        }

        $periodos = $this->obtenerPeriodosResponsable($personal->id_personal);
        if ($periodos->isEmpty()) {
            return response()->json(array(
                'items' => array(),
                'mensaje' => 'El usuario autenticado no tiene asignación activa como responsable de área en PIASE.',
            ), 403);
        }

        $idPeriodo = (int) $request->get('id_periodo', 0);
        if ($idPeriodo <= 0) {
            $idPeriodo = (int) $periodos->first()->id_periodo;
        }

        $periodoSeleccionado = $this->buscarPeriodoEnColeccion($periodos, $idPeriodo);
        if (!$periodoSeleccionado) {
            return response()->json(array(
                'items' => array(),
                'mensaje' => 'El periodo seleccionado no corresponde a las asignaciones del responsable.',
            ), 403);
        }

        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));
        if (!$areaPedagogia || !$this->usuarioEsResponsableArea($personal->id_personal, $idPeriodo, (int) $areaPedagogia->id_area_atencion)) {
            return response()->json(array(
                'items' => array(),
                'mensaje' => 'Solo las y los responsables de Pedagogía pueden buscar estudiantes para canalización.',
            ), 403);
        }

        $term = trim((string) $request->get('term', ''));
        $idCarrera = (int) $request->get('id_carrera', 0);

        if (mb_strlen($term) < 2) {
            return response()->json(array('items' => array()));
        }

        $resultados = $this->buscarEstudiantesParaCanalizar($idPeriodo, $term, $idCarrera);
        $items = array();

        foreach ($resultados as $estudiante) {
            $estadoCaso = $estudiante->estado_caso ? $estudiante->estado_caso : 'Sin caso';
            $items[] = array(
                'id_alumno' => (int) $estudiante->id_alumno,
                'id_carrera' => (int) $estudiante->id_carrera,
                'id_periodo' => $idPeriodo,
                'alumno' => $estudiante->alumno,
                'cuenta' => $estudiante->cuenta,
                'carrera' => $estudiante->carrera,
                'semestre' => $estudiante->id_semestre,
                'asignaturas_reprobadas' => (int) $estudiante->asignaturas_reprobadas,
                'asignaturas' => $estudiante->asignaturas,
                'id_ar_caso' => $estudiante->id_ar_caso ? (int) $estudiante->id_ar_caso : null,
                'estado_caso' => $estadoCaso,
                'bloqueado' => $estudiante->estado_caso == 'cerrado',
            );
        }

        return response()->json(array('items' => $items));
    }

    public function agregarCanalizacionEstudiante(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_alumno' => 'required|integer',
            'id_carrera' => 'required|integer',
            'id_area_destino' => 'required|integer',
            'id_area_responsable_periodo_destino' => 'required|integer',
            'id_area_responsable_horario' => 'required|integer',
            'fecha_cita' => 'required|date',
            'hora_inicio_slot' => 'required',
            'hora_fin_slot' => 'required',
            'observaciones' => 'nullable|string|max:500',
        ), array(
            'id_alumno.required' => 'Selecciona el estudiante que se canalizará.',
            'id_area_destino.required' => 'Selecciona el área destino.',
            'id_area_responsable_periodo_destino.required' => 'Selecciona el responsable del área.',
            'id_area_responsable_horario.required' => 'Selecciona el horario de atención.',
            'fecha_cita.required' => 'Selecciona el día de atención.',
            'hora_inicio_slot.required' => 'Selecciona un horario disponible.',
            'hora_fin_slot.required' => 'Selecciona un horario disponible.',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idAlumno = (int) $request->get('id_alumno');
        $idCarrera = (int) $request->get('id_carrera');
        $idAreaDestino = (int) $request->get('id_area_destino');
        $idResponsablePeriodo = (int) $request->get('id_area_responsable_periodo_destino');
        $idHorario = (int) $request->get('id_area_responsable_horario');
        $fecha = trim($request->get('fecha_cita'));
        $horaInicioSlot = $this->normalizarHora($request->get('hora_inicio_slot'));
        $horaFinSlot = $this->normalizarHora($request->get('hora_fin_slot'));
        $observaciones = trim($request->get('observaciones'));

        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));
        if (!$areaPedagogia) {
            return redirect()->back()->with('error', 'No existe el área activa de Pedagogía.');
        }

        if (!$this->usuarioEsResponsableArea($personal->id_personal, $idPeriodo, (int) $areaPedagogia->id_area_atencion)) {
            return redirect()->back()->with('error', 'Solo las y los responsables de Pedagogía pueden agregar canalizaciones desde PIASE.');
        }

        $alumno = $this->obtenerAlumnoParaCanalizacion($idPeriodo, $idAlumno, $idCarrera);
        if (!$alumno) {
            return redirect()->back()->with('error', 'No se encontró el estudiante seleccionado en el periodo actual.');
        }

        $responsable = DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('activo', 1)
            ->first();

        if (!$responsable) {
            return redirect()->back()->with('error', 'El responsable seleccionado no corresponde al área/periodo.');
        }

        $horario = DB::table('ar_area_responsable_horarios')
            ->where('id_area_responsable_horario', $idHorario)
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('id_personal', $responsable->id_personal)
            ->where('activo', 1)
            ->first();

        if (!$horario) {
            return redirect()->back()->with('error', 'El horario seleccionado no corresponde al responsable.');
        }

        $validacionHorario = $this->validarFechaYSlotContraHorario($horario, $fecha, $horaInicioSlot, $horaFinSlot);
        if (!$validacionHorario['ok']) {
            return redirect()->back()->with('error', $validacionHorario['mensaje']);
        }

        $validacionPeriodo = $this->validarFechaDentroDelPeriodo($idPeriodo, $fecha);
        if (!$validacionPeriodo['ok']) {
            return redirect()->back()->with('error', $validacionPeriodo['mensaje']);
        }

        $ocupacionSlot = $this->contarOcupacionSlot($idHorario, $fecha, $horaInicioSlot, $horaFinSlot);
        if ($ocupacionSlot > 0) {
            return redirect()->back()->with('error', 'El horario seleccionado ya está ocupado para esa fecha.');
        }

        $ahora = date('Y-m-d H:i:s');
        $fechaCita = $fecha . ' ' . $horaInicioSlot;

        DB::beginTransaction();
        try {
            $caso = DB::table('ar_casos_estudiantes')
                ->where('id_periodo', $idPeriodo)
                ->where('id_alumno', $idAlumno)
                ->where('origen_caso', 'reprobacion')
                ->first();

            if ($caso && $caso->estado == 'cerrado') {
                DB::rollBack();
                return redirect()->back()->with('error', 'El estudiante ya tiene un caso cerrado en este periodo. Revisa el historial antes de crear otra canalización.');
            }

            if ($caso) {
                $idCaso = (int) $caso->id_ar_caso;
                DB::table('ar_casos_estudiantes')
                    ->where('id_ar_caso', $idCaso)
                    ->update(array(
                        'estado' => 'en_proceso',
                        'updated_at' => $ahora,
                    ));
            } else {
                $idCaso = DB::table('ar_casos_estudiantes')->insertGetId(array(
                    'id_periodo' => $idPeriodo,
                    'id_carrera' => $idCarrera,
                    'id_alumno' => $idAlumno,
                    'id_asigna_generacion' => null,
                    'id_asigna_tutor' => null,
                    'id_personal_tutor' => null,
                    'origen_caso' => 'reprobacion',
                    'estado' => 'en_proceso',
                    'fecha_apertura' => $ahora,
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ));
            }

            $sesionesCasoArea = $this->contarSesionesCasoArea($idCaso, $idAreaDestino);
            if ($sesionesCasoArea >= self::MAX_SESIONES_POR_CASO_AREA) {
                DB::rollBack();
                return redirect()->back()->with('error', 'El caso ya tiene el máximo de 4 sesiones para el área seleccionada.');
            }

            $idCanalizacion = DB::table('ar_caso_canalizaciones')->insertGetId(array(
                'id_ar_caso' => $idCaso,
                'id_area_origen' => (int) $areaPedagogia->id_area_atencion,
                'id_area_destino' => $idAreaDestino,
                'id_causa_reprobacion' => null,
                'id_personal_canaliza' => $personal->id_personal,
                'id_usuario_canaliza' => Auth::id(),
                'id_area_responsable_periodo_destino' => $idResponsablePeriodo,
                'id_personal_responsable_destino' => $responsable->id_personal,
                'id_area_responsable_horario_destino' => $idHorario,
                'fecha_canalizacion' => $ahora,
                'estado' => 'programado',
                'observaciones' => $observaciones != '' ? $observaciones : 'Canalización agregada directamente por Pedagogía desde PIASE.',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ));

            DB::table('ar_caso_citas')->insert(array(
                'id_ar_caso' => $idCaso,
                'id_ar_caso_canalizacion' => $idCanalizacion,
                'id_area_atencion' => $idAreaDestino,
                'id_area_responsable_horario' => $idHorario,
                'numero_sesion' => $sesionesCasoArea + 1,
                'fecha_cita' => $fechaCita,
                'hora_inicio_cita' => $horaInicioSlot,
                'hora_fin_cita' => $horaFinSlot,
                'lugar' => $horario->lugar,
                'motivo' => $observaciones != '' ? $observaciones : 'Primera sesión programada desde PIASE.',
                'estado' => 'programada',
                'id_personal_asigna' => $personal->id_personal,
                'id_usuario_asigna' => Auth::id(),
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo agregar la canalización: ' . $e->getMessage());
        }

        return $this->redirectPiase($request, $idPeriodo, 'tab-canalizados', array('id_carrera' => $idCarrera, 'focus' => 'caso-' . $idCaso))
            ->with('success', 'Canalización agregada correctamente desde Pedagogía.');
    }

    public function canalizarArea(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_caso' => 'required|integer',
            'id_area_destino' => 'required|integer',
            'id_area_responsable_periodo_destino' => 'required|integer',
            'id_area_responsable_horario' => 'required|integer',
            'fecha_cita' => 'required|date',
            'hora_inicio_slot' => 'required',
            'hora_fin_slot' => 'required',
            'observaciones' => 'nullable|string|max:500',
        ), array(
            'id_area_destino.required' => 'Selecciona el área destino.',
            'id_area_responsable_periodo_destino.required' => 'Selecciona el responsable del área.',
            'id_area_responsable_horario.required' => 'Selecciona el horario de atención.',
            'fecha_cita.required' => 'Selecciona el día de atención.',
            'hora_inicio_slot.required' => 'Selecciona un horario disponible.',
            'hora_fin_slot.required' => 'Selecciona un horario disponible.',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCaso = (int) $request->get('id_ar_caso');
        $idAreaDestino = (int) $request->get('id_area_destino');
        $idResponsablePeriodo = (int) $request->get('id_area_responsable_periodo_destino');
        $idHorario = (int) $request->get('id_area_responsable_horario');
        $fecha = trim($request->get('fecha_cita'));
        $horaInicioSlot = $this->normalizarHora($request->get('hora_inicio_slot'));
        $horaFinSlot = $this->normalizarHora($request->get('hora_fin_slot'));
        $observaciones = trim($request->get('observaciones'));

        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));
        if (!$areaPedagogia) {
            return redirect()->back()->with('error', 'No existe el área activa de Pedagogía.');
        }

        if (!$this->usuarioEsResponsableArea($personal->id_personal, $idPeriodo, (int) $areaPedagogia->id_area_atencion)) {
            return redirect()->back()->with('error', 'Solo la responsable de Pedagogía puede canalizar estudiantes desde PIASE.');
        }

        $caso = DB::table('ar_casos_estudiantes')
            ->where('id_ar_caso', $idCaso)
            ->where('id_periodo', $idPeriodo)
            ->where('origen_caso', 'reprobacion')
            ->first();

        if (!$caso) {
            return redirect()->back()->with('error', 'No se encontró el caso seleccionado.');
        }

        if ($caso->estado == 'cerrado') {
            return redirect()->back()->with('error', 'El caso ya está cerrado y no puede canalizarse nuevamente.');
        }

        $responsable = DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('activo', 1)
            ->first();

        if (!$responsable) {
            return redirect()->back()->with('error', 'El responsable seleccionado no corresponde al área/periodo.');
        }

        $horario = DB::table('ar_area_responsable_horarios')
            ->where('id_area_responsable_horario', $idHorario)
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('id_personal', $responsable->id_personal)
            ->where('activo', 1)
            ->first();

        if (!$horario) {
            return redirect()->back()->with('error', 'El horario seleccionado no corresponde al responsable.');
        }

        $validacionHorario = $this->validarFechaYSlotContraHorario($horario, $fecha, $horaInicioSlot, $horaFinSlot);
        if (!$validacionHorario['ok']) {
            return redirect()->back()->with('error', $validacionHorario['mensaje']);
        }

        $validacionPeriodo = $this->validarFechaDentroDelPeriodo($idPeriodo, $fecha);
        if (!$validacionPeriodo['ok']) {
            return redirect()->back()->with('error', $validacionPeriodo['mensaje']);
        }

        $sesionesCasoArea = $this->contarSesionesCasoArea($idCaso, $idAreaDestino);
        if ($sesionesCasoArea >= self::MAX_SESIONES_POR_CASO_AREA) {
            return redirect()->back()->with('error', 'El caso ya tiene el máximo de 4 sesiones para el área seleccionada.');
        }

        $ocupacionSlot = $this->contarOcupacionSlot($idHorario, $fecha, $horaInicioSlot, $horaFinSlot);
        if ($ocupacionSlot > 0) {
            return redirect()->back()->with('error', 'El horario seleccionado ya está ocupado para esa fecha.');
        }

        $ahora = date('Y-m-d H:i:s');
        $fechaCita = $fecha . ' ' . $horaInicioSlot;
        $numeroSesion = $sesionesCasoArea + 1;

        DB::beginTransaction();
        try {
            $idCanalizacion = DB::table('ar_caso_canalizaciones')->insertGetId(array(
                'id_ar_caso' => $idCaso,
                'id_area_origen' => (int) $areaPedagogia->id_area_atencion,
                'id_area_destino' => $idAreaDestino,
                'id_causa_reprobacion' => null,
                'id_personal_canaliza' => $personal->id_personal,
                'id_usuario_canaliza' => Auth::id(),
                'id_area_responsable_periodo_destino' => $idResponsablePeriodo,
                'id_personal_responsable_destino' => $responsable->id_personal,
                'id_area_responsable_horario_destino' => $idHorario,
                'fecha_canalizacion' => $ahora,
                'estado' => 'programado',
                'observaciones' => $observaciones != '' ? $observaciones : 'Canalización generada desde PIASE.',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ));

            DB::table('ar_caso_citas')->insert(array(
                'id_ar_caso' => $idCaso,
                'id_ar_caso_canalizacion' => $idCanalizacion,
                'id_area_atencion' => $idAreaDestino,
                'id_area_responsable_horario' => $idHorario,
                'numero_sesion' => $numeroSesion,
                'fecha_cita' => $fechaCita,
                'hora_inicio_cita' => $horaInicioSlot,
                'hora_fin_cita' => $horaFinSlot,
                'lugar' => $horario->lugar,
                'motivo' => $observaciones != '' ? $observaciones : 'Sesión programada desde PIASE.',
                'estado' => 'programada',
                'id_personal_asigna' => $personal->id_personal,
                'id_usuario_asigna' => Auth::id(),
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ));

            DB::table('ar_casos_estudiantes')
                ->where('id_ar_caso', $idCaso)
                ->update(array(
                    'estado' => 'en_proceso',
                    'updated_at' => $ahora,
                ));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo registrar la canalización: ' . $e->getMessage());
        }

        return $this->redirectPiase($request, $idPeriodo, 'tab-canalizados', array('focus' => 'caso-' . $idCaso))
            ->with('success', 'Canalización y primera sesión registradas correctamente.');
    }

    public function agregarSesion(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_caso' => 'required|integer',
            'id_ar_caso_canalizacion' => 'required|integer',
            'id_area_destino' => 'required|integer',
            'id_area_responsable_periodo_destino' => 'required|integer',
            'id_area_responsable_horario' => 'required|integer',
            'fecha_cita' => 'required|date',
            'hora_inicio_slot' => 'required',
            'hora_fin_slot' => 'required',
            'observaciones' => 'nullable|string|max:500',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCaso = (int) $request->get('id_ar_caso');
        $idCanalizacion = (int) $request->get('id_ar_caso_canalizacion');
        $idAreaDestino = (int) $request->get('id_area_destino');
        $idResponsablePeriodo = (int) $request->get('id_area_responsable_periodo_destino');
        $idHorario = (int) $request->get('id_area_responsable_horario');
        $fecha = trim($request->get('fecha_cita'));
        $horaInicioSlot = $this->normalizarHora($request->get('hora_inicio_slot'));
        $horaFinSlot = $this->normalizarHora($request->get('hora_fin_slot'));
        $observaciones = trim($request->get('observaciones'));

        $canalizacion = DB::table('ar_caso_canalizaciones as cc')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cc.id_ar_caso')
            ->where('cc.id_ar_caso_canalizacion', $idCanalizacion)
            ->where('cc.id_ar_caso', $idCaso)
            ->where('cc.id_area_destino', $idAreaDestino)
            ->where('ce.id_periodo', $idPeriodo)
            ->where('ce.estado', '<>', 'cerrado')
            ->select('cc.*', 'ce.estado as estado_caso')
            ->first();

        if (!$canalizacion) {
            return redirect()->back()->with('error', 'No se encontró la canalización seleccionada o el caso ya está cerrado.');
        }

        $responsable = DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('activo', 1)
            ->first();

        if (!$responsable) {
            return redirect()->back()->with('error', 'El responsable seleccionado no corresponde al área/periodo.');
        }

        $esResponsableDestino = (int) $responsable->id_personal === (int) $personal->id_personal;
        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));
        $esPedagogia = $areaPedagogia && $this->usuarioEsResponsableArea($personal->id_personal, $idPeriodo, (int) $areaPedagogia->id_area_atencion);

        if (!$esResponsableDestino && !$esPedagogia) {
            return redirect()->back()->with('error', 'No tienes permiso para agregar sesiones a esta canalización.');
        }

        $horario = DB::table('ar_area_responsable_horarios')
            ->where('id_area_responsable_horario', $idHorario)
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_area_atencion', $idAreaDestino)
            ->where('id_periodo', $idPeriodo)
            ->where('id_personal', $responsable->id_personal)
            ->where('activo', 1)
            ->first();

        if (!$horario) {
            return redirect()->back()->with('error', 'El horario seleccionado no corresponde al responsable.');
        }

        $validacionHorario = $this->validarFechaYSlotContraHorario($horario, $fecha, $horaInicioSlot, $horaFinSlot);
        if (!$validacionHorario['ok']) {
            return redirect()->back()->with('error', $validacionHorario['mensaje']);
        }

        $validacionPeriodo = $this->validarFechaDentroDelPeriodo($idPeriodo, $fecha);
        if (!$validacionPeriodo['ok']) {
            return redirect()->back()->with('error', $validacionPeriodo['mensaje']);
        }

        $sesionesCasoArea = $this->contarSesionesCasoArea($idCaso, $idAreaDestino);
        if ($sesionesCasoArea >= self::MAX_SESIONES_POR_CASO_AREA) {
            return redirect()->back()->with('error', 'El caso ya tiene el máximo de 4 sesiones para el área seleccionada.');
        }

        $ocupacionSlot = $this->contarOcupacionSlot($idHorario, $fecha, $horaInicioSlot, $horaFinSlot);
        if ($ocupacionSlot > 0) {
            return redirect()->back()->with('error', 'El horario seleccionado ya está ocupado para esa fecha.');
        }

        $ahora = date('Y-m-d H:i:s');
        $fechaCita = $fecha . ' ' . $horaInicioSlot;
        $numeroSesion = $sesionesCasoArea + 1;

        DB::beginTransaction();
        try {
            DB::table('ar_caso_citas')->insert(array(
                'id_ar_caso' => $idCaso,
                'id_ar_caso_canalizacion' => $idCanalizacion,
                'id_area_atencion' => $idAreaDestino,
                'id_area_responsable_horario' => $idHorario,
                'numero_sesion' => $numeroSesion,
                'fecha_cita' => $fechaCita,
                'hora_inicio_cita' => $horaInicioSlot,
                'hora_fin_cita' => $horaFinSlot,
                'lugar' => $horario->lugar,
                'motivo' => $observaciones != '' ? $observaciones : 'Sesión adicional programada desde PIASE.',
                'estado' => 'programada',
                'id_personal_asigna' => $personal->id_personal,
                'id_usuario_asigna' => Auth::id(),
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ));

            DB::table('ar_caso_canalizaciones')
                ->where('id_ar_caso_canalizacion', $idCanalizacion)
                ->update(array('estado' => 'programado', 'updated_at' => $ahora));

            DB::table('ar_casos_estudiantes')
                ->where('id_ar_caso', $idCaso)
                ->update(array('estado' => 'en_proceso', 'updated_at' => $ahora));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'No se pudo agregar la sesión: ' . $e->getMessage());
        }

        return $this->redirectPiase($request, $idPeriodo, 'tab-canalizados', array('focus' => 'caso-' . $idCaso))
            ->with('success', 'Sesión adicional registrada correctamente.');
    }

    public function cerrarCaso(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_caso' => 'required|integer',
            'resultado_cierre' => 'nullable|string|max:1000',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCaso = (int) $request->get('id_ar_caso');
        $resultado = trim($request->get('resultado_cierre'));
        $areaPedagogia = $this->obtenerAreaPorNombre(array('Pedagogía', 'Pedagogia'));

        if (!$areaPedagogia || !$this->usuarioEsResponsableArea($personal->id_personal, $idPeriodo, (int) $areaPedagogia->id_area_atencion)) {
            return redirect()->back()->with('error', 'Solo la responsable de Pedagogía puede cerrar casos en PIASE.');
        }

        $caso = DB::table('ar_casos_estudiantes')
            ->where('id_ar_caso', $idCaso)
            ->where('id_periodo', $idPeriodo)
            ->where('origen_caso', 'reprobacion')
            ->first();

        if (!$caso) {
            return redirect()->back()->with('error', 'No se encontró el caso seleccionado.');
        }

        $ahora = date('Y-m-d H:i:s');

        DB::table('ar_casos_estudiantes')
            ->where('id_ar_caso', $idCaso)
            ->update(array(
                'estado' => 'cerrado',
                'fecha_cierre' => $ahora,
                'resultado_cierre' => $resultado != '' ? $resultado : null,
                'updated_at' => $ahora,
            ));

        DB::table('ar_caso_canalizaciones')
            ->where('id_ar_caso', $idCaso)
            ->whereNotIn('estado', array('cerrado', 'cancelado'))
            ->update(array('estado' => 'cerrado', 'updated_at' => $ahora));

        return $this->redirectPiase($request, $idPeriodo, 'tab-cerrados', array('focus' => 'caso-' . $idCaso))
            ->with('success', 'Caso cerrado correctamente.');
    }



    private function normalizarEstadoCitaValor($estado)
    {
        $estado = trim((string) $estado);
        $estado = str_replace(' ', '_', $estado);
        $estado = str_replace('á', 'a', str_replace('Á', 'A', $estado));
        $estado = strtolower($estado);

        if ($estado === 'en_atencion' || $estado === 'enatencion') {
            return 'en_atencion';
        }

        if ($estado === 'atendido') {
            return 'atendida';
        }

        if ($estado === 'cancelado') {
            return 'cancelada';
        }

        if (!in_array($estado, array('programada', 'en_atencion', 'atendida', 'cancelada'))) {
            return 'programada';
        }

        return $estado;
    }

    public function editarSesion(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_cita' => 'required|integer',
            'id_area_responsable_horario' => 'required|integer',
            'fecha_cita' => 'required|date',
            'hora_inicio_slot' => 'required',
            'hora_fin_slot' => 'required',
            'estado' => 'required|string|max:30',
            'observaciones' => 'nullable|string|max:500',
            'lugar' => 'nullable|string|max:150',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCita = (int) $request->get('id_ar_cita');
        $idHorario = (int) $request->get('id_area_responsable_horario');
        $fecha = trim($request->get('fecha_cita'));
        $horaInicio = $this->normalizarHora($request->get('hora_inicio_slot'));
        $horaFin = $this->normalizarHora($request->get('hora_fin_slot'));
        $estadoRequest = trim((string) $request->get('estado', ''));
        if ($estadoRequest == '') {
            $estadoRequest = trim((string) $request->get('estado_cita', 'programada'));
        }
        $estado = $this->normalizarEstadoCitaValor($estadoRequest);
        $observaciones = trim($request->get('observaciones'));
        $lugar = trim($request->get('lugar'));

        if (!in_array($estado, array('programada', 'en_atencion', 'atendida', 'cancelada'))) {
            return redirect()->back()->with('error', 'El estado de la sesión no es válido.');
        }

        $cita = $this->obtenerCitaEditable($idCita, $idPeriodo, $personal->id_personal);
        if (!$cita) {
            return redirect()->back()->with('error', 'No tienes permiso para editar esta cita o no existe.');
        }

        $fechaActual = $cita->fecha_cita ? date('Y-m-d', strtotime($cita->fecha_cita)) : '';
        $horaInicioActual = $this->normalizarHora($cita->hora_inicio_cita);
        $horaFinActual = $this->normalizarHora($cita->hora_fin_cita);
        $idHorarioActual = (int) $cita->id_area_responsable_horario;

        if ($fecha == '' || $fecha == '0000-00-00') {
            $fecha = $fechaActual;
        }
        if ($horaInicio == '') {
            $horaInicio = $horaInicioActual;
        }
        if ($horaFin == '') {
            $horaFin = $horaFinActual;
        }
        if ($idHorario <= 0) {
            $idHorario = $idHorarioActual;
        }

        $soloCambioEstado = ((int) $idHorario === (int) $idHorarioActual)
            && ($fecha === $fechaActual)
            && ($horaInicio === $horaInicioActual)
            && ($horaFin === $horaFinActual);

        $horario = DB::table('ar_area_responsable_horarios')
            ->where('id_area_responsable_horario', $idHorario)
            ->where('id_area_responsable_periodo', $cita->id_area_responsable_periodo_destino)
            ->where('id_area_atencion', $cita->id_area_destino)
            ->where('id_periodo', $idPeriodo)
            ->where('id_personal', $personal->id_personal)
            ->where('activo', 1)
            ->first();

        if (!$horario) {
            return redirect()->back()->with('error', 'El horario seleccionado no corresponde al responsable asignado.');
        }

        /*
         * Si el responsable solamente cambia el estado de la cita, se permite guardar
         * aunque la fecha histórica haya quedado fuera del rango actual del periodo.
         * Si cambia fecha u horario, entonces sí se vuelven a aplicar todas las reglas.
         */
        if (!$soloCambioEstado && $estado !== 'cancelada') {
            $validacionHorario = $this->validarFechaYSlotContraHorario($horario, $fecha, $horaInicio, $horaFin);
            if (!$validacionHorario['ok']) {
                return redirect()->back()->with('error', $validacionHorario['mensaje']);
            }

            $validacionPeriodo = $this->validarFechaDentroDelPeriodo($idPeriodo, $fecha);
            if (!$validacionPeriodo['ok']) {
                return redirect()->back()->with('error', $validacionPeriodo['mensaje']);
            }

            if ($this->contarOcupacionSlotExcepto($idHorario, $fecha, $idCita) > 0) {
                return redirect()->back()->with('error', 'El horario seleccionado ya está ocupado para esa fecha.');
            }
        }

        $ahora = date('Y-m-d H:i:s');

        DB::table('ar_caso_citas')
            ->where('id_ar_cita', $idCita)
            ->update(array(
                'id_area_responsable_horario' => $idHorario,
                'fecha_cita' => $fecha . ' ' . $horaInicio,
                'hora_inicio_cita' => $horaInicio,
                'hora_fin_cita' => $horaFin,
                'lugar' => $lugar != '' ? $lugar : $horario->lugar,
                'motivo' => $observaciones,
                'estado' => $estado,
                'updated_at' => $ahora,
            ));

        $estadoCanalizacion = null;
        if ($estado == 'programada') {
            $estadoCanalizacion = 'programado';
        } elseif ($estado == 'en_atencion') {
            $estadoCanalizacion = 'en_atencion';
        } elseif ($estado == 'atendida') {
            $estadoCanalizacion = 'atendido';
        }

        /*
         * Cancelar una cita no cancela la canalización completa. Se conserva el rastro
         * de la cita cancelada y el caso puede seguir con nuevas sesiones/actividades.
         */
        if ($estadoCanalizacion !== null) {
            DB::table('ar_caso_canalizaciones')
                ->where('id_ar_caso_canalizacion', $cita->id_ar_caso_canalizacion)
                ->update(array(
                    'estado' => $estadoCanalizacion,
                    'updated_at' => $ahora,
                ));
        }

        if (in_array($estado, array('en_atencion', 'atendida'))) {
            DB::table('ar_casos_estudiantes')
                ->where('id_ar_caso', $cita->id_ar_caso)
                ->where('estado', '<>', 'cerrado')
                ->update(array(
                    'estado' => 'en_proceso',
                    'updated_at' => $ahora,
                ));
        }

        $tabRetorno = $this->tabRetorno($request, 'tab-citas');
        if (!in_array($tabRetorno, array('tab-citas', 'tab-canalizados'))) {
            $tabRetorno = 'tab-citas';
        }

        return $this->redirectPiase($request, $idPeriodo, $tabRetorno, array('focus' => 'cita-' . $idCita))
            ->with('success', 'Sesión actualizada correctamente.');
    }

    public function cancelarSesion(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_cita' => 'required|integer',
            'motivo_cancelacion' => 'nullable|string|max:500',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCita = (int) $request->get('id_ar_cita');
        $motivo = trim((string) $request->get('motivo_cancelacion', ''));

        $cita = $this->obtenerCitaEditable($idCita, $idPeriodo, $personal->id_personal);
        if (!$cita) {
            return redirect()->back()->with('error', 'No tienes permiso para cancelar esta cita o no existe.');
        }

        $motivoActual = trim((string) $cita->motivo);
        $motivoFinal = $motivoActual;
        if ($motivo != '') {
            $motivoFinal = $motivoActual != '' ? ($motivoActual . "\nCancelación: " . $motivo) : ('Cancelación: ' . $motivo);
        }

        $ahora = date('Y-m-d H:i:s');

        DB::table('ar_caso_citas')
            ->where('id_ar_cita', $idCita)
            ->update(array(
                'estado' => 'cancelada',
                'motivo' => $motivoFinal,
                'updated_at' => $ahora,
            ));

        DB::table('ar_caso_canalizaciones')
            ->where('id_ar_caso_canalizacion', $cita->id_ar_caso_canalizacion)
            ->update(array(
                'estado' => 'cancelado',
                'updated_at' => $ahora,
            ));

        $tabRetorno = $this->tabRetorno($request, 'tab-citas');
        if (!in_array($tabRetorno, array('tab-citas', 'tab-canalizados'))) {
            $tabRetorno = 'tab-citas';
        }

        return $this->redirectPiase($request, $idPeriodo, $tabRetorno, array('focus' => 'cita-' . $idCita))
            ->with('success', 'Cita cancelada correctamente.');
    }

    public function guardarActividad(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_cita' => 'required|integer',
            'id_actividad_catalogo' => 'required|integer',
            'fecha_limite' => 'nullable|date',
            'descripcion' => 'nullable|string|max:1000',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idCita = (int) $request->get('id_ar_cita');
        $idCatalogo = (int) $request->get('id_actividad_catalogo');
        $fechaLimite = trim($request->get('fecha_limite'));
        $descripcion = trim($request->get('descripcion'));

        $cita = $this->obtenerCitaEditable($idCita, $idPeriodo, $personal->id_personal);
        if (!$cita) {
            return redirect()->back()->with('error', 'Solo el responsable asignado a la cita puede agregar actividades.');
        }

        $catalogo = DB::table('ar_actividad_catalogo as ac')
            ->leftJoin('ar_actividad_categorias as cat', 'cat.id_categoria_actividad', '=', 'ac.id_categoria_actividad')
            ->where('ac.id_actividad_catalogo', $idCatalogo)
            ->where('ac.activo', 1)
            ->select('ac.*', 'cat.nombre as categoria')
            ->first();

        if (!$catalogo) {
            return redirect()->back()->with('error', 'La actividad seleccionada no existe o está inactiva.');
        }

        DB::table('ar_caso_actividades')->insert(array(
            'id_ar_caso' => $cita->id_ar_caso,
            'id_ar_caso_canalizacion' => $cita->id_ar_caso_canalizacion,
            'id_ar_cita' => $idCita,
            'id_area_atencion' => $cita->id_area_destino,
            'id_actividad_catalogo' => $catalogo->id_actividad_catalogo,
            'id_categoria_actividad' => $catalogo->id_categoria_actividad,
            'titulo' => $catalogo->nombre,
            'descripcion' => $descripcion != '' ? $descripcion : $catalogo->descripcion,
            'fecha_asignacion' => date('Y-m-d H:i:s'),
            'fecha_limite' => $fechaLimite != '' ? $fechaLimite : null,
            'estado' => 'asignada',
            'id_personal_asigna' => $personal->id_personal,
            'id_usuario_asigna' => Auth::id(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        return $this->redirectPiase($request, $idPeriodo, 'tab-citas', array('focus' => 'cita-' . $idCita))
            ->with('success', 'Actividad asignada correctamente.');
    }

    public function actualizarActividad(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_actividad' => 'required|integer',
            'id_actividad_catalogo' => 'required|integer',
            'fecha_limite' => 'nullable|date',
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|string|max:30',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idActividad = (int) $request->get('id_ar_actividad');
        $idCatalogo = (int) $request->get('id_actividad_catalogo');
        $estadoRequest = trim((string) $request->get('estado', ''));
        if ($estadoRequest == '') {
            $estadoRequest = trim((string) $request->get('estado_cita', 'programada'));
        }
        $estado = $this->normalizarEstadoCitaValor($estadoRequest);

        if (!in_array($estado, array('asignada', 'en_proceso', 'entregada', 'revisada', 'cancelada'))) {
            return redirect()->back()->with('error', 'El estado de la actividad no es válido.');
        }

        $actividad = $this->obtenerActividadEditable($idActividad, $idPeriodo, $personal->id_personal);
        if (!$actividad) {
            return redirect()->back()->with('error', 'Solo el responsable que asignó la actividad puede editarla.');
        }

        $catalogo = DB::table('ar_actividad_catalogo')
            ->where('id_actividad_catalogo', $idCatalogo)
            ->where('activo', 1)
            ->first();

        if (!$catalogo) {
            return redirect()->back()->with('error', 'La actividad seleccionada no existe o está inactiva.');
        }

        DB::table('ar_caso_actividades')
            ->where('id_ar_actividad', $idActividad)
            ->update(array(
                'id_actividad_catalogo' => $catalogo->id_actividad_catalogo,
                'id_categoria_actividad' => $catalogo->id_categoria_actividad,
                'titulo' => $catalogo->nombre,
                'descripcion' => trim($request->get('descripcion')) != '' ? trim($request->get('descripcion')) : $catalogo->descripcion,
                'fecha_limite' => trim($request->get('fecha_limite')) != '' ? trim($request->get('fecha_limite')) : null,
                'estado' => $estado,
                'updated_at' => date('Y-m-d H:i:s'),
            ));

        return $this->redirectPiase($request, $idPeriodo, 'tab-actividades', array('focus' => 'actividad-' . $idActividad))
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function cancelarActividad(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_actividad' => 'required|integer',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idActividad = (int) $request->get('id_ar_actividad');
        $actividad = $this->obtenerActividadEditable($idActividad, $idPeriodo, $personal->id_personal);
        if (!$actividad) {
            return redirect()->back()->with('error', 'Solo el responsable que asignó la actividad puede cancelarla.');
        }

        DB::table('ar_caso_actividades')
            ->where('id_ar_actividad', $idActividad)
            ->update(array('estado' => 'cancelada', 'updated_at' => date('Y-m-d H:i:s')));

        return $this->redirectPiase($request, $idPeriodo, 'tab-actividades', array('focus' => 'actividad-' . $idActividad))
            ->with('success', 'Actividad cancelada correctamente.');
    }

    public function revisarEvidencia(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_ar_entrega' => 'required|integer',
            'calificacion_estrellas' => 'required|integer|min:1|max:5',
            'estado_revision' => 'required|string|max:30',
            'comentarios' => 'nullable|string|max:1000',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $personal = $this->resolverPersonalUsuario();
        if (!$personal) {
            return redirect('/home')->with('error', 'No se pudo identificar al usuario responsable.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idEntrega = (int) $request->get('id_ar_entrega');
        $entrega = $this->obtenerEntregaEditable($idEntrega, $idPeriodo, $personal->id_personal);
        if (!$entrega) {
            return redirect()->back()->with('error', 'Solo el responsable que asignó la actividad puede calificar la evidencia.');
        }

        $ahora = date('Y-m-d H:i:s');
        DB::table('ar_caso_actividad_revisiones')->insert(array(
            'id_ar_entrega' => $idEntrega,
            'fecha_revision' => $ahora,
            'validada' => $request->get('estado_revision') == 'validada' ? 1 : 0,
            'calificacion_estrellas' => (int) $request->get('calificacion_estrellas'),
            'estado_revision' => trim($request->get('estado_revision')),
            'comentarios' => trim($request->get('comentarios')),
            'recomendaciones' => trim($request->get('comentarios')),
            'id_personal_revisa' => $personal->id_personal,
            'id_usuario_revisa' => Auth::id(),
            'created_at' => $ahora,
            'updated_at' => $ahora,
        ));

        DB::table('ar_caso_actividad_entregas')
            ->where('id_ar_entrega', $idEntrega)
            ->update(array('estado' => 'revisada', 'updated_at' => $ahora));

        DB::table('ar_caso_actividades')
            ->where('id_ar_actividad', $entrega->id_ar_actividad)
            ->update(array('estado' => 'revisada', 'updated_at' => $ahora));

        return $this->redirectPiase($request, $idPeriodo, 'tab-actividades', array('focus' => 'actividad-' . $entrega->id_ar_actividad))
            ->with('success', 'Evidencia calificada correctamente.');
    }


    private function tabRetorno(Request $request, $default = 'tab-estudiantes')
    {
        // active_tab se llena por JavaScript justo antes de enviar cualquier formulario.
        // Debe tener prioridad para evitar que un input fijo del formulario mande al usuario
        // a otra pestaña después de guardar, editar o cancelar.
        $tab = trim((string) $request->get('active_tab', ''));
        if ($tab == '') {
            $tab = trim((string) $request->get('tab', ''));
        }

        if (!in_array($tab, array('tab-estudiantes', 'tab-canalizados', 'tab-citas', 'tab-cerrados', 'tab-actividades'))) {
            $tab = $default;
        }

        return $tab;
    }

    private function focusRetorno(Request $request, $default = '')
    {
        // active_focus se actualiza al abrir modales o accionar botones,
        // por eso tiene prioridad sobre focus.
        $focus = trim((string) $request->get('active_focus', ''));
        if ($focus == '') {
            $focus = trim((string) $request->get('focus', ''));
        }

        $focus = preg_replace('/[^A-Za-z0-9_\-]/', '', $focus);
        if ($focus == '' && $default != '') {
            $focus = preg_replace('/[^A-Za-z0-9_\-]/', '', $default);
        }

        return $focus;
    }

    private function redirectPiase(Request $request, $idPeriodo, $defaultTab = 'tab-estudiantes', $extra = array())
    {
        $params = array(
            'id_periodo' => (int) $idPeriodo,
            'tab' => $this->tabRetorno($request, $defaultTab),
        );

        $idCarrera = (int) $request->get('filtro_id_carrera', 0);
        if ($idCarrera <= 0 && !$request->has('id_alumno')) {
            $idCarrera = (int) $request->get('id_carrera', 0);
        }
        if ($idCarrera > 0) {
            $params['id_carrera'] = $idCarrera;
        }

        $buscarEstudiante = trim((string) $request->get('buscar_estudiante', ''));
        if ($buscarEstudiante != '') {
            $params['buscar_estudiante'] = $buscarEstudiante;
        }

        foreach ($extra as $key => $value) {
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
        }

        $focus = isset($extra['focus']) ? $extra['focus'] : $this->focusRetorno($request);
        $focus = preg_replace('/[^A-Za-z0-9_\-]/', '', (string) $focus);
        if ($focus != '') {
            $params['focus'] = $focus;
        }

        return redirect()->route('piase.index', $params);
    }

    private function vistaBase($overrides)
    {
        $base = array(
            'permitido' => true,
            'mensaje' => null,
            'personal' => null,
            'periodos' => collect(),
            'periodoSeleccionado' => null,
            'areasResponsable' => collect(),
            'esResponsablePedagogia' => false,
            'areaPedagogia' => null,
            'resumenCarreras' => collect(),
            'areasActivas' => collect(),
            'horariosDisponibles' => collect(),
            'horariosDisponiblesJson' => '[]',
            'categoriasActividades' => collect(),
            'catalogoActividades' => collect(),
            'citasAsignadas' => collect(),
            'actividadesSeguimiento' => collect(),
            'rutasCasos' => array(),
            'resultadosBusquedaEstudiantes' => collect(),
            'busquedaEstudiante' => '',
            'citasOcupadasJson' => '{}',
            'periodoRangoJson' => '{"inicio":null,"fin":null}',
            'filasEstudiantes' => collect(),
            'filasCanalizados' => collect(),
            'filasCerrados' => collect(),
            'graficasCerradosJson' => '{}',
            'unidades' => array(1, 2, 3, 4),
            'filtros' => array('id_periodo' => null, 'id_carrera' => 0, 'buscar_estudiante' => ''),
        );

        foreach ($overrides as $key => $value) {
            $base[$key] = $value;
        }

        return $base;
    }

    private function resolverPersonalUsuario()
    {
        $idUsuario = Auth::id();
        if (!$idUsuario) {
            return null;
        }

        $usuario = DB::table('users')->where('id', $idUsuario)->first();
        if (!$usuario) {
            return null;
        }

        $correo = '';
        if (isset($usuario->email) && trim($usuario->email) != '') {
            $correo = trim(strtolower($usuario->email));
        }

        $idSesion = session()->get('id_perso');
        if ($idSesion) {
            $personalSesion = DB::table('gnral_personales')->where('id_personal', $idSesion)->first();
            if ($personalSesion) {
                return $personalSesion;
            }
        }

        $consulta = DB::table('gnral_personales')->where('tipo_usuario', $usuario->id);
        if ($correo != '') {
            $consulta->orWhereRaw('LOWER(TRIM(correo)) = ?', array($correo));
        }

        return $consulta->first();
    }

    private function obtenerPeriodosResponsable($idPersonal)
    {
        return DB::table('ar_area_responsables_periodo as arp')
            ->join('gnral_periodos as gp', 'gp.id_periodo', '=', 'arp.id_periodo')
            ->join('ar_areas_atencion as aa', 'aa.id_area_atencion', '=', 'arp.id_area_atencion')
            ->where('arp.id_personal', $idPersonal)
            ->where('arp.activo', 1)
            ->where('aa.activo', 1)
            ->select('gp.id_periodo', 'gp.periodo', 'gp.fecha_inicio', 'gp.fecha_termino')
            ->groupBy('gp.id_periodo', 'gp.periodo', 'gp.fecha_inicio', 'gp.fecha_termino')
            ->orderBy('gp.id_periodo', 'desc')
            ->get();
    }

    private function buscarPeriodoEnColeccion($periodos, $idPeriodo)
    {
        foreach ($periodos as $periodo) {
            if ((int) $periodo->id_periodo === (int) $idPeriodo) {
                return $periodo;
            }
        }
        return null;
    }

    private function obtenerAreasResponsable($idPersonal, $idPeriodo)
    {
        return DB::table('ar_area_responsables_periodo as arp')
            ->join('ar_areas_atencion as aa', 'aa.id_area_atencion', '=', 'arp.id_area_atencion')
            ->where('arp.id_personal', $idPersonal)
            ->where('arp.id_periodo', $idPeriodo)
            ->where('arp.activo', 1)
            ->where('aa.activo', 1)
            ->select('aa.id_area_atencion', 'aa.nombre', 'aa.requiere_citas', 'aa.requiere_actividades', 'aa.maneja_datos_sensibles')
            ->orderBy('aa.orden')
            ->orderBy('aa.nombre')
            ->get();
    }

    private function obtenerAreaPorNombre($nombres)
    {
        return DB::table('ar_areas_atencion')
            ->where('activo', 1)
            ->whereIn('nombre', $nombres)
            ->orderBy('orden')
            ->first();
    }

    private function obtenerAreasActivas()
    {
        return DB::table('ar_areas_atencion')
            ->where('activo', 1)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();
    }

    private function obtenerHorariosDisponibles($idPeriodo)
    {
        return DB::table('ar_area_responsable_horarios as h')
            ->join('ar_area_responsables_periodo as rp', 'rp.id_area_responsable_periodo', '=', 'h.id_area_responsable_periodo')
            ->join('ar_areas_atencion as aa', 'aa.id_area_atencion', '=', 'h.id_area_atencion')
            ->join('gnral_personales as p', 'p.id_personal', '=', 'h.id_personal')
            ->where('h.id_periodo', $idPeriodo)
            ->where('h.activo', 1)
            ->where('rp.activo', 1)
            ->where('aa.activo', 1)
            ->select(
                'h.id_area_responsable_horario',
                'h.id_area_responsable_periodo',
                'h.id_area_atencion',
                'h.id_periodo',
                'h.id_personal',
                'h.dia_semana',
                'h.hora_inicio',
                'h.hora_fin',
                'h.lugar',
                'aa.nombre as area',
                'p.nombre as responsable'
            )
            ->orderBy('aa.orden')
            ->orderBy('p.nombre')
            ->orderBy('h.dia_semana')
            ->orderBy('h.hora_inicio')
            ->get();
    }

    private function usuarioEsResponsableArea($idPersonal, $idPeriodo, $idArea)
    {
        return DB::table('ar_area_responsables_periodo')
            ->where('id_personal', $idPersonal)
            ->where('id_periodo', $idPeriodo)
            ->where('id_area_atencion', $idArea)
            ->where('activo', 1)
            ->exists();
    }

    private function buscarEstudiantesParaCanalizar($idPeriodo, $busqueda, $idCarrera)
    {
        $busqueda = trim((string) $busqueda);
        if (mb_strlen($busqueda) < 2) {
            return collect();
        }

        /*
         * Buscador PIASE:
         * - Debe mostrar cualquier estudiante con carga académica en el periodo.
         * - No debe limitarse a estudiantes con unidades reprobadas.
         * - La reprobación se conserva como dato informativo.
         */
        $query = DB::table('gnral_alumnos as a')
            ->join('eva_carga_academica as ca', function ($join) use ($idPeriodo) {
                $join->on('ca.id_alumno', '=', 'a.id_alumno')
                    ->where('ca.id_periodo', '=', $idPeriodo);
            })
            ->leftJoin('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->leftJoin('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->leftJoin('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
            ->leftJoin('ar_casos_estudiantes as ce', function ($join) use ($idPeriodo) {
                $join->on('ce.id_alumno', '=', 'a.id_alumno')
                    ->where('ce.id_periodo', '=', $idPeriodo)
                    ->where('ce.origen_caso', '=', 'reprobacion');
            });

        if ($idCarrera > 0) {
            $query->where('a.id_carrera', $idCarrera);
        }

        $like = '%' . $busqueda . '%';
        $query->where(function ($q) use ($like) {
            $q->where('a.cuenta', 'like', $like)
                ->orWhere('a.nombre', 'like', $like)
                ->orWhere('a.apaterno', 'like', $like)
                ->orWhere('a.amaterno', 'like', $like)
                ->orWhereRaw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) LIKE ?", array($like))
                ->orWhereRaw("CONCAT_WS(' ', a.apaterno, a.amaterno, a.nombre) LIKE ?", array($like));
        });

        return $query->select(
            'a.id_alumno',
            'a.cuenta',
            'a.id_carrera',
            'a.id_semestre',
            'a.nombre as nombre_alumno',
            'a.apaterno',
            'a.amaterno',
            DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
            DB::raw("COALESCE(c.nombre, 'Sin carrera registrada') as carrera"),
            DB::raw("COUNT(DISTINCT ca.id_materia) as asignaturas_cursando"),
            DB::raw("COUNT(DISTINCT CASE WHEN ev.calificacion < " . self::CALIFICACION_MINIMA_APROBATORIA . " THEN ca.id_materia ELSE NULL END) as asignaturas_reprobadas"),
            DB::raw("GROUP_CONCAT(DISTINCT m.nombre ORDER BY m.nombre SEPARATOR ', ') as asignaturas"),
            DB::raw('MAX(ce.id_ar_caso) as id_ar_caso'),
            DB::raw('MAX(ce.estado) as estado_caso')
        )
            ->groupBy('a.id_alumno', 'a.cuenta', 'a.id_carrera', 'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre')
            ->orderBy('a.apaterno')
            ->orderBy('a.amaterno')
            ->orderBy('a.nombre')
            ->limit(40)
            ->get();
    }

    private function obtenerAlumnoParaCanalizacion($idPeriodo, $idAlumno, $idCarrera)
    {
        return DB::table('gnral_alumnos as a')
            ->join('eva_carga_academica as ca', function ($join) use ($idPeriodo) {
                $join->on('ca.id_alumno', '=', 'a.id_alumno')
                    ->where('ca.id_periodo', '=', $idPeriodo);
            })
            ->where('a.id_alumno', $idAlumno)
            ->where('a.id_carrera', $idCarrera)
            ->select('a.id_alumno', 'a.id_carrera', 'a.id_semestre', 'a.cuenta', 'a.nombre', 'a.apaterno', 'a.amaterno')
            ->groupBy('a.id_alumno', 'a.id_carrera', 'a.id_semestre', 'a.cuenta', 'a.nombre', 'a.apaterno', 'a.amaterno')
            ->first();
    }

    private function obtenerResumenCarrerasPedagogia($idPeriodo, $idAreaPedagogia)
    {
        if ($idAreaPedagogia <= 0) {
            return collect();
        }

        return DB::table('ar_casos_estudiantes as ce')
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'ce.id_carrera')
            ->where('ce.id_periodo', $idPeriodo)
            ->where('ce.origen_caso', 'reprobacion')
            ->where('ce.estado', '<>', 'cerrado')
            ->where('cc.id_area_destino', $idAreaPedagogia)
            ->whereNotIn('cc.estado', array('cancelado', 'cerrado'))
            ->select('c.id_carrera', 'c.nombre as carrera', DB::raw('COUNT(DISTINCT ce.id_alumno) as total_estudiantes'))
            ->groupBy('c.id_carrera', 'c.nombre')
            ->orderBy('c.nombre')
            ->get();
    }

    private function baseConsultaCasos($idPeriodo)
    {
        return DB::table('ar_casos_estudiantes as ce')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ce.id_alumno')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'ce.id_carrera')
            ->leftJoin('gnral_personales as tutor', 'tutor.id_personal', '=', 'ce.id_personal_tutor')
            ->where('ce.id_periodo', $idPeriodo)
            ->where('ce.origen_caso', 'reprobacion');
    }

    private function seleccionarCamposCaso($query)
    {
        return $query->select(
            'ce.id_ar_caso',
            'ce.id_periodo',
            'ce.id_carrera',
            'ce.id_alumno',
            'ce.estado as estado_caso',
            'ce.fecha_apertura',
            'ce.fecha_cierre',
            'ce.resultado_cierre',
            'a.cuenta',
            'a.id_semestre',
            DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
            'a.nombre as nombre_alumno',
            'a.apaterno',
            'a.amaterno',
            'c.nombre as carrera',
            'tutor.nombre as tutor'
        );
    }

    private function obtenerCasosEntradaPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia)
    {
        if ($idAreaPedagogia <= 0) {
            return collect();
        }

        $subCanalizadosPedagogia = DB::table('ar_caso_canalizaciones as mov')
            ->select('mov.id_ar_caso')
            ->where('mov.id_area_origen', $idAreaPedagogia)
            ->whereNotIn('mov.estado', array('cancelado'));

        $query = $this->baseConsultaCasos($idPeriodo)
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->where('ce.estado', '<>', 'cerrado')
            ->where('cc.id_area_destino', $idAreaPedagogia)
            ->whereNotIn('cc.estado', array('cancelado', 'cerrado'))
            ->whereNotIn('ce.id_ar_caso', $subCanalizadosPedagogia);

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        $query = $this->seleccionarCamposCaso($query);
        $query->addSelect(
            DB::raw('MAX(cc.id_ar_caso_canalizacion) as id_ar_caso_canalizacion'),
            DB::raw('MAX(cc.fecha_canalizacion) as fecha_canalizacion'),
            DB::raw('MAX(cc.estado) as estado_canalizacion'),
            DB::raw('NULL as id_area_destino'),
            DB::raw('NULL as area_destino'),
            DB::raw('NULL as responsable_destino'),
            DB::raw('0 as sesiones_area'),
            DB::raw('NULL as ultima_cita')
        );

        return $query->groupBy(
            'ce.id_ar_caso', 'ce.id_periodo', 'ce.id_carrera', 'ce.id_alumno', 'ce.estado',
            'ce.fecha_apertura', 'ce.fecha_cierre', 'ce.resultado_cierre', 'a.cuenta',
            'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre', 'tutor.nombre'
        )->orderBy('c.nombre')->orderBy('a.apaterno')->orderBy('a.amaterno')->orderBy('a.nombre')->get();
    }

    private function obtenerCasosCanalizadosPorPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia)
    {
        if ($idAreaPedagogia <= 0) {
            return collect();
        }

        $query = $this->baseConsultaCasos($idPeriodo)
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->join('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->leftJoin('ar_caso_citas as cita', 'cita.id_ar_caso_canalizacion', '=', 'cc.id_ar_caso_canalizacion')
            ->where('ce.estado', '<>', 'cerrado')
            ->where('cc.id_area_origen', $idAreaPedagogia)
            ->whereNotIn('cc.estado', array('cancelado'));

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        $query = $this->seleccionarCamposCaso($query);
        $query->addSelect(
            'cc.id_ar_caso_canalizacion',
            'cc.fecha_canalizacion',
            'cc.estado as estado_canalizacion',
            'cc.id_area_destino',
            'ad.nombre as area_destino',
            'resp.nombre as responsable_destino',
            DB::raw("COUNT(DISTINCT CASE WHEN cita.estado NOT IN ('cancelada', 'cancelado') THEN cita.id_ar_cita END) as sesiones_area"),
            DB::raw("MAX(CASE WHEN cita.estado NOT IN ('cancelada', 'cancelado') THEN cita.fecha_cita END) as ultima_cita")
        );

        return $query->groupBy(
            'ce.id_ar_caso', 'ce.id_periodo', 'ce.id_carrera', 'ce.id_alumno', 'ce.estado',
            'ce.fecha_apertura', 'ce.fecha_cierre', 'ce.resultado_cierre', 'a.cuenta',
            'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre', 'tutor.nombre',
            'cc.id_ar_caso_canalizacion', 'cc.fecha_canalizacion', 'cc.estado', 'cc.id_area_destino',
            'ad.nombre', 'resp.nombre'
        )->orderBy('cc.fecha_canalizacion', 'desc')->get();
    }

    private function obtenerCasosCanalizadosResponsable($idPersonal, $idPeriodo, $idsAreas, $idCarrera)
    {
        if (empty($idsAreas)) {
            return collect();
        }

        $query = $this->baseConsultaCasos($idPeriodo)
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->join('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->leftJoin('ar_caso_citas as cita', 'cita.id_ar_caso_canalizacion', '=', 'cc.id_ar_caso_canalizacion')
            ->where('ce.estado', '<>', 'cerrado')
            ->whereIn('cc.id_area_destino', $idsAreas)
            ->where(function ($q) use ($idPersonal) {
                $q->where('cc.id_personal_responsable_destino', $idPersonal)
                    ->orWhereNull('cc.id_personal_responsable_destino');
            })
            ->whereNotIn('cc.estado', array('cancelado'));

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        $query = $this->seleccionarCamposCaso($query);
        $query->addSelect(
            'cc.id_ar_caso_canalizacion',
            'cc.fecha_canalizacion',
            'cc.estado as estado_canalizacion',
            'cc.id_area_destino',
            'ad.nombre as area_destino',
            'resp.nombre as responsable_destino',
            DB::raw("COUNT(DISTINCT CASE WHEN cita.estado NOT IN ('cancelada', 'cancelado') THEN cita.id_ar_cita END) as sesiones_area"),
            DB::raw("MAX(CASE WHEN cita.estado NOT IN ('cancelada', 'cancelado') THEN cita.fecha_cita END) as ultima_cita")
        );

        return $query->groupBy(
            'ce.id_ar_caso', 'ce.id_periodo', 'ce.id_carrera', 'ce.id_alumno', 'ce.estado',
            'ce.fecha_apertura', 'ce.fecha_cierre', 'ce.resultado_cierre', 'a.cuenta',
            'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre', 'tutor.nombre',
            'cc.id_ar_caso_canalizacion', 'cc.fecha_canalizacion', 'cc.estado', 'cc.id_area_destino',
            'ad.nombre', 'resp.nombre'
        )->orderBy('cc.fecha_canalizacion', 'desc')->get();
    }

    private function obtenerCasosCerradosPedagogia($idPeriodo, $idCarrera, $idAreaPedagogia)
    {
        if ($idAreaPedagogia <= 0) {
            return collect();
        }

        $query = $this->baseConsultaCasos($idPeriodo)
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->where('ce.estado', 'cerrado')
            ->where(function ($q) use ($idAreaPedagogia) {
                $q->where('cc.id_area_destino', $idAreaPedagogia)
                    ->orWhere('cc.id_area_origen', $idAreaPedagogia);
            });

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        $query = $this->seleccionarCamposCaso($query);
        $query->addSelect(
            DB::raw('MAX(cc.id_ar_caso_canalizacion) as id_ar_caso_canalizacion'),
            DB::raw('MAX(cc.fecha_canalizacion) as fecha_canalizacion'),
            DB::raw('MAX(cc.estado) as estado_canalizacion'),
            DB::raw('NULL as id_area_destino'),
            DB::raw('NULL as area_destino'),
            DB::raw('NULL as responsable_destino'),
            DB::raw('0 as sesiones_area'),
            DB::raw('NULL as ultima_cita')
        );

        return $query->groupBy(
            'ce.id_ar_caso', 'ce.id_periodo', 'ce.id_carrera', 'ce.id_alumno', 'ce.estado',
            'ce.fecha_apertura', 'ce.fecha_cierre', 'ce.resultado_cierre', 'a.cuenta',
            'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre', 'tutor.nombre'
        )->orderBy('ce.fecha_cierre', 'desc')->get();
    }

    private function obtenerCasosCerradosResponsable($idPersonal, $idPeriodo, $idsAreas, $idCarrera)
    {
        if (empty($idsAreas)) {
            return collect();
        }

        $query = $this->baseConsultaCasos($idPeriodo)
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->join('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->where('ce.estado', 'cerrado')
            ->whereIn('cc.id_area_destino', $idsAreas)
            ->where(function ($q) use ($idPersonal) {
                $q->where('cc.id_personal_responsable_destino', $idPersonal)
                    ->orWhereNull('cc.id_personal_responsable_destino');
            });

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        $query = $this->seleccionarCamposCaso($query);
        $query->addSelect(
            DB::raw('MAX(cc.id_ar_caso_canalizacion) as id_ar_caso_canalizacion'),
            DB::raw('MAX(cc.fecha_canalizacion) as fecha_canalizacion'),
            DB::raw('MAX(cc.estado) as estado_canalizacion'),
            DB::raw('MAX(cc.id_area_destino) as id_area_destino'),
            DB::raw('MAX(ad.nombre) as area_destino'),
            DB::raw('MAX(resp.nombre) as responsable_destino'),
            DB::raw('0 as sesiones_area'),
            DB::raw('NULL as ultima_cita')
        );

        return $query->groupBy(
            'ce.id_ar_caso', 'ce.id_periodo', 'ce.id_carrera', 'ce.id_alumno', 'ce.estado',
            'ce.fecha_apertura', 'ce.fecha_cierre', 'ce.resultado_cierre', 'a.cuenta',
            'a.id_semestre', 'a.nombre', 'a.apaterno', 'a.amaterno', 'c.nombre', 'tutor.nombre'
        )->orderBy('ce.fecha_cierre', 'desc')->get();
    }

    private function construirFilasPorMateria($casos, $idPeriodo)
    {
        if ($casos->isEmpty()) {
            return array('filas' => collect(), 'unidades' => array(1, 2, 3, 4), 'graficas' => array());
        }

        $casosPorId = array();
        $idsCasos = array();
        foreach ($casos as $caso) {
            if (!isset($casosPorId[$caso->id_ar_caso])) {
                $casosPorId[$caso->id_ar_caso] = array();
            }
            $casosPorId[$caso->id_ar_caso][] = $caso;
            $idsCasos[$caso->id_ar_caso] = $caso->id_ar_caso;
        }
        $idsCasos = array_values($idsCasos);

        $docentesAsignaturaSubquery = DB::raw("(
            SELECT
                gpc.id_periodo,
                gpc.id_carrera,
                hp.grupo,
                mp.id_materia,
                GROUP_CONCAT(DISTINCT docente.nombre ORDER BY docente.nombre SEPARATOR ', ') AS docente_asignatura
            FROM gnral_horarios h
            INNER JOIN gnral_periodo_carreras gpc
                ON gpc.id_periodo_carrera = h.id_periodo_carrera
            INNER JOIN gnral_horas_profesores hp
                ON hp.id_horario_profesor = h.id_horario_profesor
            INNER JOIN gnral_materias_perfiles mp
                ON mp.id_materia_perfil = hp.id_materia_perfil
            INNER JOIN gnral_personales docente
                ON docente.id_personal = h.id_personal
            GROUP BY gpc.id_periodo, gpc.id_carrera, hp.grupo, mp.id_materia
        ) as doc_asig");

        $evaluaciones = DB::table('ar_casos_estudiantes as ce')
            ->join('eva_carga_academica as ca', function ($join) {
                $join->on('ca.id_alumno', '=', 'ce.id_alumno')
                    ->on('ca.id_periodo', '=', 'ce.id_periodo');
            })
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->leftJoin($docentesAsignaturaSubquery, function ($join) {
                $join->on('doc_asig.id_periodo', '=', 'ce.id_periodo')
                    ->on('doc_asig.id_carrera', '=', 'ce.id_carrera')
                    ->on('doc_asig.grupo', '=', 'ca.grupo')
                    ->on('doc_asig.id_materia', '=', 'ca.id_materia');
            })
            ->whereIn('ce.id_ar_caso', $idsCasos)
            ->where('ce.id_periodo', $idPeriodo)
            ->select(
                'ce.id_ar_caso',
                'ca.id_carga_academica',
                'm.id_materia',
                'm.nombre as materia',
                'm.clave',
                'm.id_semestre as semestre_materia',
                'm.unidades',
                DB::raw("COALESCE(doc_asig.docente_asignatura, 'Sin docente registrado') as docente_asignatura"),
                'ev.id_unidad',
                'ev.calificacion'
            )
            ->orderBy('ce.id_ar_caso')
            ->orderBy('m.nombre')
            ->orderBy('ev.id_unidad')
            ->get();

        $materias = array();
        $unidades = array();

        foreach ($evaluaciones as $ev) {
            $key = $ev->id_ar_caso . '_' . $ev->id_materia;
            if (!isset($materias[$key])) {
                $materias[$key] = array(
                    'id_ar_caso' => $ev->id_ar_caso,
                    'id_materia' => $ev->id_materia,
                    'materia' => $ev->materia,
                    'clave' => $ev->clave,
                    'docente_asignatura' => $ev->docente_asignatura,
                    'semestre_materia' => $ev->semestre_materia,
                    'calificaciones' => array(),
                    'tiene_reprobacion' => false,
                );
            }

            $unidad = (int) $ev->id_unidad;
            $calificacion = (int) $ev->calificacion;
            $materias[$key]['calificaciones'][$unidad] = $calificacion;

            if ($calificacion < self::CALIFICACION_MINIMA_APROBATORIA) {
                $materias[$key]['tiene_reprobacion'] = true;
            }

            if ($unidad > 0) {
                $unidades[$unidad] = $unidad;
            }

            if ((int) $ev->unidades > 0) {
                for ($u = 1; $u <= (int) $ev->unidades; $u++) {
                    $unidades[$u] = $u;
                }
            }
        }

        if (empty($unidades)) {
            $unidades = array(1 => 1, 2 => 2, 3 => 3, 4 => 4);
        }
        ksort($unidades);

        $filas = collect();
        $graficas = array();

        foreach ($materias as $materia) {
            if (!$materia['tiene_reprobacion']) {
                continue;
            }

            $casosRelacionados = isset($casosPorId[$materia['id_ar_caso']]) ? $casosPorId[$materia['id_ar_caso']] : array();
            if (empty($casosRelacionados)) {
                continue;
            }

            foreach ($casosRelacionados as $caso) {
                $fila = clone $caso;
                $fila->id_materia = $materia['id_materia'];
                $fila->materia = $materia['materia'];
                $fila->clave_materia = $materia['clave'];
                $fila->docente_asignatura = $materia['docente_asignatura'];
                $fila->semestre_materia = $materia['semestre_materia'];
                $fila->calificaciones = $materia['calificaciones'];
                $filas->push($fila);

                if (!isset($graficas[$caso->id_ar_caso])) {
                    $graficas[$caso->id_ar_caso] = array(
                        'alumno' => $caso->alumno,
                        'carrera' => $caso->carrera,
                        'materias' => array(),
                    );
                }

                $graficas[$caso->id_ar_caso]['materias'][] = array(
                    'materia' => $materia['materia'],
                    'docente_asignatura' => $materia['docente_asignatura'],
                    'calificaciones' => $materia['calificaciones'],
                );
            }
        }

        $filas = $filas->sortBy(function ($fila) {
            $clave = '';
            $clave .= isset($fila->carrera) ? $fila->carrera : '';
            $clave .= '|';
            $clave .= isset($fila->apaterno) ? $fila->apaterno : '';
            $clave .= '|';
            $clave .= isset($fila->amaterno) ? $fila->amaterno : '';
            $clave .= '|';
            $clave .= isset($fila->nombre_alumno) ? $fila->nombre_alumno : '';
            $clave .= '|';
            $clave .= isset($fila->id_ar_caso_canalizacion) ? $fila->id_ar_caso_canalizacion : 0;
            $clave .= '|';
            $clave .= isset($fila->materia) ? $fila->materia : '';
            return $clave;
        })->values();

        return array('filas' => $filas, 'unidades' => array_values($unidades), 'graficas' => $graficas);
    }

    private function mezclarUnidades($listas)
    {
        $unidades = array();
        foreach ($listas as $lista) {
            foreach ($lista as $unidad) {
                $unidades[(int) $unidad] = (int) $unidad;
            }
        }

        if (empty($unidades)) {
            $unidades = array(1 => 1, 2 => 2, 3 => 3, 4 => 4);
        }

        ksort($unidades);
        return array_values($unidades);
    }

    private function contarSesionesCasoArea($idCaso, $idArea)
    {
        return DB::table('ar_caso_citas')
            ->where('id_ar_caso', $idCaso)
            ->where('id_area_atencion', $idArea)
            ->whereNotIn('estado', array('cancelada', 'cancelado'))
            ->count();
    }

    private function validarFechaYSlotContraHorario($horario, $fecha, $horaInicioSlot, $horaFinSlot)
    {
        $timestamp = strtotime($fecha);
        if (!$timestamp) {
            return array('ok' => false, 'mensaje' => 'La fecha seleccionada no es válida.');
        }

        $diaSemana = (int) date('N', $timestamp);
        if ($diaSemana !== (int) $horario->dia_semana) {
            return array(
                'ok' => false,
                'mensaje' => 'La fecha seleccionada no corresponde al día de atención del responsable.',
            );
        }

        $inicioHorario = $this->normalizarHora($horario->hora_inicio);
        $finHorario = $this->normalizarHora($horario->hora_fin);
        $horaInicioSlot = $this->normalizarHora($horaInicioSlot);
        $horaFinSlot = $this->normalizarHora($horaFinSlot);

        $inicioHorarioTs = strtotime('2000-01-01 ' . $inicioHorario);
        $finHorarioTs = strtotime('2000-01-01 ' . $finHorario);

        if (!$inicioHorarioTs || !$finHorarioTs || $finHorarioTs <= $inicioHorarioTs) {
            return array('ok' => false, 'mensaje' => 'El horario del responsable está mal configurado.');
        }

        if ($horaInicioSlot !== $inicioHorario || $horaFinSlot !== $finHorario) {
            return array('ok' => false, 'mensaje' => 'El horario seleccionado no coincide con el bloque de atención del responsable.');
        }

        return array('ok' => true, 'mensaje' => null);
    }

    private function contarOcupacionSlot($idHorario, $fecha, $horaInicioSlot, $horaFinSlot)
    {
        /*
         * Nueva regla:
         * un horario completo de un responsable solo puede asignarse a un estudiante
         * por fecha. No se divide el horario y no se maneja cupo.
         */
        return DB::table('ar_caso_citas')
            ->where('id_area_responsable_horario', $idHorario)
            ->whereRaw('DATE(fecha_cita) = ?', array($fecha))
            ->whereNotIn('estado', array('cancelada', 'cancelado'))
            ->count();
    }

    private function obtenerCitasOcupadas($idPeriodo)
    {
        $registros = DB::table('ar_caso_citas as cita')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cita.id_ar_caso')
            ->where('ce.id_periodo', $idPeriodo)
            ->whereNotIn('cita.estado', array('cancelada', 'cancelado'))
            ->whereNotNull('cita.id_area_responsable_horario')
            ->select(
                'cita.id_area_responsable_horario',
                DB::raw('DATE(cita.fecha_cita) as fecha'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('cita.id_area_responsable_horario', DB::raw('DATE(cita.fecha_cita)'))
            ->get();

        $ocupadas = array();
        foreach ($registros as $registro) {
            $clave = $registro->id_area_responsable_horario . '|' . $registro->fecha;
            $ocupadas[$clave] = (int) $registro->total;
        }

        return $ocupadas;
    }

    private function obtenerRangoPeriodo($idPeriodo)
    {
        $periodo = DB::table('gnral_periodos')
            ->where('id_periodo', $idPeriodo)
            ->select('fecha_inicio', 'fecha_termino')
            ->first();

        if (!$periodo) {
            return array('inicio' => null, 'fin' => null);
        }

        $inicio = $periodo->fecha_inicio ? date('Y-m-d', strtotime($periodo->fecha_inicio)) : null;
        $fin = $periodo->fecha_termino ? date('Y-m-d', strtotime($periodo->fecha_termino)) : null;

        return array('inicio' => $inicio, 'fin' => $fin);
    }

    private function validarFechaDentroDelPeriodo($idPeriodo, $fecha)
    {
        $rango = $this->obtenerRangoPeriodo($idPeriodo);

        if (!$rango['inicio'] || !$rango['fin']) {
            return array(
                'ok' => false,
                'mensaje' => 'El periodo seleccionado no tiene fecha de inicio o fecha de término configurada.',
            );
        }

        $fechaDia = date('Y-m-d', strtotime($fecha));

        if ($fechaDia < $rango['inicio'] || $fechaDia > $rango['fin']) {
            return array(
                'ok' => false,
                'mensaje' => 'La fecha seleccionada está fuera del periodo académico.',
            );
        }

        return array('ok' => true, 'mensaje' => null);
    }

    private function normalizarHora($hora)
    {
        $hora = trim((string) $hora);
        if (strlen($hora) >= 8) {
            return substr($hora, 0, 8);
        }
        if (strlen($hora) == 5) {
            return $hora . ':00';
        }
        return '00:00:00';
    }


    private function obtenerCategoriasActividades()
    {
        return DB::table('ar_actividad_categorias')
            ->where('activo', 1)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();
    }

    private function obtenerCatalogoActividades()
    {
        return DB::table('ar_actividad_catalogo as ac')
            ->leftJoin('ar_actividad_categorias as cat', 'cat.id_categoria_actividad', '=', 'ac.id_categoria_actividad')
            ->where('ac.activo', 1)
            ->select('ac.*', 'cat.nombre as categoria')
            ->orderBy('cat.orden')
            ->orderBy('ac.nombre')
            ->get();
    }

    private function obtenerCitasAsignadas($idPersonal, $idPeriodo, $idsAreas, $idCarrera)
    {
        if (empty($idsAreas)) {
            return collect();
        }

        $query = DB::table('ar_caso_citas as cita')
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'cita.id_ar_caso_canalizacion')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cita.id_ar_caso')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ce.id_alumno')
            ->leftJoin('gnral_carreras as car', 'car.id_carrera', '=', 'ce.id_carrera')
            ->leftJoin('ar_areas_atencion as ao', 'ao.id_area_atencion', '=', 'cc.id_area_origen')
            ->leftJoin('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->leftJoin('ar_area_responsable_horarios as h', 'h.id_area_responsable_horario', '=', 'cita.id_area_responsable_horario')
            ->leftJoin(DB::raw('(
                SELECT 
                    act.id_ar_cita,
                    COUNT(DISTINCT act.id_ar_actividad) AS total_actividades,
                    COUNT(DISTINCT CASE WHEN ent.id_ar_entrega IS NOT NULL THEN act.id_ar_actividad ELSE NULL END) AS actividades_con_evidencia
                FROM ar_caso_actividades act
                LEFT JOIN ar_caso_actividad_entregas ent
                    ON ent.id_ar_actividad = act.id_ar_actividad
                   AND IFNULL(ent.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                WHERE IFNULL(act.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                GROUP BY act.id_ar_cita
            ) AS act_count'), 'act_count.id_ar_cita', '=', 'cita.id_ar_cita')
            ->leftJoin(DB::raw('(
                SELECT 
                    act.id_ar_caso_canalizacion,
                    COUNT(DISTINCT act.id_ar_actividad) AS total_actividades_global,
                    COUNT(DISTINCT CASE WHEN ent.id_ar_entrega IS NOT NULL THEN act.id_ar_actividad ELSE NULL END) AS actividades_con_evidencia_global
                FROM ar_caso_actividades act
                LEFT JOIN ar_caso_actividad_entregas ent
                    ON ent.id_ar_actividad = act.id_ar_actividad
                   AND IFNULL(ent.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                WHERE IFNULL(act.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                GROUP BY act.id_ar_caso_canalizacion
            ) AS act_global'), 'act_global.id_ar_caso_canalizacion', '=', 'cc.id_ar_caso_canalizacion')
            ->where('ce.id_periodo', $idPeriodo)
            ->where('cc.id_personal_responsable_destino', $idPersonal)
            ->whereIn('cc.id_area_destino', $idsAreas)
            ->where('ce.estado', '<>', 'cerrado');

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        return $query->select(
            'cita.*',
            DB::raw('cita.estado as estado_cita'),
            'cc.id_area_origen',
            'cc.id_area_destino',
            'cc.id_area_responsable_periodo_destino',
            'cc.id_personal_responsable_destino',
            'ce.id_periodo',
            'ce.id_carrera',
            'ce.estado as estado_caso',
            'a.cuenta',
            'a.id_alumno',
            'a.id_semestre',
            'a.nombre as nombre_alumno',
            'a.apaterno',
            'a.amaterno',
            DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
            DB::raw("COALESCE(car.nombre, 'Sin carrera registrada') as carrera"),
            DB::raw("COALESCE(ao.nombre, 'Sin área origen') as area_origen"),
            DB::raw("COALESCE(ad.nombre, 'Sin área destino') as area_destino"),
            DB::raw("COALESCE(resp.nombre, 'Sin responsable') as responsable_destino"),
            'h.dia_semana',
            'h.hora_inicio as horario_inicio',
            'h.hora_fin as horario_fin',
            DB::raw('COALESCE(act_count.total_actividades, 0) as total_actividades'),
            DB::raw('COALESCE(act_count.actividades_con_evidencia, 0) as actividades_con_evidencia'),
            DB::raw('COALESCE(act_global.total_actividades_global, 0) as total_actividades_global'),
            DB::raw('COALESCE(act_global.actividades_con_evidencia_global, 0) as actividades_con_evidencia_global')
        )
            ->orderBy('cita.fecha_cita', 'asc')
            ->orderBy('a.apaterno')
            ->orderBy('a.amaterno')
            ->get();
    }

    private function obtenerActividadesSeguimiento($idPersonal, $idPeriodo, $idsAreas, $idCarrera, $esResponsablePedagogia, $idAreaPedagogia)
    {
        if (empty($idsAreas)) {
            return collect();
        }

        $query = DB::table('ar_caso_actividades as act')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'act.id_ar_caso')
            ->leftJoin('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'act.id_ar_caso_canalizacion')
            ->leftJoin('ar_caso_citas as cita', 'cita.id_ar_cita', '=', 'act.id_ar_cita')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ce.id_alumno')
            ->leftJoin('gnral_carreras as car', 'car.id_carrera', '=', 'ce.id_carrera')
            ->leftJoin('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'act.id_area_atencion')
            ->leftJoin('ar_actividad_catalogo as ac', 'ac.id_actividad_catalogo', '=', 'act.id_actividad_catalogo')
            ->leftJoin('ar_actividad_categorias as cat', 'cat.id_categoria_actividad', '=', 'act.id_categoria_actividad')
            ->leftJoin('gnral_personales as asigna', 'asigna.id_personal', '=', 'act.id_personal_asigna')
            ->leftJoin('ar_caso_actividad_entregas as ent', function ($join) {
                $join->on('ent.id_ar_actividad', '=', 'act.id_ar_actividad')
                    ->whereNotIn('ent.estado', array('cancelada', 'cancelado'));
            })
            ->leftJoin('ar_caso_actividad_revisiones as rev', 'rev.id_ar_entrega', '=', 'ent.id_ar_entrega')
            ->where('ce.id_periodo', $idPeriodo)
            ->whereNotIn('act.estado', array('cancelada', 'cancelado'));

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        if (!$esResponsablePedagogia) {
            $query->where(function ($q) use ($idPersonal, $idsAreas) {
                $q->where('act.id_personal_asigna', $idPersonal)
                    ->orWhere('cc.id_personal_responsable_destino', $idPersonal)
                    ->orWhereIn('act.id_area_atencion', $idsAreas);
            });
        }

        return $query->select(
            'act.*',
            'ce.id_periodo',
            'ce.id_carrera',
            'ce.estado as estado_caso',
            'a.cuenta',
            'a.id_alumno',
            DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
            DB::raw("COALESCE(car.nombre, 'Sin carrera registrada') as carrera"),
            DB::raw("COALESCE(ad.nombre, 'Sin área') as area"),
            DB::raw("COALESCE(cat.nombre, 'Sin categoría') as categoria"),
            DB::raw("COALESCE(asigna.nombre, 'Sin responsable') as responsable_asigna"),
            'cita.fecha_cita',
            'cita.numero_sesion',
            'ent.id_ar_entrega',
            'ent.fecha_entrega',
            'ent.ruta_archivo',
            'ent.texto_evidencia',
            'ent.estado as estado_entrega',
            DB::raw('MAX(rev.calificacion_estrellas) as calificacion_estrellas'),
            DB::raw('MAX(rev.estado_revision) as estado_revision'),
            DB::raw('MAX(rev.comentarios) as comentarios_revision')
        )
            ->groupBy(
                'act.id_ar_actividad', 'act.id_ar_caso', 'act.id_ar_caso_canalizacion', 'act.id_ar_cita',
                'act.id_area_atencion', 'act.id_actividad_catalogo', 'act.id_categoria_actividad', 'act.titulo',
                'act.descripcion', 'act.fecha_asignacion', 'act.fecha_limite', 'act.estado', 'act.id_personal_asigna',
                'act.id_usuario_asigna', 'act.created_at', 'act.updated_at', 'ce.id_periodo', 'ce.id_carrera', 'ce.estado',
                'a.cuenta', 'a.id_alumno', 'a.nombre', 'a.apaterno', 'a.amaterno', 'car.nombre', 'ad.nombre', 'cat.nombre',
                'asigna.nombre', 'cita.fecha_cita', 'cita.numero_sesion', 'ent.id_ar_entrega', 'ent.fecha_entrega',
                'ent.ruta_archivo', 'ent.texto_evidencia', 'ent.estado'
            )
            ->orderBy('act.fecha_asignacion', 'desc')
            ->get();
    }

    private function obtenerRutasCasos($idPeriodo, $idCarrera, $esResponsablePedagogia, $idPersonal, $idsAreas, $idAreaPedagogia)
    {
        $query = DB::table('ar_caso_canalizaciones as cc')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cc.id_ar_caso')
            ->leftJoin('ar_areas_atencion as ao', 'ao.id_area_atencion', '=', 'cc.id_area_origen')
            ->leftJoin('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as canaliza', 'canaliza.id_personal', '=', 'cc.id_personal_canaliza')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->leftJoin('ar_caso_citas as cita', 'cita.id_ar_caso_canalizacion', '=', 'cc.id_ar_caso_canalizacion')
            ->where('ce.id_periodo', $idPeriodo);

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        if (!$esResponsablePedagogia) {
            $query->where(function ($q) use ($idPersonal, $idsAreas) {
                $q->where('cc.id_personal_responsable_destino', $idPersonal)
                    ->orWhereIn('cc.id_area_destino', $idsAreas);
            });
        }

        $registros = $query->select(
            'cc.id_ar_caso',
            'cc.id_ar_caso_canalizacion',
            'cc.fecha_canalizacion',
            'cc.estado',
            'cc.observaciones',
            DB::raw("COALESCE(ao.nombre, 'Sin área origen') as area_origen"),
            DB::raw("COALESCE(ad.nombre, 'Sin área destino') as area_destino"),
            DB::raw("COALESCE(canaliza.nombre, 'Sin responsable') as personal_canaliza"),
            DB::raw("COALESCE(resp.nombre, 'Sin responsable asignado') as responsable_destino"),
            DB::raw('COUNT(DISTINCT cita.id_ar_cita) as total_citas'),
            DB::raw('MAX(cita.fecha_cita) as ultima_cita')
        )
            ->groupBy('cc.id_ar_caso', 'cc.id_ar_caso_canalizacion', 'cc.fecha_canalizacion', 'cc.estado', 'cc.observaciones', 'ao.nombre', 'ad.nombre', 'canaliza.nombre', 'resp.nombre')
            ->orderBy('cc.id_ar_caso')
            ->orderBy('cc.fecha_canalizacion')
            ->get();

        $rutas = array();
        foreach ($registros as $r) {
            if (!isset($rutas[$r->id_ar_caso])) {
                $rutas[$r->id_ar_caso] = array();
            }
            $rutas[$r->id_ar_caso][] = $r;
        }
        return $rutas;
    }


    private function obtenerCitasPorCanalizacion($idPeriodo, $idCarrera, $esResponsablePedagogia, $idPersonal, $idsAreas)
    {
        $query = DB::table('ar_caso_citas as cita')
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'cita.id_ar_caso_canalizacion')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cita.id_ar_caso')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ce.id_alumno')
            ->leftJoin('gnral_carreras as car', 'car.id_carrera', '=', 'ce.id_carrera')
            ->leftJoin('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->leftJoin('ar_area_responsable_horarios as h', 'h.id_area_responsable_horario', '=', 'cita.id_area_responsable_horario')
            ->leftJoin(DB::raw('(
                SELECT 
                    act.id_ar_cita,
                    COUNT(DISTINCT act.id_ar_actividad) AS total_actividades,
                    COUNT(DISTINCT CASE WHEN ent.id_ar_entrega IS NOT NULL THEN act.id_ar_actividad ELSE NULL END) AS actividades_con_evidencia
                FROM ar_caso_actividades act
                LEFT JOIN ar_caso_actividad_entregas ent
                    ON ent.id_ar_actividad = act.id_ar_actividad
                   AND IFNULL(ent.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                WHERE IFNULL(act.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                GROUP BY act.id_ar_cita
            ) AS act_count'), 'act_count.id_ar_cita', '=', 'cita.id_ar_cita')
            ->leftJoin(DB::raw('(
                SELECT 
                    act.id_ar_caso_canalizacion,
                    COUNT(DISTINCT act.id_ar_actividad) AS total_actividades_global,
                    COUNT(DISTINCT CASE WHEN ent.id_ar_entrega IS NOT NULL THEN act.id_ar_actividad ELSE NULL END) AS actividades_con_evidencia_global
                FROM ar_caso_actividades act
                LEFT JOIN ar_caso_actividad_entregas ent
                    ON ent.id_ar_actividad = act.id_ar_actividad
                   AND IFNULL(ent.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                WHERE IFNULL(act.estado, \'\') NOT IN (\'cancelada\', \'cancelado\')
                GROUP BY act.id_ar_caso_canalizacion
            ) AS act_global'), 'act_global.id_ar_caso_canalizacion', '=', 'cc.id_ar_caso_canalizacion')
            ->where('ce.id_periodo', $idPeriodo);

        if ($idCarrera > 0) {
            $query->where('ce.id_carrera', $idCarrera);
        }

        if (!$esResponsablePedagogia) {
            if (empty($idsAreas)) {
                return array();
            }

            $query->whereIn('cc.id_area_destino', $idsAreas)
                ->where(function ($q) use ($idPersonal) {
                    $q->where('cc.id_personal_responsable_destino', $idPersonal)
                        ->orWhereNull('cc.id_personal_responsable_destino');
                });
        }

        $registros = $query->select(
            'cita.*',
            DB::raw('cita.estado as estado_cita'),
            'cc.id_area_destino',
            'cc.id_personal_responsable_destino',
            'ce.id_periodo',
            'ce.id_carrera',
            'a.cuenta',
            'a.id_alumno',
            'a.id_semestre',
            DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as alumno"),
            DB::raw("COALESCE(car.nombre, 'Sin carrera registrada') as carrera"),
            DB::raw("COALESCE(ad.nombre, 'Sin área destino') as area_destino"),
            DB::raw("COALESCE(resp.nombre, 'Sin responsable') as responsable_destino"),
            'h.dia_semana',
            'h.hora_inicio as horario_inicio',
            'h.hora_fin as horario_fin',
            DB::raw('COALESCE(act_count.total_actividades, 0) as total_actividades'),
            DB::raw('COALESCE(act_count.actividades_con_evidencia, 0) as actividades_con_evidencia'),
            DB::raw('COALESCE(act_global.total_actividades_global, 0) as total_actividades_global'),
            DB::raw('COALESCE(act_global.actividades_con_evidencia_global, 0) as actividades_con_evidencia_global')
        )
            ->orderBy('cita.fecha_cita', 'asc')
            ->orderBy('cita.numero_sesion', 'asc')
            ->get();

        $salida = array();
        foreach ($registros as $registro) {
            $key = (int) $registro->id_ar_caso_canalizacion;
            if (!isset($salida[$key])) {
                $salida[$key] = array();
            }
            $salida[$key][] = $registro;
        }

        return $salida;
    }

    private function obtenerCitaEditable($idCita, $idPeriodo, $idPersonal)
    {
        return DB::table('ar_caso_citas as cita')
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'cita.id_ar_caso_canalizacion')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cita.id_ar_caso')
            ->where('cita.id_ar_cita', $idCita)
            ->where('ce.id_periodo', $idPeriodo)
            ->where('cc.id_personal_responsable_destino', $idPersonal)
            ->select('cita.*', 'cc.id_area_destino', 'cc.id_area_responsable_periodo_destino', 'cc.id_personal_responsable_destino', 'ce.id_periodo')
            ->first();
    }

    private function obtenerActividadEditable($idActividad, $idPeriodo, $idPersonal)
    {
        return DB::table('ar_caso_actividades as act')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'act.id_ar_caso')
            ->where('act.id_ar_actividad', $idActividad)
            ->where('ce.id_periodo', $idPeriodo)
            ->where('act.id_personal_asigna', $idPersonal)
            ->select('act.*', 'ce.id_periodo')
            ->first();
    }

    private function obtenerEntregaEditable($idEntrega, $idPeriodo, $idPersonal)
    {
        return DB::table('ar_caso_actividad_entregas as ent')
            ->join('ar_caso_actividades as act', 'act.id_ar_actividad', '=', 'ent.id_ar_actividad')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'act.id_ar_caso')
            ->where('ent.id_ar_entrega', $idEntrega)
            ->where('ce.id_periodo', $idPeriodo)
            ->where('act.id_personal_asigna', $idPersonal)
            ->select('ent.*', 'act.id_ar_actividad')
            ->first();
    }

    private function contarOcupacionSlotExcepto($idHorario, $fecha, $idCitaExcluir)
    {
        return DB::table('ar_caso_citas')
            ->where('id_area_responsable_horario', $idHorario)
            ->whereRaw('DATE(fecha_cita) = ?', array($fecha))
            ->where('id_ar_cita', '<>', $idCitaExcluir)
            ->whereNotIn('estado', array('cancelada', 'cancelado'))
            ->count();
    }

    private function asegurarSesionPeriodosSistema($idPeriodo = 0)
    {
        $periodosSistema = DB::table('gnral_periodos')
            ->select('id_periodo', 'periodo', 'fecha_inicio', 'fecha_termino')
            ->orderBy('id_periodo', 'asc')
            ->get();

        if ($periodosSistema->isEmpty()) {
            return;
        }

        $idPeriodo = (int) $idPeriodo;

        if ($idPeriodo <= 0 && Session::has('periodo_actual')) {
            $idPeriodo = (int) Session::get('periodo_actual');
        }

        if ($idPeriodo <= 0) {
            $ultimo = DB::table('gnral_periodos')
                ->select('id_periodo', 'periodo', 'fecha_inicio', 'fecha_termino')
                ->orderBy('id_periodo', 'desc')
                ->first();

            if ($ultimo) {
                $idPeriodo = (int) $ultimo->id_periodo;
            }
        }

        $periodoActual = null;
        foreach ($periodosSistema as $periodoItem) {
            if ((int) $periodoItem->id_periodo === (int) $idPeriodo) {
                $periodoActual = $periodoItem;
                break;
            }
        }

        if (!$periodoActual) {
            $periodoActual = $periodosSistema->last();
            $idPeriodo = (int) $periodoActual->id_periodo;
        }

        $periodoAnterior = null;
        $periodoSiguiente = null;

        foreach ($periodosSistema as $periodoItem) {
            if ((int) $periodoItem->id_periodo < (int) $idPeriodo) {
                $periodoAnterior = $periodoItem;
            }

            if ((int) $periodoItem->id_periodo > (int) $idPeriodo && !$periodoSiguiente) {
                $periodoSiguiente = $periodoItem;
            }
        }

        if (!$periodoAnterior) {
            $periodoAnterior = $periodoActual;
        }

        if (!$periodoSiguiente) {
            $periodoSiguiente = $periodoActual;
        }

        Session::put('arre_periodos', $periodosSistema);
        Session::put('periodo_anterior', (int) $periodoAnterior->id_periodo);
        Session::put('periodo_actual', (int) $periodoActual->id_periodo);
        Session::put('periodo_siguiente', (int) $periodoSiguiente->id_periodo);
        Session::put('p1', $periodoAnterior);
        Session::put('p2', $periodoActual);
        Session::put('p3', $periodoSiguiente);
    }

}
