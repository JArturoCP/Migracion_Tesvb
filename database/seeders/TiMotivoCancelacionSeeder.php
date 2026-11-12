<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_motivo_cancelacion`.
 */
class TiMotivoCancelacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_motivo_cancelacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_motivo_cancelacion';

        $llaves = [
            ['id_motivo_cancelacion'],
        ];

        $registros = [
            [
                'id_motivo_cancelacion'   => 1,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 1.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 1.',
            ],
            [
                'id_motivo_cancelacion'   => 2,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 2.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 2.',
            ],
            [
                'id_motivo_cancelacion'   => 3,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 3.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 3.',
            ],
            [
                'id_motivo_cancelacion'   => 4,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 4.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 4.',
            ],
            [
                'id_motivo_cancelacion'   => 5,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 5.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 5.',
            ],
            [
                'id_motivo_cancelacion'   => 6,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 6.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 6.',
            ],
            [
                'id_motivo_cancelacion'   => 7,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 7.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 7.',
            ],
            [
                'id_motivo_cancelacion'   => 8,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 8.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 8.',
            ],
            [
                'id_motivo_cancelacion'   => 9,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 9.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 9.',
            ],
            [
                'id_motivo_cancelacion'   => 10,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 10.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 10.',
            ],
            [
                'id_motivo_cancelacion'   => 11,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 11.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 11.',
            ],
            [
                'id_motivo_cancelacion'   => 12,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 12.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 12.',
            ],
            [
                'id_motivo_cancelacion'   => 13,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 13.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 13.',
            ],
            [
                'id_motivo_cancelacion'   => 14,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 14.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 14.',
            ],
            [
                'id_motivo_cancelacion'   => 15,
                'siglas_motivo'           => 'Siglas motivo de motivo cancelacion: registro de prueba número 15.',
                'descripcion_cancelacion' => 'Descripcion cancelacion de motivo cancelacion: registro de prueba número 15.',
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
