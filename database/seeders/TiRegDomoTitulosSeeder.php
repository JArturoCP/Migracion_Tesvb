<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_reg_domo_titulos`.
 */
class TiRegDomoTitulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_reg_domo_titulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_reg_domo_titulos';

        $llaves = [
            ['id_reg_domo'],
        ];

        $registros = [
            [
                'id_reg_domo'      => 1,
                'abreviacion'      => 'ABR1',
                'numero_inicial'   => 1,
                'numero_final'     => 1,
                'fecha_reg'        => '2026-01-05',
                'id_registrado'    => 1,
                'id_estado_tomo'   => 1,
                'fecha_activacion' => '2026-01-05',
            ],
            [
                'id_reg_domo'      => 2,
                'abreviacion'      => 'ABR2',
                'numero_inicial'   => 2,
                'numero_final'     => 2,
                'fecha_reg'        => '2026-01-14',
                'id_registrado'    => 2,
                'id_estado_tomo'   => 2,
                'fecha_activacion' => '2026-01-14',
            ],
            [
                'id_reg_domo'      => 3,
                'abreviacion'      => 'ABR3',
                'numero_inicial'   => 3,
                'numero_final'     => 3,
                'fecha_reg'        => '2026-01-23',
                'id_registrado'    => 3,
                'id_estado_tomo'   => 3,
                'fecha_activacion' => '2026-01-23',
            ],
            [
                'id_reg_domo'      => 4,
                'abreviacion'      => 'ABR4',
                'numero_inicial'   => 4,
                'numero_final'     => 4,
                'fecha_reg'        => '2026-02-01',
                'id_registrado'    => 4,
                'id_estado_tomo'   => 4,
                'fecha_activacion' => '2026-02-01',
            ],
            [
                'id_reg_domo'      => 5,
                'abreviacion'      => 'ABR5',
                'numero_inicial'   => 5,
                'numero_final'     => 5,
                'fecha_reg'        => '2026-02-10',
                'id_registrado'    => 5,
                'id_estado_tomo'   => 5,
                'fecha_activacion' => '2026-02-10',
            ],
            [
                'id_reg_domo'      => 6,
                'abreviacion'      => 'ABR6',
                'numero_inicial'   => 6,
                'numero_final'     => 6,
                'fecha_reg'        => '2026-02-19',
                'id_registrado'    => 6,
                'id_estado_tomo'   => 6,
                'fecha_activacion' => '2026-02-19',
            ],
            [
                'id_reg_domo'      => 7,
                'abreviacion'      => 'ABR7',
                'numero_inicial'   => 7,
                'numero_final'     => 7,
                'fecha_reg'        => '2026-02-28',
                'id_registrado'    => 7,
                'id_estado_tomo'   => 7,
                'fecha_activacion' => '2026-02-28',
            ],
            [
                'id_reg_domo'      => 8,
                'abreviacion'      => 'ABR8',
                'numero_inicial'   => 8,
                'numero_final'     => 8,
                'fecha_reg'        => '2026-03-09',
                'id_registrado'    => 8,
                'id_estado_tomo'   => 8,
                'fecha_activacion' => '2026-03-09',
            ],
            [
                'id_reg_domo'      => 9,
                'abreviacion'      => 'ABR9',
                'numero_inicial'   => 9,
                'numero_final'     => 9,
                'fecha_reg'        => '2026-03-18',
                'id_registrado'    => 9,
                'id_estado_tomo'   => 9,
                'fecha_activacion' => '2026-03-18',
            ],
            [
                'id_reg_domo'      => 10,
                'abreviacion'      => 'ABR10',
                'numero_inicial'   => 10,
                'numero_final'     => 10,
                'fecha_reg'        => '2026-03-27',
                'id_registrado'    => 10,
                'id_estado_tomo'   => 10,
                'fecha_activacion' => '2026-03-27',
            ],
            [
                'id_reg_domo'      => 11,
                'abreviacion'      => 'ABR11',
                'numero_inicial'   => 11,
                'numero_final'     => 11,
                'fecha_reg'        => '2026-04-05',
                'id_registrado'    => 11,
                'id_estado_tomo'   => 11,
                'fecha_activacion' => '2026-04-05',
            ],
            [
                'id_reg_domo'      => 12,
                'abreviacion'      => 'ABR12',
                'numero_inicial'   => 12,
                'numero_final'     => 12,
                'fecha_reg'        => '2026-04-14',
                'id_registrado'    => 12,
                'id_estado_tomo'   => 12,
                'fecha_activacion' => '2026-04-14',
            ],
            [
                'id_reg_domo'      => 13,
                'abreviacion'      => 'ABR13',
                'numero_inicial'   => 13,
                'numero_final'     => 13,
                'fecha_reg'        => '2026-04-23',
                'id_registrado'    => 13,
                'id_estado_tomo'   => 13,
                'fecha_activacion' => '2026-04-23',
            ],
            [
                'id_reg_domo'      => 14,
                'abreviacion'      => 'ABR14',
                'numero_inicial'   => 14,
                'numero_final'     => 14,
                'fecha_reg'        => '2026-05-02',
                'id_registrado'    => 14,
                'id_estado_tomo'   => 14,
                'fecha_activacion' => '2026-05-02',
            ],
            [
                'id_reg_domo'      => 15,
                'abreviacion'      => 'ABR15',
                'numero_inicial'   => 15,
                'numero_final'     => 15,
                'fecha_reg'        => '2026-05-11',
                'id_registrado'    => 15,
                'id_estado_tomo'   => 15,
                'fecha_activacion' => '2026-05-11',
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
