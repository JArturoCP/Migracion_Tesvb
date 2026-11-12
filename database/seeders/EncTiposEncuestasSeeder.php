<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_tipos_encuestas`.
 */
class EncTiposEncuestasSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_tipos_encuestas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'enc_tipos_encuestas';

        $llaves = [
            ['id_tipo_encuesta'],
        ];

        $registros = [
            [
                'id_tipo_encuesta' => 1,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 1.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 1.',
            ],
            [
                'id_tipo_encuesta' => 2,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 2.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 2.',
            ],
            [
                'id_tipo_encuesta' => 3,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 3.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 3.',
            ],
            [
                'id_tipo_encuesta' => 4,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 4.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 4.',
            ],
            [
                'id_tipo_encuesta' => 5,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 5.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 5.',
            ],
            [
                'id_tipo_encuesta' => 6,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 6.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 6.',
            ],
            [
                'id_tipo_encuesta' => 7,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 7.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 7.',
            ],
            [
                'id_tipo_encuesta' => 8,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 8.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 8.',
            ],
            [
                'id_tipo_encuesta' => 9,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 9.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 9.',
            ],
            [
                'id_tipo_encuesta' => 10,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 10.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 10.',
            ],
            [
                'id_tipo_encuesta' => 11,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 11.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 11.',
            ],
            [
                'id_tipo_encuesta' => 12,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 12.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 12.',
            ],
            [
                'id_tipo_encuesta' => 13,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 13.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 13.',
            ],
            [
                'id_tipo_encuesta' => 14,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 14.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 14.',
            ],
            [
                'id_tipo_encuesta' => 15,
                'tipo_encuesta'    => 'Tipo encuesta de tipos encuestas: registro de prueba número 15.',
                'descripcion'      => 'Descripcion de tipos encuestas: registro de prueba número 15.',
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
