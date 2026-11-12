<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_cuestionario`.
 */
class TuEvaCuestionarioSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_cuestionario` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            TuEvaCategoriaCuestionarioSeeder::class,
        ]);

        $tabla = 'tu_eva_cuestionario';

        $llaves = [
            ['id_eva_cuestionario'],
        ];

        $registros = [
            [
                'id_eva_cuestionario'           => 1,
                'id_eva_categoria_cuestionario' => 1,
                'descripcion'                   => 'Descripcion eva cuestionario 1',
            ],
            [
                'id_eva_cuestionario'           => 2,
                'id_eva_categoria_cuestionario' => 2,
                'descripcion'                   => 'Descripcion eva cuestionario 2',
            ],
            [
                'id_eva_cuestionario'           => 3,
                'id_eva_categoria_cuestionario' => 3,
                'descripcion'                   => 'Descripcion eva cuestionario 3',
            ],
            [
                'id_eva_cuestionario'           => 4,
                'id_eva_categoria_cuestionario' => 4,
                'descripcion'                   => 'Descripcion eva cuestionario 4',
            ],
            [
                'id_eva_cuestionario'           => 5,
                'id_eva_categoria_cuestionario' => 5,
                'descripcion'                   => 'Descripcion eva cuestionario 5',
            ],
            [
                'id_eva_cuestionario'           => 6,
                'id_eva_categoria_cuestionario' => 6,
                'descripcion'                   => 'Descripcion eva cuestionario 6',
            ],
            [
                'id_eva_cuestionario'           => 7,
                'id_eva_categoria_cuestionario' => 7,
                'descripcion'                   => 'Descripcion eva cuestionario 7',
            ],
            [
                'id_eva_cuestionario'           => 8,
                'id_eva_categoria_cuestionario' => 8,
                'descripcion'                   => 'Descripcion eva cuestionario 8',
            ],
            [
                'id_eva_cuestionario'           => 9,
                'id_eva_categoria_cuestionario' => 9,
                'descripcion'                   => 'Descripcion eva cuestionario 9',
            ],
            [
                'id_eva_cuestionario'           => 10,
                'id_eva_categoria_cuestionario' => 10,
                'descripcion'                   => 'Descripcion eva cuestionario 10',
            ],
            [
                'id_eva_cuestionario'           => 11,
                'id_eva_categoria_cuestionario' => 11,
                'descripcion'                   => 'Descripcion eva cuestionario 11',
            ],
            [
                'id_eva_cuestionario'           => 12,
                'id_eva_categoria_cuestionario' => 12,
                'descripcion'                   => 'Descripcion eva cuestionario 12',
            ],
            [
                'id_eva_cuestionario'           => 13,
                'id_eva_categoria_cuestionario' => 13,
                'descripcion'                   => 'Descripcion eva cuestionario 13',
            ],
            [
                'id_eva_cuestionario'           => 14,
                'id_eva_categoria_cuestionario' => 14,
                'descripcion'                   => 'Descripcion eva cuestionario 14',
            ],
            [
                'id_eva_cuestionario'           => 15,
                'id_eva_categoria_cuestionario' => 15,
                'descripcion'                   => 'Descripcion eva cuestionario 15',
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
