<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_beca`.
 */
class ExpBecaSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_beca` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_beca';

        $llaves = [
            ['id_expbeca'],
        ];

        $registros = [
            [
                'id_expbeca'       => 1,
                'descripcion_beca' => 'Descripcion beca beca 1',
            ],
            [
                'id_expbeca'       => 2,
                'descripcion_beca' => 'Descripcion beca beca 2',
            ],
            [
                'id_expbeca'       => 3,
                'descripcion_beca' => 'Descripcion beca beca 3',
            ],
            [
                'id_expbeca'       => 4,
                'descripcion_beca' => 'Descripcion beca beca 4',
            ],
            [
                'id_expbeca'       => 5,
                'descripcion_beca' => 'Descripcion beca beca 5',
            ],
            [
                'id_expbeca'       => 6,
                'descripcion_beca' => 'Descripcion beca beca 6',
            ],
            [
                'id_expbeca'       => 7,
                'descripcion_beca' => 'Descripcion beca beca 7',
            ],
            [
                'id_expbeca'       => 8,
                'descripcion_beca' => 'Descripcion beca beca 8',
            ],
            [
                'id_expbeca'       => 9,
                'descripcion_beca' => 'Descripcion beca beca 9',
            ],
            [
                'id_expbeca'       => 10,
                'descripcion_beca' => 'Descripcion beca beca 10',
            ],
            [
                'id_expbeca'       => 11,
                'descripcion_beca' => 'Descripcion beca beca 11',
            ],
            [
                'id_expbeca'       => 12,
                'descripcion_beca' => 'Descripcion beca beca 12',
            ],
            [
                'id_expbeca'       => 13,
                'descripcion_beca' => 'Descripcion beca beca 13',
            ],
            [
                'id_expbeca'       => 14,
                'descripcion_beca' => 'Descripcion beca beca 14',
            ],
            [
                'id_expbeca'       => 15,
                'descripcion_beca' => 'Descripcion beca beca 15',
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
