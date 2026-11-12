<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_criterio`.
 */
class EvaCriterioSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_criterio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'eva_criterio';

        $llaves = [
            ['id_criterio'],
        ];

        $registros = [
            [
                'id_criterio'     => 1,
                'nombre_criterio' => 'Nombre criterio criterio 1',
                'color'           => '#1565C0',
            ],
            [
                'id_criterio'     => 2,
                'nombre_criterio' => 'Nombre criterio criterio 2',
                'color'           => '#2E7D32',
            ],
            [
                'id_criterio'     => 3,
                'nombre_criterio' => 'Nombre criterio criterio 3',
                'color'           => '#F9A825',
            ],
            [
                'id_criterio'     => 4,
                'nombre_criterio' => 'Nombre criterio criterio 4',
                'color'           => '#C62828',
            ],
            [
                'id_criterio'     => 5,
                'nombre_criterio' => 'Nombre criterio criterio 5',
                'color'           => '#6A1B9A',
            ],
            [
                'id_criterio'     => 6,
                'nombre_criterio' => 'Nombre criterio criterio 6',
                'color'           => '#00838F',
            ],
            [
                'id_criterio'     => 7,
                'nombre_criterio' => 'Nombre criterio criterio 7',
                'color'           => '#EF6C00',
            ],
            [
                'id_criterio'     => 8,
                'nombre_criterio' => 'Nombre criterio criterio 8',
                'color'           => '#1565C0',
            ],
            [
                'id_criterio'     => 9,
                'nombre_criterio' => 'Nombre criterio criterio 9',
                'color'           => '#2E7D32',
            ],
            [
                'id_criterio'     => 10,
                'nombre_criterio' => 'Nombre criterio criterio 10',
                'color'           => '#F9A825',
            ],
            [
                'id_criterio'     => 11,
                'nombre_criterio' => 'Nombre criterio criterio 11',
                'color'           => '#C62828',
            ],
            [
                'id_criterio'     => 12,
                'nombre_criterio' => 'Nombre criterio criterio 12',
                'color'           => '#6A1B9A',
            ],
            [
                'id_criterio'     => 13,
                'nombre_criterio' => 'Nombre criterio criterio 13',
                'color'           => '#00838F',
            ],
            [
                'id_criterio'     => 14,
                'nombre_criterio' => 'Nombre criterio criterio 14',
                'color'           => '#EF6C00',
            ],
            [
                'id_criterio'     => 15,
                'nombre_criterio' => 'Nombre criterio criterio 15',
                'color'           => '#1565C0',
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
