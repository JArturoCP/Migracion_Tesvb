<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_mes`.
 */
class PresMesSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_mes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_mes';

        $llaves = [
            ['id_mes'],
        ];

        $registros = [
            [
                'id_mes' => 1,
                'mes'    => 'Mes mes 1',
            ],
            [
                'id_mes' => 2,
                'mes'    => 'Mes mes 2',
            ],
            [
                'id_mes' => 3,
                'mes'    => 'Mes mes 3',
            ],
            [
                'id_mes' => 4,
                'mes'    => 'Mes mes 4',
            ],
            [
                'id_mes' => 5,
                'mes'    => 'Mes mes 5',
            ],
            [
                'id_mes' => 6,
                'mes'    => 'Mes mes 6',
            ],
            [
                'id_mes' => 7,
                'mes'    => 'Mes mes 7',
            ],
            [
                'id_mes' => 8,
                'mes'    => 'Mes mes 8',
            ],
            [
                'id_mes' => 9,
                'mes'    => 'Mes mes 9',
            ],
            [
                'id_mes' => 10,
                'mes'    => 'Mes mes 10',
            ],
            [
                'id_mes' => 11,
                'mes'    => 'Mes mes 11',
            ],
            [
                'id_mes' => 12,
                'mes'    => 'Mes mes 12',
            ],
            [
                'id_mes' => 13,
                'mes'    => 'Mes mes 13',
            ],
            [
                'id_mes' => 14,
                'mes'    => 'Mes mes 14',
            ],
            [
                'id_mes' => 15,
                'mes'    => 'Mes mes 15',
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
