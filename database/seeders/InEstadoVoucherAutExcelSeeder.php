<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_estado_voucher_aut_excel`.
 */
class InEstadoVoucherAutExcelSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_estado_voucher_aut_excel` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InPeriodosSeeder::class,
        ]);

        $tabla = 'in_estado_voucher_aut_excel';

        $llaves = [
            ['id_estado_voucher_aut_excel'],
        ];

        $registros = [
            [
                'id_estado_voucher_aut_excel' => 1,
                'estado'                      => 1,
                'id_periodo_ingles'           => 1,
                'fecha_registro'              => '2026-01-05',
            ],
            [
                'id_estado_voucher_aut_excel' => 2,
                'estado'                      => 2,
                'id_periodo_ingles'           => 2,
                'fecha_registro'              => '2026-01-14',
            ],
            [
                'id_estado_voucher_aut_excel' => 3,
                'estado'                      => 3,
                'id_periodo_ingles'           => 3,
                'fecha_registro'              => '2026-01-23',
            ],
            [
                'id_estado_voucher_aut_excel' => 4,
                'estado'                      => 4,
                'id_periodo_ingles'           => 4,
                'fecha_registro'              => '2026-02-01',
            ],
            [
                'id_estado_voucher_aut_excel' => 5,
                'estado'                      => 5,
                'id_periodo_ingles'           => 5,
                'fecha_registro'              => '2026-02-10',
            ],
            [
                'id_estado_voucher_aut_excel' => 6,
                'estado'                      => 6,
                'id_periodo_ingles'           => 6,
                'fecha_registro'              => '2026-02-19',
            ],
            [
                'id_estado_voucher_aut_excel' => 7,
                'estado'                      => 7,
                'id_periodo_ingles'           => 7,
                'fecha_registro'              => '2026-02-28',
            ],
            [
                'id_estado_voucher_aut_excel' => 8,
                'estado'                      => 8,
                'id_periodo_ingles'           => 8,
                'fecha_registro'              => '2026-03-09',
            ],
            [
                'id_estado_voucher_aut_excel' => 9,
                'estado'                      => 9,
                'id_periodo_ingles'           => 9,
                'fecha_registro'              => '2026-03-18',
            ],
            [
                'id_estado_voucher_aut_excel' => 10,
                'estado'                      => 10,
                'id_periodo_ingles'           => 10,
                'fecha_registro'              => '2026-03-27',
            ],
            [
                'id_estado_voucher_aut_excel' => 11,
                'estado'                      => 11,
                'id_periodo_ingles'           => 11,
                'fecha_registro'              => '2026-04-05',
            ],
            [
                'id_estado_voucher_aut_excel' => 12,
                'estado'                      => 12,
                'id_periodo_ingles'           => 12,
                'fecha_registro'              => '2026-04-14',
            ],
            [
                'id_estado_voucher_aut_excel' => 13,
                'estado'                      => 13,
                'id_periodo_ingles'           => 13,
                'fecha_registro'              => '2026-04-23',
            ],
            [
                'id_estado_voucher_aut_excel' => 14,
                'estado'                      => 14,
                'id_periodo_ingles'           => 14,
                'fecha_registro'              => '2026-05-02',
            ],
            [
                'id_estado_voucher_aut_excel' => 15,
                'estado'                      => 15,
                'id_periodo_ingles'           => 15,
                'fecha_registro'              => '2026-05-11',
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
