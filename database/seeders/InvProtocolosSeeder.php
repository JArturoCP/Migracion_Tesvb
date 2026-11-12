<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_protocolos`.
 */
class InvProtocolosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_protocolos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvConvocatoriasSeeder::class,
            InvInvestigadoresSeeder::class,
            InvLineasSeeder::class,
        ]);

        $tabla = 'inv_protocolos';

        $llaves = [
            ['id_protocolo'],
        ];

        $registros = [
            [
                'id_protocolo'         => 1,
                'id_investigador'      => 1,
                'id_convocatoria'      => 1,
                'id_linea'             => 1,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 1.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 1.',
                'f_inicio'             => '2026-01-05',
                'f_fin'                => '2026-01-05',
                'clave_registro'       => 'CLV-001',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
                'estado'               => 1,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 1.',
                'fecha_ampliacion'     => '2026-01-05',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 1.',
            ],
            [
                'id_protocolo'         => 2,
                'id_investigador'      => 2,
                'id_convocatoria'      => 2,
                'id_linea'             => 2,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 2.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 2.',
                'f_inicio'             => '2026-01-14',
                'f_fin'                => '2026-01-14',
                'clave_registro'       => 'CLV-002',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
                'estado'               => 2,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 2.',
                'fecha_ampliacion'     => '2026-01-14',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 2.',
            ],
            [
                'id_protocolo'         => 3,
                'id_investigador'      => 3,
                'id_convocatoria'      => 3,
                'id_linea'             => 3,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 3.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 3.',
                'f_inicio'             => '2026-01-23',
                'f_fin'                => '2026-01-23',
                'clave_registro'       => 'CLV-003',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
                'estado'               => 3,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 3.',
                'fecha_ampliacion'     => '2026-01-23',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 3.',
            ],
            [
                'id_protocolo'         => 4,
                'id_investigador'      => 4,
                'id_convocatoria'      => 4,
                'id_linea'             => 4,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 4.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 4.',
                'f_inicio'             => '2026-02-01',
                'f_fin'                => '2026-02-01',
                'clave_registro'       => 'CLV-004',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
                'estado'               => 4,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 4.',
                'fecha_ampliacion'     => '2026-02-01',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 4.',
            ],
            [
                'id_protocolo'         => 5,
                'id_investigador'      => 5,
                'id_convocatoria'      => 5,
                'id_linea'             => 5,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 5.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 5.',
                'f_inicio'             => '2026-02-10',
                'f_fin'                => '2026-02-10',
                'clave_registro'       => 'CLV-005',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
                'estado'               => 5,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 5.',
                'fecha_ampliacion'     => '2026-02-10',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 5.',
            ],
            [
                'id_protocolo'         => 6,
                'id_investigador'      => 6,
                'id_convocatoria'      => 6,
                'id_linea'             => 6,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 6.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 6.',
                'f_inicio'             => '2026-02-19',
                'f_fin'                => '2026-02-19',
                'clave_registro'       => 'CLV-006',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
                'estado'               => 6,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 6.',
                'fecha_ampliacion'     => '2026-02-19',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 6.',
            ],
            [
                'id_protocolo'         => 7,
                'id_investigador'      => 7,
                'id_convocatoria'      => 7,
                'id_linea'             => 7,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 7.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 7.',
                'f_inicio'             => '2026-02-28',
                'f_fin'                => '2026-02-28',
                'clave_registro'       => 'CLV-007',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
                'estado'               => 7,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 7.',
                'fecha_ampliacion'     => '2026-02-28',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 7.',
            ],
            [
                'id_protocolo'         => 8,
                'id_investigador'      => 8,
                'id_convocatoria'      => 8,
                'id_linea'             => 8,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 8.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 8.',
                'f_inicio'             => '2026-03-09',
                'f_fin'                => '2026-03-09',
                'clave_registro'       => 'CLV-008',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
                'estado'               => 8,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 8.',
                'fecha_ampliacion'     => '2026-03-09',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 8.',
            ],
            [
                'id_protocolo'         => 9,
                'id_investigador'      => 9,
                'id_convocatoria'      => 9,
                'id_linea'             => 9,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 9.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 9.',
                'f_inicio'             => '2026-03-18',
                'f_fin'                => '2026-03-18',
                'clave_registro'       => 'CLV-009',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
                'estado'               => 9,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 9.',
                'fecha_ampliacion'     => '2026-03-18',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 9.',
            ],
            [
                'id_protocolo'         => 10,
                'id_investigador'      => 10,
                'id_convocatoria'      => 10,
                'id_linea'             => 10,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 10.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 10.',
                'f_inicio'             => '2026-03-27',
                'f_fin'                => '2026-03-27',
                'clave_registro'       => 'CLV-010',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
                'estado'               => 10,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 10.',
                'fecha_ampliacion'     => '2026-03-27',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 10.',
            ],
            [
                'id_protocolo'         => 11,
                'id_investigador'      => 11,
                'id_convocatoria'      => 11,
                'id_linea'             => 11,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 11.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 11.',
                'f_inicio'             => '2026-04-05',
                'f_fin'                => '2026-04-05',
                'clave_registro'       => 'CLV-011',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
                'estado'               => 11,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 11.',
                'fecha_ampliacion'     => '2026-04-05',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 11.',
            ],
            [
                'id_protocolo'         => 12,
                'id_investigador'      => 12,
                'id_convocatoria'      => 12,
                'id_linea'             => 12,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 12.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 12.',
                'f_inicio'             => '2026-04-14',
                'f_fin'                => '2026-04-14',
                'clave_registro'       => 'CLV-012',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
                'estado'               => 12,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 12.',
                'fecha_ampliacion'     => '2026-04-14',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 12.',
            ],
            [
                'id_protocolo'         => 13,
                'id_investigador'      => 13,
                'id_convocatoria'      => 13,
                'id_linea'             => 13,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 13.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 13.',
                'f_inicio'             => '2026-04-23',
                'f_fin'                => '2026-04-23',
                'clave_registro'       => 'CLV-013',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
                'estado'               => 13,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 13.',
                'fecha_ampliacion'     => '2026-04-23',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 13.',
            ],
            [
                'id_protocolo'         => 14,
                'id_investigador'      => 14,
                'id_convocatoria'      => 14,
                'id_linea'             => 14,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 14.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 14.',
                'f_inicio'             => '2026-05-02',
                'f_fin'                => '2026-05-02',
                'clave_registro'       => 'CLV-014',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
                'estado'               => 14,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 14.',
                'fecha_ampliacion'     => '2026-05-02',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 14.',
            ],
            [
                'id_protocolo'         => 15,
                'id_investigador'      => 15,
                'id_convocatoria'      => 15,
                'id_linea'             => 15,
                'titulo'               => 'Titulo de protocolos: registro de prueba número 15.',
                'resumen'              => 'Resumen de protocolos: registro de prueba número 15.',
                'f_inicio'             => '2026-05-11',
                'f_fin'                => '2026-05-11',
                'clave_registro'       => 'CLV-015',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'deleted_at'           => null,
                'estado'               => 15,
                'solicitar_ampliacion' => 'Solicitar ampliacion de protocolos: registro de prueba número 15.',
                'fecha_ampliacion'     => '2026-05-11',
                'acuerdo'              => 'Acuerdo de protocolos: registro de prueba número 15.',
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
