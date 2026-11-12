<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_proceso_unidad`.
 */
class RiProcesoUnidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_proceso_unidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiProcesoSeeder::class,
        ]);

        $tabla = 'ri_proceso_unidad';

        $llaves = [
            ['id_proceso_unidad'],
        ];

        $registros = [
            [
                'id_proceso_unidad' => 1,
                'id_proceso'        => 1,
                'id_unidad_admin'   => 1,
                'updated_at'        => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_proceso_unidad' => 2,
                'id_proceso'        => 2,
                'id_unidad_admin'   => 2,
                'updated_at'        => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_proceso_unidad' => 3,
                'id_proceso'        => 3,
                'id_unidad_admin'   => 3,
                'updated_at'        => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_proceso_unidad' => 4,
                'id_proceso'        => 4,
                'id_unidad_admin'   => 4,
                'updated_at'        => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_proceso_unidad' => 5,
                'id_proceso'        => 5,
                'id_unidad_admin'   => 5,
                'updated_at'        => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_proceso_unidad' => 6,
                'id_proceso'        => 6,
                'id_unidad_admin'   => 6,
                'updated_at'        => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_proceso_unidad' => 7,
                'id_proceso'        => 7,
                'id_unidad_admin'   => 7,
                'updated_at'        => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_proceso_unidad' => 8,
                'id_proceso'        => 8,
                'id_unidad_admin'   => 8,
                'updated_at'        => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_proceso_unidad' => 9,
                'id_proceso'        => 9,
                'id_unidad_admin'   => 9,
                'updated_at'        => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_proceso_unidad' => 10,
                'id_proceso'        => 10,
                'id_unidad_admin'   => 10,
                'updated_at'        => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_proceso_unidad' => 11,
                'id_proceso'        => 11,
                'id_unidad_admin'   => 11,
                'updated_at'        => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_proceso_unidad' => 12,
                'id_proceso'        => 12,
                'id_unidad_admin'   => 12,
                'updated_at'        => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_proceso_unidad' => 13,
                'id_proceso'        => 13,
                'id_unidad_admin'   => 13,
                'updated_at'        => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_proceso_unidad' => 14,
                'id_proceso'        => 14,
                'id_unidad_admin'   => 14,
                'updated_at'        => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_proceso_unidad' => 15,
                'id_proceso'        => 15,
                'id_unidad_admin'   => 15,
                'updated_at'        => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
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
