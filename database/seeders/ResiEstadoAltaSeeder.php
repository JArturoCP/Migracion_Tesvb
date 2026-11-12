<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_estado_alta`.
 */
class ResiEstadoAltaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_estado_alta` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_estado_alta';

        $llaves = [
            ['id_estado_alta'],
        ];

        $registros = [
            [
                'id_estado_alta' => 1,
                'estado_alta'    => 'Estado alta estado alta 1',
            ],
            [
                'id_estado_alta' => 2,
                'estado_alta'    => 'Estado alta estado alta 2',
            ],
            [
                'id_estado_alta' => 3,
                'estado_alta'    => 'Estado alta estado alta 3',
            ],
            [
                'id_estado_alta' => 4,
                'estado_alta'    => 'Estado alta estado alta 4',
            ],
            [
                'id_estado_alta' => 5,
                'estado_alta'    => 'Estado alta estado alta 5',
            ],
            [
                'id_estado_alta' => 6,
                'estado_alta'    => 'Estado alta estado alta 6',
            ],
            [
                'id_estado_alta' => 7,
                'estado_alta'    => 'Estado alta estado alta 7',
            ],
            [
                'id_estado_alta' => 8,
                'estado_alta'    => 'Estado alta estado alta 8',
            ],
            [
                'id_estado_alta' => 9,
                'estado_alta'    => 'Estado alta estado alta 9',
            ],
            [
                'id_estado_alta' => 10,
                'estado_alta'    => 'Estado alta estado alta 10',
            ],
            [
                'id_estado_alta' => 11,
                'estado_alta'    => 'Estado alta estado alta 11',
            ],
            [
                'id_estado_alta' => 12,
                'estado_alta'    => 'Estado alta estado alta 12',
            ],
            [
                'id_estado_alta' => 13,
                'estado_alta'    => 'Estado alta estado alta 13',
            ],
            [
                'id_estado_alta' => 14,
                'estado_alta'    => 'Estado alta estado alta 14',
            ],
            [
                'id_estado_alta' => 15,
                'estado_alta'    => 'Estado alta estado alta 15',
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
