<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_justificacion`.
 */
class ResiJustificacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_justificacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_justificacion';

        $llaves = [
            ['id_justificacion'],
        ];

        $registros = [
            [
                'id_justificacion'                   => 1,
                'id_anteproyecto'                    => 1,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 1.',
                'estado'                             => 1,
                'id_periodo_evaluacion_anteproyecto' => 1,
                'estado_aceptado_justificacion'      => 1,
            ],
            [
                'id_justificacion'                   => 2,
                'id_anteproyecto'                    => 2,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 2.',
                'estado'                             => 2,
                'id_periodo_evaluacion_anteproyecto' => 2,
                'estado_aceptado_justificacion'      => 2,
            ],
            [
                'id_justificacion'                   => 3,
                'id_anteproyecto'                    => 3,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 3.',
                'estado'                             => 3,
                'id_periodo_evaluacion_anteproyecto' => 3,
                'estado_aceptado_justificacion'      => 3,
            ],
            [
                'id_justificacion'                   => 4,
                'id_anteproyecto'                    => 4,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 4.',
                'estado'                             => 4,
                'id_periodo_evaluacion_anteproyecto' => 4,
                'estado_aceptado_justificacion'      => 4,
            ],
            [
                'id_justificacion'                   => 5,
                'id_anteproyecto'                    => 5,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 5.',
                'estado'                             => 5,
                'id_periodo_evaluacion_anteproyecto' => 5,
                'estado_aceptado_justificacion'      => 5,
            ],
            [
                'id_justificacion'                   => 6,
                'id_anteproyecto'                    => 6,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 6.',
                'estado'                             => 6,
                'id_periodo_evaluacion_anteproyecto' => 6,
                'estado_aceptado_justificacion'      => 6,
            ],
            [
                'id_justificacion'                   => 7,
                'id_anteproyecto'                    => 7,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 7.',
                'estado'                             => 7,
                'id_periodo_evaluacion_anteproyecto' => 7,
                'estado_aceptado_justificacion'      => 7,
            ],
            [
                'id_justificacion'                   => 8,
                'id_anteproyecto'                    => 8,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 8.',
                'estado'                             => 8,
                'id_periodo_evaluacion_anteproyecto' => 8,
                'estado_aceptado_justificacion'      => 8,
            ],
            [
                'id_justificacion'                   => 9,
                'id_anteproyecto'                    => 9,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 9.',
                'estado'                             => 9,
                'id_periodo_evaluacion_anteproyecto' => 9,
                'estado_aceptado_justificacion'      => 9,
            ],
            [
                'id_justificacion'                   => 10,
                'id_anteproyecto'                    => 10,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 10.',
                'estado'                             => 10,
                'id_periodo_evaluacion_anteproyecto' => 10,
                'estado_aceptado_justificacion'      => 10,
            ],
            [
                'id_justificacion'                   => 11,
                'id_anteproyecto'                    => 11,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 11.',
                'estado'                             => 11,
                'id_periodo_evaluacion_anteproyecto' => 11,
                'estado_aceptado_justificacion'      => 11,
            ],
            [
                'id_justificacion'                   => 12,
                'id_anteproyecto'                    => 12,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 12.',
                'estado'                             => 12,
                'id_periodo_evaluacion_anteproyecto' => 12,
                'estado_aceptado_justificacion'      => 12,
            ],
            [
                'id_justificacion'                   => 13,
                'id_anteproyecto'                    => 13,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 13.',
                'estado'                             => 13,
                'id_periodo_evaluacion_anteproyecto' => 13,
                'estado_aceptado_justificacion'      => 13,
            ],
            [
                'id_justificacion'                   => 14,
                'id_anteproyecto'                    => 14,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 14.',
                'estado'                             => 14,
                'id_periodo_evaluacion_anteproyecto' => 14,
                'estado_aceptado_justificacion'      => 14,
            ],
            [
                'id_justificacion'                   => 15,
                'id_anteproyecto'                    => 15,
                'justificacion'                      => 'Justificacion de justificacion: registro de prueba número 15.',
                'estado'                             => 15,
                'id_periodo_evaluacion_anteproyecto' => 15,
                'estado_aceptado_justificacion'      => 15,
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
