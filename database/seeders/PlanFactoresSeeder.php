<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_factores`.
 */
class PlanFactoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_factores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PlanEjesSeeder::class,
        ]);

        $tabla = 'plan_factores';

        $llaves = [
            ['id_factor'],
        ];

        $registros = [
            [
                'id_factor'   => 1,
                'desc_factor' => 'Desc factor factores 1',
                'id_eje'      => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_factor'   => 2,
                'desc_factor' => 'Desc factor factores 2',
                'id_eje'      => 2,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_factor'   => 3,
                'desc_factor' => 'Desc factor factores 3',
                'id_eje'      => 3,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_factor'   => 4,
                'desc_factor' => 'Desc factor factores 4',
                'id_eje'      => 4,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_factor'   => 5,
                'desc_factor' => 'Desc factor factores 5',
                'id_eje'      => 5,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_factor'   => 6,
                'desc_factor' => 'Desc factor factores 6',
                'id_eje'      => 6,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_factor'   => 7,
                'desc_factor' => 'Desc factor factores 7',
                'id_eje'      => 7,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_factor'   => 8,
                'desc_factor' => 'Desc factor factores 8',
                'id_eje'      => 8,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_factor'   => 9,
                'desc_factor' => 'Desc factor factores 9',
                'id_eje'      => 9,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_factor'   => 10,
                'desc_factor' => 'Desc factor factores 10',
                'id_eje'      => 10,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_factor'   => 11,
                'desc_factor' => 'Desc factor factores 11',
                'id_eje'      => 11,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_factor'   => 12,
                'desc_factor' => 'Desc factor factores 12',
                'id_eje'      => 12,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_factor'   => 13,
                'desc_factor' => 'Desc factor factores 13',
                'id_eje'      => 13,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_factor'   => 14,
                'desc_factor' => 'Desc factor factores 14',
                'id_eje'      => 14,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_factor'   => 15,
                'desc_factor' => 'Desc factor factores 15',
                'id_eje'      => 15,
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
