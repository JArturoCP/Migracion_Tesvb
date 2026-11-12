<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_cronograma`.
 */
class ResiCronogramaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_cronograma` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_cronograma';

        $llaves = [
            ['id_cronograma'],
        ];

        $registros = [
            [
                'id_cronograma'                      => 1,
                'no_semana'                          => 1,
                'id_anteproyecto'                    => 1,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 1.',
                'f_inicio'                           => '2026-01-05',
                'f_termino'                          => '2026-01-05',
                'estado'                             => 1,
                'id_periodo_evaluacion_anteproyecto' => 1,
                'estado_aceptado_cronograma'         => 1,
            ],
            [
                'id_cronograma'                      => 2,
                'no_semana'                          => 2,
                'id_anteproyecto'                    => 2,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 2.',
                'f_inicio'                           => '2026-01-14',
                'f_termino'                          => '2026-01-14',
                'estado'                             => 2,
                'id_periodo_evaluacion_anteproyecto' => 2,
                'estado_aceptado_cronograma'         => 2,
            ],
            [
                'id_cronograma'                      => 3,
                'no_semana'                          => 3,
                'id_anteproyecto'                    => 3,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 3.',
                'f_inicio'                           => '2026-01-23',
                'f_termino'                          => '2026-01-23',
                'estado'                             => 3,
                'id_periodo_evaluacion_anteproyecto' => 3,
                'estado_aceptado_cronograma'         => 3,
            ],
            [
                'id_cronograma'                      => 4,
                'no_semana'                          => 4,
                'id_anteproyecto'                    => 4,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 4.',
                'f_inicio'                           => '2026-02-01',
                'f_termino'                          => '2026-02-01',
                'estado'                             => 4,
                'id_periodo_evaluacion_anteproyecto' => 4,
                'estado_aceptado_cronograma'         => 4,
            ],
            [
                'id_cronograma'                      => 5,
                'no_semana'                          => 5,
                'id_anteproyecto'                    => 5,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 5.',
                'f_inicio'                           => '2026-02-10',
                'f_termino'                          => '2026-02-10',
                'estado'                             => 5,
                'id_periodo_evaluacion_anteproyecto' => 5,
                'estado_aceptado_cronograma'         => 5,
            ],
            [
                'id_cronograma'                      => 6,
                'no_semana'                          => 6,
                'id_anteproyecto'                    => 6,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 6.',
                'f_inicio'                           => '2026-02-19',
                'f_termino'                          => '2026-02-19',
                'estado'                             => 6,
                'id_periodo_evaluacion_anteproyecto' => 6,
                'estado_aceptado_cronograma'         => 6,
            ],
            [
                'id_cronograma'                      => 7,
                'no_semana'                          => 7,
                'id_anteproyecto'                    => 7,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 7.',
                'f_inicio'                           => '2026-02-28',
                'f_termino'                          => '2026-02-28',
                'estado'                             => 7,
                'id_periodo_evaluacion_anteproyecto' => 7,
                'estado_aceptado_cronograma'         => 7,
            ],
            [
                'id_cronograma'                      => 8,
                'no_semana'                          => 8,
                'id_anteproyecto'                    => 8,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 8.',
                'f_inicio'                           => '2026-03-09',
                'f_termino'                          => '2026-03-09',
                'estado'                             => 8,
                'id_periodo_evaluacion_anteproyecto' => 8,
                'estado_aceptado_cronograma'         => 8,
            ],
            [
                'id_cronograma'                      => 9,
                'no_semana'                          => 9,
                'id_anteproyecto'                    => 9,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 9.',
                'f_inicio'                           => '2026-03-18',
                'f_termino'                          => '2026-03-18',
                'estado'                             => 9,
                'id_periodo_evaluacion_anteproyecto' => 9,
                'estado_aceptado_cronograma'         => 9,
            ],
            [
                'id_cronograma'                      => 10,
                'no_semana'                          => 10,
                'id_anteproyecto'                    => 10,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 10.',
                'f_inicio'                           => '2026-03-27',
                'f_termino'                          => '2026-03-27',
                'estado'                             => 10,
                'id_periodo_evaluacion_anteproyecto' => 10,
                'estado_aceptado_cronograma'         => 10,
            ],
            [
                'id_cronograma'                      => 11,
                'no_semana'                          => 11,
                'id_anteproyecto'                    => 11,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 11.',
                'f_inicio'                           => '2026-04-05',
                'f_termino'                          => '2026-04-05',
                'estado'                             => 11,
                'id_periodo_evaluacion_anteproyecto' => 11,
                'estado_aceptado_cronograma'         => 11,
            ],
            [
                'id_cronograma'                      => 12,
                'no_semana'                          => 12,
                'id_anteproyecto'                    => 12,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 12.',
                'f_inicio'                           => '2026-04-14',
                'f_termino'                          => '2026-04-14',
                'estado'                             => 12,
                'id_periodo_evaluacion_anteproyecto' => 12,
                'estado_aceptado_cronograma'         => 12,
            ],
            [
                'id_cronograma'                      => 13,
                'no_semana'                          => 13,
                'id_anteproyecto'                    => 13,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 13.',
                'f_inicio'                           => '2026-04-23',
                'f_termino'                          => '2026-04-23',
                'estado'                             => 13,
                'id_periodo_evaluacion_anteproyecto' => 13,
                'estado_aceptado_cronograma'         => 13,
            ],
            [
                'id_cronograma'                      => 14,
                'no_semana'                          => 14,
                'id_anteproyecto'                    => 14,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 14.',
                'f_inicio'                           => '2026-05-02',
                'f_termino'                          => '2026-05-02',
                'estado'                             => 14,
                'id_periodo_evaluacion_anteproyecto' => 14,
                'estado_aceptado_cronograma'         => 14,
            ],
            [
                'id_cronograma'                      => 15,
                'no_semana'                          => 15,
                'id_anteproyecto'                    => 15,
                'actividad'                          => 'Actividad de cronograma: registro de prueba número 15.',
                'f_inicio'                           => '2026-05-11',
                'f_termino'                          => '2026-05-11',
                'estado'                             => 15,
                'id_periodo_evaluacion_anteproyecto' => 15,
                'estado_aceptado_cronograma'         => 15,
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
