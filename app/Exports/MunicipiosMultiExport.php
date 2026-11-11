<?php

namespace App\Exports;

use App\Carreras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Session;
class MunicipiosMultiExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets=[];
        $carreras=Carreras::all();

        foreach ($carreras as $carrera)
        {
            $sheets[]=new MunicipiosExport($carrera);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
