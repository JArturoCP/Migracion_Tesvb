<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_turno`.
 */
class ExpTurnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_turno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_turno';

        $llaves = [
            ['id_turno'],
        ];

        $registros = [
            [
                'id_turno'          => 1,
                'descripcion_turno' => 'Descripcion turno turno 1',
            ],
            [
                'id_turno'          => 2,
                'descripcion_turno' => 'Descripcion turno turno 2',
            ],
            [
                'id_turno'          => 3,
                'descripcion_turno' => 'Descripcion turno turno 3',
            ],
            [
                'id_turno'          => 4,
                'descripcion_turno' => 'Descripcion turno turno 4',
            ],
            [
                'id_turno'          => 5,
                'descripcion_turno' => 'Descripcion turno turno 5',
            ],
            [
                'id_turno'          => 6,
                'descripcion_turno' => 'Descripcion turno turno 6',
            ],
            [
                'id_turno'          => 7,
                'descripcion_turno' => 'Descripcion turno turno 7',
            ],
            [
                'id_turno'          => 8,
                'descripcion_turno' => 'Descripcion turno turno 8',
            ],
            [
                'id_turno'          => 9,
                'descripcion_turno' => 'Descripcion turno turno 9',
            ],
            [
                'id_turno'          => 10,
                'descripcion_turno' => 'Descripcion turno turno 10',
            ],
            [
                'id_turno'          => 11,
                'descripcion_turno' => 'Descripcion turno turno 11',
            ],
            [
                'id_turno'          => 12,
                'descripcion_turno' => 'Descripcion turno turno 12',
            ],
            [
                'id_turno'          => 13,
                'descripcion_turno' => 'Descripcion turno turno 13',
            ],
            [
                'id_turno'          => 14,
                'descripcion_turno' => 'Descripcion turno turno 14',
            ],
            [
                'id_turno'          => 15,
                'descripcion_turno' => 'Descripcion turno turno 15',
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
