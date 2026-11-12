<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_descuento`.
 */
class BecaDescuentoSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_descuento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'beca_descuento';

        $llaves = [
            ['id_descuento'],
        ];

        $registros = [
            [
                'id_descuento' => 1,
                'descripcion'  => 'Descripcion descuento 1',
            ],
            [
                'id_descuento' => 2,
                'descripcion'  => 'Descripcion descuento 2',
            ],
            [
                'id_descuento' => 3,
                'descripcion'  => 'Descripcion descuento 3',
            ],
            [
                'id_descuento' => 4,
                'descripcion'  => 'Descripcion descuento 4',
            ],
            [
                'id_descuento' => 5,
                'descripcion'  => 'Descripcion descuento 5',
            ],
            [
                'id_descuento' => 6,
                'descripcion'  => 'Descripcion descuento 6',
            ],
            [
                'id_descuento' => 7,
                'descripcion'  => 'Descripcion descuento 7',
            ],
            [
                'id_descuento' => 8,
                'descripcion'  => 'Descripcion descuento 8',
            ],
            [
                'id_descuento' => 9,
                'descripcion'  => 'Descripcion descuento 9',
            ],
            [
                'id_descuento' => 10,
                'descripcion'  => 'Descripcion descuento 10',
            ],
            [
                'id_descuento' => 11,
                'descripcion'  => 'Descripcion descuento 11',
            ],
            [
                'id_descuento' => 12,
                'descripcion'  => 'Descripcion descuento 12',
            ],
            [
                'id_descuento' => 13,
                'descripcion'  => 'Descripcion descuento 13',
            ],
            [
                'id_descuento' => 14,
                'descripcion'  => 'Descripcion descuento 14',
            ],
            [
                'id_descuento' => 15,
                'descripcion'  => 'Descripcion descuento 15',
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
