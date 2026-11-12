<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_calificacion_autoeva`.
 */
class TuEvaCalificacionAutoevaSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_calificacion_autoeva` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_eva_calificacion_autoeva';

        $llaves = [
            ['id_calificacion'],
        ];

        $registros = [
            [
                'id_calificacion' => 1,
                'cal'             => 'Cal eva calificacion autoeva 1',
            ],
            [
                'id_calificacion' => 2,
                'cal'             => 'Cal eva calificacion autoeva 2',
            ],
            [
                'id_calificacion' => 3,
                'cal'             => 'Cal eva calificacion autoeva 3',
            ],
            [
                'id_calificacion' => 4,
                'cal'             => 'Cal eva calificacion autoeva 4',
            ],
            [
                'id_calificacion' => 5,
                'cal'             => 'Cal eva calificacion autoeva 5',
            ],
            [
                'id_calificacion' => 6,
                'cal'             => 'Cal eva calificacion autoeva 6',
            ],
            [
                'id_calificacion' => 7,
                'cal'             => 'Cal eva calificacion autoeva 7',
            ],
            [
                'id_calificacion' => 8,
                'cal'             => 'Cal eva calificacion autoeva 8',
            ],
            [
                'id_calificacion' => 9,
                'cal'             => 'Cal eva calificacion autoeva 9',
            ],
            [
                'id_calificacion' => 10,
                'cal'             => 'Cal eva calificacion autoeva 10',
            ],
            [
                'id_calificacion' => 11,
                'cal'             => 'Cal eva calificacion autoeva 11',
            ],
            [
                'id_calificacion' => 12,
                'cal'             => 'Cal eva calificacion autoeva 12',
            ],
            [
                'id_calificacion' => 13,
                'cal'             => 'Cal eva calificacion autoeva 13',
            ],
            [
                'id_calificacion' => 14,
                'cal'             => 'Cal eva calificacion autoeva 14',
            ],
            [
                'id_calificacion' => 15,
                'cal'             => 'Cal eva calificacion autoeva 15',
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
