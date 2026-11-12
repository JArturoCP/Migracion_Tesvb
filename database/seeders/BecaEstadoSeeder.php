<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_estado`.
 */
class BecaEstadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_estado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'beca_estado';

        $llaves = [
            ['id_beca_estado'],
        ];

        $registros = [
            [
                'id_beca_estado' => 1,
                'descripcion'    => 'Descripcion estado 1',
            ],
            [
                'id_beca_estado' => 2,
                'descripcion'    => 'Descripcion estado 2',
            ],
            [
                'id_beca_estado' => 3,
                'descripcion'    => 'Descripcion estado 3',
            ],
            [
                'id_beca_estado' => 4,
                'descripcion'    => 'Descripcion estado 4',
            ],
            [
                'id_beca_estado' => 5,
                'descripcion'    => 'Descripcion estado 5',
            ],
            [
                'id_beca_estado' => 6,
                'descripcion'    => 'Descripcion estado 6',
            ],
            [
                'id_beca_estado' => 7,
                'descripcion'    => 'Descripcion estado 7',
            ],
            [
                'id_beca_estado' => 8,
                'descripcion'    => 'Descripcion estado 8',
            ],
            [
                'id_beca_estado' => 9,
                'descripcion'    => 'Descripcion estado 9',
            ],
            [
                'id_beca_estado' => 10,
                'descripcion'    => 'Descripcion estado 10',
            ],
            [
                'id_beca_estado' => 11,
                'descripcion'    => 'Descripcion estado 11',
            ],
            [
                'id_beca_estado' => 12,
                'descripcion'    => 'Descripcion estado 12',
            ],
            [
                'id_beca_estado' => 13,
                'descripcion'    => 'Descripcion estado 13',
            ],
            [
                'id_beca_estado' => 14,
                'descripcion'    => 'Descripcion estado 14',
            ],
            [
                'id_beca_estado' => 15,
                'descripcion'    => 'Descripcion estado 15',
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
