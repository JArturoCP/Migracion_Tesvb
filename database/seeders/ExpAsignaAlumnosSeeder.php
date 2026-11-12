<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_asigna_alumnos`.
 */
class ExpAsignaAlumnosSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_asigna_alumnos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaGeneracionSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'exp_asigna_alumnos';

        $llaves = [
            ['id_asigna_alumno'],
        ];

        $registros = [
            [
                'id_asigna_alumno'     => 1,
                'id_alumno'            => 1,
                'id_asigna_generacion' => 1,
                'estado'               => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 2,
                'id_alumno'            => 2,
                'id_asigna_generacion' => 2,
                'estado'               => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 3,
                'id_alumno'            => 3,
                'id_asigna_generacion' => 3,
                'estado'               => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 4,
                'id_alumno'            => 4,
                'id_asigna_generacion' => 4,
                'estado'               => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 5,
                'id_alumno'            => 5,
                'id_asigna_generacion' => 5,
                'estado'               => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 6,
                'id_alumno'            => 6,
                'id_asigna_generacion' => 6,
                'estado'               => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 7,
                'id_alumno'            => 7,
                'id_asigna_generacion' => 7,
                'estado'               => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 8,
                'id_alumno'            => 8,
                'id_asigna_generacion' => 8,
                'estado'               => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 9,
                'id_alumno'            => 9,
                'id_asigna_generacion' => 9,
                'estado'               => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 10,
                'id_alumno'            => 10,
                'id_asigna_generacion' => 10,
                'estado'               => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 11,
                'id_alumno'            => 11,
                'id_asigna_generacion' => 11,
                'estado'               => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 12,
                'id_alumno'            => 12,
                'id_asigna_generacion' => 12,
                'estado'               => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 13,
                'id_alumno'            => 13,
                'id_asigna_generacion' => 13,
                'estado'               => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 14,
                'id_alumno'            => 14,
                'id_asigna_generacion' => 14,
                'estado'               => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'deleted_at'           => null,
            ],
            [
                'id_asigna_alumno'     => 15,
                'id_alumno'            => 15,
                'id_asigna_generacion' => 15,
                'estado'               => 15,
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
