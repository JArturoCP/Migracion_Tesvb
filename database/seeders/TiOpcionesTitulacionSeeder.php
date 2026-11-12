<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_opciones_titulacion`.
 */
class TiOpcionesTitulacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_opciones_titulacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_opciones_titulacion';

        $llaves = [
            ['id_opcion_titulacion'],
        ];

        $registros = [
            [
                'id_opcion_titulacion' => 1,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 1.',
                'id_tipo_evidencia'    => 1,
            ],
            [
                'id_opcion_titulacion' => 2,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 2.',
                'id_tipo_evidencia'    => 2,
            ],
            [
                'id_opcion_titulacion' => 3,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 3.',
                'id_tipo_evidencia'    => 3,
            ],
            [
                'id_opcion_titulacion' => 4,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 4.',
                'id_tipo_evidencia'    => 4,
            ],
            [
                'id_opcion_titulacion' => 5,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 5.',
                'id_tipo_evidencia'    => 5,
            ],
            [
                'id_opcion_titulacion' => 6,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 6.',
                'id_tipo_evidencia'    => 6,
            ],
            [
                'id_opcion_titulacion' => 7,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 7.',
                'id_tipo_evidencia'    => 7,
            ],
            [
                'id_opcion_titulacion' => 8,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 8.',
                'id_tipo_evidencia'    => 8,
            ],
            [
                'id_opcion_titulacion' => 9,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 9.',
                'id_tipo_evidencia'    => 9,
            ],
            [
                'id_opcion_titulacion' => 10,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 10.',
                'id_tipo_evidencia'    => 10,
            ],
            [
                'id_opcion_titulacion' => 11,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 11.',
                'id_tipo_evidencia'    => 11,
            ],
            [
                'id_opcion_titulacion' => 12,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 12.',
                'id_tipo_evidencia'    => 12,
            ],
            [
                'id_opcion_titulacion' => 13,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 13.',
                'id_tipo_evidencia'    => 13,
            ],
            [
                'id_opcion_titulacion' => 14,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 14.',
                'id_tipo_evidencia'    => 14,
            ],
            [
                'id_opcion_titulacion' => 15,
                'opcion_titulacion'    => 'Opcion titulacion de opciones titulacion: registro de prueba número 15.',
                'id_tipo_evidencia'    => 15,
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
