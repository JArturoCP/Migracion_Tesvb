<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_actividades`.
 */
class PlanActividadesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_actividades` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpGeneracionSeeder::class,
            GnralPeriodosSeeder::class,
            PlanEstadosSeeder::class,
        ]);

        $tabla = 'plan_actividades';

        $llaves = [
            ['id_plan_actividad'],
        ];

        $registros = [
            [
                'id_plan_actividad'  => 1,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 1.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 1.',
                'fi_actividad'       => '2026-01-05',
                'ff_actividad'       => '2026-01-05',
                'id_generacion'      => 1,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 1.',
                'id_estado'          => 1,
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 2,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 2.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 2.',
                'fi_actividad'       => '2026-01-14',
                'ff_actividad'       => '2026-01-14',
                'id_generacion'      => 2,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 2.',
                'id_estado'          => 2,
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 3,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 3.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 3.',
                'fi_actividad'       => '2026-01-23',
                'ff_actividad'       => '2026-01-23',
                'id_generacion'      => 3,
                'id_periodo'         => 3,
                'comentario'         => 'Comentario de actividades: registro de prueba número 3.',
                'id_estado'          => 3,
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 4,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 4.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 4.',
                'fi_actividad'       => '2026-02-01',
                'ff_actividad'       => '2026-02-01',
                'id_generacion'      => 4,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 4.',
                'id_estado'          => 4,
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 5,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 5.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 5.',
                'fi_actividad'       => '2026-02-10',
                'ff_actividad'       => '2026-02-10',
                'id_generacion'      => 5,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 5.',
                'id_estado'          => 5,
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 6,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 6.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 6.',
                'fi_actividad'       => '2026-02-19',
                'ff_actividad'       => '2026-02-19',
                'id_generacion'      => 6,
                'id_periodo'         => 6,
                'comentario'         => 'Comentario de actividades: registro de prueba número 6.',
                'id_estado'          => 6,
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 7,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 7.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 7.',
                'fi_actividad'       => '2026-02-28',
                'ff_actividad'       => '2026-02-28',
                'id_generacion'      => 7,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 7.',
                'id_estado'          => 7,
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 8,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 8.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 8.',
                'fi_actividad'       => '2026-03-09',
                'ff_actividad'       => '2026-03-09',
                'id_generacion'      => 8,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 8.',
                'id_estado'          => 8,
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 9,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 9.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 9.',
                'fi_actividad'       => '2026-03-18',
                'ff_actividad'       => '2026-03-18',
                'id_generacion'      => 9,
                'id_periodo'         => 9,
                'comentario'         => 'Comentario de actividades: registro de prueba número 9.',
                'id_estado'          => 9,
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 10,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 10.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 10.',
                'fi_actividad'       => '2026-03-27',
                'ff_actividad'       => '2026-03-27',
                'id_generacion'      => 10,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 10.',
                'id_estado'          => 10,
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 11,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 11.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 11.',
                'fi_actividad'       => '2026-04-05',
                'ff_actividad'       => '2026-04-05',
                'id_generacion'      => 11,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 11.',
                'id_estado'          => 11,
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 12,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 12.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 12.',
                'fi_actividad'       => '2026-04-14',
                'ff_actividad'       => '2026-04-14',
                'id_generacion'      => 12,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 12.',
                'id_estado'          => 12,
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 13,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 13.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 13.',
                'fi_actividad'       => '2026-04-23',
                'ff_actividad'       => '2026-04-23',
                'id_generacion'      => 13,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 13.',
                'id_estado'          => 13,
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 14,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 14.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 14.',
                'fi_actividad'       => '2026-05-02',
                'ff_actividad'       => '2026-05-02',
                'id_generacion'      => 14,
                'id_periodo'         => 12,
                'comentario'         => 'Comentario de actividades: registro de prueba número 14.',
                'id_estado'          => 14,
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_plan_actividad'  => 15,
                'desc_actividad'     => 'Desc actividad de actividades: registro de prueba número 15.',
                'objetivo_actividad' => 'Objetivo actividad de actividades: registro de prueba número 15.',
                'fi_actividad'       => '2026-05-11',
                'ff_actividad'       => '2026-05-11',
                'id_generacion'      => 15,
                'id_periodo'         => 15,
                'comentario'         => 'Comentario de actividades: registro de prueba número 15.',
                'id_estado'          => 15,
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'deleted_at'         => null,
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
