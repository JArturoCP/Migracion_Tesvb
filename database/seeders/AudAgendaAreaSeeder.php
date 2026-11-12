<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_agenda_area`.
 */
class AudAgendaAreaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_agenda_area` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAgendaSeeder::class,
        ]);

        $tabla = 'aud_agenda_area';

        $llaves = [
            ['id_agenda_area'],
        ];

        $registros = [
            [
                'id_agenda_area' => 1,
                'id_agenda'      => 1,
                'id_area'        => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 2,
                'id_agenda'      => 2,
                'id_area'        => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 3,
                'id_agenda'      => 3,
                'id_area'        => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 4,
                'id_agenda'      => 4,
                'id_area'        => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 5,
                'id_agenda'      => 5,
                'id_area'        => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 6,
                'id_agenda'      => 6,
                'id_area'        => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 7,
                'id_agenda'      => 7,
                'id_area'        => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 8,
                'id_agenda'      => 8,
                'id_area'        => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 9,
                'id_agenda'      => 9,
                'id_area'        => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 10,
                'id_agenda'      => 10,
                'id_area'        => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 11,
                'id_agenda'      => 11,
                'id_area'        => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 12,
                'id_agenda'      => 12,
                'id_area'        => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 13,
                'id_agenda'      => 13,
                'id_area'        => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 14,
                'id_agenda'      => 14,
                'id_area'        => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_agenda_area' => 15,
                'id_agenda'      => 15,
                'id_area'        => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'deleted_at'     => null,
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
