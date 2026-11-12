<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_alcances`.
 */
class ResiAlcancesSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_alcances` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_alcances';

        $llaves = [
            ['id_alcances'],
        ];

        $registros = [
            [
                'id_alcances'                        => 1,
                'id_anteproyecto'                    => 1,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 1.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 1.',
                'estado'                             => 1,
                'id_periodo_evaluacion_anteproyecto' => 1,
                'estado_aceptado_alcances'           => 1,
            ],
            [
                'id_alcances'                        => 2,
                'id_anteproyecto'                    => 2,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 2.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 2.',
                'estado'                             => 2,
                'id_periodo_evaluacion_anteproyecto' => 2,
                'estado_aceptado_alcances'           => 2,
            ],
            [
                'id_alcances'                        => 3,
                'id_anteproyecto'                    => 3,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 3.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 3.',
                'estado'                             => 3,
                'id_periodo_evaluacion_anteproyecto' => 3,
                'estado_aceptado_alcances'           => 3,
            ],
            [
                'id_alcances'                        => 4,
                'id_anteproyecto'                    => 4,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 4.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 4.',
                'estado'                             => 4,
                'id_periodo_evaluacion_anteproyecto' => 4,
                'estado_aceptado_alcances'           => 4,
            ],
            [
                'id_alcances'                        => 5,
                'id_anteproyecto'                    => 5,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 5.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 5.',
                'estado'                             => 5,
                'id_periodo_evaluacion_anteproyecto' => 5,
                'estado_aceptado_alcances'           => 5,
            ],
            [
                'id_alcances'                        => 6,
                'id_anteproyecto'                    => 6,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 6.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 6.',
                'estado'                             => 6,
                'id_periodo_evaluacion_anteproyecto' => 6,
                'estado_aceptado_alcances'           => 6,
            ],
            [
                'id_alcances'                        => 7,
                'id_anteproyecto'                    => 7,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 7.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 7.',
                'estado'                             => 7,
                'id_periodo_evaluacion_anteproyecto' => 7,
                'estado_aceptado_alcances'           => 7,
            ],
            [
                'id_alcances'                        => 8,
                'id_anteproyecto'                    => 8,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 8.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 8.',
                'estado'                             => 8,
                'id_periodo_evaluacion_anteproyecto' => 8,
                'estado_aceptado_alcances'           => 8,
            ],
            [
                'id_alcances'                        => 9,
                'id_anteproyecto'                    => 9,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 9.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 9.',
                'estado'                             => 9,
                'id_periodo_evaluacion_anteproyecto' => 9,
                'estado_aceptado_alcances'           => 9,
            ],
            [
                'id_alcances'                        => 10,
                'id_anteproyecto'                    => 10,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 10.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 10.',
                'estado'                             => 10,
                'id_periodo_evaluacion_anteproyecto' => 10,
                'estado_aceptado_alcances'           => 10,
            ],
            [
                'id_alcances'                        => 11,
                'id_anteproyecto'                    => 11,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 11.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 11.',
                'estado'                             => 11,
                'id_periodo_evaluacion_anteproyecto' => 11,
                'estado_aceptado_alcances'           => 11,
            ],
            [
                'id_alcances'                        => 12,
                'id_anteproyecto'                    => 12,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 12.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 12.',
                'estado'                             => 12,
                'id_periodo_evaluacion_anteproyecto' => 12,
                'estado_aceptado_alcances'           => 12,
            ],
            [
                'id_alcances'                        => 13,
                'id_anteproyecto'                    => 13,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 13.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 13.',
                'estado'                             => 13,
                'id_periodo_evaluacion_anteproyecto' => 13,
                'estado_aceptado_alcances'           => 13,
            ],
            [
                'id_alcances'                        => 14,
                'id_anteproyecto'                    => 14,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 14.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 14.',
                'estado'                             => 14,
                'id_periodo_evaluacion_anteproyecto' => 14,
                'estado_aceptado_alcances'           => 14,
            ],
            [
                'id_alcances'                        => 15,
                'id_anteproyecto'                    => 15,
                'alcances'                           => 'Alcances de alcances: registro de prueba número 15.',
                'limitaciones'                       => 'Limitaciones de alcances: registro de prueba número 15.',
                'estado'                             => 15,
                'id_periodo_evaluacion_anteproyecto' => 15,
                'estado_aceptado_alcances'           => 15,
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
