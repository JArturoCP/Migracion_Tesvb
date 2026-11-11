<?php

namespace App\Http\Controllers;

use App\AudAuditorAuditoria;
use App\AudAuditores;
use App\AudAuditorias;
use App\AudInforme;
use App\GnralPersonales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AudInformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $informe=AudInforme::where('id_auditoria',$id)->get();
        if($informe->count()==0)
            $informe=AudInforme::create(["id_auditoria"=>$id]);
        else
            $informe=$informe->first();


        Session::forget(['auditorUsed','dateUsed']);
        $fecha=AudAuditorias::where('id_auditoria',$id)->get()->pluck('id_programa');
        $auditorias=AudAuditorias::orderBy('fecha_i','ASC')->where('id_programa',$fecha)->get();
        $auditoria_id=$id;
        $lider=AudAuditorAuditoria::where('id_auditoria',$id)->where('id_categoria','1')->get();
        $equipo=AudAuditorAuditoria::where('id_auditoria',$id)->where('id_categoria','2')->get();
        $entrenados=AudAuditorAuditoria::where('id_auditoria',$id)->where('id_categoria','3')->get();
        $personas=GnralPersonales::orderBy('nombre')->get();


        $procesosE=DB::table('ri_proceso')
            ->join('aud_auditoria_proceso','aud_auditoria_proceso.id_proceso','=','ri_proceso.id_proceso')
            ->where('aud_auditoria_proceso.id_auditoria','=',$id)
            ->where('aud_auditoria_proceso.deleted_at','=',NULL)
            ->select('aud_auditoria_proceso.id_auditoria_proceso','ri_proceso.clave','ri_proceso.des_proceso')
            ->orderBy('ri_proceso.clave','ASC')
            ->orderBy('ri_proceso.des_proceso','ASC')
            ->get();

        // no existe $auditEx
        $auditoresEx=null;
        $esLider=false;
        if ($idLider = AudAuditores::where('id_categoria',1)->get()[0]->id_personal==Session::get('id_perso'))
            $esLider=true;$idLider = AudAuditores::where('id_categoria',1)->get()[0];

        $personas=AudInforme::getPersonas($id);
        $noConformidad=AudInforme::getDatosInforme($id,1);
        $fortalezas=AudInforme::getDatosInforme($id,5);
        $oportunidades=AudInforme::getDatosInforme($id,2);
        /*
         * Se conserva sin cambios el funcionamiento original del informe.
         */
        $seguimientoAcciones=AudInforme::getDatosInforme($id,4);

        /*
         * Se anexan las NC/OM históricas que deben continuar en seguimiento.
         * La consulta nueva no sustituye ni modifica los datos originales.
         */
        $seguimientoHistorico=$this->obtenerSeguimientoAcciones($id);
        $seguimientoAcciones=collect($seguimientoAcciones)
            ->concat($seguimientoHistorico)
            ->values();

        //dd($personas);
        return view('auditorias.informe',compact('auditorias','auditoria_id','lider','equipo',
            'personas','informe','noConformidad','fortalezas','oportunidades','seguimientoAcciones',
            'entrenados','personas','procesosE','esLider'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $informe=AudInforme::find($id);
        //dd($request->all());
        $informe->update([$request->field=>$request->value]);
        //  dd($informe);
        return redirect()->back();
    }

    /**
     * Obtiene las acciones que deben mostrarse en el informe consultado.
     *
     * Reglas:
     * - Sólo considera auditorías anteriores del mismo programa.
     * - Muestra acciones marcadas en verde para integrar al informe.
     * - Las notas sin plan se muestran con la leyenda predeterminada.
     * - Las acciones marcadas en rojo se excluyen del informe.
     */
    private function obtenerSeguimientoAcciones($idAuditoriaActual)
    {
        $auditoriaActual=DB::table('aud_auditoria')
            ->where('id_auditoria',$idAuditoriaActual)
            ->first();

        if(!$auditoriaActual)
            return collect();

        $subUltimaRevision='(
            SELECT
                id_plan_acciones,
                MAX(id_seguimiento_accion) AS id_ultima_revision
            FROM aud_seguimiento_acciones
            WHERE deleted_at IS NULL
            GROUP BY id_plan_acciones
        ) AS ultima_revision';

        $consulta=DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota','nota.id_notas','=','acc.id_notas')
            ->join('aud_reportes as reporte','reporte.id_reporte','=','nota.id_reporte')
            ->join('aud_agenda as agenda','agenda.id_agenda','=','reporte.id_agenda')
            ->join('aud_auditoria as auditoria_origen','auditoria_origen.id_auditoria','=','agenda.id_auditoria')
            ->leftJoin('gnral_personales as responsable','responsable.id_personal','=','acc.id_personal')
            ->leftJoin('aud_plan_acciones as plan',function($join){
                $join->on('plan.id_responsable','=','acc.id_responsable')
                    ->whereNull('plan.deleted_at');
            })
            ->leftJoin(DB::raw($subUltimaRevision),function($join){
                $join->on('ultima_revision.id_plan_acciones','=','plan.id_plan_acciones');
            })
            ->leftJoin('aud_seguimiento_acciones as seg_accion',function($join){
                $join->on('seg_accion.id_seguimiento_accion','=','ultima_revision.id_ultima_revision')
                    ->whereNull('seg_accion.deleted_at');
            })
            ->whereNull('acc.deleted_at')
            ->where(function($integracion){
                $integracion->where(function($conPlan){
                    $conPlan->whereNotNull('plan.id_plan_acciones')
                        ->where('plan.integrar_informe',1);
                })->orWhere(function($sinPlan){
                    $sinPlan->whereNull('plan.id_plan_acciones')
                        ->where('acc.integrar_informe',1);
                });
            })
            ->whereIn('nota.id_clasificacion',[1,2]);

        if(is_null($auditoriaActual->id_programa))
            $consulta->whereNull('auditoria_origen.id_programa');
        else
            $consulta->where('auditoria_origen.id_programa',$auditoriaActual->id_programa);

        $consulta->where(function($query) use ($auditoriaActual,$idAuditoriaActual){
            if(!empty($auditoriaActual->fecha_i))
            {
                $query->where('auditoria_origen.fecha_i','<',$auditoriaActual->fecha_i)
                    ->orWhere(function($q) use ($auditoriaActual,$idAuditoriaActual){
                        $q->where('auditoria_origen.fecha_i','=',$auditoriaActual->fecha_i)
                            ->where('agenda.id_auditoria','<',$idAuditoriaActual);
                    });
            }
            else
                $query->where('agenda.id_auditoria','<',$idAuditoriaActual);
        });

        return $consulta
            ->select(
                'acc.id_responsable',
                'acc.id_personal',
                'acc.estado_cierre',
                'acc.integrar_informe as integrar_informe_nota',
                'responsable.nombre as responsable_asignado',
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
                'plan.acciones as accion',
                'plan.estado as estado_plan',
                'plan.integrar_informe',
                'plan.fecha_implantar_accion',
                'plan.fecha_verificacion',
                'seg_accion.id_seguimiento_accion',
                DB::raw("CASE
                    WHEN plan.id_plan_acciones IS NULL THEN 3
                    ELSE seg_accion.estado_cumplimiento
                END AS estado_cumplimiento"),
                'seg_accion.nota_seguimiento',
                'seg_accion.nota_seguimiento as ultima_nota',
                'seg_accion.fecha_revision',
                DB::raw("CASE
                    WHEN plan.id_plan_acciones IS NULL THEN 'No se registraron acciones en el procedimiento de No Conformidades y Acciones Correctivas'
                    ELSE seg_accion.nota_seguimiento
                END AS seguimiento_informe"),
                DB::raw("CASE WHEN nota.id_clasificacion=1 THEN 'NC' WHEN nota.id_clasificacion=2 THEN 'OM' ELSE 'Nota' END AS tipo_hallazgo"),
                DB::raw("CASE
                    WHEN plan.id_plan_acciones IS NULL THEN 'Sin cumplimiento'
                    WHEN seg_accion.estado_cumplimiento=1 THEN 'Concluido'
                    WHEN seg_accion.estado_cumplimiento=2 THEN 'En proceso'
                    WHEN seg_accion.estado_cumplimiento=3 THEN 'Sin cumplimiento'
                    WHEN seg_accion.estado_cumplimiento=0 THEN 'Sin revisar'
                    ELSE 'Sin revisar'
                END AS estado_cumplimiento_texto")
            )
            ->orderBy('auditoria_origen.fecha_i','ASC')
            ->orderBy('nota.clave_nota','ASC')
            ->orderBy('plan.fecha_implantar_accion','ASC')
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
