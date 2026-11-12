<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_plan`.
 */
class CalPlanSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_plan` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'cal_plan';

        $llaves = [
            ['id_plan'],
        ];

        $registros = [
            [
                'id_plan'    => 1,
                'plan'       => 'Plan plan 1',
                'id_carrera' => 1,
            ],
            [
                'id_plan'    => 2,
                'plan'       => 'Plan plan 2',
                'id_carrera' => 2,
            ],
            [
                'id_plan'    => 3,
                'plan'       => 'Plan plan 3',
                'id_carrera' => 3,
            ],
            [
                'id_plan'    => 4,
                'plan'       => 'Plan plan 4',
                'id_carrera' => 4,
            ],
            [
                'id_plan'    => 5,
                'plan'       => 'Plan plan 5',
                'id_carrera' => 5,
            ],
            [
                'id_plan'    => 6,
                'plan'       => 'Plan plan 6',
                'id_carrera' => 6,
            ],
            [
                'id_plan'    => 7,
                'plan'       => 'Plan plan 7',
                'id_carrera' => 7,
            ],
            [
                'id_plan'    => 8,
                'plan'       => 'Plan plan 8',
                'id_carrera' => 1,
            ],
            [
                'id_plan'    => 9,
                'plan'       => 'Plan plan 9',
                'id_carrera' => 2,
            ],
            [
                'id_plan'    => 10,
                'plan'       => 'Plan plan 10',
                'id_carrera' => 3,
            ],
            [
                'id_plan'    => 11,
                'plan'       => 'Plan plan 11',
                'id_carrera' => 4,
            ],
            [
                'id_plan'    => 12,
                'plan'       => 'Plan plan 12',
                'id_carrera' => 5,
            ],
            [
                'id_plan'    => 13,
                'plan'       => 'Plan plan 13',
                'id_carrera' => 6,
            ],
            [
                'id_plan'    => 14,
                'plan'       => 'Plan plan 14',
                'id_carrera' => 7,
            ],
            [
                'id_plan'    => 15,
                'plan'       => 'Plan plan 15',
                'id_carrera' => 1,
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
