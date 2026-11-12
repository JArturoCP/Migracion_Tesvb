<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_opcion_cal_inc_reins`.
 */
class EncOpcionCalIncReinsSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_opcion_cal_inc_reins` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'enc_opcion_cal_inc_reins';

        $llaves = [
            ['id_opcion_cal_inc_reins'],
        ];

        $registros = [
            [
                'id_opcion_cal_inc_reins' => 1,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 1.',
                'valor'                   => 1,
            ],
            [
                'id_opcion_cal_inc_reins' => 2,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 2.',
                'valor'                   => 2,
            ],
            [
                'id_opcion_cal_inc_reins' => 3,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 3.',
                'valor'                   => 3,
            ],
            [
                'id_opcion_cal_inc_reins' => 4,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 4.',
                'valor'                   => 4,
            ],
            [
                'id_opcion_cal_inc_reins' => 5,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 5.',
                'valor'                   => 5,
            ],
            [
                'id_opcion_cal_inc_reins' => 6,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 6.',
                'valor'                   => 6,
            ],
            [
                'id_opcion_cal_inc_reins' => 7,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 7.',
                'valor'                   => 7,
            ],
            [
                'id_opcion_cal_inc_reins' => 8,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 8.',
                'valor'                   => 8,
            ],
            [
                'id_opcion_cal_inc_reins' => 9,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 9.',
                'valor'                   => 9,
            ],
            [
                'id_opcion_cal_inc_reins' => 10,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 10.',
                'valor'                   => 10,
            ],
            [
                'id_opcion_cal_inc_reins' => 11,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 11.',
                'valor'                   => 11,
            ],
            [
                'id_opcion_cal_inc_reins' => 12,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 12.',
                'valor'                   => 12,
            ],
            [
                'id_opcion_cal_inc_reins' => 13,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 13.',
                'valor'                   => 13,
            ],
            [
                'id_opcion_cal_inc_reins' => 14,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 14.',
                'valor'                   => 14,
            ],
            [
                'id_opcion_cal_inc_reins' => 15,
                'opcion_cal_inc_reins'    => 'Opcion cal inc reins de opcion cal inc reins: registro de prueba número 15.',
                'valor'                   => 15,
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
