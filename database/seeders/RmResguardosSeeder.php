<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_resguardos`.
 */
class RmResguardosSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_resguardos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RmBienesSeeder::class,
            RmSectorauxsSeeder::class,
        ]);

        $tabla = 'rm_resguardos';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'         => 1,
                'id_sector'  => 1,
                'id_bienres' => 1,
                'fecha'      => '2026-01-05',
                'stock1'     => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'id_sector'  => 2,
                'id_bienres' => 2,
                'fecha'      => '2026-01-14',
                'stock1'     => 2,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'id_sector'  => 3,
                'id_bienres' => 3,
                'fecha'      => '2026-01-23',
                'stock1'     => 3,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'id_sector'  => 4,
                'id_bienres' => 4,
                'fecha'      => '2026-02-01',
                'stock1'     => 4,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'id_sector'  => 5,
                'id_bienres' => 5,
                'fecha'      => '2026-02-10',
                'stock1'     => 5,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'id_sector'  => 6,
                'id_bienres' => 6,
                'fecha'      => '2026-02-19',
                'stock1'     => 6,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'id_sector'  => 7,
                'id_bienres' => 7,
                'fecha'      => '2026-02-28',
                'stock1'     => 7,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'id_sector'  => 8,
                'id_bienres' => 8,
                'fecha'      => '2026-03-09',
                'stock1'     => 8,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'id_sector'  => 9,
                'id_bienres' => 9,
                'fecha'      => '2026-03-18',
                'stock1'     => 9,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'id_sector'  => 10,
                'id_bienres' => 10,
                'fecha'      => '2026-03-27',
                'stock1'     => 10,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'id_sector'  => 11,
                'id_bienres' => 11,
                'fecha'      => '2026-04-05',
                'stock1'     => 11,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'id_sector'  => 12,
                'id_bienres' => 12,
                'fecha'      => '2026-04-14',
                'stock1'     => 12,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'id_sector'  => 13,
                'id_bienres' => 13,
                'fecha'      => '2026-04-23',
                'stock1'     => 13,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'id_sector'  => 14,
                'id_bienres' => 14,
                'fecha'      => '2026-05-02',
                'stock1'     => 14,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'id_sector'  => 15,
                'id_bienres' => 15,
                'fecha'      => '2026-05-11',
                'stock1'     => 15,
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
