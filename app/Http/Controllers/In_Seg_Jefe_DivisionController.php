<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class In_Seg_Jefe_divisionController extends Controller
{
    public function index()
    {
        $periodo_ingles = Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');
        $id_carrera = Session::get('carrera');

        $semestres = DB::table('gnral_semestres')
            ->select('id_semestre', 'descripcion')
            ->get();

        $alumnos = DB::table('gnral_alumnos as a')

            // semestre
            ->join('gnral_semestres as s', 's.id_semestre', '=', 'a.id_semestre')

            // carga de inglés (TABLA EJE)
            ->join('in_carga_academica_ingles as ci', function ($join) use ($periodo_ingles) {
                $join->on('ci.id_alumno', '=', 'a.id_alumno')
                    ->where('ci.id_periodo_ingles', $periodo_ingles);
            })

            // nivel (DEPENDIENTE DE CI)
            ->join('in_niveles_ingles as ni', 'ni.id_niveles_ingles', '=', 'ci.id_nivel')

            // validación de periodo escolar
            ->join('eva_validacion_de_cargas as ca', function ($join) use ($periodo) {
                $join->on('ca.id_alumno', '=', 'a.id_alumno')
                    ->where('ca.id_periodo', $periodo);
            })

            ->where('a.id_carrera', $id_carrera)

            ->select(
                'a.id_alumno',
                'a.cuenta',
                'a.nombre',
                'a.apaterno',
                'a.amaterno',
                'a.id_semestre',

                // inglés
                'ni.descripcion as nivel',
                'ci.id_grupo'
            )

            ->distinct()
            ->get();

        return view(
            'jefe_carrera.ingles.seguimiento_estudiantes_ingles',
            compact('semestres', 'alumnos')
        );
    }


}