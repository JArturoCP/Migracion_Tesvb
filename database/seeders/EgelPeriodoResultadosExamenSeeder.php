<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_periodo_resultados_examen`.
 */
class EgelPeriodoResultadosExamenSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_periodo_resultados_examen` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelPeriodoExamenSeeder::class,
        ]);

        $tabla = 'egel_periodo_resultados_examen';

        $llaves = [
            ['id_periodo_resultado_examen'],
        ];

        $registros = [
            [
                'id_periodo_resultado_examen' => 1,
                'periodo'                     => 'FEBRERO-JULIO 2021',
                'fecha_inicio'                => '2026-01-05 09:00:00',
                'fecha_fin'                   => '2026-01-05 09:00:00',
                'estado'                      => 1,
                'id_periodo_examen'           => 1,
            ],
            [
                'id_periodo_resultado_examen' => 2,
                'periodo'                     => 'AGOSTO 2021-ENERO 2022',
                'fecha_inicio'                => '2026-01-14 10:00:00',
                'fecha_fin'                   => '2026-01-14 10:00:00',
                'estado'                      => 2,
                'id_periodo_examen'           => 2,
            ],
            [
                'id_periodo_resultado_examen' => 3,
                'periodo'                     => 'FEBRERO-JULIO 2022',
                'fecha_inicio'                => '2026-01-23 11:00:00',
                'fecha_fin'                   => '2026-01-23 11:00:00',
                'estado'                      => 3,
                'id_periodo_examen'           => 3,
            ],
            [
                'id_periodo_resultado_examen' => 4,
                'periodo'                     => 'AGOSTO 2022-ENERO 2023',
                'fecha_inicio'                => '2026-02-01 12:00:00',
                'fecha_fin'                   => '2026-02-01 12:00:00',
                'estado'                      => 4,
                'id_periodo_examen'           => 4,
            ],
            [
                'id_periodo_resultado_examen' => 5,
                'periodo'                     => 'FEBRERO-JULIO 2023',
                'fecha_inicio'                => '2026-02-10 13:00:00',
                'fecha_fin'                   => '2026-02-10 13:00:00',
                'estado'                      => 5,
                'id_periodo_examen'           => 5,
            ],
            [
                'id_periodo_resultado_examen' => 6,
                'periodo'                     => 'AGOSTO 2023-ENERO 2024',
                'fecha_inicio'                => '2026-02-19 14:00:00',
                'fecha_fin'                   => '2026-02-19 14:00:00',
                'estado'                      => 6,
                'id_periodo_examen'           => 6,
            ],
            [
                'id_periodo_resultado_examen' => 7,
                'periodo'                     => 'FEBRERO-JULIO 2024',
                'fecha_inicio'                => '2026-02-28 15:00:00',
                'fecha_fin'                   => '2026-02-28 15:00:00',
                'estado'                      => 7,
                'id_periodo_examen'           => 7,
            ],
            [
                'id_periodo_resultado_examen' => 8,
                'periodo'                     => 'AGOSTO 2024-ENERO 2025',
                'fecha_inicio'                => '2026-03-09 16:00:00',
                'fecha_fin'                   => '2026-03-09 16:00:00',
                'estado'                      => 8,
                'id_periodo_examen'           => 8,
            ],
            [
                'id_periodo_resultado_examen' => 9,
                'periodo'                     => 'FEBRERO-JULIO 2025',
                'fecha_inicio'                => '2026-03-18 08:00:00',
                'fecha_fin'                   => '2026-03-18 08:00:00',
                'estado'                      => 9,
                'id_periodo_examen'           => 9,
            ],
            [
                'id_periodo_resultado_examen' => 10,
                'periodo'                     => 'AGOSTO 2025-ENERO 2026',
                'fecha_inicio'                => '2026-03-27 09:00:00',
                'fecha_fin'                   => '2026-03-27 09:00:00',
                'estado'                      => 10,
                'id_periodo_examen'           => 10,
            ],
            [
                'id_periodo_resultado_examen' => 11,
                'periodo'                     => 'FEBRERO-JULIO 2026',
                'fecha_inicio'                => '2026-04-05 10:00:00',
                'fecha_fin'                   => '2026-04-05 10:00:00',
                'estado'                      => 11,
                'id_periodo_examen'           => 11,
            ],
            [
                'id_periodo_resultado_examen' => 12,
                'periodo'                     => 'AGOSTO 2026-ENERO 2027',
                'fecha_inicio'                => '2026-04-14 11:00:00',
                'fecha_fin'                   => '2026-04-14 11:00:00',
                'estado'                      => 12,
                'id_periodo_examen'           => 12,
            ],
            [
                'id_periodo_resultado_examen' => 13,
                'periodo'                     => 'FEBRERO-JULIO 2027',
                'fecha_inicio'                => '2026-04-23 12:00:00',
                'fecha_fin'                   => '2026-04-23 12:00:00',
                'estado'                      => 13,
                'id_periodo_examen'           => 13,
            ],
            [
                'id_periodo_resultado_examen' => 14,
                'periodo'                     => 'AGOSTO 2027-ENERO 2028',
                'fecha_inicio'                => '2026-05-02 13:00:00',
                'fecha_fin'                   => '2026-05-02 13:00:00',
                'estado'                      => 14,
                'id_periodo_examen'           => 14,
            ],
            [
                'id_periodo_resultado_examen' => 15,
                'periodo'                     => 'FEBRERO-JULIO 2028',
                'fecha_inicio'                => '2026-05-11 14:00:00',
                'fecha_fin'                   => '2026-05-11 14:00:00',
                'estado'                      => 15,
                'id_periodo_examen'           => 15,
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
