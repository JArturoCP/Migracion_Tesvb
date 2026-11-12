<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_grupo_tutorias`.
 */
class TuGrupoTutoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_grupo_tutorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_grupo_tutorias';

        $llaves = [
            ['id_grupo_tutorias', 'descripcion'],
        ];

        $registros = [
            [
                'id_grupo_tutorias' => 1,
                'descripcion'       => 1,
            ],
            [
                'id_grupo_tutorias' => 2,
                'descripcion'       => 2,
            ],
            [
                'id_grupo_tutorias' => 3,
                'descripcion'       => 3,
            ],
            [
                'id_grupo_tutorias' => 4,
                'descripcion'       => 4,
            ],
            [
                'id_grupo_tutorias' => 5,
                'descripcion'       => 5,
            ],
            [
                'id_grupo_tutorias' => 6,
                'descripcion'       => 6,
            ],
            [
                'id_grupo_tutorias' => 7,
                'descripcion'       => 7,
            ],
            [
                'id_grupo_tutorias' => 8,
                'descripcion'       => 8,
            ],
            [
                'id_grupo_tutorias' => 9,
                'descripcion'       => 9,
            ],
            [
                'id_grupo_tutorias' => 10,
                'descripcion'       => 10,
            ],
            [
                'id_grupo_tutorias' => 11,
                'descripcion'       => 11,
            ],
            [
                'id_grupo_tutorias' => 12,
                'descripcion'       => 12,
            ],
            [
                'id_grupo_tutorias' => 13,
                'descripcion'       => 13,
            ],
            [
                'id_grupo_tutorias' => 14,
                'descripcion'       => 14,
            ],
            [
                'id_grupo_tutorias' => 15,
                'descripcion'       => 15,
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
