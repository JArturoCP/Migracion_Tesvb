<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_periodo`.
 */
class BecaPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'beca_periodo';

        $llaves = [
            ['id_beca_periodo'],
        ];

        $registros = [
            [
                'id_beca_periodo' => 1,
                'fecha_inicial'   => '2026-01-05',
                'fecha_final'     => '2026-01-05',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 2,
                'fecha_inicial'   => '2026-01-14',
                'fecha_final'     => '2026-01-14',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 3,
                'fecha_inicial'   => '2026-01-23',
                'fecha_final'     => '2026-01-23',
                'id_periodo'      => 3,
            ],
            [
                'id_beca_periodo' => 4,
                'fecha_inicial'   => '2026-02-01',
                'fecha_final'     => '2026-02-01',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 5,
                'fecha_inicial'   => '2026-02-10',
                'fecha_final'     => '2026-02-10',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 6,
                'fecha_inicial'   => '2026-02-19',
                'fecha_final'     => '2026-02-19',
                'id_periodo'      => 6,
            ],
            [
                'id_beca_periodo' => 7,
                'fecha_inicial'   => '2026-02-28',
                'fecha_final'     => '2026-02-28',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 8,
                'fecha_inicial'   => '2026-03-09',
                'fecha_final'     => '2026-03-09',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 9,
                'fecha_inicial'   => '2026-03-18',
                'fecha_final'     => '2026-03-18',
                'id_periodo'      => 9,
            ],
            [
                'id_beca_periodo' => 10,
                'fecha_inicial'   => '2026-03-27',
                'fecha_final'     => '2026-03-27',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 11,
                'fecha_inicial'   => '2026-04-05',
                'fecha_final'     => '2026-04-05',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 12,
                'fecha_inicial'   => '2026-04-14',
                'fecha_final'     => '2026-04-14',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 13,
                'fecha_inicial'   => '2026-04-23',
                'fecha_final'     => '2026-04-23',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 14,
                'fecha_inicial'   => '2026-05-02',
                'fecha_final'     => '2026-05-02',
                'id_periodo'      => 12,
            ],
            [
                'id_beca_periodo' => 15,
                'fecha_inicial'   => '2026-05-11',
                'fecha_final'     => '2026-05-11',
                'id_periodo'      => 15,
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
