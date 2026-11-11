<?php

namespace App\Exports;

use App\Carreras;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Session;
class Tutorias_carrerasMulti_export implements  WithMultipleSheets
{

    /**
     * @return \Illuminate\Support\Collection
     */
    protected $siglas;
    protected  $id_carrera;
    public function __construct($carreras){
        //dd($carreras);
        $this->siglas=$carreras->siglas;
        $this->nombre=$carreras->nombre;
        $this->id_carrera=$carreras->id_carrera;
    }
    public function sheets(): array
    {
        $periodo = Session::get('periodo_actual');

        $tutores = DB::SELECT('SELECT exp_asigna_t.id_asigna_generacion,tu_grupo_s.id_grupo_semestre,car.nombre carrera, car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor, gnral_p.tipo_usuario tipo FROM tu_grupo_tutorias tu_grupo_t
                              INNER JOIN tu_grupo_semestre tu_grupo_s
                              ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                              INNER JOIN exp_asigna_tutor exp_asigna_t 
                              ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                              INNER JOIN gnral_personales gnral_p 
                              ON gnral_p.id_personal = exp_asigna_t.id_personal 
                              INNER JOIN gnral_jefes_periodos gnral_j 
                              ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                              INNER JOIN gnral_carreras car
                              ON car.id_carrera = gnral_j.id_carrera
                              WHERE gnral_j.id_periodo = '.$periodo.' AND car.id_carrera = '.$this->id_carrera.' ');
        $sheets=[];


        foreach ($tutores as $tutor)
        {
            $sheets[]=new Tutorias_carreras_export($tutor);
        }

        return $sheets;
        // TODO: Implement sheets() method.
    }
}
