<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_lider_acciones`.
 */
class AudLiderAccionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_lider_acciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'aud_lider_acciones';

        $llaves = [
            ['id_lider'],
        ];

        $registros = [
            [
                'id_lider'    => 1,
                'id_personal' => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 2,
                'id_personal' => 2,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 3,
                'id_personal' => 3,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 4,
                'id_personal' => 4,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 5,
                'id_personal' => 5,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 6,
                'id_personal' => 6,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 7,
                'id_personal' => 7,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 8,
                'id_personal' => 8,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 9,
                'id_personal' => 9,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 10,
                'id_personal' => 10,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 11,
                'id_personal' => 11,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 12,
                'id_personal' => 12,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 13,
                'id_personal' => 13,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 14,
                'id_personal' => 14,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_lider'    => 15,
                'id_personal' => 15,
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
                'deleted_at'  => null,
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
