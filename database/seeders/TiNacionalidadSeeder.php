<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_nacionalidad`.
 */
class TiNacionalidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_nacionalidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_nacionalidad';

        $llaves = [
            ['id_nacionalidad'],
        ];

        $registros = [
            [
                'id_nacionalidad' => 1,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 2,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 3,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 4,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 5,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 6,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 7,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 8,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 9,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 10,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 11,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 12,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 13,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 14,
                'nacionalidad'    => 'MEXICANA',
            ],
            [
                'id_nacionalidad' => 15,
                'nacionalidad'    => 'MEXICANA',
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
