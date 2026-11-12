<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_solicitudes_partidas`.
 */
class PresAutSolicitudesPartidasSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_solicitudes_partidas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresActividadesReqAnteSeeder::class,
            PresAutSolicitudesSeeder::class,
            PresPartidaPresSeeder::class,
        ]);

        $tabla = 'pres_aut_solicitudes_partidas';

        $llaves = [
            ['id_solicitud_partida'],
        ];

        $registros = [
            [
                'id_solicitud_partida'    => 1,
                'id_solicitud'            => 1,
                'id_partida_pres'         => 1,
                'numero_requisicion'      => 1,
                'id_autorizacion'         => 1,
                'fecha_registro'          => '2026-01-05',
                'fecha_modificacion'      => '2026-01-05',
                'presupuesto_dado'        => 1500.0,
                'importe_total'           => 1500.0,
                'id_tipo_requisicion'     => 1,
                'id_actividades_req_ante' => 1,
            ],
            [
                'id_solicitud_partida'    => 2,
                'id_solicitud'            => 2,
                'id_partida_pres'         => 2,
                'numero_requisicion'      => 2,
                'id_autorizacion'         => 2,
                'fecha_registro'          => '2026-01-14',
                'fecha_modificacion'      => '2026-01-14',
                'presupuesto_dado'        => 3000.0,
                'importe_total'           => 3000.0,
                'id_tipo_requisicion'     => 2,
                'id_actividades_req_ante' => 2,
            ],
            [
                'id_solicitud_partida'    => 3,
                'id_solicitud'            => 3,
                'id_partida_pres'         => 3,
                'numero_requisicion'      => 3,
                'id_autorizacion'         => 3,
                'fecha_registro'          => '2026-01-23',
                'fecha_modificacion'      => '2026-01-23',
                'presupuesto_dado'        => 4500.0,
                'importe_total'           => 4500.0,
                'id_tipo_requisicion'     => 3,
                'id_actividades_req_ante' => 3,
            ],
            [
                'id_solicitud_partida'    => 4,
                'id_solicitud'            => 4,
                'id_partida_pres'         => 4,
                'numero_requisicion'      => 4,
                'id_autorizacion'         => 4,
                'fecha_registro'          => '2026-02-01',
                'fecha_modificacion'      => '2026-02-01',
                'presupuesto_dado'        => 6000.0,
                'importe_total'           => 6000.0,
                'id_tipo_requisicion'     => 4,
                'id_actividades_req_ante' => 4,
            ],
            [
                'id_solicitud_partida'    => 5,
                'id_solicitud'            => 5,
                'id_partida_pres'         => 5,
                'numero_requisicion'      => 5,
                'id_autorizacion'         => 5,
                'fecha_registro'          => '2026-02-10',
                'fecha_modificacion'      => '2026-02-10',
                'presupuesto_dado'        => 7500.0,
                'importe_total'           => 7500.0,
                'id_tipo_requisicion'     => 5,
                'id_actividades_req_ante' => 5,
            ],
            [
                'id_solicitud_partida'    => 6,
                'id_solicitud'            => 6,
                'id_partida_pres'         => 6,
                'numero_requisicion'      => 6,
                'id_autorizacion'         => 6,
                'fecha_registro'          => '2026-02-19',
                'fecha_modificacion'      => '2026-02-19',
                'presupuesto_dado'        => 9000.0,
                'importe_total'           => 9000.0,
                'id_tipo_requisicion'     => 6,
                'id_actividades_req_ante' => 6,
            ],
            [
                'id_solicitud_partida'    => 7,
                'id_solicitud'            => 7,
                'id_partida_pres'         => 7,
                'numero_requisicion'      => 7,
                'id_autorizacion'         => 7,
                'fecha_registro'          => '2026-02-28',
                'fecha_modificacion'      => '2026-02-28',
                'presupuesto_dado'        => 10500.0,
                'importe_total'           => 10500.0,
                'id_tipo_requisicion'     => 7,
                'id_actividades_req_ante' => 7,
            ],
            [
                'id_solicitud_partida'    => 8,
                'id_solicitud'            => 8,
                'id_partida_pres'         => 8,
                'numero_requisicion'      => 8,
                'id_autorizacion'         => 8,
                'fecha_registro'          => '2026-03-09',
                'fecha_modificacion'      => '2026-03-09',
                'presupuesto_dado'        => 12000.0,
                'importe_total'           => 12000.0,
                'id_tipo_requisicion'     => 8,
                'id_actividades_req_ante' => 8,
            ],
            [
                'id_solicitud_partida'    => 9,
                'id_solicitud'            => 9,
                'id_partida_pres'         => 9,
                'numero_requisicion'      => 9,
                'id_autorizacion'         => 9,
                'fecha_registro'          => '2026-03-18',
                'fecha_modificacion'      => '2026-03-18',
                'presupuesto_dado'        => 13500.0,
                'importe_total'           => 13500.0,
                'id_tipo_requisicion'     => 9,
                'id_actividades_req_ante' => 9,
            ],
            [
                'id_solicitud_partida'    => 10,
                'id_solicitud'            => 10,
                'id_partida_pres'         => 10,
                'numero_requisicion'      => 10,
                'id_autorizacion'         => 10,
                'fecha_registro'          => '2026-03-27',
                'fecha_modificacion'      => '2026-03-27',
                'presupuesto_dado'        => 15000.0,
                'importe_total'           => 15000.0,
                'id_tipo_requisicion'     => 10,
                'id_actividades_req_ante' => 10,
            ],
            [
                'id_solicitud_partida'    => 11,
                'id_solicitud'            => 11,
                'id_partida_pres'         => 11,
                'numero_requisicion'      => 11,
                'id_autorizacion'         => 11,
                'fecha_registro'          => '2026-04-05',
                'fecha_modificacion'      => '2026-04-05',
                'presupuesto_dado'        => 16500.0,
                'importe_total'           => 16500.0,
                'id_tipo_requisicion'     => 11,
                'id_actividades_req_ante' => 11,
            ],
            [
                'id_solicitud_partida'    => 12,
                'id_solicitud'            => 12,
                'id_partida_pres'         => 12,
                'numero_requisicion'      => 12,
                'id_autorizacion'         => 12,
                'fecha_registro'          => '2026-04-14',
                'fecha_modificacion'      => '2026-04-14',
                'presupuesto_dado'        => 18000.0,
                'importe_total'           => 18000.0,
                'id_tipo_requisicion'     => 12,
                'id_actividades_req_ante' => 12,
            ],
            [
                'id_solicitud_partida'    => 13,
                'id_solicitud'            => 13,
                'id_partida_pres'         => 13,
                'numero_requisicion'      => 13,
                'id_autorizacion'         => 13,
                'fecha_registro'          => '2026-04-23',
                'fecha_modificacion'      => '2026-04-23',
                'presupuesto_dado'        => 19500.0,
                'importe_total'           => 19500.0,
                'id_tipo_requisicion'     => 13,
                'id_actividades_req_ante' => 13,
            ],
            [
                'id_solicitud_partida'    => 14,
                'id_solicitud'            => 14,
                'id_partida_pres'         => 14,
                'numero_requisicion'      => 14,
                'id_autorizacion'         => 14,
                'fecha_registro'          => '2026-05-02',
                'fecha_modificacion'      => '2026-05-02',
                'presupuesto_dado'        => 21000.0,
                'importe_total'           => 21000.0,
                'id_tipo_requisicion'     => 14,
                'id_actividades_req_ante' => 14,
            ],
            [
                'id_solicitud_partida'    => 15,
                'id_solicitud'            => 15,
                'id_partida_pres'         => 15,
                'numero_requisicion'      => 15,
                'id_autorizacion'         => 15,
                'fecha_registro'          => '2026-05-11',
                'fecha_modificacion'      => '2026-05-11',
                'presupuesto_dado'        => 22500.0,
                'importe_total'           => 22500.0,
                'id_tipo_requisicion'     => 15,
                'id_actividades_req_ante' => 15,
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
