<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_decisiones_jurado`.
 */
class TiDecisionesJuradoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_decisiones_jurado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_decisiones_jurado';

        $llaves = [
            ['id_decision'],
        ];

        $registros = [
            [
                'id_decision' => 1,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 1.',
            ],
            [
                'id_decision' => 2,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 2.',
            ],
            [
                'id_decision' => 3,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 3.',
            ],
            [
                'id_decision' => 4,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 4.',
            ],
            [
                'id_decision' => 5,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 5.',
            ],
            [
                'id_decision' => 6,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 6.',
            ],
            [
                'id_decision' => 7,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 7.',
            ],
            [
                'id_decision' => 8,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 8.',
            ],
            [
                'id_decision' => 9,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 9.',
            ],
            [
                'id_decision' => 10,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 10.',
            ],
            [
                'id_decision' => 11,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 11.',
            ],
            [
                'id_decision' => 12,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 12.',
            ],
            [
                'id_decision' => 13,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 13.',
            ],
            [
                'id_decision' => 14,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 14.',
            ],
            [
                'id_decision' => 15,
                'decision'    => 'Decision de decisiones jurado: registro de prueba número 15.',
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
