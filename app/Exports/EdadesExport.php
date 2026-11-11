<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;
class EdadesExport implements FromArray, WithTitle
{
    protected $siglas;
    protected  $id_carrera;


    public function __construct($carrera){
        // dd($carrera);
        $this->siglas=$carrera->siglas;
        $this->id_carrera=$carrera->id_carrera;
        $this->carrera=$carrera->nombre;
    }

    public function title(): string
    {
        return $this->siglas;

    }
    public function array(): array
    {
        $result = [
            [$this->carrera], // Agrega el nombre en la parte superior
        ];
        // Agrega el primer encabezado
        $result[]=[''];
        $periodo=Session::get('periodo_actual');
        $tot_edades=0;

        $datos_edades=DB::select('SELECT COUNT(gnral_alumnos.id_alumno) cantidad,edad FROM gnral_alumnos, eva_validacion_de_cargas WHERE 
 eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno and eva_validacion_de_cargas.id_periodo='.$periodo.' and gnral_alumnos.id_carrera='.$this->id_carrera.'
  and eva_validacion_de_cargas.estado_validacion  IN (2,8,9)and   edad!=\'\'GROUP BY edad');
        $array_edades=array();
        foreach ($datos_edades as $dato)
        {
            $dat_edades['edad']=$dato->edad;
            $dat_edades['cantidad']=$dato->cantidad;
            $tot_edades+=$dato->cantidad;
            array_push($array_edades,$dat_edades);
        }

        $tot_edades;

        $result[]=['Edad', 'Cantidad', 'Porcentaje'];

        foreach ($array_edades as $edad){
            //$porcentaje=0;
            if($edad['cantidad'] == 0)
            {
                $porcentaje=0;
            }else
            {
                $porcentaje=round((($edad['cantidad']*100)/$tot_edades), 1).'%';
            }
            $result[] = [$edad['edad'], $edad['cantidad'],$porcentaje];
        }

        $result[]=[''];
        $result[]=['TOTAL', $tot_edades];


        return $result;
    }
}
