<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_seguimiento_act`.
 */
class InvSeguimientoActSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_seguimiento_act` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvEstadosMetasActSeeder::class,
            InvInformesSeeder::class,
        ]);

        $tabla = 'inv_seguimiento_act';

        $llaves = [
            ['id_seguimiento_act'],
        ];

        $registros = [
            [
                'id_seguimiento_act' => 1,
                'id_informe'         => 1,
                'id_estado_meta_act' => 1,
                'id_actividad'       => 1,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_1.pdf',
                'cantidad_lograda'   => 1,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 1.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 1.',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 2,
                'id_informe'         => 2,
                'id_estado_meta_act' => 2,
                'id_actividad'       => 2,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_2.pdf',
                'cantidad_lograda'   => 2,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 2.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 2.',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 3,
                'id_informe'         => 3,
                'id_estado_meta_act' => 3,
                'id_actividad'       => 3,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_3.pdf',
                'cantidad_lograda'   => 3,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 3.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 3.',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 4,
                'id_informe'         => 4,
                'id_estado_meta_act' => 4,
                'id_actividad'       => 4,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_4.pdf',
                'cantidad_lograda'   => 4,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 4.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 4.',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 5,
                'id_informe'         => 5,
                'id_estado_meta_act' => 5,
                'id_actividad'       => 5,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_5.pdf',
                'cantidad_lograda'   => 5,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 5.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 5.',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 6,
                'id_informe'         => 6,
                'id_estado_meta_act' => 6,
                'id_actividad'       => 6,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_6.pdf',
                'cantidad_lograda'   => 6,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 6.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 6.',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 7,
                'id_informe'         => 7,
                'id_estado_meta_act' => 7,
                'id_actividad'       => 7,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_7.pdf',
                'cantidad_lograda'   => 7,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 7.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 7.',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 8,
                'id_informe'         => 8,
                'id_estado_meta_act' => 8,
                'id_actividad'       => 8,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_8.pdf',
                'cantidad_lograda'   => 8,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 8.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 8.',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 9,
                'id_informe'         => 9,
                'id_estado_meta_act' => 9,
                'id_actividad'       => 9,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_9.pdf',
                'cantidad_lograda'   => 9,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 9.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 9.',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 10,
                'id_informe'         => 10,
                'id_estado_meta_act' => 10,
                'id_actividad'       => 10,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_10.pdf',
                'cantidad_lograda'   => 10,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 10.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 10.',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 11,
                'id_informe'         => 11,
                'id_estado_meta_act' => 11,
                'id_actividad'       => 11,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_11.pdf',
                'cantidad_lograda'   => 11,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 11.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 11.',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 12,
                'id_informe'         => 12,
                'id_estado_meta_act' => 12,
                'id_actividad'       => 12,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_12.pdf',
                'cantidad_lograda'   => 12,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 12.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 12.',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 13,
                'id_informe'         => 13,
                'id_estado_meta_act' => 13,
                'id_actividad'       => 13,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_13.pdf',
                'cantidad_lograda'   => 13,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 13.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 13.',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 14,
                'id_informe'         => 14,
                'id_estado_meta_act' => 14,
                'id_actividad'       => 14,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_14.pdf',
                'cantidad_lograda'   => 14,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 14.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 14.',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_seguimiento_act' => 15,
                'id_informe'         => 15,
                'id_estado_meta_act' => 15,
                'id_actividad'       => 15,
                'documento'          => 'documentos/inv_seguimiento_act/inv_seguimiento_act_15.pdf',
                'cantidad_lograda'   => 15,
                'justificacion'      => 'Justificacion de seguimiento act: registro de prueba número 15.',
                'comentario'         => 'Comentario de seguimiento act: registro de prueba número 15.',
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'deleted_at'         => null,
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
