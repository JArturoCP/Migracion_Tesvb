<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_redes_sociales`.
 */
class TiRedesSocialesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_redes_sociales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_redes_sociales';

        $llaves = [
            ['id_red_social'],
        ];

        $registros = [
            [
                'id_red_social' => 1,
                'red_social'    => 'Red social redes sociales 1',
            ],
            [
                'id_red_social' => 2,
                'red_social'    => 'Red social redes sociales 2',
            ],
            [
                'id_red_social' => 3,
                'red_social'    => 'Red social redes sociales 3',
            ],
            [
                'id_red_social' => 4,
                'red_social'    => 'Red social redes sociales 4',
            ],
            [
                'id_red_social' => 5,
                'red_social'    => 'Red social redes sociales 5',
            ],
            [
                'id_red_social' => 6,
                'red_social'    => 'Red social redes sociales 6',
            ],
            [
                'id_red_social' => 7,
                'red_social'    => 'Red social redes sociales 7',
            ],
            [
                'id_red_social' => 8,
                'red_social'    => 'Red social redes sociales 8',
            ],
            [
                'id_red_social' => 9,
                'red_social'    => 'Red social redes sociales 9',
            ],
            [
                'id_red_social' => 10,
                'red_social'    => 'Red social redes sociales 10',
            ],
            [
                'id_red_social' => 11,
                'red_social'    => 'Red social redes sociales 11',
            ],
            [
                'id_red_social' => 12,
                'red_social'    => 'Red social redes sociales 12',
            ],
            [
                'id_red_social' => 13,
                'red_social'    => 'Red social redes sociales 13',
            ],
            [
                'id_red_social' => 14,
                'red_social'    => 'Red social redes sociales 14',
            ],
            [
                'id_red_social' => 15,
                'red_social'    => 'Red social redes sociales 15',
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
