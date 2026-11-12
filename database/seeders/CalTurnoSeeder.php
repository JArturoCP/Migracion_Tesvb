<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_turno`.
 */
class CalTurnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_turno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'cal_turno';

        $llaves = [
            ['id_turno'],
        ];

        $registros = [
            [
                'id_turno' => 1,
                'turno'    => 'Turno turno 1',
            ],
            [
                'id_turno' => 2,
                'turno'    => 'Turno turno 2',
            ],
            [
                'id_turno' => 3,
                'turno'    => 'Turno turno 3',
            ],
            [
                'id_turno' => 4,
                'turno'    => 'Turno turno 4',
            ],
            [
                'id_turno' => 5,
                'turno'    => 'Turno turno 5',
            ],
            [
                'id_turno' => 6,
                'turno'    => 'Turno turno 6',
            ],
            [
                'id_turno' => 7,
                'turno'    => 'Turno turno 7',
            ],
            [
                'id_turno' => 8,
                'turno'    => 'Turno turno 8',
            ],
            [
                'id_turno' => 9,
                'turno'    => 'Turno turno 9',
            ],
            [
                'id_turno' => 10,
                'turno'    => 'Turno turno 10',
            ],
            [
                'id_turno' => 11,
                'turno'    => 'Turno turno 11',
            ],
            [
                'id_turno' => 12,
                'turno'    => 'Turno turno 12',
            ],
            [
                'id_turno' => 13,
                'turno'    => 'Turno turno 13',
            ],
            [
                'id_turno' => 14,
                'turno'    => 'Turno turno 14',
            ],
            [
                'id_turno' => 15,
                'turno'    => 'Turno turno 15',
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
