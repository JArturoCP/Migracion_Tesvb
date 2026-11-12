<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_proyecto_practicas`.
 */
class PlanProyectoPracticasSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_proyecto_practicas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_proyecto_practicas';

        $llaves = [
            ['id_plan_proyecto_practica'],
        ];

        $registros = [
            [
                'id_plan_proyecto_practica' => 1,
                'id_unidad'                 => 1,
                'grupo'                     => 1,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 1.',
                'created_at'                => '2026-01-05 09:00:00',
                'updated_at'                => '2026-01-05 09:00:00',
                'id_encabezado'             => 1,
            ],
            [
                'id_plan_proyecto_practica' => 2,
                'id_unidad'                 => 2,
                'grupo'                     => 2,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 2.',
                'created_at'                => '2026-01-14 10:00:00',
                'updated_at'                => '2026-01-14 10:00:00',
                'id_encabezado'             => 2,
            ],
            [
                'id_plan_proyecto_practica' => 3,
                'id_unidad'                 => 3,
                'grupo'                     => 3,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 3.',
                'created_at'                => '2026-01-23 11:00:00',
                'updated_at'                => '2026-01-23 11:00:00',
                'id_encabezado'             => 3,
            ],
            [
                'id_plan_proyecto_practica' => 4,
                'id_unidad'                 => 4,
                'grupo'                     => 4,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 4.',
                'created_at'                => '2026-02-01 12:00:00',
                'updated_at'                => '2026-02-01 12:00:00',
                'id_encabezado'             => 4,
            ],
            [
                'id_plan_proyecto_practica' => 5,
                'id_unidad'                 => 5,
                'grupo'                     => 5,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 5.',
                'created_at'                => '2026-02-10 13:00:00',
                'updated_at'                => '2026-02-10 13:00:00',
                'id_encabezado'             => 5,
            ],
            [
                'id_plan_proyecto_practica' => 6,
                'id_unidad'                 => 6,
                'grupo'                     => 6,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 6.',
                'created_at'                => '2026-02-19 14:00:00',
                'updated_at'                => '2026-02-19 14:00:00',
                'id_encabezado'             => 6,
            ],
            [
                'id_plan_proyecto_practica' => 7,
                'id_unidad'                 => 7,
                'grupo'                     => 7,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 7.',
                'created_at'                => '2026-02-28 15:00:00',
                'updated_at'                => '2026-02-28 15:00:00',
                'id_encabezado'             => 7,
            ],
            [
                'id_plan_proyecto_practica' => 8,
                'id_unidad'                 => 8,
                'grupo'                     => 8,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 8.',
                'created_at'                => '2026-03-09 16:00:00',
                'updated_at'                => '2026-03-09 16:00:00',
                'id_encabezado'             => 8,
            ],
            [
                'id_plan_proyecto_practica' => 9,
                'id_unidad'                 => 9,
                'grupo'                     => 9,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 9.',
                'created_at'                => '2026-03-18 08:00:00',
                'updated_at'                => '2026-03-18 08:00:00',
                'id_encabezado'             => 9,
            ],
            [
                'id_plan_proyecto_practica' => 10,
                'id_unidad'                 => 10,
                'grupo'                     => 10,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 10.',
                'created_at'                => '2026-03-27 09:00:00',
                'updated_at'                => '2026-03-27 09:00:00',
                'id_encabezado'             => 10,
            ],
            [
                'id_plan_proyecto_practica' => 11,
                'id_unidad'                 => 11,
                'grupo'                     => 11,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 11.',
                'created_at'                => '2026-04-05 10:00:00',
                'updated_at'                => '2026-04-05 10:00:00',
                'id_encabezado'             => 11,
            ],
            [
                'id_plan_proyecto_practica' => 12,
                'id_unidad'                 => 12,
                'grupo'                     => 12,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 12.',
                'created_at'                => '2026-04-14 11:00:00',
                'updated_at'                => '2026-04-14 11:00:00',
                'id_encabezado'             => 12,
            ],
            [
                'id_plan_proyecto_practica' => 13,
                'id_unidad'                 => 13,
                'grupo'                     => 13,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 13.',
                'created_at'                => '2026-04-23 12:00:00',
                'updated_at'                => '2026-04-23 12:00:00',
                'id_encabezado'             => 13,
            ],
            [
                'id_plan_proyecto_practica' => 14,
                'id_unidad'                 => 14,
                'grupo'                     => 14,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 14.',
                'created_at'                => '2026-05-02 13:00:00',
                'updated_at'                => '2026-05-02 13:00:00',
                'id_encabezado'             => 14,
            ],
            [
                'id_plan_proyecto_practica' => 15,
                'id_unidad'                 => 15,
                'grupo'                     => 15,
                'Descripcion_p'             => 'Descripcion p de proyecto practicas: registro de prueba número 15.',
                'created_at'                => '2026-05-11 14:00:00',
                'updated_at'                => '2026-05-11 14:00:00',
                'id_encabezado'             => 15,
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
