<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_agenda_evento`.
 */
class AudAgendaEventoSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_agenda_evento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAgendaSeeder::class,
            AudAuditorAuditoriaSeeder::class,
            AudAuditoriaProcesoSeeder::class,
        ]);

        $tabla = 'aud_agenda_evento';

        $llaves = [
            ['id_agenda_evento'],
        ];

        $registros = [
            [
                'id_agenda_evento'     => 1,
                'id_agenda'            => 1,
                'id_auditoria_proceso' => 1,
                'id_auditor_auditoria' => 1,
                'created_at'           => '2026-01-05',
                'updated_at'           => '2026-01-05',
                'deleted_at'           => '2026-01-05',
            ],
            [
                'id_agenda_evento'     => 2,
                'id_agenda'            => 2,
                'id_auditoria_proceso' => 2,
                'id_auditor_auditoria' => 2,
                'created_at'           => '2026-01-14',
                'updated_at'           => '2026-01-14',
                'deleted_at'           => '2026-01-14',
            ],
            [
                'id_agenda_evento'     => 3,
                'id_agenda'            => 3,
                'id_auditoria_proceso' => 3,
                'id_auditor_auditoria' => 3,
                'created_at'           => '2026-01-23',
                'updated_at'           => '2026-01-23',
                'deleted_at'           => '2026-01-23',
            ],
            [
                'id_agenda_evento'     => 4,
                'id_agenda'            => 4,
                'id_auditoria_proceso' => 4,
                'id_auditor_auditoria' => 4,
                'created_at'           => '2026-02-01',
                'updated_at'           => '2026-02-01',
                'deleted_at'           => '2026-02-01',
            ],
            [
                'id_agenda_evento'     => 5,
                'id_agenda'            => 5,
                'id_auditoria_proceso' => 5,
                'id_auditor_auditoria' => 5,
                'created_at'           => '2026-02-10',
                'updated_at'           => '2026-02-10',
                'deleted_at'           => '2026-02-10',
            ],
            [
                'id_agenda_evento'     => 6,
                'id_agenda'            => 6,
                'id_auditoria_proceso' => 6,
                'id_auditor_auditoria' => 6,
                'created_at'           => '2026-02-19',
                'updated_at'           => '2026-02-19',
                'deleted_at'           => '2026-02-19',
            ],
            [
                'id_agenda_evento'     => 7,
                'id_agenda'            => 7,
                'id_auditoria_proceso' => 7,
                'id_auditor_auditoria' => 7,
                'created_at'           => '2026-02-28',
                'updated_at'           => '2026-02-28',
                'deleted_at'           => '2026-02-28',
            ],
            [
                'id_agenda_evento'     => 8,
                'id_agenda'            => 8,
                'id_auditoria_proceso' => 8,
                'id_auditor_auditoria' => 8,
                'created_at'           => '2026-03-09',
                'updated_at'           => '2026-03-09',
                'deleted_at'           => '2026-03-09',
            ],
            [
                'id_agenda_evento'     => 9,
                'id_agenda'            => 9,
                'id_auditoria_proceso' => 9,
                'id_auditor_auditoria' => 9,
                'created_at'           => '2026-03-18',
                'updated_at'           => '2026-03-18',
                'deleted_at'           => '2026-03-18',
            ],
            [
                'id_agenda_evento'     => 10,
                'id_agenda'            => 10,
                'id_auditoria_proceso' => 10,
                'id_auditor_auditoria' => 10,
                'created_at'           => '2026-03-27',
                'updated_at'           => '2026-03-27',
                'deleted_at'           => '2026-03-27',
            ],
            [
                'id_agenda_evento'     => 11,
                'id_agenda'            => 11,
                'id_auditoria_proceso' => 11,
                'id_auditor_auditoria' => 11,
                'created_at'           => '2026-04-05',
                'updated_at'           => '2026-04-05',
                'deleted_at'           => '2026-04-05',
            ],
            [
                'id_agenda_evento'     => 12,
                'id_agenda'            => 12,
                'id_auditoria_proceso' => 12,
                'id_auditor_auditoria' => 12,
                'created_at'           => '2026-04-14',
                'updated_at'           => '2026-04-14',
                'deleted_at'           => '2026-04-14',
            ],
            [
                'id_agenda_evento'     => 13,
                'id_agenda'            => 13,
                'id_auditoria_proceso' => 13,
                'id_auditor_auditoria' => 13,
                'created_at'           => '2026-04-23',
                'updated_at'           => '2026-04-23',
                'deleted_at'           => '2026-04-23',
            ],
            [
                'id_agenda_evento'     => 14,
                'id_agenda'            => 14,
                'id_auditoria_proceso' => 14,
                'id_auditor_auditoria' => 14,
                'created_at'           => '2026-05-02',
                'updated_at'           => '2026-05-02',
                'deleted_at'           => '2026-05-02',
            ],
            [
                'id_agenda_evento'     => 15,
                'id_agenda'            => 15,
                'id_auditoria_proceso' => 15,
                'id_auditor_auditoria' => 15,
                'created_at'           => '2026-05-11',
                'updated_at'           => '2026-05-11',
                'deleted_at'           => '2026-05-11',
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
