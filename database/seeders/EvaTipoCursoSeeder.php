<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_tipo_curso`.
 */
class EvaTipoCursoSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_tipo_curso` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'eva_tipo_curso';

        $llaves = [
            ['id_tipo_curso', 'nombre_curso'],
        ];

        $registros = [
            [
                'id_tipo_curso' => 1,
                'nombre_curso'  => 'Nombre curso tipo curso 1',
            ],
            [
                'id_tipo_curso' => 2,
                'nombre_curso'  => 'Nombre curso tipo curso 2',
            ],
            [
                'id_tipo_curso' => 3,
                'nombre_curso'  => 'Nombre curso tipo curso 3',
            ],
            [
                'id_tipo_curso' => 4,
                'nombre_curso'  => 'Nombre curso tipo curso 4',
            ],
            [
                'id_tipo_curso' => 5,
                'nombre_curso'  => 'Nombre curso tipo curso 5',
            ],
            [
                'id_tipo_curso' => 6,
                'nombre_curso'  => 'Nombre curso tipo curso 6',
            ],
            [
                'id_tipo_curso' => 7,
                'nombre_curso'  => 'Nombre curso tipo curso 7',
            ],
            [
                'id_tipo_curso' => 8,
                'nombre_curso'  => 'Nombre curso tipo curso 8',
            ],
            [
                'id_tipo_curso' => 9,
                'nombre_curso'  => 'Nombre curso tipo curso 9',
            ],
            [
                'id_tipo_curso' => 10,
                'nombre_curso'  => 'Nombre curso tipo curso 10',
            ],
            [
                'id_tipo_curso' => 11,
                'nombre_curso'  => 'Nombre curso tipo curso 11',
            ],
            [
                'id_tipo_curso' => 12,
                'nombre_curso'  => 'Nombre curso tipo curso 12',
            ],
            [
                'id_tipo_curso' => 13,
                'nombre_curso'  => 'Nombre curso tipo curso 13',
            ],
            [
                'id_tipo_curso' => 14,
                'nombre_curso'  => 'Nombre curso tipo curso 14',
            ],
            [
                'id_tipo_curso' => 15,
                'nombre_curso'  => 'Nombre curso tipo curso 15',
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
