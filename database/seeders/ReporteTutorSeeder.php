<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `reporte_tutor`.
 */
class ReporteTutorSeeder extends Seeder
{
    /**
     * Pobla la tabla `reporte_tutor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaGeneracionSeeder::class,
        ]);

        $tabla = 'reporte_tutor';

        $llaves = [
            ['id_reporte_tutor'],
        ];

        $registros = [
            [
                'id_reporte_tutor'     => 1,
                'id_asigna_generacion' => 1,
                'alumno'               => 'Alumno reporte tutor 1',
                'appaterno'            => 'Appaterno reporte tutor 1',
                'apmaterno'            => 'Apmaterno reporte tutor 1',
                'n_cuenta'             => '202610001',
                'tutoria_grupal'       => 'V1',
                'tutoria_individual'   => 'V1',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 1.',
                'repeticion'           => 'V1',
                'especial'             => 'V1',
                'academico'            => 'V1',
                'medico'               => 'V1',
                'psicologico'          => 'V1',
                'baja'                 => 'V1',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 1.',
            ],
            [
                'id_reporte_tutor'     => 2,
                'id_asigna_generacion' => 2,
                'alumno'               => 'Alumno reporte tutor 2',
                'appaterno'            => 'Appaterno reporte tutor 2',
                'apmaterno'            => 'Apmaterno reporte tutor 2',
                'n_cuenta'             => '202610002',
                'tutoria_grupal'       => 'V2',
                'tutoria_individual'   => 'V2',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 2.',
                'repeticion'           => 'V2',
                'especial'             => 'V2',
                'academico'            => 'V2',
                'medico'               => 'V2',
                'psicologico'          => 'V2',
                'baja'                 => 'V2',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 2.',
            ],
            [
                'id_reporte_tutor'     => 3,
                'id_asigna_generacion' => 3,
                'alumno'               => 'Alumno reporte tutor 3',
                'appaterno'            => 'Appaterno reporte tutor 3',
                'apmaterno'            => 'Apmaterno reporte tutor 3',
                'n_cuenta'             => '202610003',
                'tutoria_grupal'       => 'V3',
                'tutoria_individual'   => 'V3',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 3.',
                'repeticion'           => 'V3',
                'especial'             => 'V3',
                'academico'            => 'V3',
                'medico'               => 'V3',
                'psicologico'          => 'V3',
                'baja'                 => 'V3',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 3.',
            ],
            [
                'id_reporte_tutor'     => 4,
                'id_asigna_generacion' => 4,
                'alumno'               => 'Alumno reporte tutor 4',
                'appaterno'            => 'Appaterno reporte tutor 4',
                'apmaterno'            => 'Apmaterno reporte tutor 4',
                'n_cuenta'             => '202610004',
                'tutoria_grupal'       => 'V4',
                'tutoria_individual'   => 'V4',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 4.',
                'repeticion'           => 'V4',
                'especial'             => 'V4',
                'academico'            => 'V4',
                'medico'               => 'V4',
                'psicologico'          => 'V4',
                'baja'                 => 'V4',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 4.',
            ],
            [
                'id_reporte_tutor'     => 5,
                'id_asigna_generacion' => 5,
                'alumno'               => 'Alumno reporte tutor 5',
                'appaterno'            => 'Appaterno reporte tutor 5',
                'apmaterno'            => 'Apmaterno reporte tutor 5',
                'n_cuenta'             => '202610005',
                'tutoria_grupal'       => 'V5',
                'tutoria_individual'   => 'V5',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 5.',
                'repeticion'           => 'V5',
                'especial'             => 'V5',
                'academico'            => 'V5',
                'medico'               => 'V5',
                'psicologico'          => 'V5',
                'baja'                 => 'V5',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 5.',
            ],
            [
                'id_reporte_tutor'     => 6,
                'id_asigna_generacion' => 6,
                'alumno'               => 'Alumno reporte tutor 6',
                'appaterno'            => 'Appaterno reporte tutor 6',
                'apmaterno'            => 'Apmaterno reporte tutor 6',
                'n_cuenta'             => '202610006',
                'tutoria_grupal'       => 'V6',
                'tutoria_individual'   => 'V6',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 6.',
                'repeticion'           => 'V6',
                'especial'             => 'V6',
                'academico'            => 'V6',
                'medico'               => 'V6',
                'psicologico'          => 'V6',
                'baja'                 => 'V6',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 6.',
            ],
            [
                'id_reporte_tutor'     => 7,
                'id_asigna_generacion' => 7,
                'alumno'               => 'Alumno reporte tutor 7',
                'appaterno'            => 'Appaterno reporte tutor 7',
                'apmaterno'            => 'Apmaterno reporte tutor 7',
                'n_cuenta'             => '202610007',
                'tutoria_grupal'       => 'V7',
                'tutoria_individual'   => 'V7',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 7.',
                'repeticion'           => 'V7',
                'especial'             => 'V7',
                'academico'            => 'V7',
                'medico'               => 'V7',
                'psicologico'          => 'V7',
                'baja'                 => 'V7',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 7.',
            ],
            [
                'id_reporte_tutor'     => 8,
                'id_asigna_generacion' => 8,
                'alumno'               => 'Alumno reporte tutor 8',
                'appaterno'            => 'Appaterno reporte tutor 8',
                'apmaterno'            => 'Apmaterno reporte tutor 8',
                'n_cuenta'             => '202610008',
                'tutoria_grupal'       => 'V8',
                'tutoria_individual'   => 'V8',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 8.',
                'repeticion'           => 'V8',
                'especial'             => 'V8',
                'academico'            => 'V8',
                'medico'               => 'V8',
                'psicologico'          => 'V8',
                'baja'                 => 'V8',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 8.',
            ],
            [
                'id_reporte_tutor'     => 9,
                'id_asigna_generacion' => 9,
                'alumno'               => 'Alumno reporte tutor 9',
                'appaterno'            => 'Appaterno reporte tutor 9',
                'apmaterno'            => 'Apmaterno reporte tutor 9',
                'n_cuenta'             => '202610009',
                'tutoria_grupal'       => 'V9',
                'tutoria_individual'   => 'V9',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 9.',
                'repeticion'           => 'V9',
                'especial'             => 'V9',
                'academico'            => 'V9',
                'medico'               => 'V9',
                'psicologico'          => 'V9',
                'baja'                 => 'V9',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 9.',
            ],
            [
                'id_reporte_tutor'     => 10,
                'id_asigna_generacion' => 10,
                'alumno'               => 'Alumno reporte tutor 10',
                'appaterno'            => 'Appaterno reporte tutor 10',
                'apmaterno'            => 'Apmaterno reporte tutor 10',
                'n_cuenta'             => '202610010',
                'tutoria_grupal'       => 'V10',
                'tutoria_individual'   => 'V10',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 10.',
                'repeticion'           => 'V10',
                'especial'             => 'V10',
                'academico'            => 'V10',
                'medico'               => 'V10',
                'psicologico'          => 'V10',
                'baja'                 => 'V10',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 10.',
            ],
            [
                'id_reporte_tutor'     => 11,
                'id_asigna_generacion' => 11,
                'alumno'               => 'Alumno reporte tutor 11',
                'appaterno'            => 'Appaterno reporte tutor 11',
                'apmaterno'            => 'Apmaterno reporte tutor 11',
                'n_cuenta'             => '202610011',
                'tutoria_grupal'       => 'V11',
                'tutoria_individual'   => 'V11',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 11.',
                'repeticion'           => 'V11',
                'especial'             => 'V11',
                'academico'            => 'V11',
                'medico'               => 'V11',
                'psicologico'          => 'V11',
                'baja'                 => 'V11',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 11.',
            ],
            [
                'id_reporte_tutor'     => 12,
                'id_asigna_generacion' => 12,
                'alumno'               => 'Alumno reporte tutor 12',
                'appaterno'            => 'Appaterno reporte tutor 12',
                'apmaterno'            => 'Apmaterno reporte tutor 12',
                'n_cuenta'             => '202610012',
                'tutoria_grupal'       => 'V12',
                'tutoria_individual'   => 'V12',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 12.',
                'repeticion'           => 'V12',
                'especial'             => 'V12',
                'academico'            => 'V12',
                'medico'               => 'V12',
                'psicologico'          => 'V12',
                'baja'                 => 'V12',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 12.',
            ],
            [
                'id_reporte_tutor'     => 13,
                'id_asigna_generacion' => 13,
                'alumno'               => 'Alumno reporte tutor 13',
                'appaterno'            => 'Appaterno reporte tutor 13',
                'apmaterno'            => 'Apmaterno reporte tutor 13',
                'n_cuenta'             => '202610013',
                'tutoria_grupal'       => 'V13',
                'tutoria_individual'   => 'V13',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 13.',
                'repeticion'           => 'V13',
                'especial'             => 'V13',
                'academico'            => 'V13',
                'medico'               => 'V13',
                'psicologico'          => 'V13',
                'baja'                 => 'V13',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 13.',
            ],
            [
                'id_reporte_tutor'     => 14,
                'id_asigna_generacion' => 14,
                'alumno'               => 'Alumno reporte tutor 14',
                'appaterno'            => 'Appaterno reporte tutor 14',
                'apmaterno'            => 'Apmaterno reporte tutor 14',
                'n_cuenta'             => '202610014',
                'tutoria_grupal'       => 'V14',
                'tutoria_individual'   => 'V14',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 14.',
                'repeticion'           => 'V14',
                'especial'             => 'V14',
                'academico'            => 'V14',
                'medico'               => 'V14',
                'psicologico'          => 'V14',
                'baja'                 => 'V14',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 14.',
            ],
            [
                'id_reporte_tutor'     => 15,
                'id_asigna_generacion' => 15,
                'alumno'               => 'Alumno reporte tutor 15',
                'appaterno'            => 'Appaterno reporte tutor 15',
                'apmaterno'            => 'Apmaterno reporte tutor 15',
                'n_cuenta'             => '202610015',
                'tutoria_grupal'       => 'V15',
                'tutoria_individual'   => 'V15',
                'beca'                 => 'Beca de reporte tutor: registro de prueba número 15.',
                'repeticion'           => 'V15',
                'especial'             => 'V15',
                'academico'            => 'V15',
                'medico'               => 'V15',
                'psicologico'          => 'V15',
                'baja'                 => 'V15',
                'observaciones'        => 'Observaciones de reporte tutor: registro de prueba número 15.',
            ],
        ];

        foreach ($registros as $registro) {
            $existe = DB::table($tabla)
                ->where(function ($consulta) use ($llaves, $registro) {
                    foreach ($llaves as $llave) {
                        $consulta->orWhere(function ($condicion) use ($llave, $registro) {
                            foreach ($llave as $columna) {
                                $condicion->where($columna, $registro[$columna]);
                            }
                        });
                    }
                })
                ->exists();

            if (! $existe) {
                DB::table($tabla)->insert($registro);
            }
        }
    }
}
