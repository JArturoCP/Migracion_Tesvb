<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_agenda_actividad_auditor`.
 */
class AudAgendaActividadAuditorSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_agenda_actividad_auditor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAgendaActividadSeeder::class,
            AudAuditorAuditoriaSeeder::class,
        ]);

        $tabla = 'aud_agenda_actividad_auditor';

        $llaves = [
            ['id_agenda_actividad_auditor'],
        ];

        $registros = [
            [
                'id_agenda_actividad_auditor' => 1,
                'id_agenda_actividad'         => 1,
                'id_auditor_auditoria'        => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 2,
                'id_agenda_actividad'         => 2,
                'id_auditor_auditoria'        => 2,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 3,
                'id_agenda_actividad'         => 3,
                'id_auditor_auditoria'        => 3,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 4,
                'id_agenda_actividad'         => 4,
                'id_auditor_auditoria'        => 4,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 5,
                'id_agenda_actividad'         => 5,
                'id_auditor_auditoria'        => 5,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 6,
                'id_agenda_actividad'         => 6,
                'id_auditor_auditoria'        => 6,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 7,
                'id_agenda_actividad'         => 7,
                'id_auditor_auditoria'        => 7,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 8,
                'id_agenda_actividad'         => 8,
                'id_auditor_auditoria'        => 8,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 9,
                'id_agenda_actividad'         => 9,
                'id_auditor_auditoria'        => 9,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 10,
                'id_agenda_actividad'         => 10,
                'id_auditor_auditoria'        => 10,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 11,
                'id_agenda_actividad'         => 11,
                'id_auditor_auditoria'        => 11,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 12,
                'id_agenda_actividad'         => 12,
                'id_auditor_auditoria'        => 12,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 13,
                'id_agenda_actividad'         => 13,
                'id_auditor_auditoria'        => 13,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 14,
                'id_agenda_actividad'         => 14,
                'id_auditor_auditoria'        => 14,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_agenda_actividad_auditor' => 15,
                'id_agenda_actividad'         => 15,
                'id_auditor_auditoria'        => 15,
                'created_at'                  => '2026-05-11 14:00:00',
                'updated_at'                  => '2026-05-11 14:00:00',
                'deleted_at'                  => null,
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
