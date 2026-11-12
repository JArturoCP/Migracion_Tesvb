<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_cal_periodo`.
 */
class InCalPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_cal_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            GnralGruposSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'in_cal_periodo';

        $llaves = [
            ['id_cal_periodo'],
        ];

        $registros = [
            [
                'id_cal_periodo' => 1,
                'fecha'          => '2026-01-05',
                'id_unidad'      => 1,
                'id_periodo'     => 12,
                'id_nivel'       => 1,
                'id_grupo'       => 1,
                'evaluada'       => 1,
            ],
            [
                'id_cal_periodo' => 2,
                'fecha'          => '2026-01-14',
                'id_unidad'      => 2,
                'id_periodo'     => 12,
                'id_nivel'       => 2,
                'id_grupo'       => 2,
                'evaluada'       => 2,
            ],
            [
                'id_cal_periodo' => 3,
                'fecha'          => '2026-01-23',
                'id_unidad'      => 3,
                'id_periodo'     => 3,
                'id_nivel'       => 3,
                'id_grupo'       => 3,
                'evaluada'       => 3,
            ],
            [
                'id_cal_periodo' => 4,
                'fecha'          => '2026-02-01',
                'id_unidad'      => 4,
                'id_periodo'     => 12,
                'id_nivel'       => 4,
                'id_grupo'       => 4,
                'evaluada'       => 4,
            ],
            [
                'id_cal_periodo' => 5,
                'fecha'          => '2026-02-10',
                'id_unidad'      => 5,
                'id_periodo'     => 12,
                'id_nivel'       => 5,
                'id_grupo'       => 5,
                'evaluada'       => 5,
            ],
            [
                'id_cal_periodo' => 6,
                'fecha'          => '2026-02-19',
                'id_unidad'      => 6,
                'id_periodo'     => 6,
                'id_nivel'       => 6,
                'id_grupo'       => 6,
                'evaluada'       => 6,
            ],
            [
                'id_cal_periodo' => 7,
                'fecha'          => '2026-02-28',
                'id_unidad'      => 7,
                'id_periodo'     => 12,
                'id_nivel'       => 7,
                'id_grupo'       => 7,
                'evaluada'       => 7,
            ],
            [
                'id_cal_periodo' => 8,
                'fecha'          => '2026-03-09',
                'id_unidad'      => 8,
                'id_periodo'     => 12,
                'id_nivel'       => 8,
                'id_grupo'       => 8,
                'evaluada'       => 8,
            ],
            [
                'id_cal_periodo' => 9,
                'fecha'          => '2026-03-18',
                'id_unidad'      => 1,
                'id_periodo'     => 9,
                'id_nivel'       => 9,
                'id_grupo'       => 9,
                'evaluada'       => 9,
            ],
            [
                'id_cal_periodo' => 10,
                'fecha'          => '2026-03-27',
                'id_unidad'      => 2,
                'id_periodo'     => 12,
                'id_nivel'       => 10,
                'id_grupo'       => 10,
                'evaluada'       => 10,
            ],
            [
                'id_cal_periodo' => 11,
                'fecha'          => '2026-04-05',
                'id_unidad'      => 3,
                'id_periodo'     => 12,
                'id_nivel'       => 11,
                'id_grupo'       => 11,
                'evaluada'       => 11,
            ],
            [
                'id_cal_periodo' => 12,
                'fecha'          => '2026-04-14',
                'id_unidad'      => 4,
                'id_periodo'     => 12,
                'id_nivel'       => 12,
                'id_grupo'       => 12,
                'evaluada'       => 12,
            ],
            [
                'id_cal_periodo' => 13,
                'fecha'          => '2026-04-23',
                'id_unidad'      => 5,
                'id_periodo'     => 12,
                'id_nivel'       => 13,
                'id_grupo'       => 13,
                'evaluada'       => 13,
            ],
            [
                'id_cal_periodo' => 14,
                'fecha'          => '2026-05-02',
                'id_unidad'      => 6,
                'id_periodo'     => 12,
                'id_nivel'       => 14,
                'id_grupo'       => 14,
                'evaluada'       => 14,
            ],
            [
                'id_cal_periodo' => 15,
                'fecha'          => '2026-05-11',
                'id_unidad'      => 7,
                'id_periodo'     => 15,
                'id_nivel'       => 15,
                'id_grupo'       => 15,
                'evaluada'       => 15,
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
