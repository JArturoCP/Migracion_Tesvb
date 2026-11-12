<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_actividades_complementarias`.
 */
class CalActividadesComplementariasSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_actividades_complementarias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'cal_actividades_complementarias';

        $llaves = [
            ['id_actividades_comple'],
        ];

        $registros = [
            [
                'id_actividades_comple' => 1,
                'clave'                 => 'CLV-001',
                'id_alumno'             => 1,
                'cal'                   => 'Cal actividades complementarias 1',
            ],
            [
                'id_actividades_comple' => 2,
                'clave'                 => 'CLV-002',
                'id_alumno'             => 2,
                'cal'                   => 'Cal actividades complementarias 2',
            ],
            [
                'id_actividades_comple' => 3,
                'clave'                 => 'CLV-003',
                'id_alumno'             => 3,
                'cal'                   => 'Cal actividades complementarias 3',
            ],
            [
                'id_actividades_comple' => 4,
                'clave'                 => 'CLV-004',
                'id_alumno'             => 4,
                'cal'                   => 'Cal actividades complementarias 4',
            ],
            [
                'id_actividades_comple' => 5,
                'clave'                 => 'CLV-005',
                'id_alumno'             => 5,
                'cal'                   => 'Cal actividades complementarias 5',
            ],
            [
                'id_actividades_comple' => 6,
                'clave'                 => 'CLV-006',
                'id_alumno'             => 6,
                'cal'                   => 'Cal actividades complementarias 6',
            ],
            [
                'id_actividades_comple' => 7,
                'clave'                 => 'CLV-007',
                'id_alumno'             => 7,
                'cal'                   => 'Cal actividades complementarias 7',
            ],
            [
                'id_actividades_comple' => 8,
                'clave'                 => 'CLV-008',
                'id_alumno'             => 8,
                'cal'                   => 'Cal actividades complementarias 8',
            ],
            [
                'id_actividades_comple' => 9,
                'clave'                 => 'CLV-009',
                'id_alumno'             => 9,
                'cal'                   => 'Cal actividades complementarias 9',
            ],
            [
                'id_actividades_comple' => 10,
                'clave'                 => 'CLV-010',
                'id_alumno'             => 10,
                'cal'                   => 'Cal actividades complementarias 10',
            ],
            [
                'id_actividades_comple' => 11,
                'clave'                 => 'CLV-011',
                'id_alumno'             => 11,
                'cal'                   => 'Cal actividades complementarias 11',
            ],
            [
                'id_actividades_comple' => 12,
                'clave'                 => 'CLV-012',
                'id_alumno'             => 12,
                'cal'                   => 'Cal actividades complementarias 12',
            ],
            [
                'id_actividades_comple' => 13,
                'clave'                 => 'CLV-013',
                'id_alumno'             => 13,
                'cal'                   => 'Cal actividades complementarias 13',
            ],
            [
                'id_actividades_comple' => 14,
                'clave'                 => 'CLV-014',
                'id_alumno'             => 14,
                'cal'                   => 'Cal actividades complementarias 14',
            ],
            [
                'id_actividades_comple' => 15,
                'clave'                 => 'CLV-015',
                'id_alumno'             => 15,
                'cal'                   => 'Cal actividades complementarias 15',
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
