<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `adeudo_depto`.
 */
class AdeudoDeptoSeeder extends Seeder
{
    /**
     * Pobla la tabla `adeudo_depto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'adeudo_depto';

        $llaves = [
            ['id_dep'],
        ];

        $registros = [
            [
                'id_dep'      => 1,
                'descripcion' => 'Descripcion adeudo depto 1',
            ],
            [
                'id_dep'      => 2,
                'descripcion' => 'Descripcion adeudo depto 2',
            ],
            [
                'id_dep'      => 3,
                'descripcion' => 'Descripcion adeudo depto 3',
            ],
            [
                'id_dep'      => 4,
                'descripcion' => 'Descripcion adeudo depto 4',
            ],
            [
                'id_dep'      => 5,
                'descripcion' => 'Descripcion adeudo depto 5',
            ],
            [
                'id_dep'      => 6,
                'descripcion' => 'Descripcion adeudo depto 6',
            ],
            [
                'id_dep'      => 7,
                'descripcion' => 'Descripcion adeudo depto 7',
            ],
            [
                'id_dep'      => 8,
                'descripcion' => 'Descripcion adeudo depto 8',
            ],
            [
                'id_dep'      => 9,
                'descripcion' => 'Descripcion adeudo depto 9',
            ],
            [
                'id_dep'      => 10,
                'descripcion' => 'Descripcion adeudo depto 10',
            ],
            [
                'id_dep'      => 11,
                'descripcion' => 'Descripcion adeudo depto 11',
            ],
            [
                'id_dep'      => 12,
                'descripcion' => 'Descripcion adeudo depto 12',
            ],
            [
                'id_dep'      => 13,
                'descripcion' => 'Descripcion adeudo depto 13',
            ],
            [
                'id_dep'      => 14,
                'descripcion' => 'Descripcion adeudo depto 14',
            ],
            [
                'id_dep'      => 15,
                'descripcion' => 'Descripcion adeudo depto 15',
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
