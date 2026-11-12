<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_ejes`.
 */
class PlanEjesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_ejes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_ejes';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'          => 1,
                'descripcion' => 'Descripcion ejes 1',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id'          => 2,
                'descripcion' => 'Descripcion ejes 2',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id'          => 3,
                'descripcion' => 'Descripcion ejes 3',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id'          => 4,
                'descripcion' => 'Descripcion ejes 4',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id'          => 5,
                'descripcion' => 'Descripcion ejes 5',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id'          => 6,
                'descripcion' => 'Descripcion ejes 6',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id'          => 7,
                'descripcion' => 'Descripcion ejes 7',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id'          => 8,
                'descripcion' => 'Descripcion ejes 8',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id'          => 9,
                'descripcion' => 'Descripcion ejes 9',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id'          => 10,
                'descripcion' => 'Descripcion ejes 10',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id'          => 11,
                'descripcion' => 'Descripcion ejes 11',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id'          => 12,
                'descripcion' => 'Descripcion ejes 12',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id'          => 13,
                'descripcion' => 'Descripcion ejes 13',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id'          => 14,
                'descripcion' => 'Descripcion ejes 14',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id'          => 15,
                'descripcion' => 'Descripcion ejes 15',
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
