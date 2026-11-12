<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_situaciones`.
 */
class HrsSituacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_situaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_situaciones';

        $llaves = [
            ['id_situacion'],
        ];

        $registros = [
            [
                'id_situacion' => 1,
                'situacion'    => 'Situacion situaciones 1',
                'abrevia'      => 'ABR1',
                'created_at'   => '2026-01-05 09:00:00',
                'updated_at'   => '2026-01-05 09:00:00',
            ],
            [
                'id_situacion' => 2,
                'situacion'    => 'Situacion situaciones 2',
                'abrevia'      => 'ABR2',
                'created_at'   => '2026-01-14 10:00:00',
                'updated_at'   => '2026-01-14 10:00:00',
            ],
            [
                'id_situacion' => 3,
                'situacion'    => 'Situacion situaciones 3',
                'abrevia'      => 'ABR3',
                'created_at'   => '2026-01-23 11:00:00',
                'updated_at'   => '2026-01-23 11:00:00',
            ],
            [
                'id_situacion' => 4,
                'situacion'    => 'Situacion situaciones 4',
                'abrevia'      => 'ABR4',
                'created_at'   => '2026-02-01 12:00:00',
                'updated_at'   => '2026-02-01 12:00:00',
            ],
            [
                'id_situacion' => 5,
                'situacion'    => 'Situacion situaciones 5',
                'abrevia'      => 'ABR5',
                'created_at'   => '2026-02-10 13:00:00',
                'updated_at'   => '2026-02-10 13:00:00',
            ],
            [
                'id_situacion' => 6,
                'situacion'    => 'Situacion situaciones 6',
                'abrevia'      => 'ABR6',
                'created_at'   => '2026-02-19 14:00:00',
                'updated_at'   => '2026-02-19 14:00:00',
            ],
            [
                'id_situacion' => 7,
                'situacion'    => 'Situacion situaciones 7',
                'abrevia'      => 'ABR7',
                'created_at'   => '2026-02-28 15:00:00',
                'updated_at'   => '2026-02-28 15:00:00',
            ],
            [
                'id_situacion' => 8,
                'situacion'    => 'Situacion situaciones 8',
                'abrevia'      => 'ABR8',
                'created_at'   => '2026-03-09 16:00:00',
                'updated_at'   => '2026-03-09 16:00:00',
            ],
            [
                'id_situacion' => 9,
                'situacion'    => 'Situacion situaciones 9',
                'abrevia'      => 'ABR9',
                'created_at'   => '2026-03-18 08:00:00',
                'updated_at'   => '2026-03-18 08:00:00',
            ],
            [
                'id_situacion' => 10,
                'situacion'    => 'Situacion situaciones 10',
                'abrevia'      => 'ABR10',
                'created_at'   => '2026-03-27 09:00:00',
                'updated_at'   => '2026-03-27 09:00:00',
            ],
            [
                'id_situacion' => 11,
                'situacion'    => 'Situacion situaciones 11',
                'abrevia'      => 'ABR11',
                'created_at'   => '2026-04-05 10:00:00',
                'updated_at'   => '2026-04-05 10:00:00',
            ],
            [
                'id_situacion' => 12,
                'situacion'    => 'Situacion situaciones 12',
                'abrevia'      => 'ABR12',
                'created_at'   => '2026-04-14 11:00:00',
                'updated_at'   => '2026-04-14 11:00:00',
            ],
            [
                'id_situacion' => 13,
                'situacion'    => 'Situacion situaciones 13',
                'abrevia'      => 'ABR13',
                'created_at'   => '2026-04-23 12:00:00',
                'updated_at'   => '2026-04-23 12:00:00',
            ],
            [
                'id_situacion' => 14,
                'situacion'    => 'Situacion situaciones 14',
                'abrevia'      => 'ABR14',
                'created_at'   => '2026-05-02 13:00:00',
                'updated_at'   => '2026-05-02 13:00:00',
            ],
            [
                'id_situacion' => 15,
                'situacion'    => 'Situacion situaciones 15',
                'abrevia'      => 'ABR15',
                'created_at'   => '2026-05-11 14:00:00',
                'updated_at'   => '2026-05-11 14:00:00',
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
