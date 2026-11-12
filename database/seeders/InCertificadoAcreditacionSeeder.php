<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_certificado_acreditacion`.
 */
class InCertificadoAcreditacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_certificado_acreditacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'in_certificado_acreditacion';

        $llaves = [
            ['id_certificado_acreditacion'],
        ];

        $registros = [
            [
                'id_certificado_acreditacion' => 1,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_1.pdf',
                'id_alumno'                   => 1,
                'fecha_registro'              => '2026-01-05',
                'enviado'                     => 1,
                'fecha_envio'                 => '2026-01-05',
            ],
            [
                'id_certificado_acreditacion' => 2,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_2.pdf',
                'id_alumno'                   => 2,
                'fecha_registro'              => '2026-01-14',
                'enviado'                     => 2,
                'fecha_envio'                 => '2026-01-14',
            ],
            [
                'id_certificado_acreditacion' => 3,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_3.pdf',
                'id_alumno'                   => 3,
                'fecha_registro'              => '2026-01-23',
                'enviado'                     => 3,
                'fecha_envio'                 => '2026-01-23',
            ],
            [
                'id_certificado_acreditacion' => 4,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_4.pdf',
                'id_alumno'                   => 4,
                'fecha_registro'              => '2026-02-01',
                'enviado'                     => 4,
                'fecha_envio'                 => '2026-02-01',
            ],
            [
                'id_certificado_acreditacion' => 5,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_5.pdf',
                'id_alumno'                   => 5,
                'fecha_registro'              => '2026-02-10',
                'enviado'                     => 5,
                'fecha_envio'                 => '2026-02-10',
            ],
            [
                'id_certificado_acreditacion' => 6,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_6.pdf',
                'id_alumno'                   => 6,
                'fecha_registro'              => '2026-02-19',
                'enviado'                     => 6,
                'fecha_envio'                 => '2026-02-19',
            ],
            [
                'id_certificado_acreditacion' => 7,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_7.pdf',
                'id_alumno'                   => 7,
                'fecha_registro'              => '2026-02-28',
                'enviado'                     => 7,
                'fecha_envio'                 => '2026-02-28',
            ],
            [
                'id_certificado_acreditacion' => 8,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_8.pdf',
                'id_alumno'                   => 8,
                'fecha_registro'              => '2026-03-09',
                'enviado'                     => 8,
                'fecha_envio'                 => '2026-03-09',
            ],
            [
                'id_certificado_acreditacion' => 9,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_9.pdf',
                'id_alumno'                   => 9,
                'fecha_registro'              => '2026-03-18',
                'enviado'                     => 9,
                'fecha_envio'                 => '2026-03-18',
            ],
            [
                'id_certificado_acreditacion' => 10,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_10.pdf',
                'id_alumno'                   => 10,
                'fecha_registro'              => '2026-03-27',
                'enviado'                     => 10,
                'fecha_envio'                 => '2026-03-27',
            ],
            [
                'id_certificado_acreditacion' => 11,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_11.pdf',
                'id_alumno'                   => 11,
                'fecha_registro'              => '2026-04-05',
                'enviado'                     => 11,
                'fecha_envio'                 => '2026-04-05',
            ],
            [
                'id_certificado_acreditacion' => 12,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_12.pdf',
                'id_alumno'                   => 12,
                'fecha_registro'              => '2026-04-14',
                'enviado'                     => 12,
                'fecha_envio'                 => '2026-04-14',
            ],
            [
                'id_certificado_acreditacion' => 13,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_13.pdf',
                'id_alumno'                   => 13,
                'fecha_registro'              => '2026-04-23',
                'enviado'                     => 13,
                'fecha_envio'                 => '2026-04-23',
            ],
            [
                'id_certificado_acreditacion' => 14,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_14.pdf',
                'id_alumno'                   => 14,
                'fecha_registro'              => '2026-05-02',
                'enviado'                     => 14,
                'fecha_envio'                 => '2026-05-02',
            ],
            [
                'id_certificado_acreditacion' => 15,
                'pdf_certificado'             => 'documentos/in_certificado_acreditacion/in_certificado_acreditacion_15.pdf',
                'id_alumno'                   => 15,
                'fecha_registro'              => '2026-05-11',
                'enviado'                     => 15,
                'fecha_envio'                 => '2026-05-11',
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
