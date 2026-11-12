<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_colores`.
 */
class RmColoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_colores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_colores';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'         => 1,
                'color'      => '#1565C0',
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'color'      => '#2E7D32',
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'color'      => '#F9A825',
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'color'      => '#C62828',
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'color'      => '#6A1B9A',
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'color'      => '#00838F',
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'color'      => '#EF6C00',
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'color'      => '#1565C0',
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'color'      => '#2E7D32',
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'color'      => '#F9A825',
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'color'      => '#C62828',
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'color'      => '#6A1B9A',
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'color'      => '#00838F',
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'color'      => '#EF6C00',
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'color'      => '#1565C0',
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
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
