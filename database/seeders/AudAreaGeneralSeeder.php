<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_area_general`.
 */
class AudAreaGeneralSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_area_general` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_area_general';

        $llaves = [
            ['id_area_general'],
        ];

        $registros = [
            [
                'id_area_general' => 1,
                'descripcion'     => 'Descripcion area general 1',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 2,
                'descripcion'     => 'Descripcion area general 2',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 3,
                'descripcion'     => 'Descripcion area general 3',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 4,
                'descripcion'     => 'Descripcion area general 4',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 5,
                'descripcion'     => 'Descripcion area general 5',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 6,
                'descripcion'     => 'Descripcion area general 6',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 7,
                'descripcion'     => 'Descripcion area general 7',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 8,
                'descripcion'     => 'Descripcion area general 8',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 9,
                'descripcion'     => 'Descripcion area general 9',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 10,
                'descripcion'     => 'Descripcion area general 10',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 11,
                'descripcion'     => 'Descripcion area general 11',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 12,
                'descripcion'     => 'Descripcion area general 12',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 13,
                'descripcion'     => 'Descripcion area general 13',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 14,
                'descripcion'     => 'Descripcion area general 14',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_area_general' => 15,
                'descripcion'     => 'Descripcion area general 15',
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
                'deleted_at'      => null,
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
