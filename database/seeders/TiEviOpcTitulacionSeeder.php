<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_evi_opc_titulacion`.
 */
class TiEviOpcTitulacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_evi_opc_titulacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_evi_opc_titulacion';

        $llaves = [
            ['id_evi_opc_ti'],
        ];

        $registros = [
            [
                'id_evi_opc_ti' => 1,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 1.',
            ],
            [
                'id_evi_opc_ti' => 2,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 2.',
            ],
            [
                'id_evi_opc_ti' => 3,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 3.',
            ],
            [
                'id_evi_opc_ti' => 4,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 4.',
            ],
            [
                'id_evi_opc_ti' => 5,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 5.',
            ],
            [
                'id_evi_opc_ti' => 6,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 6.',
            ],
            [
                'id_evi_opc_ti' => 7,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 7.',
            ],
            [
                'id_evi_opc_ti' => 8,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 8.',
            ],
            [
                'id_evi_opc_ti' => 9,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 9.',
            ],
            [
                'id_evi_opc_ti' => 10,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 10.',
            ],
            [
                'id_evi_opc_ti' => 11,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 11.',
            ],
            [
                'id_evi_opc_ti' => 12,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 12.',
            ],
            [
                'id_evi_opc_ti' => 13,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 13.',
            ],
            [
                'id_evi_opc_ti' => 14,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 14.',
            ],
            [
                'id_evi_opc_ti' => 15,
                'descripcion'   => 'Descripcion de evi opc titulacion: registro de prueba número 15.',
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
