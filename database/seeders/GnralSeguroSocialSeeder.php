<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_seguro_social`.
 */
class GnralSeguroSocialSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_seguro_social` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_seguro_social';

        $llaves = [
            ['id_seguro_social'],
        ];

        $registros = [
            [
                'id_seguro_social' => 1,
                'descripcion'      => 'IMSS',
            ],
            [
                'id_seguro_social' => 2,
                'descripcion'      => 'ISSSTE',
            ],
            [
                'id_seguro_social' => 3,
                'descripcion'      => 'ISSEMYM',
            ],
            [
                'id_seguro_social' => 4,
                'descripcion'      => 'IMSS-BIENESTAR',
            ],
            [
                'id_seguro_social' => 5,
                'descripcion'      => 'NINGUNO',
            ],
            [
                'id_seguro_social' => 6,
                'descripcion'      => 'IMSS 6',
            ],
            [
                'id_seguro_social' => 7,
                'descripcion'      => 'ISSSTE 7',
            ],
            [
                'id_seguro_social' => 8,
                'descripcion'      => 'ISSEMYM 8',
            ],
            [
                'id_seguro_social' => 9,
                'descripcion'      => 'IMSS-BIENESTAR 9',
            ],
            [
                'id_seguro_social' => 10,
                'descripcion'      => 'NINGUNO 10',
            ],
            [
                'id_seguro_social' => 11,
                'descripcion'      => 'IMSS 11',
            ],
            [
                'id_seguro_social' => 12,
                'descripcion'      => 'ISSSTE 12',
            ],
            [
                'id_seguro_social' => 13,
                'descripcion'      => 'ISSEMYM 13',
            ],
            [
                'id_seguro_social' => 14,
                'descripcion'      => 'IMSS-BIENESTAR 14',
            ],
            [
                'id_seguro_social' => 15,
                'descripcion'      => 'NINGUNO 15',
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
