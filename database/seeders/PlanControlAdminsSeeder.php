<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_control_admins`.
 */
class PlanControlAdminsSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_control_admins` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_control_admins';

        $llaves = [
            ['id_control_admin'],
        ];

        $registros = [
            [
                'id_control_admin' => 1,
                'id_unidad'        => 1,
                'grupo'            => 1,
                'fecha_evaluacion' => '2026-01-05',
                'fecha_revision'   => '2026-01-05',
                'fecha_entrega'    => '2026-01-05',
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'id_encabezado'    => 1,
                'habilitado'       => 1,
            ],
            [
                'id_control_admin' => 2,
                'id_unidad'        => 2,
                'grupo'            => 2,
                'fecha_evaluacion' => '2026-01-14',
                'fecha_revision'   => '2026-01-14',
                'fecha_entrega'    => '2026-01-14',
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'id_encabezado'    => 2,
                'habilitado'       => 2,
            ],
            [
                'id_control_admin' => 3,
                'id_unidad'        => 3,
                'grupo'            => 3,
                'fecha_evaluacion' => '2026-01-23',
                'fecha_revision'   => '2026-01-23',
                'fecha_entrega'    => '2026-01-23',
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'id_encabezado'    => 3,
                'habilitado'       => 3,
            ],
            [
                'id_control_admin' => 4,
                'id_unidad'        => 4,
                'grupo'            => 4,
                'fecha_evaluacion' => '2026-02-01',
                'fecha_revision'   => '2026-02-01',
                'fecha_entrega'    => '2026-02-01',
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'id_encabezado'    => 4,
                'habilitado'       => 4,
            ],
            [
                'id_control_admin' => 5,
                'id_unidad'        => 5,
                'grupo'            => 5,
                'fecha_evaluacion' => '2026-02-10',
                'fecha_revision'   => '2026-02-10',
                'fecha_entrega'    => '2026-02-10',
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'id_encabezado'    => 5,
                'habilitado'       => 5,
            ],
            [
                'id_control_admin' => 6,
                'id_unidad'        => 6,
                'grupo'            => 6,
                'fecha_evaluacion' => '2026-02-19',
                'fecha_revision'   => '2026-02-19',
                'fecha_entrega'    => '2026-02-19',
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'id_encabezado'    => 6,
                'habilitado'       => 6,
            ],
            [
                'id_control_admin' => 7,
                'id_unidad'        => 7,
                'grupo'            => 7,
                'fecha_evaluacion' => '2026-02-28',
                'fecha_revision'   => '2026-02-28',
                'fecha_entrega'    => '2026-02-28',
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'id_encabezado'    => 7,
                'habilitado'       => 7,
            ],
            [
                'id_control_admin' => 8,
                'id_unidad'        => 8,
                'grupo'            => 8,
                'fecha_evaluacion' => '2026-03-09',
                'fecha_revision'   => '2026-03-09',
                'fecha_entrega'    => '2026-03-09',
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'id_encabezado'    => 8,
                'habilitado'       => 8,
            ],
            [
                'id_control_admin' => 9,
                'id_unidad'        => 9,
                'grupo'            => 9,
                'fecha_evaluacion' => '2026-03-18',
                'fecha_revision'   => '2026-03-18',
                'fecha_entrega'    => '2026-03-18',
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'id_encabezado'    => 9,
                'habilitado'       => 9,
            ],
            [
                'id_control_admin' => 10,
                'id_unidad'        => 10,
                'grupo'            => 10,
                'fecha_evaluacion' => '2026-03-27',
                'fecha_revision'   => '2026-03-27',
                'fecha_entrega'    => '2026-03-27',
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'id_encabezado'    => 10,
                'habilitado'       => 10,
            ],
            [
                'id_control_admin' => 11,
                'id_unidad'        => 11,
                'grupo'            => 11,
                'fecha_evaluacion' => '2026-04-05',
                'fecha_revision'   => '2026-04-05',
                'fecha_entrega'    => '2026-04-05',
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'id_encabezado'    => 11,
                'habilitado'       => 11,
            ],
            [
                'id_control_admin' => 12,
                'id_unidad'        => 12,
                'grupo'            => 12,
                'fecha_evaluacion' => '2026-04-14',
                'fecha_revision'   => '2026-04-14',
                'fecha_entrega'    => '2026-04-14',
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'id_encabezado'    => 12,
                'habilitado'       => 12,
            ],
            [
                'id_control_admin' => 13,
                'id_unidad'        => 13,
                'grupo'            => 13,
                'fecha_evaluacion' => '2026-04-23',
                'fecha_revision'   => '2026-04-23',
                'fecha_entrega'    => '2026-04-23',
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'id_encabezado'    => 13,
                'habilitado'       => 13,
            ],
            [
                'id_control_admin' => 14,
                'id_unidad'        => 14,
                'grupo'            => 14,
                'fecha_evaluacion' => '2026-05-02',
                'fecha_revision'   => '2026-05-02',
                'fecha_entrega'    => '2026-05-02',
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'id_encabezado'    => 14,
                'habilitado'       => 14,
            ],
            [
                'id_control_admin' => 15,
                'id_unidad'        => 15,
                'grupo'            => 15,
                'fecha_evaluacion' => '2026-05-11',
                'fecha_revision'   => '2026-05-11',
                'fecha_entrega'    => '2026-05-11',
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'id_encabezado'    => 15,
                'habilitado'       => 15,
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
