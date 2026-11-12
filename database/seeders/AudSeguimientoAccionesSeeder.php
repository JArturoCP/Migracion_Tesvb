<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_seguimiento_acciones`.
 */
class AudSeguimientoAccionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_seguimiento_acciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudPlanAccionesSeeder::class,
            AudresponsableAccionesSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'aud_seguimiento_acciones';

        $llaves = [
            ['id_seguimiento_accion'],
        ];

        $registros = [
            [
                'id_seguimiento_accion'   => 1,
                'id_plan_acciones'        => 1,
                'id_responsable'          => 1,
                'id_personal_seguimiento' => 1,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 1.',
                'estado_cumplimiento'     => 1,
                'fecha_revision'          => '2026-01-05 09:00:00',
                'created_at'              => '2026-01-05 09:00:00',
                'updated_at'              => '2026-01-05 09:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 2,
                'id_plan_acciones'        => 2,
                'id_responsable'          => 2,
                'id_personal_seguimiento' => 2,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 2.',
                'estado_cumplimiento'     => 2,
                'fecha_revision'          => '2026-01-14 10:00:00',
                'created_at'              => '2026-01-14 10:00:00',
                'updated_at'              => '2026-01-14 10:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 3,
                'id_plan_acciones'        => 3,
                'id_responsable'          => 3,
                'id_personal_seguimiento' => 3,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 3.',
                'estado_cumplimiento'     => 3,
                'fecha_revision'          => '2026-01-23 11:00:00',
                'created_at'              => '2026-01-23 11:00:00',
                'updated_at'              => '2026-01-23 11:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 4,
                'id_plan_acciones'        => 4,
                'id_responsable'          => 4,
                'id_personal_seguimiento' => 4,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 4.',
                'estado_cumplimiento'     => 4,
                'fecha_revision'          => '2026-02-01 12:00:00',
                'created_at'              => '2026-02-01 12:00:00',
                'updated_at'              => '2026-02-01 12:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 5,
                'id_plan_acciones'        => 5,
                'id_responsable'          => 5,
                'id_personal_seguimiento' => 5,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 5.',
                'estado_cumplimiento'     => 5,
                'fecha_revision'          => '2026-02-10 13:00:00',
                'created_at'              => '2026-02-10 13:00:00',
                'updated_at'              => '2026-02-10 13:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 6,
                'id_plan_acciones'        => 6,
                'id_responsable'          => 6,
                'id_personal_seguimiento' => 6,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 6.',
                'estado_cumplimiento'     => 6,
                'fecha_revision'          => '2026-02-19 14:00:00',
                'created_at'              => '2026-02-19 14:00:00',
                'updated_at'              => '2026-02-19 14:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 7,
                'id_plan_acciones'        => 7,
                'id_responsable'          => 7,
                'id_personal_seguimiento' => 7,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 7.',
                'estado_cumplimiento'     => 7,
                'fecha_revision'          => '2026-02-28 15:00:00',
                'created_at'              => '2026-02-28 15:00:00',
                'updated_at'              => '2026-02-28 15:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 8,
                'id_plan_acciones'        => 8,
                'id_responsable'          => 8,
                'id_personal_seguimiento' => 8,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 8.',
                'estado_cumplimiento'     => 8,
                'fecha_revision'          => '2026-03-09 16:00:00',
                'created_at'              => '2026-03-09 16:00:00',
                'updated_at'              => '2026-03-09 16:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 9,
                'id_plan_acciones'        => 9,
                'id_responsable'          => 9,
                'id_personal_seguimiento' => 9,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 9.',
                'estado_cumplimiento'     => 9,
                'fecha_revision'          => '2026-03-18 08:00:00',
                'created_at'              => '2026-03-18 08:00:00',
                'updated_at'              => '2026-03-18 08:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 10,
                'id_plan_acciones'        => 10,
                'id_responsable'          => 10,
                'id_personal_seguimiento' => 10,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 10.',
                'estado_cumplimiento'     => 10,
                'fecha_revision'          => '2026-03-27 09:00:00',
                'created_at'              => '2026-03-27 09:00:00',
                'updated_at'              => '2026-03-27 09:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 11,
                'id_plan_acciones'        => 11,
                'id_responsable'          => 11,
                'id_personal_seguimiento' => 11,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 11.',
                'estado_cumplimiento'     => 11,
                'fecha_revision'          => '2026-04-05 10:00:00',
                'created_at'              => '2026-04-05 10:00:00',
                'updated_at'              => '2026-04-05 10:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 12,
                'id_plan_acciones'        => 12,
                'id_responsable'          => 12,
                'id_personal_seguimiento' => 12,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 12.',
                'estado_cumplimiento'     => 12,
                'fecha_revision'          => '2026-04-14 11:00:00',
                'created_at'              => '2026-04-14 11:00:00',
                'updated_at'              => '2026-04-14 11:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 13,
                'id_plan_acciones'        => 13,
                'id_responsable'          => 13,
                'id_personal_seguimiento' => 13,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 13.',
                'estado_cumplimiento'     => 13,
                'fecha_revision'          => '2026-04-23 12:00:00',
                'created_at'              => '2026-04-23 12:00:00',
                'updated_at'              => '2026-04-23 12:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 14,
                'id_plan_acciones'        => 14,
                'id_responsable'          => 14,
                'id_personal_seguimiento' => 14,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 14.',
                'estado_cumplimiento'     => 14,
                'fecha_revision'          => '2026-05-02 13:00:00',
                'created_at'              => '2026-05-02 13:00:00',
                'updated_at'              => '2026-05-02 13:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento_accion'   => 15,
                'id_plan_acciones'        => 15,
                'id_responsable'          => 15,
                'id_personal_seguimiento' => 15,
                'nota_seguimiento'        => 'Nota seguimiento de seguimiento acciones: registro de prueba número 15.',
                'estado_cumplimiento'     => 15,
                'fecha_revision'          => '2026-05-11 14:00:00',
                'created_at'              => '2026-05-11 14:00:00',
                'updated_at'              => '2026-05-11 14:00:00',
                'deleted_at'              => null,
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
