<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_anos`.
 */
class OcAnosSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_anos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_anos';

        $llaves = [
            ['id_ano'],
        ];

        $registros = [
            [
                'id_ano'      => 1,
                'descripcion' => 1,
            ],
            [
                'id_ano'      => 2,
                'descripcion' => 2,
            ],
            [
                'id_ano'      => 3,
                'descripcion' => 3,
            ],
            [
                'id_ano'      => 4,
                'descripcion' => 4,
            ],
            [
                'id_ano'      => 5,
                'descripcion' => 5,
            ],
            [
                'id_ano'      => 6,
                'descripcion' => 6,
            ],
            [
                'id_ano'      => 7,
                'descripcion' => 7,
            ],
            [
                'id_ano'      => 8,
                'descripcion' => 8,
            ],
            [
                'id_ano'      => 9,
                'descripcion' => 9,
            ],
            [
                'id_ano'      => 10,
                'descripcion' => 10,
            ],
            [
                'id_ano'      => 11,
                'descripcion' => 11,
            ],
            [
                'id_ano'      => 12,
                'descripcion' => 12,
            ],
            [
                'id_ano'      => 13,
                'descripcion' => 13,
            ],
            [
                'id_ano'      => 14,
                'descripcion' => 14,
            ],
            [
                'id_ano'      => 15,
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
