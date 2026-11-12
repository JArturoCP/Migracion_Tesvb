<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_periodo_residencia`.
 */
class EncPeriodoResidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_periodo_residencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'enc_periodo_residencia';

        $llaves = [
            ['id_periodo_residencia'],
        ];

        $registros = [
            [
                'id_periodo_residencia' => 1,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-01-05',
                'fecha_termino'         => '2026-01-05',
                'id_estado'             => 1,
            ],
            [
                'id_periodo_residencia' => 2,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-01-14',
                'fecha_termino'         => '2026-01-14',
                'id_estado'             => 2,
            ],
            [
                'id_periodo_residencia' => 3,
                'id_periodo'            => 3,
                'fecha_registro'        => '2026-01-23',
                'fecha_termino'         => '2026-01-23',
                'id_estado'             => 3,
            ],
            [
                'id_periodo_residencia' => 4,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-02-01',
                'fecha_termino'         => '2026-02-01',
                'id_estado'             => 4,
            ],
            [
                'id_periodo_residencia' => 5,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-02-10',
                'fecha_termino'         => '2026-02-10',
                'id_estado'             => 5,
            ],
            [
                'id_periodo_residencia' => 6,
                'id_periodo'            => 6,
                'fecha_registro'        => '2026-02-19',
                'fecha_termino'         => '2026-02-19',
                'id_estado'             => 6,
            ],
            [
                'id_periodo_residencia' => 7,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-02-28',
                'fecha_termino'         => '2026-02-28',
                'id_estado'             => 7,
            ],
            [
                'id_periodo_residencia' => 8,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-03-09',
                'fecha_termino'         => '2026-03-09',
                'id_estado'             => 8,
            ],
            [
                'id_periodo_residencia' => 9,
                'id_periodo'            => 9,
                'fecha_registro'        => '2026-03-18',
                'fecha_termino'         => '2026-03-18',
                'id_estado'             => 9,
            ],
            [
                'id_periodo_residencia' => 10,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-03-27',
                'fecha_termino'         => '2026-03-27',
                'id_estado'             => 10,
            ],
            [
                'id_periodo_residencia' => 11,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-04-05',
                'fecha_termino'         => '2026-04-05',
                'id_estado'             => 11,
            ],
            [
                'id_periodo_residencia' => 12,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-04-14',
                'fecha_termino'         => '2026-04-14',
                'id_estado'             => 12,
            ],
            [
                'id_periodo_residencia' => 13,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-04-23',
                'fecha_termino'         => '2026-04-23',
                'id_estado'             => 13,
            ],
            [
                'id_periodo_residencia' => 14,
                'id_periodo'            => 12,
                'fecha_registro'        => '2026-05-02',
                'fecha_termino'         => '2026-05-02',
                'id_estado'             => 14,
            ],
            [
                'id_periodo_residencia' => 15,
                'id_periodo'            => 15,
                'fecha_registro'        => '2026-05-11',
                'fecha_termino'         => '2026-05-11',
                'id_estado'             => 15,
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
