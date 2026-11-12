<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_nivel_decision`.
 */
class RiNivelDecisionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_nivel_decision` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_nivel_decision';

        $llaves = [
            ['id_nivel_de'],
        ];

        $registros = [
            [
                'id_nivel_de'   => 1,
                'des_nivel_des' => 'Des nivel des nivel decision 1',
                'updated_at'    => '2026-01-05 09:00:00',
                'created_at'    => '2026-01-05 09:00:00',
            ],
            [
                'id_nivel_de'   => 2,
                'des_nivel_des' => 'Des nivel des nivel decision 2',
                'updated_at'    => '2026-01-14 10:00:00',
                'created_at'    => '2026-01-14 10:00:00',
            ],
            [
                'id_nivel_de'   => 3,
                'des_nivel_des' => 'Des nivel des nivel decision 3',
                'updated_at'    => '2026-01-23 11:00:00',
                'created_at'    => '2026-01-23 11:00:00',
            ],
            [
                'id_nivel_de'   => 4,
                'des_nivel_des' => 'Des nivel des nivel decision 4',
                'updated_at'    => '2026-02-01 12:00:00',
                'created_at'    => '2026-02-01 12:00:00',
            ],
            [
                'id_nivel_de'   => 5,
                'des_nivel_des' => 'Des nivel des nivel decision 5',
                'updated_at'    => '2026-02-10 13:00:00',
                'created_at'    => '2026-02-10 13:00:00',
            ],
            [
                'id_nivel_de'   => 6,
                'des_nivel_des' => 'Des nivel des nivel decision 6',
                'updated_at'    => '2026-02-19 14:00:00',
                'created_at'    => '2026-02-19 14:00:00',
            ],
            [
                'id_nivel_de'   => 7,
                'des_nivel_des' => 'Des nivel des nivel decision 7',
                'updated_at'    => '2026-02-28 15:00:00',
                'created_at'    => '2026-02-28 15:00:00',
            ],
            [
                'id_nivel_de'   => 8,
                'des_nivel_des' => 'Des nivel des nivel decision 8',
                'updated_at'    => '2026-03-09 16:00:00',
                'created_at'    => '2026-03-09 16:00:00',
            ],
            [
                'id_nivel_de'   => 9,
                'des_nivel_des' => 'Des nivel des nivel decision 9',
                'updated_at'    => '2026-03-18 08:00:00',
                'created_at'    => '2026-03-18 08:00:00',
            ],
            [
                'id_nivel_de'   => 10,
                'des_nivel_des' => 'Des nivel des nivel decision 10',
                'updated_at'    => '2026-03-27 09:00:00',
                'created_at'    => '2026-03-27 09:00:00',
            ],
            [
                'id_nivel_de'   => 11,
                'des_nivel_des' => 'Des nivel des nivel decision 11',
                'updated_at'    => '2026-04-05 10:00:00',
                'created_at'    => '2026-04-05 10:00:00',
            ],
            [
                'id_nivel_de'   => 12,
                'des_nivel_des' => 'Des nivel des nivel decision 12',
                'updated_at'    => '2026-04-14 11:00:00',
                'created_at'    => '2026-04-14 11:00:00',
            ],
            [
                'id_nivel_de'   => 13,
                'des_nivel_des' => 'Des nivel des nivel decision 13',
                'updated_at'    => '2026-04-23 12:00:00',
                'created_at'    => '2026-04-23 12:00:00',
            ],
            [
                'id_nivel_de'   => 14,
                'des_nivel_des' => 'Des nivel des nivel decision 14',
                'updated_at'    => '2026-05-02 13:00:00',
                'created_at'    => '2026-05-02 13:00:00',
            ],
            [
                'id_nivel_de'   => 15,
                'des_nivel_des' => 'Des nivel des nivel decision 15',
                'updated_at'    => '2026-05-11 14:00:00',
                'created_at'    => '2026-05-11 14:00:00',
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
