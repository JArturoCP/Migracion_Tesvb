<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_respuestas`.
 */
class EgelRespuestasSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_respuestas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
            EgelPreguntasSeeder::class,
        ]);

        $tabla = 'egel_respuestas';

        $llaves = [
            ['id_respuesta'],
        ];

        $registros = [
            [
                'id_respuesta'   => 1,
                'id_pregunta'    => 1,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 1.',
                'es_correcta'    => 1,
                'orden'          => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'id_examen_egel' => 1,
            ],
            [
                'id_respuesta'   => 2,
                'id_pregunta'    => 2,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 2.',
                'es_correcta'    => 1,
                'orden'          => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'id_examen_egel' => 2,
            ],
            [
                'id_respuesta'   => 3,
                'id_pregunta'    => 3,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 3.',
                'es_correcta'    => 1,
                'orden'          => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'id_examen_egel' => 3,
            ],
            [
                'id_respuesta'   => 4,
                'id_pregunta'    => 4,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 4.',
                'es_correcta'    => 1,
                'orden'          => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'id_examen_egel' => 4,
            ],
            [
                'id_respuesta'   => 5,
                'id_pregunta'    => 5,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 5.',
                'es_correcta'    => 1,
                'orden'          => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'id_examen_egel' => 5,
            ],
            [
                'id_respuesta'   => 6,
                'id_pregunta'    => 6,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 6.',
                'es_correcta'    => 1,
                'orden'          => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'id_examen_egel' => 6,
            ],
            [
                'id_respuesta'   => 7,
                'id_pregunta'    => 7,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 7.',
                'es_correcta'    => 1,
                'orden'          => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'id_examen_egel' => 7,
            ],
            [
                'id_respuesta'   => 8,
                'id_pregunta'    => 8,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 8.',
                'es_correcta'    => 1,
                'orden'          => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'id_examen_egel' => 8,
            ],
            [
                'id_respuesta'   => 9,
                'id_pregunta'    => 9,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 9.',
                'es_correcta'    => 1,
                'orden'          => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'id_examen_egel' => 9,
            ],
            [
                'id_respuesta'   => 10,
                'id_pregunta'    => 10,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 10.',
                'es_correcta'    => 1,
                'orden'          => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'id_examen_egel' => 10,
            ],
            [
                'id_respuesta'   => 11,
                'id_pregunta'    => 11,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 11.',
                'es_correcta'    => 1,
                'orden'          => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'id_examen_egel' => 11,
            ],
            [
                'id_respuesta'   => 12,
                'id_pregunta'    => 12,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 12.',
                'es_correcta'    => 1,
                'orden'          => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'id_examen_egel' => 12,
            ],
            [
                'id_respuesta'   => 13,
                'id_pregunta'    => 13,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 13.',
                'es_correcta'    => 1,
                'orden'          => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'id_examen_egel' => 13,
            ],
            [
                'id_respuesta'   => 14,
                'id_pregunta'    => 14,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 14.',
                'es_correcta'    => 1,
                'orden'          => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'id_examen_egel' => 14,
            ],
            [
                'id_respuesta'   => 15,
                'id_pregunta'    => 15,
                'respuesta'      => 'Respuesta de respuestas: registro de prueba número 15.',
                'es_correcta'    => 1,
                'orden'          => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'id_examen_egel' => 15,
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
