<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_opc_tiempo`.
 */
class ExpOpcTiempoSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_opc_tiempo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_opc_tiempo';

        $llaves = [
            ['id_opc_tiempo'],
        ];

        $registros = [
            [
                'id_opc_tiempo' => 1,
                'desc_opc'      => 'Desc opc opc tiempo 1',
            ],
            [
                'id_opc_tiempo' => 2,
                'desc_opc'      => 'Desc opc opc tiempo 2',
            ],
            [
                'id_opc_tiempo' => 3,
                'desc_opc'      => 'Desc opc opc tiempo 3',
            ],
            [
                'id_opc_tiempo' => 4,
                'desc_opc'      => 'Desc opc opc tiempo 4',
            ],
            [
                'id_opc_tiempo' => 5,
                'desc_opc'      => 'Desc opc opc tiempo 5',
            ],
            [
                'id_opc_tiempo' => 6,
                'desc_opc'      => 'Desc opc opc tiempo 6',
            ],
            [
                'id_opc_tiempo' => 7,
                'desc_opc'      => 'Desc opc opc tiempo 7',
            ],
            [
                'id_opc_tiempo' => 8,
                'desc_opc'      => 'Desc opc opc tiempo 8',
            ],
            [
                'id_opc_tiempo' => 9,
                'desc_opc'      => 'Desc opc opc tiempo 9',
            ],
            [
                'id_opc_tiempo' => 10,
                'desc_opc'      => 'Desc opc opc tiempo 10',
            ],
            [
                'id_opc_tiempo' => 11,
                'desc_opc'      => 'Desc opc opc tiempo 11',
            ],
            [
                'id_opc_tiempo' => 12,
                'desc_opc'      => 'Desc opc opc tiempo 12',
            ],
            [
                'id_opc_tiempo' => 13,
                'desc_opc'      => 'Desc opc opc tiempo 13',
            ],
            [
                'id_opc_tiempo' => 14,
                'desc_opc'      => 'Desc opc opc tiempo 14',
            ],
            [
                'id_opc_tiempo' => 15,
                'desc_opc'      => 'Desc opc opc tiempo 15',
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
