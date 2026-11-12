<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_potencialcosto`.
 */
class RiOPotencialcostoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_potencialcosto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_o_potencialcosto';

        $llaves = [
            ['id_potencialcosto'],
        ];

        $registros = [
            [
                'id_potencialcosto'  => 1,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 1',
                'updated_at'         => '2026-01-05 09:00:00',
                'created_at'         => '2026-01-05 09:00:00',
            ],
            [
                'id_potencialcosto'  => 2,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 2',
                'updated_at'         => '2026-01-14 10:00:00',
                'created_at'         => '2026-01-14 10:00:00',
            ],
            [
                'id_potencialcosto'  => 3,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 3',
                'updated_at'         => '2026-01-23 11:00:00',
                'created_at'         => '2026-01-23 11:00:00',
            ],
            [
                'id_potencialcosto'  => 4,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 4',
                'updated_at'         => '2026-02-01 12:00:00',
                'created_at'         => '2026-02-01 12:00:00',
            ],
            [
                'id_potencialcosto'  => 5,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 5',
                'updated_at'         => '2026-02-10 13:00:00',
                'created_at'         => '2026-02-10 13:00:00',
            ],
            [
                'id_potencialcosto'  => 6,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 6',
                'updated_at'         => '2026-02-19 14:00:00',
                'created_at'         => '2026-02-19 14:00:00',
            ],
            [
                'id_potencialcosto'  => 7,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 7',
                'updated_at'         => '2026-02-28 15:00:00',
                'created_at'         => '2026-02-28 15:00:00',
            ],
            [
                'id_potencialcosto'  => 8,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 8',
                'updated_at'         => '2026-03-09 16:00:00',
                'created_at'         => '2026-03-09 16:00:00',
            ],
            [
                'id_potencialcosto'  => 9,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 9',
                'updated_at'         => '2026-03-18 08:00:00',
                'created_at'         => '2026-03-18 08:00:00',
            ],
            [
                'id_potencialcosto'  => 10,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 10',
                'updated_at'         => '2026-03-27 09:00:00',
                'created_at'         => '2026-03-27 09:00:00',
            ],
            [
                'id_potencialcosto'  => 11,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 11',
                'updated_at'         => '2026-04-05 10:00:00',
                'created_at'         => '2026-04-05 10:00:00',
            ],
            [
                'id_potencialcosto'  => 12,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 12',
                'updated_at'         => '2026-04-14 11:00:00',
                'created_at'         => '2026-04-14 11:00:00',
            ],
            [
                'id_potencialcosto'  => 13,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 13',
                'updated_at'         => '2026-04-23 12:00:00',
                'created_at'         => '2026-04-23 12:00:00',
            ],
            [
                'id_potencialcosto'  => 14,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 14',
                'updated_at'         => '2026-05-02 13:00:00',
                'created_at'         => '2026-05-02 13:00:00',
            ],
            [
                'id_potencialcosto'  => 15,
                'des_potencialcosto' => 'Des potencialcosto o potencialcosto 15',
                'updated_at'         => '2026-05-11 14:00:00',
                'created_at'         => '2026-05-11 14:00:00',
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
