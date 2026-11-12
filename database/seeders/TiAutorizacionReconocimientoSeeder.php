<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_autorizacion_reconocimiento`.
 */
class TiAutorizacionReconocimientoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_autorizacion_reconocimiento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_autorizacion_reconocimiento';

        $llaves = [
            ['id_autorizacion_reconocimiento'],
        ];

        $registros = [
            [
                'id_autorizacion_reconocimiento' => 1,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 1.',
            ],
            [
                'id_autorizacion_reconocimiento' => 2,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 2.',
            ],
            [
                'id_autorizacion_reconocimiento' => 3,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 3.',
            ],
            [
                'id_autorizacion_reconocimiento' => 4,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 4.',
            ],
            [
                'id_autorizacion_reconocimiento' => 5,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 5.',
            ],
            [
                'id_autorizacion_reconocimiento' => 6,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 6.',
            ],
            [
                'id_autorizacion_reconocimiento' => 7,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 7.',
            ],
            [
                'id_autorizacion_reconocimiento' => 8,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 8.',
            ],
            [
                'id_autorizacion_reconocimiento' => 9,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 9.',
            ],
            [
                'id_autorizacion_reconocimiento' => 10,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 10.',
            ],
            [
                'id_autorizacion_reconocimiento' => 11,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 11.',
            ],
            [
                'id_autorizacion_reconocimiento' => 12,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 12.',
            ],
            [
                'id_autorizacion_reconocimiento' => 13,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 13.',
            ],
            [
                'id_autorizacion_reconocimiento' => 14,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 14.',
            ],
            [
                'id_autorizacion_reconocimiento' => 15,
                'autorizacion_reconocimiento'    => 'Autorizacion reconocimiento de autorizacion reconocimiento: registro de prueba número 15.',
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
