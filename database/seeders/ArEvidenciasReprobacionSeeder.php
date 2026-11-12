<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_evidencias_reprobacion`.
 */
class ArEvidenciasReprobacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_evidencias_reprobacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArEstrategiasReprobacionSeeder::class,
            GnralPersonalesSeeder::class,
            UsersSeeder::class,
        ]);

        $tabla = 'ar_evidencias_reprobacion';

        $llaves = [
            ['id_ar_evidencia'],
        ];

        $registros = [
            [
                'id_ar_evidencia'   => 1,
                'id_ar_estrategia'  => 1,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_1.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_1.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 102400,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 1.',
                'id_usuario_subio'  => 1,
                'id_personal_subio' => 1,
                'created_at'        => '2026-01-05 09:00:00',
                'updated_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_evidencia'   => 2,
                'id_ar_estrategia'  => 2,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_2.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_2.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 204800,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 2.',
                'id_usuario_subio'  => 2,
                'id_personal_subio' => 2,
                'created_at'        => '2026-01-14 10:00:00',
                'updated_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_evidencia'   => 3,
                'id_ar_estrategia'  => 3,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_3.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_3.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 307200,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 3.',
                'id_usuario_subio'  => 3,
                'id_personal_subio' => 3,
                'created_at'        => '2026-01-23 11:00:00',
                'updated_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_evidencia'   => 4,
                'id_ar_estrategia'  => 4,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_4.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_4.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 409600,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 4.',
                'id_usuario_subio'  => 4,
                'id_personal_subio' => 4,
                'created_at'        => '2026-02-01 12:00:00',
                'updated_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_evidencia'   => 5,
                'id_ar_estrategia'  => 5,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_5.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_5.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 512000,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 5.',
                'id_usuario_subio'  => 5,
                'id_personal_subio' => 5,
                'created_at'        => '2026-02-10 13:00:00',
                'updated_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_evidencia'   => 6,
                'id_ar_estrategia'  => 6,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_6.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_6.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 614400,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 6.',
                'id_usuario_subio'  => 6,
                'id_personal_subio' => 6,
                'created_at'        => '2026-02-19 14:00:00',
                'updated_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_evidencia'   => 7,
                'id_ar_estrategia'  => 7,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_7.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_7.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 716800,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 7.',
                'id_usuario_subio'  => 7,
                'id_personal_subio' => 7,
                'created_at'        => '2026-02-28 15:00:00',
                'updated_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_evidencia'   => 8,
                'id_ar_estrategia'  => 8,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_8.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_8.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 819200,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 8.',
                'id_usuario_subio'  => 8,
                'id_personal_subio' => 8,
                'created_at'        => '2026-03-09 16:00:00',
                'updated_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_evidencia'   => 9,
                'id_ar_estrategia'  => 9,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_9.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_9.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 921600,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 9.',
                'id_usuario_subio'  => 9,
                'id_personal_subio' => 9,
                'created_at'        => '2026-03-18 08:00:00',
                'updated_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_evidencia'   => 10,
                'id_ar_estrategia'  => 10,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_10.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_10.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1024000,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 10.',
                'id_usuario_subio'  => 10,
                'id_personal_subio' => 10,
                'created_at'        => '2026-03-27 09:00:00',
                'updated_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_evidencia'   => 11,
                'id_ar_estrategia'  => 11,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_11.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_11.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1126400,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 11.',
                'id_usuario_subio'  => 11,
                'id_personal_subio' => 11,
                'created_at'        => '2026-04-05 10:00:00',
                'updated_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_evidencia'   => 12,
                'id_ar_estrategia'  => 12,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_12.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_12.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1228800,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 12.',
                'id_usuario_subio'  => 12,
                'id_personal_subio' => 12,
                'created_at'        => '2026-04-14 11:00:00',
                'updated_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_evidencia'   => 13,
                'id_ar_estrategia'  => 13,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_13.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_13.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1331200,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 13.',
                'id_usuario_subio'  => 13,
                'id_personal_subio' => 13,
                'created_at'        => '2026-04-23 12:00:00',
                'updated_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_evidencia'   => 14,
                'id_ar_estrategia'  => 14,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_14.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_14.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1433600,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 14.',
                'id_usuario_subio'  => 14,
                'id_personal_subio' => 14,
                'created_at'        => '2026-05-02 13:00:00',
                'updated_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_evidencia'   => 15,
                'id_ar_estrategia'  => 15,
                'ruta_archivo'      => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_15.pdf',
                'nombre_original'   => 'documentos/ar_evidencias_reprobacion/ar_evidencias_reprobacion_15.pdf',
                'extension'         => 'pdf',
                'mime'              => 'application/pdf',
                'size_bytes'        => 1536000,
                'observaciones'     => 'Observaciones de evidencias reprobacion: registro de prueba número 15.',
                'id_usuario_subio'  => 15,
                'id_personal_subio' => 15,
                'created_at'        => '2026-05-11 14:00:00',
                'updated_at'        => '2026-05-11 14:00:00',
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
