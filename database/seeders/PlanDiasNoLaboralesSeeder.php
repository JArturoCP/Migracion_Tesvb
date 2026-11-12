<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_dias_no_laborales`.
 */
class PlanDiasNoLaboralesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_dias_no_laborales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'plan_dias_no_laborales';

        $llaves = [
            ['id_fecha'],
        ];

        $registros = [
            [
                'id_fecha'   => 1,
                'fecha'      => '2026-01-05',
                'id_periodo' => 12,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id_fecha'   => 2,
                'fecha'      => '2026-01-14',
                'id_periodo' => 12,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id_fecha'   => 3,
                'fecha'      => '2026-01-23',
                'id_periodo' => 3,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id_fecha'   => 4,
                'fecha'      => '2026-02-01',
                'id_periodo' => 12,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id_fecha'   => 5,
                'fecha'      => '2026-02-10',
                'id_periodo' => 12,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id_fecha'   => 6,
                'fecha'      => '2026-02-19',
                'id_periodo' => 6,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id_fecha'   => 7,
                'fecha'      => '2026-02-28',
                'id_periodo' => 12,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id_fecha'   => 8,
                'fecha'      => '2026-03-09',
                'id_periodo' => 12,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id_fecha'   => 9,
                'fecha'      => '2026-03-18',
                'id_periodo' => 9,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id_fecha'   => 10,
                'fecha'      => '2026-03-27',
                'id_periodo' => 12,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id_fecha'   => 11,
                'fecha'      => '2026-04-05',
                'id_periodo' => 12,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id_fecha'   => 12,
                'fecha'      => '2026-04-14',
                'id_periodo' => 12,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id_fecha'   => 13,
                'fecha'      => '2026-04-23',
                'id_periodo' => 12,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id_fecha'   => 14,
                'fecha'      => '2026-05-02',
                'id_periodo' => 12,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id_fecha'   => 15,
                'fecha'      => '2026-05-11',
                'id_periodo' => 15,
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
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
