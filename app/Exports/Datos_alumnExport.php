<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Session;
use App\Alumnos;

class Datos_alumnExport implements FromCollection, WithHeadings, WithTitle
{
    protected $siglas;
    protected $id_carrera;

    public function __construct($carrera)
    {
        $this->siglas = $carrera->siglas;
        $this->id_carrera = $carrera->id_carrera;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function title(): string
    {
        return $this->siglas;
    }

    public function collection()
    {
        $periodo = Session::get('periodo_actual');

        // $array_carreras=array();
        // $carrera2=DB::select('SELECT * FROM `gnral_carreras` WHERE `id_carrera` ='.$this->id_carrera.'');
        // dd($carrera);

        $datos_generales = DB::select('SELECT 
                gnral_alumnos.id_alumno,
                gnral_alumnos.cuenta,
                gnral_alumnos.nombre,
                gnral_alumnos.apaterno,
                gnral_alumnos.amaterno,
                gnral_alumnos.genero,
                gnral_alumnos.fecha_nac,
                gnral_alumnos.edad,
                gnral_alumnos.curp_al,
                gnral_alumnos.edo_civil,
                gnral_alumnos.nacionalidad,
                gnral_alumnos.correo_al,
                gnral_alumnos.cel_al,
                gnral_alumnos.grado_estudio_al,
                gnral_alumnos.tipo_admision,
                gnral_carreras.nombre carrera,
                gnral_semestres.descripcion semestre,
                gnral_alumnos.grupo,
                gnral_alumnos.promedio_preparatoria,
                gnral_estados.nombre_estado,
                gnral_municipios.nombre_municipio,
                gnral_alumnos.calle_al,
                gnral_alumnos.n_ext_al numero_exterior,
                gnral_alumnos.n_int_al numero_interior,
                gnral_alumnos.entre_calle,
                gnral_alumnos.y_calle,
                gnral_alumnos.otra_ref,
                gnral_alumnos.colonia_al,
                gnral_alumnos.cp,
                gnral_alumnos.discapacidad,
                gnral_alumnos.descripcion_discapacidad,
                gnral_alumnos.lengua,
                gnral_alumnos.descripcion_lengua,
                gnral_alumnos.id_seguro_social seguro,
                gnral_alumnos.numero_seguro_social,
                gnral_alumnos.id_semestre,
                gnral_alumnos.id_escuela_procedencia,
                gnral_alumnos.id_institucion 
                FROM
                gnral_alumnos,
                eva_validacion_de_cargas,
                gnral_carreras,
                gnral_semestres,
                gnral_grupos,
                gnral_estados,
                gnral_municipios 
                WHERE
                gnral_grupos.id_grupo=gnral_alumnos.grupo 
                and gnral_alumnos.estado=gnral_estados.id_estado 
                and gnral_alumnos.id_municipio=gnral_municipios.id_municipio 
                and gnral_alumnos.id_semestre=gnral_semestres.id_semestre 
                AND gnral_carreras.id_carrera=gnral_alumnos.id_carrera 
                AND eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno
                and eva_validacion_de_cargas.id_periodo=' . $periodo . ' 
                and eva_validacion_de_cargas.estado_validacion in (2,8,9) 
                and gnral_carreras.id_carrera=' . $this->id_carrera . ' 
                ORDER BY gnral_alumnos.apaterno ASC');

        $array_generales = array();

        foreach ($datos_generales as $dato) {

            $tutor = DB::selectOne('SELECT * FROM `eva_tutor` WHERE `id_alumno` =' . $dato->id_alumno . '');

            $contar_escuela = DB::selectOne('SELECT count(id_alumno) contar from gnral_alumnos,gnral_escuela_procedencia 
                where gnral_alumnos.id_escuela_procedencia=gnral_escuela_procedencia.id_escuela_procedencia 
                and gnral_alumnos.id_alumno=' . $dato->id_alumno . ' ');

            $contar_escuela = $contar_escuela->contar;

            $dat_generales['cuenta'] = $dato->cuenta;
            $dat_generales['nombre'] = $dato->nombre;
            $dat_generales['apaterno'] = $dato->apaterno;
            $dat_generales['amaterno'] = $dato->amaterno;
            $dat_generales['genero'] = $dato->genero;
            $dat_generales['fecha_nac'] = $dato->fecha_nac;
            $dat_generales['edad'] = $dato->edad;
            $dat_generales['curp_al'] = $dato->curp_al;
            $dat_generales['edo_civil'] = $dato->edo_civil;
            $dat_generales['nacionalidad'] = $dato->nacionalidad;
            $dat_generales['correo_al'] = $dato->correo_al;
            $dat_generales['cel_al'] = $dato->cel_al;
            $dat_generales['grado_estudio_al'] = $dato->grado_estudio_al;

            // TIPO DE ADMISION
            $dat_generales['tipo_admision'] = $dato->tipo_admision;

            $dat_generales['carrera'] = $dato->carrera;
            $dat_generales['semestre'] = $dato->semestre;
            $dat_generales['grupo'] = $dato->id_semestre . "0" . $dato->grupo;
            $dat_generales['promedio'] = $dato->promedio_preparatoria;
            $dat_generales['nombre_estado'] = $dato->nombre_estado;
            $dat_generales['nombre_municipio'] = $dato->nombre_municipio;
            $dat_generales['calle_al'] = $dato->calle_al;
            $dat_generales['numero_exterior'] = $dato->numero_exterior;
            $dat_generales['numero_interior'] = $dato->numero_interior;
            $dat_generales['entre_calle'] = $dato->entre_calle;
            $dat_generales['y_calle'] = $dato->y_calle;
            $dat_generales['otra_ref'] = $dato->otra_ref;
            $dat_generales['colonia_al'] = $dato->colonia_al;
            $dat_generales['cp'] = $dato->cp;

            if ($dato->discapacidad == 1) {
                $dat_generales['discapacidad'] = 'NO';
            }

            if ($dato->discapacidad == 2) {
                $dat_generales['discapacidad'] = 'SI';
            }

            $dat_generales['descripcion_discapacidad'] = $dato->descripcion_discapacidad;

            if ($dato->lengua == 1) {
                $dat_generales['lengua'] = 'NO';
            }

            if ($dato->lengua == 2) {
                $dat_generales['lengua'] = 'SI';
            }

            $dat_generales['descripcion_lengua'] = $dato->descripcion_lengua;

            if ($dato->seguro == 0) {
                $dat_generales['seguro'] = 'No selecciono';
            }

            if ($dato->seguro == 1) {
                $dat_generales['seguro'] = 'IMSS';
            }

            if ($dato->seguro == 2) {
                $dat_generales['seguro'] = 'ISSSTE';
            }

            if ($dato->seguro == 3) {
                $dat_generales['seguro'] = 'ISSEMYM';
            }

            if ($dato->seguro == 4) {
                $dat_generales['seguro'] = 'SEGURO POPULAR';
            }

            $dat_generales['numero_seguro_social'] = $dato->numero_seguro_social;

            $dat_generales['n1'] = "";
            $dat_generales['n2'] = "";

            if ($contar_escuela == 0) {

                if ($dato->id_institucion == 0) {

                    $dat_generales['nombre_escuela'] = "";
                    //dd($institucion->nombre_escuela);
                    $dat_generales['estado_escuela'] = "";
                    $dat_generales['municipio_escuela'] = "";

                } else {

                    $institucion = DB::selectOne('SELECT * FROM gnral_instituciones_edu WHERE id_institucion= ' . $dato->id_institucion . '');

                    $dat_generales['nombre_escuela'] = $institucion->nombre_escuela;
                    //dd($institucion->nombre_escuela);
                    $dat_generales['estado_escuela'] = "";
                    $dat_generales['municipio_escuela'] = $institucion->municipio;

                    /*
                }
                */

                }

            } else {

                $escuela_procedencia = DB::selectOne('SELECT * FROM `gnral_escuela_procedencia` WHERE `id_escuela_procedencia` = ' . $dato->id_escuela_procedencia . ' ');

                $dat_generales['nombre_escuela'] = $escuela_procedencia->nombre_escuela;
                $dat_generales['estado_escuela'] = $escuela_procedencia->estado;
                $dat_generales['municipio_escuela'] = $escuela_procedencia->municipio;
            }

            $dat_generales['n3'] = "";

            $dat_generales['curp_tutor'] = $tutor->curp;
            $dat_generales['nombre_tutor'] = $tutor->nombre;
            $dat_generales['apaterno_tutor'] = $tutor->ap_paterno_T;
            $dat_generales['amaterno_tutor'] = $tutor->ap_mat_T;
            $dat_generales['fecha_nac_tutor'] = $tutor->fecha_nac_T;
            $dat_generales['correo_tutor'] = $tutor->correo_t;

            $genero_tutor = substr($tutor->curp, 10, 1);

            if ($genero_tutor == "H") {
                $genero_tutor = "M";
            } else {
                $genero_tutor = "F";
            }

            $dat_generales['sexo_tutor'] = $genero_tutor;
            $dat_generales['parentezco_tutor'] = $tutor->parentezco;
            $dat_generales['telefono_tutor'] = $tutor->cel_t;

            array_push($array_generales, $dat_generales);
        }

        //dd($array_carreras);

        return collect($array_generales);

        /*
        return Alumnos::query()
            ->join('gnral_carreras','gnral_alumnos.id_carrera',"=",'gnral_carreras.id_carrera')
            ->where('gnral_alumnos.id_carrera','=',$this->id_carrera)
            ->select('gnral_alumnos.id_alumno','gnral_alumnos.cuenta');
        */
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.

        return [
            'Cuenta',
            'Nombre',
            'Apellido paterno',
            'Apellido materno',
            'Genero',
            'Fecha nacimiento',
            'Edad',
            'Curp',
            'Estado civil',
            'Nacionalidad',
            'Correo',
            'Celular',
            'Grado de estudios',
            'Tipo de admisión',
            'Carrera',
            'Semestre',
            'Grupo',
            'Promedio de Preparatoria',
            'Estado',
            'Municipio',
            'Calle',
            'Número exterior',
            'Número interior',
            'Entre calle',
            'Y calle',
            'Otra referencia',
            'Colonia',
            'Codigo postal',
            'Discapacidad',
            'Descripción discapacidad',
            'Lengua',
            'Tipo lengua',
            'Seguro',
            'Número de seguro social',
            '',
            '',
            'Nombre de la escuela de procedencia',
            'Estado de la escuela de procedencia',
            'Municipio de la escuela de procedencia',
            '',
            'Curp del tutor',
            'Nombre del tutor',
            'Apellido Paterno del tutor',
            'Apellido Materno del tutor',
            'Fecha de nacimiento del tutor',
            'Correo electronico del tutor',
            'Genero del tutor',
            'Parentezco del alumno',
            'Telefono del tutor'
        ];
    }
}
