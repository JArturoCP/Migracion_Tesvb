<?php

namespace App\Http\Controllers;

use App\AudReporteEvidencia;
use Illuminate\Http\Request;

class AudReporteEvidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/auditorias/programas');
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
     * @param  \App\AudReporteEvidencia  $audReporteEvidencia
     * @return \Illuminate\Http\Response
     */
    public function show(AudReporteEvidencia $audReporteEvidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudReporteEvidencia  $audReporteEvidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(AudReporteEvidencia $audReporteEvidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudReporteEvidencia  $audReporteEvidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudReporteEvidencia $audReporteEvidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudReporteEvidencia  $audReporteEvidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudReporteEvidencia $audReporteEvidencia)
    {
        //
    }
}
