<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `p45`.
 */
class P45Seeder extends Seeder
{
    /**
     * Pobla la tabla `p45` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaAlumnoMateriasSeeder::class,
        ]);

        $tabla = 'p45';

        $llaves = [
            ['id_registro'],
        ];

        $registros = [
            [
                'id_registro'       => 1,
                'id_alumno_materia' => 1,
                'valor'             => 1,
            ],
            [
                'id_registro'       => 2,
                'id_alumno_materia' => 2,
                'valor'             => 2,
            ],
            [
                'id_registro'       => 3,
                'id_alumno_materia' => 3,
                'valor'             => 3,
            ],
            [
                'id_registro'       => 4,
                'id_alumno_materia' => 4,
                'valor'             => 4,
            ],
            [
                'id_registro'       => 5,
                'id_alumno_materia' => 5,
                'valor'             => 5,
            ],
            [
                'id_registro'       => 6,
                'id_alumno_materia' => 6,
                'valor'             => 6,
            ],
            [
                'id_registro'       => 7,
                'id_alumno_materia' => 7,
                'valor'             => 7,
            ],
            [
                'id_registro'       => 8,
                'id_alumno_materia' => 8,
                'valor'             => 8,
            ],
            [
                'id_registro'       => 9,
                'id_alumno_materia' => 9,
                'valor'             => 9,
            ],
            [
                'id_registro'       => 10,
                'id_alumno_materia' => 10,
                'valor'             => 10,
            ],
            [
                'id_registro'       => 11,
                'id_alumno_materia' => 11,
                'valor'             => 11,
            ],
            [
                'id_registro'       => 12,
                'id_alumno_materia' => 12,
                'valor'             => 12,
            ],
            [
                'id_registro'       => 13,
                'id_alumno_materia' => 13,
                'valor'             => 13,
            ],
            [
                'id_registro'       => 14,
                'id_alumno_materia' => 14,
                'valor'             => 14,
            ],
            [
                'id_registro'       => 15,
                'id_alumno_materia' => 15,
                'valor'             => 15,
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
