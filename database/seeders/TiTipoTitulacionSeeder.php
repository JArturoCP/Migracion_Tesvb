<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipo_titulacion`.
 */
class TiTipoTitulacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipo_titulacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipo_titulacion';

        $llaves = [
            ['id_tipo_titulacion'],
        ];

        $registros = [
            [
                'id_tipo_titulacion' => 1,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 1.',
            ],
            [
                'id_tipo_titulacion' => 2,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 2.',
            ],
            [
                'id_tipo_titulacion' => 3,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 3.',
            ],
            [
                'id_tipo_titulacion' => 4,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 4.',
            ],
            [
                'id_tipo_titulacion' => 5,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 5.',
            ],
            [
                'id_tipo_titulacion' => 6,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 6.',
            ],
            [
                'id_tipo_titulacion' => 7,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 7.',
            ],
            [
                'id_tipo_titulacion' => 8,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 8.',
            ],
            [
                'id_tipo_titulacion' => 9,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 9.',
            ],
            [
                'id_tipo_titulacion' => 10,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 10.',
            ],
            [
                'id_tipo_titulacion' => 11,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 11.',
            ],
            [
                'id_tipo_titulacion' => 12,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 12.',
            ],
            [
                'id_tipo_titulacion' => 13,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 13.',
            ],
            [
                'id_tipo_titulacion' => 14,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 14.',
            ],
            [
                'id_tipo_titulacion' => 15,
                'tipo_titulacion'    => 'Tipo titulacion de tipo titulacion: registro de prueba número 15.',
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
