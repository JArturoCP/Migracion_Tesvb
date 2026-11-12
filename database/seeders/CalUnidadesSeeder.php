<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_unidades`.
 */
class CalUnidadesSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_unidades` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'cal_unidades';

        $llaves = [
            ['id_unidad'],
        ];

        $registros = [
            [
                'id_unidad'   => 1,
                'descripcion' => 'UNIDAD 1',
                'abreviacion' => 'U1',
            ],
            [
                'id_unidad'   => 2,
                'descripcion' => 'UNIDAD 2',
                'abreviacion' => 'U2',
            ],
            [
                'id_unidad'   => 3,
                'descripcion' => 'UNIDAD 3',
                'abreviacion' => 'U3',
            ],
            [
                'id_unidad'   => 4,
                'descripcion' => 'UNIDAD 4',
                'abreviacion' => 'U4',
            ],
            [
                'id_unidad'   => 5,
                'descripcion' => 'UNIDAD 5',
                'abreviacion' => 'U5',
            ],
            [
                'id_unidad'   => 6,
                'descripcion' => 'UNIDAD 6',
                'abreviacion' => 'U6',
            ],
            [
                'id_unidad'   => 7,
                'descripcion' => 'UNIDAD 7',
                'abreviacion' => 'U7',
            ],
            [
                'id_unidad'   => 8,
                'descripcion' => 'UNIDAD 8',
                'abreviacion' => 'U8',
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
