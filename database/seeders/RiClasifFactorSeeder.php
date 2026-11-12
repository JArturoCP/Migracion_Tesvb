<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_clasif_factor`.
 */
class RiClasifFactorSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_clasif_factor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_clasif_factor';

        $llaves = [
            ['id_cl_f'],
        ];

        $registros = [
            [
                'id_cl_f'    => 1,
                'des_cl_f'   => 'Des cl f clasif factor 1',
                'updated_at' => '2026-01-05 09:00:00',
                'created_at' => '2026-01-05 09:00:00',
            ],
            [
                'id_cl_f'    => 2,
                'des_cl_f'   => 'Des cl f clasif factor 2',
                'updated_at' => '2026-01-14 10:00:00',
                'created_at' => '2026-01-14 10:00:00',
            ],
            [
                'id_cl_f'    => 3,
                'des_cl_f'   => 'Des cl f clasif factor 3',
                'updated_at' => '2026-01-23 11:00:00',
                'created_at' => '2026-01-23 11:00:00',
            ],
            [
                'id_cl_f'    => 4,
                'des_cl_f'   => 'Des cl f clasif factor 4',
                'updated_at' => '2026-02-01 12:00:00',
                'created_at' => '2026-02-01 12:00:00',
            ],
            [
                'id_cl_f'    => 5,
                'des_cl_f'   => 'Des cl f clasif factor 5',
                'updated_at' => '2026-02-10 13:00:00',
                'created_at' => '2026-02-10 13:00:00',
            ],
            [
                'id_cl_f'    => 6,
                'des_cl_f'   => 'Des cl f clasif factor 6',
                'updated_at' => '2026-02-19 14:00:00',
                'created_at' => '2026-02-19 14:00:00',
            ],
            [
                'id_cl_f'    => 7,
                'des_cl_f'   => 'Des cl f clasif factor 7',
                'updated_at' => '2026-02-28 15:00:00',
                'created_at' => '2026-02-28 15:00:00',
            ],
            [
                'id_cl_f'    => 8,
                'des_cl_f'   => 'Des cl f clasif factor 8',
                'updated_at' => '2026-03-09 16:00:00',
                'created_at' => '2026-03-09 16:00:00',
            ],
            [
                'id_cl_f'    => 9,
                'des_cl_f'   => 'Des cl f clasif factor 9',
                'updated_at' => '2026-03-18 08:00:00',
                'created_at' => '2026-03-18 08:00:00',
            ],
            [
                'id_cl_f'    => 10,
                'des_cl_f'   => 'Des cl f clasif factor 10',
                'updated_at' => '2026-03-27 09:00:00',
                'created_at' => '2026-03-27 09:00:00',
            ],
            [
                'id_cl_f'    => 11,
                'des_cl_f'   => 'Des cl f clasif factor 11',
                'updated_at' => '2026-04-05 10:00:00',
                'created_at' => '2026-04-05 10:00:00',
            ],
            [
                'id_cl_f'    => 12,
                'des_cl_f'   => 'Des cl f clasif factor 12',
                'updated_at' => '2026-04-14 11:00:00',
                'created_at' => '2026-04-14 11:00:00',
            ],
            [
                'id_cl_f'    => 13,
                'des_cl_f'   => 'Des cl f clasif factor 13',
                'updated_at' => '2026-04-23 12:00:00',
                'created_at' => '2026-04-23 12:00:00',
            ],
            [
                'id_cl_f'    => 14,
                'des_cl_f'   => 'Des cl f clasif factor 14',
                'updated_at' => '2026-05-02 13:00:00',
                'created_at' => '2026-05-02 13:00:00',
            ],
            [
                'id_cl_f'    => 15,
                'des_cl_f'   => 'Des cl f clasif factor 15',
                'updated_at' => '2026-05-11 14:00:00',
                'created_at' => '2026-05-11 14:00:00',
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
