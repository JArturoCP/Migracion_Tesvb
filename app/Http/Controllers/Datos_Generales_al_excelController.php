<?php

namespace App\Http\Controllers;

use App\Carreras;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Datos_alumnExport;
use App\Exports\Estudiantes_multiplesExport;
use App\Exports\EdadesMultiExport;
use App\Exports\MultiExport;
use App\Exports\MunicipiosMultiExport;


class Datos_Generales_al_excelController extends Controller
{
    public function export()
    {


        //   ini_set('max_execution_time', 300);

        return Excel::download(new MultiExport, 'Datos_Generales_excel.xlsx');
    }

    public function exportAlumnos()
    {
        return Excel::download(new Estudiantes_multiplesExport, 'Datos_Generales_estadisticos.xlsx');
    }
    public function exportMunicipios(){
        return Excel::download(new MunicipiosMultiExport, 'Datos_Municipio_estadisticos.xlsx');
    }
    public function exportEdades(){
        return Excel::download(new EdadesMultiExport, 'Datos_Edades_estadisticos.xlsx');
    }
}

