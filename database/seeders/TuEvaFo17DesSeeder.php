<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_fo17_des`.
 */
class TuEvaFo17DesSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_fo17_des` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_eva_fo17_des';

        $llaves = [
            ['id_des'],
        ];

        $registros = [
            [
                'id_des' => 1,
                'des'    => '1',
            ],
            [
                'id_des' => 2,
                'des'    => '2',
            ],
            [
                'id_des' => 3,
                'des'    => '3',
            ],
            [
                'id_des' => 4,
                'des'    => '4',
            ],
            [
                'id_des' => 5,
                'des'    => '5',
            ],
            [
                'id_des' => 6,
                'des'    => '6',
            ],
            [
                'id_des' => 7,
                'des'    => '7',
            ],
            [
                'id_des' => 8,
                'des'    => '8',
            ],
            [
                'id_des' => 9,
                'des'    => '9',
            ],
            [
                'id_des' => 10,
                'des'    => '10',
            ],
            [
                'id_des' => 11,
                'des'    => '11',
            ],
            [
                'id_des' => 12,
                'des'    => '12',
            ],
            [
                'id_des' => 13,
                'des'    => '13',
            ],
            [
                'id_des' => 14,
                'des'    => '14',
            ],
            [
                'id_des' => 15,
                'des'    => '15',
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
