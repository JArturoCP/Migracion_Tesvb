<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_categoria_cuestionario`.
 */
class TuEvaCategoriaCuestionarioSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_categoria_cuestionario` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_eva_categoria_cuestionario';

        $llaves = [
            ['id_eva_categoria_cuestionario'],
        ];

        $registros = [
            [
                'id_eva_categoria_cuestionario' => 1,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 1',
            ],
            [
                'id_eva_categoria_cuestionario' => 2,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 2',
            ],
            [
                'id_eva_categoria_cuestionario' => 3,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 3',
            ],
            [
                'id_eva_categoria_cuestionario' => 4,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 4',
            ],
            [
                'id_eva_categoria_cuestionario' => 5,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 5',
            ],
            [
                'id_eva_categoria_cuestionario' => 6,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 6',
            ],
            [
                'id_eva_categoria_cuestionario' => 7,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 7',
            ],
            [
                'id_eva_categoria_cuestionario' => 8,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 8',
            ],
            [
                'id_eva_categoria_cuestionario' => 9,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 9',
            ],
            [
                'id_eva_categoria_cuestionario' => 10,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 10',
            ],
            [
                'id_eva_categoria_cuestionario' => 11,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 11',
            ],
            [
                'id_eva_categoria_cuestionario' => 12,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 12',
            ],
            [
                'id_eva_categoria_cuestionario' => 13,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 13',
            ],
            [
                'id_eva_categoria_cuestionario' => 14,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 14',
            ],
            [
                'id_eva_categoria_cuestionario' => 15,
                'desctipcion'                   => 'Desctipcion eva categoria cuestionario 15',
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
