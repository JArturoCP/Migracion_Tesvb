<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_probabilidad`.
 */
class RiOProbabilidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_probabilidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_o_probabilidad';

        $llaves = [
            ['id_probabilidad'],
        ];

        $registros = [
            [
                'id_probabilidad'  => 1,
                'des_probabilidad' => 'Des probabilidad o probabilidad 1',
                'calificacion'     => 77,
                'updated_at'       => '2026-01-05 09:00:00',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_probabilidad'  => 2,
                'des_probabilidad' => 'Des probabilidad o probabilidad 2',
                'calificacion'     => 84,
                'updated_at'       => '2026-01-14 10:00:00',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_probabilidad'  => 3,
                'des_probabilidad' => 'Des probabilidad o probabilidad 3',
                'calificacion'     => 91,
                'updated_at'       => '2026-01-23 11:00:00',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_probabilidad'  => 4,
                'des_probabilidad' => 'Des probabilidad o probabilidad 4',
                'calificacion'     => 98,
                'updated_at'       => '2026-02-01 12:00:00',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_probabilidad'  => 5,
                'des_probabilidad' => 'Des probabilidad o probabilidad 5',
                'calificacion'     => 74,
                'updated_at'       => '2026-02-10 13:00:00',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_probabilidad'  => 6,
                'des_probabilidad' => 'Des probabilidad o probabilidad 6',
                'calificacion'     => 81,
                'updated_at'       => '2026-02-19 14:00:00',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_probabilidad'  => 7,
                'des_probabilidad' => 'Des probabilidad o probabilidad 7',
                'calificacion'     => 88,
                'updated_at'       => '2026-02-28 15:00:00',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_probabilidad'  => 8,
                'des_probabilidad' => 'Des probabilidad o probabilidad 8',
                'calificacion'     => 95,
                'updated_at'       => '2026-03-09 16:00:00',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_probabilidad'  => 9,
                'des_probabilidad' => 'Des probabilidad o probabilidad 9',
                'calificacion'     => 71,
                'updated_at'       => '2026-03-18 08:00:00',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_probabilidad'  => 10,
                'des_probabilidad' => 'Des probabilidad o probabilidad 10',
                'calificacion'     => 78,
                'updated_at'       => '2026-03-27 09:00:00',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_probabilidad'  => 11,
                'des_probabilidad' => 'Des probabilidad o probabilidad 11',
                'calificacion'     => 85,
                'updated_at'       => '2026-04-05 10:00:00',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_probabilidad'  => 12,
                'des_probabilidad' => 'Des probabilidad o probabilidad 12',
                'calificacion'     => 92,
                'updated_at'       => '2026-04-14 11:00:00',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_probabilidad'  => 13,
                'des_probabilidad' => 'Des probabilidad o probabilidad 13',
                'calificacion'     => 99,
                'updated_at'       => '2026-04-23 12:00:00',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_probabilidad'  => 14,
                'des_probabilidad' => 'Des probabilidad o probabilidad 14',
                'calificacion'     => 75,
                'updated_at'       => '2026-05-02 13:00:00',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_probabilidad'  => 15,
                'des_probabilidad' => 'Des probabilidad o probabilidad 15',
                'calificacion'     => 82,
                'updated_at'       => '2026-05-11 14:00:00',
                'created_at'       => '2026-05-11 14:00:00',
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
