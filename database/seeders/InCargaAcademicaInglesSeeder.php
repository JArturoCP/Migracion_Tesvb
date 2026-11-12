<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_carga_academica_ingles`.
 */
class InCargaAcademicaInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_carga_academica_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralGruposSeeder::class,
            InPeriodosSeeder::class,
        ]);

        $tabla = 'in_carga_academica_ingles';

        $llaves = [
            ['id_carga_ingles'],
        ];

        $registros = [
            [
                'id_carga_ingles'   => 1,
                'id_alumno'         => 1,
                'id_nivel'          => 1,
                'id_grupo'          => 1,
                'id_periodo_ingles' => 1,
                'estado_nivel'      => 1,
            ],
            [
                'id_carga_ingles'   => 2,
                'id_alumno'         => 2,
                'id_nivel'          => 2,
                'id_grupo'          => 2,
                'id_periodo_ingles' => 2,
                'estado_nivel'      => 2,
            ],
            [
                'id_carga_ingles'   => 3,
                'id_alumno'         => 3,
                'id_nivel'          => 3,
                'id_grupo'          => 3,
                'id_periodo_ingles' => 3,
                'estado_nivel'      => 3,
            ],
            [
                'id_carga_ingles'   => 4,
                'id_alumno'         => 4,
                'id_nivel'          => 4,
                'id_grupo'          => 4,
                'id_periodo_ingles' => 4,
                'estado_nivel'      => 4,
            ],
            [
                'id_carga_ingles'   => 5,
                'id_alumno'         => 5,
                'id_nivel'          => 5,
                'id_grupo'          => 5,
                'id_periodo_ingles' => 5,
                'estado_nivel'      => 5,
            ],
            [
                'id_carga_ingles'   => 6,
                'id_alumno'         => 6,
                'id_nivel'          => 6,
                'id_grupo'          => 6,
                'id_periodo_ingles' => 6,
                'estado_nivel'      => 6,
            ],
            [
                'id_carga_ingles'   => 7,
                'id_alumno'         => 7,
                'id_nivel'          => 7,
                'id_grupo'          => 7,
                'id_periodo_ingles' => 7,
                'estado_nivel'      => 7,
            ],
            [
                'id_carga_ingles'   => 8,
                'id_alumno'         => 8,
                'id_nivel'          => 8,
                'id_grupo'          => 8,
                'id_periodo_ingles' => 8,
                'estado_nivel'      => 8,
            ],
            [
                'id_carga_ingles'   => 9,
                'id_alumno'         => 9,
                'id_nivel'          => 9,
                'id_grupo'          => 9,
                'id_periodo_ingles' => 9,
                'estado_nivel'      => 9,
            ],
            [
                'id_carga_ingles'   => 10,
                'id_alumno'         => 10,
                'id_nivel'          => 10,
                'id_grupo'          => 10,
                'id_periodo_ingles' => 10,
                'estado_nivel'      => 10,
            ],
            [
                'id_carga_ingles'   => 11,
                'id_alumno'         => 11,
                'id_nivel'          => 11,
                'id_grupo'          => 11,
                'id_periodo_ingles' => 11,
                'estado_nivel'      => 11,
            ],
            [
                'id_carga_ingles'   => 12,
                'id_alumno'         => 12,
                'id_nivel'          => 12,
                'id_grupo'          => 12,
                'id_periodo_ingles' => 12,
                'estado_nivel'      => 12,
            ],
            [
                'id_carga_ingles'   => 13,
                'id_alumno'         => 13,
                'id_nivel'          => 13,
                'id_grupo'          => 13,
                'id_periodo_ingles' => 13,
                'estado_nivel'      => 13,
            ],
            [
                'id_carga_ingles'   => 14,
                'id_alumno'         => 14,
                'id_nivel'          => 14,
                'id_grupo'          => 14,
                'id_periodo_ingles' => 14,
                'estado_nivel'      => 14,
            ],
            [
                'id_carga_ingles'   => 15,
                'id_alumno'         => 15,
                'id_nivel'          => 15,
                'id_grupo'          => 15,
                'id_periodo_ingles' => 15,
                'estado_nivel'      => 15,
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
