<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_asigna_coordinador`.
 */
class ExpAsignaCoordinadorSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_asigna_coordinador` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralJefesPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'exp_asigna_coordinador';

        $llaves = [
            ['id_asigna_coordinador'],
        ];

        $registros = [
            [
                'id_asigna_coordinador' => 1,
                'id_jefe_periodo'       => 1,
                'id_personal'           => 1,
                'created_at'            => '2026-01-05 09:00:00',
                'updated_at'            => '2026-01-05 09:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 2,
                'id_jefe_periodo'       => 2,
                'id_personal'           => 2,
                'created_at'            => '2026-01-14 10:00:00',
                'updated_at'            => '2026-01-14 10:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 3,
                'id_jefe_periodo'       => 3,
                'id_personal'           => 3,
                'created_at'            => '2026-01-23 11:00:00',
                'updated_at'            => '2026-01-23 11:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 4,
                'id_jefe_periodo'       => 4,
                'id_personal'           => 4,
                'created_at'            => '2026-02-01 12:00:00',
                'updated_at'            => '2026-02-01 12:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 5,
                'id_jefe_periodo'       => 5,
                'id_personal'           => 5,
                'created_at'            => '2026-02-10 13:00:00',
                'updated_at'            => '2026-02-10 13:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 6,
                'id_jefe_periodo'       => 6,
                'id_personal'           => 6,
                'created_at'            => '2026-02-19 14:00:00',
                'updated_at'            => '2026-02-19 14:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 7,
                'id_jefe_periodo'       => 7,
                'id_personal'           => 7,
                'created_at'            => '2026-02-28 15:00:00',
                'updated_at'            => '2026-02-28 15:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 8,
                'id_jefe_periodo'       => 8,
                'id_personal'           => 8,
                'created_at'            => '2026-03-09 16:00:00',
                'updated_at'            => '2026-03-09 16:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 9,
                'id_jefe_periodo'       => 9,
                'id_personal'           => 9,
                'created_at'            => '2026-03-18 08:00:00',
                'updated_at'            => '2026-03-18 08:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 10,
                'id_jefe_periodo'       => 10,
                'id_personal'           => 10,
                'created_at'            => '2026-03-27 09:00:00',
                'updated_at'            => '2026-03-27 09:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 11,
                'id_jefe_periodo'       => 11,
                'id_personal'           => 11,
                'created_at'            => '2026-04-05 10:00:00',
                'updated_at'            => '2026-04-05 10:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 12,
                'id_jefe_periodo'       => 12,
                'id_personal'           => 12,
                'created_at'            => '2026-04-14 11:00:00',
                'updated_at'            => '2026-04-14 11:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 13,
                'id_jefe_periodo'       => 13,
                'id_personal'           => 13,
                'created_at'            => '2026-04-23 12:00:00',
                'updated_at'            => '2026-04-23 12:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 14,
                'id_jefe_periodo'       => 14,
                'id_personal'           => 14,
                'created_at'            => '2026-05-02 13:00:00',
                'updated_at'            => '2026-05-02 13:00:00',
                'deleted_at'            => null,
            ],
            [
                'id_asigna_coordinador' => 15,
                'id_jefe_periodo'       => 15,
                'id_personal'           => 15,
                'created_at'            => '2026-05-11 14:00:00',
                'updated_at'            => '2026-05-11 14:00:00',
                'deleted_at'            => null,
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
