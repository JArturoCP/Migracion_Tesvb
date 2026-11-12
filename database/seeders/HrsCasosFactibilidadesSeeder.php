<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_casos_factibilidades`.
 */
class HrsCasosFactibilidadesSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_casos_factibilidades` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_casos_factibilidades';

        $llaves = [
            ['id_caso'],
        ];

        $registros = [
            [
                'id_caso'     => 1,
                'descripcion' => 'Descripcion casos 1',
            ],
            [
                'id_caso'     => 2,
                'descripcion' => 'Descripcion casos 2',
            ],
            [
                'id_caso'     => 3,
                'descripcion' => 'Descripcion casos 3',
            ],
            [
                'id_caso'     => 4,
                'descripcion' => 'Descripcion casos 4',
            ],
            [
                'id_caso'     => 5,
                'descripcion' => 'Descripcion casos 5',
            ],
            [
                'id_caso'     => 6,
                'descripcion' => 'Descripcion casos 6',
            ],
            [
                'id_caso'     => 7,
                'descripcion' => 'Descripcion casos 7',
            ],
            [
                'id_caso'     => 8,
                'descripcion' => 'Descripcion casos 8',
            ],
            [
                'id_caso'     => 9,
                'descripcion' => 'Descripcion casos 9',
            ],
            [
                'id_caso'     => 10,
                'descripcion' => 'Descripcion casos 10',
            ],
            [
                'id_caso'     => 11,
                'descripcion' => 'Descripcion casos 11',
            ],
            [
                'id_caso'     => 12,
                'descripcion' => 'Descripcion casos 12',
            ],
            [
                'id_caso'     => 13,
                'descripcion' => 'Descripcion casos 13',
            ],
            [
                'id_caso'     => 14,
                'descripcion' => 'Descripcion casos 14',
            ],
            [
                'id_caso'     => 15,
                'descripcion' => 'Descripcion casos 15',
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
