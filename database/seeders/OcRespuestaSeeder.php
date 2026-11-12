<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_respuesta`.
 */
class OcRespuestaSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_respuesta` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_respuesta';

        $llaves = [
            ['id_respuesta', 'respuesta'],
        ];

        $registros = [
            [
                'id_respuesta' => 1,
                'respuesta'    => 'V1',
            ],
            [
                'id_respuesta' => 2,
                'respuesta'    => 'V2',
            ],
            [
                'id_respuesta' => 3,
                'respuesta'    => 'V3',
            ],
            [
                'id_respuesta' => 4,
                'respuesta'    => 'V4',
            ],
            [
                'id_respuesta' => 5,
                'respuesta'    => 'V5',
            ],
            [
                'id_respuesta' => 6,
                'respuesta'    => 'V6',
            ],
            [
                'id_respuesta' => 7,
                'respuesta'    => 'V7',
            ],
            [
                'id_respuesta' => 8,
                'respuesta'    => 'V8',
            ],
            [
                'id_respuesta' => 9,
                'respuesta'    => 'V9',
            ],
            [
                'id_respuesta' => 10,
                'respuesta'    => 'V10',
            ],
            [
                'id_respuesta' => 11,
                'respuesta'    => 'V11',
            ],
            [
                'id_respuesta' => 12,
                'respuesta'    => 'V12',
            ],
            [
                'id_respuesta' => 13,
                'respuesta'    => 'V13',
            ],
            [
                'id_respuesta' => 14,
                'respuesta'    => 'V14',
            ],
            [
                'id_respuesta' => 15,
                'respuesta'    => 'V15',
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
