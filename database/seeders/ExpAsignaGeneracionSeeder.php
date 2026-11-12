<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_asigna_generacion`.
 */
class ExpAsignaGeneracionSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_asigna_generacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpGeneracionSeeder::class,
            GnralJefesPeriodosSeeder::class,
        ]);

        $tabla = 'exp_asigna_generacion';

        $llaves = [
            ['id_asigna_generacion'],
        ];

        $registros = [
            [
                'id_asigna_generacion' => 1,
                'id_generacion'        => 1,
                'grupo'                => 1,
                'id_jefe_periodo'      => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 2,
                'id_generacion'        => 2,
                'grupo'                => 2,
                'id_jefe_periodo'      => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 3,
                'id_generacion'        => 3,
                'grupo'                => 3,
                'id_jefe_periodo'      => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 4,
                'id_generacion'        => 4,
                'grupo'                => 4,
                'id_jefe_periodo'      => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 5,
                'id_generacion'        => 5,
                'grupo'                => 5,
                'id_jefe_periodo'      => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 6,
                'id_generacion'        => 6,
                'grupo'                => 6,
                'id_jefe_periodo'      => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 7,
                'id_generacion'        => 7,
                'grupo'                => 7,
                'id_jefe_periodo'      => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 8,
                'id_generacion'        => 8,
                'grupo'                => 8,
                'id_jefe_periodo'      => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 9,
                'id_generacion'        => 9,
                'grupo'                => 9,
                'id_jefe_periodo'      => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 10,
                'id_generacion'        => 10,
                'grupo'                => 10,
                'id_jefe_periodo'      => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 11,
                'id_generacion'        => 11,
                'grupo'                => 11,
                'id_jefe_periodo'      => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 12,
                'id_generacion'        => 12,
                'grupo'                => 12,
                'id_jefe_periodo'      => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 13,
                'id_generacion'        => 13,
                'grupo'                => 13,
                'id_jefe_periodo'      => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 14,
                'id_generacion'        => 14,
                'grupo'                => 14,
                'id_jefe_periodo'      => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_generacion' => 15,
                'id_generacion'        => 15,
                'grupo'                => 15,
                'id_jefe_periodo'      => 15,
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'deleted_at'           => null,
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
