<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_seguimiento_auditorias`.
 */
class AudSeguimientoAuditoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_seguimiento_auditorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudresponsableAccionesSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'aud_seguimiento_auditorias';

        $llaves = [
            ['id_seguimiento'],
        ];

        $registros = [
            [
                'id_seguimiento'          => 1,
                'id_responsable'          => 1,
                'id_personal_seguimiento' => 1,
                'asignado_por'            => 1,
                'fecha_asignacion'        => '2003-01-01',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 1.',
                'activo'                  => 1,
                'created_at'              => '2026-01-05 09:00:00',
                'updated_at'              => '2026-01-05 09:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 2,
                'id_responsable'          => 2,
                'id_personal_seguimiento' => 2,
                'asignado_por'            => 2,
                'fecha_asignacion'        => '2004-02-02',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 2.',
                'activo'                  => 1,
                'created_at'              => '2026-01-14 10:00:00',
                'updated_at'              => '2026-01-14 10:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 3,
                'id_responsable'          => 3,
                'id_personal_seguimiento' => 3,
                'asignado_por'            => 3,
                'fecha_asignacion'        => '2005-03-03',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 3.',
                'activo'                  => 1,
                'created_at'              => '2026-01-23 11:00:00',
                'updated_at'              => '2026-01-23 11:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 4,
                'id_responsable'          => 4,
                'id_personal_seguimiento' => 4,
                'asignado_por'            => 4,
                'fecha_asignacion'        => '2006-04-04',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 4.',
                'activo'                  => 1,
                'created_at'              => '2026-02-01 12:00:00',
                'updated_at'              => '2026-02-01 12:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 5,
                'id_responsable'          => 5,
                'id_personal_seguimiento' => 5,
                'asignado_por'            => 5,
                'fecha_asignacion'        => '2003-05-05',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 5.',
                'activo'                  => 1,
                'created_at'              => '2026-02-10 13:00:00',
                'updated_at'              => '2026-02-10 13:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 6,
                'id_responsable'          => 6,
                'id_personal_seguimiento' => 6,
                'asignado_por'            => 6,
                'fecha_asignacion'        => '2004-06-06',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 6.',
                'activo'                  => 1,
                'created_at'              => '2026-02-19 14:00:00',
                'updated_at'              => '2026-02-19 14:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 7,
                'id_responsable'          => 7,
                'id_personal_seguimiento' => 7,
                'asignado_por'            => 7,
                'fecha_asignacion'        => '2005-07-07',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 7.',
                'activo'                  => 1,
                'created_at'              => '2026-02-28 15:00:00',
                'updated_at'              => '2026-02-28 15:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 8,
                'id_responsable'          => 8,
                'id_personal_seguimiento' => 8,
                'asignado_por'            => 8,
                'fecha_asignacion'        => '2006-08-08',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 8.',
                'activo'                  => 1,
                'created_at'              => '2026-03-09 16:00:00',
                'updated_at'              => '2026-03-09 16:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 9,
                'id_responsable'          => 9,
                'id_personal_seguimiento' => 9,
                'asignado_por'            => 9,
                'fecha_asignacion'        => '2003-09-09',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 9.',
                'activo'                  => 1,
                'created_at'              => '2026-03-18 08:00:00',
                'updated_at'              => '2026-03-18 08:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 10,
                'id_responsable'          => 10,
                'id_personal_seguimiento' => 10,
                'asignado_por'            => 10,
                'fecha_asignacion'        => '2004-10-10',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 10.',
                'activo'                  => 1,
                'created_at'              => '2026-03-27 09:00:00',
                'updated_at'              => '2026-03-27 09:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 11,
                'id_responsable'          => 11,
                'id_personal_seguimiento' => 11,
                'asignado_por'            => 11,
                'fecha_asignacion'        => '2005-11-11',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 11.',
                'activo'                  => 1,
                'created_at'              => '2026-04-05 10:00:00',
                'updated_at'              => '2026-04-05 10:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 12,
                'id_responsable'          => 12,
                'id_personal_seguimiento' => 12,
                'asignado_por'            => 12,
                'fecha_asignacion'        => '2006-12-12',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 12.',
                'activo'                  => 1,
                'created_at'              => '2026-04-14 11:00:00',
                'updated_at'              => '2026-04-14 11:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 13,
                'id_responsable'          => 13,
                'id_personal_seguimiento' => 13,
                'asignado_por'            => 13,
                'fecha_asignacion'        => '2003-01-13',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 13.',
                'activo'                  => 1,
                'created_at'              => '2026-04-23 12:00:00',
                'updated_at'              => '2026-04-23 12:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 14,
                'id_responsable'          => 14,
                'id_personal_seguimiento' => 14,
                'asignado_por'            => 14,
                'fecha_asignacion'        => '2004-02-14',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 14.',
                'activo'                  => 1,
                'created_at'              => '2026-05-02 13:00:00',
                'updated_at'              => '2026-05-02 13:00:00',
                'deleted_at'              => null,
            ],
            [
                'id_seguimiento'          => 15,
                'id_responsable'          => 15,
                'id_personal_seguimiento' => 15,
                'asignado_por'            => 15,
                'fecha_asignacion'        => '2005-03-15',
                'observaciones'           => 'Observaciones de seguimiento auditorias: registro de prueba número 15.',
                'activo'                  => 1,
                'created_at'              => '2026-05-11 14:00:00',
                'updated_at'              => '2026-05-11 14:00:00',
                'deleted_at'              => null,
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
