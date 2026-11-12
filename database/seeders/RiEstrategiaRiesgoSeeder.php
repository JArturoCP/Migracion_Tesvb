<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_estrategia_riesgo`.
 */
class RiEstrategiaRiesgoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_estrategia_riesgo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiEstrategiaSeeder::class,
            RiRegistroRiesgoSeeder::class,
        ]);

        $tabla = 'ri_estrategia_riesgo';

        $llaves = [
            ['id_estrategia_r'],
        ];

        $registros = [
            [
                'id_estrategia_r' => 1,
                'id_estrategia'   => 1,
                'id_reg_riesgo'   => 1,
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_estrategia_r' => 2,
                'id_estrategia'   => 2,
                'id_reg_riesgo'   => 2,
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_estrategia_r' => 3,
                'id_estrategia'   => 3,
                'id_reg_riesgo'   => 3,
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_estrategia_r' => 4,
                'id_estrategia'   => 4,
                'id_reg_riesgo'   => 4,
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_estrategia_r' => 5,
                'id_estrategia'   => 5,
                'id_reg_riesgo'   => 5,
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_estrategia_r' => 6,
                'id_estrategia'   => 6,
                'id_reg_riesgo'   => 6,
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_estrategia_r' => 7,
                'id_estrategia'   => 7,
                'id_reg_riesgo'   => 7,
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_estrategia_r' => 8,
                'id_estrategia'   => 8,
                'id_reg_riesgo'   => 8,
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_estrategia_r' => 9,
                'id_estrategia'   => 9,
                'id_reg_riesgo'   => 9,
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_estrategia_r' => 10,
                'id_estrategia'   => 10,
                'id_reg_riesgo'   => 10,
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_estrategia_r' => 11,
                'id_estrategia'   => 11,
                'id_reg_riesgo'   => 11,
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_estrategia_r' => 12,
                'id_estrategia'   => 12,
                'id_reg_riesgo'   => 12,
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_estrategia_r' => 13,
                'id_estrategia'   => 13,
                'id_reg_riesgo'   => 13,
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_estrategia_r' => 14,
                'id_estrategia'   => 14,
                'id_reg_riesgo'   => 14,
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_estrategia_r' => 15,
                'id_estrategia'   => 15,
                'id_reg_riesgo'   => 15,
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
