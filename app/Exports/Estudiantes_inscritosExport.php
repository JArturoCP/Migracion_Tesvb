<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

use Session;
class Estudiantes_inscritosExport implements FromArray, WithTitle
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
        $result[] = [ 'Semestre', 'Masculino', 'Femenino', 'Total', 'Porcentaje'];
        $periodo=Session::get('periodo_actual');
        $tot_masc=0; $tot_fem=0;
        $array_semestres=array();
        $total_gral=0;

        // Agrega los datos del primer array
        $semestres=DB::select('SELECT * FROM gnral_semestres');
        foreach ($semestres as $semestre)
        {
            $dat_semestres['id_semestre']=$semestre->id_semestre;
            $dat_semestres['nom_semestre']=$semestre->descripcion;
            $datos_inscritos=DB::select("SELECT * FROM (SELECT COUNT(gnral_alumnos.id_alumno)Masculino FROM 
                                    gnral_alumnos,eva_validacion_de_cargas WHERE
                                      gnral_alumnos.id_carrera=$this->id_carrera AND
                                      gnral_alumnos.id_semestre=$semestre->id_semestre AND
                                      eva_validacion_de_cargas.id_periodo=$periodo AND
                                      eva_validacion_de_cargas.estado_validacion IN (2,8,9) and 
               eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno and
                                      gnral_alumnos.genero='M') t1,
                                  (SELECT COUNT(gnral_alumnos.id_alumno)Femenino FROM
                                      gnral_alumnos,eva_validacion_de_cargas WHERE
                                      gnral_alumnos.id_carrera=$this->id_carrera AND
                                      gnral_alumnos.id_semestre=$semestre->id_semestre AND
                                      eva_validacion_de_cargas.id_periodo=$periodo AND
                                      eva_validacion_de_cargas.estado_validacion IN (2,8,9) and 
                                     eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno and
                                      gnral_alumnos.genero='F') t2");
            $array_datos=array();
            foreach ($datos_inscritos as $dato)
            {
                $dat_alumno['masculino']=$dato->Masculino;
                $dat_alumno['femenino']=$dato->Femenino;
                $tot_masc+=($dato->Masculino);
                $tot_fem+=($dato->Femenino);
                $dat_alumno['total']=($dato->Masculino)+($dato->Femenino);
                $total_gral= $total_gral+($dato->Masculino)+($dato->Femenino);
                array_push($array_datos, $dat_alumno);
            }
            $dat_semestres['datos']=$array_datos;
            array_push($array_semestres,$dat_semestres);
        }
       // dd($array_semestres);
        $total_gral;
        $tot_masc;
        $tot_fem;

        foreach ($array_semestres as $sem) {
            foreach ($sem['datos'] as $dato){
                //$porcentaje=0;
                if($dato['total'] == 0)
                {
                   $porcentaje=0;
                }else
                {
                    $porcentaje=round((($dato['total']*100)/$total_gral), 2).'%';
                }
                $result[] = [$sem['nom_semestre'],$dato['masculino'],$dato['femenino'],$dato['total'],$porcentaje];
            }
        }
        $result[]=[''];
        $result[]=['TOTAL', $tot_masc, $tot_fem, $tot_masc+$tot_fem];


        return $result;
    }




}
