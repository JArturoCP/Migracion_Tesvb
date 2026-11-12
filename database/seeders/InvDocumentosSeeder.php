<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_documentos`.
 */
class InvDocumentosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_documentos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_documentos';

        $llaves = [
            ['id_documento'],
        ];

        $registros = [
            [
                'id_documento'     => 1,
                'propietario_id'   => 1,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 1',
                'mime'             => 'application/pdf',
                'size'             => 1,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_1.pdf',
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 2,
                'propietario_id'   => 2,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 2',
                'mime'             => 'application/pdf',
                'size'             => 2,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_2.pdf',
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 3,
                'propietario_id'   => 3,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 3',
                'mime'             => 'application/pdf',
                'size'             => 3,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_3.pdf',
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 4,
                'propietario_id'   => 4,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 4',
                'mime'             => 'application/pdf',
                'size'             => 4,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_4.pdf',
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 5,
                'propietario_id'   => 5,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 5',
                'mime'             => 'application/pdf',
                'size'             => 5,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_5.pdf',
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 6,
                'propietario_id'   => 6,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 6',
                'mime'             => 'application/pdf',
                'size'             => 6,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_6.pdf',
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 7,
                'propietario_id'   => 7,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 7',
                'mime'             => 'application/pdf',
                'size'             => 7,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_7.pdf',
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 8,
                'propietario_id'   => 8,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 8',
                'mime'             => 'application/pdf',
                'size'             => 8,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_8.pdf',
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 9,
                'propietario_id'   => 9,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 9',
                'mime'             => 'application/pdf',
                'size'             => 9,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_9.pdf',
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 10,
                'propietario_id'   => 10,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 10',
                'mime'             => 'application/pdf',
                'size'             => 10,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_10.pdf',
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 11,
                'propietario_id'   => 11,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 11',
                'mime'             => 'application/pdf',
                'size'             => 11,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_11.pdf',
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 12,
                'propietario_id'   => 12,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 12',
                'mime'             => 'application/pdf',
                'size'             => 12,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_12.pdf',
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 13,
                'propietario_id'   => 13,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 13',
                'mime'             => 'application/pdf',
                'size'             => 13,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_13.pdf',
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 14,
                'propietario_id'   => 14,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 14',
                'mime'             => 'application/pdf',
                'size'             => 14,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_14.pdf',
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_documento'     => 15,
                'propietario_id'   => 15,
                'propietario_type' => 'App\\User',
                'nombre'           => 'Nombre documentos 15',
                'mime'             => 'application/pdf',
                'size'             => 15,
                'extension'        => 'pdf',
                'ruta'             => 'documentos/inv_documentos/inv_documentos_15.pdf',
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'deleted_at'       => null,
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
