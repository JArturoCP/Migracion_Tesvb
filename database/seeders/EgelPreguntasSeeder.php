<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_preguntas`.
 */
class EgelPreguntasSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_preguntas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
            EgelModulosSeeder::class,
            EgelSeccionesSeeder::class,
        ]);

        $tabla = 'egel_preguntas';

        $llaves = [
            ['id_pregunta'],
        ];

        $registros = [
            [
                'id_pregunta'     => 1,
                'id_seccion'      => 1,
                'id_modulo'       => 1,
                'numero_pregunta' => 1,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 1.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_1.pdf',
                'tipo'            => 'opcion_multiple',
                'activo'          => 1,
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'id_examen_egel'  => 1,
                'valor'           => 6.5,
            ],
            [
                'id_pregunta'     => 2,
                'id_seccion'      => 2,
                'id_modulo'       => 2,
                'numero_pregunta' => 2,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 2.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_2.pdf',
                'tipo'            => 'verdadero_falso',
                'activo'          => 1,
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'id_examen_egel'  => 2,
                'valor'           => 7.0,
            ],
            [
                'id_pregunta'     => 3,
                'id_seccion'      => 3,
                'id_modulo'       => 3,
                'numero_pregunta' => 3,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 3.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_3.pdf',
                'tipo'            => 'caso',
                'activo'          => 1,
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'id_examen_egel'  => 3,
                'valor'           => 7.5,
            ],
            [
                'id_pregunta'     => 4,
                'id_seccion'      => 4,
                'id_modulo'       => 4,
                'numero_pregunta' => 4,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 4.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_4.pdf',
                'tipo'            => 'opcion_multiple',
                'activo'          => 1,
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'id_examen_egel'  => 4,
                'valor'           => 8.0,
            ],
            [
                'id_pregunta'     => 5,
                'id_seccion'      => 5,
                'id_modulo'       => 5,
                'numero_pregunta' => 5,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 5.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_5.pdf',
                'tipo'            => 'verdadero_falso',
                'activo'          => 1,
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'id_examen_egel'  => 5,
                'valor'           => 8.5,
            ],
            [
                'id_pregunta'     => 6,
                'id_seccion'      => 6,
                'id_modulo'       => 6,
                'numero_pregunta' => 6,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 6.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_6.pdf',
                'tipo'            => 'caso',
                'activo'          => 1,
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'id_examen_egel'  => 6,
                'valor'           => 9.0,
            ],
            [
                'id_pregunta'     => 7,
                'id_seccion'      => 7,
                'id_modulo'       => 7,
                'numero_pregunta' => 7,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 7.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_7.pdf',
                'tipo'            => 'opcion_multiple',
                'activo'          => 1,
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'id_examen_egel'  => 7,
                'valor'           => 9.5,
            ],
            [
                'id_pregunta'     => 8,
                'id_seccion'      => 8,
                'id_modulo'       => 8,
                'numero_pregunta' => 8,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 8.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_8.pdf',
                'tipo'            => 'verdadero_falso',
                'activo'          => 1,
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'id_examen_egel'  => 8,
                'valor'           => 10.0,
            ],
            [
                'id_pregunta'     => 9,
                'id_seccion'      => 9,
                'id_modulo'       => 9,
                'numero_pregunta' => 9,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 9.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_9.pdf',
                'tipo'            => 'caso',
                'activo'          => 1,
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'id_examen_egel'  => 9,
                'valor'           => 6.0,
            ],
            [
                'id_pregunta'     => 10,
                'id_seccion'      => 10,
                'id_modulo'       => 10,
                'numero_pregunta' => 10,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 10.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_10.pdf',
                'tipo'            => 'opcion_multiple',
                'activo'          => 1,
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'id_examen_egel'  => 10,
                'valor'           => 6.5,
            ],
            [
                'id_pregunta'     => 11,
                'id_seccion'      => 11,
                'id_modulo'       => 11,
                'numero_pregunta' => 11,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 11.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_11.pdf',
                'tipo'            => 'verdadero_falso',
                'activo'          => 1,
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'id_examen_egel'  => 11,
                'valor'           => 7.0,
            ],
            [
                'id_pregunta'     => 12,
                'id_seccion'      => 12,
                'id_modulo'       => 12,
                'numero_pregunta' => 12,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 12.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_12.pdf',
                'tipo'            => 'caso',
                'activo'          => 1,
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'id_examen_egel'  => 12,
                'valor'           => 7.5,
            ],
            [
                'id_pregunta'     => 13,
                'id_seccion'      => 13,
                'id_modulo'       => 13,
                'numero_pregunta' => 13,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 13.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_13.pdf',
                'tipo'            => 'opcion_multiple',
                'activo'          => 1,
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'id_examen_egel'  => 13,
                'valor'           => 8.0,
            ],
            [
                'id_pregunta'     => 14,
                'id_seccion'      => 14,
                'id_modulo'       => 14,
                'numero_pregunta' => 14,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 14.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_14.pdf',
                'tipo'            => 'verdadero_falso',
                'activo'          => 1,
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'id_examen_egel'  => 14,
                'valor'           => 8.5,
            ],
            [
                'id_pregunta'     => 15,
                'id_seccion'      => 15,
                'id_modulo'       => 15,
                'numero_pregunta' => 15,
                'pregunta'        => 'Pregunta de preguntas: registro de prueba número 15.',
                'imagen'          => 'documentos/egel_preguntas/egel_preguntas_15.pdf',
                'tipo'            => 'caso',
                'activo'          => 1,
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
                'id_examen_egel'  => 15,
                'valor'           => 9.0,
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
