<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_clasif_r`.
 */
class RiClasifRSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_clasif_r` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_clasif_r';

        $llaves = [
            ['id_cl_r'],
        ];

        $registros = [
            [
                'id_cl_r'    => 1,
                'des_cl'     => 'Des cl clasif r 1',
                'updated_at' => '2026-01-05 09:00:00',
                'created_at' => '2026-01-05 09:00:00',
            ],
            [
                'id_cl_r'    => 2,
                'des_cl'     => 'Des cl clasif r 2',
                'updated_at' => '2026-01-14 10:00:00',
                'created_at' => '2026-01-14 10:00:00',
            ],
            [
                'id_cl_r'    => 3,
                'des_cl'     => 'Des cl clasif r 3',
                'updated_at' => '2026-01-23 11:00:00',
                'created_at' => '2026-01-23 11:00:00',
            ],
            [
                'id_cl_r'    => 4,
                'des_cl'     => 'Des cl clasif r 4',
                'updated_at' => '2026-02-01 12:00:00',
                'created_at' => '2026-02-01 12:00:00',
            ],
            [
                'id_cl_r'    => 5,
                'des_cl'     => 'Des cl clasif r 5',
                'updated_at' => '2026-02-10 13:00:00',
                'created_at' => '2026-02-10 13:00:00',
            ],
            [
                'id_cl_r'    => 6,
                'des_cl'     => 'Des cl clasif r 6',
                'updated_at' => '2026-02-19 14:00:00',
                'created_at' => '2026-02-19 14:00:00',
            ],
            [
                'id_cl_r'    => 7,
                'des_cl'     => 'Des cl clasif r 7',
                'updated_at' => '2026-02-28 15:00:00',
                'created_at' => '2026-02-28 15:00:00',
            ],
            [
                'id_cl_r'    => 8,
                'des_cl'     => 'Des cl clasif r 8',
                'updated_at' => '2026-03-09 16:00:00',
                'created_at' => '2026-03-09 16:00:00',
            ],
            [
                'id_cl_r'    => 9,
                'des_cl'     => 'Des cl clasif r 9',
                'updated_at' => '2026-03-18 08:00:00',
                'created_at' => '2026-03-18 08:00:00',
            ],
            [
                'id_cl_r'    => 10,
                'des_cl'     => 'Des cl clasif r 10',
                'updated_at' => '2026-03-27 09:00:00',
                'created_at' => '2026-03-27 09:00:00',
            ],
            [
                'id_cl_r'    => 11,
                'des_cl'     => 'Des cl clasif r 11',
                'updated_at' => '2026-04-05 10:00:00',
                'created_at' => '2026-04-05 10:00:00',
            ],
            [
                'id_cl_r'    => 12,
                'des_cl'     => 'Des cl clasif r 12',
                'updated_at' => '2026-04-14 11:00:00',
                'created_at' => '2026-04-14 11:00:00',
            ],
            [
                'id_cl_r'    => 13,
                'des_cl'     => 'Des cl clasif r 13',
                'updated_at' => '2026-04-23 12:00:00',
                'created_at' => '2026-04-23 12:00:00',
            ],
            [
                'id_cl_r'    => 14,
                'des_cl'     => 'Des cl clasif r 14',
                'updated_at' => '2026-05-02 13:00:00',
                'created_at' => '2026-05-02 13:00:00',
            ],
            [
                'id_cl_r'    => 15,
                'des_cl'     => 'Des cl clasif r 15',
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
