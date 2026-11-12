<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_mes_pres_cambio`.
 */
class PresAutMesPresCambioSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_mes_pres_cambio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresAutPresupuestoAutCopiaSeeder::class,
            PresMesSeeder::class,
        ]);

        $tabla = 'pres_aut_mes_pres_cambio';

        $llaves = [
            ['id_mes_pres_cambio'],
        ];

        $registros = [
            [
                'id_mes_pres_cambio'       => 1,
                'id_presupuesto_aut_copia' => 1,
                'id_partida'               => 1,
                'id_mes'                   => 1,
                'cambio_presupuesto'       => 1500.0,
                'id_mes_cambio'            => 1,
                'fecha_registro'           => '2026-01-05',
                'fecha_modificar'          => '2026-01-05',
            ],
            [
                'id_mes_pres_cambio'       => 2,
                'id_presupuesto_aut_copia' => 2,
                'id_partida'               => 2,
                'id_mes'                   => 2,
                'cambio_presupuesto'       => 3000.0,
                'id_mes_cambio'            => 2,
                'fecha_registro'           => '2026-01-14',
                'fecha_modificar'          => '2026-01-14',
            ],
            [
                'id_mes_pres_cambio'       => 3,
                'id_presupuesto_aut_copia' => 3,
                'id_partida'               => 3,
                'id_mes'                   => 3,
                'cambio_presupuesto'       => 4500.0,
                'id_mes_cambio'            => 3,
                'fecha_registro'           => '2026-01-23',
                'fecha_modificar'          => '2026-01-23',
            ],
            [
                'id_mes_pres_cambio'       => 4,
                'id_presupuesto_aut_copia' => 4,
                'id_partida'               => 4,
                'id_mes'                   => 4,
                'cambio_presupuesto'       => 6000.0,
                'id_mes_cambio'            => 4,
                'fecha_registro'           => '2026-02-01',
                'fecha_modificar'          => '2026-02-01',
            ],
            [
                'id_mes_pres_cambio'       => 5,
                'id_presupuesto_aut_copia' => 5,
                'id_partida'               => 5,
                'id_mes'                   => 5,
                'cambio_presupuesto'       => 7500.0,
                'id_mes_cambio'            => 5,
                'fecha_registro'           => '2026-02-10',
                'fecha_modificar'          => '2026-02-10',
            ],
            [
                'id_mes_pres_cambio'       => 6,
                'id_presupuesto_aut_copia' => 6,
                'id_partida'               => 6,
                'id_mes'                   => 6,
                'cambio_presupuesto'       => 9000.0,
                'id_mes_cambio'            => 6,
                'fecha_registro'           => '2026-02-19',
                'fecha_modificar'          => '2026-02-19',
            ],
            [
                'id_mes_pres_cambio'       => 7,
                'id_presupuesto_aut_copia' => 7,
                'id_partida'               => 7,
                'id_mes'                   => 7,
                'cambio_presupuesto'       => 10500.0,
                'id_mes_cambio'            => 7,
                'fecha_registro'           => '2026-02-28',
                'fecha_modificar'          => '2026-02-28',
            ],
            [
                'id_mes_pres_cambio'       => 8,
                'id_presupuesto_aut_copia' => 8,
                'id_partida'               => 8,
                'id_mes'                   => 8,
                'cambio_presupuesto'       => 12000.0,
                'id_mes_cambio'            => 8,
                'fecha_registro'           => '2026-03-09',
                'fecha_modificar'          => '2026-03-09',
            ],
            [
                'id_mes_pres_cambio'       => 9,
                'id_presupuesto_aut_copia' => 9,
                'id_partida'               => 9,
                'id_mes'                   => 9,
                'cambio_presupuesto'       => 13500.0,
                'id_mes_cambio'            => 9,
                'fecha_registro'           => '2026-03-18',
                'fecha_modificar'          => '2026-03-18',
            ],
            [
                'id_mes_pres_cambio'       => 10,
                'id_presupuesto_aut_copia' => 10,
                'id_partida'               => 10,
                'id_mes'                   => 10,
                'cambio_presupuesto'       => 15000.0,
                'id_mes_cambio'            => 10,
                'fecha_registro'           => '2026-03-27',
                'fecha_modificar'          => '2026-03-27',
            ],
            [
                'id_mes_pres_cambio'       => 11,
                'id_presupuesto_aut_copia' => 11,
                'id_partida'               => 11,
                'id_mes'                   => 11,
                'cambio_presupuesto'       => 16500.0,
                'id_mes_cambio'            => 11,
                'fecha_registro'           => '2026-04-05',
                'fecha_modificar'          => '2026-04-05',
            ],
            [
                'id_mes_pres_cambio'       => 12,
                'id_presupuesto_aut_copia' => 12,
                'id_partida'               => 12,
                'id_mes'                   => 12,
                'cambio_presupuesto'       => 18000.0,
                'id_mes_cambio'            => 12,
                'fecha_registro'           => '2026-04-14',
                'fecha_modificar'          => '2026-04-14',
            ],
            [
                'id_mes_pres_cambio'       => 13,
                'id_presupuesto_aut_copia' => 13,
                'id_partida'               => 13,
                'id_mes'                   => 13,
                'cambio_presupuesto'       => 19500.0,
                'id_mes_cambio'            => 13,
                'fecha_registro'           => '2026-04-23',
                'fecha_modificar'          => '2026-04-23',
            ],
            [
                'id_mes_pres_cambio'       => 14,
                'id_presupuesto_aut_copia' => 14,
                'id_partida'               => 14,
                'id_mes'                   => 14,
                'cambio_presupuesto'       => 21000.0,
                'id_mes_cambio'            => 14,
                'fecha_registro'           => '2026-05-02',
                'fecha_modificar'          => '2026-05-02',
            ],
            [
                'id_mes_pres_cambio'       => 15,
                'id_presupuesto_aut_copia' => 15,
                'id_partida'               => 15,
                'id_mes'                   => 15,
                'cambio_presupuesto'       => 22500.0,
                'id_mes_cambio'            => 15,
                'fecha_registro'           => '2026-05-11',
                'fecha_modificar'          => '2026-05-11',
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
