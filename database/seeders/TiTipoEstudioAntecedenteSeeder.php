<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipo_estudio_antecedente`.
 */
class TiTipoEstudioAntecedenteSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipo_estudio_antecedente` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipo_estudio_antecedente';

        $llaves = [
            ['id_tipo_estudio_antecedente'],
        ];

        $registros = [
            [
                'id_tipo_estudio_antecedente' => 1,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 1.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 1.',
            ],
            [
                'id_tipo_estudio_antecedente' => 2,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 2.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 2.',
            ],
            [
                'id_tipo_estudio_antecedente' => 3,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 3.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 3.',
            ],
            [
                'id_tipo_estudio_antecedente' => 4,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 4.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 4.',
            ],
            [
                'id_tipo_estudio_antecedente' => 5,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 5.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 5.',
            ],
            [
                'id_tipo_estudio_antecedente' => 6,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 6.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 6.',
            ],
            [
                'id_tipo_estudio_antecedente' => 7,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 7.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 7.',
            ],
            [
                'id_tipo_estudio_antecedente' => 8,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 8.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 8.',
            ],
            [
                'id_tipo_estudio_antecedente' => 9,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 9.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 9.',
            ],
            [
                'id_tipo_estudio_antecedente' => 10,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 10.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 10.',
            ],
            [
                'id_tipo_estudio_antecedente' => 11,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 11.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 11.',
            ],
            [
                'id_tipo_estudio_antecedente' => 12,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 12.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 12.',
            ],
            [
                'id_tipo_estudio_antecedente' => 13,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 13.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 13.',
            ],
            [
                'id_tipo_estudio_antecedente' => 14,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 14.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 14.',
            ],
            [
                'id_tipo_estudio_antecedente' => 15,
                'tipo_estudio_antecedente'    => 'Tipo estudio antecedente de tipo estudio antecedente: registro de prueba número 15.',
                'tipo_educativo_atecedente'   => 'Tipo educativo atecedente de tipo estudio antecedente: registro de prueba número 15.',
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
