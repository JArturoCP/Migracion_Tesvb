<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_maximo_grupo_ingles`.
 */
class InMaximoGrupoInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_maximo_grupo_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InPeriodosSeeder::class,
        ]);

        $tabla = 'in_maximo_grupo_ingles';

        $llaves = [
            ['id_maximo_grupo_ingles'],
        ];

        $registros = [
            [
                'id_maximo_grupo_ingles' => 1,
                'id_periodo_ingles'      => 1,
                'num_maximo_alumnos'     => 'TESVB-2026-0001',
            ],
            [
                'id_maximo_grupo_ingles' => 2,
                'id_periodo_ingles'      => 2,
                'num_maximo_alumnos'     => 'TESVB-2026-0002',
            ],
            [
                'id_maximo_grupo_ingles' => 3,
                'id_periodo_ingles'      => 3,
                'num_maximo_alumnos'     => 'TESVB-2026-0003',
            ],
            [
                'id_maximo_grupo_ingles' => 4,
                'id_periodo_ingles'      => 4,
                'num_maximo_alumnos'     => 'TESVB-2026-0004',
            ],
            [
                'id_maximo_grupo_ingles' => 5,
                'id_periodo_ingles'      => 5,
                'num_maximo_alumnos'     => 'TESVB-2026-0005',
            ],
            [
                'id_maximo_grupo_ingles' => 6,
                'id_periodo_ingles'      => 6,
                'num_maximo_alumnos'     => 'TESVB-2026-0006',
            ],
            [
                'id_maximo_grupo_ingles' => 7,
                'id_periodo_ingles'      => 7,
                'num_maximo_alumnos'     => 'TESVB-2026-0007',
            ],
            [
                'id_maximo_grupo_ingles' => 8,
                'id_periodo_ingles'      => 8,
                'num_maximo_alumnos'     => 'TESVB-2026-0008',
            ],
            [
                'id_maximo_grupo_ingles' => 9,
                'id_periodo_ingles'      => 9,
                'num_maximo_alumnos'     => 'TESVB-2026-0009',
            ],
            [
                'id_maximo_grupo_ingles' => 10,
                'id_periodo_ingles'      => 10,
                'num_maximo_alumnos'     => 'TESVB-2026-0010',
            ],
            [
                'id_maximo_grupo_ingles' => 11,
                'id_periodo_ingles'      => 11,
                'num_maximo_alumnos'     => 'TESVB-2026-0011',
            ],
            [
                'id_maximo_grupo_ingles' => 12,
                'id_periodo_ingles'      => 12,
                'num_maximo_alumnos'     => 'TESVB-2026-0012',
            ],
            [
                'id_maximo_grupo_ingles' => 13,
                'id_periodo_ingles'      => 13,
                'num_maximo_alumnos'     => 'TESVB-2026-0013',
            ],
            [
                'id_maximo_grupo_ingles' => 14,
                'id_periodo_ingles'      => 14,
                'num_maximo_alumnos'     => 'TESVB-2026-0014',
            ],
            [
                'id_maximo_grupo_ingles' => 15,
                'id_periodo_ingles'      => 15,
                'num_maximo_alumnos'     => 'TESVB-2026-0015',
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
