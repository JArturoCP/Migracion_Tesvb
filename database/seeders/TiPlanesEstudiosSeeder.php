<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_planes_estudios`.
 */
class TiPlanesEstudiosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_planes_estudios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_planes_estudios';

        $llaves = [
            ['id_plan_estudio'],
        ];

        $registros = [
            [
                'id_plan_estudio' => 1,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 1.',
            ],
            [
                'id_plan_estudio' => 2,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 2.',
            ],
            [
                'id_plan_estudio' => 3,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 3.',
            ],
            [
                'id_plan_estudio' => 4,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 4.',
            ],
            [
                'id_plan_estudio' => 5,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 5.',
            ],
            [
                'id_plan_estudio' => 6,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 6.',
            ],
            [
                'id_plan_estudio' => 7,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 7.',
            ],
            [
                'id_plan_estudio' => 8,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 8.',
            ],
            [
                'id_plan_estudio' => 9,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 9.',
            ],
            [
                'id_plan_estudio' => 10,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 10.',
            ],
            [
                'id_plan_estudio' => 11,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 11.',
            ],
            [
                'id_plan_estudio' => 12,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 12.',
            ],
            [
                'id_plan_estudio' => 13,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 13.',
            ],
            [
                'id_plan_estudio' => 14,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 14.',
            ],
            [
                'id_plan_estudio' => 15,
                'plan_estudio'    => 'Plan estudio de planes estudios: registro de prueba número 15.',
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
