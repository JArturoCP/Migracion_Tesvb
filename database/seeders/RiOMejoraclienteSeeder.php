<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_mejoracliente`.
 */
class RiOMejoraclienteSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_mejoracliente` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_o_mejoracliente';

        $llaves = [
            ['id_mejoracliente'],
        ];

        $registros = [
            [
                'id_mejoracliente'  => 1,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 1',
                'calificacion'      => 77,
                'updated_at'        => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_mejoracliente'  => 2,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 2',
                'calificacion'      => 84,
                'updated_at'        => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_mejoracliente'  => 3,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 3',
                'calificacion'      => 91,
                'updated_at'        => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_mejoracliente'  => 4,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 4',
                'calificacion'      => 98,
                'updated_at'        => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_mejoracliente'  => 5,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 5',
                'calificacion'      => 74,
                'updated_at'        => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_mejoracliente'  => 6,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 6',
                'calificacion'      => 81,
                'updated_at'        => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_mejoracliente'  => 7,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 7',
                'calificacion'      => 88,
                'updated_at'        => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_mejoracliente'  => 8,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 8',
                'calificacion'      => 95,
                'updated_at'        => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_mejoracliente'  => 9,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 9',
                'calificacion'      => 71,
                'updated_at'        => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_mejoracliente'  => 10,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 10',
                'calificacion'      => 78,
                'updated_at'        => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_mejoracliente'  => 11,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 11',
                'calificacion'      => 85,
                'updated_at'        => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_mejoracliente'  => 12,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 12',
                'calificacion'      => 92,
                'updated_at'        => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_mejoracliente'  => 13,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 13',
                'calificacion'      => 99,
                'updated_at'        => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_mejoracliente'  => 14,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 14',
                'calificacion'      => 75,
                'updated_at'        => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_mejoracliente'  => 15,
                'des_mejoracliente' => 'Des mejoracliente o mejoracliente 15',
                'calificacion'      => 82,
                'updated_at'        => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
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
