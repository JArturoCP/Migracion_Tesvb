<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `areas_canalizacion`.
 */
class AreasCanalizacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `areas_canalizacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'areas_canalizacion';

        $llaves = [
            ['id_area'],
        ];

        $registros = [
            [
                'id_area'          => 1,
                'descripcion_area' => 'Descripcion area areas canal 1',
            ],
            [
                'id_area'          => 2,
                'descripcion_area' => 'Descripcion area areas canal 2',
            ],
            [
                'id_area'          => 3,
                'descripcion_area' => 'Descripcion area areas canal 3',
            ],
            [
                'id_area'          => 4,
                'descripcion_area' => 'Descripcion area areas canal 4',
            ],
            [
                'id_area'          => 5,
                'descripcion_area' => 'Descripcion area areas canal 5',
            ],
            [
                'id_area'          => 6,
                'descripcion_area' => 'Descripcion area areas canal 6',
            ],
            [
                'id_area'          => 7,
                'descripcion_area' => 'Descripcion area areas canal 7',
            ],
            [
                'id_area'          => 8,
                'descripcion_area' => 'Descripcion area areas canal 8',
            ],
            [
                'id_area'          => 9,
                'descripcion_area' => 'Descripcion area areas canal 9',
            ],
            [
                'id_area'          => 10,
                'descripcion_area' => 'Descripcion area areas cana 10',
            ],
            [
                'id_area'          => 11,
                'descripcion_area' => 'Descripcion area areas cana 11',
            ],
            [
                'id_area'          => 12,
                'descripcion_area' => 'Descripcion area areas cana 12',
            ],
            [
                'id_area'          => 13,
                'descripcion_area' => 'Descripcion area areas cana 13',
            ],
            [
                'id_area'          => 14,
                'descripcion_area' => 'Descripcion area areas cana 14',
            ],
            [
                'id_area'          => 15,
                'descripcion_area' => 'Descripcion area areas cana 15',
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
