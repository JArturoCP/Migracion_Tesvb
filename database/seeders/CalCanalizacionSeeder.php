<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_canalizacion`.
 */
class CalCanalizacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_canalizacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'cal_canalizacion';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'          => 1,
                'descripcion' => 'Descripcion canalizacion 1',
            ],
            [
                'id'          => 2,
                'descripcion' => 'Descripcion canalizacion 2',
            ],
            [
                'id'          => 3,
                'descripcion' => 'Descripcion canalizacion 3',
            ],
            [
                'id'          => 4,
                'descripcion' => 'Descripcion canalizacion 4',
            ],
            [
                'id'          => 5,
                'descripcion' => 'Descripcion canalizacion 5',
            ],
            [
                'id'          => 6,
                'descripcion' => 'Descripcion canalizacion 6',
            ],
            [
                'id'          => 7,
                'descripcion' => 'Descripcion canalizacion 7',
            ],
            [
                'id'          => 8,
                'descripcion' => 'Descripcion canalizacion 8',
            ],
            [
                'id'          => 9,
                'descripcion' => 'Descripcion canalizacion 9',
            ],
            [
                'id'          => 10,
                'descripcion' => 'Descripcion canalizacion 10',
            ],
            [
                'id'          => 11,
                'descripcion' => 'Descripcion canalizacion 11',
            ],
            [
                'id'          => 12,
                'descripcion' => 'Descripcion canalizacion 12',
            ],
            [
                'id'          => 13,
                'descripcion' => 'Descripcion canalizacion 13',
            ],
            [
                'id'          => 14,
                'descripcion' => 'Descripcion canalizacion 14',
            ],
            [
                'id'          => 15,
                'descripcion' => 'Descripcion canalizacion 15',
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
