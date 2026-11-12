<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_periodos`.
 */
class ServPeriodosSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_periodos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'serv_periodos';

        $llaves = [
            ['id_periodo'],
        ];

        $registros = [
            [
                'id_periodo' => 1,
                'periodo'    => 'FEBRERO-JULIO 2021',
            ],
            [
                'id_periodo' => 2,
                'periodo'    => 'AGOSTO 2021-ENERO 2022',
            ],
            [
                'id_periodo' => 3,
                'periodo'    => 'FEBRERO-JULIO 2022',
            ],
            [
                'id_periodo' => 4,
                'periodo'    => 'AGOSTO 2022-ENERO 2023',
            ],
            [
                'id_periodo' => 5,
                'periodo'    => 'FEBRERO-JULIO 2023',
            ],
            [
                'id_periodo' => 6,
                'periodo'    => 'AGOSTO 2023-ENERO 2024',
            ],
            [
                'id_periodo' => 7,
                'periodo'    => 'FEBRERO-JULIO 2024',
            ],
            [
                'id_periodo' => 8,
                'periodo'    => 'AGOSTO 2024-ENERO 2025',
            ],
            [
                'id_periodo' => 9,
                'periodo'    => 'FEBRERO-JULIO 2025',
            ],
            [
                'id_periodo' => 10,
                'periodo'    => 'AGOSTO 2025-ENERO 2026',
            ],
            [
                'id_periodo' => 11,
                'periodo'    => 'FEBRERO-JULIO 2026',
            ],
            [
                'id_periodo' => 12,
                'periodo'    => 'AGOSTO 2026-ENERO 2027',
            ],
            [
                'id_periodo' => 13,
                'periodo'    => 'FEBRERO-JULIO 2027',
            ],
            [
                'id_periodo' => 14,
                'periodo'    => 'AGOSTO 2027-ENERO 2028',
            ],
            [
                'id_periodo' => 15,
                'periodo'    => 'FEBRERO-JULIO 2028',
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
