<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_periodo_terminado`.
 */
class EncPeriodoTerminadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_periodo_terminado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'enc_periodo_terminado';

        $llaves = [
            ['id_periodo_periodo'],
        ];

        $registros = [
            [
                'id_periodo_periodo' => 1,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-01-05',
                'id_estado'          => 1,
            ],
            [
                'id_periodo_periodo' => 2,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-01-14',
                'id_estado'          => 2,
            ],
            [
                'id_periodo_periodo' => 3,
                'id_periodo'         => 3,
                'fecha_registro'     => '2026-01-23',
                'id_estado'          => 3,
            ],
            [
                'id_periodo_periodo' => 4,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-02-01',
                'id_estado'          => 4,
            ],
            [
                'id_periodo_periodo' => 5,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-02-10',
                'id_estado'          => 5,
            ],
            [
                'id_periodo_periodo' => 6,
                'id_periodo'         => 6,
                'fecha_registro'     => '2026-02-19',
                'id_estado'          => 6,
            ],
            [
                'id_periodo_periodo' => 7,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-02-28',
                'id_estado'          => 7,
            ],
            [
                'id_periodo_periodo' => 8,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-03-09',
                'id_estado'          => 8,
            ],
            [
                'id_periodo_periodo' => 9,
                'id_periodo'         => 9,
                'fecha_registro'     => '2026-03-18',
                'id_estado'          => 9,
            ],
            [
                'id_periodo_periodo' => 10,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-03-27',
                'id_estado'          => 10,
            ],
            [
                'id_periodo_periodo' => 11,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-04-05',
                'id_estado'          => 11,
            ],
            [
                'id_periodo_periodo' => 12,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-04-14',
                'id_estado'          => 12,
            ],
            [
                'id_periodo_periodo' => 13,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-04-23',
                'id_estado'          => 13,
            ],
            [
                'id_periodo_periodo' => 14,
                'id_periodo'         => 12,
                'fecha_registro'     => '2026-05-02',
                'id_estado'          => 14,
            ],
            [
                'id_periodo_periodo' => 15,
                'id_periodo'         => 15,
                'fecha_registro'     => '2026-05-11',
                'id_estado'          => 15,
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
