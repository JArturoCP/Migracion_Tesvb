<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `adeudo_departamento`.
 */
class AdeudoDepartamentoSeeder extends Seeder
{
    /**
     * Pobla la tabla `adeudo_departamento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralDepartamentosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'adeudo_departamento';

        $llaves = [
            ['id_adeudo_departamento'],
        ];

        $registros = [
            [
                'id_adeudo_departamento' => 1,
                'id_alumno'              => 1,
                'id_periodo'             => 12,
                'id_departamento'        => 0,
                'fecha_registro'         => '2026-01-05',
                'comentario'             => 'Comentario adeudo departamento 1',
                'id_solicitud'           => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 2,
                'id_alumno'              => 2,
                'id_periodo'             => 12,
                'id_departamento'        => 1,
                'fecha_registro'         => '2026-01-14',
                'comentario'             => 'Comentario adeudo departamento 2',
                'id_solicitud'           => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 3,
                'id_alumno'              => 3,
                'id_periodo'             => 3,
                'id_departamento'        => 2,
                'fecha_registro'         => '2026-01-23',
                'comentario'             => 'Comentario adeudo departamento 3',
                'id_solicitud'           => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 4,
                'id_alumno'              => 4,
                'id_periodo'             => 12,
                'id_departamento'        => 3,
                'fecha_registro'         => '2026-02-01',
                'comentario'             => 'Comentario adeudo departamento 4',
                'id_solicitud'           => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 5,
                'id_alumno'              => 5,
                'id_periodo'             => 12,
                'id_departamento'        => 4,
                'fecha_registro'         => '2026-02-10',
                'comentario'             => 'Comentario adeudo departamento 5',
                'id_solicitud'           => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 6,
                'id_alumno'              => 6,
                'id_periodo'             => 6,
                'id_departamento'        => 5,
                'fecha_registro'         => '2026-02-19',
                'comentario'             => 'Comentario adeudo departamento 6',
                'id_solicitud'           => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 7,
                'id_alumno'              => 7,
                'id_periodo'             => 12,
                'id_departamento'        => 6,
                'fecha_registro'         => '2026-02-28',
                'comentario'             => 'Comentario adeudo departamento 7',
                'id_solicitud'           => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 8,
                'id_alumno'              => 8,
                'id_periodo'             => 12,
                'id_departamento'        => 7,
                'fecha_registro'         => '2026-03-09',
                'comentario'             => 'Comentario adeudo departamento 8',
                'id_solicitud'           => 8,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 9,
                'id_alumno'              => 9,
                'id_periodo'             => 9,
                'id_departamento'        => 8,
                'fecha_registro'         => '2026-03-18',
                'comentario'             => 'Comentario adeudo departamento 9',
                'id_solicitud'           => 9,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 10,
                'id_alumno'              => 10,
                'id_periodo'             => 12,
                'id_departamento'        => 9,
                'fecha_registro'         => '2026-03-27',
                'comentario'             => 'Comentario adeudo departamento 10',
                'id_solicitud'           => 10,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 11,
                'id_alumno'              => 11,
                'id_periodo'             => 12,
                'id_departamento'        => 10,
                'fecha_registro'         => '2026-04-05',
                'comentario'             => 'Comentario adeudo departamento 11',
                'id_solicitud'           => 11,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 12,
                'id_alumno'              => 12,
                'id_periodo'             => 12,
                'id_departamento'        => 0,
                'fecha_registro'         => '2026-04-14',
                'comentario'             => 'Comentario adeudo departamento 12',
                'id_solicitud'           => 12,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 13,
                'id_alumno'              => 13,
                'id_periodo'             => 12,
                'id_departamento'        => 1,
                'fecha_registro'         => '2026-04-23',
                'comentario'             => 'Comentario adeudo departamento 13',
                'id_solicitud'           => 13,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 14,
                'id_alumno'              => 14,
                'id_periodo'             => 12,
                'id_departamento'        => 2,
                'fecha_registro'         => '2026-05-02',
                'comentario'             => 'Comentario adeudo departamento 14',
                'id_solicitud'           => 14,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
                'deleted_at'             => null,
            ],
            [
                'id_adeudo_departamento' => 15,
                'id_alumno'              => 15,
                'id_periodo'             => 15,
                'id_departamento'        => 3,
                'fecha_registro'         => '2026-05-11',
                'comentario'             => 'Comentario adeudo departamento 15',
                'id_solicitud'           => 15,
                'created_at'             => '2026-05-11 14:00:00',
                'updated_at'             => '2026-05-11 14:00:00',
                'deleted_at'             => null,
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
