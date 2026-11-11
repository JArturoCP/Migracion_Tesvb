<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Beca_Multi_cincuentaExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
    public function sheets(): array
    {
        $sheets=[];
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();

        foreach ($carreras as $carrera)
        {
            $sheets[]=new Beca_cincuentaExport($carrera);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
