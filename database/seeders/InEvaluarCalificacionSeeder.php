<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_evaluar_calificacion`.
 */
class InEvaluarCalificacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_evaluar_calificacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            InCargaAcademicaInglesSeeder::class,
        ]);

        $tabla = 'in_evaluar_calificacion';

        $llaves = [
            ['id_evaluar_calificacion'],
        ];

        $registros = [
            [
                'id_evaluar_calificacion' => 1,
                'id_unidad'               => 1,
                'id_carga_ingles'         => 1,
                'calificacion'            => 77,
                'esc'                     => 1,
                'created_at'              => '2026-01-05 09:00:00',
                'updated_at'              => '2026-01-05 09:00:00',
            ],
            [
                'id_evaluar_calificacion' => 2,
                'id_unidad'               => 2,
                'id_carga_ingles'         => 2,
                'calificacion'            => 84,
                'esc'                     => 2,
                'created_at'              => '2026-01-14 10:00:00',
                'updated_at'              => '2026-01-14 10:00:00',
            ],
            [
                'id_evaluar_calificacion' => 3,
                'id_unidad'               => 3,
                'id_carga_ingles'         => 3,
                'calificacion'            => 91,
                'esc'                     => 3,
                'created_at'              => '2026-01-23 11:00:00',
                'updated_at'              => '2026-01-23 11:00:00',
            ],
            [
                'id_evaluar_calificacion' => 4,
                'id_unidad'               => 4,
                'id_carga_ingles'         => 4,
                'calificacion'            => 98,
                'esc'                     => 4,
                'created_at'              => '2026-02-01 12:00:00',
                'updated_at'              => '2026-02-01 12:00:00',
            ],
            [
                'id_evaluar_calificacion' => 5,
                'id_unidad'               => 5,
                'id_carga_ingles'         => 5,
                'calificacion'            => 74,
                'esc'                     => 5,
                'created_at'              => '2026-02-10 13:00:00',
                'updated_at'              => '2026-02-10 13:00:00',
            ],
            [
                'id_evaluar_calificacion' => 6,
                'id_unidad'               => 6,
                'id_carga_ingles'         => 6,
                'calificacion'            => 81,
                'esc'                     => 6,
                'created_at'              => '2026-02-19 14:00:00',
                'updated_at'              => '2026-02-19 14:00:00',
            ],
            [
                'id_evaluar_calificacion' => 7,
                'id_unidad'               => 7,
                'id_carga_ingles'         => 7,
                'calificacion'            => 88,
                'esc'                     => 7,
                'created_at'              => '2026-02-28 15:00:00',
                'updated_at'              => '2026-02-28 15:00:00',
            ],
            [
                'id_evaluar_calificacion' => 8,
                'id_unidad'               => 8,
                'id_carga_ingles'         => 8,
                'calificacion'            => 95,
                'esc'                     => 8,
                'created_at'              => '2026-03-09 16:00:00',
                'updated_at'              => '2026-03-09 16:00:00',
            ],
            [
                'id_evaluar_calificacion' => 9,
                'id_unidad'               => 1,
                'id_carga_ingles'         => 9,
                'calificacion'            => 71,
                'esc'                     => 9,
                'created_at'              => '2026-03-18 08:00:00',
                'updated_at'              => '2026-03-18 08:00:00',
            ],
            [
                'id_evaluar_calificacion' => 10,
                'id_unidad'               => 2,
                'id_carga_ingles'         => 10,
                'calificacion'            => 78,
                'esc'                     => 10,
                'created_at'              => '2026-03-27 09:00:00',
                'updated_at'              => '2026-03-27 09:00:00',
            ],
            [
                'id_evaluar_calificacion' => 11,
                'id_unidad'               => 3,
                'id_carga_ingles'         => 11,
                'calificacion'            => 85,
                'esc'                     => 11,
                'created_at'              => '2026-04-05 10:00:00',
                'updated_at'              => '2026-04-05 10:00:00',
            ],
            [
                'id_evaluar_calificacion' => 12,
                'id_unidad'               => 4,
                'id_carga_ingles'         => 12,
                'calificacion'            => 92,
                'esc'                     => 12,
                'created_at'              => '2026-04-14 11:00:00',
                'updated_at'              => '2026-04-14 11:00:00',
            ],
            [
                'id_evaluar_calificacion' => 13,
                'id_unidad'               => 5,
                'id_carga_ingles'         => 13,
                'calificacion'            => 99,
                'esc'                     => 13,
                'created_at'              => '2026-04-23 12:00:00',
                'updated_at'              => '2026-04-23 12:00:00',
            ],
            [
                'id_evaluar_calificacion' => 14,
                'id_unidad'               => 6,
                'id_carga_ingles'         => 14,
                'calificacion'            => 75,
                'esc'                     => 14,
                'created_at'              => '2026-05-02 13:00:00',
                'updated_at'              => '2026-05-02 13:00:00',
            ],
            [
                'id_evaluar_calificacion' => 15,
                'id_unidad'               => 7,
                'id_carga_ingles'         => 15,
                'calificacion'            => 82,
                'esc'                     => 15,
                'created_at'              => '2026-05-11 14:00:00',
                'updated_at'              => '2026-05-11 14:00:00',
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
