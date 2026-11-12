<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_req_mat_ante`.
 */
class PresReqMatAnteSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_req_mat_ante` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_req_mat_ante';

        $llaves = [
            ['id_req_mat_ante'],
        ];

        $registros = [
            [
                'id_req_mat_ante'       => 1,
                'id_unidad_admin'       => 1,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 1,
                'numero_requisicion'    => 1,
                'fecha_registro'        => '2026-01-05',
                'fecha_envio'           => '2026-01-05',
            ],
            [
                'id_req_mat_ante'       => 2,
                'id_unidad_admin'       => 2,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 2,
                'numero_requisicion'    => 2,
                'fecha_registro'        => '2026-01-14',
                'fecha_envio'           => '2026-01-14',
            ],
            [
                'id_req_mat_ante'       => 3,
                'id_unidad_admin'       => 3,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 3,
                'numero_requisicion'    => 3,
                'fecha_registro'        => '2026-01-23',
                'fecha_envio'           => '2026-01-23',
            ],
            [
                'id_req_mat_ante'       => 4,
                'id_unidad_admin'       => 4,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 4,
                'numero_requisicion'    => 4,
                'fecha_registro'        => '2026-02-01',
                'fecha_envio'           => '2026-02-01',
            ],
            [
                'id_req_mat_ante'       => 5,
                'id_unidad_admin'       => 5,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 5,
                'numero_requisicion'    => 5,
                'fecha_registro'        => '2026-02-10',
                'fecha_envio'           => '2026-02-10',
            ],
            [
                'id_req_mat_ante'       => 6,
                'id_unidad_admin'       => 6,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 6,
                'numero_requisicion'    => 6,
                'fecha_registro'        => '2026-02-19',
                'fecha_envio'           => '2026-02-19',
            ],
            [
                'id_req_mat_ante'       => 7,
                'id_unidad_admin'       => 7,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 7,
                'numero_requisicion'    => 7,
                'fecha_registro'        => '2026-02-28',
                'fecha_envio'           => '2026-02-28',
            ],
            [
                'id_req_mat_ante'       => 8,
                'id_unidad_admin'       => 8,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 8,
                'numero_requisicion'    => 8,
                'fecha_registro'        => '2026-03-09',
                'fecha_envio'           => '2026-03-09',
            ],
            [
                'id_req_mat_ante'       => 9,
                'id_unidad_admin'       => 9,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 9,
                'numero_requisicion'    => 9,
                'fecha_registro'        => '2026-03-18',
                'fecha_envio'           => '2026-03-18',
            ],
            [
                'id_req_mat_ante'       => 10,
                'id_unidad_admin'       => 10,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 10,
                'numero_requisicion'    => 10,
                'fecha_registro'        => '2026-03-27',
                'fecha_envio'           => '2026-03-27',
            ],
            [
                'id_req_mat_ante'       => 11,
                'id_unidad_admin'       => 11,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 11,
                'numero_requisicion'    => 11,
                'fecha_registro'        => '2026-04-05',
                'fecha_envio'           => '2026-04-05',
            ],
            [
                'id_req_mat_ante'       => 12,
                'id_unidad_admin'       => 12,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 12,
                'numero_requisicion'    => 12,
                'fecha_registro'        => '2026-04-14',
                'fecha_envio'           => '2026-04-14',
            ],
            [
                'id_req_mat_ante'       => 13,
                'id_unidad_admin'       => 13,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 13,
                'numero_requisicion'    => 13,
                'fecha_registro'        => '2026-04-23',
                'fecha_envio'           => '2026-04-23',
            ],
            [
                'id_req_mat_ante'       => 14,
                'id_unidad_admin'       => 14,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 14,
                'numero_requisicion'    => 14,
                'fecha_registro'        => '2026-05-02',
                'fecha_envio'           => '2026-05-02',
            ],
            [
                'id_req_mat_ante'       => 15,
                'id_unidad_admin'       => 15,
                'year_requisicion'      => 2026,
                'id_estado_requisicion' => 15,
                'numero_requisicion'    => 15,
                'fecha_registro'        => '2026-05-11',
                'fecha_envio'           => '2026-05-11',
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
