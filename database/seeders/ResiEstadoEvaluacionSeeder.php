<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_estado_evaluacion`.
 */
class ResiEstadoEvaluacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_estado_evaluacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_estado_evaluacion';

        $llaves = [
            ['id_estado_evaluacion'],
        ];

        $registros = [
            [
                'id_estado_evaluacion' => 1,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 1.',
            ],
            [
                'id_estado_evaluacion' => 2,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 2.',
            ],
            [
                'id_estado_evaluacion' => 3,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 3.',
            ],
            [
                'id_estado_evaluacion' => 4,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 4.',
            ],
            [
                'id_estado_evaluacion' => 5,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 5.',
            ],
            [
                'id_estado_evaluacion' => 6,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 6.',
            ],
            [
                'id_estado_evaluacion' => 7,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 7.',
            ],
            [
                'id_estado_evaluacion' => 8,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 8.',
            ],
            [
                'id_estado_evaluacion' => 9,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 9.',
            ],
            [
                'id_estado_evaluacion' => 10,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 10.',
            ],
            [
                'id_estado_evaluacion' => 11,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 11.',
            ],
            [
                'id_estado_evaluacion' => 12,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 12.',
            ],
            [
                'id_estado_evaluacion' => 13,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 13.',
            ],
            [
                'id_estado_evaluacion' => 14,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 14.',
            ],
            [
                'id_estado_evaluacion' => 15,
                'descripcion'          => 'Descripcion de estado evaluacion: registro de prueba número 15.',
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
