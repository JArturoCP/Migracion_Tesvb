<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_estadoconv`.
 */
class InvEstadoconvSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_estadoconv` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_estadoconv';

        $llaves = [
            ['id_estado'],
        ];

        $registros = [
            [
                'id_estado'   => 1,
                'desc_estado' => 'Desc estado estadoconv 1',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 2,
                'desc_estado' => 'Desc estado estadoconv 2',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 3,
                'desc_estado' => 'Desc estado estadoconv 3',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 4,
                'desc_estado' => 'Desc estado estadoconv 4',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 5,
                'desc_estado' => 'Desc estado estadoconv 5',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 6,
                'desc_estado' => 'Desc estado estadoconv 6',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 7,
                'desc_estado' => 'Desc estado estadoconv 7',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 8,
                'desc_estado' => 'Desc estado estadoconv 8',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 9,
                'desc_estado' => 'Desc estado estadoconv 9',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 10,
                'desc_estado' => 'Desc estado estadoconv 10',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 11,
                'desc_estado' => 'Desc estado estadoconv 11',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 12,
                'desc_estado' => 'Desc estado estadoconv 12',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 13,
                'desc_estado' => 'Desc estado estadoconv 13',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 14,
                'desc_estado' => 'Desc estado estadoconv 14',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_estado'   => 15,
                'desc_estado' => 'Desc estado estadoconv 15',
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
                'deleted_at'  => null,
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
