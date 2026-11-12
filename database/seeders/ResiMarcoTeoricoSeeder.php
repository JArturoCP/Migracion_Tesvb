<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_marco_teorico`.
 */
class ResiMarcoTeoricoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_marco_teorico` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_marco_teorico';

        $llaves = [
            ['id_marco_teorico'],
        ];

        $registros = [
            [
                'id_marco_teorico'                   => 1,
                'id_anteproyecto'                    => 1,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 1.',
                'estado'                             => 1,
                'id_periodo_evaluacion_anteproyecto' => 1,
                'estado_aceptado_marco'              => 1,
            ],
            [
                'id_marco_teorico'                   => 2,
                'id_anteproyecto'                    => 2,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 2.',
                'estado'                             => 2,
                'id_periodo_evaluacion_anteproyecto' => 2,
                'estado_aceptado_marco'              => 2,
            ],
            [
                'id_marco_teorico'                   => 3,
                'id_anteproyecto'                    => 3,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 3.',
                'estado'                             => 3,
                'id_periodo_evaluacion_anteproyecto' => 3,
                'estado_aceptado_marco'              => 3,
            ],
            [
                'id_marco_teorico'                   => 4,
                'id_anteproyecto'                    => 4,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 4.',
                'estado'                             => 4,
                'id_periodo_evaluacion_anteproyecto' => 4,
                'estado_aceptado_marco'              => 4,
            ],
            [
                'id_marco_teorico'                   => 5,
                'id_anteproyecto'                    => 5,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 5.',
                'estado'                             => 5,
                'id_periodo_evaluacion_anteproyecto' => 5,
                'estado_aceptado_marco'              => 5,
            ],
            [
                'id_marco_teorico'                   => 6,
                'id_anteproyecto'                    => 6,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 6.',
                'estado'                             => 6,
                'id_periodo_evaluacion_anteproyecto' => 6,
                'estado_aceptado_marco'              => 6,
            ],
            [
                'id_marco_teorico'                   => 7,
                'id_anteproyecto'                    => 7,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 7.',
                'estado'                             => 7,
                'id_periodo_evaluacion_anteproyecto' => 7,
                'estado_aceptado_marco'              => 7,
            ],
            [
                'id_marco_teorico'                   => 8,
                'id_anteproyecto'                    => 8,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 8.',
                'estado'                             => 8,
                'id_periodo_evaluacion_anteproyecto' => 8,
                'estado_aceptado_marco'              => 8,
            ],
            [
                'id_marco_teorico'                   => 9,
                'id_anteproyecto'                    => 9,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 9.',
                'estado'                             => 9,
                'id_periodo_evaluacion_anteproyecto' => 9,
                'estado_aceptado_marco'              => 9,
            ],
            [
                'id_marco_teorico'                   => 10,
                'id_anteproyecto'                    => 10,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 10.',
                'estado'                             => 10,
                'id_periodo_evaluacion_anteproyecto' => 10,
                'estado_aceptado_marco'              => 10,
            ],
            [
                'id_marco_teorico'                   => 11,
                'id_anteproyecto'                    => 11,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 11.',
                'estado'                             => 11,
                'id_periodo_evaluacion_anteproyecto' => 11,
                'estado_aceptado_marco'              => 11,
            ],
            [
                'id_marco_teorico'                   => 12,
                'id_anteproyecto'                    => 12,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 12.',
                'estado'                             => 12,
                'id_periodo_evaluacion_anteproyecto' => 12,
                'estado_aceptado_marco'              => 12,
            ],
            [
                'id_marco_teorico'                   => 13,
                'id_anteproyecto'                    => 13,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 13.',
                'estado'                             => 13,
                'id_periodo_evaluacion_anteproyecto' => 13,
                'estado_aceptado_marco'              => 13,
            ],
            [
                'id_marco_teorico'                   => 14,
                'id_anteproyecto'                    => 14,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 14.',
                'estado'                             => 14,
                'id_periodo_evaluacion_anteproyecto' => 14,
                'estado_aceptado_marco'              => 14,
            ],
            [
                'id_marco_teorico'                   => 15,
                'id_anteproyecto'                    => 15,
                'marco_teorico'                      => 'Marco teorico de marco teorico: registro de prueba número 15.',
                'estado'                             => 15,
                'id_periodo_evaluacion_anteproyecto' => 15,
                'estado_aceptado_marco'              => 15,
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
