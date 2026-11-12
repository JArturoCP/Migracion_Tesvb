<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `abreviaciones`.
 */
class AbreviacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `abreviaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'abreviaciones';

        $llaves = [
            ['id_abreviacion'],
        ];

        $registros = [
            [
                'id_abreviacion' => 1,
                'titulo'         => 'Titulo abreviaciones 1',
                'updated_at'     => '2026-01-05 09:00:00',
                'created_at'     => '2026-01-05 09:00:00',
            ],
            [
                'id_abreviacion' => 2,
                'titulo'         => 'Titulo abreviaciones 2',
                'updated_at'     => '2026-01-14 10:00:00',
                'created_at'     => '2026-01-14 10:00:00',
            ],
            [
                'id_abreviacion' => 3,
                'titulo'         => 'Titulo abreviaciones 3',
                'updated_at'     => '2026-01-23 11:00:00',
                'created_at'     => '2026-01-23 11:00:00',
            ],
            [
                'id_abreviacion' => 4,
                'titulo'         => 'Titulo abreviaciones 4',
                'updated_at'     => '2026-02-01 12:00:00',
                'created_at'     => '2026-02-01 12:00:00',
            ],
            [
                'id_abreviacion' => 5,
                'titulo'         => 'Titulo abreviaciones 5',
                'updated_at'     => '2026-02-10 13:00:00',
                'created_at'     => '2026-02-10 13:00:00',
            ],
            [
                'id_abreviacion' => 6,
                'titulo'         => 'Titulo abreviaciones 6',
                'updated_at'     => '2026-02-19 14:00:00',
                'created_at'     => '2026-02-19 14:00:00',
            ],
            [
                'id_abreviacion' => 7,
                'titulo'         => 'Titulo abreviaciones 7',
                'updated_at'     => '2026-02-28 15:00:00',
                'created_at'     => '2026-02-28 15:00:00',
            ],
            [
                'id_abreviacion' => 8,
                'titulo'         => 'Titulo abreviaciones 8',
                'updated_at'     => '2026-03-09 16:00:00',
                'created_at'     => '2026-03-09 16:00:00',
            ],
            [
                'id_abreviacion' => 9,
                'titulo'         => 'Titulo abreviaciones 9',
                'updated_at'     => '2026-03-18 08:00:00',
                'created_at'     => '2026-03-18 08:00:00',
            ],
            [
                'id_abreviacion' => 10,
                'titulo'         => 'Titulo abreviaciones 10',
                'updated_at'     => '2026-03-27 09:00:00',
                'created_at'     => '2026-03-27 09:00:00',
            ],
            [
                'id_abreviacion' => 11,
                'titulo'         => 'Titulo abreviaciones 11',
                'updated_at'     => '2026-04-05 10:00:00',
                'created_at'     => '2026-04-05 10:00:00',
            ],
            [
                'id_abreviacion' => 12,
                'titulo'         => 'Titulo abreviaciones 12',
                'updated_at'     => '2026-04-14 11:00:00',
                'created_at'     => '2026-04-14 11:00:00',
            ],
            [
                'id_abreviacion' => 13,
                'titulo'         => 'Titulo abreviaciones 13',
                'updated_at'     => '2026-04-23 12:00:00',
                'created_at'     => '2026-04-23 12:00:00',
            ],
            [
                'id_abreviacion' => 14,
                'titulo'         => 'Titulo abreviaciones 14',
                'updated_at'     => '2026-05-02 13:00:00',
                'created_at'     => '2026-05-02 13:00:00',
            ],
            [
                'id_abreviacion' => 15,
                'titulo'         => 'Titulo abreviaciones 15',
                'updated_at'     => '2026-05-11 14:00:00',
                'created_at'     => '2026-05-11 14:00:00',
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
