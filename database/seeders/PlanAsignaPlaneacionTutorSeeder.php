<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_asigna_planeacion_tutor`.
 */
class PlanAsignaPlaneacionTutorSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_asigna_planeacion_tutor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaGeneracionSeeder::class,
            PlanActividadesSeeder::class,
        ]);

        $tabla = 'plan_asigna_planeacion_tutor';

        $llaves = [
            ['id_asigna_planeacion_tutor'],
        ];

        $registros = [
            [
                'id_asigna_planeacion_tutor' => 1,
                'id_plan_actividad'          => 1,
                'id_asigna_generacion'       => 1,
                'id_estrategia'              => 1,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 1.',
                'requiere_evidencia'         => 1,
                'boton'                      => 1,
                'created_at'                 => '2026-01-05 09:00:00',
                'updated_at'                 => '2026-01-05 09:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 2,
                'id_plan_actividad'          => 2,
                'id_asigna_generacion'       => 2,
                'id_estrategia'              => 2,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 2.',
                'requiere_evidencia'         => 2,
                'boton'                      => 2,
                'created_at'                 => '2026-01-14 10:00:00',
                'updated_at'                 => '2026-01-14 10:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 3,
                'id_plan_actividad'          => 3,
                'id_asigna_generacion'       => 3,
                'id_estrategia'              => 3,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 3.',
                'requiere_evidencia'         => 3,
                'boton'                      => 3,
                'created_at'                 => '2026-01-23 11:00:00',
                'updated_at'                 => '2026-01-23 11:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 4,
                'id_plan_actividad'          => 4,
                'id_asigna_generacion'       => 4,
                'id_estrategia'              => 4,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 4.',
                'requiere_evidencia'         => 4,
                'boton'                      => 4,
                'created_at'                 => '2026-02-01 12:00:00',
                'updated_at'                 => '2026-02-01 12:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 5,
                'id_plan_actividad'          => 5,
                'id_asigna_generacion'       => 5,
                'id_estrategia'              => 5,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 5.',
                'requiere_evidencia'         => 5,
                'boton'                      => 5,
                'created_at'                 => '2026-02-10 13:00:00',
                'updated_at'                 => '2026-02-10 13:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 6,
                'id_plan_actividad'          => 6,
                'id_asigna_generacion'       => 6,
                'id_estrategia'              => 6,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 6.',
                'requiere_evidencia'         => 6,
                'boton'                      => 6,
                'created_at'                 => '2026-02-19 14:00:00',
                'updated_at'                 => '2026-02-19 14:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 7,
                'id_plan_actividad'          => 7,
                'id_asigna_generacion'       => 7,
                'id_estrategia'              => 7,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 7.',
                'requiere_evidencia'         => 7,
                'boton'                      => 7,
                'created_at'                 => '2026-02-28 15:00:00',
                'updated_at'                 => '2026-02-28 15:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 8,
                'id_plan_actividad'          => 8,
                'id_asigna_generacion'       => 8,
                'id_estrategia'              => 8,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 8.',
                'requiere_evidencia'         => 8,
                'boton'                      => 8,
                'created_at'                 => '2026-03-09 16:00:00',
                'updated_at'                 => '2026-03-09 16:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 9,
                'id_plan_actividad'          => 9,
                'id_asigna_generacion'       => 9,
                'id_estrategia'              => 9,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 9.',
                'requiere_evidencia'         => 9,
                'boton'                      => 9,
                'created_at'                 => '2026-03-18 08:00:00',
                'updated_at'                 => '2026-03-18 08:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 10,
                'id_plan_actividad'          => 10,
                'id_asigna_generacion'       => 10,
                'id_estrategia'              => 10,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 10.',
                'requiere_evidencia'         => 10,
                'boton'                      => 10,
                'created_at'                 => '2026-03-27 09:00:00',
                'updated_at'                 => '2026-03-27 09:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 11,
                'id_plan_actividad'          => 11,
                'id_asigna_generacion'       => 11,
                'id_estrategia'              => 11,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 11.',
                'requiere_evidencia'         => 11,
                'boton'                      => 11,
                'created_at'                 => '2026-04-05 10:00:00',
                'updated_at'                 => '2026-04-05 10:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 12,
                'id_plan_actividad'          => 12,
                'id_asigna_generacion'       => 12,
                'id_estrategia'              => 12,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 12.',
                'requiere_evidencia'         => 12,
                'boton'                      => 12,
                'created_at'                 => '2026-04-14 11:00:00',
                'updated_at'                 => '2026-04-14 11:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 13,
                'id_plan_actividad'          => 13,
                'id_asigna_generacion'       => 13,
                'id_estrategia'              => 13,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 13.',
                'requiere_evidencia'         => 13,
                'boton'                      => 13,
                'created_at'                 => '2026-04-23 12:00:00',
                'updated_at'                 => '2026-04-23 12:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 14,
                'id_plan_actividad'          => 14,
                'id_asigna_generacion'       => 14,
                'id_estrategia'              => 14,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 14.',
                'requiere_evidencia'         => 14,
                'boton'                      => 14,
                'created_at'                 => '2026-05-02 13:00:00',
                'updated_at'                 => '2026-05-02 13:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_asigna_planeacion_tutor' => 15,
                'id_plan_actividad'          => 15,
                'id_asigna_generacion'       => 15,
                'id_estrategia'              => 15,
                'estrategia'                 => 'Estrategia de asigna planeacion tutor: registro de prueba número 15.',
                'requiere_evidencia'         => 15,
                'boton'                      => 15,
                'created_at'                 => '2026-05-11 14:00:00',
                'updated_at'                 => '2026-05-11 14:00:00',
                'deleted_at'                 => null,
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
