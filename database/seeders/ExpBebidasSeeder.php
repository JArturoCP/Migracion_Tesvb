<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_bebidas`.
 */
class ExpBebidasSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_bebidas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_bebidas';

        $llaves = [
            ['id_expbebidas'],
        ];

        $registros = [
            [
                'id_expbebidas'      => 1,
                'descripcion_bebida' => 'Descripcion bebida bebidas 1',
            ],
            [
                'id_expbebidas'      => 2,
                'descripcion_bebida' => 'Descripcion bebida bebidas 2',
            ],
            [
                'id_expbebidas'      => 3,
                'descripcion_bebida' => 'Descripcion bebida bebidas 3',
            ],
            [
                'id_expbebidas'      => 4,
                'descripcion_bebida' => 'Descripcion bebida bebidas 4',
            ],
            [
                'id_expbebidas'      => 5,
                'descripcion_bebida' => 'Descripcion bebida bebidas 5',
            ],
            [
                'id_expbebidas'      => 6,
                'descripcion_bebida' => 'Descripcion bebida bebidas 6',
            ],
            [
                'id_expbebidas'      => 7,
                'descripcion_bebida' => 'Descripcion bebida bebidas 7',
            ],
            [
                'id_expbebidas'      => 8,
                'descripcion_bebida' => 'Descripcion bebida bebidas 8',
            ],
            [
                'id_expbebidas'      => 9,
                'descripcion_bebida' => 'Descripcion bebida bebidas 9',
            ],
            [
                'id_expbebidas'      => 10,
                'descripcion_bebida' => 'Descripcion bebida bebidas 10',
            ],
            [
                'id_expbebidas'      => 11,
                'descripcion_bebida' => 'Descripcion bebida bebidas 11',
            ],
            [
                'id_expbebidas'      => 12,
                'descripcion_bebida' => 'Descripcion bebida bebidas 12',
            ],
            [
                'id_expbebidas'      => 13,
                'descripcion_bebida' => 'Descripcion bebida bebidas 13',
            ],
            [
                'id_expbebidas'      => 14,
                'descripcion_bebida' => 'Descripcion bebida bebidas 14',
            ],
            [
                'id_expbebidas'      => 15,
                'descripcion_bebida' => 'Descripcion bebida bebidas 15',
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
