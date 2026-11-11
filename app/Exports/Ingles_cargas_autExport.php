<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;
class Ingles_cargas_autExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $periodo_ingles=Session::get('periodo_ingles');
        $periodo_ingles=Session::get('periodo_ingles');
        $alumnos = DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->where('in_carga_academica_ingles.id_periodo_ingles','=',$periodo_ingles)
            ->where('in_validar_carga.id_periodo','=',$periodo_ingles)
            ->where('in_validar_carga.id_estado','=',2)
            ->select('gnral_alumnos.id_alumno','gnral_alumnos.cuenta','gnral_alumnos.nombre','gnral_alumnos.apaterno','gnral_alumnos.amaterno','in_validar_carga.*','in_carga_academica_ingles.*','in_niveles_ingles.descripcion as nivel_ingles','in_grupo_ingles.descripcion as grupo_ingles','gnral_alumnos.genero','gnral_semestres.descripcion as semestre','gnral_carreras.nombre as carrera')
            ->get();

        return view('ingles.departamento.exportar_cargas_aut',compact('alumnos'));
    }
}
