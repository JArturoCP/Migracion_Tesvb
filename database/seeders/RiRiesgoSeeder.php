<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_riesgo`.
 */
class RiRiesgoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_riesgo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiRequisitosSeeder::class,
        ]);

        $tabla = 'ri_riesgo';

        $llaves = [
            ['id_riesgo'],
        ];

        $registros = [
            [
                'id_riesgo'       => 1,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 1.',
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
                'id_requisito'    => 1,
                'id_unidad_admin' => 1,
            ],
            [
                'id_riesgo'       => 2,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 2.',
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
                'id_requisito'    => 2,
                'id_unidad_admin' => 2,
            ],
            [
                'id_riesgo'       => 3,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 3.',
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
                'id_requisito'    => 3,
                'id_unidad_admin' => 3,
            ],
            [
                'id_riesgo'       => 4,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 4.',
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
                'id_requisito'    => 4,
                'id_unidad_admin' => 4,
            ],
            [
                'id_riesgo'       => 5,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 5.',
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
                'id_requisito'    => 5,
                'id_unidad_admin' => 5,
            ],
            [
                'id_riesgo'       => 6,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 6.',
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
                'id_requisito'    => 6,
                'id_unidad_admin' => 6,
            ],
            [
                'id_riesgo'       => 7,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 7.',
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
                'id_requisito'    => 7,
                'id_unidad_admin' => 7,
            ],
            [
                'id_riesgo'       => 8,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 8.',
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
                'id_requisito'    => 8,
                'id_unidad_admin' => 8,
            ],
            [
                'id_riesgo'       => 9,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 9.',
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
                'id_requisito'    => 9,
                'id_unidad_admin' => 9,
            ],
            [
                'id_riesgo'       => 10,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 10.',
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
                'id_requisito'    => 10,
                'id_unidad_admin' => 10,
            ],
            [
                'id_riesgo'       => 11,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 11.',
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
                'id_requisito'    => 11,
                'id_unidad_admin' => 11,
            ],
            [
                'id_riesgo'       => 12,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 12.',
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
                'id_requisito'    => 12,
                'id_unidad_admin' => 12,
            ],
            [
                'id_riesgo'       => 13,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 13.',
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
                'id_requisito'    => 13,
                'id_unidad_admin' => 13,
            ],
            [
                'id_riesgo'       => 14,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 14.',
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
                'id_requisito'    => 14,
                'id_unidad_admin' => 14,
            ],
            [
                'id_riesgo'       => 15,
                'des_riesgo'      => 'Des riesgo de riesgo: registro de prueba número 15.',
                'updated_at'      => '2026-05-11 14:00:00',
                'created_at'      => '2026-05-11 14:00:00',
                'id_requisito'    => 15,
                'id_unidad_admin' => 15,
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
