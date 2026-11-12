<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_opc_vives`.
 */
class ExpOpcVivesSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_opc_vives` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_opc_vives';

        $llaves = [
            ['id_opc_vives'],
        ];

        $registros = [
            [
                'id_opc_vives' => 1,
                'desc_opc'     => 'Desc opc opc vives 1',
            ],
            [
                'id_opc_vives' => 2,
                'desc_opc'     => 'Desc opc opc vives 2',
            ],
            [
                'id_opc_vives' => 3,
                'desc_opc'     => 'Desc opc opc vives 3',
            ],
            [
                'id_opc_vives' => 4,
                'desc_opc'     => 'Desc opc opc vives 4',
            ],
            [
                'id_opc_vives' => 5,
                'desc_opc'     => 'Desc opc opc vives 5',
            ],
            [
                'id_opc_vives' => 6,
                'desc_opc'     => 'Desc opc opc vives 6',
            ],
            [
                'id_opc_vives' => 7,
                'desc_opc'     => 'Desc opc opc vives 7',
            ],
            [
                'id_opc_vives' => 8,
                'desc_opc'     => 'Desc opc opc vives 8',
            ],
            [
                'id_opc_vives' => 9,
                'desc_opc'     => 'Desc opc opc vives 9',
            ],
            [
                'id_opc_vives' => 10,
                'desc_opc'     => 'Desc opc opc vives 10',
            ],
            [
                'id_opc_vives' => 11,
                'desc_opc'     => 'Desc opc opc vives 11',
            ],
            [
                'id_opc_vives' => 12,
                'desc_opc'     => 'Desc opc opc vives 12',
            ],
            [
                'id_opc_vives' => 13,
                'desc_opc'     => 'Desc opc opc vives 13',
            ],
            [
                'id_opc_vives' => 14,
                'desc_opc'     => 'Desc opc opc vives 14',
            ],
            [
                'id_opc_vives' => 15,
                'desc_opc'     => 'Desc opc opc vives 15',
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
