<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipo_jurado`.
 */
class TiTipoJuradoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipo_jurado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipo_jurado';

        $llaves = [
            ['id_tipo_jurado'],
        ];

        $registros = [
            [
                'id_tipo_jurado'     => 1,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 1.',
            ],
            [
                'id_tipo_jurado'     => 2,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 2.',
            ],
            [
                'id_tipo_jurado'     => 3,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 3.',
            ],
            [
                'id_tipo_jurado'     => 4,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 4.',
            ],
            [
                'id_tipo_jurado'     => 5,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 5.',
            ],
            [
                'id_tipo_jurado'     => 6,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 6.',
            ],
            [
                'id_tipo_jurado'     => 7,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 7.',
            ],
            [
                'id_tipo_jurado'     => 8,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 8.',
            ],
            [
                'id_tipo_jurado'     => 9,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 9.',
            ],
            [
                'id_tipo_jurado'     => 10,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 10.',
            ],
            [
                'id_tipo_jurado'     => 11,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 11.',
            ],
            [
                'id_tipo_jurado'     => 12,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 12.',
            ],
            [
                'id_tipo_jurado'     => 13,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 13.',
            ],
            [
                'id_tipo_jurado'     => 14,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 14.',
            ],
            [
                'id_tipo_jurado'     => 15,
                'descripcion_jurado' => 'Descripcion jurado de tipo jurado: registro de prueba número 15.',
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
