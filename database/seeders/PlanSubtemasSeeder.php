<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_subtemas`.
 */
class PlanSubtemasSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_subtemas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_subtemas';

        $llaves = [
            ['id_subtema'],
        ];

        $registros = [
            [
                'id_subtema'  => 1,
                'id_unidad'   => 1,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 1.',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_subtema'  => 2,
                'id_unidad'   => 2,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 2.',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_subtema'  => 3,
                'id_unidad'   => 3,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 3.',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_subtema'  => 4,
                'id_unidad'   => 4,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 4.',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_subtema'  => 5,
                'id_unidad'   => 5,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 5.',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_subtema'  => 6,
                'id_unidad'   => 6,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 6.',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_subtema'  => 7,
                'id_unidad'   => 7,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 7.',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_subtema'  => 8,
                'id_unidad'   => 8,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 8.',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_subtema'  => 9,
                'id_unidad'   => 9,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 9.',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_subtema'  => 10,
                'id_unidad'   => 10,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 10.',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_subtema'  => 11,
                'id_unidad'   => 11,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 11.',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_subtema'  => 12,
                'id_unidad'   => 12,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 12.',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_subtema'  => 13,
                'id_unidad'   => 13,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 13.',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_subtema'  => 14,
                'id_unidad'   => 14,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 14.',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_subtema'  => 15,
                'id_unidad'   => 15,
                'descripcion' => 'Descripcion de subtemas: registro de prueba número 15.',
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
