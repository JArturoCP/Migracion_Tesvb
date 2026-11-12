<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_asigna_planeacion_actividad`.
 */
class PlanAsignaPlaneacionActividadSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_asigna_planeacion_actividad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaGeneracionSeeder::class,
            PlanActividadesSeeder::class,
            PlanEstadosSeeder::class,
        ]);

        $tabla = 'plan_asigna_planeacion_actividad';

        $llaves = [
            ['id_asigna_planeacion_actividad'],
        ];

        $registros = [
            [
                'id_asigna_planeacion_actividad' => 1,
                'id_asigna_generacion'           => 1,
                'id_plan_actividad'              => 1,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 1.',
                'id_estado'                      => 1,
                'created_at'                     => '2026-01-05 09:00:00',
                'updated_at'                     => '2026-01-05 09:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 2,
                'id_asigna_generacion'           => 2,
                'id_plan_actividad'              => 2,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 2.',
                'id_estado'                      => 2,
                'created_at'                     => '2026-01-14 10:00:00',
                'updated_at'                     => '2026-01-14 10:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 3,
                'id_asigna_generacion'           => 3,
                'id_plan_actividad'              => 3,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 3.',
                'id_estado'                      => 3,
                'created_at'                     => '2026-01-23 11:00:00',
                'updated_at'                     => '2026-01-23 11:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 4,
                'id_asigna_generacion'           => 4,
                'id_plan_actividad'              => 4,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 4.',
                'id_estado'                      => 4,
                'created_at'                     => '2026-02-01 12:00:00',
                'updated_at'                     => '2026-02-01 12:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 5,
                'id_asigna_generacion'           => 5,
                'id_plan_actividad'              => 5,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 5.',
                'id_estado'                      => 5,
                'created_at'                     => '2026-02-10 13:00:00',
                'updated_at'                     => '2026-02-10 13:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 6,
                'id_asigna_generacion'           => 6,
                'id_plan_actividad'              => 6,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 6.',
                'id_estado'                      => 6,
                'created_at'                     => '2026-02-19 14:00:00',
                'updated_at'                     => '2026-02-19 14:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 7,
                'id_asigna_generacion'           => 7,
                'id_plan_actividad'              => 7,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 7.',
                'id_estado'                      => 7,
                'created_at'                     => '2026-02-28 15:00:00',
                'updated_at'                     => '2026-02-28 15:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 8,
                'id_asigna_generacion'           => 8,
                'id_plan_actividad'              => 8,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 8.',
                'id_estado'                      => 8,
                'created_at'                     => '2026-03-09 16:00:00',
                'updated_at'                     => '2026-03-09 16:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 9,
                'id_asigna_generacion'           => 9,
                'id_plan_actividad'              => 9,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 9.',
                'id_estado'                      => 9,
                'created_at'                     => '2026-03-18 08:00:00',
                'updated_at'                     => '2026-03-18 08:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 10,
                'id_asigna_generacion'           => 10,
                'id_plan_actividad'              => 10,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 10.',
                'id_estado'                      => 10,
                'created_at'                     => '2026-03-27 09:00:00',
                'updated_at'                     => '2026-03-27 09:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 11,
                'id_asigna_generacion'           => 11,
                'id_plan_actividad'              => 11,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 11.',
                'id_estado'                      => 11,
                'created_at'                     => '2026-04-05 10:00:00',
                'updated_at'                     => '2026-04-05 10:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 12,
                'id_asigna_generacion'           => 12,
                'id_plan_actividad'              => 12,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 12.',
                'id_estado'                      => 12,
                'created_at'                     => '2026-04-14 11:00:00',
                'updated_at'                     => '2026-04-14 11:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 13,
                'id_asigna_generacion'           => 13,
                'id_plan_actividad'              => 13,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 13.',
                'id_estado'                      => 13,
                'created_at'                     => '2026-04-23 12:00:00',
                'updated_at'                     => '2026-04-23 12:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 14,
                'id_asigna_generacion'           => 14,
                'id_plan_actividad'              => 14,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 14.',
                'id_estado'                      => 14,
                'created_at'                     => '2026-05-02 13:00:00',
                'updated_at'                     => '2026-05-02 13:00:00',
                'deleted_at'                     => null,
            ],
            [
                'id_asigna_planeacion_actividad' => 15,
                'id_asigna_generacion'           => 15,
                'id_plan_actividad'              => 15,
                'comentario'                     => 'Comentario de asigna planeacion actividad: registro de prueba número 15.',
                'id_estado'                      => 15,
                'created_at'                     => '2026-05-11 14:00:00',
                'updated_at'                     => '2026-05-11 14:00:00',
                'deleted_at'                     => null,
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
