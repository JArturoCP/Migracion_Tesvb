<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_informes`.
 */
class InvInformesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_informes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvTipoInformesSeeder::class,
        ]);

        $tabla = 'inv_informes';

        $llaves = [
            ['id_informe'],
        ];

        $registros = [
            [
                'id_informe'           => 1,
                'id_protocolo'         => 1,
                'id_tipo_informe'      => 1,
                'periodo_inicio'       => '2026-01-05',
                'periodo_fin'          => '2026-01-05',
                'fecha_elaboracion'    => '2026-01-05 09:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 1.',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 1,
            ],
            [
                'id_informe'           => 2,
                'id_protocolo'         => 2,
                'id_tipo_informe'      => 2,
                'periodo_inicio'       => '2026-01-14',
                'periodo_fin'          => '2026-01-14',
                'fecha_elaboracion'    => '2026-01-14 10:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 2.',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 2,
            ],
            [
                'id_informe'           => 3,
                'id_protocolo'         => 3,
                'id_tipo_informe'      => 3,
                'periodo_inicio'       => '2026-01-23',
                'periodo_fin'          => '2026-01-23',
                'fecha_elaboracion'    => '2026-01-23 11:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 3.',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 3,
            ],
            [
                'id_informe'           => 4,
                'id_protocolo'         => 4,
                'id_tipo_informe'      => 4,
                'periodo_inicio'       => '2026-02-01',
                'periodo_fin'          => '2026-02-01',
                'fecha_elaboracion'    => '2026-02-01 12:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 4.',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 4,
            ],
            [
                'id_informe'           => 5,
                'id_protocolo'         => 5,
                'id_tipo_informe'      => 5,
                'periodo_inicio'       => '2026-02-10',
                'periodo_fin'          => '2026-02-10',
                'fecha_elaboracion'    => '2026-02-10 13:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 5.',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 5,
            ],
            [
                'id_informe'           => 6,
                'id_protocolo'         => 6,
                'id_tipo_informe'      => 6,
                'periodo_inicio'       => '2026-02-19',
                'periodo_fin'          => '2026-02-19',
                'fecha_elaboracion'    => '2026-02-19 14:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 6.',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 6,
            ],
            [
                'id_informe'           => 7,
                'id_protocolo'         => 7,
                'id_tipo_informe'      => 7,
                'periodo_inicio'       => '2026-02-28',
                'periodo_fin'          => '2026-02-28',
                'fecha_elaboracion'    => '2026-02-28 15:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 7.',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 7,
            ],
            [
                'id_informe'           => 8,
                'id_protocolo'         => 8,
                'id_tipo_informe'      => 8,
                'periodo_inicio'       => '2026-03-09',
                'periodo_fin'          => '2026-03-09',
                'fecha_elaboracion'    => '2026-03-09 16:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 8.',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 8,
            ],
            [
                'id_informe'           => 9,
                'id_protocolo'         => 9,
                'id_tipo_informe'      => 9,
                'periodo_inicio'       => '2026-03-18',
                'periodo_fin'          => '2026-03-18',
                'fecha_elaboracion'    => '2026-03-18 08:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 9.',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 9,
            ],
            [
                'id_informe'           => 10,
                'id_protocolo'         => 10,
                'id_tipo_informe'      => 10,
                'periodo_inicio'       => '2026-03-27',
                'periodo_fin'          => '2026-03-27',
                'fecha_elaboracion'    => '2026-03-27 09:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 10.',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 10,
            ],
            [
                'id_informe'           => 11,
                'id_protocolo'         => 11,
                'id_tipo_informe'      => 11,
                'periodo_inicio'       => '2026-04-05',
                'periodo_fin'          => '2026-04-05',
                'fecha_elaboracion'    => '2026-04-05 10:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 11.',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 11,
            ],
            [
                'id_informe'           => 12,
                'id_protocolo'         => 12,
                'id_tipo_informe'      => 12,
                'periodo_inicio'       => '2026-04-14',
                'periodo_fin'          => '2026-04-14',
                'fecha_elaboracion'    => '2026-04-14 11:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 12.',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 12,
            ],
            [
                'id_informe'           => 13,
                'id_protocolo'         => 13,
                'id_tipo_informe'      => 13,
                'periodo_inicio'       => '2026-04-23',
                'periodo_fin'          => '2026-04-23',
                'fecha_elaboracion'    => '2026-04-23 12:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 13.',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 13,
            ],
            [
                'id_informe'           => 14,
                'id_protocolo'         => 14,
                'id_tipo_informe'      => 14,
                'periodo_inicio'       => '2026-05-02',
                'periodo_fin'          => '2026-05-02',
                'fecha_elaboracion'    => '2026-05-02 13:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 14.',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 14,
            ],
            [
                'id_informe'           => 15,
                'id_protocolo'         => 15,
                'id_tipo_informe'      => 15,
                'periodo_inicio'       => '2026-05-11',
                'periodo_fin'          => '2026-05-11',
                'fecha_elaboracion'    => '2026-05-11 14:00:00',
                'observaciones'        => 'Observaciones de informes: registro de prueba número 15.',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'deleted_at'           => null,
                'id_periodo_envio_inf' => 15,
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
