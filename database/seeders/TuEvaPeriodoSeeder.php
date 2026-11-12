<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_periodo`.
 */
class TuEvaPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'tu_eva_periodo';

        $llaves = [
            ['id_eva_periodo'],
        ];

        $registros = [
            [
                'id_eva_periodo'  => 1,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-01-05 09:00:00',
                'fecha_final_eva' => '2026-01-05 09:00:00',
            ],
            [
                'id_eva_periodo'  => 2,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-01-14 10:00:00',
                'fecha_final_eva' => '2026-01-14 10:00:00',
            ],
            [
                'id_eva_periodo'  => 3,
                'id_periodo'      => 3,
                'estado'          => 1,
                'fecha_registro'  => '2026-01-23 11:00:00',
                'fecha_final_eva' => '2026-01-23 11:00:00',
            ],
            [
                'id_eva_periodo'  => 4,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-02-01 12:00:00',
                'fecha_final_eva' => '2026-02-01 12:00:00',
            ],
            [
                'id_eva_periodo'  => 5,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-02-10 13:00:00',
                'fecha_final_eva' => '2026-02-10 13:00:00',
            ],
            [
                'id_eva_periodo'  => 6,
                'id_periodo'      => 6,
                'estado'          => 1,
                'fecha_registro'  => '2026-02-19 14:00:00',
                'fecha_final_eva' => '2026-02-19 14:00:00',
            ],
            [
                'id_eva_periodo'  => 7,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-02-28 15:00:00',
                'fecha_final_eva' => '2026-02-28 15:00:00',
            ],
            [
                'id_eva_periodo'  => 8,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-03-09 16:00:00',
                'fecha_final_eva' => '2026-03-09 16:00:00',
            ],
            [
                'id_eva_periodo'  => 9,
                'id_periodo'      => 9,
                'estado'          => 1,
                'fecha_registro'  => '2026-03-18 08:00:00',
                'fecha_final_eva' => '2026-03-18 08:00:00',
            ],
            [
                'id_eva_periodo'  => 10,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-03-27 09:00:00',
                'fecha_final_eva' => '2026-03-27 09:00:00',
            ],
            [
                'id_eva_periodo'  => 11,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-04-05 10:00:00',
                'fecha_final_eva' => '2026-04-05 10:00:00',
            ],
            [
                'id_eva_periodo'  => 12,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-04-14 11:00:00',
                'fecha_final_eva' => '2026-04-14 11:00:00',
            ],
            [
                'id_eva_periodo'  => 13,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-04-23 12:00:00',
                'fecha_final_eva' => '2026-04-23 12:00:00',
            ],
            [
                'id_eva_periodo'  => 14,
                'id_periodo'      => 12,
                'estado'          => 1,
                'fecha_registro'  => '2026-05-02 13:00:00',
                'fecha_final_eva' => '2026-05-02 13:00:00',
            ],
            [
                'id_eva_periodo'  => 15,
                'id_periodo'      => 15,
                'estado'          => 1,
                'fecha_registro'  => '2026-05-11 14:00:00',
                'fecha_final_eva' => '2026-05-11 14:00:00',
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
