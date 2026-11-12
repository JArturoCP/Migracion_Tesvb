<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_mejorareputacion`.
 */
class RiOMejorareputacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_mejorareputacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_o_mejorareputacion';

        $llaves = [
            ['id_mejorareputacion'],
        ];

        $registros = [
            [
                'id_mejorareputacion'  => 1,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 1',
                'calificacion'         => 77,
                'updated_at'           => '2026-01-05 09:00:00',
                'created_at'           => '2026-01-05 09:00:00',
            ],
            [
                'id_mejorareputacion'  => 2,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 2',
                'calificacion'         => 84,
                'updated_at'           => '2026-01-14 10:00:00',
                'created_at'           => '2026-01-14 10:00:00',
            ],
            [
                'id_mejorareputacion'  => 3,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 3',
                'calificacion'         => 91,
                'updated_at'           => '2026-01-23 11:00:00',
                'created_at'           => '2026-01-23 11:00:00',
            ],
            [
                'id_mejorareputacion'  => 4,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 4',
                'calificacion'         => 98,
                'updated_at'           => '2026-02-01 12:00:00',
                'created_at'           => '2026-02-01 12:00:00',
            ],
            [
                'id_mejorareputacion'  => 5,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 5',
                'calificacion'         => 74,
                'updated_at'           => '2026-02-10 13:00:00',
                'created_at'           => '2026-02-10 13:00:00',
            ],
            [
                'id_mejorareputacion'  => 6,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 6',
                'calificacion'         => 81,
                'updated_at'           => '2026-02-19 14:00:00',
                'created_at'           => '2026-02-19 14:00:00',
            ],
            [
                'id_mejorareputacion'  => 7,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 7',
                'calificacion'         => 88,
                'updated_at'           => '2026-02-28 15:00:00',
                'created_at'           => '2026-02-28 15:00:00',
            ],
            [
                'id_mejorareputacion'  => 8,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 8',
                'calificacion'         => 95,
                'updated_at'           => '2026-03-09 16:00:00',
                'created_at'           => '2026-03-09 16:00:00',
            ],
            [
                'id_mejorareputacion'  => 9,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 9',
                'calificacion'         => 71,
                'updated_at'           => '2026-03-18 08:00:00',
                'created_at'           => '2026-03-18 08:00:00',
            ],
            [
                'id_mejorareputacion'  => 10,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 10',
                'calificacion'         => 78,
                'updated_at'           => '2026-03-27 09:00:00',
                'created_at'           => '2026-03-27 09:00:00',
            ],
            [
                'id_mejorareputacion'  => 11,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 11',
                'calificacion'         => 85,
                'updated_at'           => '2026-04-05 10:00:00',
                'created_at'           => '2026-04-05 10:00:00',
            ],
            [
                'id_mejorareputacion'  => 12,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 12',
                'calificacion'         => 92,
                'updated_at'           => '2026-04-14 11:00:00',
                'created_at'           => '2026-04-14 11:00:00',
            ],
            [
                'id_mejorareputacion'  => 13,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 13',
                'calificacion'         => 99,
                'updated_at'           => '2026-04-23 12:00:00',
                'created_at'           => '2026-04-23 12:00:00',
            ],
            [
                'id_mejorareputacion'  => 14,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 14',
                'calificacion'         => 75,
                'updated_at'           => '2026-05-02 13:00:00',
                'created_at'           => '2026-05-02 13:00:00',
            ],
            [
                'id_mejorareputacion'  => 15,
                'des_mejorareputacion' => 'Des mejorareputacion o mejorareputacion 15',
                'calificacion'         => 82,
                'updated_at'           => '2026-05-11 14:00:00',
                'created_at'           => '2026-05-11 14:00:00',
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
