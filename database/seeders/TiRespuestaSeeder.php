<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_respuesta`.
 */
class TiRespuestaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_respuesta` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_respuesta';

        $llaves = [
            ['id_respuesta'],
        ];

        $registros = [
            [
                'id_respuesta' => 1,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 1.',
            ],
            [
                'id_respuesta' => 2,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 2.',
            ],
            [
                'id_respuesta' => 3,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 3.',
            ],
            [
                'id_respuesta' => 4,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 4.',
            ],
            [
                'id_respuesta' => 5,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 5.',
            ],
            [
                'id_respuesta' => 6,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 6.',
            ],
            [
                'id_respuesta' => 7,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 7.',
            ],
            [
                'id_respuesta' => 8,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 8.',
            ],
            [
                'id_respuesta' => 9,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 9.',
            ],
            [
                'id_respuesta' => 10,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 10.',
            ],
            [
                'id_respuesta' => 11,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 11.',
            ],
            [
                'id_respuesta' => 12,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 12.',
            ],
            [
                'id_respuesta' => 13,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 13.',
            ],
            [
                'id_respuesta' => 14,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 14.',
            ],
            [
                'id_respuesta' => 15,
                'respuesta'    => 'Respuesta de respuesta: registro de prueba número 15.',
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
