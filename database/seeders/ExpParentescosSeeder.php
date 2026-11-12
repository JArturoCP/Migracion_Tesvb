<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_parentescos`.
 */
class ExpParentescosSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_parentescos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_parentescos';

        $llaves = [
            ['id_parentesco'],
        ];

        $registros = [
            [
                'id_parentesco'   => 1,
                'desc_parentesco' => 'Desc parentesco parentescos 1',
            ],
            [
                'id_parentesco'   => 2,
                'desc_parentesco' => 'Desc parentesco parentescos 2',
            ],
            [
                'id_parentesco'   => 3,
                'desc_parentesco' => 'Desc parentesco parentescos 3',
            ],
            [
                'id_parentesco'   => 4,
                'desc_parentesco' => 'Desc parentesco parentescos 4',
            ],
            [
                'id_parentesco'   => 5,
                'desc_parentesco' => 'Desc parentesco parentescos 5',
            ],
            [
                'id_parentesco'   => 6,
                'desc_parentesco' => 'Desc parentesco parentescos 6',
            ],
            [
                'id_parentesco'   => 7,
                'desc_parentesco' => 'Desc parentesco parentescos 7',
            ],
            [
                'id_parentesco'   => 8,
                'desc_parentesco' => 'Desc parentesco parentescos 8',
            ],
            [
                'id_parentesco'   => 9,
                'desc_parentesco' => 'Desc parentesco parentescos 9',
            ],
            [
                'id_parentesco'   => 10,
                'desc_parentesco' => 'Desc parentesco parentescos 10',
            ],
            [
                'id_parentesco'   => 11,
                'desc_parentesco' => 'Desc parentesco parentescos 11',
            ],
            [
                'id_parentesco'   => 12,
                'desc_parentesco' => 'Desc parentesco parentescos 12',
            ],
            [
                'id_parentesco'   => 13,
                'desc_parentesco' => 'Desc parentesco parentescos 13',
            ],
            [
                'id_parentesco'   => 14,
                'desc_parentesco' => 'Desc parentesco parentescos 14',
            ],
            [
                'id_parentesco'   => 15,
                'desc_parentesco' => 'Desc parentesco parentescos 15',
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
