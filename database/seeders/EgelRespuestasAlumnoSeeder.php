<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_respuestas_alumno`.
 */
class EgelRespuestasAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_respuestas_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
            EgelPreguntasSeeder::class,
            EgelRespuestasSeeder::class,
            EgelSeccionesSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'egel_respuestas_alumno';

        $llaves = [
            ['id_respuesta_alumno'],
            ['id_alumno', 'id_pregunta'],
        ];

        $registros = [
            [
                'id_respuesta_alumno' => 1,
                'id_alumno'           => 1,
                'id_seccion'          => 1,
                'id_pregunta'         => 1,
                'id_respuesta'        => 1,
                'es_correcta'         => 1,
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
                'id_examen_egel'      => 1,
            ],
            [
                'id_respuesta_alumno' => 2,
                'id_alumno'           => 2,
                'id_seccion'          => 2,
                'id_pregunta'         => 1,
                'id_respuesta'        => 2,
                'es_correcta'         => 1,
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
                'id_examen_egel'      => 2,
            ],
            [
                'id_respuesta_alumno' => 3,
                'id_alumno'           => 3,
                'id_seccion'          => 3,
                'id_pregunta'         => 1,
                'id_respuesta'        => 3,
                'es_correcta'         => 1,
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
                'id_examen_egel'      => 3,
            ],
            [
                'id_respuesta_alumno' => 4,
                'id_alumno'           => 4,
                'id_seccion'          => 4,
                'id_pregunta'         => 1,
                'id_respuesta'        => 4,
                'es_correcta'         => 1,
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
                'id_examen_egel'      => 4,
            ],
            [
                'id_respuesta_alumno' => 5,
                'id_alumno'           => 5,
                'id_seccion'          => 5,
                'id_pregunta'         => 1,
                'id_respuesta'        => 5,
                'es_correcta'         => 1,
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
                'id_examen_egel'      => 5,
            ],
            [
                'id_respuesta_alumno' => 6,
                'id_alumno'           => 6,
                'id_seccion'          => 6,
                'id_pregunta'         => 1,
                'id_respuesta'        => 6,
                'es_correcta'         => 1,
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
                'id_examen_egel'      => 6,
            ],
            [
                'id_respuesta_alumno' => 7,
                'id_alumno'           => 7,
                'id_seccion'          => 7,
                'id_pregunta'         => 1,
                'id_respuesta'        => 7,
                'es_correcta'         => 1,
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
                'id_examen_egel'      => 7,
            ],
            [
                'id_respuesta_alumno' => 8,
                'id_alumno'           => 8,
                'id_seccion'          => 8,
                'id_pregunta'         => 1,
                'id_respuesta'        => 8,
                'es_correcta'         => 1,
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
                'id_examen_egel'      => 8,
            ],
            [
                'id_respuesta_alumno' => 9,
                'id_alumno'           => 9,
                'id_seccion'          => 9,
                'id_pregunta'         => 1,
                'id_respuesta'        => 9,
                'es_correcta'         => 1,
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
                'id_examen_egel'      => 9,
            ],
            [
                'id_respuesta_alumno' => 10,
                'id_alumno'           => 10,
                'id_seccion'          => 10,
                'id_pregunta'         => 1,
                'id_respuesta'        => 10,
                'es_correcta'         => 1,
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
                'id_examen_egel'      => 10,
            ],
            [
                'id_respuesta_alumno' => 11,
                'id_alumno'           => 11,
                'id_seccion'          => 11,
                'id_pregunta'         => 1,
                'id_respuesta'        => 11,
                'es_correcta'         => 1,
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
                'id_examen_egel'      => 11,
            ],
            [
                'id_respuesta_alumno' => 12,
                'id_alumno'           => 12,
                'id_seccion'          => 12,
                'id_pregunta'         => 1,
                'id_respuesta'        => 12,
                'es_correcta'         => 1,
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
                'id_examen_egel'      => 12,
            ],
            [
                'id_respuesta_alumno' => 13,
                'id_alumno'           => 13,
                'id_seccion'          => 13,
                'id_pregunta'         => 1,
                'id_respuesta'        => 13,
                'es_correcta'         => 1,
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
                'id_examen_egel'      => 13,
            ],
            [
                'id_respuesta_alumno' => 14,
                'id_alumno'           => 14,
                'id_seccion'          => 14,
                'id_pregunta'         => 1,
                'id_respuesta'        => 14,
                'es_correcta'         => 1,
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
                'id_examen_egel'      => 14,
            ],
            [
                'id_respuesta_alumno' => 15,
                'id_alumno'           => 15,
                'id_seccion'          => 15,
                'id_pregunta'         => 1,
                'id_respuesta'        => 15,
                'es_correcta'         => 1,
                'created_at'          => '2026-05-11 14:00:00',
                'updated_at'          => '2026-05-11 14:00:00',
                'id_examen_egel'      => 15,
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
