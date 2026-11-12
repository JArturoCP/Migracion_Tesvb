<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_escalas`.
 */
class ExpEscalasSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_escalas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_escalas';

        $llaves = [
            ['id_escala'],
        ];

        $registros = [
            [
                'id_escala'   => 1,
                'desc_escala' => 'Desc escala escalas 1',
            ],
            [
                'id_escala'   => 2,
                'desc_escala' => 'Desc escala escalas 2',
            ],
            [
                'id_escala'   => 3,
                'desc_escala' => 'Desc escala escalas 3',
            ],
            [
                'id_escala'   => 4,
                'desc_escala' => 'Desc escala escalas 4',
            ],
            [
                'id_escala'   => 5,
                'desc_escala' => 'Desc escala escalas 5',
            ],
            [
                'id_escala'   => 6,
                'desc_escala' => 'Desc escala escalas 6',
            ],
            [
                'id_escala'   => 7,
                'desc_escala' => 'Desc escala escalas 7',
            ],
            [
                'id_escala'   => 8,
                'desc_escala' => 'Desc escala escalas 8',
            ],
            [
                'id_escala'   => 9,
                'desc_escala' => 'Desc escala escalas 9',
            ],
            [
                'id_escala'   => 10,
                'desc_escala' => 'Desc escala escalas 10',
            ],
            [
                'id_escala'   => 11,
                'desc_escala' => 'Desc escala escalas 11',
            ],
            [
                'id_escala'   => 12,
                'desc_escala' => 'Desc escala escalas 12',
            ],
            [
                'id_escala'   => 13,
                'desc_escala' => 'Desc escala escalas 13',
            ],
            [
                'id_escala'   => 14,
                'desc_escala' => 'Desc escala escalas 14',
            ],
            [
                'id_escala'   => 15,
                'desc_escala' => 'Desc escala escalas 15',
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
