<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_unidad_parte`.
 */
class RiUnidadParteSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_unidad_parte` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiPartesSeeder::class,
            RiProcesoSeeder::class,
        ]);

        $tabla = 'ri_unidad_parte';

        $llaves = [
            ['id_uni_p'],
        ];

        $registros = [
            [
                'id_uni_p'        => 1,
                'id_unidad_admin' => 1,
                'id_parte'        => 1,
                'id_proceso'      => 1,
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_uni_p'        => 2,
                'id_unidad_admin' => 2,
                'id_parte'        => 2,
                'id_proceso'      => 2,
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_uni_p'        => 3,
                'id_unidad_admin' => 3,
                'id_parte'        => 3,
                'id_proceso'      => 3,
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_uni_p'        => 4,
                'id_unidad_admin' => 4,
                'id_parte'        => 4,
                'id_proceso'      => 4,
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_uni_p'        => 5,
                'id_unidad_admin' => 5,
                'id_parte'        => 5,
                'id_proceso'      => 5,
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_uni_p'        => 6,
                'id_unidad_admin' => 6,
                'id_parte'        => 6,
                'id_proceso'      => 6,
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_uni_p'        => 7,
                'id_unidad_admin' => 7,
                'id_parte'        => 7,
                'id_proceso'      => 7,
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_uni_p'        => 8,
                'id_unidad_admin' => 8,
                'id_parte'        => 8,
                'id_proceso'      => 8,
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_uni_p'        => 9,
                'id_unidad_admin' => 9,
                'id_parte'        => 9,
                'id_proceso'      => 9,
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_uni_p'        => 10,
                'id_unidad_admin' => 10,
                'id_parte'        => 10,
                'id_proceso'      => 10,
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_uni_p'        => 11,
                'id_unidad_admin' => 11,
                'id_parte'        => 11,
                'id_proceso'      => 11,
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_uni_p'        => 12,
                'id_unidad_admin' => 12,
                'id_parte'        => 12,
                'id_proceso'      => 12,
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_uni_p'        => 13,
                'id_unidad_admin' => 13,
                'id_parte'        => 13,
                'id_proceso'      => 13,
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_uni_p'        => 14,
                'id_unidad_admin' => 14,
                'id_parte'        => 14,
                'id_proceso'      => 14,
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_uni_p'        => 15,
                'id_unidad_admin' => 15,
                'id_parte'        => 15,
                'id_proceso'      => 15,
                'updated_at'      => '2026-05-11 14:00:00',
                'created_at'      => '2026-05-11 14:00:00',
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
