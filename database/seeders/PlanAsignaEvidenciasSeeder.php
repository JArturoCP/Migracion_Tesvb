<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_asigna_evidencias`.
 */
class PlanAsignaEvidenciasSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_asigna_evidencias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            PlanAsignaPlaneacionTutorSeeder::class,
        ]);

        $tabla = 'plan_asigna_evidencias';

        $llaves = [
            ['id_evidencia'],
        ];

        $registros = [
            [
                'id_evidencia'               => 1,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_1.pdf',
                'id_alumno'                  => 1,
                'id_asigna_planeacion_tutor' => 1,
                'created_at'                 => '2026-01-05 09:00:00',
                'updated_at'                 => '2026-01-05 09:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 2,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_2.pdf',
                'id_alumno'                  => 2,
                'id_asigna_planeacion_tutor' => 2,
                'created_at'                 => '2026-01-14 10:00:00',
                'updated_at'                 => '2026-01-14 10:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 3,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_3.pdf',
                'id_alumno'                  => 3,
                'id_asigna_planeacion_tutor' => 3,
                'created_at'                 => '2026-01-23 11:00:00',
                'updated_at'                 => '2026-01-23 11:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 4,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_4.pdf',
                'id_alumno'                  => 4,
                'id_asigna_planeacion_tutor' => 4,
                'created_at'                 => '2026-02-01 12:00:00',
                'updated_at'                 => '2026-02-01 12:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 5,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_5.pdf',
                'id_alumno'                  => 5,
                'id_asigna_planeacion_tutor' => 5,
                'created_at'                 => '2026-02-10 13:00:00',
                'updated_at'                 => '2026-02-10 13:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 6,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_6.pdf',
                'id_alumno'                  => 6,
                'id_asigna_planeacion_tutor' => 6,
                'created_at'                 => '2026-02-19 14:00:00',
                'updated_at'                 => '2026-02-19 14:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 7,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_7.pdf',
                'id_alumno'                  => 7,
                'id_asigna_planeacion_tutor' => 7,
                'created_at'                 => '2026-02-28 15:00:00',
                'updated_at'                 => '2026-02-28 15:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 8,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_8.pdf',
                'id_alumno'                  => 8,
                'id_asigna_planeacion_tutor' => 8,
                'created_at'                 => '2026-03-09 16:00:00',
                'updated_at'                 => '2026-03-09 16:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 9,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_9.pdf',
                'id_alumno'                  => 9,
                'id_asigna_planeacion_tutor' => 9,
                'created_at'                 => '2026-03-18 08:00:00',
                'updated_at'                 => '2026-03-18 08:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 10,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_10.pdf',
                'id_alumno'                  => 10,
                'id_asigna_planeacion_tutor' => 10,
                'created_at'                 => '2026-03-27 09:00:00',
                'updated_at'                 => '2026-03-27 09:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 11,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_11.pdf',
                'id_alumno'                  => 11,
                'id_asigna_planeacion_tutor' => 11,
                'created_at'                 => '2026-04-05 10:00:00',
                'updated_at'                 => '2026-04-05 10:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 12,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_12.pdf',
                'id_alumno'                  => 12,
                'id_asigna_planeacion_tutor' => 12,
                'created_at'                 => '2026-04-14 11:00:00',
                'updated_at'                 => '2026-04-14 11:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 13,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_13.pdf',
                'id_alumno'                  => 13,
                'id_asigna_planeacion_tutor' => 13,
                'created_at'                 => '2026-04-23 12:00:00',
                'updated_at'                 => '2026-04-23 12:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 14,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_14.pdf',
                'id_alumno'                  => 14,
                'id_asigna_planeacion_tutor' => 14,
                'created_at'                 => '2026-05-02 13:00:00',
                'updated_at'                 => '2026-05-02 13:00:00',
                'deleted_at'                 => null,
            ],
            [
                'id_evidencia'               => 15,
                'evidencia'                  => 'documentos/plan_asigna_evidencias/plan_asigna_evidencias_15.pdf',
                'id_alumno'                  => 15,
                'id_asigna_planeacion_tutor' => 15,
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
