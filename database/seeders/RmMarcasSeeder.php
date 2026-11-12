<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_marcas`.
 */
class RmMarcasSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_marcas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_marcas';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'         => 1,
                'marca'      => 'Marca marcas 1',
                'condicion'  => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'marca'      => 'Marca marcas 2',
                'condicion'  => 1,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'marca'      => 'Marca marcas 3',
                'condicion'  => 1,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'marca'      => 'Marca marcas 4',
                'condicion'  => 1,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'marca'      => 'Marca marcas 5',
                'condicion'  => 1,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'marca'      => 'Marca marcas 6',
                'condicion'  => 1,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'marca'      => 'Marca marcas 7',
                'condicion'  => 1,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'marca'      => 'Marca marcas 8',
                'condicion'  => 1,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'marca'      => 'Marca marcas 9',
                'condicion'  => 1,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'marca'      => 'Marca marcas 10',
                'condicion'  => 1,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'marca'      => 'Marca marcas 11',
                'condicion'  => 1,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'marca'      => 'Marca marcas 12',
                'condicion'  => 1,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'marca'      => 'Marca marcas 13',
                'condicion'  => 1,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'marca'      => 'Marca marcas 14',
                'condicion'  => 1,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'marca'      => 'Marca marcas 15',
                'condicion'  => 1,
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
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
