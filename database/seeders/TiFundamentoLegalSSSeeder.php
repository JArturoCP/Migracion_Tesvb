<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_fundamento_legal_s_s`.
 */
class TiFundamentoLegalSSSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_fundamento_legal_s_s` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_fundamento_legal_s_s';

        $llaves = [
            ['id_fundamento_legal'],
        ];

        $registros = [
            [
                'id_fundamento_legal' => 1,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 1.',
            ],
            [
                'id_fundamento_legal' => 2,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 2.',
            ],
            [
                'id_fundamento_legal' => 3,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 3.',
            ],
            [
                'id_fundamento_legal' => 4,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 4.',
            ],
            [
                'id_fundamento_legal' => 5,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 5.',
            ],
            [
                'id_fundamento_legal' => 6,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 6.',
            ],
            [
                'id_fundamento_legal' => 7,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 7.',
            ],
            [
                'id_fundamento_legal' => 8,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 8.',
            ],
            [
                'id_fundamento_legal' => 9,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 9.',
            ],
            [
                'id_fundamento_legal' => 10,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 10.',
            ],
            [
                'id_fundamento_legal' => 11,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 11.',
            ],
            [
                'id_fundamento_legal' => 12,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 12.',
            ],
            [
                'id_fundamento_legal' => 13,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 13.',
            ],
            [
                'id_fundamento_legal' => 14,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 14.',
            ],
            [
                'id_fundamento_legal' => 15,
                'fundamento_legal'    => 'Fundamento legal de fundamento legal s s: registro de prueba número 15.',
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
