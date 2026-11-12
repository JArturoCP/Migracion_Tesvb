<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_periodos`.
 */
class InPeriodosSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_periodos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_periodos';

        $llaves = [
            ['id_periodo_ingles'],
        ];

        $registros = [
            [
                'id_periodo_ingles'     => 1,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2021',
                'fecha_inicio_ingles'   => '2021-02-01',
                'fecha_final_ingles'    => '2021-07-31',
                'fecha_inicial_periodo' => '2021-02-01',
                'fecha_final_periodo'   => '2021-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 2,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2021-ENERO 2022',
                'fecha_inicio_ingles'   => '2021-08-01',
                'fecha_final_ingles'    => '2022-01-31',
                'fecha_inicial_periodo' => '2021-08-01',
                'fecha_final_periodo'   => '2022-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 3,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2022',
                'fecha_inicio_ingles'   => '2022-02-01',
                'fecha_final_ingles'    => '2022-07-31',
                'fecha_inicial_periodo' => '2022-02-01',
                'fecha_final_periodo'   => '2022-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 4,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2022-ENERO 2023',
                'fecha_inicio_ingles'   => '2022-08-01',
                'fecha_final_ingles'    => '2023-01-31',
                'fecha_inicial_periodo' => '2022-08-01',
                'fecha_final_periodo'   => '2023-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 5,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2023',
                'fecha_inicio_ingles'   => '2023-02-01',
                'fecha_final_ingles'    => '2023-07-31',
                'fecha_inicial_periodo' => '2023-02-01',
                'fecha_final_periodo'   => '2023-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 6,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2023-ENERO 2024',
                'fecha_inicio_ingles'   => '2023-08-01',
                'fecha_final_ingles'    => '2024-01-31',
                'fecha_inicial_periodo' => '2023-08-01',
                'fecha_final_periodo'   => '2024-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 7,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2024',
                'fecha_inicio_ingles'   => '2024-02-01',
                'fecha_final_ingles'    => '2024-07-31',
                'fecha_inicial_periodo' => '2024-02-01',
                'fecha_final_periodo'   => '2024-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 8,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2024-ENERO 2025',
                'fecha_inicio_ingles'   => '2024-08-01',
                'fecha_final_ingles'    => '2025-01-31',
                'fecha_inicial_periodo' => '2024-08-01',
                'fecha_final_periodo'   => '2025-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 9,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2025',
                'fecha_inicio_ingles'   => '2025-02-01',
                'fecha_final_ingles'    => '2025-07-31',
                'fecha_inicial_periodo' => '2025-02-01',
                'fecha_final_periodo'   => '2025-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 10,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2025-ENERO 2026',
                'fecha_inicio_ingles'   => '2025-08-01',
                'fecha_final_ingles'    => '2026-01-31',
                'fecha_inicial_periodo' => '2025-08-01',
                'fecha_final_periodo'   => '2026-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 11,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2026',
                'fecha_inicio_ingles'   => '2026-02-01',
                'fecha_final_ingles'    => '2026-07-31',
                'fecha_inicial_periodo' => '2026-02-01',
                'fecha_final_periodo'   => '2026-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 1,
            ],
            [
                'id_periodo_ingles'     => 12,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2026-ENERO 2027',
                'fecha_inicio_ingles'   => '2026-08-01',
                'fecha_final_ingles'    => '2027-01-31',
                'fecha_inicial_periodo' => '2026-08-01',
                'fecha_final_periodo'   => '2027-01-31',
                'estado_actual'         => 1,
                'estado_historial'      => 0,
            ],
            [
                'id_periodo_ingles'     => 13,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2027',
                'fecha_inicio_ingles'   => '2027-02-01',
                'fecha_final_ingles'    => '2027-07-31',
                'fecha_inicial_periodo' => '2027-02-01',
                'fecha_final_periodo'   => '2027-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 0,
            ],
            [
                'id_periodo_ingles'     => 14,
                'periodo_ingles'        => 'INGLÉS AGOSTO 2027-ENERO 2028',
                'fecha_inicio_ingles'   => '2027-08-01',
                'fecha_final_ingles'    => '2028-01-31',
                'fecha_inicial_periodo' => '2027-08-01',
                'fecha_final_periodo'   => '2028-01-31',
                'estado_actual'         => 0,
                'estado_historial'      => 0,
            ],
            [
                'id_periodo_ingles'     => 15,
                'periodo_ingles'        => 'INGLÉS FEBRERO-JULIO 2028',
                'fecha_inicio_ingles'   => '2028-02-01',
                'fecha_final_ingles'    => '2028-07-31',
                'fecha_inicial_periodo' => '2028-02-01',
                'fecha_final_periodo'   => '2028-07-31',
                'estado_actual'         => 0,
                'estado_historial'      => 0,
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
