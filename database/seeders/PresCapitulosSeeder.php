<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_capitulos`.
 */
class PresCapitulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_capitulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_capitulos';

        $llaves = [
            ['id_capitulo'],
        ];

        $registros = [
            [
                'id_capitulo' => 1,
                'capitulo'    => 1,
            ],
            [
                'id_capitulo' => 2,
                'capitulo'    => 2,
            ],
            [
                'id_capitulo' => 3,
                'capitulo'    => 3,
            ],
            [
                'id_capitulo' => 4,
                'capitulo'    => 4,
            ],
            [
                'id_capitulo' => 5,
                'capitulo'    => 5,
            ],
            [
                'id_capitulo' => 6,
                'capitulo'    => 6,
            ],
            [
                'id_capitulo' => 7,
                'capitulo'    => 7,
            ],
            [
                'id_capitulo' => 8,
                'capitulo'    => 8,
            ],
            [
                'id_capitulo' => 9,
                'capitulo'    => 9,
            ],
            [
                'id_capitulo' => 10,
                'capitulo'    => 10,
            ],
            [
                'id_capitulo' => 11,
                'capitulo'    => 11,
            ],
            [
                'id_capitulo' => 12,
                'capitulo'    => 12,
            ],
            [
                'id_capitulo' => 13,
                'capitulo'    => 13,
            ],
            [
                'id_capitulo' => 14,
                'capitulo'    => 14,
            ],
            [
                'id_capitulo' => 15,
                'capitulo'    => 15,
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
