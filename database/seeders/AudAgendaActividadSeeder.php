<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_agenda_actividad`.
 */
class AudAgendaActividadSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_agenda_actividad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudActividadSeeder::class,
            AudAuditoriaSeeder::class,
        ]);

        $tabla = 'aud_agenda_actividad';

        $llaves = [
            ['id_agenda_actividad'],
        ];

        $registros = [
            [
                'id_agenda_actividad' => 1,
                'id_actividad'        => 1,
                'id_auditoria'        => 1,
                'fecha'               => '2026-01-05',
                'hora_i'              => '08:00:00',
                'hora_f'              => '08:00:00',
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 2,
                'id_actividad'        => 2,
                'id_auditoria'        => 2,
                'fecha'               => '2026-01-14',
                'hora_i'              => '09:00:00',
                'hora_f'              => '09:00:00',
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 3,
                'id_actividad'        => 3,
                'id_auditoria'        => 3,
                'fecha'               => '2026-01-23',
                'hora_i'              => '10:00:00',
                'hora_f'              => '10:00:00',
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 4,
                'id_actividad'        => 4,
                'id_auditoria'        => 4,
                'fecha'               => '2026-02-01',
                'hora_i'              => '11:00:00',
                'hora_f'              => '11:00:00',
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 5,
                'id_actividad'        => 5,
                'id_auditoria'        => 5,
                'fecha'               => '2026-02-10',
                'hora_i'              => '12:00:00',
                'hora_f'              => '12:00:00',
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 6,
                'id_actividad'        => 6,
                'id_auditoria'        => 6,
                'fecha'               => '2026-02-19',
                'hora_i'              => '13:00:00',
                'hora_f'              => '13:00:00',
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 7,
                'id_actividad'        => 7,
                'id_auditoria'        => 7,
                'fecha'               => '2026-02-28',
                'hora_i'              => '14:00:00',
                'hora_f'              => '14:00:00',
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 8,
                'id_actividad'        => 8,
                'id_auditoria'        => 8,
                'fecha'               => '2026-03-09',
                'hora_i'              => '15:00:00',
                'hora_f'              => '15:00:00',
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 9,
                'id_actividad'        => 9,
                'id_auditoria'        => 9,
                'fecha'               => '2026-03-18',
                'hora_i'              => '16:00:00',
                'hora_f'              => '16:00:00',
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 10,
                'id_actividad'        => 10,
                'id_auditoria'        => 10,
                'fecha'               => '2026-03-27',
                'hora_i'              => '17:00:00',
                'hora_f'              => '17:00:00',
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 11,
                'id_actividad'        => 11,
                'id_auditoria'        => 11,
                'fecha'               => '2026-04-05',
                'hora_i'              => '18:00:00',
                'hora_f'              => '18:00:00',
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 12,
                'id_actividad'        => 12,
                'id_auditoria'        => 12,
                'fecha'               => '2026-04-14',
                'hora_i'              => '07:00:00',
                'hora_f'              => '07:00:00',
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 13,
                'id_actividad'        => 13,
                'id_auditoria'        => 13,
                'fecha'               => '2026-04-23',
                'hora_i'              => '08:00:00',
                'hora_f'              => '08:00:00',
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 14,
                'id_actividad'        => 14,
                'id_auditoria'        => 14,
                'fecha'               => '2026-05-02',
                'hora_i'              => '09:00:00',
                'hora_f'              => '09:00:00',
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
                'deleted_at'          => null,
            ],
            [
                'id_agenda_actividad' => 15,
                'id_actividad'        => 15,
                'id_auditoria'        => 15,
                'fecha'               => '2026-05-11',
                'hora_i'              => '10:00:00',
                'hora_f'              => '10:00:00',
                'created_at'          => '2026-05-11 14:00:00',
                'updated_at'          => '2026-05-11 14:00:00',
                'deleted_at'          => null,
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
