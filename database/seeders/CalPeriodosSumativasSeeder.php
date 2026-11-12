<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_periodos_sumativas`.
 */
class CalPeriodosSumativasSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_periodos_sumativas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'cal_periodos_sumativas';

        $llaves = [
            ['id_periodo_sum'],
        ];

        $registros = [
            [
                'id_periodo_sum' => 1,
                'fecha_inicio'   => '2026-01-05',
                'fecha_fin'      => '2026-01-05',
                'id_periodo'     => 12,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
            ],
            [
                'id_periodo_sum' => 2,
                'fecha_inicio'   => '2026-01-14',
                'fecha_fin'      => '2026-01-14',
                'id_periodo'     => 12,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
            ],
            [
                'id_periodo_sum' => 3,
                'fecha_inicio'   => '2026-01-23',
                'fecha_fin'      => '2026-01-23',
                'id_periodo'     => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
            ],
            [
                'id_periodo_sum' => 4,
                'fecha_inicio'   => '2026-02-01',
                'fecha_fin'      => '2026-02-01',
                'id_periodo'     => 12,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
            ],
            [
                'id_periodo_sum' => 5,
                'fecha_inicio'   => '2026-02-10',
                'fecha_fin'      => '2026-02-10',
                'id_periodo'     => 12,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
            ],
            [
                'id_periodo_sum' => 6,
                'fecha_inicio'   => '2026-02-19',
                'fecha_fin'      => '2026-02-19',
                'id_periodo'     => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
            ],
            [
                'id_periodo_sum' => 7,
                'fecha_inicio'   => '2026-02-28',
                'fecha_fin'      => '2026-02-28',
                'id_periodo'     => 12,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
            ],
            [
                'id_periodo_sum' => 8,
                'fecha_inicio'   => '2026-03-09',
                'fecha_fin'      => '2026-03-09',
                'id_periodo'     => 12,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
            ],
            [
                'id_periodo_sum' => 9,
                'fecha_inicio'   => '2026-03-18',
                'fecha_fin'      => '2026-03-18',
                'id_periodo'     => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
            ],
            [
                'id_periodo_sum' => 10,
                'fecha_inicio'   => '2026-03-27',
                'fecha_fin'      => '2026-03-27',
                'id_periodo'     => 12,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
            ],
            [
                'id_periodo_sum' => 11,
                'fecha_inicio'   => '2026-04-05',
                'fecha_fin'      => '2026-04-05',
                'id_periodo'     => 12,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
            ],
            [
                'id_periodo_sum' => 12,
                'fecha_inicio'   => '2026-04-14',
                'fecha_fin'      => '2026-04-14',
                'id_periodo'     => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
            ],
            [
                'id_periodo_sum' => 13,
                'fecha_inicio'   => '2026-04-23',
                'fecha_fin'      => '2026-04-23',
                'id_periodo'     => 12,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
            ],
            [
                'id_periodo_sum' => 14,
                'fecha_inicio'   => '2026-05-02',
                'fecha_fin'      => '2026-05-02',
                'id_periodo'     => 12,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
            ],
            [
                'id_periodo_sum' => 15,
                'fecha_inicio'   => '2026-05-11',
                'fecha_fin'      => '2026-05-11',
                'id_periodo'     => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
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
