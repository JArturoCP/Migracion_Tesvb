<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AudAuditorNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_personal = Session::get("id_perso");

        // Verifica si el usuario es auditor líder
        $esLider = DB::table('aud_auditores')
            ->where('id_personal', $id_personal)
            ->where('id_categoria', 1) // 1 = Auditor Líder
            ->exists();

        $query = DB::table('audresponsable_acciones as acc')
            ->join('aud_notas as nota', 'nota.id_notas', '=', 'acc.id_notas')
            ->join('aud_reportes as r', 'r.id_reporte', '=', 'nota.id_reporte')
            ->join('aud_agenda as a', 'a.id_agenda', '=', 'r.id_agenda')
            ->join('aud_agenda_auditor as aa', 'aa.id_agenda', '=', 'a.id_agenda')
            ->join('aud_auditor_auditoria as auau', 'auau.id_auditor_auditoria', '=', 'aa.id_auditor_auditoria')
            ->join('gnral_personales as gp', 'gp.id_personal', '=', 'auau.id_personal')
            ->whereIn('acc.estado', [3, 4, 5])
            ->select(
                'acc.*',
                'nota.clave_nota',
                'nota.punto_proceso',
                'nota.observaciones',
                'gp.nombre as auditor_nombre',
                'a.id_agenda',
                'a.fecha as fecha_agenda',
                'a.hora_i',
                'a.hora_f',
                'aa.id_agenda_auditor',
                DB::raw('
                    (
                        SELECT 
                            CASE 
                                WHEN COUNT(*) > 0 
                                     AND SUM(IF(estado = 1, 1, 0)) = COUNT(*) 
                                THEN 1 
                                ELSE 0 
                            END
                        FROM aud_plan_acciones 
                        WHERE aud_plan_acciones.id_responsable = acc.id_responsable
                          AND aud_plan_acciones.deleted_at IS NULL
                    ) AS todas_aceptadas
                ')
            );

        // Si no es líder, solo ve sus propias notas
        if (!$esLider) {
            $query->where('auau.id_personal', $id_personal);
        }

        $acciones = $query->distinct()->get();

        foreach ($acciones as $a) {
            $a->auditores_permitidos = DB::table('aud_auditor_auditoria as auau')
                ->join('gnral_personales as gp', 'gp.id_personal', '=', 'auau.id_personal')
                ->join('aud_auditoria as aud', 'aud.id_auditoria', '=', 'auau.id_auditoria')
                ->join('aud_agenda as age', 'age.id_auditoria', '=', 'aud.id_auditoria')
                ->where('age.id_agenda', $a->id_agenda)
                ->select('gp.id_personal', 'gp.nombre')
                ->orderBy('gp.nombre')
                ->get();
        }

        return view('auditorias.auditor_nota', compact('acciones','esLider'));
    }

    public function actualizarResponsable(Request $request)
    {
        $request->validate([
            'id_agenda_auditor' => 'required|integer',
            'nuevo_responsable' => 'required|integer' // id_personal
        ]);

        // 1. Obtener la agenda
        $agendaAuditor = DB::table('aud_agenda_auditor')
            ->where('id_agenda_auditor', $request->id_agenda_auditor)
            ->first();

        if (!$agendaAuditor) {
            return redirect()->back()->with('error', 'Registro de agenda no encontrado');
        }

        // 2. Obtener la auditoría a la que pertenece esta agenda
        $agenda = DB::table('aud_agenda')
            ->where('id_agenda', $agendaAuditor->id_agenda)
            ->first();

        if (!$agenda) {
            return redirect()->back()->with('error', 'Agenda no encontrada');
        }

        // 3. Verificar que el nuevo responsable SÍ sea un auditor asignado a esa auditoría
        $auditor = DB::table('aud_auditor_auditoria')
            ->where('id_auditoria', $agenda->id_auditoria)
            ->where('id_personal', $request->nuevo_responsable)
            ->whereNull('deleted_at')
            ->first();

        if (!$auditor) {
            return redirect()->back()->with('error', 'El nuevo responsable no pertenece al equipo auditor de esta auditoría');
        }

        // 4. Actualizar correctamente
        DB::table('aud_agenda_auditor')
            ->where('id_agenda_auditor', $request->id_agenda_auditor)
            ->update([
                'id_auditor_auditoria' => $auditor->id_auditor_auditoria,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Auditor responsable actualizado correctamente');
    }

    /*public function evaluar(Request $request)
    {
        $request->validate([
            'id_responsable' => 'required|integer|exists:audresponsable_acciones,id_responsable',
            'estado' => 'required|in:4,5', // 4 = aceptado, 5 = rechazado
        ]);

        DB::table('audresponsable_acciones')
            ->where('id_responsable', $request->id_responsable)
            ->update(['estado' => $request->estado]);

        return redirect()->back()->with('success', 'Evaluación registrada correctamente.');
    }*/

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
        //
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
        //
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
