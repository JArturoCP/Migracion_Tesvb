<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_opc_intelectual`.
 */
class ExpOpcIntelectualSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_opc_intelectual` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_opc_intelectual';

        $llaves = [
            ['id_opc_intelectual'],
        ];

        $registros = [
            [
                'id_opc_intelectual' => 1,
                'desc_opc'           => 'Desc opc opc intelectual 1',
            ],
            [
                'id_opc_intelectual' => 2,
                'desc_opc'           => 'Desc opc opc intelectual 2',
            ],
            [
                'id_opc_intelectual' => 3,
                'desc_opc'           => 'Desc opc opc intelectual 3',
            ],
            [
                'id_opc_intelectual' => 4,
                'desc_opc'           => 'Desc opc opc intelectual 4',
            ],
            [
                'id_opc_intelectual' => 5,
                'desc_opc'           => 'Desc opc opc intelectual 5',
            ],
            [
                'id_opc_intelectual' => 6,
                'desc_opc'           => 'Desc opc opc intelectual 6',
            ],
            [
                'id_opc_intelectual' => 7,
                'desc_opc'           => 'Desc opc opc intelectual 7',
            ],
            [
                'id_opc_intelectual' => 8,
                'desc_opc'           => 'Desc opc opc intelectual 8',
            ],
            [
                'id_opc_intelectual' => 9,
                'desc_opc'           => 'Desc opc opc intelectual 9',
            ],
            [
                'id_opc_intelectual' => 10,
                'desc_opc'           => 'Desc opc opc intelectual 10',
            ],
            [
                'id_opc_intelectual' => 11,
                'desc_opc'           => 'Desc opc opc intelectual 11',
            ],
            [
                'id_opc_intelectual' => 12,
                'desc_opc'           => 'Desc opc opc intelectual 12',
            ],
            [
                'id_opc_intelectual' => 13,
                'desc_opc'           => 'Desc opc opc intelectual 13',
            ],
            [
                'id_opc_intelectual' => 14,
                'desc_opc'           => 'Desc opc opc intelectual 14',
            ],
            [
                'id_opc_intelectual' => 15,
                'desc_opc'           => 'Desc opc opc intelectual 15',
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
