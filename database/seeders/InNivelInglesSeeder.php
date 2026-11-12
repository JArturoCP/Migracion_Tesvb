<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_nivel_ingles`.
 */
class InNivelInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_nivel_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_nivel_ingles';

        $llaves = [
            ['id_nivel_ingles'],
        ];

        $registros = [
            [
                'id_nivel_ingles' => 1,
                'descripcion'     => 'Descripcion nivel ingles 1',
            ],
            [
                'id_nivel_ingles' => 2,
                'descripcion'     => 'Descripcion nivel ingles 2',
            ],
            [
                'id_nivel_ingles' => 3,
                'descripcion'     => 'Descripcion nivel ingles 3',
            ],
            [
                'id_nivel_ingles' => 4,
                'descripcion'     => 'Descripcion nivel ingles 4',
            ],
            [
                'id_nivel_ingles' => 5,
                'descripcion'     => 'Descripcion nivel ingles 5',
            ],
            [
                'id_nivel_ingles' => 6,
                'descripcion'     => 'Descripcion nivel ingles 6',
            ],
            [
                'id_nivel_ingles' => 7,
                'descripcion'     => 'Descripcion nivel ingles 7',
            ],
            [
                'id_nivel_ingles' => 8,
                'descripcion'     => 'Descripcion nivel ingles 8',
            ],
            [
                'id_nivel_ingles' => 9,
                'descripcion'     => 'Descripcion nivel ingles 9',
            ],
            [
                'id_nivel_ingles' => 10,
                'descripcion'     => 'Descripcion nivel ingles 10',
            ],
            [
                'id_nivel_ingles' => 11,
                'descripcion'     => 'Descripcion nivel ingles 11',
            ],
            [
                'id_nivel_ingles' => 12,
                'descripcion'     => 'Descripcion nivel ingles 12',
            ],
            [
                'id_nivel_ingles' => 13,
                'descripcion'     => 'Descripcion nivel ingles 13',
            ],
            [
                'id_nivel_ingles' => 14,
                'descripcion'     => 'Descripcion nivel ingles 14',
            ],
            [
                'id_nivel_ingles' => 15,
                'descripcion'     => 'Descripcion nivel ingles 15',
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
