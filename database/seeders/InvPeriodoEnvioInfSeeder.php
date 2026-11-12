<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_periodo_envio_inf`.
 */
class InvPeriodoEnvioInfSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_periodo_envio_inf` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_periodo_envio_inf';

        $llaves = [
            ['id_periodo_envio_inf'],
        ];

        $registros = [
            [
                'id_periodo_envio_inf' => 1,
                'fecha_inicio'         => '2026-01-05',
                'fecha_fin'            => '2026-01-05',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 1.',
            ],
            [
                'id_periodo_envio_inf' => 2,
                'fecha_inicio'         => '2026-01-14',
                'fecha_fin'            => '2026-01-14',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 2.',
            ],
            [
                'id_periodo_envio_inf' => 3,
                'fecha_inicio'         => '2026-01-23',
                'fecha_fin'            => '2026-01-23',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 3.',
            ],
            [
                'id_periodo_envio_inf' => 4,
                'fecha_inicio'         => '2026-02-01',
                'fecha_fin'            => '2026-02-01',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 4.',
            ],
            [
                'id_periodo_envio_inf' => 5,
                'fecha_inicio'         => '2026-02-10',
                'fecha_fin'            => '2026-02-10',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 5.',
            ],
            [
                'id_periodo_envio_inf' => 6,
                'fecha_inicio'         => '2026-02-19',
                'fecha_fin'            => '2026-02-19',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 6.',
            ],
            [
                'id_periodo_envio_inf' => 7,
                'fecha_inicio'         => '2026-02-28',
                'fecha_fin'            => '2026-02-28',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 7.',
            ],
            [
                'id_periodo_envio_inf' => 8,
                'fecha_inicio'         => '2026-03-09',
                'fecha_fin'            => '2026-03-09',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 8.',
            ],
            [
                'id_periodo_envio_inf' => 9,
                'fecha_inicio'         => '2026-03-18',
                'fecha_fin'            => '2026-03-18',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 9.',
            ],
            [
                'id_periodo_envio_inf' => 10,
                'fecha_inicio'         => '2026-03-27',
                'fecha_fin'            => '2026-03-27',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 10.',
            ],
            [
                'id_periodo_envio_inf' => 11,
                'fecha_inicio'         => '2026-04-05',
                'fecha_fin'            => '2026-04-05',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 11.',
            ],
            [
                'id_periodo_envio_inf' => 12,
                'fecha_inicio'         => '2026-04-14',
                'fecha_fin'            => '2026-04-14',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 12.',
            ],
            [
                'id_periodo_envio_inf' => 13,
                'fecha_inicio'         => '2026-04-23',
                'fecha_fin'            => '2026-04-23',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 13.',
            ],
            [
                'id_periodo_envio_inf' => 14,
                'fecha_inicio'         => '2026-05-02',
                'fecha_fin'            => '2026-05-02',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 14.',
            ],
            [
                'id_periodo_envio_inf' => 15,
                'fecha_inicio'         => '2026-05-11',
                'fecha_fin'            => '2026-05-11',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'deleted_at'           => null,
                'observacion'          => 'Observacion de periodo envio inf: registro de prueba número 15.',
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
