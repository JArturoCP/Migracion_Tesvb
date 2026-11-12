<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_opc_cal_ss_rp`.
 */
class EncOpcCalSsRpSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_opc_cal_ss_rp` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'enc_opc_cal_ss_rp';

        $llaves = [
            ['id_opc_cal_ss_rp'],
        ];

        $registros = [
            [
                'id_opc_cal_ss_rp' => 1,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 1.',
                'valor'            => 1,
            ],
            [
                'id_opc_cal_ss_rp' => 2,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 2.',
                'valor'            => 2,
            ],
            [
                'id_opc_cal_ss_rp' => 3,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 3.',
                'valor'            => 3,
            ],
            [
                'id_opc_cal_ss_rp' => 4,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 4.',
                'valor'            => 4,
            ],
            [
                'id_opc_cal_ss_rp' => 5,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 5.',
                'valor'            => 5,
            ],
            [
                'id_opc_cal_ss_rp' => 6,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 6.',
                'valor'            => 6,
            ],
            [
                'id_opc_cal_ss_rp' => 7,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 7.',
                'valor'            => 7,
            ],
            [
                'id_opc_cal_ss_rp' => 8,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 8.',
                'valor'            => 8,
            ],
            [
                'id_opc_cal_ss_rp' => 9,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 9.',
                'valor'            => 9,
            ],
            [
                'id_opc_cal_ss_rp' => 10,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 10.',
                'valor'            => 10,
            ],
            [
                'id_opc_cal_ss_rp' => 11,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 11.',
                'valor'            => 11,
            ],
            [
                'id_opc_cal_ss_rp' => 12,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 12.',
                'valor'            => 12,
            ],
            [
                'id_opc_cal_ss_rp' => 13,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 13.',
                'valor'            => 13,
            ],
            [
                'id_opc_cal_ss_rp' => 14,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 14.',
                'valor'            => 14,
            ],
            [
                'id_opc_cal_ss_rp' => 15,
                'opc_cal_ss_rp'    => 'Opc cal ss rp de opc cal ss rp: registro de prueba número 15.',
                'valor'            => 15,
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
