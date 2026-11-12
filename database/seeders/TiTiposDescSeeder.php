<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipos_desc`.
 */
class TiTiposDescSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipos_desc` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipos_desc';

        $llaves = [
            ['id_tipo_desc'],
        ];

        $registros = [
            [
                'id_tipo_desc' => 1,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 1.',
            ],
            [
                'id_tipo_desc' => 2,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 2.',
            ],
            [
                'id_tipo_desc' => 3,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 3.',
            ],
            [
                'id_tipo_desc' => 4,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 4.',
            ],
            [
                'id_tipo_desc' => 5,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 5.',
            ],
            [
                'id_tipo_desc' => 6,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 6.',
            ],
            [
                'id_tipo_desc' => 7,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 7.',
            ],
            [
                'id_tipo_desc' => 8,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 8.',
            ],
            [
                'id_tipo_desc' => 9,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 9.',
            ],
            [
                'id_tipo_desc' => 10,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 10.',
            ],
            [
                'id_tipo_desc' => 11,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 11.',
            ],
            [
                'id_tipo_desc' => 12,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 12.',
            ],
            [
                'id_tipo_desc' => 13,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 13.',
            ],
            [
                'id_tipo_desc' => 14,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 14.',
            ],
            [
                'id_tipo_desc' => 15,
                'tipo_desc'    => 'Tipo desc de tipos desc: registro de prueba número 15.',
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
