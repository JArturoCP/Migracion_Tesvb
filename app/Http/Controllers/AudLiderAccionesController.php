<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Gnral_Personales;
use App\AudLiderAcciones;
use App\AudResponsableAcciones;
use App\AudPlanAccion;

class AudLiderAccionesController extends Controller
{
    public function index()
    {
        //
    }

    public function verAcciones()
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        $esLiderActivo = $liderActivo !== null;

        $controlAccionesCorrectivas = $this->obtenerControlAccionesCorrectivas();
        $moduloAccionesCerrado = $controlAccionesCorrectivas ? ((int) $controlAccionesCorrectivas->cerrado === 1) : false;
        $mensajeCierreAcciones = $controlAccionesCorrectivas && !empty($controlAccionesCorrectivas->mensaje_cierre)
            ? $controlAccionesCorrectivas->mensaje_cierre
            : 'El sistema fue cerrado. Contacte al líder.';

        $acciones = $esLiderActivo
            ? AudResponsableAcciones::whereIn('estado', [3, 6, 7])
                ->with('personal')
                ->get()
            : collect();

        $accionesAgrupadas = collect();
        $asignadasSinAtender = collect();
        $ncSinAtender = collect();
        $omSinAtender = collect();
        $sinAtenderAgrupadas = collect();

        if ($esLiderActivo) {

            /*
             * 1. NC / OM que ya están en seguimiento:
             * estado 3 = enviada al líder
             * estado 6 = validada por líder
             * estado 7 = regresada por líder
             */
            $accionesLider = DB::table('audresponsable_acciones as acc')
                ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
                ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
                ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
                ->leftJoin('aud_auditoria as auditoria', 'auditoria.id_auditoria', '=', 'agenda.id_auditoria')
                ->leftJoin('gnral_personales as personal', 'personal.id_personal', '=', 'acc.id_personal')
                ->whereNull('acc.deleted_at')
                ->whereIn('acc.estado', [3, 6, 7])
                ->whereIn('nota.id_clasificacion', [1, 2])
                ->select(
                    'acc.id_responsable',
                    'acc.id_personal',
                    'acc.estado',
                    'acc.requiere_accion',
                    'acc.requiere_correccion',
                    'acc.analisis',
                    'acc.accion_correctiva',
                    'acc.causa_raiz',
                    'acc.actualizacion_riesgos',
                    'acc.valor_actr',
                    'acc.cambios_sistema',
                    'acc.valor_cambios',
                    'acc.observaciones_lider',
                    'acc.folio_requisicion',
                    'acc.fecha_requisicion',
                    'acc.estado_cierre',
                    'acc.cerrado_at',
                    'personal.nombre as responsable_nombre',

                    'nota.id_notas',
                    'nota.clave_nota',
                    'nota.punto_proceso',
                    'nota.resultado as reporte_auditor',
                    'nota.observaciones as observaciones_auditor',
                    'nota.id_clasificacion',

                    'reporte.id_reporte',

                    'agenda.id_agenda',
                    'agenda.id_auditoria',
                    'agenda.fecha as fecha_auditoria',

                    'auditoria.criterio as criterio_auditoria'
                )
                ->orderBy('agenda.fecha', 'desc')
                ->orderBy('agenda.id_auditoria', 'desc')
                ->orderBy('nota.id_clasificacion', 'asc')
                ->orderBy('nota.id_notas', 'asc')
                ->get()
                ->map(function ($accion) {
                    $claveNota = $accion->clave_nota ?: '';
                    $partesClave = explode('-', $claveNota);

                    $accion->numero_auditoria = count($partesClave) >= 2
                        ? $partesClave[0] . '-' . $partesClave[1]
                        : 'Auditoría ' . ($accion->id_auditoria ?: 'sin número');

                    $accion->categoria = (int) $accion->id_clasificacion === 1 ? 'NC' : 'OM';

                    if (isset($accion->estado_cierre) && (int) $accion->estado_cierre === 3) {
                        $accion->situacion = $accion->categoria . ' cerrada';
                    } elseif ((int) $accion->estado === 3) {
                        $accion->situacion = 'Enviada al líder';
                    } elseif ((int) $accion->estado === 6) {
                        $accion->situacion = 'Validada por líder';
                    } elseif ((int) $accion->estado === 7) {
                        $accion->situacion = 'Regresada por líder';
                    } else {
                        $accion->situacion = 'En seguimiento';
                    }

                    return $accion;
                });

            $accionesAgrupadas = $accionesLider
                ->groupBy('numero_auditoria')
                ->map(function ($items) {
                    return [
                        'NC' => $items->where('categoria', 'NC')->values(),
                        'OM' => $items->where('categoria', 'OM')->values(),
                    ];
                });

            /*
             * 2. NC / OM asignadas pero sin atender.
             *
             * Nota:
             * No usamos orWhereNotExists porque en Laravel 5.6 puede provocar:
             * compact(): Undefined variable: operator.
             *
             * Por eso primero traemos las asignadas y luego filtramos en Collection.
             */
            $asignadasBase = DB::table('audresponsable_acciones as acc')
                ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
                ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
                ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
                ->leftJoin('aud_auditoria as auditoria', 'auditoria.id_auditoria', '=', 'agenda.id_auditoria')
                ->leftJoin('gnral_personales as personal', 'personal.id_personal', '=', 'acc.id_personal')
                ->whereNull('acc.deleted_at')
                ->whereNotNull('acc.id_personal')
                ->whereIn('nota.id_clasificacion', [1, 2])
                ->select(
                    'acc.id_responsable',
                    'acc.id_personal',
                    'acc.estado',
                    'acc.estado_cierre',
                    'personal.nombre as responsable_nombre',

                    'nota.id_notas',
                    'nota.clave_nota',
                    'nota.punto_proceso',
                    'nota.resultado as reporte_auditor',
                    'nota.observaciones as observaciones_auditor',
                    'nota.id_clasificacion',

                    'reporte.id_reporte',

                    'agenda.id_agenda',
                    'agenda.id_auditoria',
                    'agenda.fecha as fecha_auditoria',

                    'auditoria.criterio as criterio_auditoria',

                    DB::raw('(
                    SELECT COUNT(*)
                    FROM aud_plan_acciones AS plan_count
                    WHERE plan_count.id_responsable = acc.id_responsable
                    AND plan_count.deleted_at IS NULL
                ) AS total_acciones_plan')
                )
                ->orderBy('agenda.fecha', 'desc')
                ->orderBy('agenda.id_auditoria', 'desc')
                ->orderBy('nota.id_clasificacion', 'asc')
                ->orderBy('nota.id_notas', 'asc')
                ->get()
                ->map(function ($accion) {
                    $claveNota = $accion->clave_nota ?: '';
                    $partesClave = explode('-', $claveNota);

                    $accion->numero_auditoria = count($partesClave) >= 2
                        ? $partesClave[0] . '-' . $partesClave[1]
                        : 'Auditoría ' . ($accion->id_auditoria ?: 'sin número');

                    $accion->categoria = (int) $accion->id_clasificacion === 1 ? 'NC' : 'OM';
                    $accion->total_acciones_plan = (int) $accion->total_acciones_plan;

                    if ($accion->total_acciones_plan === 0) {
                        $accion->situacion = 'Asignada sin plan registrado';
                    } elseif (is_null($accion->estado)) {
                        $accion->situacion = 'Asignada sin iniciar atención';
                    } elseif (!in_array((int) $accion->estado, [3, 6, 7])) {
                        $accion->situacion = 'En captura por responsable';
                    } else {
                        $accion->situacion = 'Requiere seguimiento';
                    }

                    return $accion;
                });

            $asignadasSinAtender = $asignadasBase
                ->filter(function ($accion) {
                    if (isset($accion->estado_cierre) && (int) $accion->estado_cierre === 3) {
                        return false;
                    }

                    if ($accion->total_acciones_plan === 0) {
                        return true;
                    }

                    if (is_null($accion->estado)) {
                        return true;
                    }

                    if (!in_array((int) $accion->estado, [3, 6, 7])) {
                        return true;
                    }

                    return false;
                })
                ->values();

            $ncSinAtender = $asignadasSinAtender
                ->where('categoria', 'NC')
                ->values();

            $omSinAtender = $asignadasSinAtender
                ->where('categoria', 'OM')
                ->values();

            $sinAtenderAgrupadas = $asignadasSinAtender
                ->groupBy('numero_auditoria')
                ->map(function ($items) {
                    return [
                        'NC' => $items->where('categoria', 'NC')->values(),
                        'OM' => $items->where('categoria', 'OM')->values(),
                    ];
                });
        }

        return view('auditorias.lider_acciones', compact(
            'acciones',
            'accionesAgrupadas',
            'asignadasSinAtender',
            'ncSinAtender',
            'omSinAtender',
            'sinAtenderAgrupadas',
            'esLiderActivo',
            'moduloAccionesCerrado',
            'mensajeCierreAcciones'
        ));
    }

    public function create()
    {
        $personales = Gnral_Personales::orderBy('nombre')->get();
        $lideres = AudLiderAcciones::with('personal')->whereNull('deleted_at')->get();
        $lideresAsignadosIds = $lideres->pluck('id_personal')->toArray();

        return view('auditorias.asignar_lider', compact('personales', 'lideres', 'lideresAsignadosIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_personal' => 'required',
        ]);

        AudLiderAcciones::create([
            'id_personal' => $request->id_personal,
        ]);

        return redirect()
            ->route('auditorias.asignar_lider')
            ->with('success', 'Líder asignado correctamente.');
    }

    public function reporteNc($id_responsable)
    {
        $id_personal = Session::get("id_perso");
        $modoConsulta = request()->get('modo_consulta') == 1;
        $urlRegresar = $this->obtenerUrlRegresarReporte();

        $accion = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->leftJoin('aud_auditoria as auditoria', 'auditoria.id_auditoria', '=', 'agenda.id_auditoria')
            ->leftJoin('gnral_personales as responsable', 'responsable.id_personal', '=', 'acc.id_personal')
            ->where('acc.id_responsable', $id_responsable)
            ->select(
                'acc.id_responsable',
                'acc.id_personal',
                'acc.estado',
                'acc.requiere_accion',
                'acc.requiere_correccion',
                'acc.analisis',
                'acc.accion_correctiva',
                'acc.causa_raiz',
                'acc.actualizacion_riesgos',
                'acc.valor_actr',
                'acc.cambios_sistema',
                'acc.valor_cambios',
                'acc.observaciones_lider',
                'acc.folio_requisicion',
                'acc.fecha_requisicion',
                'acc.estado_cierre',
                'acc.cerrado_por',
                'acc.cerrado_at',
                'acc.observaciones_cierre',

                'nota.id_notas',
                'nota.clave_nota',
                'nota.punto_proceso',
                'nota.resultado',
                'nota.observaciones',
                'nota.id_clasificacion',

                'reporte.id_reporte',

                'agenda.id_agenda',
                'agenda.id_auditoria',
                'agenda.fecha as fecha_registro',

                'auditoria.criterio as criterio_auditoria',

                'responsable.nombre as responsable_tratamiento'
            )
            ->first();

        if (!$accion) {
            abort(404, 'No se encontró la no conformidad solicitada.');
        }

        if ((int) $accion->id_clasificacion !== 1) {
            if ($modoConsulta) {
                return redirect($urlRegresar)
                    ->with('warning', 'El formato F28-PSGOE-05 aplica únicamente para No Conformidades.');
            }

            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('warning', 'El formato F28-PSGOE-05 aplica únicamente para No Conformidades.');
        }

        if ($modoConsulta && !$this->usuarioPuedeConsultarReporteSeguimiento($id_responsable, $id_personal)) {
            return redirect($urlRegresar)
                ->with('error', 'No tienes permisos para consultar este reporte.');
        }

        if (!$modoConsulta && (int) $accion->estado !== 6) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('warning', 'El reporte F28-PSGOE-05 solo se genera cuando la No Conformidad ya fue validada por el líder.');
        }

        $planes = DB::table('aud_plan_acciones as plan')
            ->leftJoin('gnral_personales as implanta', 'implanta.id_personal', '=', 'plan.id_responsable_implantar')
            ->leftJoin('gnral_personales as revisa', 'revisa.id_personal', '=', 'plan.id_responsable_revisar')
            ->leftJoin('aud_evidencias as evidencia', 'evidencia.id_evidencia', '=', 'plan.id_evidencia')
            ->where('plan.id_responsable', $id_responsable)
            ->whereNull('plan.deleted_at')
            ->select(
                'plan.id_plan_acciones',
                'plan.id_responsable',
                'plan.acciones',
                'plan.tipo',
                'plan.estado',
                'plan.path_evidencia',
                'plan.fecha_planeada',
                'plan.observaciones',
                'plan.fecha_implantar_accion',
                'plan.fecha_verificacion',
                'implanta.nombre as responsable_implantar',
                'revisa.nombre as responsable_revisar',
                'evidencia.descripcion as evidencia'
            )
            ->orderBy('plan.tipo')
            ->orderBy('plan.id_plan_acciones')
            ->get();
        $planesConEvidenciaAutorizada = $planes->filter(function ($plan) {
            return !empty($plan->path_evidencia) && (int) $plan->estado === 1;
        })->values();

        $evidenciasAcciones = $planesConEvidenciaAutorizada->filter(function ($plan) {
            return (int) $plan->tipo === 1;
        })->values();

        $evidenciasCorrecciones = $planesConEvidenciaAutorizada->filter(function ($plan) {
            return (int) $plan->tipo === 2;
        })->values();

        /*
         * En el sistema actual no hay una evidencia separada cargada por el revisor.
         * Por eso aquí se consideran como evidencias revisadas las acciones que ya tienen PDF
         * y estado autorizado.
         */
        $evidenciasRevision = $planesConEvidenciaAutorizada;
        $accionesCorrectivas = $planes->where('tipo', 1)->values();
        $correcciones = $planes->where('tipo', 2)->values();

        $tratamientos = collect();

        if (!empty($accion->causa_raiz)) {
            $tratamientos->push('Corrección: ' . $accion->causa_raiz);
        }

        if (!empty($accion->accion_correctiva)) {
            $tratamientos->push('Acción correctiva: ' . $accion->accion_correctiva);
        }

        foreach ($correcciones as $correccion) {
            $tratamientos->push('Corrección programada: ' . $correccion->acciones);
        }

        foreach ($accionesCorrectivas as $plan) {
            $tratamientos->push('Acción correctiva programada: ' . $plan->acciones);
        }

        $fechasEjecucion = $planes
            ->pluck('fecha_implantar_accion')
            ->filter()
            ->unique()
            ->values()
            ->implode(', ');

        $fechasVerificacion = $planes
            ->pluck('fecha_verificacion')
            ->filter()
            ->unique()
            ->values()
            ->implode(', ');

        $liderActivo = AudLiderAcciones::with('personal')
            ->whereNull('deleted_at')
            ->first();

        $formatoNc = [
            'no_p' => $accion->clave_nota,
            'folio_requisicion' => $accion->folio_requisicion,
            'fecha_registro' => $accion->fecha_requisicion ?: $accion->fecha_registro,
            'descripcion_senc' => $accion->resultado,
            'tratamiento_salida_no_conforme' => $tratamientos->implode("\n"),
            'responsable_tratamiento' => $accion->responsable_tratamiento,
            'fecha_ejecucion' => $fechasEjecucion,
            'firma_autorizacion_tratamiento' => '',
            'fecha_verificacion_tratamiento' => $fechasVerificacion,
            'no_ocurrencia_senc' => '',
            'requiere_accion_correctiva' => $accion->requiere_accion == 1 ? 'Sí' : 'No',
            'elaboro' => '',
            'valida' => $liderActivo && $liderActivo->personal ? $liderActivo->personal->nombre : '',
        ];

        return view('auditorias.reporte_nc_f16', compact(
            'formatoNc',
            'accion',
            'accionesCorrectivas',
            'correcciones',
            'planes',
            'evidenciasAcciones',
            'evidenciasRevision',
            'evidenciasCorrecciones',
            'modoConsulta',
            'urlRegresar'
        ));
    }

    public function actualizarFolioF28(Request $request, $id_responsable)
    {
        $folio = trim($request->input('folio_requisicion', ''));

        if ($folio === '') {
            return response()->json([
                'ok' => false,
                'message' => 'Debe ingresar el Folio de Requisición.'
            ], 422);
        }

        if (strlen($folio) > 100) {
            return response()->json([
                'ok' => false,
                'message' => 'El Folio de Requisición no debe exceder 100 caracteres.'
            ], 422);
        }

        $id_personal = Session::get("id_perso");
        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return response()->json([
                'ok' => false,
                'message' => 'No tienes permisos para actualizar el Folio de Requisición.'
            ], 403);
        }

        $accion = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->where('acc.id_responsable', $id_responsable)
            ->select(
                'acc.id_responsable',
                'acc.estado',
                'acc.fecha_requisicion',
                'nota.id_clasificacion'
            )
            ->first();

        if (!$accion) {
            return response()->json([
                'ok' => false,
                'message' => 'No se encontró el reporte solicitado.'
            ], 404);
        }

        if ((int) $accion->id_clasificacion !== 1) {
            return response()->json([
                'ok' => false,
                'message' => 'El formato F28-PSGOE-05 aplica únicamente para No Conformidades.'
            ], 422);
        }

        if ((int) $accion->estado !== 6) {
            return response()->json([
                'ok' => false,
                'message' => 'El folio solo puede guardarse cuando la No Conformidad ya fue validada por el líder.'
            ], 422);
        }

        $fechaRequisicion = $accion->fecha_requisicion ?: date('Y-m-d');

        DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->update([
                'folio_requisicion' => $folio,
                'fecha_requisicion' => $fechaRequisicion,
            ]);

        $accionActualizada = DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->select('id_responsable', 'folio_requisicion', 'fecha_requisicion')
            ->first();

        return response()->json([
            'ok' => true,
            'message' => 'Folio de Requisición guardado correctamente.',
            'id_responsable' => $accionActualizada->id_responsable,
            'folio_requisicion' => $accionActualizada->folio_requisicion,
            'fecha_requisicion' => $accionActualizada->fecha_requisicion,
        ]);
    }
    public function cerrarReporteF28(Request $request, $id_responsable)
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No tienes permisos para cerrar esta No Conformidad.');
        }

        $accion = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->where('acc.id_responsable', $id_responsable)
            ->select(
                'acc.id_responsable',
                'acc.estado',
                'acc.estado_cierre',
                'acc.folio_requisicion',
                'nota.id_clasificacion'
            )
            ->first();

        if (!$accion) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No se encontró la No Conformidad.');
        }

        if ((int) $accion->id_clasificacion !== 1) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'Solo se pueden cerrar No Conformidades.');
        }

        if ((int) $accion->estado !== 6) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'La No Conformidad debe estar validada por el líder antes de cerrarse.');
        }

        if (empty($accion->folio_requisicion)) {
            return back()->with('error', 'Debes capturar y guardar el Folio de Requisición antes de cerrar la NC.');
        }

        if ((int) $accion->estado_cierre === 3) {
            return back()->with('success', 'La No Conformidad ya se encuentra cerrada.');
        }

        $planes = DB::table('aud_plan_acciones')
            ->where('id_responsable', $id_responsable)
            ->whereNull('deleted_at')
            ->get();

        if ($planes->isEmpty()) {
            return back()->with('error', 'No se puede cerrar la NC porque no tiene plan de acciones registrado.');
        }

        $planesSinEvidenciaAutorizada = $planes->filter(function ($plan) {
            return empty($plan->path_evidencia) || (int) $plan->estado !== 1;
        });

        if ($planesSinEvidenciaAutorizada->count() > 0) {
            return back()->with('error', 'No se puede cerrar la NC. Todas las acciones/correcciones deben tener evidencia PDF autorizada.');
        }

        DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->update([
                'estado_cierre' => 3,
                'cerrado_por' => $id_personal,
                'cerrado_at' => date('Y-m-d H:i:s'),
                'observaciones_cierre' => 'NC cerrada por líder después de validar evidencias autorizadas.',
            ]);

        return redirect()
            ->route('auditorias.lider_acciones.reporte_nc', $id_responsable)
            ->with('success', 'No Conformidad cerrada correctamente.');
    }


    public function reporteOm($id_responsable)
    {
        $id_personal = Session::get("id_perso");
        $modoConsulta = request()->get('modo_consulta') == 1;
        $urlRegresar = $this->obtenerUrlRegresarReporte();

        $accion = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->leftJoin('aud_auditoria as auditoria', 'auditoria.id_auditoria', '=', 'agenda.id_auditoria')
            ->leftJoin('gnral_personales as responsable', 'responsable.id_personal', '=', 'acc.id_personal')
            ->where('acc.id_responsable', $id_responsable)
            ->select(
                'acc.id_responsable',
                'acc.id_personal',
                'acc.estado',
                'acc.requiere_accion',
                'acc.requiere_correccion',
                'acc.analisis',
                'acc.accion_correctiva',
                'acc.causa_raiz',
                'acc.actualizacion_riesgos',
                'acc.valor_actr',
                'acc.cambios_sistema',
                'acc.valor_cambios',
                'acc.observaciones_lider',
                'acc.estado_cierre',
                'acc.cerrado_por',
                'acc.cerrado_at',
                'acc.observaciones_cierre',

                'nota.id_notas',
                'nota.clave_nota',
                'nota.punto_proceso',
                'nota.resultado',
                'nota.observaciones',
                'nota.id_clasificacion',

                'reporte.id_reporte',

                'agenda.id_agenda',
                'agenda.id_auditoria',
                'agenda.fecha as fecha_registro',

                'auditoria.criterio as criterio_auditoria',

                'responsable.nombre as responsable_tratamiento'
            )
            ->first();

        if (!$accion) {
            abort(404, 'No se encontró la oportunidad de mejora solicitada.');
        }

        if ((int) $accion->id_clasificacion !== 2) {
            if ($modoConsulta) {
                return redirect($urlRegresar)
                    ->with('warning', 'Este reporte aplica únicamente para Oportunidades de Mejora.');
            }

            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('warning', 'Este reporte aplica únicamente para Oportunidades de Mejora.');
        }

        if ($modoConsulta && !$this->usuarioPuedeConsultarReporteSeguimiento($id_responsable, $id_personal)) {
            return redirect($urlRegresar)
                ->with('error', 'No tienes permisos para consultar este reporte.');
        }

        if (!$modoConsulta && (int) $accion->estado !== 6) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('warning', 'El reporte de OM solo se genera cuando la Oportunidad de Mejora ya fue validada por el líder.');
        }

        $planes = DB::table('aud_plan_acciones as plan')
            ->leftJoin('gnral_personales as implanta', 'implanta.id_personal', '=', 'plan.id_responsable_implantar')
            ->leftJoin('gnral_personales as revisa', 'revisa.id_personal', '=', 'plan.id_responsable_revisar')
            ->leftJoin('aud_evidencias as evidencia', 'evidencia.id_evidencia', '=', 'plan.id_evidencia')
            ->where('plan.id_responsable', $id_responsable)
            ->where('plan.tipo', 3)
            ->whereNull('plan.deleted_at')
            ->select(
                'plan.id_plan_acciones',
                'plan.id_responsable',
                'plan.acciones',
                'plan.tipo',
                'plan.estado',
                'plan.path_evidencia',
                'plan.fecha_planeada',
                'plan.observaciones',
                'plan.fecha_implantar_accion',
                'plan.fecha_verificacion',
                'implanta.nombre as responsable_implantar',
                'revisa.nombre as responsable_revisar',
                'evidencia.descripcion as evidencia'
            )
            ->orderBy('plan.id_plan_acciones')
            ->get();

        $planesConEvidenciaAutorizada = $planes->filter(function ($plan) {
            return !empty($plan->path_evidencia) && (int) $plan->estado === 1;
        })->values();

        $planesPendientes = $planes->filter(function ($plan) {
            return empty($plan->path_evidencia) || (int) $plan->estado !== 1;
        })->values();

        return view('auditorias.reporte_om', compact(
            'accion',
            'planes',
            'planesConEvidenciaAutorizada',
            'planesPendientes',
            'modoConsulta',
            'urlRegresar'
        ));
    }

    public function cerrarReporteOm(Request $request, $id_responsable)
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No tienes permisos para cerrar esta Oportunidad de Mejora.');
        }

        $accion = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->where('acc.id_responsable', $id_responsable)
            ->select(
                'acc.id_responsable',
                'acc.estado',
                'acc.estado_cierre',
                'nota.id_clasificacion'
            )
            ->first();

        if (!$accion) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No se encontró la Oportunidad de Mejora.');
        }

        if ((int) $accion->id_clasificacion !== 2) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'Solo se pueden cerrar Oportunidades de Mejora desde este reporte.');
        }

        if ((int) $accion->estado !== 6) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'La Oportunidad de Mejora debe estar validada por el líder antes de cerrarse.');
        }

        if ((int) $accion->estado_cierre === 3) {
            return back()->with('success', 'La Oportunidad de Mejora ya se encuentra cerrada.');
        }

        $planes = DB::table('aud_plan_acciones')
            ->where('id_responsable', $id_responsable)
            ->where('tipo', 3)
            ->whereNull('deleted_at')
            ->get();

        if ($planes->isEmpty()) {
            return back()->with('error', 'No se puede cerrar la OM porque no tiene acciones registradas.');
        }

        $planesSinEvidenciaAutorizada = $planes->filter(function ($plan) {
            return empty($plan->path_evidencia) || (int) $plan->estado !== 1;
        });

        if ($planesSinEvidenciaAutorizada->count() > 0) {
            return back()->with('error', 'No se puede cerrar la OM. Todas las acciones deben tener evidencia PDF autorizada.');
        }

        DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->update([
                'estado_cierre' => 3,
                'cerrado_por' => $id_personal,
                'cerrado_at' => date('Y-m-d H:i:s'),
                'observaciones_cierre' => 'OM cerrada por líder después de validar acciones y evidencias autorizadas.',
            ]);

        return redirect()
            ->route('auditorias.lider_acciones.reporte_om', $id_responsable)
            ->with('success', 'Oportunidad de Mejora cerrada correctamente.');
    }


    public function quitarValidacion(Request $request, $id_responsable)
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No tienes permisos para quitar la validación.');
        }

        $accion = AudResponsableAcciones::find($id_responsable);

        if (!$accion) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No se encontró el registro solicitado.');
        }

        if ((int) $accion->estado_cierre === 3) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No se puede quitar la validación porque la NC/OM ya está cerrada.');
        }

        if ((int) $accion->estado !== 6) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('warning', 'Solo se puede quitar la validación a registros validados.');
        }

        $accion->estado = 3;
        $accion->observaciones_lider = null;
        $accion->save();

        return redirect()
            ->route('auditorias.lider_acciones')
            ->with('success', 'Se quitó la validación y el registro regresó a estado Sin revisar.');
    }

    public function cerrarModuloAccionesCorrectivas(Request $request)
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No tienes permisos para cerrar el sistema.');
        }

        try {
            $this->asegurarControlAccionesCorrectivas();

            DB::table('aud_control_modulos')
                ->where('clave_modulo', 'acciones_correctivas')
                ->whereNull('deleted_at')
                ->update([
                    'cerrado' => 1,
                    'mensaje_cierre' => 'El sistema fue cerrado. Contacte al líder.',
                    'actualizado_por' => $id_personal,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('success', 'El sistema de No conformidades y acciones correctivas fue cerrado correctamente.');
        } catch (\Exception $e) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No fue posible cerrar el sistema. Verifica que exista la tabla aud_control_modulos.');
        }
    }

    public function reactivarModuloAccionesCorrectivas(Request $request)
    {
        $id_personal = Session::get("id_perso");

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if (!$liderActivo) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No tienes permisos para reactivar el sistema.');
        }

        try {
            $this->asegurarControlAccionesCorrectivas();

            DB::table('aud_control_modulos')
                ->where('clave_modulo', 'acciones_correctivas')
                ->whereNull('deleted_at')
                ->update([
                    'cerrado' => 0,
                    'actualizado_por' => $id_personal,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('success', 'El sistema de No conformidades y acciones correctivas fue reactivado correctamente.');
        } catch (\Exception $e) {
            return redirect()
                ->route('auditorias.lider_acciones')
                ->with('error', 'No fue posible reactivar el sistema. Verifica que exista la tabla aud_control_modulos.');
        }
    }

    private function obtenerUrlRegresarReporte()
    {
        $returnUrl = request()->get('return_url');

        if (!empty($returnUrl)) {
            $returnUrl = urldecode($returnUrl);
            $urlSeguimientoCompleta = url('/auditorias/seguimiento_auditorias');
            $rutaSeguimiento = '/auditorias/seguimiento_auditorias';

            if (strpos($returnUrl, $urlSeguimientoCompleta) === 0 || strpos($returnUrl, $rutaSeguimiento) === 0) {
                return $returnUrl;
            }
        }

        return url('/auditorias/seguimiento_auditorias');
    }

    private function usuarioPuedeConsultarReporteSeguimiento($id_responsable, $id_personal)
    {
        if (!$id_personal) {
            return false;
        }

        $liderActivo = AudLiderAcciones::where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->first();

        if ($liderActivo) {
            return true;
        }

        $esResponsableSeguimiento = DB::table('aud_seguimiento_auditorias')
            ->where('id_responsable', $id_responsable)
            ->where('id_personal_seguimiento', $id_personal)
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->exists();

        if ($esResponsableSeguimiento) {
            return true;
        }

        $esResponsableTratamiento = DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->where('id_personal', $id_personal)
            ->whereNull('deleted_at')
            ->exists();

        if ($esResponsableTratamiento) {
            return true;
        }

        $esAuditorDeLaNota = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->join('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->join('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->join('aud_agenda_auditor as agenda_auditor', 'agenda_auditor.id_agenda', '=', 'agenda.id_agenda')
            ->join('aud_auditor_auditoria as auditor_auditoria', 'auditor_auditoria.id_auditor_auditoria', '=', 'agenda_auditor.id_auditor_auditoria')
            ->where('acc.id_responsable', $id_responsable)
            ->where('auditor_auditoria.id_personal', $id_personal)
            ->whereNull('acc.deleted_at')
            ->exists();

        return $esAuditorDeLaNota;
    }

    private function obtenerControlAccionesCorrectivas()
    {
        try {
            $this->asegurarControlAccionesCorrectivas();

            return DB::table('aud_control_modulos')
                ->where('clave_modulo', 'acciones_correctivas')
                ->whereNull('deleted_at')
                ->first();
        } catch (\Exception $e) {
            return null;
        }
    }

    private function asegurarControlAccionesCorrectivas()
    {
        $existe = DB::table('aud_control_modulos')
            ->where('clave_modulo', 'acciones_correctivas')
            ->whereNull('deleted_at')
            ->first();

        if (!$existe) {
            DB::table('aud_control_modulos')->insert([
                'clave_modulo' => 'acciones_correctivas',
                'nombre_modulo' => 'No conformidades y acciones correctivas',
                'cerrado' => 0,
                'mensaje_cierre' => 'El sistema fue cerrado. Contacte al líder.',
                'actualizado_por' => Session::get("id_perso"),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ]);
        }
    }

    public function evaluar(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required',
            'observaciones_lider' => 'nullable|string',
        ]);

        $accion = AudResponsableAcciones::findOrFail($id);

        $accion->estado = $request->estado;
        $accion->observaciones_lider = $request->estado == 7 ? $request->observaciones_lider : null;
        $accion->save();

        if ($request->estado == 7) {
            AudPlanAccion::where('id_responsable', $accion->id_responsable)->delete();
        }

        return back()->with('success', 'Evaluación guardada correctamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $lider = AudLiderAcciones::findOrFail($id);
        $lider->delete();

        return redirect()
            ->route('auditorias.asignar_lider')
            ->with('success', 'Líder eliminado correctamente.');
    }
}
