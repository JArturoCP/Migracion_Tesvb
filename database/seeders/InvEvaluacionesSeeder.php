<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_evaluaciones`.
 */
class InvEvaluacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_evaluaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvResultadosSeeder::class,
        ]);

        $tabla = 'inv_evaluaciones';

        $llaves = [
            ['id_evaluacion'],
        ];

        $registros = [
            [
                'id_evaluacion' => 1,
                'id_resultado'  => 1,
                'id_protocolo'  => 1,
                'id_comite'     => 1,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 1.',
                'fecha'         => '2026-01-05',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 1,
            ],
            [
                'id_evaluacion' => 2,
                'id_resultado'  => 2,
                'id_protocolo'  => 2,
                'id_comite'     => 2,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 2.',
                'fecha'         => '2026-01-14',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 2,
            ],
            [
                'id_evaluacion' => 3,
                'id_resultado'  => 3,
                'id_protocolo'  => 3,
                'id_comite'     => 3,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 3.',
                'fecha'         => '2026-01-23',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 3,
            ],
            [
                'id_evaluacion' => 4,
                'id_resultado'  => 4,
                'id_protocolo'  => 4,
                'id_comite'     => 4,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 4.',
                'fecha'         => '2026-02-01',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 4,
            ],
            [
                'id_evaluacion' => 5,
                'id_resultado'  => 5,
                'id_protocolo'  => 5,
                'id_comite'     => 5,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 5.',
                'fecha'         => '2026-02-10',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 5,
            ],
            [
                'id_evaluacion' => 6,
                'id_resultado'  => 6,
                'id_protocolo'  => 6,
                'id_comite'     => 6,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 6.',
                'fecha'         => '2026-02-19',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 6,
            ],
            [
                'id_evaluacion' => 7,
                'id_resultado'  => 7,
                'id_protocolo'  => 7,
                'id_comite'     => 7,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 7.',
                'fecha'         => '2026-02-28',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 7,
            ],
            [
                'id_evaluacion' => 8,
                'id_resultado'  => 8,
                'id_protocolo'  => 8,
                'id_comite'     => 8,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 8.',
                'fecha'         => '2026-03-09',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 8,
            ],
            [
                'id_evaluacion' => 9,
                'id_resultado'  => 9,
                'id_protocolo'  => 9,
                'id_comite'     => 9,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 9.',
                'fecha'         => '2026-03-18',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 9,
            ],
            [
                'id_evaluacion' => 10,
                'id_resultado'  => 10,
                'id_protocolo'  => 10,
                'id_comite'     => 10,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 10.',
                'fecha'         => '2026-03-27',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 10,
            ],
            [
                'id_evaluacion' => 11,
                'id_resultado'  => 11,
                'id_protocolo'  => 11,
                'id_comite'     => 11,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 11.',
                'fecha'         => '2026-04-05',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 11,
            ],
            [
                'id_evaluacion' => 12,
                'id_resultado'  => 12,
                'id_protocolo'  => 12,
                'id_comite'     => 12,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 12.',
                'fecha'         => '2026-04-14',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 12,
            ],
            [
                'id_evaluacion' => 13,
                'id_resultado'  => 13,
                'id_protocolo'  => 13,
                'id_comite'     => 13,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 13.',
                'fecha'         => '2026-04-23',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 13,
            ],
            [
                'id_evaluacion' => 14,
                'id_resultado'  => 14,
                'id_protocolo'  => 14,
                'id_comite'     => 14,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 14.',
                'fecha'         => '2026-05-02',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 14,
            ],
            [
                'id_evaluacion' => 15,
                'id_resultado'  => 15,
                'id_protocolo'  => 15,
                'id_comite'     => 15,
                'comentario'    => 'Comentario de evaluaciones: registro de prueba número 15.',
                'fecha'         => '2026-05-11',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
                'id_asignaeva'  => 15,
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
