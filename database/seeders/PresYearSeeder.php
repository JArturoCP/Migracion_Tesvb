<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_year`.
 */
class PresYearSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_year` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_year';

        $llaves = [
            ['id_year'],
        ];

        $registros = [
            [
                'id_year'     => 1,
                'descripcion' => 1,
            ],
            [
                'id_year'     => 2,
                'descripcion' => 2,
            ],
            [
                'id_year'     => 3,
                'descripcion' => 3,
            ],
            [
                'id_year'     => 4,
                'descripcion' => 4,
            ],
            [
                'id_year'     => 5,
                'descripcion' => 5,
            ],
            [
                'id_year'     => 6,
                'descripcion' => 6,
            ],
            [
                'id_year'     => 7,
                'descripcion' => 7,
            ],
            [
                'id_year'     => 8,
                'descripcion' => 8,
            ],
            [
                'id_year'     => 9,
                'descripcion' => 9,
            ],
            [
                'id_year'     => 10,
                'descripcion' => 10,
            ],
            [
                'id_year'     => 11,
                'descripcion' => 11,
            ],
            [
                'id_year'     => 12,
                'descripcion' => 12,
            ],
            [
                'id_year'     => 13,
                'descripcion' => 13,
            ],
            [
                'id_year'     => 14,
                'descripcion' => 14,
            ],
            [
                'id_year'     => 15,
                'descripcion' => 15,
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
