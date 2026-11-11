<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\in_desempeno_academico_ingles;

class In_Excel_Desem_Aca extends Controller
{
    public function in_concentrado_cal_ingles($id_nivel,$id_grupo,$id_carrera)
    {
        return Excel::download(new in_desempeno_academico_ingles($id_nivel,$id_grupo,$id_carrera), 'ingles_concentrado_cal_ingles.xlsx');
    }
}
