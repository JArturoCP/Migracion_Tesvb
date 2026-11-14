<?php

namespace App\Http\Controllers;

use App\gnral_unidad_administrativa;
use App\SgcAgenda;
use App\SgcAsignaAudi;
use App\SgcAuditorias;
use App\GnralPersonales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SgcAgendaController extends Controller
{
    private $horas_f=[];
    /**
     * Display a listing of the resource.
     *php
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
        $this->validate($request,[
            'inicio' => 'required',
            'fin' => 'required',
            'area' => 'required',
            'procesos' => 'required'
        ]);
        $evento= array(
            'hora_i' => mb_strtoupper($request->get('inicio'),'utf-8'),
            'hora_f' => mb_strtoupper($request->get('fin'),'utf-8'),
            'fecha' => Session::get('dateUsed'),
            'id_area' => mb_strtoupper($request->get('area'),'utf-8'),
            'procesos' => mb_strtoupper($request->get('procesos'),'utf-8'),
            'id_asigna_audi' => mb_strtoupper($request->get('auditor'),'utf-8'),
        );
        SgcAgenda::create($evento);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // El módulo SGC heredado se sustituyó por el de auditorías (aud_agenda ya no tiene id_asigna_audi).
        return redirect('/auditorias/agenda/'.$id);
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
        Session::put('dateUsed',$id);
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

    public function setAuditor(Request $request){
        abort(501, 'Funcionalidad no disponible.');
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date) {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            if(!$date->isSaturday() && !$date->isSunday())
                $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    private function generateTimeRange(Carbon $start_hour, Carbon $end_hour) {
        for($hour = $start_hour; $hour->lte($end_hour); $hour->addMinute('30')) {
            $hours = [];
            $hours [] = $hour->format('H');
            $hours[]=$hour->format('i');
            $this->horas_f[]=$hours;
        }
    }
}
