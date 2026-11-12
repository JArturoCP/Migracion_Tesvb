<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_letras`.
 */
class PresLetrasSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_letras` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_letras';

        $llaves = [
            ['id_letra'],
        ];

        $registros = [
            [
                'id_letra' => 1,
                'letra'    => 'V1',
            ],
            [
                'id_letra' => 2,
                'letra'    => 'V2',
            ],
            [
                'id_letra' => 3,
                'letra'    => 'V3',
            ],
            [
                'id_letra' => 4,
                'letra'    => 'V4',
            ],
            [
                'id_letra' => 5,
                'letra'    => 'V5',
            ],
            [
                'id_letra' => 6,
                'letra'    => 'V6',
            ],
            [
                'id_letra' => 7,
                'letra'    => 'V7',
            ],
            [
                'id_letra' => 8,
                'letra'    => 'V8',
            ],
            [
                'id_letra' => 9,
                'letra'    => 'V9',
            ],
            [
                'id_letra' => 10,
                'letra'    => 'V10',
            ],
            [
                'id_letra' => 11,
                'letra'    => 'V11',
            ],
            [
                'id_letra' => 12,
                'letra'    => 'V12',
            ],
            [
                'id_letra' => 13,
                'letra'    => 'V13',
            ],
            [
                'id_letra' => 14,
                'letra'    => 'V14',
            ],
            [
                'id_letra' => 15,
                'letra'    => 'V15',
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
