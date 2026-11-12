<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_periodos`.
 */
class GnralPeriodosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_periodos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_periodos';

        $llaves = [
            ['id_periodo'],
        ];

        $registros = [
            [
                'id_periodo'    => 1,
                'periodo'       => 'FEBRERO-JULIO 2021',
                'fecha_inicio'  => '2021-02-01',
                'fecha_termino' => '2021-07-31',
                'ciclo'         => '2020-2021',
                'year'          => 2021,
                'siglas'        => 'FEB-JUL 2021',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 2,
                'periodo'       => 'AGOSTO 2021-ENERO 2022',
                'fecha_inicio'  => '2021-08-01',
                'fecha_termino' => '2022-01-31',
                'ciclo'         => '2021-2022',
                'year'          => 2021,
                'siglas'        => 'AGO 2021-ENE 2022',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 3,
                'periodo'       => 'FEBRERO-JULIO 2022',
                'fecha_inicio'  => '2022-02-01',
                'fecha_termino' => '2022-07-31',
                'ciclo'         => '2021-2022',
                'year'          => 2022,
                'siglas'        => 'FEB-JUL 2022',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 4,
                'periodo'       => 'AGOSTO 2022-ENERO 2023',
                'fecha_inicio'  => '2022-08-01',
                'fecha_termino' => '2023-01-31',
                'ciclo'         => '2022-2023',
                'year'          => 2022,
                'siglas'        => 'AGO 2022-ENE 2023',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 5,
                'periodo'       => 'FEBRERO-JULIO 2023',
                'fecha_inicio'  => '2023-02-01',
                'fecha_termino' => '2023-07-31',
                'ciclo'         => '2022-2023',
                'year'          => 2023,
                'siglas'        => 'FEB-JUL 2023',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 6,
                'periodo'       => 'AGOSTO 2023-ENERO 2024',
                'fecha_inicio'  => '2023-08-01',
                'fecha_termino' => '2024-01-31',
                'ciclo'         => '2023-2024',
                'year'          => 2023,
                'siglas'        => 'AGO 2023-ENE 2024',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 7,
                'periodo'       => 'FEBRERO-JULIO 2024',
                'fecha_inicio'  => '2024-02-01',
                'fecha_termino' => '2024-07-31',
                'ciclo'         => '2023-2024',
                'year'          => 2024,
                'siglas'        => 'FEB-JUL 2024',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 8,
                'periodo'       => 'AGOSTO 2024-ENERO 2025',
                'fecha_inicio'  => '2024-08-01',
                'fecha_termino' => '2025-01-31',
                'ciclo'         => '2024-2025',
                'year'          => 2024,
                'siglas'        => 'AGO 2024-ENE 2025',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 9,
                'periodo'       => 'FEBRERO-JULIO 2025',
                'fecha_inicio'  => '2025-02-01',
                'fecha_termino' => '2025-07-31',
                'ciclo'         => '2024-2025',
                'year'          => 2025,
                'siglas'        => 'FEB-JUL 2025',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 10,
                'periodo'       => 'AGOSTO 2025-ENERO 2026',
                'fecha_inicio'  => '2025-08-01',
                'fecha_termino' => '2026-01-31',
                'ciclo'         => '2025-2026',
                'year'          => 2025,
                'siglas'        => 'AGO 2025-ENE 2026',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 11,
                'periodo'       => 'FEBRERO-JULIO 2026',
                'fecha_inicio'  => '2026-02-01',
                'fecha_termino' => '2026-07-31',
                'ciclo'         => '2025-2026',
                'year'          => 2026,
                'siglas'        => 'FEB-JUL 2026',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 12,
                'periodo'       => 'AGOSTO 2026-ENERO 2027',
                'fecha_inicio'  => '2026-08-01',
                'fecha_termino' => '2027-01-31',
                'ciclo'         => '2026-2027',
                'year'          => 2026,
                'siglas'        => 'AGO 2026-ENE 2027',
                'estado'        => 1,
            ],
            [
                'id_periodo'    => 13,
                'periodo'       => 'FEBRERO-JULIO 2027',
                'fecha_inicio'  => '2027-02-01',
                'fecha_termino' => '2027-07-31',
                'ciclo'         => '2026-2027',
                'year'          => 2027,
                'siglas'        => 'FEB-JUL 2027',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 14,
                'periodo'       => 'AGOSTO 2027-ENERO 2028',
                'fecha_inicio'  => '2027-08-01',
                'fecha_termino' => '2028-01-31',
                'ciclo'         => '2027-2028',
                'year'          => 2027,
                'siglas'        => 'AGO 2027-ENE 2028',
                'estado'        => 0,
            ],
            [
                'id_periodo'    => 15,
                'periodo'       => 'FEBRERO-JULIO 2028',
                'fecha_inicio'  => '2028-02-01',
                'fecha_termino' => '2028-07-31',
                'ciclo'         => '2027-2028',
                'year'          => 2028,
                'siglas'        => 'FEB-JUL 2028',
                'estado'        => 0,
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
