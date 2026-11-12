<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_constancia_presentacion`.
 */
class ServConstanciaPresentacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_constancia_presentacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            ServPeriodosSeeder::class,
        ]);

        $tabla = 'serv_constancia_presentacion';

        $llaves = [
            ['id_constancia_presentacion'],
        ];

        $registros = [
            [
                'id_constancia_presentacion'  => 1,
                'id_estado_envio'             => 1,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 1.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_1.pdf',
                'id_periodo'                  => 1,
                'id_alumno'                   => 1,
            ],
            [
                'id_constancia_presentacion'  => 2,
                'id_estado_envio'             => 2,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 2.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_2.pdf',
                'id_periodo'                  => 2,
                'id_alumno'                   => 2,
            ],
            [
                'id_constancia_presentacion'  => 3,
                'id_estado_envio'             => 3,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 3.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_3.pdf',
                'id_periodo'                  => 3,
                'id_alumno'                   => 3,
            ],
            [
                'id_constancia_presentacion'  => 4,
                'id_estado_envio'             => 4,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 4.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_4.pdf',
                'id_periodo'                  => 4,
                'id_alumno'                   => 4,
            ],
            [
                'id_constancia_presentacion'  => 5,
                'id_estado_envio'             => 5,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 5.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_5.pdf',
                'id_periodo'                  => 5,
                'id_alumno'                   => 5,
            ],
            [
                'id_constancia_presentacion'  => 6,
                'id_estado_envio'             => 6,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 6.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_6.pdf',
                'id_periodo'                  => 6,
                'id_alumno'                   => 6,
            ],
            [
                'id_constancia_presentacion'  => 7,
                'id_estado_envio'             => 7,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 7.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_7.pdf',
                'id_periodo'                  => 7,
                'id_alumno'                   => 7,
            ],
            [
                'id_constancia_presentacion'  => 8,
                'id_estado_envio'             => 8,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 8.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_8.pdf',
                'id_periodo'                  => 8,
                'id_alumno'                   => 8,
            ],
            [
                'id_constancia_presentacion'  => 9,
                'id_estado_envio'             => 9,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 9.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_9.pdf',
                'id_periodo'                  => 9,
                'id_alumno'                   => 9,
            ],
            [
                'id_constancia_presentacion'  => 10,
                'id_estado_envio'             => 10,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 10.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_10.pdf',
                'id_periodo'                  => 10,
                'id_alumno'                   => 10,
            ],
            [
                'id_constancia_presentacion'  => 11,
                'id_estado_envio'             => 11,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 11.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_11.pdf',
                'id_periodo'                  => 11,
                'id_alumno'                   => 11,
            ],
            [
                'id_constancia_presentacion'  => 12,
                'id_estado_envio'             => 12,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 12.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_12.pdf',
                'id_periodo'                  => 12,
                'id_alumno'                   => 12,
            ],
            [
                'id_constancia_presentacion'  => 13,
                'id_estado_envio'             => 13,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 13.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_13.pdf',
                'id_periodo'                  => 13,
                'id_alumno'                   => 13,
            ],
            [
                'id_constancia_presentacion'  => 14,
                'id_estado_envio'             => 14,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 14.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_14.pdf',
                'id_periodo'                  => 14,
                'id_alumno'                   => 14,
            ],
            [
                'id_constancia_presentacion'  => 15,
                'id_estado_envio'             => 15,
                'comentario'                  => 'Comentario de constancia presentacion: registro de prueba número 15.',
                'pdf_constancia_presentacion' => 'documentos/serv_constancia_presentacion/serv_constancia_presentacion_15.pdf',
                'id_periodo'                  => 15,
                'id_alumno'                   => 15,
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
