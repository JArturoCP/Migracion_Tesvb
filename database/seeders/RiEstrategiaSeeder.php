<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_estrategia`.
 */
class RiEstrategiaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_estrategia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_estrategia';

        $llaves = [
            ['id_estrategia'],
        ];

        $registros = [
            [
                'id_estrategia' => 1,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 1.',
                'updated_at'    => '2026-01-05 09:00:00',
                'created_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 2,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 2.',
                'updated_at'    => '2026-01-14 10:00:00',
                'created_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 3,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 3.',
                'updated_at'    => '2026-01-23 11:00:00',
                'created_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 4,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 4.',
                'updated_at'    => '2026-02-01 12:00:00',
                'created_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 5,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 5.',
                'updated_at'    => '2026-02-10 13:00:00',
                'created_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 6,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 6.',
                'updated_at'    => '2026-02-19 14:00:00',
                'created_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 7,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 7.',
                'updated_at'    => '2026-02-28 15:00:00',
                'created_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 8,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 8.',
                'updated_at'    => '2026-03-09 16:00:00',
                'created_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 9,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 9.',
                'updated_at'    => '2026-03-18 08:00:00',
                'created_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 10,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 10.',
                'updated_at'    => '2026-03-27 09:00:00',
                'created_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 11,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 11.',
                'updated_at'    => '2026-04-05 10:00:00',
                'created_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 12,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 12.',
                'updated_at'    => '2026-04-14 11:00:00',
                'created_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 13,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 13.',
                'updated_at'    => '2026-04-23 12:00:00',
                'created_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 14,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 14.',
                'updated_at'    => '2026-05-02 13:00:00',
                'created_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_estrategia' => 15,
                'descripcion'   => 'Descripcion de estrategia: registro de prueba número 15.',
                'updated_at'    => '2026-05-11 14:00:00',
                'created_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
