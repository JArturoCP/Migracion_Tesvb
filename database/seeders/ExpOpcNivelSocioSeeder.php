<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_opc_nivel_socio`.
 */
class ExpOpcNivelSocioSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_opc_nivel_socio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_opc_nivel_socio';

        $llaves = [
            ['id_nivel_economico'],
        ];

        $registros = [
            [
                'id_nivel_economico' => 1,
                'desc_opc'           => 'Desc opc opc nivel socio 1',
            ],
            [
                'id_nivel_economico' => 2,
                'desc_opc'           => 'Desc opc opc nivel socio 2',
            ],
            [
                'id_nivel_economico' => 3,
                'desc_opc'           => 'Desc opc opc nivel socio 3',
            ],
            [
                'id_nivel_economico' => 4,
                'desc_opc'           => 'Desc opc opc nivel socio 4',
            ],
            [
                'id_nivel_economico' => 5,
                'desc_opc'           => 'Desc opc opc nivel socio 5',
            ],
            [
                'id_nivel_economico' => 6,
                'desc_opc'           => 'Desc opc opc nivel socio 6',
            ],
            [
                'id_nivel_economico' => 7,
                'desc_opc'           => 'Desc opc opc nivel socio 7',
            ],
            [
                'id_nivel_economico' => 8,
                'desc_opc'           => 'Desc opc opc nivel socio 8',
            ],
            [
                'id_nivel_economico' => 9,
                'desc_opc'           => 'Desc opc opc nivel socio 9',
            ],
            [
                'id_nivel_economico' => 10,
                'desc_opc'           => 'Desc opc opc nivel socio 10',
            ],
            [
                'id_nivel_economico' => 11,
                'desc_opc'           => 'Desc opc opc nivel socio 11',
            ],
            [
                'id_nivel_economico' => 12,
                'desc_opc'           => 'Desc opc opc nivel socio 12',
            ],
            [
                'id_nivel_economico' => 13,
                'desc_opc'           => 'Desc opc opc nivel socio 13',
            ],
            [
                'id_nivel_economico' => 14,
                'desc_opc'           => 'Desc opc opc nivel socio 14',
            ],
            [
                'id_nivel_economico' => 15,
                'desc_opc'           => 'Desc opc opc nivel socio 15',
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
