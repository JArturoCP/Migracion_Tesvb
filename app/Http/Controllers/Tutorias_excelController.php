<?php

namespace App\Http\Controllers;

use App\Exports\EdadesMultiExport;
use App\Exports\Tutorias_carreras_export;
use App\Exports\Tutorias_carrerasMulti_export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Tutorias_excelController extends Controller
{
    public function excel_carrera($id_carrera){
        $carreras = DB::selectOne('SELECT *FROM gnral_carreras car WHERE car.id_carrera = '.$id_carrera.' ');

        return Excel::download(new Tutorias_carrerasMulti_export($carreras), 'Carreras_tutorias.xlsx');

    }
}
