<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\AudPlanAccion;
use App\GnralPersonales;
use Illuminate\Http\Request;

class AudSeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_personal = Session::get('id_perso');
        //dd($id_personal);

        $acciones = AudPlanAccion::leftJoin('aud_evidencias', 'aud_plan_acciones.id_evidencia', '=', 'aud_evidencias.id_evidencia')
            ->join('audresponsable_acciones', 'aud_plan_acciones.id_responsable', '=', 'audresponsable_acciones.id_responsable')
            ->where('aud_plan_acciones.id_responsable_implantar', $id_personal)
            ->where('audresponsable_acciones.estado', 6) //ANTES ERA 4 LO PONGO POR SI ACASO EL DR ABNER CAMBIA DE OPINION
            ->select(
                'aud_plan_acciones.*',
                'aud_evidencias.descripcion as medio_verificacion'
            )
            ->get();
        //dd($acciones);

        return view('auditorias.responsables_implantar', compact('acciones'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'path_evidencia' => 'required|mimes:pdf|max:20480', // Max 20MB
        ]);

        $file = $request->file('path_evidencia');

        $path = $file->store('aud_evidencias', 'public');

        $accion = AudPlanAccion::findOrFail($id);
        $accion->path_evidencia = $path;

        // Registrar la fecha actual como fecha_planeada
        $accion->fecha_planeada = now()->format('Y-m-d');

        if ($accion->estado == 2) {
            $accion->estado = 3; // Cambiar estado a "Regresado con cambios"
        }
        $accion->save();
        //dd($request->all());

        return back()->with('success', 'Evidencia subida correctamente.');
    }

    public function downloadEvidencia($id)
    {
        $accion = AudPlanAccion::findOrFail($id);

        $pathToFile = storage_path('app/public/' . $accion->path_evidencia);

        if (!file_exists($pathToFile)) {
            return redirect()->back()->with('error', 'El archivo no se encuentra disponible.');
        }

        return response()->download($pathToFile);
    }

    public function revisar()
    {
        $id_personal = Session::get('id_perso');

        $acciones = AudPlanAccion::leftJoin('aud_evidencias', 'aud_plan_acciones.id_evidencia', '=', 'aud_evidencias.id_evidencia')
            ->join('audresponsable_acciones', 'aud_plan_acciones.id_responsable', '=', 'audresponsable_acciones.id_responsable')
            ->where('aud_plan_acciones.id_responsable_revisar', $id_personal)
            ->where('audresponsable_acciones.estado', 6) //ANTES ERA 4 LO PONGO POR SI ACASO EL DR ABNER CAMBIA DE OPINION
            ->select(
                'aud_plan_acciones.*',
                'aud_evidencias.descripcion as medio_verificacion'
            )
            ->get();

        return view('auditorias.responsables_revisar', compact('acciones'));
    }

    public function evaluar(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required',
            'observaciones' => 'required_if:estado,2|max:500',
        ]);

        $accion = AudPlanAccion::findOrFail($id);
        $accion->estado = $request->estado;
        if ($request->estado == 2) {
            $accion->observaciones = $request->observaciones;
        }
        $accion->save();

        return back()->with('success', 'Evaluación registrada correctamente.');
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
