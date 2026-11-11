<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;
class Beca_cincuentaExport implements FromArray, WithTitle
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
        $autorizados_profesionales=DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,gnral_alumnos.nombre,gnral_alumnos.apaterno,
gnral_alumnos.amaterno,gnral_alumnos.curp_al,gnral_alumnos.correo_al,beca_descuento.descripcion descuento,beca_descuento.id_descuento,beca_autorizar.promedio,
gnral_semestres.id_semestre,gnral_semestres.descripcion semestre,beca_autorizar.id_autorizar,gnral_carreras.id_carrera,gnral_carreras.nombre carrera,beca_vulnerabilidad.id_estado 
 FROM gnral_alumnos,beca_descuento,beca_autorizar,gnral_semestres,gnral_carreras,beca_vulnerabilidad WHERE gnral_alumnos.id_alumno=beca_autorizar.id_alumno 
 and gnral_alumnos.id_carrera=gnral_carreras.id_carrera and beca_autorizar.id_descuento=beca_descuento.id_descuento 
 and beca_autorizar.id_semestre=gnral_semestres.id_semestre and beca_autorizar.id_periodo='.$periodo.' and beca_autorizar.id_estado=5  
 and beca_descuento.id_descuento in (2,3)  and  gnral_carreras.id_carrera='.$this->id_carrera.' and beca_vulnerabilidad.id_alumno = gnral_alumnos.id_alumno and beca_vulnerabilidad.id_periodo =beca_autorizar.id_periodo
 ORDER BY gnral_alumnos.apaterno ASC,gnral_alumnos.amaterno ASC,gnral_alumnos.nombre ASC');


        $array_generales=array();
        foreach ($autorizados_profesionales as $dato) {
            $dat_generales['cuenta'] = $dato->cuenta;
            $dat_generales['nombre'] = $dato->nombre;
            $dat_generales['apaterno'] = $dato->apaterno;
            $dat_generales['amaterno'] = $dato->amaterno;
            $dat_generales['curp_al'] = $dato->curp_al;
            $dat_generales['correo_al'] = $dato->correo_al;
            $dat_generales['carrera'] = $dato->carrera;
            $dat_generales['semestre'] = $dato->semestre;
            $dat_generales['promedio'] = $dato->promedio;
            if ($dato->id_estado == 1) {
                $dat_generales['estado'] = "MADRE DE FAMILIA";
            }
            elseif($dato->id_estado == 2){
                $dat_generales['estado'] = "CONDICIÓN DE DISCAPACIDAD";
           }else{
                $dat_generales['estado'] = "";
            }
            $dat_generales['descuento'] = $dato->descuento . " de descuento";
            array_push($array_generales, $dat_generales);
        }



        $result[]=[   'Cuenta','Apellido paterno','Apellido materno', 'Nombre','Curp','Correo electronico','Carrera','Semestre','Promedio','descuento','Estado del estudiante'
        ];

        foreach ($array_generales as $generales){
            //$porcentaje=0;

            $result[] = [  $generales['cuenta'],$generales['apaterno'],$generales['amaterno'],$generales['nombre'],
                $generales['curp_al'],$generales['correo_al'],$generales['carrera'],$generales['semestre'],
                $generales['promedio'], $generales['descuento'], $generales['estado']];
        }

        $result[]=[''];
        // $result[]=['TOTAL', $tot_municipio];


        return $result;
    }
}
