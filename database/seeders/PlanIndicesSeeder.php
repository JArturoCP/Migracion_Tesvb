<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_indices`.
 */
class PlanIndicesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_indices` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_indices';

        $llaves = [
            ['id_indice'],
        ];

        $registros = [
            [
                'id_indice'   => 1,
                'grupo'       => 1,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 1.',
                'id_temario'  => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_indice'   => 2,
                'grupo'       => 2,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 2.',
                'id_temario'  => 2,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_indice'   => 3,
                'grupo'       => 3,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 3.',
                'id_temario'  => 3,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_indice'   => 4,
                'grupo'       => 4,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 4.',
                'id_temario'  => 4,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_indice'   => 5,
                'grupo'       => 5,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 5.',
                'id_temario'  => 5,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_indice'   => 6,
                'grupo'       => 6,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 6.',
                'id_temario'  => 6,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_indice'   => 7,
                'grupo'       => 7,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 7.',
                'id_temario'  => 7,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_indice'   => 8,
                'grupo'       => 8,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 8.',
                'id_temario'  => 8,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_indice'   => 9,
                'grupo'       => 9,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 9.',
                'id_temario'  => 9,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_indice'   => 10,
                'grupo'       => 10,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 10.',
                'id_temario'  => 10,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_indice'   => 11,
                'grupo'       => 11,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 11.',
                'id_temario'  => 11,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_indice'   => 12,
                'grupo'       => 12,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 12.',
                'id_temario'  => 12,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_indice'   => 13,
                'grupo'       => 13,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 13.',
                'id_temario'  => 13,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_indice'   => 14,
                'grupo'       => 14,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 14.',
                'id_temario'  => 14,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_indice'   => 15,
                'grupo'       => 15,
                'desc_indice' => 'Desc indice de indices: registro de prueba número 15.',
                'id_temario'  => 15,
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
