<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_seguimiento_metas`.
 */
class InvSeguimientoMetasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_seguimiento_metas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvEstadosMetasActSeeder::class,
            InvInformesSeeder::class,
        ]);

        $tabla = 'inv_seguimiento_metas';

        $llaves = [
            ['id_seguimiento_metas'],
        ];

        $registros = [
            [
                'id_seguimiento_metas' => 1,
                'id_informe'           => 1,
                'id_protprod'          => 1,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_1.pdf',
                'id_estado_meta_act'   => 1,
                'cantidad_lograda'     => 1,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 1.',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 2,
                'id_informe'           => 2,
                'id_protprod'          => 2,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_2.pdf',
                'id_estado_meta_act'   => 2,
                'cantidad_lograda'     => 2,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 2.',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 3,
                'id_informe'           => 3,
                'id_protprod'          => 3,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_3.pdf',
                'id_estado_meta_act'   => 3,
                'cantidad_lograda'     => 3,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 3.',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 4,
                'id_informe'           => 4,
                'id_protprod'          => 4,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_4.pdf',
                'id_estado_meta_act'   => 4,
                'cantidad_lograda'     => 4,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 4.',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 5,
                'id_informe'           => 5,
                'id_protprod'          => 5,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_5.pdf',
                'id_estado_meta_act'   => 5,
                'cantidad_lograda'     => 5,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 5.',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 6,
                'id_informe'           => 6,
                'id_protprod'          => 6,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_6.pdf',
                'id_estado_meta_act'   => 6,
                'cantidad_lograda'     => 6,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 6.',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 7,
                'id_informe'           => 7,
                'id_protprod'          => 7,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_7.pdf',
                'id_estado_meta_act'   => 7,
                'cantidad_lograda'     => 7,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 7.',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 8,
                'id_informe'           => 8,
                'id_protprod'          => 8,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_8.pdf',
                'id_estado_meta_act'   => 8,
                'cantidad_lograda'     => 8,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 8.',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 9,
                'id_informe'           => 9,
                'id_protprod'          => 9,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_9.pdf',
                'id_estado_meta_act'   => 9,
                'cantidad_lograda'     => 9,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 9.',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 10,
                'id_informe'           => 10,
                'id_protprod'          => 10,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_10.pdf',
                'id_estado_meta_act'   => 10,
                'cantidad_lograda'     => 10,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 10.',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 11,
                'id_informe'           => 11,
                'id_protprod'          => 11,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_11.pdf',
                'id_estado_meta_act'   => 11,
                'cantidad_lograda'     => 11,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 11.',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 12,
                'id_informe'           => 12,
                'id_protprod'          => 12,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_12.pdf',
                'id_estado_meta_act'   => 12,
                'cantidad_lograda'     => 12,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 12.',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 13,
                'id_informe'           => 13,
                'id_protprod'          => 13,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_13.pdf',
                'id_estado_meta_act'   => 13,
                'cantidad_lograda'     => 13,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 13.',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 14,
                'id_informe'           => 14,
                'id_protprod'          => 14,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_14.pdf',
                'id_estado_meta_act'   => 14,
                'cantidad_lograda'     => 14,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 14.',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_seguimiento_metas' => 15,
                'id_informe'           => 15,
                'id_protprod'          => 15,
                'documento'            => 'documentos/inv_seguimiento_metas/inv_seguimiento_metas_15.pdf',
                'id_estado_meta_act'   => 15,
                'cantidad_lograda'     => 15,
                'justificacion'        => 'Justificacion de seguimiento metas: registro de prueba número 15.',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'deleted_at'           => null,
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
