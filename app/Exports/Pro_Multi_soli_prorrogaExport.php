<?php

namespace App\Exports;

use App\Exports\Pro_solicitud_prorrogaExport;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Pro_Multi_soli_prorrogaExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

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
            $sheets[]=new Pro_solicitud_prorrogaExport($carrera);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
