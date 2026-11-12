<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_sistema_evaluacion`.
 */
class PlanSistemaEvaluacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_sistema_evaluacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_sistema_evaluacion';

        $llaves = [
            ['id_sistema_evaluacion'],
        ];

        $registros = [
            [
                'id_sistema_evaluacion' => 1,
                'id_unidad'             => 1,
                'id_encabezado'         => 1,
                'id_factor'             => 1,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 1.',
                'created_at'            => '2026-01-05 09:00:00',
                'updated_at'            => '2026-01-05 09:00:00',
            ],
            [
                'id_sistema_evaluacion' => 2,
                'id_unidad'             => 2,
                'id_encabezado'         => 2,
                'id_factor'             => 2,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 2.',
                'created_at'            => '2026-01-14 10:00:00',
                'updated_at'            => '2026-01-14 10:00:00',
            ],
            [
                'id_sistema_evaluacion' => 3,
                'id_unidad'             => 3,
                'id_encabezado'         => 3,
                'id_factor'             => 3,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 3.',
                'created_at'            => '2026-01-23 11:00:00',
                'updated_at'            => '2026-01-23 11:00:00',
            ],
            [
                'id_sistema_evaluacion' => 4,
                'id_unidad'             => 4,
                'id_encabezado'         => 4,
                'id_factor'             => 4,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 4.',
                'created_at'            => '2026-02-01 12:00:00',
                'updated_at'            => '2026-02-01 12:00:00',
            ],
            [
                'id_sistema_evaluacion' => 5,
                'id_unidad'             => 5,
                'id_encabezado'         => 5,
                'id_factor'             => 5,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 5.',
                'created_at'            => '2026-02-10 13:00:00',
                'updated_at'            => '2026-02-10 13:00:00',
            ],
            [
                'id_sistema_evaluacion' => 6,
                'id_unidad'             => 6,
                'id_encabezado'         => 6,
                'id_factor'             => 6,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 6.',
                'created_at'            => '2026-02-19 14:00:00',
                'updated_at'            => '2026-02-19 14:00:00',
            ],
            [
                'id_sistema_evaluacion' => 7,
                'id_unidad'             => 7,
                'id_encabezado'         => 7,
                'id_factor'             => 7,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 7.',
                'created_at'            => '2026-02-28 15:00:00',
                'updated_at'            => '2026-02-28 15:00:00',
            ],
            [
                'id_sistema_evaluacion' => 8,
                'id_unidad'             => 8,
                'id_encabezado'         => 8,
                'id_factor'             => 8,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 8.',
                'created_at'            => '2026-03-09 16:00:00',
                'updated_at'            => '2026-03-09 16:00:00',
            ],
            [
                'id_sistema_evaluacion' => 9,
                'id_unidad'             => 9,
                'id_encabezado'         => 9,
                'id_factor'             => 9,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 9.',
                'created_at'            => '2026-03-18 08:00:00',
                'updated_at'            => '2026-03-18 08:00:00',
            ],
            [
                'id_sistema_evaluacion' => 10,
                'id_unidad'             => 10,
                'id_encabezado'         => 10,
                'id_factor'             => 10,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 10.',
                'created_at'            => '2026-03-27 09:00:00',
                'updated_at'            => '2026-03-27 09:00:00',
            ],
            [
                'id_sistema_evaluacion' => 11,
                'id_unidad'             => 11,
                'id_encabezado'         => 11,
                'id_factor'             => 11,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 11.',
                'created_at'            => '2026-04-05 10:00:00',
                'updated_at'            => '2026-04-05 10:00:00',
            ],
            [
                'id_sistema_evaluacion' => 12,
                'id_unidad'             => 12,
                'id_encabezado'         => 12,
                'id_factor'             => 12,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 12.',
                'created_at'            => '2026-04-14 11:00:00',
                'updated_at'            => '2026-04-14 11:00:00',
            ],
            [
                'id_sistema_evaluacion' => 13,
                'id_unidad'             => 13,
                'id_encabezado'         => 13,
                'id_factor'             => 13,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 13.',
                'created_at'            => '2026-04-23 12:00:00',
                'updated_at'            => '2026-04-23 12:00:00',
            ],
            [
                'id_sistema_evaluacion' => 14,
                'id_unidad'             => 14,
                'id_encabezado'         => 14,
                'id_factor'             => 14,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 14.',
                'created_at'            => '2026-05-02 13:00:00',
                'updated_at'            => '2026-05-02 13:00:00',
            ],
            [
                'id_sistema_evaluacion' => 15,
                'id_unidad'             => 15,
                'id_encabezado'         => 15,
                'id_factor'             => 15,
                'ponderacion'           => 'Ponderacion de sistema evaluacion: registro de prueba número 15.',
                'created_at'            => '2026-05-11 14:00:00',
                'updated_at'            => '2026-05-11 14:00:00',
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
