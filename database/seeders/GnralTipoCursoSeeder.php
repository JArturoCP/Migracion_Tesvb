<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_tipo_curso`.
 */
class GnralTipoCursoSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_tipo_curso` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_tipo_curso';

        $llaves = [
            ['id_tipo_curso', 'curso'],
        ];

        $registros = [
            [
                'id_tipo_curso' => 1,
                'curso'         => 'Curso tipo curso 1',
            ],
            [
                'id_tipo_curso' => 2,
                'curso'         => 'Curso tipo curso 2',
            ],
            [
                'id_tipo_curso' => 3,
                'curso'         => 'Curso tipo curso 3',
            ],
            [
                'id_tipo_curso' => 4,
                'curso'         => 'Curso tipo curso 4',
            ],
            [
                'id_tipo_curso' => 5,
                'curso'         => 'Curso tipo curso 5',
            ],
            [
                'id_tipo_curso' => 6,
                'curso'         => 'Curso tipo curso 6',
            ],
            [
                'id_tipo_curso' => 7,
                'curso'         => 'Curso tipo curso 7',
            ],
            [
                'id_tipo_curso' => 8,
                'curso'         => 'Curso tipo curso 8',
            ],
            [
                'id_tipo_curso' => 9,
                'curso'         => 'Curso tipo curso 9',
            ],
            [
                'id_tipo_curso' => 10,
                'curso'         => 'Curso tipo curso 10',
            ],
            [
                'id_tipo_curso' => 11,
                'curso'         => 'Curso tipo curso 11',
            ],
            [
                'id_tipo_curso' => 12,
                'curso'         => 'Curso tipo curso 12',
            ],
            [
                'id_tipo_curso' => 13,
                'curso'         => 'Curso tipo curso 13',
            ],
            [
                'id_tipo_curso' => 14,
                'curso'         => 'Curso tipo curso 14',
            ],
            [
                'id_tipo_curso' => 15,
                'curso'         => 'Curso tipo curso 15',
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
