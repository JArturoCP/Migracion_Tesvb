<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_familia_union`.
 */
class ExpFamiliaUnionSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_familia_union` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_familia_union';

        $llaves = [
            ['id_familia_union'],
        ];

        $registros = [
            [
                'id_familia_union' => 1,
                'desc_union'       => 'Desc union familia union 1',
            ],
            [
                'id_familia_union' => 2,
                'desc_union'       => 'Desc union familia union 2',
            ],
            [
                'id_familia_union' => 3,
                'desc_union'       => 'Desc union familia union 3',
            ],
            [
                'id_familia_union' => 4,
                'desc_union'       => 'Desc union familia union 4',
            ],
            [
                'id_familia_union' => 5,
                'desc_union'       => 'Desc union familia union 5',
            ],
            [
                'id_familia_union' => 6,
                'desc_union'       => 'Desc union familia union 6',
            ],
            [
                'id_familia_union' => 7,
                'desc_union'       => 'Desc union familia union 7',
            ],
            [
                'id_familia_union' => 8,
                'desc_union'       => 'Desc union familia union 8',
            ],
            [
                'id_familia_union' => 9,
                'desc_union'       => 'Desc union familia union 9',
            ],
            [
                'id_familia_union' => 10,
                'desc_union'       => 'Desc union familia union 10',
            ],
            [
                'id_familia_union' => 11,
                'desc_union'       => 'Desc union familia union 11',
            ],
            [
                'id_familia_union' => 12,
                'desc_union'       => 'Desc union familia union 12',
            ],
            [
                'id_familia_union' => 13,
                'desc_union'       => 'Desc union familia union 13',
            ],
            [
                'id_familia_union' => 14,
                'desc_union'       => 'Desc union familia union 14',
            ],
            [
                'id_familia_union' => 15,
                'desc_union'       => 'Desc union familia union 15',
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
