<?php

namespace App\Exports;

use App\Carreras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;

class Estudiantes_multiplesExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets=[];
       $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera NOT IN (9, 11, 15,16, 17) ORDER BY id_carrera');

        foreach ($carreras as $carrera)
        {
            $sheets[]=new Estudiantes_inscritosExport($carrera);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
