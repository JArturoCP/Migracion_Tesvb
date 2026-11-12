<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_doc_empresa_publica`.
 */
class ServDocEmpresaPublicaSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_doc_empresa_publica` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            ServEstadoDocumentacionSeeder::class,
        ]);

        $tabla = 'serv_doc_empresa_publica';

        $llaves = [
            ['id_empresa_publica'],
        ];

        $registros = [
            [
                'id_empresa_publica'          => 1,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_1.pdf',
                'est_curp'                    => 1,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 1.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_1.pdf',
                'est_carnet'                  => 1,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 1.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_1.pdf',
                'est_constancia_creditos'     => 1,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 1.',
                'est_solicitud_reg_autori'    => 1,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 1.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_1.pdf',
                'id_alumno'                   => 1,
                'id_estado_documentacion'     => 1,
                'fecha'                       => '2026-01-05',
            ],
            [
                'id_empresa_publica'          => 2,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_2.pdf',
                'est_curp'                    => 2,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 2.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_2.pdf',
                'est_carnet'                  => 2,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 2.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_2.pdf',
                'est_constancia_creditos'     => 2,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 2.',
                'est_solicitud_reg_autori'    => 2,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 2.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_2.pdf',
                'id_alumno'                   => 2,
                'id_estado_documentacion'     => 2,
                'fecha'                       => '2026-01-14',
            ],
            [
                'id_empresa_publica'          => 3,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_3.pdf',
                'est_curp'                    => 3,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 3.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_3.pdf',
                'est_carnet'                  => 3,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 3.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_3.pdf',
                'est_constancia_creditos'     => 3,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 3.',
                'est_solicitud_reg_autori'    => 3,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 3.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_3.pdf',
                'id_alumno'                   => 3,
                'id_estado_documentacion'     => 3,
                'fecha'                       => '2026-01-23',
            ],
            [
                'id_empresa_publica'          => 4,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_4.pdf',
                'est_curp'                    => 4,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 4.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_4.pdf',
                'est_carnet'                  => 4,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 4.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_4.pdf',
                'est_constancia_creditos'     => 4,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 4.',
                'est_solicitud_reg_autori'    => 4,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 4.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_4.pdf',
                'id_alumno'                   => 4,
                'id_estado_documentacion'     => 4,
                'fecha'                       => '2026-02-01',
            ],
            [
                'id_empresa_publica'          => 5,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_5.pdf',
                'est_curp'                    => 5,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 5.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_5.pdf',
                'est_carnet'                  => 5,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 5.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_5.pdf',
                'est_constancia_creditos'     => 5,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 5.',
                'est_solicitud_reg_autori'    => 5,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 5.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_5.pdf',
                'id_alumno'                   => 5,
                'id_estado_documentacion'     => 5,
                'fecha'                       => '2026-02-10',
            ],
            [
                'id_empresa_publica'          => 6,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_6.pdf',
                'est_curp'                    => 6,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 6.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_6.pdf',
                'est_carnet'                  => 6,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 6.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_6.pdf',
                'est_constancia_creditos'     => 6,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 6.',
                'est_solicitud_reg_autori'    => 6,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 6.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_6.pdf',
                'id_alumno'                   => 6,
                'id_estado_documentacion'     => 6,
                'fecha'                       => '2026-02-19',
            ],
            [
                'id_empresa_publica'          => 7,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_7.pdf',
                'est_curp'                    => 7,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 7.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_7.pdf',
                'est_carnet'                  => 7,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 7.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_7.pdf',
                'est_constancia_creditos'     => 7,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 7.',
                'est_solicitud_reg_autori'    => 7,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 7.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_7.pdf',
                'id_alumno'                   => 7,
                'id_estado_documentacion'     => 7,
                'fecha'                       => '2026-02-28',
            ],
            [
                'id_empresa_publica'          => 8,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_8.pdf',
                'est_curp'                    => 8,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 8.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_8.pdf',
                'est_carnet'                  => 8,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 8.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_8.pdf',
                'est_constancia_creditos'     => 8,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 8.',
                'est_solicitud_reg_autori'    => 8,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 8.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_8.pdf',
                'id_alumno'                   => 8,
                'id_estado_documentacion'     => 8,
                'fecha'                       => '2026-03-09',
            ],
            [
                'id_empresa_publica'          => 9,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_9.pdf',
                'est_curp'                    => 9,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 9.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_9.pdf',
                'est_carnet'                  => 9,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 9.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_9.pdf',
                'est_constancia_creditos'     => 9,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 9.',
                'est_solicitud_reg_autori'    => 9,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 9.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_9.pdf',
                'id_alumno'                   => 9,
                'id_estado_documentacion'     => 9,
                'fecha'                       => '2026-03-18',
            ],
            [
                'id_empresa_publica'          => 10,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_10.pdf',
                'est_curp'                    => 10,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 10.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_10.pdf',
                'est_carnet'                  => 10,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 10.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_10.pdf',
                'est_constancia_creditos'     => 10,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 10.',
                'est_solicitud_reg_autori'    => 10,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 10.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_10.pdf',
                'id_alumno'                   => 10,
                'id_estado_documentacion'     => 10,
                'fecha'                       => '2026-03-27',
            ],
            [
                'id_empresa_publica'          => 11,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_11.pdf',
                'est_curp'                    => 11,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 11.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_11.pdf',
                'est_carnet'                  => 11,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 11.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_11.pdf',
                'est_constancia_creditos'     => 11,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 11.',
                'est_solicitud_reg_autori'    => 11,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 11.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_11.pdf',
                'id_alumno'                   => 11,
                'id_estado_documentacion'     => 11,
                'fecha'                       => '2026-04-05',
            ],
            [
                'id_empresa_publica'          => 12,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_12.pdf',
                'est_curp'                    => 12,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 12.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_12.pdf',
                'est_carnet'                  => 12,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 12.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_12.pdf',
                'est_constancia_creditos'     => 12,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 12.',
                'est_solicitud_reg_autori'    => 12,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 12.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_12.pdf',
                'id_alumno'                   => 12,
                'id_estado_documentacion'     => 12,
                'fecha'                       => '2026-04-14',
            ],
            [
                'id_empresa_publica'          => 13,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_13.pdf',
                'est_curp'                    => 13,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 13.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_13.pdf',
                'est_carnet'                  => 13,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 13.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_13.pdf',
                'est_constancia_creditos'     => 13,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 13.',
                'est_solicitud_reg_autori'    => 13,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 13.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_13.pdf',
                'id_alumno'                   => 13,
                'id_estado_documentacion'     => 13,
                'fecha'                       => '2026-04-23',
            ],
            [
                'id_empresa_publica'          => 14,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_14.pdf',
                'est_curp'                    => 14,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 14.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_14.pdf',
                'est_carnet'                  => 14,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 14.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_14.pdf',
                'est_constancia_creditos'     => 14,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 14.',
                'est_solicitud_reg_autori'    => 14,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 14.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_14.pdf',
                'id_alumno'                   => 14,
                'id_estado_documentacion'     => 14,
                'fecha'                       => '2026-05-02',
            ],
            [
                'id_empresa_publica'          => 15,
                'pdf_curp'                    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_15.pdf',
                'est_curp'                    => 15,
                'coment_curp'                 => 'Coment curp de doc empresa publica: registro de prueba número 15.',
                'pdf_carnet'                  => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_15.pdf',
                'est_carnet'                  => 15,
                'coment_carnet'               => 'Coment carnet de doc empresa publica: registro de prueba número 15.',
                'pdf_constancia_creditos'     => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_15.pdf',
                'est_constancia_creditos'     => 15,
                'coment_constancia_creditos'  => 'Coment constancia creditos de doc empresa publica: registro de prueba número 15.',
                'est_solicitud_reg_autori'    => 15,
                'coment_solicitud_reg_autori' => 'Coment solicitud reg autori de doc empresa publica: registro de prueba número 15.',
                'pdf_solicitud_reg_autori'    => 'documentos/serv_doc_empresa_publica/serv_doc_empresa_publica_15.pdf',
                'id_alumno'                   => 15,
                'id_estado_documentacion'     => 15,
                'fecha'                       => '2026-05-11',
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
