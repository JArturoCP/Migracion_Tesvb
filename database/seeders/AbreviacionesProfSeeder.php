<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `abreviaciones_prof`.
 */
class AbreviacionesProfSeeder extends Seeder
{
    /**
     * Pobla la tabla `abreviaciones_prof` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AbreviacionesSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'abreviaciones_prof';

        $llaves = [
            ['id_abreviacion_prof'],
        ];

        $registros = [
            [
                'id_abreviacion_prof' => 1,
                'id_abreviacion'      => 1,
                'id_personal'         => 1,
                'updated_at'          => '2026-01-05 09:00:00',
                'created_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_abreviacion_prof' => 2,
                'id_abreviacion'      => 2,
                'id_personal'         => 2,
                'updated_at'          => '2026-01-14 10:00:00',
                'created_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_abreviacion_prof' => 3,
                'id_abreviacion'      => 3,
                'id_personal'         => 3,
                'updated_at'          => '2026-01-23 11:00:00',
                'created_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_abreviacion_prof' => 4,
                'id_abreviacion'      => 4,
                'id_personal'         => 4,
                'updated_at'          => '2026-02-01 12:00:00',
                'created_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_abreviacion_prof' => 5,
                'id_abreviacion'      => 5,
                'id_personal'         => 5,
                'updated_at'          => '2026-02-10 13:00:00',
                'created_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_abreviacion_prof' => 6,
                'id_abreviacion'      => 6,
                'id_personal'         => 6,
                'updated_at'          => '2026-02-19 14:00:00',
                'created_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_abreviacion_prof' => 7,
                'id_abreviacion'      => 7,
                'id_personal'         => 7,
                'updated_at'          => '2026-02-28 15:00:00',
                'created_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_abreviacion_prof' => 8,
                'id_abreviacion'      => 8,
                'id_personal'         => 8,
                'updated_at'          => '2026-03-09 16:00:00',
                'created_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_abreviacion_prof' => 9,
                'id_abreviacion'      => 9,
                'id_personal'         => 9,
                'updated_at'          => '2026-03-18 08:00:00',
                'created_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_abreviacion_prof' => 10,
                'id_abreviacion'      => 10,
                'id_personal'         => 10,
                'updated_at'          => '2026-03-27 09:00:00',
                'created_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_abreviacion_prof' => 11,
                'id_abreviacion'      => 11,
                'id_personal'         => 11,
                'updated_at'          => '2026-04-05 10:00:00',
                'created_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_abreviacion_prof' => 12,
                'id_abreviacion'      => 12,
                'id_personal'         => 12,
                'updated_at'          => '2026-04-14 11:00:00',
                'created_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_abreviacion_prof' => 13,
                'id_abreviacion'      => 13,
                'id_personal'         => 13,
                'updated_at'          => '2026-04-23 12:00:00',
                'created_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_abreviacion_prof' => 14,
                'id_abreviacion'      => 14,
                'id_personal'         => 14,
                'updated_at'          => '2026-05-02 13:00:00',
                'created_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_abreviacion_prof' => 15,
                'id_abreviacion'      => 15,
                'id_personal'         => 15,
                'updated_at'          => '2026-05-11 14:00:00',
                'created_at'          => '2026-05-11 14:00:00',
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
