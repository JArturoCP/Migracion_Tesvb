<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_reg_solicitud`.
 */
class ResiRegSolicitudSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_reg_solicitud` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_reg_solicitud';

        $llaves = [
            ['id_reg_solicitud'],
        ];

        $registros = [
            [
                'id_reg_solicitud'         => 1,
                'id_opcion_proyecto'       => 1,
                'rfc_empresa'              => 'HERM890618A1B',
                'colonia_empresa'          => 'Valle De Bravo',
                'codigo_postal_empresa'    => 'CLV-001',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 1',
                'telefono_empresa'         => '7262600001',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 1.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 1.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 1',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 1',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 1.',
                'no_seguro_estudiante'     => '12345678901',
                'telefono_estudiante'      => '7262600001',
                'id_anteproyecto'          => 1,
                'fecha_registro'           => '2026-01-05',
            ],
            [
                'id_reg_solicitud'         => 2,
                'id_opcion_proyecto'       => 2,
                'rfc_empresa'              => 'SACJ900719A2C',
                'colonia_empresa'          => 'Amanalco',
                'codigo_postal_empresa'    => 'CLV-002',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 2',
                'telefono_empresa'         => '7262600002',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 2.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 2.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 2',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 2',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 2.',
                'no_seguro_estudiante'     => '12345678902',
                'telefono_estudiante'      => '7262600002',
                'id_anteproyecto'          => 2,
                'fecha_registro'           => '2026-01-14',
            ],
            [
                'id_reg_solicitud'         => 3,
                'id_opcion_proyecto'       => 3,
                'rfc_empresa'              => 'JITD910820A3D',
                'colonia_empresa'          => 'Donato Guerra',
                'codigo_postal_empresa'    => 'CLV-003',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 3',
                'telefono_empresa'         => '7262600003',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 3.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 3.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 3',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 3',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 3.',
                'no_seguro_estudiante'     => '12345678903',
                'telefono_estudiante'      => '7262600003',
                'id_anteproyecto'          => 3,
                'fecha_registro'           => '2026-01-23',
            ],
            [
                'id_reg_solicitud'         => 4,
                'id_opcion_proyecto'       => 4,
                'rfc_empresa'              => 'PEAC720921A4E',
                'colonia_empresa'          => 'Villa De Allende',
                'codigo_postal_empresa'    => 'CLV-004',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 4',
                'telefono_empresa'         => '7262600004',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 4.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 4.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 4',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 4',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 4.',
                'no_seguro_estudiante'     => '12345678904',
                'telefono_estudiante'      => '7262600004',
                'id_anteproyecto'          => 4,
                'fecha_registro'           => '2026-02-01',
            ],
            [
                'id_reg_solicitud'         => 5,
                'id_opcion_proyecto'       => 5,
                'rfc_empresa'              => 'VANV731022A5F',
                'colonia_empresa'          => 'Temascaltepec',
                'codigo_postal_empresa'    => 'CLV-005',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 5',
                'telefono_empresa'         => '7262600005',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 5.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 5.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 5',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 5',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 5.',
                'no_seguro_estudiante'     => '12345678905',
                'telefono_estudiante'      => '7262600005',
                'id_anteproyecto'          => 5,
                'fecha_registro'           => '2026-02-10',
            ],
            [
                'id_reg_solicitud'         => 6,
                'id_opcion_proyecto'       => 6,
                'rfc_empresa'              => 'RORM741123A6G',
                'colonia_empresa'          => 'Ixtapan Del Oro',
                'codigo_postal_empresa'    => 'CLV-006',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 6',
                'telefono_empresa'         => '7262600006',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 6.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 6.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 6',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 6',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 6.',
                'no_seguro_estudiante'     => '12345678906',
                'telefono_estudiante'      => '7262600006',
                'id_anteproyecto'          => 6,
                'fecha_registro'           => '2026-02-19',
            ],
            [
                'id_reg_solicitud'         => 7,
                'id_opcion_proyecto'       => 7,
                'rfc_empresa'              => 'MORF751224A7H',
                'colonia_empresa'          => 'Santo Tomás',
                'codigo_postal_empresa'    => 'CLV-007',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 7',
                'telefono_empresa'         => '7262600007',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 7.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 7.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 7',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 7',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 7.',
                'no_seguro_estudiante'     => '12345678907',
                'telefono_estudiante'      => '7262600007',
                'id_anteproyecto'          => 7,
                'fecha_registro'           => '2026-02-28',
            ],
            [
                'id_reg_solicitud'         => 8,
                'id_opcion_proyecto'       => 8,
                'rfc_empresa'              => 'GOMJ760125A8I',
                'colonia_empresa'          => 'Otzoloapan',
                'codigo_postal_empresa'    => 'CLV-008',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 8',
                'telefono_empresa'         => '7262600008',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 8.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 8.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 8',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 8',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 8.',
                'no_seguro_estudiante'     => '12345678908',
                'telefono_estudiante'      => '7262600008',
                'id_anteproyecto'          => 8,
                'fecha_registro'           => '2026-03-09',
            ],
            [
                'id_reg_solicitud'         => 9,
                'id_opcion_proyecto'       => 9,
                'rfc_empresa'              => 'GOOA770226A9J',
                'colonia_empresa'          => 'Zacazonapan',
                'codigo_postal_empresa'    => 'CLV-009',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 9',
                'telefono_empresa'         => '7262600009',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 9.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 9.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 9',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 9',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 9.',
                'no_seguro_estudiante'     => '12345678909',
                'telefono_estudiante'      => '7262600009',
                'id_anteproyecto'          => 9,
                'fecha_registro'           => '2026-03-18',
            ],
            [
                'id_reg_solicitud'         => 10,
                'id_opcion_proyecto'       => 10,
                'rfc_empresa'              => 'LOMD780327A0K',
                'colonia_empresa'          => 'Villa Victoria',
                'codigo_postal_empresa'    => 'CLV-010',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 10',
                'telefono_empresa'         => '7262600010',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 10.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 10.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 10',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 10',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 10.',
                'no_seguro_estudiante'     => '12345678910',
                'telefono_estudiante'      => '7262600010',
                'id_anteproyecto'          => 10,
                'fecha_registro'           => '2026-03-27',
            ],
            [
                'id_reg_solicitud'         => 11,
                'id_opcion_proyecto'       => 11,
                'rfc_empresa'              => 'FORP790401A1L',
                'colonia_empresa'          => 'Almoloya De Juárez',
                'codigo_postal_empresa'    => 'CLV-011',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 11',
                'telefono_empresa'         => '7262600011',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 11.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 11.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 11',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 11',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 11.',
                'no_seguro_estudiante'     => '12345678911',
                'telefono_estudiante'      => '7262600011',
                'id_anteproyecto'          => 11,
                'fecha_registro'           => '2026-04-05',
            ],
            [
                'id_reg_solicitud'         => 12,
                'id_opcion_proyecto'       => 12,
                'rfc_empresa'              => 'MAHR800502A2M',
                'colonia_empresa'          => 'Toluca',
                'codigo_postal_empresa'    => 'CLV-012',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 12',
                'telefono_empresa'         => '7262600012',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 12.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 12.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 12',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 12',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 12.',
                'no_seguro_estudiante'     => '12345678912',
                'telefono_estudiante'      => '7262600012',
                'id_anteproyecto'          => 12,
                'fecha_registro'           => '2026-04-14',
            ],
            [
                'id_reg_solicitud'         => 13,
                'id_opcion_proyecto'       => 13,
                'rfc_empresa'              => 'CUVI810603A3N',
                'colonia_empresa'          => 'Zinacantepec',
                'codigo_postal_empresa'    => 'CLV-013',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 13',
                'telefono_empresa'         => '7262600013',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 13.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 13.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 13',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 13',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 13.',
                'no_seguro_estudiante'     => '12345678913',
                'telefono_estudiante'      => '7262600013',
                'id_anteproyecto'          => 13,
                'fecha_registro'           => '2026-04-23',
            ],
            [
                'id_reg_solicitud'         => 14,
                'id_opcion_proyecto'       => 14,
                'rfc_empresa'              => 'MARA820704A4O',
                'colonia_empresa'          => 'Tejupilco',
                'codigo_postal_empresa'    => 'CLV-014',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 14',
                'telefono_empresa'         => '7262600014',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 14.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 14.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 14',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 14',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 14.',
                'no_seguro_estudiante'     => '12345678914',
                'telefono_estudiante'      => '7262600014',
                'id_anteproyecto'          => 14,
                'fecha_registro'           => '2026-05-02',
            ],
            [
                'id_reg_solicitud'         => 15,
                'id_opcion_proyecto'       => 15,
                'rfc_empresa'              => 'CURL830805A5P',
                'colonia_empresa'          => 'San José Del Rincón',
                'codigo_postal_empresa'    => 'CLV-015',
                'ciudad_municipio_empresa' => 'Ciudad municipio empresa reg solicitud 15',
                'telefono_empresa'         => '7262600015',
                'mision_empresa'           => 'Mision empresa de reg solicitud: registro de prueba número 15.',
                'puesto_titular_empresa'   => 'Puesto titular empresa de reg solicitud: registro de prueba número 15.',
                'nombre_acuerdo_empresa'   => 'Nombre acuerdo empresa reg solicitud 15',
                'puesto_acuerdo_empresa'   => 'Puesto acuerdo empresa reg solicitud 15',
                'domiclio_estudiante'      => 'Domiclio estudiante de reg solicitud: registro de prueba número 15.',
                'no_seguro_estudiante'     => '12345678915',
                'telefono_estudiante'      => '7262600015',
                'id_anteproyecto'          => 15,
                'fecha_registro'           => '2026-05-11',
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
