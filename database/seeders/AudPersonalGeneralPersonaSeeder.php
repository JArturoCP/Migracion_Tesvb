<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_personal_general_persona`.
 */
class AudPersonalGeneralPersonaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_personal_general_persona` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudPersonalGeneralSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'aud_personal_general_persona';

        $llaves = [
            ['id_personal_general_persona'],
        ];

        $registros = [
            [
                'id_personal_general_persona' => 1,
                'id_personal_general'         => 1,
                'id_personal'                 => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 2,
                'id_personal_general'         => 2,
                'id_personal'                 => 2,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 3,
                'id_personal_general'         => 3,
                'id_personal'                 => 3,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 4,
                'id_personal_general'         => 4,
                'id_personal'                 => 4,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 5,
                'id_personal_general'         => 5,
                'id_personal'                 => 5,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 6,
                'id_personal_general'         => 6,
                'id_personal'                 => 6,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 7,
                'id_personal_general'         => 7,
                'id_personal'                 => 7,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 8,
                'id_personal_general'         => 8,
                'id_personal'                 => 8,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 9,
                'id_personal_general'         => 9,
                'id_personal'                 => 9,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 10,
                'id_personal_general'         => 10,
                'id_personal'                 => 10,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 11,
                'id_personal_general'         => 11,
                'id_personal'                 => 11,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 12,
                'id_personal_general'         => 12,
                'id_personal'                 => 12,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 13,
                'id_personal_general'         => 13,
                'id_personal'                 => 13,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 14,
                'id_personal_general'         => 14,
                'id_personal'                 => 14,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
                'deleted_at'                  => null,
            ],
            [
                'id_personal_general_persona' => 15,
                'id_personal_general'         => 15,
                'id_personal'                 => 15,
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
