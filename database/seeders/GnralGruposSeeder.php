<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_grupos`.
 */
class GnralGruposSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_grupos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_grupos';

        $llaves = [
            ['id_grupo'],
        ];

        $registros = [
            [
                'id_grupo' => 1,
                'grupo'    => 101,
            ],
            [
                'id_grupo' => 2,
                'grupo'    => 201,
            ],
            [
                'id_grupo' => 3,
                'grupo'    => 301,
            ],
            [
                'id_grupo' => 4,
                'grupo'    => 401,
            ],
            [
                'id_grupo' => 5,
                'grupo'    => 501,
            ],
            [
                'id_grupo' => 6,
                'grupo'    => 601,
            ],
            [
                'id_grupo' => 7,
                'grupo'    => 701,
            ],
            [
                'id_grupo' => 8,
                'grupo'    => 801,
            ],
            [
                'id_grupo' => 9,
                'grupo'    => 901,
            ],
            [
                'id_grupo' => 10,
                'grupo'    => 1001,
            ],
            [
                'id_grupo' => 11,
                'grupo'    => 1101,
            ],
            [
                'id_grupo' => 12,
                'grupo'    => 1201,
            ],
            [
                'id_grupo' => 13,
                'grupo'    => 102,
            ],
            [
                'id_grupo' => 14,
                'grupo'    => 202,
            ],
            [
                'id_grupo' => 15,
                'grupo'    => 302,
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
