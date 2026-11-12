<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_fo17_cal`.
 */
class TuEvaFo17CalSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_fo17_cal` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_eva_fo17_cal';

        $llaves = [
            ['id_cal'],
        ];

        $registros = [
            [
                'id_cal' => 1,
                'cal'    => 'Cal eva fo17 cal 1',
            ],
            [
                'id_cal' => 2,
                'cal'    => 'Cal eva fo17 cal 2',
            ],
            [
                'id_cal' => 3,
                'cal'    => 'Cal eva fo17 cal 3',
            ],
            [
                'id_cal' => 4,
                'cal'    => 'Cal eva fo17 cal 4',
            ],
            [
                'id_cal' => 5,
                'cal'    => 'Cal eva fo17 cal 5',
            ],
            [
                'id_cal' => 6,
                'cal'    => 'Cal eva fo17 cal 6',
            ],
            [
                'id_cal' => 7,
                'cal'    => 'Cal eva fo17 cal 7',
            ],
            [
                'id_cal' => 8,
                'cal'    => 'Cal eva fo17 cal 8',
            ],
            [
                'id_cal' => 9,
                'cal'    => 'Cal eva fo17 cal 9',
            ],
            [
                'id_cal' => 10,
                'cal'    => 'Cal eva fo17 cal 10',
            ],
            [
                'id_cal' => 11,
                'cal'    => 'Cal eva fo17 cal 11',
            ],
            [
                'id_cal' => 12,
                'cal'    => 'Cal eva fo17 cal 12',
            ],
            [
                'id_cal' => 13,
                'cal'    => 'Cal eva fo17 cal 13',
            ],
            [
                'id_cal' => 14,
                'cal'    => 'Cal eva fo17 cal 14',
            ],
            [
                'id_cal' => 15,
                'cal'    => 'Cal eva fo17 cal 15',
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
