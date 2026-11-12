<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_edificios`.
 */
class HrsEdificiosSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_edificios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_edificios';

        $llaves = [
            ['id_edificio'],
        ];

        $registros = [
            [
                'id_edificio' => 1,
                'nombre'      => 'Nombre edificios 1',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_edificio' => 2,
                'nombre'      => 'Nombre edificios 2',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_edificio' => 3,
                'nombre'      => 'Nombre edificios 3',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_edificio' => 4,
                'nombre'      => 'Nombre edificios 4',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_edificio' => 5,
                'nombre'      => 'Nombre edificios 5',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_edificio' => 6,
                'nombre'      => 'Nombre edificios 6',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_edificio' => 7,
                'nombre'      => 'Nombre edificios 7',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_edificio' => 8,
                'nombre'      => 'Nombre edificios 8',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_edificio' => 9,
                'nombre'      => 'Nombre edificios 9',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_edificio' => 10,
                'nombre'      => 'Nombre edificios 10',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_edificio' => 11,
                'nombre'      => 'Nombre edificios 11',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_edificio' => 12,
                'nombre'      => 'Nombre edificios 12',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_edificio' => 13,
                'nombre'      => 'Nombre edificios 13',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_edificio' => 14,
                'nombre'      => 'Nombre edificios 14',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_edificio' => 15,
                'nombre'      => 'Nombre edificios 15',
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
