<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_opcion_cal_titulacion`.
 */
class EncOpcionCalTitulacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_opcion_cal_titulacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'enc_opcion_cal_titulacion';

        $llaves = [
            ['id_opcion_cal_titulacion'],
        ];

        $registros = [
            [
                'id_opcion_cal_titulacion' => 1,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 1.',
                'valor'                    => 1,
            ],
            [
                'id_opcion_cal_titulacion' => 2,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 2.',
                'valor'                    => 2,
            ],
            [
                'id_opcion_cal_titulacion' => 3,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 3.',
                'valor'                    => 3,
            ],
            [
                'id_opcion_cal_titulacion' => 4,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 4.',
                'valor'                    => 4,
            ],
            [
                'id_opcion_cal_titulacion' => 5,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 5.',
                'valor'                    => 5,
            ],
            [
                'id_opcion_cal_titulacion' => 6,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 6.',
                'valor'                    => 6,
            ],
            [
                'id_opcion_cal_titulacion' => 7,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 7.',
                'valor'                    => 7,
            ],
            [
                'id_opcion_cal_titulacion' => 8,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 8.',
                'valor'                    => 8,
            ],
            [
                'id_opcion_cal_titulacion' => 9,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 9.',
                'valor'                    => 9,
            ],
            [
                'id_opcion_cal_titulacion' => 10,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 10.',
                'valor'                    => 10,
            ],
            [
                'id_opcion_cal_titulacion' => 11,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 11.',
                'valor'                    => 11,
            ],
            [
                'id_opcion_cal_titulacion' => 12,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 12.',
                'valor'                    => 12,
            ],
            [
                'id_opcion_cal_titulacion' => 13,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 13.',
                'valor'                    => 13,
            ],
            [
                'id_opcion_cal_titulacion' => 14,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 14.',
                'valor'                    => 14,
            ],
            [
                'id_opcion_cal_titulacion' => 15,
                'opcion_cal_titulacion'    => 'Opcion cal titulacion de opcion cal titulacion: registro de prueba número 15.',
                'valor'                    => 15,
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
