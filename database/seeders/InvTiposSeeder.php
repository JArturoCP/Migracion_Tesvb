<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_tipos`.
 */
class InvTiposSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_tipos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_tipos';

        $llaves = [
            ['id_tipo'],
        ];

        $registros = [
            [
                'id_tipo'     => 1,
                'descripcion' => 'Descripcion tipos 1',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 2,
                'descripcion' => 'Descripcion tipos 2',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 3,
                'descripcion' => 'Descripcion tipos 3',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 4,
                'descripcion' => 'Descripcion tipos 4',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 5,
                'descripcion' => 'Descripcion tipos 5',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 6,
                'descripcion' => 'Descripcion tipos 6',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 7,
                'descripcion' => 'Descripcion tipos 7',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 8,
                'descripcion' => 'Descripcion tipos 8',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 9,
                'descripcion' => 'Descripcion tipos 9',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 10,
                'descripcion' => 'Descripcion tipos 10',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 11,
                'descripcion' => 'Descripcion tipos 11',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 12,
                'descripcion' => 'Descripcion tipos 12',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 13,
                'descripcion' => 'Descripcion tipos 13',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 14,
                'descripcion' => 'Descripcion tipos 14',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_tipo'     => 15,
                'descripcion' => 'Descripcion tipos 15',
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
