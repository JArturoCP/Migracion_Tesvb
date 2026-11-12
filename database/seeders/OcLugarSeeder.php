<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_lugar`.
 */
class OcLugarSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_lugar` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_lugar';

        $llaves = [
            ['id_lugar'],
        ];

        $registros = [
            [
                'id_lugar'    => 1,
                'descripcion' => 'Descripcion lugar 1',
            ],
            [
                'id_lugar'    => 2,
                'descripcion' => 'Descripcion lugar 2',
            ],
            [
                'id_lugar'    => 3,
                'descripcion' => 'Descripcion lugar 3',
            ],
            [
                'id_lugar'    => 4,
                'descripcion' => 'Descripcion lugar 4',
            ],
            [
                'id_lugar'    => 5,
                'descripcion' => 'Descripcion lugar 5',
            ],
            [
                'id_lugar'    => 6,
                'descripcion' => 'Descripcion lugar 6',
            ],
            [
                'id_lugar'    => 7,
                'descripcion' => 'Descripcion lugar 7',
            ],
            [
                'id_lugar'    => 8,
                'descripcion' => 'Descripcion lugar 8',
            ],
            [
                'id_lugar'    => 9,
                'descripcion' => 'Descripcion lugar 9',
            ],
            [
                'id_lugar'    => 10,
                'descripcion' => 'Descripcion lugar 10',
            ],
            [
                'id_lugar'    => 11,
                'descripcion' => 'Descripcion lugar 11',
            ],
            [
                'id_lugar'    => 12,
                'descripcion' => 'Descripcion lugar 12',
            ],
            [
                'id_lugar'    => 13,
                'descripcion' => 'Descripcion lugar 13',
            ],
            [
                'id_lugar'    => 14,
                'descripcion' => 'Descripcion lugar 14',
            ],
            [
                'id_lugar'    => 15,
                'descripcion' => 'Descripcion lugar 15',
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
