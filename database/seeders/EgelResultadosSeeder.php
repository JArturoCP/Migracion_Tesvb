<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_resultados`.
 */
class EgelResultadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_resultados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'egel_resultados';

        $llaves = [
            ['id_resultado'],
        ];

        $registros = [
            [
                'id_resultado'         => 1,
                'id_alumno'            => 1,
                'calificacion_general' => 6.5,
                'nivel'                => 'Nivel resultados 1',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'id_examen_egel'       => 1,
            ],
            [
                'id_resultado'         => 2,
                'id_alumno'            => 2,
                'calificacion_general' => 7.0,
                'nivel'                => 'Nivel resultados 2',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'id_examen_egel'       => 2,
            ],
            [
                'id_resultado'         => 3,
                'id_alumno'            => 3,
                'calificacion_general' => 7.5,
                'nivel'                => 'Nivel resultados 3',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'id_examen_egel'       => 3,
            ],
            [
                'id_resultado'         => 4,
                'id_alumno'            => 4,
                'calificacion_general' => 8.0,
                'nivel'                => 'Nivel resultados 4',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'id_examen_egel'       => 4,
            ],
            [
                'id_resultado'         => 5,
                'id_alumno'            => 5,
                'calificacion_general' => 8.5,
                'nivel'                => 'Nivel resultados 5',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'id_examen_egel'       => 5,
            ],
            [
                'id_resultado'         => 6,
                'id_alumno'            => 6,
                'calificacion_general' => 9.0,
                'nivel'                => 'Nivel resultados 6',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'id_examen_egel'       => 6,
            ],
            [
                'id_resultado'         => 7,
                'id_alumno'            => 7,
                'calificacion_general' => 9.5,
                'nivel'                => 'Nivel resultados 7',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'id_examen_egel'       => 7,
            ],
            [
                'id_resultado'         => 8,
                'id_alumno'            => 8,
                'calificacion_general' => 10.0,
                'nivel'                => 'Nivel resultados 8',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'id_examen_egel'       => 8,
            ],
            [
                'id_resultado'         => 9,
                'id_alumno'            => 9,
                'calificacion_general' => 6.0,
                'nivel'                => 'Nivel resultados 9',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'id_examen_egel'       => 9,
            ],
            [
                'id_resultado'         => 10,
                'id_alumno'            => 10,
                'calificacion_general' => 6.5,
                'nivel'                => 'Nivel resultados 10',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'id_examen_egel'       => 10,
            ],
            [
                'id_resultado'         => 11,
                'id_alumno'            => 11,
                'calificacion_general' => 7.0,
                'nivel'                => 'Nivel resultados 11',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'id_examen_egel'       => 11,
            ],
            [
                'id_resultado'         => 12,
                'id_alumno'            => 12,
                'calificacion_general' => 7.5,
                'nivel'                => 'Nivel resultados 12',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'id_examen_egel'       => 12,
            ],
            [
                'id_resultado'         => 13,
                'id_alumno'            => 13,
                'calificacion_general' => 8.0,
                'nivel'                => 'Nivel resultados 13',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'id_examen_egel'       => 13,
            ],
            [
                'id_resultado'         => 14,
                'id_alumno'            => 14,
                'calificacion_general' => 8.5,
                'nivel'                => 'Nivel resultados 14',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'id_examen_egel'       => 14,
            ],
            [
                'id_resultado'         => 15,
                'id_alumno'            => 15,
                'calificacion_general' => 9.0,
                'nivel'                => 'Nivel resultados 15',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'id_examen_egel'       => 15,
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
