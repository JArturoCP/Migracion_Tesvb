<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PiaseEstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $alumno = $this->resolverAlumnoUsuario();

        if (!$alumno) {
            return view('piase.estudiante.index', array(
                'permitido' => false,
                'mensaje' => 'El usuario autenticado no está relacionado con un estudiante.',
                'alumno' => null,
                'periodos' => collect(),
                'periodoSeleccionado' => null,
                'casos' => collect(),
                'citas' => collect(),
                'actividades' => collect(),
                'ruta' => collect(),
                'tabActivo' => 'tab-actividades',
                'focusActivo' => '',
            ));
        }

        // Esta pantalla siempre consulta el periodo vigente según las fechas del sistema.
        // No permite seleccionar periodos históricos mediante parámetros URL.
        $periodoSeleccionado = $this->obtenerPeriodoVigente();
        $periodos = $periodoSeleccionado ? collect(array($periodoSeleccionado)) : collect();
        $idPeriodo = $periodoSeleccionado ? (int) $periodoSeleccionado->id_periodo : 0;

        // Sin periodo vigente, no consultar información de otro semestre.
        $casos = $idPeriodo ? $this->obtenerCasosAlumno($alumno->id_alumno, $idPeriodo) : collect();
        $citas = $idPeriodo ? $this->obtenerCitasAlumno($alumno->id_alumno, $idPeriodo) : collect();
        $actividades = $idPeriodo ? $this->obtenerActividadesAlumno($alumno->id_alumno, $idPeriodo) : collect();
        $ruta = $idPeriodo ? $this->obtenerRutaAlumno($alumno->id_alumno, $idPeriodo) : collect();

        return view('piase.estudiante.index', array(
            'permitido' => true,
            'mensaje' => $idPeriodo ? '' : 'No existe un periodo académico vigente para la fecha actual.',
            'alumno' => $alumno,
            'periodos' => $periodos,
            'periodoSeleccionado' => $periodoSeleccionado,
            'casos' => $casos,
            'citas' => $citas,
            'actividades' => $actividades,
            'ruta' => $ruta,
            'tabActivo' => $this->tabRetorno($request, 'tab-actividades'),
            'focusActivo' => trim((string) $request->get('focus', '')),
        ));
    }

    public function subirEvidencia(Request $request)
    {
        $alumno = $this->resolverAlumnoUsuario();

        if (!$alumno) {
            return redirect()->route('piase.estudiante.index')
                ->with('error', 'No se localizó el estudiante autenticado.');
        }

        $validator = Validator::make($request->all(), array(
            'id_ar_actividad' => 'required|integer',
            'texto_evidencia' => 'nullable|string',
            'evidencia' => 'nullable|file|max:10240',
            'id_periodo' => 'nullable|integer',
        ));

        if ($validator->fails()) {
            return redirect()->route('piase.estudiante.index', array(
                'id_periodo' => (int) $request->get('id_periodo'),
                'tab' => 'tab-actividades',
                'focus' => 'actividad-' . (int) $request->get('id_ar_actividad'),
            ))->withErrors($validator)->withInput();
        }

        if (!$request->hasFile('evidencia') && trim((string) $request->get('texto_evidencia', '')) == '') {
            return redirect()->route('piase.estudiante.index', array(
                'id_periodo' => (int) $request->get('id_periodo'),
                'tab' => 'tab-actividades',
                'focus' => 'actividad-' . (int) $request->get('id_ar_actividad'),
            ))->with('error', 'Debes adjuntar un archivo o escribir una descripción de la evidencia.');
        }

        $idActividad = (int) $request->get('id_ar_actividad');
        $actividad = $this->obtenerActividadPerteneceAlumno($idActividad, $alumno->id_alumno);

        if (!$actividad) {
            return redirect()->route('piase.estudiante.index')
                ->with('error', 'La actividad no pertenece al estudiante autenticado.');
        }

        $periodoVigente = $this->obtenerPeriodoVigente();
        if (!$periodoVigente || (int) $actividad->id_periodo !== (int) $periodoVigente->id_periodo) {
            return redirect()->route('piase.estudiante.index', array('tab' => 'tab-actividades'))
                ->with('error', 'Solo puedes enviar evidencias de actividades del periodo académico actual.');
        }

        if (in_array(strtolower(trim((string) $actividad->estado)), array('cancelada', 'cancelado'))) {
            return redirect()->route('piase.estudiante.index', array(
                'id_periodo' => (int) $request->get('id_periodo'),
                'tab' => 'tab-actividades',
                'focus' => 'actividad-' . $idActividad,
            ))->with('error', 'No se puede subir evidencia a una actividad cancelada.');
        }

        // La primera entrega deja la actividad en solo lectura, aun si se intenta
        // enviar otro POST directamente, sin utilizar el formulario.
        $entregaExistente = DB::table('ar_caso_actividad_entregas')
            ->where('id_ar_actividad', $idActividad)
            ->first();
        $revisionExistente = DB::table('ar_caso_actividad_revisiones as rev')
            ->join('ar_caso_actividad_entregas as ent', 'ent.id_ar_entrega', '=', 'rev.id_ar_entrega')
            ->where('ent.id_ar_actividad', $idActividad)
            ->first();

        if ($entregaExistente || $revisionExistente) {
            return redirect()->route('piase.estudiante.index', array(
                'tab' => 'tab-actividades',
                'focus' => 'actividad-' . $idActividad,
            ))->with('error', $revisionExistente
                ? 'Actividad calificada. No se permiten nuevas evidencias.'
                : 'Evidencia enviada anteriormente. No se permiten nuevas entregas.');
        }

        $rutaArchivo = null;

        if ($request->hasFile('evidencia')) {
            $file = $request->file('evidencia');
            $extension = strtolower($file->getClientOriginalExtension());
            $nombreArchivo = 'piase_' . $alumno->id_alumno . '_' . $idActividad . '_' . time() . '.' . $extension;
            $carpeta = public_path('piase/evidencias');

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0775, true);
            }

            $file->move($carpeta, $nombreArchivo);
            $rutaArchivo = 'piase/evidencias/' . $nombreArchivo;
        }

        $datosEntrega = array(
            'id_ar_caso' => $actividad->id_ar_caso,
            'id_ar_caso_canalizacion' => $actividad->id_ar_caso_canalizacion,
            'id_ar_cita' => $actividad->id_ar_cita,
            'id_ar_actividad' => $idActividad,
            'fecha_entrega' => date('Y-m-d H:i:s'),
            'texto_evidencia' => trim((string) $request->get('texto_evidencia', '')),
            'estado' => 'entregada',
            'id_alumno_entrega' => $alumno->id_alumno,
            'id_usuario_entrega' => Auth::id(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        if ($rutaArchivo) {
            $datosEntrega['ruta_archivo'] = $rutaArchivo;
        }

        DB::table('ar_caso_actividad_entregas')->insert($datosEntrega);

        DB::table('ar_caso_actividades')
            ->where('id_ar_actividad', $idActividad)
            ->update(array(
                'estado' => 'evidencia_entregada',
                'updated_at' => date('Y-m-d H:i:s'),
            ));

        return redirect()->route('piase.estudiante.index', array(
            'id_periodo' => (int) $request->get('id_periodo'),
            'tab' => 'tab-actividades',
            'focus' => 'actividad-' . $idActividad,
        ))->with('success', 'Evidencia enviada correctamente.');
    }

    private function obtenerPeriodoVigente()
    {
        $hoy = date('Y-m-d');

        return DB::table('gnral_periodos')
            ->select('id_periodo', 'periodo', 'fecha_inicio', 'fecha_termino')
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_termino', '>=', $hoy)
            ->orderBy('fecha_inicio', 'desc')
            ->first();
    }

    private function resolverAlumnoUsuario()
    {
        if (Auth::guest()) {
            return null;
        }

        $idUsuario = Auth::id();

        return DB::table('gnral_alumnos as a')
            ->leftJoin('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
            ->select(
                'a.id_alumno',
                'a.id_usuario',
                'a.cuenta',
                'a.nombre',
                'a.apaterno',
                'a.amaterno',
                'a.id_carrera',
                'a.id_semestre',
                'a.grupo',
                'c.nombre as carrera'
            )
            ->where('a.id_usuario', $idUsuario)
            ->first();
    }

    private function obtenerPeriodosAlumno($idAlumno)
    {
        return DB::table('ar_casos_estudiantes as ce')
            ->join('gnral_periodos as p', 'p.id_periodo', '=', 'ce.id_periodo')
            ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
            ->where('ce.id_alumno', $idAlumno)
            ->select('p.id_periodo', 'p.periodo', 'p.fecha_inicio', 'p.fecha_termino')
            ->distinct()
            ->orderBy('p.id_periodo', 'desc')
            ->get();
    }

    private function obtenerCasosAlumno($idAlumno, $idPeriodo)
    {
        return DB::table('ar_casos_estudiantes as ce')
            ->leftJoin('gnral_carreras as c', 'c.id_carrera', '=', 'ce.id_carrera')
            ->where('ce.id_alumno', $idAlumno)
            ->where('ce.id_periodo', $idPeriodo)
            ->select('ce.*', 'c.nombre as carrera')
            ->orderBy('ce.fecha_apertura', 'desc')
            ->get();
    }

    private function obtenerCitasAlumno($idAlumno, $idPeriodo)
    {
        return DB::table('ar_caso_citas as cita')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cita.id_ar_caso')
            ->leftJoin('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'cita.id_ar_caso_canalizacion')
            ->leftJoin('ar_areas_atencion as area', 'area.id_area_atencion', '=', 'cita.id_area_atencion')
            ->leftJoin('gnral_personales as resp', 'resp.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->where('ce.id_alumno', $idAlumno)
            ->where('ce.id_periodo', $idPeriodo)
            ->select(
                'cita.*',
                'cc.id_area_destino',
                'cc.estado as estado_canalizacion',
                'area.nombre as area_atencion',
                'resp.nombre as responsable'
            )
            ->orderBy('cita.fecha_cita', 'asc')
            ->orderBy('cita.hora_inicio_cita', 'asc')
            ->get();
    }

    private function obtenerActividadesAlumno($idAlumno, $idPeriodo)
    {
        $entregaSub = "(
            SELECT e1.*
            FROM ar_caso_actividad_entregas e1
            INNER JOIN (
                SELECT id_ar_actividad, MAX(id_ar_entrega) AS id_ultima_entrega
                FROM ar_caso_actividad_entregas
                GROUP BY id_ar_actividad
            ) e2 ON e2.id_ultima_entrega = e1.id_ar_entrega
        ) AS ent";

        $revisionSub = "(
            SELECT r1.*
            FROM ar_caso_actividad_revisiones r1
            INNER JOIN (
                SELECT id_ar_entrega, MAX(id_ar_revision) AS id_ultima_revision
                FROM ar_caso_actividad_revisiones
                GROUP BY id_ar_entrega
            ) r2 ON r2.id_ultima_revision = r1.id_ar_revision
        ) AS rev";

        return DB::table('ar_caso_actividades as act')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'act.id_ar_caso')
            ->leftJoin('ar_caso_citas as cita', 'cita.id_ar_cita', '=', 'act.id_ar_cita')
            ->leftJoin('ar_caso_canalizaciones as cc', 'cc.id_ar_caso_canalizacion', '=', 'act.id_ar_caso_canalizacion')
            ->leftJoin('ar_areas_atencion as area', 'area.id_area_atencion', '=', 'act.id_area_atencion')
            ->leftJoin('ar_actividad_catalogo as catalogo', 'catalogo.id_actividad_catalogo', '=', 'act.id_actividad_catalogo')
            ->leftJoin('ar_actividad_categorias as categoria', 'categoria.id_categoria_actividad', '=', 'act.id_categoria_actividad')
            ->leftJoin('gnral_personales as asigna', 'asigna.id_personal', '=', 'act.id_personal_asigna')
            ->leftJoin(DB::raw($entregaSub), 'ent.id_ar_actividad', '=', 'act.id_ar_actividad')
            ->leftJoin(DB::raw($revisionSub), 'rev.id_ar_entrega', '=', 'ent.id_ar_entrega')
            ->where('ce.id_alumno', $idAlumno)
            ->where('ce.id_periodo', $idPeriodo)
            ->whereNotIn(DB::raw("IFNULL(act.estado, '')"), array('cancelada', 'cancelado'))
            ->where(function ($q) {
                $q->whereNull('cita.id_ar_cita')
                    ->orWhereNotIn(DB::raw("IFNULL(cita.estado, '')"), array('cancelada', 'cancelado'));
            })
            ->select(
                'act.*',
                'catalogo.nombre as actividad_catalogo',
                'categoria.nombre as categoria_actividad',
                'area.nombre as area_atencion',
                'asigna.nombre as responsable_asigna',
                'cita.fecha_cita',
                'cita.hora_inicio_cita',
                'cita.hora_fin_cita',
                'cita.numero_sesion',
                'cita.estado as estado_cita',
                'ent.id_ar_entrega',
                'ent.fecha_entrega',
                'ent.ruta_archivo',
                'ent.texto_evidencia',
                'ent.estado as estado_entrega',
                'rev.id_ar_revision',
                'rev.fecha_revision',
                'rev.validada',
                'rev.calificacion_estrellas',
                'rev.estado_revision',
                'rev.comentarios',
                'rev.recomendaciones'
            )
            ->orderBy('cita.fecha_cita', 'asc')
            ->orderBy('cita.hora_inicio_cita', 'asc')
            ->orderBy('act.fecha_asignacion', 'asc')
            ->get();
    }

    private function obtenerRutaAlumno($idAlumno, $idPeriodo)
    {
        return DB::table('ar_caso_canalizaciones as cc')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'cc.id_ar_caso')
            ->leftJoin('ar_areas_atencion as ad', 'ad.id_area_atencion', '=', 'cc.id_area_destino')
            ->leftJoin('gnral_personales as pr', 'pr.id_personal', '=', 'cc.id_personal_responsable_destino')
            ->where('ce.id_alumno', $idAlumno)
            ->where('ce.id_periodo', $idPeriodo)
            ->select(
                'cc.id_ar_caso_canalizacion',
                'cc.fecha_canalizacion',
                'cc.estado',
                'ad.nombre as area_destino',
                'pr.nombre as responsable_destino'
            )
            ->orderBy('cc.fecha_canalizacion', 'asc')
            ->get();
    }

    private function obtenerActividadPerteneceAlumno($idActividad, $idAlumno)
    {
        return DB::table('ar_caso_actividades as act')
            ->join('ar_casos_estudiantes as ce', 'ce.id_ar_caso', '=', 'act.id_ar_caso')
            ->where('act.id_ar_actividad', $idActividad)
            ->where('ce.id_alumno', $idAlumno)
            ->select('act.*', 'ce.id_periodo')
            ->first();
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

    private function tabRetorno(Request $request, $default)
    {
        $tab = trim((string) $request->get('tab', ''));
        return $tab != '' ? $tab : $default;
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
