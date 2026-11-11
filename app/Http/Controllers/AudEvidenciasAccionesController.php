<?php

namespace App\Http\Controllers;

use App\AudEvidenciasAcciones;
use Illuminate\Http\Request;

class AudEvidenciasAccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('auditorias.evidencias_acciones');
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
     * @param  \App\AudEvidenciasAcciones  $audEvidenciasAcciones
     * @return \Illuminate\Http\Response
     */
    public function show(AudEvidenciasAcciones $audEvidenciasAcciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudEvidenciasAcciones  $audEvidenciasAcciones
     * @return \Illuminate\Http\Response
     */
    public function edit(AudEvidenciasAcciones $audEvidenciasAcciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudEvidenciasAcciones  $audEvidenciasAcciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudEvidenciasAcciones $audEvidenciasAcciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudEvidenciasAcciones  $audEvidenciasAcciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudEvidenciasAcciones $audEvidenciasAcciones)
    {
        //
    }
}
