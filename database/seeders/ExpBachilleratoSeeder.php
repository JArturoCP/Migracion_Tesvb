<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_bachillerato`.
 */
class ExpBachilleratoSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_bachillerato` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_bachillerato';

        $llaves = [
            ['id_bachillerato'],
        ];

        $registros = [
            [
                'id_bachillerato'   => 1,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 1',
            ],
            [
                'id_bachillerato'   => 2,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 2',
            ],
            [
                'id_bachillerato'   => 3,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 3',
            ],
            [
                'id_bachillerato'   => 4,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 4',
            ],
            [
                'id_bachillerato'   => 5,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 5',
            ],
            [
                'id_bachillerato'   => 6,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 6',
            ],
            [
                'id_bachillerato'   => 7,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 7',
            ],
            [
                'id_bachillerato'   => 8,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 8',
            ],
            [
                'id_bachillerato'   => 9,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 9',
            ],
            [
                'id_bachillerato'   => 10,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 10',
            ],
            [
                'id_bachillerato'   => 11,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 11',
            ],
            [
                'id_bachillerato'   => 12,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 12',
            ],
            [
                'id_bachillerato'   => 13,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 13',
            ],
            [
                'id_bachillerato'   => 14,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 14',
            ],
            [
                'id_bachillerato'   => 15,
                'desc_bachillerato' => 'Desc bachillerato bachillerato 15',
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
