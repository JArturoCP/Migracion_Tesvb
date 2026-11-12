<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_titulo`.
 */
class InTituloSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_titulo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_titulo';

        $llaves = [
            ['id_titulo'],
        ];

        $registros = [
            [
                'id_titulo'   => 1,
                'descripcion' => 'Descripcion titulo 1',
            ],
            [
                'id_titulo'   => 2,
                'descripcion' => 'Descripcion titulo 2',
            ],
            [
                'id_titulo'   => 3,
                'descripcion' => 'Descripcion titulo 3',
            ],
            [
                'id_titulo'   => 4,
                'descripcion' => 'Descripcion titulo 4',
            ],
            [
                'id_titulo'   => 5,
                'descripcion' => 'Descripcion titulo 5',
            ],
            [
                'id_titulo'   => 6,
                'descripcion' => 'Descripcion titulo 6',
            ],
            [
                'id_titulo'   => 7,
                'descripcion' => 'Descripcion titulo 7',
            ],
            [
                'id_titulo'   => 8,
                'descripcion' => 'Descripcion titulo 8',
            ],
            [
                'id_titulo'   => 9,
                'descripcion' => 'Descripcion titulo 9',
            ],
            [
                'id_titulo'   => 10,
                'descripcion' => 'Descripcion titulo 10',
            ],
            [
                'id_titulo'   => 11,
                'descripcion' => 'Descripcion titulo 11',
            ],
            [
                'id_titulo'   => 12,
                'descripcion' => 'Descripcion titulo 12',
            ],
            [
                'id_titulo'   => 13,
                'descripcion' => 'Descripcion titulo 13',
            ],
            [
                'id_titulo'   => 14,
                'descripcion' => 'Descripcion titulo 14',
            ],
            [
                'id_titulo'   => 15,
                'descripcion' => 'Descripcion titulo 15',
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
