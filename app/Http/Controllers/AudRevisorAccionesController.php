<?php

namespace App\Http\Controllers;

use App\AudPlanAccion;
use Illuminate\Http\Request;
use App\AudRevisorAcciones;
use App\Gnral_Personales;
use App\AudResponsableAcciones;
use Illuminate\Support\Facades\Session;

class AudRevisorAccionesController extends Controller
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
        $responsables = AudResponsableAcciones::where('estado', 6)->get();
        $personales = Gnral_Personales::orderBy('nombre')->get();
        $asignaciones = AudRevisorAcciones::all()->keyBy('id_responsable');

        return view('auditorias.asignar_acciones', compact('responsables', 'personales', 'asignaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_responsable' => 'required|exists:audresponsable_acciones,id_responsable',
            'id_personal' => 'required|exists:gnral_personales,id_personal',
        ]);

        AudRevisorAcciones::create([
            'id_responsable' => $request->id_responsable,
            'id_personal' => $request->id_personal,
        ]);

        return redirect()->route('auditorias.asignar_acciones')->with('success', 'Revisor asignado correctamente.');
    }

    public function revisarAcciones()
    {
        $id_personal = Session::get("id_perso");

        $asignaciones = AudRevisorAcciones::with('responsable')
            ->where('id_personal', $id_personal)
            ->get();
        //dd($asignaciones);

        return view('auditorias.revisar_acciones', compact('asignaciones'));
    }

    public function evaluarAccion(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required',
            'observaciones' => 'nullable|string',
        ]);

        $accion = AudResponsableAcciones::findOrFail($id);
        $accion->estado = $request->estado;

        if ($request->estado == 5 && $request->has('observaciones')) {
            $accion->observaciones = $request->observaciones;

            AudPlanAccion::where('id_responsable', $id)->delete();
        }

        $accion->save();

        return back()->with('success', 'Evaluación guardada correctamente.');
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
        $asignacion = AudRevisorAcciones::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('auditorias.asignar_acciones')->with('success', 'Asignación eliminada correctamente.');
    }
}
