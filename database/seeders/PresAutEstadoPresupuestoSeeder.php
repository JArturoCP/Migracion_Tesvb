<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_estado_presupuesto`.
 */
class PresAutEstadoPresupuestoSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_estado_presupuesto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_aut_estado_presupuesto';

        $llaves = [
            ['id_estado_presupuesto'],
        ];

        $registros = [
            [
                'id_estado_presupuesto' => 1,
                'year_estado'           => 2026,
                'status'                => 1,
                'fecha_registro'        => '2026-01-05',
            ],
            [
                'id_estado_presupuesto' => 2,
                'year_estado'           => 2026,
                'status'                => 2,
                'fecha_registro'        => '2026-01-14',
            ],
            [
                'id_estado_presupuesto' => 3,
                'year_estado'           => 2026,
                'status'                => 3,
                'fecha_registro'        => '2026-01-23',
            ],
            [
                'id_estado_presupuesto' => 4,
                'year_estado'           => 2026,
                'status'                => 4,
                'fecha_registro'        => '2026-02-01',
            ],
            [
                'id_estado_presupuesto' => 5,
                'year_estado'           => 2026,
                'status'                => 5,
                'fecha_registro'        => '2026-02-10',
            ],
            [
                'id_estado_presupuesto' => 6,
                'year_estado'           => 2026,
                'status'                => 6,
                'fecha_registro'        => '2026-02-19',
            ],
            [
                'id_estado_presupuesto' => 7,
                'year_estado'           => 2026,
                'status'                => 7,
                'fecha_registro'        => '2026-02-28',
            ],
            [
                'id_estado_presupuesto' => 8,
                'year_estado'           => 2026,
                'status'                => 8,
                'fecha_registro'        => '2026-03-09',
            ],
            [
                'id_estado_presupuesto' => 9,
                'year_estado'           => 2026,
                'status'                => 9,
                'fecha_registro'        => '2026-03-18',
            ],
            [
                'id_estado_presupuesto' => 10,
                'year_estado'           => 2026,
                'status'                => 10,
                'fecha_registro'        => '2026-03-27',
            ],
            [
                'id_estado_presupuesto' => 11,
                'year_estado'           => 2026,
                'status'                => 11,
                'fecha_registro'        => '2026-04-05',
            ],
            [
                'id_estado_presupuesto' => 12,
                'year_estado'           => 2026,
                'status'                => 12,
                'fecha_registro'        => '2026-04-14',
            ],
            [
                'id_estado_presupuesto' => 13,
                'year_estado'           => 2026,
                'status'                => 13,
                'fecha_registro'        => '2026-04-23',
            ],
            [
                'id_estado_presupuesto' => 14,
                'year_estado'           => 2026,
                'status'                => 14,
                'fecha_registro'        => '2026-05-02',
            ],
            [
                'id_estado_presupuesto' => 15,
                'year_estado'           => 2026,
                'status'                => 15,
                'fecha_registro'        => '2026-05-11',
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
