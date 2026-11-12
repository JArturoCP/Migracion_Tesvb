<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_generacion`.
 */
class ExpGeneracionSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_generacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_generacion';

        $llaves = [
            ['id_generacion'],
        ];

        $registros = [
            [
                'id_generacion' => 1,
                'generacion'    => 1,
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
            ],
            [
                'id_generacion' => 2,
                'generacion'    => 2,
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
            ],
            [
                'id_generacion' => 3,
                'generacion'    => 3,
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
            ],
            [
                'id_generacion' => 4,
                'generacion'    => 4,
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
            ],
            [
                'id_generacion' => 5,
                'generacion'    => 5,
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
            ],
            [
                'id_generacion' => 6,
                'generacion'    => 6,
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
            ],
            [
                'id_generacion' => 7,
                'generacion'    => 7,
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
            ],
            [
                'id_generacion' => 8,
                'generacion'    => 8,
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
            ],
            [
                'id_generacion' => 9,
                'generacion'    => 9,
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
            ],
            [
                'id_generacion' => 10,
                'generacion'    => 10,
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
            ],
            [
                'id_generacion' => 11,
                'generacion'    => 11,
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
            ],
            [
                'id_generacion' => 12,
                'generacion'    => 12,
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
            ],
            [
                'id_generacion' => 13,
                'generacion'    => 13,
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
            ],
            [
                'id_generacion' => 14,
                'generacion'    => 14,
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
            ],
            [
                'id_generacion' => 15,
                'generacion'    => 15,
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
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
