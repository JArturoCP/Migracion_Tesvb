<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_enviado_pres`.
 */
class PresAutEnviadoPresSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_enviado_pres` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_aut_enviado_pres';

        $llaves = [
            ['id_enviado_pres'],
        ];

        $registros = [
            [
                'id_enviado_pres' => 1,
                'enviado_pres'    => 'Enviado pres aut enviado pres 1',
            ],
            [
                'id_enviado_pres' => 2,
                'enviado_pres'    => 'Enviado pres aut enviado pres 2',
            ],
            [
                'id_enviado_pres' => 3,
                'enviado_pres'    => 'Enviado pres aut enviado pres 3',
            ],
            [
                'id_enviado_pres' => 4,
                'enviado_pres'    => 'Enviado pres aut enviado pres 4',
            ],
            [
                'id_enviado_pres' => 5,
                'enviado_pres'    => 'Enviado pres aut enviado pres 5',
            ],
            [
                'id_enviado_pres' => 6,
                'enviado_pres'    => 'Enviado pres aut enviado pres 6',
            ],
            [
                'id_enviado_pres' => 7,
                'enviado_pres'    => 'Enviado pres aut enviado pres 7',
            ],
            [
                'id_enviado_pres' => 8,
                'enviado_pres'    => 'Enviado pres aut enviado pres 8',
            ],
            [
                'id_enviado_pres' => 9,
                'enviado_pres'    => 'Enviado pres aut enviado pres 9',
            ],
            [
                'id_enviado_pres' => 10,
                'enviado_pres'    => 'Enviado pres aut enviado pres 10',
            ],
            [
                'id_enviado_pres' => 11,
                'enviado_pres'    => 'Enviado pres aut enviado pres 11',
            ],
            [
                'id_enviado_pres' => 12,
                'enviado_pres'    => 'Enviado pres aut enviado pres 12',
            ],
            [
                'id_enviado_pres' => 13,
                'enviado_pres'    => 'Enviado pres aut enviado pres 13',
            ],
            [
                'id_enviado_pres' => 14,
                'enviado_pres'    => 'Enviado pres aut enviado pres 14',
            ],
            [
                'id_enviado_pres' => 15,
                'enviado_pres'    => 'Enviado pres aut enviado pres 15',
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
