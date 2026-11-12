<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_solicitudes`.
 */
class PresAutSolicitudesSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_solicitudes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresMesSeeder::class,
            PresMetasSeeder::class,
            PresProyectosSeeder::class,
        ]);

        $tabla = 'pres_aut_solicitudes';

        $llaves = [
            ['id_solicitud'],
        ];

        $registros = [
            [
                'id_solicitud'          => 1,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 1,
                'id_estado_enviado'     => 1,
                'numero_solicitud'      => 1,
                'id_proyecto'           => 1,
                'id_meta'               => 1,
                'id_mes'                => 1,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 1.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 1.',
                'fecha_registro'        => '2026-01-05',
                'fecha_modificacion'    => '2026-01-05',
                'fecha_enviado'         => '2026-01-05',
            ],
            [
                'id_solicitud'          => 2,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 2,
                'id_estado_enviado'     => 2,
                'numero_solicitud'      => 2,
                'id_proyecto'           => 2,
                'id_meta'               => 2,
                'id_mes'                => 2,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 2.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 2.',
                'fecha_registro'        => '2026-01-14',
                'fecha_modificacion'    => '2026-01-14',
                'fecha_enviado'         => '2026-01-14',
            ],
            [
                'id_solicitud'          => 3,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 3,
                'id_estado_enviado'     => 3,
                'numero_solicitud'      => 3,
                'id_proyecto'           => 3,
                'id_meta'               => 3,
                'id_mes'                => 3,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 3.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 3.',
                'fecha_registro'        => '2026-01-23',
                'fecha_modificacion'    => '2026-01-23',
                'fecha_enviado'         => '2026-01-23',
            ],
            [
                'id_solicitud'          => 4,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 4,
                'id_estado_enviado'     => 4,
                'numero_solicitud'      => 4,
                'id_proyecto'           => 4,
                'id_meta'               => 4,
                'id_mes'                => 4,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 4.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 4.',
                'fecha_registro'        => '2026-02-01',
                'fecha_modificacion'    => '2026-02-01',
                'fecha_enviado'         => '2026-02-01',
            ],
            [
                'id_solicitud'          => 5,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 5,
                'id_estado_enviado'     => 5,
                'numero_solicitud'      => 5,
                'id_proyecto'           => 5,
                'id_meta'               => 5,
                'id_mes'                => 5,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 5.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 5.',
                'fecha_registro'        => '2026-02-10',
                'fecha_modificacion'    => '2026-02-10',
                'fecha_enviado'         => '2026-02-10',
            ],
            [
                'id_solicitud'          => 6,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 6,
                'id_estado_enviado'     => 6,
                'numero_solicitud'      => 6,
                'id_proyecto'           => 6,
                'id_meta'               => 6,
                'id_mes'                => 6,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 6.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 6.',
                'fecha_registro'        => '2026-02-19',
                'fecha_modificacion'    => '2026-02-19',
                'fecha_enviado'         => '2026-02-19',
            ],
            [
                'id_solicitud'          => 7,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 7,
                'id_estado_enviado'     => 7,
                'numero_solicitud'      => 7,
                'id_proyecto'           => 7,
                'id_meta'               => 7,
                'id_mes'                => 7,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 7.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 7.',
                'fecha_registro'        => '2026-02-28',
                'fecha_modificacion'    => '2026-02-28',
                'fecha_enviado'         => '2026-02-28',
            ],
            [
                'id_solicitud'          => 8,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 8,
                'id_estado_enviado'     => 8,
                'numero_solicitud'      => 8,
                'id_proyecto'           => 8,
                'id_meta'               => 8,
                'id_mes'                => 8,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 8.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 8.',
                'fecha_registro'        => '2026-03-09',
                'fecha_modificacion'    => '2026-03-09',
                'fecha_enviado'         => '2026-03-09',
            ],
            [
                'id_solicitud'          => 9,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 9,
                'id_estado_enviado'     => 9,
                'numero_solicitud'      => 9,
                'id_proyecto'           => 9,
                'id_meta'               => 9,
                'id_mes'                => 9,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 9.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 9.',
                'fecha_registro'        => '2026-03-18',
                'fecha_modificacion'    => '2026-03-18',
                'fecha_enviado'         => '2026-03-18',
            ],
            [
                'id_solicitud'          => 10,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 10,
                'id_estado_enviado'     => 10,
                'numero_solicitud'      => 10,
                'id_proyecto'           => 10,
                'id_meta'               => 10,
                'id_mes'                => 10,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 10.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 10.',
                'fecha_registro'        => '2026-03-27',
                'fecha_modificacion'    => '2026-03-27',
                'fecha_enviado'         => '2026-03-27',
            ],
            [
                'id_solicitud'          => 11,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 11,
                'id_estado_enviado'     => 11,
                'numero_solicitud'      => 11,
                'id_proyecto'           => 11,
                'id_meta'               => 11,
                'id_mes'                => 11,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 11.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 11.',
                'fecha_registro'        => '2026-04-05',
                'fecha_modificacion'    => '2026-04-05',
                'fecha_enviado'         => '2026-04-05',
            ],
            [
                'id_solicitud'          => 12,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 12,
                'id_estado_enviado'     => 12,
                'numero_solicitud'      => 12,
                'id_proyecto'           => 12,
                'id_meta'               => 12,
                'id_mes'                => 12,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 12.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 12.',
                'fecha_registro'        => '2026-04-14',
                'fecha_modificacion'    => '2026-04-14',
                'fecha_enviado'         => '2026-04-14',
            ],
            [
                'id_solicitud'          => 13,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 13,
                'id_estado_enviado'     => 13,
                'numero_solicitud'      => 13,
                'id_proyecto'           => 13,
                'id_meta'               => 13,
                'id_mes'                => 13,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 13.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 13.',
                'fecha_registro'        => '2026-04-23',
                'fecha_modificacion'    => '2026-04-23',
                'fecha_enviado'         => '2026-04-23',
            ],
            [
                'id_solicitud'          => 14,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 14,
                'id_estado_enviado'     => 14,
                'numero_solicitud'      => 14,
                'id_proyecto'           => 14,
                'id_meta'               => 14,
                'id_mes'                => 14,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 14.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 14.',
                'fecha_registro'        => '2026-05-02',
                'fecha_modificacion'    => '2026-05-02',
                'fecha_enviado'         => '2026-05-02',
            ],
            [
                'id_solicitud'          => 15,
                'year_presupuesto'      => 2026,
                'id_unidad_admin'       => 15,
                'id_estado_enviado'     => 15,
                'numero_solicitud'      => 15,
                'id_proyecto'           => 15,
                'id_meta'               => 15,
                'id_mes'                => 15,
                'descripcion_solicitud' => 'Descripcion solicitud de aut solicitudes: registro de prueba número 15.',
                'comentario_solicitud'  => 'Comentario solicitud de aut solicitudes: registro de prueba número 15.',
                'fecha_registro'        => '2026-05-11',
                'fecha_modificacion'    => '2026-05-11',
                'fecha_enviado'         => '2026-05-11',
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
