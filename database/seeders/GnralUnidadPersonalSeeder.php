<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_unidad_personal`.
 */
class GnralUnidadPersonalSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_unidad_personal` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'gnral_unidad_personal';

        $llaves = [
            ['id_unidad_persona'],
        ];

        $registros = [
            [
                'id_unidad_persona' => 1,
                'id_personal'       => 1,
                'id_unidad_admin'   => 1,
                'updated_at'        => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_unidad_persona' => 2,
                'id_personal'       => 2,
                'id_unidad_admin'   => 2,
                'updated_at'        => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_unidad_persona' => 3,
                'id_personal'       => 3,
                'id_unidad_admin'   => 3,
                'updated_at'        => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_unidad_persona' => 4,
                'id_personal'       => 4,
                'id_unidad_admin'   => 4,
                'updated_at'        => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_unidad_persona' => 5,
                'id_personal'       => 5,
                'id_unidad_admin'   => 5,
                'updated_at'        => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_unidad_persona' => 6,
                'id_personal'       => 6,
                'id_unidad_admin'   => 6,
                'updated_at'        => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_unidad_persona' => 7,
                'id_personal'       => 7,
                'id_unidad_admin'   => 7,
                'updated_at'        => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_unidad_persona' => 8,
                'id_personal'       => 8,
                'id_unidad_admin'   => 8,
                'updated_at'        => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_unidad_persona' => 9,
                'id_personal'       => 9,
                'id_unidad_admin'   => 9,
                'updated_at'        => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_unidad_persona' => 10,
                'id_personal'       => 10,
                'id_unidad_admin'   => 10,
                'updated_at'        => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_unidad_persona' => 11,
                'id_personal'       => 11,
                'id_unidad_admin'   => 11,
                'updated_at'        => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_unidad_persona' => 12,
                'id_personal'       => 12,
                'id_unidad_admin'   => 12,
                'updated_at'        => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_unidad_persona' => 13,
                'id_personal'       => 13,
                'id_unidad_admin'   => 13,
                'updated_at'        => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_unidad_persona' => 14,
                'id_personal'       => 14,
                'id_unidad_admin'   => 14,
                'updated_at'        => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_unidad_persona' => 15,
                'id_personal'       => 15,
                'id_unidad_admin'   => 15,
                'updated_at'        => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
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
