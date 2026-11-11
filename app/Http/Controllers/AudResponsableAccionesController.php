<?php

namespace App\Http\Controllers;

use App\AudAgenda;
use App\AudAuditorAuditoria;
use App\AudAuditores;
use App\AudAuditoriaProceso;
use App\AudAuditorias;
use App\AudInforme;
use App\AudNota;
use App\AudProgramas;
use App\AudReporte;
use App\GnralPersonales;
use App\AudResponsableAcciones;
use App\ri_proceso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\CarbonPeriod;

class AudResponsableAccionesController extends Controller
{

    public function index()
    {

        $programas = AudProgramas::orderBy('fecha_i','ASC')->get();
        $auditorias = AudAuditorias::query()
            ->select('aud_auditoria.*')
            ->selectRaw("
        CONCAT(
            YEAR(aud_auditoria.created_at),
            '-',
            ROW_NUMBER() OVER (
                PARTITION BY YEAR(aud_auditoria.created_at)
                ORDER BY aud_auditoria.created_at ASC, aud_auditoria.id_auditoria ASC
            )
        ) AS no_auditoria
    ")
            ->orderBy('aud_auditoria.created_at', 'asc')
            ->orderBy('aud_auditoria.id_auditoria', 'asc')
            ->get();
        $esLider=false;
        return view("auditorias.seguimiento",compact('programas','esLider','auditorias'));

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
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_personal' => 'required',
            'id_notas' => 'required',
        ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(AudResponsableAcciones::where('id_personal', $request->id_personal)->where('id_notas', $request->id_notas)->count()==0)
        AudResponsableAcciones::create([
            'id_personal' => $request->id_personal,
            'id_notas' => $request->id_notas,
        ]);


        return redirect()->back()->withSuccess('success','Registro exitoso!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::put('id_programa',$id);
        $programas=AudProgramas::get()->where('id_programa',$id);
        $esLider=false;
        if ($idLider = AudAuditores::where('id_categoria',1)->get()[0]->id_personal==Session::get('id_perso'))
            $esLider=true;

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
        $noConformidad=AudInforme::getDatosInformeSeguimiento($id,1);
        //dd($noConformidad);
        $fortalezas=AudInforme::getDatosInformeSeguimiento($id,5);
        $oportunidades=AudInforme::getDatosInformeSeguimiento($id,2);
        //dd($oportunidades);
        //$responsables = AudReporte::getDatosInformeSeguimiento($id,1);

        // Contadores de asignaciones
        $totalRegistros = count($noConformidad) + count($oportunidades);
        $asignados = 0;

        foreach ([$noConformidad, $fortalezas, $oportunidades] as $categoria) {
            foreach ($categoria as $registro) {
                if ($registro->getResponsables($registro->id_notas)->count() > 0) {
                    $asignados++;
                }
            }
        }






     //   dd($noConformidad);

        // return view('auditorias.ver_programa',compact('programas','objetivos','esLider'));
        return view('auditorias.seguimiento_informe',compact('programas','esLider','fortalezas','oportunidades','auditoria_id','auditorias','lider','equipo','entrenados','informe','personas','id','noConformidad', 'asignados', 'totalRegistros'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('id_programa',$id);
        $programas=AudProgramas::get()->where('id_programa',$id);
        $auditorias=AudAuditorias::orderBy('fecha_i','ASC')->where('id_programa',$id)->get();
        $procesos =ri_proceso::orderBy('clave','ASC')->orderBy('des_proceso','ASC')->get();

        $procesosEnAgenda=AudAuditoriaProceso::join('aud_auditoria','aud_auditoria_proceso.id_auditoria','=','aud_auditoria.id_auditoria')
            ->join('ri_proceso','aud_auditoria_proceso.id_proceso','=','ri_proceso.id_proceso')
            // ->where('ri_proceso.id_proceso',"<>",44) //para ignorar proceso de audiotiras internas
            ->where('aud_auditoria.id_programa',$id)
            ->where('aud_auditoria_proceso.deleted_at','=',NULL)
            ->where('aud_auditoria.deleted_at','=',NULL)
            ->select('aud_auditoria_proceso.id_proceso')
            ->orderBy('aud_auditoria_proceso.id_proceso')
            ->get()->pluck('id_proceso')->unique()->toArray();

        $porcentaje=round((sizeof($procesosEnAgenda)*100)/(sizeof($procesos)-1),0);// -1 para ignorar el proceso de auditorias internas

        //  dd($porcentaje);

        $porcentaje=$porcentaje>=100?'100':$porcentaje;
        $esLider=false;
        if ($idLider = AudAuditores::where('id_categoria',1)->get()[0]->id_personal==Session::get('id_perso'))
            $esLider=true;$idLider = AudAuditores::where('id_categoria',1)->get()[0];
        return view('auditorias.procesos_auditoria',compact('programas','esLider','auditorias','procesos','procesosEnAgenda','porcentaje'));


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
        $validator = Validator::make($request->all(), [
            'numero_dias' => 'required|date|after_or_equal:today',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    $auditoria_id = $id;

    $fechaHoy = Carbon::today();
    $fechaLimite = Carbon::parse($request->numero_dias);
    //$numeroDias = $fechaHoy->diffInDays($fechaLimite);

    // Crear un periodo entre hoy y la fecha límite
    $periodo = CarbonPeriod::create($fechaHoy, $fechaLimite);

    // Contar solo días hábiles (lunes a viernes)
    $diasHabiles = collect($periodo)->filter(function ($fecha) {
        return !$fecha->isWeekend(); // Excluye sábados y domingos
    })->count();

    $id_notas=AudAgenda::join("aud_reportes","aud_reportes.id_agenda","aud_agenda.id_agenda")
        ->join("aud_notas","aud_notas.id_reporte","aud_reportes.id_reporte")
        ->where("aud_agenda.id_auditoria",$auditoria_id)
        ->whereIn("aud_notas.id_clasificacion", [1, 2])
        ->whereIn("aud_notas.id_clasificacion",[1,2])
        ->pluck("aud_notas.id_notas");

        AudNota::whereIn("id_notas",$id_notas)
            ->update([
                "dias"=>$diasHabiles-1
            ]);


    AudAuditorias::where('id_auditoria', $auditoria_id)->update(['asignado' => 1]);



    return redirect()->back()->with('success', 'La auditoría ha sido enviada exitosamente.');

    }
    public function updateMultiple(Request $request, $auditoria_id)
    {
        //dd($request->all());
        $request->validate([
            'numero_dias' => 'required|date|after_or_equal:today',
            'responsables' => 'required|array',
        ]);

        $fechaHoy = Carbon::today();
        $fechaLimite = Carbon::parse($request->numero_dias);

        // Calcular días hábiles
        $diasHabiles = collect(CarbonPeriod::create($fechaHoy, $fechaLimite))
            ->filter(fn($fecha) => !$fecha->isWeekend())
            ->count();

        // Actualizar responsables
        /*foreach ($request->responsables as $id_notas => $responsables) {
            foreach ($responsables as $id_personal) {
                AudResponsableAcciones::updateOrCreate(
                    ['id_notas' => $id_notas, 'id_personal' => $id_personal],
                    []
                );
            }
        }

        // Actualizar días hábiles en notas
        AudNota::whereIn('id_notas', array_keys($request->responsables))
            ->update(['dias' => $diasHabiles]);

        // Marcar auditoría como asignada
        AudAuditorias::where('id_auditoria', $auditoria_id)->update(['asignado' => 1]);*/
        // Si se mandan responsables, hacer asignación normal
        if ($request->has('responsables')) {
            $request->validate([
                'responsables' => 'required|array',
            ]);

            foreach ($request->responsables as $id_notas => $responsables) {
                foreach ($responsables as $id_personal) {
                    AudResponsableAcciones::updateOrCreate(
                        ['id_notas' => $id_notas, 'id_personal' => $id_personal],
                        []
                    );
                }
            }

            // Actualizar días hábiles en esas notas
            AudNota::whereIn('id_notas', array_keys($request->responsables))
                ->update(['dias' => $diasHabiles]);

            // Marcar como asignada
            AudAuditorias::where('id_auditoria', $auditoria_id)->update(['asignado' => 1]);


            return redirect()->back()->with('success', 'Asignaciones y plazo guardados correctamente.');
        }
        // Si no hay responsables, es solo edición de días
        $idsNotasAsignadas = AudResponsableAcciones::pluck('id_notas')->unique()->toArray();

        AudNota::whereIn('id_notas', $idsNotasAsignadas)->update(['dias' => $diasHabiles-1]);

        return redirect()->back()->with('success', 'Días hábiles actualizados correctamente.');
    }

    /*public function editarFechaDias(Request $request, $auditoria_id)
    {
        $request->validate([
            'numero_dias' => 'required|date|after_or_equal:today',
        ]);

        $fechaHoy = Carbon::today();
        $fechaNueva = Carbon::parse($request->numero_dias);

        // Calcular días hábiles
        $diasHabiles = collect(CarbonPeriod::create($fechaHoy, $fechaNueva))
            ->filter(fn($fecha) => !$fecha->isWeekend())
            ->count();

        // Obtener los id_notas que ya tienen responsables asignados
        $idsNotasAsignadas = AudResponsableAcciones::pluck('id_notas')
            ->unique()
            ->toArray();

        // Actualizar solo esas notas
        AudNota::whereIn('id_notas', $idsNotasAsignadas)->update(['dias' => $diasHabiles]);

        return redirect()->back()->with('success', 'Fecha y días hábiles actualizados correctamente.');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AudResponsableAcciones::destroy($id);
        return redirect()->back()->with('success', 'El registro se elimino de manera exitosa');
    }


}
