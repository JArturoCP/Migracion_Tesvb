<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_evaluaciones`.
 */
class CalEvaluacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_evaluaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            EvaCargaAcademicaSeeder::class,
        ]);

        $tabla = 'cal_evaluaciones';

        $llaves = [
            ['id_evaluacion'],
        ];

        $registros = [
            [
                'id_evaluacion'      => 1,
                'id_unidad'          => 1,
                'id_carga_academica' => 1,
                'calificacion'       => 77,
                'esc'                => 1,
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'id_canalizacion'    => 1,
                'observaciones'      => 'Observaciones evaluaciones 1',
            ],
            [
                'id_evaluacion'      => 2,
                'id_unidad'          => 2,
                'id_carga_academica' => 2,
                'calificacion'       => 84,
                'esc'                => 2,
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'id_canalizacion'    => 2,
                'observaciones'      => 'Observaciones evaluaciones 2',
            ],
            [
                'id_evaluacion'      => 3,
                'id_unidad'          => 3,
                'id_carga_academica' => 3,
                'calificacion'       => 91,
                'esc'                => 3,
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'id_canalizacion'    => 3,
                'observaciones'      => 'Observaciones evaluaciones 3',
            ],
            [
                'id_evaluacion'      => 4,
                'id_unidad'          => 4,
                'id_carga_academica' => 4,
                'calificacion'       => 98,
                'esc'                => 4,
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'id_canalizacion'    => 4,
                'observaciones'      => 'Observaciones evaluaciones 4',
            ],
            [
                'id_evaluacion'      => 5,
                'id_unidad'          => 5,
                'id_carga_academica' => 5,
                'calificacion'       => 74,
                'esc'                => 5,
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'id_canalizacion'    => 5,
                'observaciones'      => 'Observaciones evaluaciones 5',
            ],
            [
                'id_evaluacion'      => 6,
                'id_unidad'          => 6,
                'id_carga_academica' => 6,
                'calificacion'       => 81,
                'esc'                => 6,
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'id_canalizacion'    => 6,
                'observaciones'      => 'Observaciones evaluaciones 6',
            ],
            [
                'id_evaluacion'      => 7,
                'id_unidad'          => 7,
                'id_carga_academica' => 7,
                'calificacion'       => 88,
                'esc'                => 7,
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'id_canalizacion'    => 7,
                'observaciones'      => 'Observaciones evaluaciones 7',
            ],
            [
                'id_evaluacion'      => 8,
                'id_unidad'          => 8,
                'id_carga_academica' => 8,
                'calificacion'       => 95,
                'esc'                => 8,
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'id_canalizacion'    => 8,
                'observaciones'      => 'Observaciones evaluaciones 8',
            ],
            [
                'id_evaluacion'      => 9,
                'id_unidad'          => 1,
                'id_carga_academica' => 9,
                'calificacion'       => 71,
                'esc'                => 9,
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'id_canalizacion'    => 9,
                'observaciones'      => 'Observaciones evaluaciones 9',
            ],
            [
                'id_evaluacion'      => 10,
                'id_unidad'          => 2,
                'id_carga_academica' => 10,
                'calificacion'       => 78,
                'esc'                => 10,
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'id_canalizacion'    => 10,
                'observaciones'      => 'Observaciones evaluaciones 10',
            ],
            [
                'id_evaluacion'      => 11,
                'id_unidad'          => 3,
                'id_carga_academica' => 11,
                'calificacion'       => 85,
                'esc'                => 11,
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'id_canalizacion'    => 11,
                'observaciones'      => 'Observaciones evaluaciones 11',
            ],
            [
                'id_evaluacion'      => 12,
                'id_unidad'          => 4,
                'id_carga_academica' => 12,
                'calificacion'       => 92,
                'esc'                => 12,
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'id_canalizacion'    => 12,
                'observaciones'      => 'Observaciones evaluaciones 12',
            ],
            [
                'id_evaluacion'      => 13,
                'id_unidad'          => 5,
                'id_carga_academica' => 13,
                'calificacion'       => 99,
                'esc'                => 13,
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'id_canalizacion'    => 13,
                'observaciones'      => 'Observaciones evaluaciones 13',
            ],
            [
                'id_evaluacion'      => 14,
                'id_unidad'          => 6,
                'id_carga_academica' => 14,
                'calificacion'       => 75,
                'esc'                => 14,
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'id_canalizacion'    => 14,
                'observaciones'      => 'Observaciones evaluaciones 14',
            ],
            [
                'id_evaluacion'      => 15,
                'id_unidad'          => 7,
                'id_carga_academica' => 15,
                'calificacion'       => 82,
                'esc'                => 15,
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'id_canalizacion'    => 15,
                'observaciones'      => 'Observaciones evaluaciones 15',
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
