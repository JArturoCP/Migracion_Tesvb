<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_aspeval`.
 */
class InvAspevalSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_aspeval` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvAspectosSeeder::class,
            InvEvaluacionesSeeder::class,
            InvValoresSeeder::class,
        ]);

        $tabla = 'inv_aspeval';

        $llaves = [
            ['id_aspeval'],
        ];

        $registros = [
            [
                'id_aspeval'    => 1,
                'id_aspecto'    => 1,
                'id_valor'      => 1,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 1.',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 1,
            ],
            [
                'id_aspeval'    => 2,
                'id_aspecto'    => 2,
                'id_valor'      => 2,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 2.',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 2,
            ],
            [
                'id_aspeval'    => 3,
                'id_aspecto'    => 3,
                'id_valor'      => 3,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 3.',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 3,
            ],
            [
                'id_aspeval'    => 4,
                'id_aspecto'    => 4,
                'id_valor'      => 4,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 4.',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 4,
            ],
            [
                'id_aspeval'    => 5,
                'id_aspecto'    => 5,
                'id_valor'      => 5,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 5.',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 5,
            ],
            [
                'id_aspeval'    => 6,
                'id_aspecto'    => 6,
                'id_valor'      => 6,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 6.',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 6,
            ],
            [
                'id_aspeval'    => 7,
                'id_aspecto'    => 7,
                'id_valor'      => 7,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 7.',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 7,
            ],
            [
                'id_aspeval'    => 8,
                'id_aspecto'    => 8,
                'id_valor'      => 8,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 8.',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 8,
            ],
            [
                'id_aspeval'    => 9,
                'id_aspecto'    => 9,
                'id_valor'      => 9,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 9.',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 9,
            ],
            [
                'id_aspeval'    => 10,
                'id_aspecto'    => 10,
                'id_valor'      => 10,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 10.',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 10,
            ],
            [
                'id_aspeval'    => 11,
                'id_aspecto'    => 11,
                'id_valor'      => 11,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 11.',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 11,
            ],
            [
                'id_aspeval'    => 12,
                'id_aspecto'    => 12,
                'id_valor'      => 12,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 12.',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 12,
            ],
            [
                'id_aspeval'    => 13,
                'id_aspecto'    => 13,
                'id_valor'      => 13,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 13.',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 13,
            ],
            [
                'id_aspeval'    => 14,
                'id_aspecto'    => 14,
                'id_valor'      => 14,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 14.',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 14,
            ],
            [
                'id_aspeval'    => 15,
                'id_aspecto'    => 15,
                'id_valor'      => 15,
                'comentario'    => 'Comentario de aspeval: registro de prueba número 15.',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
                'id_evaluacion' => 15,
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
