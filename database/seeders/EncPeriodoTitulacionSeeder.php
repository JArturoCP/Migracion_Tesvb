<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_periodo_titulacion`.
 */
class EncPeriodoTitulacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_periodo_titulacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'enc_periodo_titulacion';

        $llaves = [
            ['id_periodo_titulacion'],
        ];

        $registros = [
            [
                'id_periodo_titulacion' => 1,
                'year'                  => 2026,
                'mes'                   => 1,
                'id_estado'             => 1,
                'fecha_registro'        => '2026-01-05',
                'fecha_liberacion'      => '2026-01-05',
            ],
            [
                'id_periodo_titulacion' => 2,
                'year'                  => 2026,
                'mes'                   => 2,
                'id_estado'             => 2,
                'fecha_registro'        => '2026-01-14',
                'fecha_liberacion'      => '2026-01-14',
            ],
            [
                'id_periodo_titulacion' => 3,
                'year'                  => 2026,
                'mes'                   => 3,
                'id_estado'             => 3,
                'fecha_registro'        => '2026-01-23',
                'fecha_liberacion'      => '2026-01-23',
            ],
            [
                'id_periodo_titulacion' => 4,
                'year'                  => 2026,
                'mes'                   => 4,
                'id_estado'             => 4,
                'fecha_registro'        => '2026-02-01',
                'fecha_liberacion'      => '2026-02-01',
            ],
            [
                'id_periodo_titulacion' => 5,
                'year'                  => 2026,
                'mes'                   => 5,
                'id_estado'             => 5,
                'fecha_registro'        => '2026-02-10',
                'fecha_liberacion'      => '2026-02-10',
            ],
            [
                'id_periodo_titulacion' => 6,
                'year'                  => 2026,
                'mes'                   => 6,
                'id_estado'             => 6,
                'fecha_registro'        => '2026-02-19',
                'fecha_liberacion'      => '2026-02-19',
            ],
            [
                'id_periodo_titulacion' => 7,
                'year'                  => 2026,
                'mes'                   => 7,
                'id_estado'             => 7,
                'fecha_registro'        => '2026-02-28',
                'fecha_liberacion'      => '2026-02-28',
            ],
            [
                'id_periodo_titulacion' => 8,
                'year'                  => 2026,
                'mes'                   => 8,
                'id_estado'             => 8,
                'fecha_registro'        => '2026-03-09',
                'fecha_liberacion'      => '2026-03-09',
            ],
            [
                'id_periodo_titulacion' => 9,
                'year'                  => 2026,
                'mes'                   => 9,
                'id_estado'             => 9,
                'fecha_registro'        => '2026-03-18',
                'fecha_liberacion'      => '2026-03-18',
            ],
            [
                'id_periodo_titulacion' => 10,
                'year'                  => 2026,
                'mes'                   => 10,
                'id_estado'             => 10,
                'fecha_registro'        => '2026-03-27',
                'fecha_liberacion'      => '2026-03-27',
            ],
            [
                'id_periodo_titulacion' => 11,
                'year'                  => 2026,
                'mes'                   => 11,
                'id_estado'             => 11,
                'fecha_registro'        => '2026-04-05',
                'fecha_liberacion'      => '2026-04-05',
            ],
            [
                'id_periodo_titulacion' => 12,
                'year'                  => 2026,
                'mes'                   => 12,
                'id_estado'             => 12,
                'fecha_registro'        => '2026-04-14',
                'fecha_liberacion'      => '2026-04-14',
            ],
            [
                'id_periodo_titulacion' => 13,
                'year'                  => 2026,
                'mes'                   => 1,
                'id_estado'             => 13,
                'fecha_registro'        => '2026-04-23',
                'fecha_liberacion'      => '2026-04-23',
            ],
            [
                'id_periodo_titulacion' => 14,
                'year'                  => 2026,
                'mes'                   => 2,
                'id_estado'             => 14,
                'fecha_registro'        => '2026-05-02',
                'fecha_liberacion'      => '2026-05-02',
            ],
            [
                'id_periodo_titulacion' => 15,
                'year'                  => 2026,
                'mes'                   => 3,
                'id_estado'             => 15,
                'fecha_registro'        => '2026-05-11',
                'fecha_liberacion'      => '2026-05-11',
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
