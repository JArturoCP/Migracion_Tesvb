<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;
class MunicipiosExport implements FromArray, WithTitle
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
        $tot_municipio=0;
        $datos_municipios=DB::select('SELECT COUNT(gnral_alumnos.id_municipio) cantidad,gnral_municipios.nombre_municipio municipio
            FROM gnral_alumnos,gnral_municipios,eva_validacion_de_cargas  WHERE
           eva_validacion_de_cargas.estado_validacion IN (2,8,9) and
               eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno and
                eva_validacion_de_cargas.id_periodo= ?  AND
            gnral_alumnos.id_municipio=gnral_municipios.id_municipio AND
            id_carrera= ? GROUP BY gnral_municipios.id_municipio ORDER BY cantidad DESC', [$periodo, $this->id_carrera]);
        $array_municipios=array();

        foreach ($datos_municipios as $dato)
        {
            $dat_mpios['municipio']=$dato->municipio;
            $dat_mpios['cantidad']=$dato->cantidad;
            array_push($array_municipios,$dat_mpios);
            $tot_municipio+=$dato->cantidad;
        }
        //dd($array_municipios);
       $tot_municipio;
               $result[]=[ 'Municipio', 'Cantidad', 'Porcentaje'];

            foreach ($array_municipios as $muni){
                //$porcentaje=0;
                if($muni['cantidad'] == 0)
                {
                    $porcentaje=0;
                }else
                {
                    $porcentaje=round((($muni['cantidad']*100)/$tot_municipio), 1).'%';
                }
                $result[] = [$muni['municipio'], $muni['cantidad'],$porcentaje];
            }

        $result[]=[''];
        $result[]=['TOTAL', $tot_municipio];


        return $result;
    }

}
