<?php

namespace App\Http\Controllers;

use App\AudAuditores;
use App\AudAuditorias;
use App\AudInformeEstado;
use App\AudReporteEvidencia;
use App\AudProgramas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AudInformeEstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programas = AudProgramas::orderBy('fecha_i', 'ASC')->get();
        $auditorias = AudAuditorias::all();
        $esLider = $this->esLiderAuditoria();

        return view('auditorias.informe_estado', compact('programas', 'esLider', 'auditorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auditorias.reporte_evidencias');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_auditoria
     * @return \Illuminate\Http\Response
     */
    public function show($id_auditoria)
    {
        $auditoriaActual = AudAuditorias::where('id_auditoria', $id_auditoria)->first();

        if (!$auditoriaActual) {
            abort(404, 'No se encontró la auditoría solicitada.');
        }

        $auditoria_id = $id_auditoria;
        $programas = AudProgramas::orderBy('fecha_i', 'ASC')->get();
        $auditorias = AudAuditorias::all();
        $esLider = $this->esLiderAuditoria();

        $lider = AudAuditores::where('id_categoria', 1)
            ->where('id_auditoria', $id_auditoria)
            ->get();

        $informe = $this->obtenerOCrearInforme($id_auditoria);

        $notasAuditoria = $this->obtenerNotasAuditoria($id_auditoria);

        $noConformidad = $notasAuditoria
            ->where('id_clasificacion', 1)
            ->values();

        $oportunidades = $notasAuditoria
            ->where('id_clasificacion', 2)
            ->values();

        $fortalezas = $notasAuditoria
            ->filter(function ($nota) {
                return !in_array((int) $nota->id_clasificacion, [1, 2]);
            })
            ->values();

        /*
         * El seguimiento del informe no se limita únicamente a la auditoría actual.
         * Para auditorías posteriores debe arrastrar pendientes de auditorías anteriores.
         */
        $seguimientoAcciones = $this->obtenerSeguimientoAccionesInforme($id_auditoria);

        /*
         * Se conservan estas variables para compatibilidad con la vista original.
         * Si el proyecto ya las alimenta desde otro flujo, estas colecciones evitan errores de variable indefinida.
         */
        $personas = collect();
        $procesosE = collect();

        return view('auditorias.reporte_evidencia', compact(
            'programas',
            'auditorias',
            'auditoria_id',
            'esLider',
            'lider',
            'informe',
            'personas',
            'procesosE',
            'noConformidad',
            'fortalezas',
            'oportunidades',
            'seguimientoAcciones'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudInformeEstado  $audInformeEstado
     * @return \Illuminate\Http\Response
     */
    public function edit(AudInformeEstado $audInformeEstado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudInformeEstado  $audInformeEstado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudInformeEstado $audInformeEstado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudInformeEstado  $audInformeEstado
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudInformeEstado $audInformeEstado)
    {
        //
    }

    private function esLiderAuditoria()
    {
        $idPersonal = Session::get('id_perso');

        if (!$idPersonal) {
            return false;
        }

        return AudAuditores::where('id_categoria', 1)
            ->where('id_personal', $idPersonal)
            ->exists();
    }

    private function obtenerOCrearInforme($id_auditoria)
    {
        $informe = AudInformeEstado::where('id_auditoria', $id_auditoria)->first();

        if ($informe) {
            return $informe;
        }

        $informe = new AudInformeEstado();
        $informe->id_auditoria = $id_auditoria;
        $informe->resumen = '';
        $informe->cierre = '';
        $informe->conclusiones = '';

        try {
            $informe->save();
        } catch (\Exception $e) {
            /*
             * En caso de que el modelo no permita guardar por configuración antigua,
             * se devuelve el objeto vacío para que la vista no falle.
             */
        }

        return $informe;
    }

    private function obtenerNotasAuditoria($id_auditoria)
    {
        return DB::table('aud_notas as nota')
            ->join('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->join('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->where('agenda.id_auditoria', $id_auditoria)
            ->select(
                'nota.id_notas',
                'nota.id_clasificacion',
                'nota.clave_nota',
                'nota.punto_proceso',
                'nota.resultado',
                'nota.observaciones'
            )
            ->orderBy('nota.id_clasificacion', 'asc')
            ->orderBy('nota.clave_nota', 'asc')
            ->get();
    }

    private function obtenerSeguimientoAccionesInforme($id_auditoria)
    {
        $auditoriaActual = DB::table('aud_auditoria')
            ->where('id_auditoria', $id_auditoria)
            ->first();

        if (!$auditoriaActual) {
            return collect();
        }

        $auditoriaAnterior = $this->obtenerAuditoriaAnterior($auditoriaActual);
        $idAuditoriaAnterior = $auditoriaAnterior ? (int) $auditoriaAnterior->id_auditoria : 0;

        /*
         * Última revisión registrada por acción del plan.
         * Se usa subconsulta compatible con Laravel 5.6/MySQL 5.x.
         */
        $subUltimaRevision = '(
            SELECT
                id_plan_acciones,
                MAX(id_seguimiento_accion) AS id_ultima_revision
            FROM aud_seguimiento_acciones
            WHERE deleted_at IS NULL
            GROUP BY id_plan_acciones
        ) AS ultima_revision';

        $consulta = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->join('aud_reportes as reporte', 'reporte.id_reporte', '=', 'nota.id_reporte')
            ->join('aud_agenda as agenda', 'agenda.id_agenda', '=', 'reporte.id_agenda')
            ->join('aud_auditoria as auditoria_origen', 'auditoria_origen.id_auditoria', '=', 'agenda.id_auditoria')
            ->join('aud_plan_acciones as plan', function ($join) {
                $join->on('plan.id_responsable', '=', 'acc.id_responsable')
                    ->whereNull('plan.deleted_at');
            })
            /*
             * LEFT JOIN: la acción debe aparecer aunque todavía no tenga
             * revisiones en aud_seguimiento_acciones.
             */
            ->leftJoin(DB::raw($subUltimaRevision), function ($join) {
                $join->on('ultima_revision.id_plan_acciones', '=', 'plan.id_plan_acciones');
            })
            ->leftJoin('aud_seguimiento_acciones as seg_accion', function ($join) {
                $join->on('seg_accion.id_seguimiento_accion', '=', 'ultima_revision.id_ultima_revision')
                    ->whereNull('seg_accion.deleted_at');
            })
            ->whereNull('acc.deleted_at')
            ->whereIn('nota.id_clasificacion', [1, 2])
            /*
             * El origen debe ser realmente anterior a la auditoría consultada.
             * No se usa "<>" porque también incluiría auditorías futuras.
             */
            ->where(function ($query) use ($auditoriaActual, $id_auditoria) {
                if (!empty($auditoriaActual->fecha_i)) {
                    $query->where('auditoria_origen.fecha_i', '<', $auditoriaActual->fecha_i)
                        ->orWhere(function ($q) use ($auditoriaActual, $id_auditoria) {
                            /*
                             * Desempate para auditorías con la misma fecha inicial.
                             */
                            $q->where('auditoria_origen.fecha_i', '=', $auditoriaActual->fecha_i)
                                ->where('agenda.id_auditoria', '<', $id_auditoria);
                        });
                } else {
                    $query->where('agenda.id_auditoria', '<', $id_auditoria);
                }
            })
            /*
             * Regla del informe:
             * - Todo seguimiento no cumplido continúa apareciendo.
             * - Un seguimiento cumplido/cerrado aparece únicamente en el
             *   informe de la auditoría inmediatamente posterior.
             */
            ->where(function ($query) use ($idAuditoriaAnterior) {
                $query->whereNull('seg_accion.estado_cumplimiento')
                    ->orWhere('seg_accion.estado_cumplimiento', '<>', 1);

                if ($idAuditoriaAnterior > 0) {
                    $query->orWhere('agenda.id_auditoria', $idAuditoriaAnterior);
                }
            })
            ->select(
                'acc.id_responsable',
                'acc.estado_cierre',

                'nota.id_notas',
                'nota.id_clasificacion',
                'nota.clave_nota',
                'nota.punto_proceso',
                'nota.resultado',
                'nota.observaciones',

                'agenda.id_auditoria as id_auditoria_origen',
                'auditoria_origen.fecha_i as fecha_i_origen',
                'auditoria_origen.fecha_f as fecha_f_origen',

                'plan.id_plan_acciones',
                'plan.acciones',
                'plan.estado as estado_plan',
                'plan.fecha_implantar_accion',
                'plan.fecha_verificacion',

                'seg_accion.id_seguimiento_accion',
                'seg_accion.estado_cumplimiento',
                'seg_accion.nota_seguimiento',
                'seg_accion.fecha_revision',

                DB::raw("CASE WHEN nota.id_clasificacion = 1 THEN 'NC' WHEN nota.id_clasificacion = 2 THEN 'OM' ELSE 'Nota' END AS tipo_hallazgo"),
                DB::raw("CASE
                    WHEN seg_accion.estado_cumplimiento = 1 THEN 'Cumplió'
                    WHEN seg_accion.estado_cumplimiento = 2 THEN 'Cumplimiento parcial'
                    WHEN seg_accion.estado_cumplimiento = 3 THEN 'No cumplió'
                    WHEN seg_accion.estado_cumplimiento = 0 THEN 'Sin revisar'
                    ELSE 'Sin seguimiento'
                END AS estado_cumplimiento_texto")
            )
            ->orderBy('auditoria_origen.fecha_i', 'asc')
            ->orderBy('agenda.id_auditoria', 'asc')
            ->orderBy('nota.id_clasificacion', 'asc')
            ->orderBy('nota.clave_nota', 'asc')
            ->orderBy('plan.fecha_implantar_accion', 'asc');

        return $consulta->get();
    }

    private function obtenerAuditoriaAnterior($auditoriaActual)
    {
        if (!empty($auditoriaActual->fecha_i)) {
            $auditoriaAnterior = DB::table('aud_auditoria')
                ->where(function ($query) use ($auditoriaActual) {
                    $query->where('fecha_i', '<', $auditoriaActual->fecha_i)
                        ->orWhere(function ($q) use ($auditoriaActual) {
                            $q->where('fecha_i', '=', $auditoriaActual->fecha_i)
                                ->where('id_auditoria', '<', $auditoriaActual->id_auditoria);
                        });
                })
                ->orderBy('fecha_i', 'desc')
                ->orderBy('id_auditoria', 'desc')
                ->first();

            if ($auditoriaAnterior) {
                return $auditoriaAnterior;
            }
        }

        return DB::table('aud_auditoria')
            ->where('id_auditoria', '<', $auditoriaActual->id_auditoria)
            ->orderBy('id_auditoria', 'desc')
            ->first();
    }
}
