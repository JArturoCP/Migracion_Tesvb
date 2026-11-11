<?php

namespace App\Exports;

use App\Carreras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;

class EdadesMultiExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets=[];
        $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera NOT IN (9, 11, 15,16, 17) ORDER BY id_carrera');

        foreach ($carreras as $carrera)
        {
            $sheets[]=new EdadesExport($carrera);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
