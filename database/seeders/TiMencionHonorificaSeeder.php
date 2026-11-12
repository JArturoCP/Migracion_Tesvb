<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_mencion_honorifica`.
 */
class TiMencionHonorificaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_mencion_honorifica` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'ti_mencion_honorifica';

        $llaves = [
            ['id_mencion_honorifica'],
        ];

        $registros = [
            [
                'id_mencion_honorifica' => 1,
                'no_registro'           => 1,
                'libro_registro'        => 1,
                'fecha_registro_dato'   => '2026-01-05',
                'id_alumno'             => 1,
            ],
            [
                'id_mencion_honorifica' => 2,
                'no_registro'           => 2,
                'libro_registro'        => 2,
                'fecha_registro_dato'   => '2026-01-14',
                'id_alumno'             => 2,
            ],
            [
                'id_mencion_honorifica' => 3,
                'no_registro'           => 3,
                'libro_registro'        => 3,
                'fecha_registro_dato'   => '2026-01-23',
                'id_alumno'             => 3,
            ],
            [
                'id_mencion_honorifica' => 4,
                'no_registro'           => 4,
                'libro_registro'        => 4,
                'fecha_registro_dato'   => '2026-02-01',
                'id_alumno'             => 4,
            ],
            [
                'id_mencion_honorifica' => 5,
                'no_registro'           => 5,
                'libro_registro'        => 5,
                'fecha_registro_dato'   => '2026-02-10',
                'id_alumno'             => 5,
            ],
            [
                'id_mencion_honorifica' => 6,
                'no_registro'           => 6,
                'libro_registro'        => 6,
                'fecha_registro_dato'   => '2026-02-19',
                'id_alumno'             => 6,
            ],
            [
                'id_mencion_honorifica' => 7,
                'no_registro'           => 7,
                'libro_registro'        => 7,
                'fecha_registro_dato'   => '2026-02-28',
                'id_alumno'             => 7,
            ],
            [
                'id_mencion_honorifica' => 8,
                'no_registro'           => 8,
                'libro_registro'        => 8,
                'fecha_registro_dato'   => '2026-03-09',
                'id_alumno'             => 8,
            ],
            [
                'id_mencion_honorifica' => 9,
                'no_registro'           => 9,
                'libro_registro'        => 9,
                'fecha_registro_dato'   => '2026-03-18',
                'id_alumno'             => 9,
            ],
            [
                'id_mencion_honorifica' => 10,
                'no_registro'           => 10,
                'libro_registro'        => 10,
                'fecha_registro_dato'   => '2026-03-27',
                'id_alumno'             => 10,
            ],
            [
                'id_mencion_honorifica' => 11,
                'no_registro'           => 11,
                'libro_registro'        => 11,
                'fecha_registro_dato'   => '2026-04-05',
                'id_alumno'             => 11,
            ],
            [
                'id_mencion_honorifica' => 12,
                'no_registro'           => 12,
                'libro_registro'        => 12,
                'fecha_registro_dato'   => '2026-04-14',
                'id_alumno'             => 12,
            ],
            [
                'id_mencion_honorifica' => 13,
                'no_registro'           => 13,
                'libro_registro'        => 13,
                'fecha_registro_dato'   => '2026-04-23',
                'id_alumno'             => 13,
            ],
            [
                'id_mencion_honorifica' => 14,
                'no_registro'           => 14,
                'libro_registro'        => 14,
                'fecha_registro_dato'   => '2026-05-02',
                'id_alumno'             => 14,
            ],
            [
                'id_mencion_honorifica' => 15,
                'no_registro'           => 15,
                'libro_registro'        => 15,
                'fecha_registro_dato'   => '2026-05-11',
                'id_alumno'             => 15,
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
