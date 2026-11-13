<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;

class Pro_solicitud_prorrogaExport implements FromArray, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        $dat_carreras['id_carrera'] = $this->id_carrera;
        $dat_carreras['nom_carrera'] = $this->carrera;
        $dat_carreras['siglas'] = $this->siglas;
        $solicitudes_prorroga=DB::select('SELECT DISTINCT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,
gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.curp_al,gnral_alumnos.correo_al,gnral_semestres.descripcion semestre,
gnral_carreras.nombre carrera,prorroga_solicitudes.fecha_efectuar
from gnral_alumnos,gnral_semestres,prorroga_solicitudes,gnral_carreras where
 gnral_carreras.id_carrera=gnral_alumnos.id_carrera
and gnral_alumnos.id_alumno=prorroga_solicitudes.id_alumno and
gnral_semestres.id_semestre=prorroga_solicitudes.id_semestre and
gnral_alumnos.id_carrera= ? and
prorroga_solicitudes.id_periodo= ? ORDER BY gnral_alumnos.apaterno ASC,gnral_alumnos.amaterno ASC,gnral_alumnos.nombre ASC', [$this->id_carrera, $periodo]);

        $array_generales=array();
        foreach ($solicitudes_prorroga as $dato)
        {
            $dat_generales['cuenta']=$dato->cuenta;
            $dat_generales['nombre']=$dato->nombre;
            $dat_generales['apaterno']=$dato->apaterno;
            $dat_generales['amaterno']=$dato->amaterno;
            $dat_generales['curp_al']=$dato->curp_al;
            $dat_generales['correo_al']=$dato->correo_al;
            $dat_generales['carrera']=$dato->carrera;
            $dat_generales['semestre']=$dato->semestre;
            $dat_generales['fecha_efectuar']=$dato->fecha_efectuar;
            array_push($array_generales,$dat_generales);
        }



        $result[]=[ 'Cuenta','Apellido paterno','Apellido materno', 'Nombre','Curp','Correo electronico','Carrera','Semestre al que ingresará','Fecha efectuada para el pago de colegiatura semestral'
        ];

        foreach ($array_generales as $generales){
            //$porcentaje=0;

            $result[] = [ $generales['cuenta'],$generales['apaterno'],$generales['amaterno'],$generales['nombre'],
                $generales['curp_al'],$generales['correo_al'],$generales['carrera'],$generales['semestre'],
                $generales['fecha_efectuar']];
        }

        $result[]=[''];
       // $result[]=['TOTAL', $tot_municipio];


        return $result;
    }
}
