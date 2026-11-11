<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\AudAuditores;

class AudSeguimientoAuditoriasController extends Controller
{
    public function index()
    {
        $idsPersonal = $this->obtenerIdsPersonalAutenticado();
        $origenAuditor = $this->detectarOrigenAuditor();

        $esAuditorLider = $idsPersonal->isNotEmpty()
            ? AudAuditores::whereIn('id_personal', $idsPersonal->all())
                ->where('id_categoria', 1)
                ->exists()
            : false;

        $esAuditorResponsable = $idsPersonal->isNotEmpty()
            ? AudAuditores::whereIn('id_personal', $idsPersonal->all())->exists()
            : false;

        /*
         * Se conserva este nombre porque la vista actual lo utiliza para
         * habilitar las funciones administrativas del seguimiento.
         */
        $esLiderActivo = $esAuditorLider;

        $idsSeguimientoAsignado = $idsPersonal->isNotEmpty()
            ? DB::table('aud_seguimiento_auditorias')
                ->whereIn('id_personal_seguimiento', $idsPersonal->all())
                ->where('activo', 1)
                ->whereNull('deleted_at')
                ->pluck('id_responsable')
                ->toArray()
            : [];

        /*
         * El auditor líder ve todas las notas. El responsable específico ve
         * las reasignadas y el auditor responsable conserva sus propias notas
         * únicamente mientras no exista una reasignación activa.
         */
        $puedeVerSeguimiento = $esAuditorLider
            || count($idsSeguimientoAsignado) > 0
            || $esAuditorResponsable;

        $personales = $esAuditorLider
            ? DB::table('gnral_personales')
                ->select('id_personal', 'nombre')
                ->orderBy('nombre', 'asc')
                ->get()
            : collect();

        $seguimientosAgrupados = collect();

        if ($puedeVerSeguimiento) {
            $query = DB::table('audresponsable_acciones as acc')
                ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
                ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
                ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
                ->leftJoin('aud_auditoria as auditoria', 'auditoria.id_auditoria', '=', 'agenda.id_auditoria')
                ->leftJoin('gnral_personales as responsable', 'responsable.id_personal', '=', 'acc.id_personal')
                ->leftJoin('aud_plan_acciones as plan', function ($join) {
                    $join->on('plan.id_responsable', '=', 'acc.id_responsable')
                        ->whereNull('plan.deleted_at');
                })
                ->leftJoin('gnral_personales as implanta', 'implanta.id_personal', '=', 'plan.id_responsable_implantar')
                ->leftJoin('gnral_personales as revisa', 'revisa.id_personal', '=', 'plan.id_responsable_revisar')
                ->leftJoin('aud_seguimiento_auditorias as seg', function ($join) {
                    $join->on('seg.id_responsable', '=', 'acc.id_responsable')
                        ->where('seg.activo', '=', 1)
                        ->whereNull('seg.deleted_at');
                })
                ->leftJoin('gnral_personales as seguimiento', 'seguimiento.id_personal', '=', 'seg.id_personal_seguimiento')
                ->whereNull('acc.deleted_at')
                ->whereIn('nota.id_clasificacion', [1, 2]);

            $this->aplicarJoinAuditor($query, $origenAuditor);

            if (!$esAuditorLider) {
                $query->where(function ($acceso) use (
                    $idsSeguimientoAsignado,
                    $esAuditorResponsable,
                    $origenAuditor,
                    $idsPersonal
                ) {
                    $acceso->where(function ($asignadas) use ($idsSeguimientoAsignado) {
                        if (count($idsSeguimientoAsignado) > 0) {
                            $asignadas->whereIn('acc.id_responsable', $idsSeguimientoAsignado);
                        } else {
                            $asignadas->whereRaw('1 = 0');
                        }
                    });

                    $acceso->orWhere(function ($propias) use (
                        $esAuditorResponsable,
                        $origenAuditor,
                        $idsPersonal
                    ) {
                        if (!$esAuditorResponsable || $origenAuditor === null) {
                            $propias->whereRaw('1 = 0');
                            return;
                        }

                        $propias->whereNull('seg.id_seguimiento');
                        $this->aplicarWhereAuditor($propias, $origenAuditor, $idsPersonal->all());
                    });
                });
            }

            $selects = [
                'acc.id_responsable',
                'acc.id_personal',
                'acc.estado as estado_nc_om',
                'acc.estado_cierre',
                'acc.integrar_informe as integrar_informe_nota',

                'nota.id_notas',
                'nota.clave_nota',
                'nota.id_clasificacion',
                'nota.resultado as reporte_auditor',
                'nota.observaciones as observaciones_auditor',
                'nota.punto_proceso',

                'agenda.id_auditoria',
                'agenda.fecha as fecha_auditoria',

                'auditoria.criterio as criterio_auditoria',

                'responsable.nombre as responsable_asignado',

                'plan.id_plan_acciones',
                'plan.acciones',
                'plan.tipo as tipo_accion',
                'plan.estado as estado_plan',
                'plan.integrar_informe',
                'plan.path_evidencia',
                'plan.fecha_implantar_accion',
                'plan.fecha_verificacion',
                'plan.observaciones as observaciones_plan',

                'implanta.nombre as responsable_implantar',
                'revisa.nombre as responsable_revisar',

                'seg.id_seguimiento',
                'seg.id_personal_seguimiento',
                'seguimiento.nombre as persona_seguimiento'
            ];

            $auditorSelects = $this->selectsAuditor($origenAuditor);
            foreach ($auditorSelects as $selectAuditor) {
                $selects[] = $selectAuditor;
            }

            $registros = $query
                ->select($selects)
                ->orderBy('auditor_nota_nombre', 'asc')
                ->orderBy('agenda.fecha', 'desc')
                ->orderBy('agenda.id_auditoria', 'desc')
                ->orderBy('nota.id_clasificacion', 'asc')
                ->orderBy('nota.clave_nota', 'asc')
                ->orderBy('plan.fecha_implantar_accion', 'asc')
                ->get();

            $idsPlan = $registros
                ->pluck('id_plan_acciones')
                ->filter(function ($id) {
                    return !is_null($id);
                })
                ->unique()
                ->values()
                ->toArray();

            $ultimasRevisiones = collect();

            if (count($idsPlan) > 0) {
                $ultimasRevisiones = DB::table('aud_seguimiento_acciones')
                    ->whereIn('id_plan_acciones', $idsPlan)
                    ->whereNull('deleted_at')
                    ->orderBy('id_seguimiento_accion', 'desc')
                    ->get()
                    ->groupBy('id_plan_acciones')
                    ->map(function ($items) {
                        return $items->first();
                    });
            }

            $registros = $registros->map(function ($registro) use ($ultimasRevisiones) {
                $revision = null;

                if ($registro->id_plan_acciones && isset($ultimasRevisiones[$registro->id_plan_acciones])) {
                    $revision = $ultimasRevisiones[$registro->id_plan_acciones];
                }

                $registro->estado_cumplimiento = $revision ? (int) $revision->estado_cumplimiento : 0;
                $registro->nota_seguimiento = $revision ? $revision->nota_seguimiento : null;
                $registro->fecha_revision = $revision ? $revision->fecha_revision : null;

                $registro->tipo_hallazgo = (int) $registro->id_clasificacion === 1 ? 'NC' : 'OM';

                $claveNota = $registro->clave_nota ? $registro->clave_nota : '';
                $partesClave = explode('-', $claveNota);

                $registro->numero_auditoria = count($partesClave) >= 2
                    ? $partesClave[0] . '-' . $partesClave[1]
                    : 'Auditoría ' . ($registro->id_auditoria ? $registro->id_auditoria : 'sin número');

                /*
                 * Responsable efectivo de seguimiento:
                 * - Si el líder ya cambió el responsable, se usa aud_seguimiento_auditorias.
                 * - Si no existe cambio, por default queda el auditor real consultado desde BD.
                 */
                $registro->id_personal_seguimiento_efectivo = $registro->id_personal_seguimiento
                    ? $registro->id_personal_seguimiento
                    : $registro->id_auditor_nota;

                $registro->persona_seguimiento_efectiva = $registro->persona_seguimiento
                    ? $registro->persona_seguimiento
                    : ($registro->auditor_nota_nombre ? $registro->auditor_nota_nombre : 'Sin auditor identificado');

                $registro->seguimiento_por_defecto = !$registro->id_personal_seguimiento && $registro->id_auditor_nota;

                $registro->auditor_grupo_id = $registro->id_auditor_nota ? $registro->id_auditor_nota : 0;
                $registro->auditor_grupo_nombre = $registro->auditor_nota_nombre ? $registro->auditor_nota_nombre : 'Sin auditor identificado';

                $semaforo = $this->calcularSemaforo($registro);
                $semaforoImplantacion = $this->calcularSemaforoFecha($registro, 'implantacion');
                $semaforoVerificacion = $this->calcularSemaforoFecha($registro, 'verificacion');

                /*
                 * Se conserva el semáforo general para compatibilidad con filtros/consultas existentes.
                 * En la vista se muestran dos etiquetas independientes:
                 * - Fecha de implantación.
                 * - Fecha de verificación.
                 */
                $registro->semaforo_clase = $semaforo['clase'];
                $registro->semaforo_texto = $semaforo['texto'];

                $registro->semaforo_implantacion_clase = $semaforoImplantacion['clase'];
                $registro->semaforo_implantacion_texto = $semaforoImplantacion['texto'];

                $registro->semaforo_verificacion_clase = $semaforoVerificacion['clase'];
                $registro->semaforo_verificacion_texto = $semaforoVerificacion['texto'];

                return $registro;
            });

            /*
             * Jerarquía final:
             * Auditor real de la BD -> Auditoría -> Nota NC/OM -> Acciones del plan.
             */
            $seguimientosAgrupados = $registros
                ->groupBy(function ($registro) {
                    return $registro->auditor_grupo_id . '|' . $registro->auditor_grupo_nombre;
                })
                ->map(function ($itemsAuditor) {
                    $primerRegistroAuditor = $itemsAuditor->first();

                    $responsablesSeguimiento = $itemsAuditor
                        ->pluck('persona_seguimiento_efectiva')
                        ->filter(function ($nombre) {
                            return !empty($nombre);
                        })
                        ->unique()
                        ->values();

                    $responsableSeguimientoTexto = $responsablesSeguimiento->count() === 1
                        ? $responsablesSeguimiento->first()
                        : 'Varios responsables de seguimiento';

                    $idsResponsables = $itemsAuditor
                        ->pluck('id_responsable')
                        ->filter(function ($id) {
                            return !is_null($id);
                        })
                        ->unique()
                        ->values();

                    $auditorias = $itemsAuditor
                        ->groupBy('numero_auditoria')
                        ->map(function ($itemsAuditoria) {
                            return $itemsAuditoria
                                ->groupBy('id_responsable')
                                ->map(function ($accionesNota) {
                                    $primero = $accionesNota->first();

                                    $accionesPlan = $accionesNota->filter(function ($accion) {
                                        return !is_null($accion->id_plan_acciones);
                                    })->values();

                                    return [
                                        'nota' => $primero,
                                        'acciones' => $accionesPlan,
                                    ];
                                })->values();
                        });

                    return [
                        'auditor' => $primerRegistroAuditor,
                        'responsable_seguimiento_texto' => $responsableSeguimientoTexto,
                        'total_notas' => $idsResponsables->count(),
                        'auditorias' => $auditorias,
                    ];
                });
        }

        return view('auditorias.seguimiento_auditorias', compact(
            'esLiderActivo',
            'puedeVerSeguimiento',
            'seguimientosAgrupados',
            'personales'
        ));
    }

    public function asignarSeguimiento(Request $request, $id_responsable)
    {
        $id_personal = $this->obtenerIdPersonalAutenticado();

        $esAuditorLider = $id_personal
            ? AudAuditores::where('id_personal', $id_personal)
                ->where('id_categoria', 1)
                ->exists()
            : false;

        if (!$esAuditorLider) {
            return redirect()->back()->with('error', 'No tiene permisos para cambiar el responsable de seguimiento.');
        }

        $this->validate($request, [
            'id_personal_seguimiento' => 'required|integer',
            'observaciones' => 'nullable|string',
            'return_anchor' => 'nullable|string',
        ]);

        $registro = DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->whereNull('deleted_at')
            ->first();

        if (!$registro) {
            return redirect()->back()->with('error', 'No se encontró la nota seleccionada.');
        }

        DB::beginTransaction();

        try {
            /*
             * El cambio de responsable de seguimiento se realiza por nota.
             * No se actualizan todas las notas del auditor porque una auditoría
             * puede requerir responsables de seguimiento distintos por cada NC/OM.
             */
            DB::table('aud_seguimiento_auditorias')
                ->where('id_responsable', $id_responsable)
                ->where('activo', 1)
                ->whereNull('deleted_at')
                ->update([
                    'activo' => 0,
                    'updated_at' => Carbon::now(),
                ]);

            DB::table('aud_seguimiento_auditorias')->insert([
                'id_responsable' => $id_responsable,
                'id_personal_seguimiento' => $request->input('id_personal_seguimiento'),
                'asignado_por' => $id_personal,
                'fecha_asignacion' => Carbon::now(),
                'observaciones' => $request->input('observaciones'),
                'activo' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);

            DB::commit();

            $anchor = preg_replace('/[^A-Za-z0-9_\-]/', '', $request->input('return_anchor', ''));

            if ($anchor !== '') {
                return redirect()->to(url()->previous() . '#' . $anchor)
                    ->with('success', 'Responsable de seguimiento actualizado correctamente.');
            }

            return redirect()->back()->with('success', 'Responsable de seguimiento actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'No fue posible actualizar el responsable de seguimiento.');
        }
    }

    public function guardarNotaAccion(Request $request, $id_plan_acciones)
    {
        $idsPersonal = $this->obtenerIdsPersonalAutenticado();
        $id_personal = $this->obtenerIdPersonalAutenticado();

        $this->validate($request, [
            'estado_cumplimiento' => 'required|integer|in:0,1,2,3',
            'nota_seguimiento' => 'nullable|string',
            'return_anchor' => 'nullable|string',
        ]);

        $plan = DB::table('aud_plan_acciones')
            ->where('id_plan_acciones', $id_plan_acciones)
            ->whereNull('deleted_at')
            ->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'La acción del plan no existe.');
        }

        $esAuditorLider = $idsPersonal->isNotEmpty()
            ? AudAuditores::whereIn('id_personal', $idsPersonal->all())
                ->where('id_categoria', 1)
                ->exists()
            : false;

        $esSeguimientoAsignado = DB::table('aud_seguimiento_auditorias')
            ->where('id_responsable', $plan->id_responsable)
            ->whereIn('id_personal_seguimiento', $idsPersonal->all())
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->exists();

        $tieneResponsableEspecifico = DB::table('aud_seguimiento_auditorias')
            ->where('id_responsable', $plan->id_responsable)
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->exists();

        $esAuditorOriginal = !$tieneResponsableEspecifico
            && $this->esAuditorOriginalDeResponsable($plan->id_responsable, $idsPersonal->all());

        if (!$esAuditorLider && !$esSeguimientoAsignado && !$esAuditorOriginal) {
            return redirect()->back()->with('error', 'No tiene permisos para calificar esta acción.');
        }

        DB::table('aud_seguimiento_acciones')->insert([
            'id_plan_acciones' => $id_plan_acciones,
            'id_responsable' => $plan->id_responsable,
            'id_personal_seguimiento' => $id_personal,
            'nota_seguimiento' => $request->input('nota_seguimiento'),
            'estado_cumplimiento' => $request->input('estado_cumplimiento'),
            'fecha_revision' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);

        $anchor = preg_replace('/[^A-Za-z0-9_\-]/', '', $request->input('return_anchor', ''));

        if ($anchor !== '') {
            return redirect()->to(url()->previous() . '#' . $anchor)
                ->with('success', 'Seguimiento de acción guardado correctamente.');
        }

        return redirect()->back()->with('success', 'Seguimiento de acción guardado correctamente.');
    }

    public function actualizarIntegracionInforme(Request $request, $id_plan_acciones)
    {
        $idsPersonal = $this->obtenerIdsPersonalAutenticado();

        $this->validate($request, [
            'integrar_informe' => 'required|integer|in:0,1',
            'return_anchor' => 'nullable|string',
        ]);

        if (!Schema::hasColumn('aud_plan_acciones', 'integrar_informe')) {
            return redirect()->back()->with(
                'error',
                'Falta aplicar la actualización de base de datos para integrar acciones al informe.'
            );
        }

        $plan = DB::table('aud_plan_acciones')
            ->where('id_plan_acciones', $id_plan_acciones)
            ->whereNull('deleted_at')
            ->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'La acción del plan no existe.');
        }

        $esAuditorLider = $idsPersonal->isNotEmpty()
            ? AudAuditores::whereIn('id_personal', $idsPersonal->all())
                ->where('id_categoria', 1)
                ->exists()
            : false;

        $esSeguimientoAsignado = $idsPersonal->isNotEmpty()
            ? DB::table('aud_seguimiento_auditorias')
                ->where('id_responsable', $plan->id_responsable)
                ->whereIn('id_personal_seguimiento', $idsPersonal->all())
                ->where('activo', 1)
                ->whereNull('deleted_at')
                ->exists()
            : false;

        $tieneResponsableEspecifico = DB::table('aud_seguimiento_auditorias')
            ->where('id_responsable', $plan->id_responsable)
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->exists();

        $esAuditorOriginal = !$tieneResponsableEspecifico
            && $this->esAuditorOriginalDeResponsable($plan->id_responsable, $idsPersonal->all());

        if (!$esAuditorLider && !$esSeguimientoAsignado && !$esAuditorOriginal) {
            return redirect()->back()->with('error', 'No tiene permisos para integrar esta acción al informe.');
        }

        $integrarInforme = (int) $request->input('integrar_informe');

        DB::table('aud_plan_acciones')
            ->where('id_plan_acciones', $id_plan_acciones)
            ->whereNull('deleted_at')
            ->update([
                'integrar_informe' => $integrarInforme,
                'updated_at' => Carbon::now(),
            ]);

        $mensaje = $integrarInforme === 1
            ? 'La acción se integrará al informe de auditoría.'
            : 'La acción fue excluida del informe de auditoría.';

        $anchor = preg_replace('/[^A-Za-z0-9_\-]/', '', $request->input('return_anchor', ''));

        if ($anchor !== '') {
            return redirect()->to(url()->previous() . '#' . $anchor)
                ->with('success', $mensaje);
        }

        return redirect()->back()->with('success', $mensaje);
    }

    public function actualizarIntegracionInformeNota(Request $request, $id_responsable)
    {
        $idsPersonal = $this->obtenerIdsPersonalAutenticado();

        $this->validate($request, [
            'integrar_informe' => 'required|integer|in:0,1',
            'return_anchor' => 'nullable|string',
        ]);

        if (!Schema::hasColumn('audresponsable_acciones', 'integrar_informe')) {
            return redirect()->back()->with(
                'error',
                'Falta aplicar la actualización de base de datos para integrar notas sin plan al informe.'
            );
        }

        $registro = DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->whereNull('deleted_at')
            ->first();

        if (!$registro) {
            return redirect()->back()->with('error', 'No se encontró la nota seleccionada.');
        }

        $esAuditorLider = $idsPersonal->isNotEmpty()
            ? AudAuditores::whereIn('id_personal', $idsPersonal->all())
                ->where('id_categoria', 1)
                ->exists()
            : false;

        $esSeguimientoAsignado = $idsPersonal->isNotEmpty()
            ? DB::table('aud_seguimiento_auditorias')
                ->where('id_responsable', $id_responsable)
                ->whereIn('id_personal_seguimiento', $idsPersonal->all())
                ->where('activo', 1)
                ->whereNull('deleted_at')
                ->exists()
            : false;

        $tieneResponsableEspecifico = DB::table('aud_seguimiento_auditorias')
            ->where('id_responsable', $id_responsable)
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->exists();

        $esAuditorOriginal = !$tieneResponsableEspecifico
            && $this->esAuditorOriginalDeResponsable($id_responsable, $idsPersonal->all());

        if (!$esAuditorLider && !$esSeguimientoAsignado && !$esAuditorOriginal) {
            return redirect()->back()->with('error', 'No tiene permisos para integrar esta nota al informe.');
        }

        $integrarInforme = (int) $request->input('integrar_informe');

        DB::table('audresponsable_acciones')
            ->where('id_responsable', $id_responsable)
            ->whereNull('deleted_at')
            ->update([
                'integrar_informe' => $integrarInforme,
                'updated_at' => Carbon::now(),
            ]);

        $mensaje = $integrarInforme === 1
            ? 'La nota sin plan se integrará al informe de auditoría.'
            : 'La nota sin plan fue excluida del informe de auditoría.';

        $anchor = preg_replace('/[^A-Za-z0-9_\-]/', '', $request->input('return_anchor', ''));

        if ($anchor !== '') {
            return redirect()->to(url()->previous() . '#' . $anchor)
                ->with('success', $mensaje);
        }

        return redirect()->back()->with('success', $mensaje);
    }

    private function calcularSemaforo($registro)
    {
        if (!$registro->id_plan_acciones) {
            return [
                'clase' => 'default',
                'texto' => 'Sin plan cargado',
            ];
        }

        if ((int) $registro->estado_cumplimiento === 1 || (int) $registro->estado_plan === 1) {
            return [
                'clase' => 'success',
                'texto' => 'Concluido',
            ];
        }

        if ((int) $registro->estado_cumplimiento === 2) {
            return [
                'clase' => 'warning',
                'texto' => 'En proceso',
            ];
        }

        if ((int) $registro->estado_cumplimiento === 3) {
            return [
                'clase' => 'danger',
                'texto' => 'Sin cumplimiento',
            ];
        }

        $fechaCompromiso = $registro->fecha_verificacion ? $registro->fecha_verificacion : $registro->fecha_implantar_accion;

        if ($fechaCompromiso) {
            try {
                $fecha = Carbon::parse($fechaCompromiso)->startOfDay();

                if ($fecha->lt(Carbon::today())) {
                    return [
                        'clase' => 'danger',
                        'texto' => 'Vencida sin cumplimiento',
                    ];
                }
            } catch (\Exception $e) {
                // Si la fecha no se puede interpretar, se deja como pendiente.
            }
        }

        if (!empty($registro->path_evidencia)) {
            return [
                'clase' => 'warning',
                'texto' => 'Con evidencia pendiente de validar',
            ];
        }

        return [
            'clase' => 'info',
            'texto' => 'En tiempo / pendiente',
        ];
    }

    private function obtenerIdPersonalAutenticado()
    {
        $idsPersonal = $this->obtenerIdsPersonalAutenticado();

        if ($idsPersonal->isEmpty()) {
            return null;
        }

        /*
         * Para un responsable se prioriza el id_personal con asignación activa.
         * Esto evita que un id_perso de sesión distinto o antiguo oculte el menú
         * o deje el controlador sin registros.
         */
        $idAsignado = DB::table('aud_seguimiento_auditorias')
            ->whereIn('id_personal_seguimiento', $idsPersonal->all())
            ->where('activo', 1)
            ->whereNull('deleted_at')
            ->value('id_personal_seguimiento');

        if ($idAsignado) {
            return (int) $idAsignado;
        }

        $idAuditorLider = AudAuditores::whereIn('id_personal', $idsPersonal->all())
            ->where('id_categoria', 1)
            ->value('id_personal');

        if ($idAuditorLider) {
            return (int) $idAuditorLider;
        }

        $idAuditor = AudAuditores::whereIn('id_personal', $idsPersonal->all())
            ->value('id_personal');

        if ($idAuditor) {
            return (int) $idAuditor;
        }

        return (int) $idsPersonal->first();
    }

    private function obtenerIdsPersonalAutenticado()
    {
        $idsPersonal = collect();
        $idPersonalSesion = Session::get('id_perso');

        if (is_numeric($idPersonalSesion) && (int) $idPersonalSesion > 0) {
            $idsPersonal->push((int) $idPersonalSesion);
        }

        $usuario = Auth::user();

        if ($usuario) {
            $idUsuario = isset($usuario->id) ? $usuario->id : null;
            $correo = isset($usuario->email) ? trim(strtolower($usuario->email)) : '';

            if (isset($usuario->id_personal) && is_numeric($usuario->id_personal)) {
                $idsPersonal->push((int) $usuario->id_personal);
            }

            if ($idUsuario || $correo !== '') {
                $idsPersonalBd = DB::table('gnral_personales')
                    ->where(function ($query) use ($idUsuario, $correo) {
                        if ($idUsuario) {
                            $query->where('tipo_usuario', $idUsuario);
                        }

                        if ($correo !== '') {
                            $query->orWhereRaw('LOWER(TRIM(correo)) = ?', [$correo]);
                        }
                    })
                    ->pluck('id_personal');

                foreach ($idsPersonalBd as $idPersonalBd) {
                    if (is_numeric($idPersonalBd)) {
                        $idsPersonal->push((int) $idPersonalBd);
                    }
                }
            }
        }

        $idsPersonal = $idsPersonal
            ->filter(function ($id) {
                return is_numeric($id) && (int) $id > 0;
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values();

        return $idsPersonal;
    }

    private function calcularSemaforoFecha($registro, $tipoFecha)
    {
        if (!$registro->id_plan_acciones) {
            return [
                'clase' => 'default',
                'texto' => 'Sin plan cargado',
            ];
        }

        $esImplantacion = $tipoFecha === 'implantacion';
        $etiquetaFecha = $esImplantacion ? 'Implantación' : 'Verificación';
        $campoFecha = $esImplantacion ? 'fecha_implantar_accion' : 'fecha_verificacion';
        $fechaCompromiso = isset($registro->{$campoFecha}) ? $registro->{$campoFecha} : null;

        /*
         * La calificación manual del seguimiento tiene prioridad sobre la fecha.
         */
        if ((int) $registro->estado_cumplimiento === 1 || (int) $registro->estado_plan === 1) {
            return [
                'clase' => 'success',
                'texto' => $etiquetaFecha . ': concluida',
            ];
        }

        if ((int) $registro->estado_cumplimiento === 2) {
            return [
                'clase' => 'warning',
                'texto' => $etiquetaFecha . ': en proceso',
            ];
        }

        if ((int) $registro->estado_cumplimiento === 3) {
            return [
                'clase' => 'danger',
                'texto' => $etiquetaFecha . ': sin cumplimiento',
            ];
        }

        if (!$fechaCompromiso) {
            return [
                'clase' => 'default',
                'texto' => $etiquetaFecha . ': sin fecha',
            ];
        }

        try {
            $fecha = Carbon::parse($fechaCompromiso)->startOfDay();

            if ($fecha->lt(Carbon::today())) {
                return [
                    'clase' => 'danger',
                    'texto' => $etiquetaFecha . ': vencida',
                ];
            }
        } catch (\Exception $e) {
            return [
                'clase' => 'default',
                'texto' => $etiquetaFecha . ': fecha inválida',
            ];
        }

        if (!$esImplantacion && !empty($registro->path_evidencia)) {
            return [
                'clase' => 'warning',
                'texto' => $etiquetaFecha . ': evidencia por validar',
            ];
        }

        return [
            'clase' => 'success',
            'texto' => $etiquetaFecha . ': en tiempo',
        ];
    }

    private function detectarOrigenAuditor()
    {
        /*
         * La ruta /auditorias/agenda/{id} obtiene el auditor responsable por agenda:
         * aud_agenda.id_agenda -> aud_agenda_auditor.id_agenda
         * aud_agenda_auditor.id_auditor_auditoria -> aud_auditor_auditoria.id_auditor_auditoria
         * aud_auditor_auditoria.id_personal -> gnral_personales.id_personal
         *
         * IMPORTANTE:
         * No se debe agrupar por aud_auditor_auditoria.id_auditoria directamente,
         * porque eso duplica todas las NC/OM para todos los auditores de la auditoría.
         */
        if (
            Schema::hasTable('aud_agenda_auditor') &&
            Schema::hasTable('aud_auditor_auditoria') &&
            Schema::hasColumn('aud_agenda_auditor', 'id_agenda') &&
            Schema::hasColumn('aud_agenda_auditor', 'id_auditor_auditoria') &&
            Schema::hasColumn('aud_auditor_auditoria', 'id_auditor_auditoria') &&
            Schema::hasColumn('aud_auditor_auditoria', 'id_personal')
        ) {
            return [
                'tipo' => 'agenda_auditor',
            ];
        }

        /*
         * Respaldo por si en algún ambiente la nota o el reporte ya guardan
         * directamente el auditor que levantó la nota.
         */
        $fuentesDirectas = [
            ['tabla' => 'aud_notas', 'alias' => 'nota', 'columnas' => ['id_personal', 'id_auditor', 'id_personal_auditor', 'auditor_id', 'id_personal_registro', 'created_by']],
            ['tabla' => 'aud_reportes', 'alias' => 'reporte', 'columnas' => ['id_personal', 'id_auditor', 'id_personal_auditor', 'auditor_id', 'id_personal_registro', 'created_by']],
        ];

        foreach ($fuentesDirectas as $fuente) {
            if (!Schema::hasTable($fuente['tabla'])) {
                continue;
            }

            foreach ($fuente['columnas'] as $columna) {
                if (Schema::hasColumn($fuente['tabla'], $columna)) {
                    return [
                        'tipo' => 'directo',
                        'tabla' => $fuente['tabla'],
                        'alias' => $fuente['alias'],
                        'columna' => $columna,
                    ];
                }
            }
        }

        return null;
    }

    private function aplicarJoinAuditor($query, $origenAuditor)
    {
        if ($origenAuditor === null) {
            return;
        }

        if ($origenAuditor['tipo'] === 'agenda_auditor') {
            $query->leftJoin('aud_agenda_auditor as agenda_auditor', function ($join) {
                $join->on('agenda_auditor.id_agenda', '=', 'agenda.id_agenda');

                if (Schema::hasColumn('aud_agenda_auditor', 'deleted_at')) {
                    $join->whereNull('agenda_auditor.deleted_at');
                }
            });

            $query->leftJoin('aud_auditor_auditoria as auditor_asignado', function ($join) {
                $join->on('auditor_asignado.id_auditor_auditoria', '=', 'agenda_auditor.id_auditor_auditoria');

                if (Schema::hasColumn('aud_auditor_auditoria', 'deleted_at')) {
                    $join->whereNull('auditor_asignado.deleted_at');
                }
            });

            $query->leftJoin(
                'gnral_personales as auditor_nota',
                'auditor_nota.id_personal',
                '=',
                'auditor_asignado.id_personal'
            );

            return;
        }

        if ($origenAuditor['tipo'] === 'directo') {
            $query->leftJoin(
                'gnral_personales as auditor_nota',
                'auditor_nota.id_personal',
                '=',
                $origenAuditor['alias'] . '.' . $origenAuditor['columna']
            );
        }
    }

    private function aplicarWhereAuditor($query, $origenAuditor, array $idsPersonal)
    {
        if ($origenAuditor === null || count($idsPersonal) === 0) {
            $query->whereRaw('1 = 0');
            return;
        }

        if ($origenAuditor['tipo'] === 'agenda_auditor') {
            $query->whereIn('auditor_asignado.id_personal', $idsPersonal);
            return;
        }

        if ($origenAuditor['tipo'] === 'directo') {
            $query->whereIn($origenAuditor['alias'] . '.' . $origenAuditor['columna'], $idsPersonal);
        }
    }

    private function esAuditorOriginalDeResponsable($idResponsable, array $idsPersonal)
    {
        if (count($idsPersonal) === 0) {
            return false;
        }

        $origenAuditor = $this->detectarOrigenAuditor();

        if ($origenAuditor === null) {
            return false;
        }

        $query = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->where('acc.id_responsable', $idResponsable)
            ->whereNull('acc.deleted_at');

        $this->aplicarJoinAuditor($query, $origenAuditor);
        $this->aplicarWhereAuditor($query, $origenAuditor, $idsPersonal);

        return $query->exists();
    }

    private function selectsAuditor($origenAuditor)
    {
        if ($origenAuditor === null) {
            return [
                DB::raw('NULL as id_auditor_nota'),
                DB::raw('NULL as auditor_nota_nombre'),
                DB::raw('NULL as id_auditor_auditoria_nota'),
                DB::raw('NULL as categoria_auditor_nota'),
            ];
        }

        if ($origenAuditor['tipo'] === 'agenda_auditor') {
            return [
                DB::raw('auditor_asignado.id_personal as id_auditor_nota'),
                'auditor_nota.nombre as auditor_nota_nombre',
                DB::raw('auditor_asignado.id_auditor_auditoria as id_auditor_auditoria_nota'),
                DB::raw('auditor_asignado.id_categoria as categoria_auditor_nota'),
            ];
        }

        return [
            DB::raw($origenAuditor['alias'] . '.' . $origenAuditor['columna'] . ' as id_auditor_nota'),
            'auditor_nota.nombre as auditor_nota_nombre',
            DB::raw('NULL as id_auditor_auditoria_nota'),
            DB::raw('NULL as categoria_auditor_nota'),
        ];
    }

    private function obtenerIdsResponsablesPorAuditor($id_auditor)
    {
        $origenAuditor = $this->detectarOrigenAuditor();

        if ($origenAuditor === null || (int) $id_auditor <= 0) {
            return collect();
        }

        $query = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->leftJoin('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->leftJoin('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->whereNull('acc.deleted_at')
            ->whereIn('nota.id_clasificacion', [1, 2]);

        $this->aplicarJoinAuditor($query, $origenAuditor);
        $this->aplicarWhereAuditor($query, $origenAuditor, [(int) $id_auditor]);

        return $query
            ->pluck('acc.id_responsable')
            ->unique()
            ->values();
    }

}
