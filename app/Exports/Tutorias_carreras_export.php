<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;
class Tutorias_carreras_export implements FromArray, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $grupo;
    protected  $id_asigna_generacion;


    public function __construct($tutor){
        //dd($carreras);
        $this->grupo=$tutor->grupo;;
        $this->id_asigna_generacion=$tutor->id_asigna_generacion;
        //$this->id_carrera=$carreras->id_carrera;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function title(): string
    {
        return $this->grupo;

    }

    public function array(): array
    {

//dd($tutores);
        $datos_alumnos = DB::select('SELECT CONCAT(alumno.nombre," ",alumno.apaterno," ",alumno.amaterno) nombre, alumno.cuenta FROM gnral_alumnos alumno
                                                INNER JOIN exp_asigna_alumnos asigna
                                                ON asigna.id_alumno = alumno.id_alumno
                                                WHERE asigna.id_asigna_generacion = '.$this->id_asigna_generacion.' AND asigna.id_asigna_alumno NOT IN (SELECT id_asigna_alumno FROM tu_eva_resultados_formulario)');
        $result[]=[ 'Cuenta', 'Nombre'];

        foreach ($datos_alumnos as $alumno){
            //$porcentaje=0;

            $result[] = [$alumno->cuenta, $alumno->nombre];
        }
        return $result;


    }

}
