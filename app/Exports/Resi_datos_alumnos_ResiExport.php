<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;

class Resi_datos_alumnos_ResiExport implements FromArray, WithTitle
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
        $datos_generales=DB::select('SELECT gnral_alumnos.cuenta,gnral_alumnos.correo_al,gnral_alumnos.nombre,gnral_alumnos.apaterno,
gnral_alumnos.amaterno,resi_proyecto.nom_proyecto,resi_empresa.nombre empresa,resi_sector.descripcion sector,resi_giro.descripcion giro,resi_empresa.domicilio,resi_empresa.tel_empresa,
resi_empresa.correo,resi_empresa.dir_gral,resi_proy_empresa.asesor asesor_externo,gnral_carreras.nombre carrera,resi_proy_empresa.puesto,gnral_personales.nombre asesor_interno,abreviaciones.titulo from gnral_alumnos,resi_anteproyecto,resi_proy_empresa,resi_empresa,resi_giro,resi_sector,resi_proyecto,
resi_asesores,gnral_personales,abreviaciones_prof,abreviaciones,gnral_carreras
WHERE gnral_alumnos.id_carrera=gnral_carreras.id_carrera and gnral_alumnos.id_alumno=resi_anteproyecto.id_alumno and resi_anteproyecto.id_anteproyecto=resi_proy_empresa.id_anteproyecto
and resi_proy_empresa.id_empresa=resi_empresa.id_empresa
and resi_proy_empresa.id_giro=resi_giro.id_giro and
resi_proy_empresa.id_sector=resi_sector.id_sector and
resi_anteproyecto.id_proyecto=resi_proyecto.id_proyecto
and resi_asesores.id_periodo= ?
and resi_anteproyecto.autorizacion_departamento=1
and resi_anteproyecto.id_anteproyecto=resi_asesores.id_anteproyecto
and resi_asesores.id_carrera= ?
and resi_asesores.id_profesor=gnral_personales.id_personal
and gnral_personales.id_personal=abreviaciones_prof.id_personal
and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
ORDER BY gnral_alumnos.apaterno,gnral_alumnos.amaterno,gnral_alumnos.nombre  ASC', [$periodo, $this->id_carrera]);


        $array_generales=array();
        foreach ($datos_generales as $dato)
        {
            $dat_generales['cuenta']=$dato->cuenta;
            $dat_generales['nombre']=mb_strtoupper($dato->apaterno,'utf-8')." ".mb_strtoupper($dato->amaterno,'utf-8')." ".mb_strtoupper($dato->nombre,'utf-8');
            $dat_generales['correo_al']=$dato->correo_al;
            $dat_generales['nom_proyecto']=mb_strtoupper($dato->nom_proyecto,'utf-8');
            $dat_generales['empresa']=$dato->empresa;
            $dat_generales['sector']=$dato->sector;
            $dat_generales['giro']=$dato->giro;
            $dat_generales['domicilio']=$dato->domicilio;
            $dat_generales['tel_empresa']=strval($dato->tel_empresa);
            $dat_generales['correo']=$dato->correo;
            $dat_generales['dir_gral']=$dato->dir_gral;
            $dat_generales['asesor_externo']=$dato->asesor_externo;
            $dat_generales['carrera']=$dato->carrera;
            $dat_generales['puesto']=$dato->puesto;
            $dat_generales['asesor_interno']=$dato->titulo.' '.$dato->asesor_interno;

            array_push($array_generales,$dat_generales);
        }





        $result[]=[ 'No. de Cuenta', 'Nombre del alumno','Correo del alumno','Nombre del proyecto',
            'Nombre de la empresa','Sector de la empresa',
            'Giro de la empresa','Domicilio de la empresa',
            'Telefono de la empresa','Correo de la empresa',
            'Representante de la empresa','Nombre del asesor externo',
            'Puesto del asesor externo','Nombre del asesor interno','Carrera'
        ];

        foreach ($array_generales as $generales){
            //$porcentaje=0;

            $result[] = [  $generales['cuenta'],$generales['nombre'],$generales['correo_al'],
                $generales['nom_proyecto'],$generales['empresa'],
                $generales['sector'],$generales['giro'],$generales['domicilio'],
                $generales['tel_empresa'],$generales['correo'],$generales['dir_gral'],
                $generales['asesor_externo'],$generales['puesto'],
                $generales['asesor_interno'],$generales['carrera']];
        }

        $result[]=[''];
        // $result[]=['TOTAL', $tot_municipio];


        return $result;
    }
}
