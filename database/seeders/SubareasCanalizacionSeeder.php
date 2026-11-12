<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `subareas_canalizacion`.
 */
class SubareasCanalizacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `subareas_canalizacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'subareas_canalizacion';

        $llaves = [
            ['id_subarea'],
        ];

        $registros = [
            [
                'id_subarea'          => 1,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 1',
            ],
            [
                'id_subarea'          => 2,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 2',
            ],
            [
                'id_subarea'          => 3,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 3',
            ],
            [
                'id_subarea'          => 4,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 4',
            ],
            [
                'id_subarea'          => 5,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 5',
            ],
            [
                'id_subarea'          => 6,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 6',
            ],
            [
                'id_subarea'          => 7,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 7',
            ],
            [
                'id_subarea'          => 8,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 8',
            ],
            [
                'id_subarea'          => 9,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 9',
            ],
            [
                'id_subarea'          => 10,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 10',
            ],
            [
                'id_subarea'          => 11,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 11',
            ],
            [
                'id_subarea'          => 12,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 12',
            ],
            [
                'id_subarea'          => 13,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 13',
            ],
            [
                'id_subarea'          => 14,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 14',
            ],
            [
                'id_subarea'          => 15,
                'descripcion_subarea' => 'Descripcion subarea subareas canalizacion 15',
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
