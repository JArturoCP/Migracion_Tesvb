<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_periodo_anteproyecto`.
 */
class PresPeriodoAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_periodo_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_periodo_anteproyecto';

        $llaves = [
            ['id_peri_anteproyecto'],
        ];

        $registros = [
            [
                'id_peri_anteproyecto' => 1,
                'fecha_inicio'         => '2026-01-05',
                'fecha_final'          => '2026-01-05',
                'year'                 => 2026,
                'id_activacion'        => 1,
                'fecha_registro'       => '2026-01-05',
                'fecha_activacion'     => '2026-01-05',
                'fecha_modificacion'   => '2026-01-05',
            ],
            [
                'id_peri_anteproyecto' => 2,
                'fecha_inicio'         => '2026-01-14',
                'fecha_final'          => '2026-01-14',
                'year'                 => 2026,
                'id_activacion'        => 2,
                'fecha_registro'       => '2026-01-14',
                'fecha_activacion'     => '2026-01-14',
                'fecha_modificacion'   => '2026-01-14',
            ],
            [
                'id_peri_anteproyecto' => 3,
                'fecha_inicio'         => '2026-01-23',
                'fecha_final'          => '2026-01-23',
                'year'                 => 2026,
                'id_activacion'        => 3,
                'fecha_registro'       => '2026-01-23',
                'fecha_activacion'     => '2026-01-23',
                'fecha_modificacion'   => '2026-01-23',
            ],
            [
                'id_peri_anteproyecto' => 4,
                'fecha_inicio'         => '2026-02-01',
                'fecha_final'          => '2026-02-01',
                'year'                 => 2026,
                'id_activacion'        => 4,
                'fecha_registro'       => '2026-02-01',
                'fecha_activacion'     => '2026-02-01',
                'fecha_modificacion'   => '2026-02-01',
            ],
            [
                'id_peri_anteproyecto' => 5,
                'fecha_inicio'         => '2026-02-10',
                'fecha_final'          => '2026-02-10',
                'year'                 => 2026,
                'id_activacion'        => 5,
                'fecha_registro'       => '2026-02-10',
                'fecha_activacion'     => '2026-02-10',
                'fecha_modificacion'   => '2026-02-10',
            ],
            [
                'id_peri_anteproyecto' => 6,
                'fecha_inicio'         => '2026-02-19',
                'fecha_final'          => '2026-02-19',
                'year'                 => 2026,
                'id_activacion'        => 6,
                'fecha_registro'       => '2026-02-19',
                'fecha_activacion'     => '2026-02-19',
                'fecha_modificacion'   => '2026-02-19',
            ],
            [
                'id_peri_anteproyecto' => 7,
                'fecha_inicio'         => '2026-02-28',
                'fecha_final'          => '2026-02-28',
                'year'                 => 2026,
                'id_activacion'        => 7,
                'fecha_registro'       => '2026-02-28',
                'fecha_activacion'     => '2026-02-28',
                'fecha_modificacion'   => '2026-02-28',
            ],
            [
                'id_peri_anteproyecto' => 8,
                'fecha_inicio'         => '2026-03-09',
                'fecha_final'          => '2026-03-09',
                'year'                 => 2026,
                'id_activacion'        => 8,
                'fecha_registro'       => '2026-03-09',
                'fecha_activacion'     => '2026-03-09',
                'fecha_modificacion'   => '2026-03-09',
            ],
            [
                'id_peri_anteproyecto' => 9,
                'fecha_inicio'         => '2026-03-18',
                'fecha_final'          => '2026-03-18',
                'year'                 => 2026,
                'id_activacion'        => 9,
                'fecha_registro'       => '2026-03-18',
                'fecha_activacion'     => '2026-03-18',
                'fecha_modificacion'   => '2026-03-18',
            ],
            [
                'id_peri_anteproyecto' => 10,
                'fecha_inicio'         => '2026-03-27',
                'fecha_final'          => '2026-03-27',
                'year'                 => 2026,
                'id_activacion'        => 10,
                'fecha_registro'       => '2026-03-27',
                'fecha_activacion'     => '2026-03-27',
                'fecha_modificacion'   => '2026-03-27',
            ],
            [
                'id_peri_anteproyecto' => 11,
                'fecha_inicio'         => '2026-04-05',
                'fecha_final'          => '2026-04-05',
                'year'                 => 2026,
                'id_activacion'        => 11,
                'fecha_registro'       => '2026-04-05',
                'fecha_activacion'     => '2026-04-05',
                'fecha_modificacion'   => '2026-04-05',
            ],
            [
                'id_peri_anteproyecto' => 12,
                'fecha_inicio'         => '2026-04-14',
                'fecha_final'          => '2026-04-14',
                'year'                 => 2026,
                'id_activacion'        => 12,
                'fecha_registro'       => '2026-04-14',
                'fecha_activacion'     => '2026-04-14',
                'fecha_modificacion'   => '2026-04-14',
            ],
            [
                'id_peri_anteproyecto' => 13,
                'fecha_inicio'         => '2026-04-23',
                'fecha_final'          => '2026-04-23',
                'year'                 => 2026,
                'id_activacion'        => 13,
                'fecha_registro'       => '2026-04-23',
                'fecha_activacion'     => '2026-04-23',
                'fecha_modificacion'   => '2026-04-23',
            ],
            [
                'id_peri_anteproyecto' => 14,
                'fecha_inicio'         => '2026-05-02',
                'fecha_final'          => '2026-05-02',
                'year'                 => 2026,
                'id_activacion'        => 14,
                'fecha_registro'       => '2026-05-02',
                'fecha_activacion'     => '2026-05-02',
                'fecha_modificacion'   => '2026-05-02',
            ],
            [
                'id_peri_anteproyecto' => 15,
                'fecha_inicio'         => '2026-05-11',
                'fecha_final'          => '2026-05-11',
                'year'                 => 2026,
                'id_activacion'        => 15,
                'fecha_registro'       => '2026-05-11',
                'fecha_activacion'     => '2026-05-11',
                'fecha_modificacion'   => '2026-05-11',
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
