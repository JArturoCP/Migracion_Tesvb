<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_encabezado`.
 */
class PlanEncabezadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_encabezado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'plan_encabezado';

        $llaves = [
            ['id_encabezado'],
        ];

        $registros = [
            [
                'id_encabezado'            => 1,
                'id_carrera'               => 1,
                'id_periodo'               => 12,
                'id_temario'               => 1,
                'grupo'                    => 1,
                'id_personal'              => 1,
                'f_inicioPlan'             => '2026-01-05',
                'f_finPlan'                => '2026-01-05',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 1.',
                'created_at'               => '2026-01-05 09:00:00',
                'updated_at'               => '2026-01-05 09:00:00',
            ],
            [
                'id_encabezado'            => 2,
                'id_carrera'               => 2,
                'id_periodo'               => 12,
                'id_temario'               => 2,
                'grupo'                    => 2,
                'id_personal'              => 2,
                'f_inicioPlan'             => '2026-01-14',
                'f_finPlan'                => '2026-01-14',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 2.',
                'created_at'               => '2026-01-14 10:00:00',
                'updated_at'               => '2026-01-14 10:00:00',
            ],
            [
                'id_encabezado'            => 3,
                'id_carrera'               => 3,
                'id_periodo'               => 3,
                'id_temario'               => 3,
                'grupo'                    => 3,
                'id_personal'              => 3,
                'f_inicioPlan'             => '2026-01-23',
                'f_finPlan'                => '2026-01-23',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 3.',
                'created_at'               => '2026-01-23 11:00:00',
                'updated_at'               => '2026-01-23 11:00:00',
            ],
            [
                'id_encabezado'            => 4,
                'id_carrera'               => 4,
                'id_periodo'               => 12,
                'id_temario'               => 4,
                'grupo'                    => 4,
                'id_personal'              => 4,
                'f_inicioPlan'             => '2026-02-01',
                'f_finPlan'                => '2026-02-01',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 4.',
                'created_at'               => '2026-02-01 12:00:00',
                'updated_at'               => '2026-02-01 12:00:00',
            ],
            [
                'id_encabezado'            => 5,
                'id_carrera'               => 5,
                'id_periodo'               => 12,
                'id_temario'               => 5,
                'grupo'                    => 5,
                'id_personal'              => 5,
                'f_inicioPlan'             => '2026-02-10',
                'f_finPlan'                => '2026-02-10',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 5.',
                'created_at'               => '2026-02-10 13:00:00',
                'updated_at'               => '2026-02-10 13:00:00',
            ],
            [
                'id_encabezado'            => 6,
                'id_carrera'               => 6,
                'id_periodo'               => 6,
                'id_temario'               => 6,
                'grupo'                    => 6,
                'id_personal'              => 6,
                'f_inicioPlan'             => '2026-02-19',
                'f_finPlan'                => '2026-02-19',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 6.',
                'created_at'               => '2026-02-19 14:00:00',
                'updated_at'               => '2026-02-19 14:00:00',
            ],
            [
                'id_encabezado'            => 7,
                'id_carrera'               => 7,
                'id_periodo'               => 12,
                'id_temario'               => 7,
                'grupo'                    => 7,
                'id_personal'              => 7,
                'f_inicioPlan'             => '2026-02-28',
                'f_finPlan'                => '2026-02-28',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 7.',
                'created_at'               => '2026-02-28 15:00:00',
                'updated_at'               => '2026-02-28 15:00:00',
            ],
            [
                'id_encabezado'            => 8,
                'id_carrera'               => 1,
                'id_periodo'               => 12,
                'id_temario'               => 8,
                'grupo'                    => 8,
                'id_personal'              => 8,
                'f_inicioPlan'             => '2026-03-09',
                'f_finPlan'                => '2026-03-09',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 8.',
                'created_at'               => '2026-03-09 16:00:00',
                'updated_at'               => '2026-03-09 16:00:00',
            ],
            [
                'id_encabezado'            => 9,
                'id_carrera'               => 2,
                'id_periodo'               => 9,
                'id_temario'               => 9,
                'grupo'                    => 9,
                'id_personal'              => 9,
                'f_inicioPlan'             => '2026-03-18',
                'f_finPlan'                => '2026-03-18',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 9.',
                'created_at'               => '2026-03-18 08:00:00',
                'updated_at'               => '2026-03-18 08:00:00',
            ],
            [
                'id_encabezado'            => 10,
                'id_carrera'               => 3,
                'id_periodo'               => 12,
                'id_temario'               => 10,
                'grupo'                    => 10,
                'id_personal'              => 10,
                'f_inicioPlan'             => '2026-03-27',
                'f_finPlan'                => '2026-03-27',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 10.',
                'created_at'               => '2026-03-27 09:00:00',
                'updated_at'               => '2026-03-27 09:00:00',
            ],
            [
                'id_encabezado'            => 11,
                'id_carrera'               => 4,
                'id_periodo'               => 12,
                'id_temario'               => 11,
                'grupo'                    => 11,
                'id_personal'              => 11,
                'f_inicioPlan'             => '2026-04-05',
                'f_finPlan'                => '2026-04-05',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 11.',
                'created_at'               => '2026-04-05 10:00:00',
                'updated_at'               => '2026-04-05 10:00:00',
            ],
            [
                'id_encabezado'            => 12,
                'id_carrera'               => 5,
                'id_periodo'               => 12,
                'id_temario'               => 12,
                'grupo'                    => 12,
                'id_personal'              => 12,
                'f_inicioPlan'             => '2026-04-14',
                'f_finPlan'                => '2026-04-14',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 12.',
                'created_at'               => '2026-04-14 11:00:00',
                'updated_at'               => '2026-04-14 11:00:00',
            ],
            [
                'id_encabezado'            => 13,
                'id_carrera'               => 6,
                'id_periodo'               => 12,
                'id_temario'               => 13,
                'grupo'                    => 13,
                'id_personal'              => 13,
                'f_inicioPlan'             => '2026-04-23',
                'f_finPlan'                => '2026-04-23',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 13.',
                'created_at'               => '2026-04-23 12:00:00',
                'updated_at'               => '2026-04-23 12:00:00',
            ],
            [
                'id_encabezado'            => 14,
                'id_carrera'               => 7,
                'id_periodo'               => 12,
                'id_temario'               => 14,
                'grupo'                    => 14,
                'id_personal'              => 14,
                'f_inicioPlan'             => '2026-05-02',
                'f_finPlan'                => '2026-05-02',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 14.',
                'created_at'               => '2026-05-02 13:00:00',
                'updated_at'               => '2026-05-02 13:00:00',
            ],
            [
                'id_encabezado'            => 15,
                'id_carrera'               => 1,
                'id_periodo'               => 15,
                'id_temario'               => 15,
                'grupo'                    => 15,
                'id_personal'              => 15,
                'f_inicioPlan'             => '2026-05-11',
                'f_finPlan'                => '2026-05-11',
                'descripcion_discapacidad' => 'Descripcion discapacidad de encabezado: registro de prueba número 15.',
                'created_at'               => '2026-05-11 14:00:00',
                'updated_at'               => '2026-05-11 14:00:00',
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
