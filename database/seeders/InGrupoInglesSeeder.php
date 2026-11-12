<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_grupo_ingles`.
 */
class InGrupoInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_grupo_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_grupo_ingles';

        $llaves = [
            ['id_grupo_ingles'],
        ];

        $registros = [
            [
                'id_grupo_ingles' => 1,
                'descripcion'     => 'Descripcion grupo ingles 1',
            ],
            [
                'id_grupo_ingles' => 2,
                'descripcion'     => 'Descripcion grupo ingles 2',
            ],
            [
                'id_grupo_ingles' => 3,
                'descripcion'     => 'Descripcion grupo ingles 3',
            ],
            [
                'id_grupo_ingles' => 4,
                'descripcion'     => 'Descripcion grupo ingles 4',
            ],
            [
                'id_grupo_ingles' => 5,
                'descripcion'     => 'Descripcion grupo ingles 5',
            ],
            [
                'id_grupo_ingles' => 6,
                'descripcion'     => 'Descripcion grupo ingles 6',
            ],
            [
                'id_grupo_ingles' => 7,
                'descripcion'     => 'Descripcion grupo ingles 7',
            ],
            [
                'id_grupo_ingles' => 8,
                'descripcion'     => 'Descripcion grupo ingles 8',
            ],
            [
                'id_grupo_ingles' => 9,
                'descripcion'     => 'Descripcion grupo ingles 9',
            ],
            [
                'id_grupo_ingles' => 10,
                'descripcion'     => 'Descripcion grupo ingles 10',
            ],
            [
                'id_grupo_ingles' => 11,
                'descripcion'     => 'Descripcion grupo ingles 11',
            ],
            [
                'id_grupo_ingles' => 12,
                'descripcion'     => 'Descripcion grupo ingles 12',
            ],
            [
                'id_grupo_ingles' => 13,
                'descripcion'     => 'Descripcion grupo ingles 13',
            ],
            [
                'id_grupo_ingles' => 14,
                'descripcion'     => 'Descripcion grupo ingles 14',
            ],
            [
                'id_grupo_ingles' => 15,
                'descripcion'     => 'Descripcion grupo ingles 15',
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
