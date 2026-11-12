<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipos_donacion`.
 */
class TiTiposDonacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipos_donacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipos_donacion';

        $llaves = [
            ['id_tipo_donacion'],
        ];

        $registros = [
            [
                'id_tipo_donacion' => 1,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 1.',
            ],
            [
                'id_tipo_donacion' => 2,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 2.',
            ],
            [
                'id_tipo_donacion' => 3,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 3.',
            ],
            [
                'id_tipo_donacion' => 4,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 4.',
            ],
            [
                'id_tipo_donacion' => 5,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 5.',
            ],
            [
                'id_tipo_donacion' => 6,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 6.',
            ],
            [
                'id_tipo_donacion' => 7,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 7.',
            ],
            [
                'id_tipo_donacion' => 8,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 8.',
            ],
            [
                'id_tipo_donacion' => 9,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 9.',
            ],
            [
                'id_tipo_donacion' => 10,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 10.',
            ],
            [
                'id_tipo_donacion' => 11,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 11.',
            ],
            [
                'id_tipo_donacion' => 12,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 12.',
            ],
            [
                'id_tipo_donacion' => 13,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 13.',
            ],
            [
                'id_tipo_donacion' => 14,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 14.',
            ],
            [
                'id_tipo_donacion' => 15,
                'tipo_donacion'    => 'Tipo donacion de tipos donacion: registro de prueba número 15.',
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
