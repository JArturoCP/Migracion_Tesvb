<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_fuentes_financiamiento`.
 */
class PresFuentesFinanciamientoSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_fuentes_financiamiento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresCapitulosSeeder::class,
        ]);

        $tabla = 'pres_fuentes_financiamiento';

        $llaves = [
            ['id_fuente_financiamiento'],
        ];

        $registros = [
            [
                'id_fuente_financiamiento' => 1,
                'id_presupuesto_ante'      => 1,
                'id_capitulo'              => 1,
                'presupuesto_estatal'      => 1500.0,
                'presupuesto_federal'      => 1500.0,
                'presupuesto_propios'      => 1500.0,
                'total_presupuesto'        => 1500.0,
                'financiamiento_estatal'   => 7.3,
                'financiamiento_federal'   => 7.3,
                'financiamiento_propios'   => 7.3,
                'total_financiamiento'     => 1500.0,
                'fecha_registro'           => '2026-01-05',
                'fecha_modificacion'       => '2026-01-05',
            ],
            [
                'id_fuente_financiamiento' => 2,
                'id_presupuesto_ante'      => 2,
                'id_capitulo'              => 2,
                'presupuesto_estatal'      => 3000.0,
                'presupuesto_federal'      => 3000.0,
                'presupuesto_propios'      => 3000.0,
                'total_presupuesto'        => 3000.0,
                'financiamiento_estatal'   => 7.6,
                'financiamiento_federal'   => 7.6,
                'financiamiento_propios'   => 7.6,
                'total_financiamiento'     => 3000.0,
                'fecha_registro'           => '2026-01-14',
                'fecha_modificacion'       => '2026-01-14',
            ],
            [
                'id_fuente_financiamiento' => 3,
                'id_presupuesto_ante'      => 3,
                'id_capitulo'              => 3,
                'presupuesto_estatal'      => 4500.0,
                'presupuesto_federal'      => 4500.0,
                'presupuesto_propios'      => 4500.0,
                'total_presupuesto'        => 4500.0,
                'financiamiento_estatal'   => 7.9,
                'financiamiento_federal'   => 7.9,
                'financiamiento_propios'   => 7.9,
                'total_financiamiento'     => 4500.0,
                'fecha_registro'           => '2026-01-23',
                'fecha_modificacion'       => '2026-01-23',
            ],
            [
                'id_fuente_financiamiento' => 4,
                'id_presupuesto_ante'      => 4,
                'id_capitulo'              => 4,
                'presupuesto_estatal'      => 6000.0,
                'presupuesto_federal'      => 6000.0,
                'presupuesto_propios'      => 6000.0,
                'total_presupuesto'        => 6000.0,
                'financiamiento_estatal'   => 8.2,
                'financiamiento_federal'   => 8.2,
                'financiamiento_propios'   => 8.2,
                'total_financiamiento'     => 6000.0,
                'fecha_registro'           => '2026-02-01',
                'fecha_modificacion'       => '2026-02-01',
            ],
            [
                'id_fuente_financiamiento' => 5,
                'id_presupuesto_ante'      => 5,
                'id_capitulo'              => 5,
                'presupuesto_estatal'      => 7500.0,
                'presupuesto_federal'      => 7500.0,
                'presupuesto_propios'      => 7500.0,
                'total_presupuesto'        => 7500.0,
                'financiamiento_estatal'   => 8.5,
                'financiamiento_federal'   => 8.5,
                'financiamiento_propios'   => 8.5,
                'total_financiamiento'     => 7500.0,
                'fecha_registro'           => '2026-02-10',
                'fecha_modificacion'       => '2026-02-10',
            ],
            [
                'id_fuente_financiamiento' => 6,
                'id_presupuesto_ante'      => 6,
                'id_capitulo'              => 6,
                'presupuesto_estatal'      => 9000.0,
                'presupuesto_federal'      => 9000.0,
                'presupuesto_propios'      => 9000.0,
                'total_presupuesto'        => 9000.0,
                'financiamiento_estatal'   => 8.8,
                'financiamiento_federal'   => 8.8,
                'financiamiento_propios'   => 8.8,
                'total_financiamiento'     => 9000.0,
                'fecha_registro'           => '2026-02-19',
                'fecha_modificacion'       => '2026-02-19',
            ],
            [
                'id_fuente_financiamiento' => 7,
                'id_presupuesto_ante'      => 7,
                'id_capitulo'              => 7,
                'presupuesto_estatal'      => 10500.0,
                'presupuesto_federal'      => 10500.0,
                'presupuesto_propios'      => 10500.0,
                'total_presupuesto'        => 10500.0,
                'financiamiento_estatal'   => 9.1,
                'financiamiento_federal'   => 9.1,
                'financiamiento_propios'   => 9.1,
                'total_financiamiento'     => 10500.0,
                'fecha_registro'           => '2026-02-28',
                'fecha_modificacion'       => '2026-02-28',
            ],
            [
                'id_fuente_financiamiento' => 8,
                'id_presupuesto_ante'      => 8,
                'id_capitulo'              => 8,
                'presupuesto_estatal'      => 12000.0,
                'presupuesto_federal'      => 12000.0,
                'presupuesto_propios'      => 12000.0,
                'total_presupuesto'        => 12000.0,
                'financiamiento_estatal'   => 9.4,
                'financiamiento_federal'   => 9.4,
                'financiamiento_propios'   => 9.4,
                'total_financiamiento'     => 12000.0,
                'fecha_registro'           => '2026-03-09',
                'fecha_modificacion'       => '2026-03-09',
            ],
            [
                'id_fuente_financiamiento' => 9,
                'id_presupuesto_ante'      => 9,
                'id_capitulo'              => 9,
                'presupuesto_estatal'      => 13500.0,
                'presupuesto_federal'      => 13500.0,
                'presupuesto_propios'      => 13500.0,
                'total_presupuesto'        => 13500.0,
                'financiamiento_estatal'   => 9.7,
                'financiamiento_federal'   => 9.7,
                'financiamiento_propios'   => 9.7,
                'total_financiamiento'     => 13500.0,
                'fecha_registro'           => '2026-03-18',
                'fecha_modificacion'       => '2026-03-18',
            ],
            [
                'id_fuente_financiamiento' => 10,
                'id_presupuesto_ante'      => 10,
                'id_capitulo'              => 10,
                'presupuesto_estatal'      => 15000.0,
                'presupuesto_federal'      => 15000.0,
                'presupuesto_propios'      => 15000.0,
                'total_presupuesto'        => 15000.0,
                'financiamiento_estatal'   => 7.0,
                'financiamiento_federal'   => 7.0,
                'financiamiento_propios'   => 7.0,
                'total_financiamiento'     => 15000.0,
                'fecha_registro'           => '2026-03-27',
                'fecha_modificacion'       => '2026-03-27',
            ],
            [
                'id_fuente_financiamiento' => 11,
                'id_presupuesto_ante'      => 11,
                'id_capitulo'              => 11,
                'presupuesto_estatal'      => 16500.0,
                'presupuesto_federal'      => 16500.0,
                'presupuesto_propios'      => 16500.0,
                'total_presupuesto'        => 16500.0,
                'financiamiento_estatal'   => 7.3,
                'financiamiento_federal'   => 7.3,
                'financiamiento_propios'   => 7.3,
                'total_financiamiento'     => 16500.0,
                'fecha_registro'           => '2026-04-05',
                'fecha_modificacion'       => '2026-04-05',
            ],
            [
                'id_fuente_financiamiento' => 12,
                'id_presupuesto_ante'      => 12,
                'id_capitulo'              => 12,
                'presupuesto_estatal'      => 18000.0,
                'presupuesto_federal'      => 18000.0,
                'presupuesto_propios'      => 18000.0,
                'total_presupuesto'        => 18000.0,
                'financiamiento_estatal'   => 7.6,
                'financiamiento_federal'   => 7.6,
                'financiamiento_propios'   => 7.6,
                'total_financiamiento'     => 18000.0,
                'fecha_registro'           => '2026-04-14',
                'fecha_modificacion'       => '2026-04-14',
            ],
            [
                'id_fuente_financiamiento' => 13,
                'id_presupuesto_ante'      => 13,
                'id_capitulo'              => 13,
                'presupuesto_estatal'      => 19500.0,
                'presupuesto_federal'      => 19500.0,
                'presupuesto_propios'      => 19500.0,
                'total_presupuesto'        => 19500.0,
                'financiamiento_estatal'   => 7.9,
                'financiamiento_federal'   => 7.9,
                'financiamiento_propios'   => 7.9,
                'total_financiamiento'     => 19500.0,
                'fecha_registro'           => '2026-04-23',
                'fecha_modificacion'       => '2026-04-23',
            ],
            [
                'id_fuente_financiamiento' => 14,
                'id_presupuesto_ante'      => 14,
                'id_capitulo'              => 14,
                'presupuesto_estatal'      => 21000.0,
                'presupuesto_federal'      => 21000.0,
                'presupuesto_propios'      => 21000.0,
                'total_presupuesto'        => 21000.0,
                'financiamiento_estatal'   => 8.2,
                'financiamiento_federal'   => 8.2,
                'financiamiento_propios'   => 8.2,
                'total_financiamiento'     => 21000.0,
                'fecha_registro'           => '2026-05-02',
                'fecha_modificacion'       => '2026-05-02',
            ],
            [
                'id_fuente_financiamiento' => 15,
                'id_presupuesto_ante'      => 15,
                'id_capitulo'              => 15,
                'presupuesto_estatal'      => 22500.0,
                'presupuesto_federal'      => 22500.0,
                'presupuesto_propios'      => 22500.0,
                'total_presupuesto'        => 22500.0,
                'financiamiento_estatal'   => 8.5,
                'financiamiento_federal'   => 8.5,
                'financiamiento_propios'   => 8.5,
                'total_financiamiento'     => 22500.0,
                'fecha_registro'           => '2026-05-11',
                'fecha_modificacion'       => '2026-05-11',
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
