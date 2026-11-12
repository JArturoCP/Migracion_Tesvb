<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_constancia_presentacion_alumno`.
 */
class ServConstanciaPresentacionAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_constancia_presentacion_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'serv_constancia_presentacion_alumno';

        $llaves = [
            ['id_constancia_presentacion_alumno'],
        ];

        $registros = [
            [
                'id_constancia_presentacion_alumno' => 1,
                'id_alumno'                         => 1,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_1.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 1.',
                'fecha_registro'                    => '2026-01-05',
            ],
            [
                'id_constancia_presentacion_alumno' => 2,
                'id_alumno'                         => 2,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_2.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 2.',
                'fecha_registro'                    => '2026-01-14',
            ],
            [
                'id_constancia_presentacion_alumno' => 3,
                'id_alumno'                         => 3,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_3.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 3.',
                'fecha_registro'                    => '2026-01-23',
            ],
            [
                'id_constancia_presentacion_alumno' => 4,
                'id_alumno'                         => 4,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_4.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 4.',
                'fecha_registro'                    => '2026-02-01',
            ],
            [
                'id_constancia_presentacion_alumno' => 5,
                'id_alumno'                         => 5,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_5.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 5.',
                'fecha_registro'                    => '2026-02-10',
            ],
            [
                'id_constancia_presentacion_alumno' => 6,
                'id_alumno'                         => 6,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_6.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 6.',
                'fecha_registro'                    => '2026-02-19',
            ],
            [
                'id_constancia_presentacion_alumno' => 7,
                'id_alumno'                         => 7,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_7.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 7.',
                'fecha_registro'                    => '2026-02-28',
            ],
            [
                'id_constancia_presentacion_alumno' => 8,
                'id_alumno'                         => 8,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_8.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 8.',
                'fecha_registro'                    => '2026-03-09',
            ],
            [
                'id_constancia_presentacion_alumno' => 9,
                'id_alumno'                         => 9,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_9.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 9.',
                'fecha_registro'                    => '2026-03-18',
            ],
            [
                'id_constancia_presentacion_alumno' => 10,
                'id_alumno'                         => 10,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_10.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 10.',
                'fecha_registro'                    => '2026-03-27',
            ],
            [
                'id_constancia_presentacion_alumno' => 11,
                'id_alumno'                         => 11,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_11.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 11.',
                'fecha_registro'                    => '2026-04-05',
            ],
            [
                'id_constancia_presentacion_alumno' => 12,
                'id_alumno'                         => 12,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_12.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 12.',
                'fecha_registro'                    => '2026-04-14',
            ],
            [
                'id_constancia_presentacion_alumno' => 13,
                'id_alumno'                         => 13,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_13.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 13.',
                'fecha_registro'                    => '2026-04-23',
            ],
            [
                'id_constancia_presentacion_alumno' => 14,
                'id_alumno'                         => 14,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_14.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 14.',
                'fecha_registro'                    => '2026-05-02',
            ],
            [
                'id_constancia_presentacion_alumno' => 15,
                'id_alumno'                         => 15,
                'pdf_carta_presentacion'            => 'documentos/serv_constancia_presentacion_alumno/serv_constancia_presentacion_alumno_15.pdf',
                'comentario_departamento'           => 'Comentario departamento de constancia presentacion alumno: registro de prueba número 15.',
                'fecha_registro'                    => '2026-05-11',
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
