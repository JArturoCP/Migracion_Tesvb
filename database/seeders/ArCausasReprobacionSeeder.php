<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_causas_reprobacion`.
 */
class ArCausasReprobacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_causas_reprobacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ar_causas_reprobacion';

        $llaves = [
            ['id_ar_causa'],
            ['nombre'],
        ];

        $registros = [
            [
                'id_ar_causa' => 1,
                'nombre'      => 'Nombre causas reprobacion 1',
                'activo'      => 1,
                'orden'       => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_causa' => 2,
                'nombre'      => 'Nombre causas reprobacion 2',
                'activo'      => 1,
                'orden'       => 2,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_causa' => 3,
                'nombre'      => 'Nombre causas reprobacion 3',
                'activo'      => 1,
                'orden'       => 3,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_causa' => 4,
                'nombre'      => 'Nombre causas reprobacion 4',
                'activo'      => 1,
                'orden'       => 4,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_causa' => 5,
                'nombre'      => 'Nombre causas reprobacion 5',
                'activo'      => 1,
                'orden'       => 5,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_causa' => 6,
                'nombre'      => 'Nombre causas reprobacion 6',
                'activo'      => 1,
                'orden'       => 6,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_causa' => 7,
                'nombre'      => 'Nombre causas reprobacion 7',
                'activo'      => 1,
                'orden'       => 7,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_causa' => 8,
                'nombre'      => 'Nombre causas reprobacion 8',
                'activo'      => 1,
                'orden'       => 8,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_causa' => 9,
                'nombre'      => 'Nombre causas reprobacion 9',
                'activo'      => 1,
                'orden'       => 9,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_causa' => 10,
                'nombre'      => 'Nombre causas reprobacion 10',
                'activo'      => 1,
                'orden'       => 10,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_causa' => 11,
                'nombre'      => 'Nombre causas reprobacion 11',
                'activo'      => 1,
                'orden'       => 11,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_causa' => 12,
                'nombre'      => 'Nombre causas reprobacion 12',
                'activo'      => 1,
                'orden'       => 12,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_causa' => 13,
                'nombre'      => 'Nombre causas reprobacion 13',
                'activo'      => 1,
                'orden'       => 13,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_causa' => 14,
                'nombre'      => 'Nombre causas reprobacion 14',
                'activo'      => 1,
                'orden'       => 14,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_causa' => 15,
                'nombre'      => 'Nombre causas reprobacion 15',
                'activo'      => 1,
                'orden'       => 15,
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
