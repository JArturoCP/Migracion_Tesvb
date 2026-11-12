<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_civil_estados`.
 */
class ExpCivilEstadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_civil_estados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_civil_estados';

        $llaves = [
            ['id_estado_civil'],
        ];

        $registros = [
            [
                'id_estado_civil' => 1,
                'desc_ec'         => 'SOLTERO(A)',
            ],
            [
                'id_estado_civil' => 2,
                'desc_ec'         => 'CASADO(A)',
            ],
            [
                'id_estado_civil' => 3,
                'desc_ec'         => 'UNIÓN LIBRE',
            ],
            [
                'id_estado_civil' => 4,
                'desc_ec'         => 'DIVORCIADO(A)',
            ],
            [
                'id_estado_civil' => 5,
                'desc_ec'         => 'VIUDO(A)',
            ],
            [
                'id_estado_civil' => 6,
                'desc_ec'         => 'SOLTERO(A) 6',
            ],
            [
                'id_estado_civil' => 7,
                'desc_ec'         => 'CASADO(A) 7',
            ],
            [
                'id_estado_civil' => 8,
                'desc_ec'         => 'UNIÓN LIBRE 8',
            ],
            [
                'id_estado_civil' => 9,
                'desc_ec'         => 'DIVORCIADO(A) 9',
            ],
            [
                'id_estado_civil' => 10,
                'desc_ec'         => 'VIUDO(A) 10',
            ],
            [
                'id_estado_civil' => 11,
                'desc_ec'         => 'SOLTERO(A) 11',
            ],
            [
                'id_estado_civil' => 12,
                'desc_ec'         => 'CASADO(A) 12',
            ],
            [
                'id_estado_civil' => 13,
                'desc_ec'         => 'UNIÓN LIBRE 13',
            ],
            [
                'id_estado_civil' => 14,
                'desc_ec'         => 'DIVORCIADO(A) 14',
            ],
            [
                'id_estado_civil' => 15,
                'desc_ec'         => 'VIUDO(A) 15',
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
