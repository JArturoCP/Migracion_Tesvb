<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_tipoadqui`.
 */
class RmTipoadquiSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_tipoadqui` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_tipoadqui';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'         => 1,
                'tipoadqui'  => 'Tipoadqui tipoadqui 1',
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'tipoadqui'  => 'Tipoadqui tipoadqui 2',
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'tipoadqui'  => 'Tipoadqui tipoadqui 3',
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'tipoadqui'  => 'Tipoadqui tipoadqui 4',
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'tipoadqui'  => 'Tipoadqui tipoadqui 5',
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'tipoadqui'  => 'Tipoadqui tipoadqui 6',
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'tipoadqui'  => 'Tipoadqui tipoadqui 7',
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'tipoadqui'  => 'Tipoadqui tipoadqui 8',
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'tipoadqui'  => 'Tipoadqui tipoadqui 9',
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'tipoadqui'  => 'Tipoadqui tipoadqui 10',
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'tipoadqui'  => 'Tipoadqui tipoadqui 11',
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'tipoadqui'  => 'Tipoadqui tipoadqui 12',
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'tipoadqui'  => 'Tipoadqui tipoadqui 13',
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'tipoadqui'  => 'Tipoadqui tipoadqui 14',
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'tipoadqui'  => 'Tipoadqui tipoadqui 15',
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
