<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_agenda`.
 */
class AudAgendaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_agenda` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAuditoriaSeeder::class,
        ]);

        $tabla = 'aud_agenda';

        $llaves = [
            ['id_agenda'],
        ];

        $registros = [
            [
                'id_agenda'    => 1,
                'fecha'        => '2026-01-05',
                'hora_i'       => '08:00:00',
                'hora_f'       => '08:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 1.',
                'created_at'   => '2026-01-05',
                'updated_at'   => '2026-01-05',
                'deleted_at'   => null,
                'id_auditoria' => 1,
            ],
            [
                'id_agenda'    => 2,
                'fecha'        => '2026-01-14',
                'hora_i'       => '09:00:00',
                'hora_f'       => '09:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 2.',
                'created_at'   => '2026-01-14',
                'updated_at'   => '2026-01-14',
                'deleted_at'   => null,
                'id_auditoria' => 2,
            ],
            [
                'id_agenda'    => 3,
                'fecha'        => '2026-01-23',
                'hora_i'       => '10:00:00',
                'hora_f'       => '10:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 3.',
                'created_at'   => '2026-01-23',
                'updated_at'   => '2026-01-23',
                'deleted_at'   => null,
                'id_auditoria' => 3,
            ],
            [
                'id_agenda'    => 4,
                'fecha'        => '2026-02-01',
                'hora_i'       => '11:00:00',
                'hora_f'       => '11:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 4.',
                'created_at'   => '2026-02-01',
                'updated_at'   => '2026-02-01',
                'deleted_at'   => null,
                'id_auditoria' => 4,
            ],
            [
                'id_agenda'    => 5,
                'fecha'        => '2026-02-10',
                'hora_i'       => '12:00:00',
                'hora_f'       => '12:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 5.',
                'created_at'   => '2026-02-10',
                'updated_at'   => '2026-02-10',
                'deleted_at'   => null,
                'id_auditoria' => 5,
            ],
            [
                'id_agenda'    => 6,
                'fecha'        => '2026-02-19',
                'hora_i'       => '13:00:00',
                'hora_f'       => '13:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 6.',
                'created_at'   => '2026-02-19',
                'updated_at'   => '2026-02-19',
                'deleted_at'   => null,
                'id_auditoria' => 6,
            ],
            [
                'id_agenda'    => 7,
                'fecha'        => '2026-02-28',
                'hora_i'       => '14:00:00',
                'hora_f'       => '14:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 7.',
                'created_at'   => '2026-02-28',
                'updated_at'   => '2026-02-28',
                'deleted_at'   => null,
                'id_auditoria' => 7,
            ],
            [
                'id_agenda'    => 8,
                'fecha'        => '2026-03-09',
                'hora_i'       => '15:00:00',
                'hora_f'       => '15:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 8.',
                'created_at'   => '2026-03-09',
                'updated_at'   => '2026-03-09',
                'deleted_at'   => null,
                'id_auditoria' => 8,
            ],
            [
                'id_agenda'    => 9,
                'fecha'        => '2026-03-18',
                'hora_i'       => '16:00:00',
                'hora_f'       => '16:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 9.',
                'created_at'   => '2026-03-18',
                'updated_at'   => '2026-03-18',
                'deleted_at'   => null,
                'id_auditoria' => 9,
            ],
            [
                'id_agenda'    => 10,
                'fecha'        => '2026-03-27',
                'hora_i'       => '17:00:00',
                'hora_f'       => '17:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 10.',
                'created_at'   => '2026-03-27',
                'updated_at'   => '2026-03-27',
                'deleted_at'   => null,
                'id_auditoria' => 10,
            ],
            [
                'id_agenda'    => 11,
                'fecha'        => '2026-04-05',
                'hora_i'       => '18:00:00',
                'hora_f'       => '18:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 11.',
                'created_at'   => '2026-04-05',
                'updated_at'   => '2026-04-05',
                'deleted_at'   => null,
                'id_auditoria' => 11,
            ],
            [
                'id_agenda'    => 12,
                'fecha'        => '2026-04-14',
                'hora_i'       => '07:00:00',
                'hora_f'       => '07:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 12.',
                'created_at'   => '2026-04-14',
                'updated_at'   => '2026-04-14',
                'deleted_at'   => null,
                'id_auditoria' => 12,
            ],
            [
                'id_agenda'    => 13,
                'fecha'        => '2026-04-23',
                'hora_i'       => '08:00:00',
                'hora_f'       => '08:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 13.',
                'created_at'   => '2026-04-23',
                'updated_at'   => '2026-04-23',
                'deleted_at'   => null,
                'id_auditoria' => 13,
            ],
            [
                'id_agenda'    => 14,
                'fecha'        => '2026-05-02',
                'hora_i'       => '09:00:00',
                'hora_f'       => '09:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 14.',
                'created_at'   => '2026-05-02',
                'updated_at'   => '2026-05-02',
                'deleted_at'   => null,
                'id_auditoria' => 14,
            ],
            [
                'id_agenda'    => 15,
                'fecha'        => '2026-05-11',
                'hora_i'       => '10:00:00',
                'hora_f'       => '10:00:00',
                'criterios'    => 'Criterios de agenda: registro de prueba número 15.',
                'created_at'   => '2026-05-11',
                'updated_at'   => '2026-05-11',
                'deleted_at'   => null,
                'id_auditoria' => 15,
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
