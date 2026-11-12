<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_area_general_unidad`.
 */
class AudAreaGeneralUnidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_area_general_unidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAreaGeneralSeeder::class,
        ]);

        $tabla = 'aud_area_general_unidad';

        $llaves = [
            ['id_area_general_unidad'],
        ];

        $registros = [
            [
                'id_area_general_unidad' => 1,
                'id_area_general'        => 1,
                'id_unidad_admin'        => 1,
                'created_at'             => '2026-01-05',
                'updated_at'             => '2026-01-05',
                'deleted_at'             => '2026-01-05',
            ],
            [
                'id_area_general_unidad' => 2,
                'id_area_general'        => 2,
                'id_unidad_admin'        => 2,
                'created_at'             => '2026-01-14',
                'updated_at'             => '2026-01-14',
                'deleted_at'             => '2026-01-14',
            ],
            [
                'id_area_general_unidad' => 3,
                'id_area_general'        => 3,
                'id_unidad_admin'        => 3,
                'created_at'             => '2026-01-23',
                'updated_at'             => '2026-01-23',
                'deleted_at'             => '2026-01-23',
            ],
            [
                'id_area_general_unidad' => 4,
                'id_area_general'        => 4,
                'id_unidad_admin'        => 4,
                'created_at'             => '2026-02-01',
                'updated_at'             => '2026-02-01',
                'deleted_at'             => '2026-02-01',
            ],
            [
                'id_area_general_unidad' => 5,
                'id_area_general'        => 5,
                'id_unidad_admin'        => 5,
                'created_at'             => '2026-02-10',
                'updated_at'             => '2026-02-10',
                'deleted_at'             => '2026-02-10',
            ],
            [
                'id_area_general_unidad' => 6,
                'id_area_general'        => 6,
                'id_unidad_admin'        => 6,
                'created_at'             => '2026-02-19',
                'updated_at'             => '2026-02-19',
                'deleted_at'             => '2026-02-19',
            ],
            [
                'id_area_general_unidad' => 7,
                'id_area_general'        => 7,
                'id_unidad_admin'        => 7,
                'created_at'             => '2026-02-28',
                'updated_at'             => '2026-02-28',
                'deleted_at'             => '2026-02-28',
            ],
            [
                'id_area_general_unidad' => 8,
                'id_area_general'        => 8,
                'id_unidad_admin'        => 8,
                'created_at'             => '2026-03-09',
                'updated_at'             => '2026-03-09',
                'deleted_at'             => '2026-03-09',
            ],
            [
                'id_area_general_unidad' => 9,
                'id_area_general'        => 9,
                'id_unidad_admin'        => 9,
                'created_at'             => '2026-03-18',
                'updated_at'             => '2026-03-18',
                'deleted_at'             => '2026-03-18',
            ],
            [
                'id_area_general_unidad' => 10,
                'id_area_general'        => 10,
                'id_unidad_admin'        => 10,
                'created_at'             => '2026-03-27',
                'updated_at'             => '2026-03-27',
                'deleted_at'             => '2026-03-27',
            ],
            [
                'id_area_general_unidad' => 11,
                'id_area_general'        => 11,
                'id_unidad_admin'        => 11,
                'created_at'             => '2026-04-05',
                'updated_at'             => '2026-04-05',
                'deleted_at'             => '2026-04-05',
            ],
            [
                'id_area_general_unidad' => 12,
                'id_area_general'        => 12,
                'id_unidad_admin'        => 12,
                'created_at'             => '2026-04-14',
                'updated_at'             => '2026-04-14',
                'deleted_at'             => '2026-04-14',
            ],
            [
                'id_area_general_unidad' => 13,
                'id_area_general'        => 13,
                'id_unidad_admin'        => 13,
                'created_at'             => '2026-04-23',
                'updated_at'             => '2026-04-23',
                'deleted_at'             => '2026-04-23',
            ],
            [
                'id_area_general_unidad' => 14,
                'id_area_general'        => 14,
                'id_unidad_admin'        => 14,
                'created_at'             => '2026-05-02',
                'updated_at'             => '2026-05-02',
                'deleted_at'             => '2026-05-02',
            ],
            [
                'id_area_general_unidad' => 15,
                'id_area_general'        => 15,
                'id_unidad_admin'        => 15,
                'created_at'             => '2026-05-11',
                'updated_at'             => '2026-05-11',
                'deleted_at'             => '2026-05-11',
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
