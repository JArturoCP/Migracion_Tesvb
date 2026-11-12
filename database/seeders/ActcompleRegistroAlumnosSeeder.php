<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_registro_alumnos`.
 */
class ActcompleRegistroAlumnosSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_registro_alumnos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleDocenteActividadSeeder::class,
            GnralPeriodosSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'actcomple_registro_alumnos';

        $llaves = [
            ['id_registro_alumno'],
        ];

        $registros = [
            [
                'id_registro_alumno'   => 1,
                'cuenta'               => '202610001',
                'id_periodo'           => 12,
                'id_docente_actividad' => 1,
                'liberacion'           => 1,
                'id_semestre'          => 1,
                'fecha_registro'       => '2026-01-05',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
            ],
            [
                'id_registro_alumno'   => 2,
                'cuenta'               => '202610002',
                'id_periodo'           => 12,
                'id_docente_actividad' => 2,
                'liberacion'           => 2,
                'id_semestre'          => 2,
                'fecha_registro'       => '2026-01-14',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
            ],
            [
                'id_registro_alumno'   => 3,
                'cuenta'               => '202610003',
                'id_periodo'           => 3,
                'id_docente_actividad' => 3,
                'liberacion'           => 3,
                'id_semestre'          => 3,
                'fecha_registro'       => '2026-01-23',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
            ],
            [
                'id_registro_alumno'   => 4,
                'cuenta'               => '202610004',
                'id_periodo'           => 12,
                'id_docente_actividad' => 4,
                'liberacion'           => 4,
                'id_semestre'          => 4,
                'fecha_registro'       => '2026-02-01',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
            ],
            [
                'id_registro_alumno'   => 5,
                'cuenta'               => '202610005',
                'id_periodo'           => 12,
                'id_docente_actividad' => 5,
                'liberacion'           => 5,
                'id_semestre'          => 5,
                'fecha_registro'       => '2026-02-10',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
            ],
            [
                'id_registro_alumno'   => 6,
                'cuenta'               => '202610006',
                'id_periodo'           => 6,
                'id_docente_actividad' => 6,
                'liberacion'           => 6,
                'id_semestre'          => 6,
                'fecha_registro'       => '2026-02-19',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
            ],
            [
                'id_registro_alumno'   => 7,
                'cuenta'               => '202610007',
                'id_periodo'           => 12,
                'id_docente_actividad' => 7,
                'liberacion'           => 7,
                'id_semestre'          => 7,
                'fecha_registro'       => '2026-02-28',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
            ],
            [
                'id_registro_alumno'   => 8,
                'cuenta'               => '202610008',
                'id_periodo'           => 12,
                'id_docente_actividad' => 8,
                'liberacion'           => 8,
                'id_semestre'          => 8,
                'fecha_registro'       => '2026-03-09',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
            ],
            [
                'id_registro_alumno'   => 9,
                'cuenta'               => '202610009',
                'id_periodo'           => 9,
                'id_docente_actividad' => 9,
                'liberacion'           => 9,
                'id_semestre'          => 9,
                'fecha_registro'       => '2026-03-18',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
            ],
            [
                'id_registro_alumno'   => 10,
                'cuenta'               => '202610010',
                'id_periodo'           => 12,
                'id_docente_actividad' => 10,
                'liberacion'           => 10,
                'id_semestre'          => 10,
                'fecha_registro'       => '2026-03-27',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
            ],
            [
                'id_registro_alumno'   => 11,
                'cuenta'               => '202610011',
                'id_periodo'           => 12,
                'id_docente_actividad' => 11,
                'liberacion'           => 11,
                'id_semestre'          => 11,
                'fecha_registro'       => '2026-04-05',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
            ],
            [
                'id_registro_alumno'   => 12,
                'cuenta'               => '202610012',
                'id_periodo'           => 12,
                'id_docente_actividad' => 12,
                'liberacion'           => 12,
                'id_semestre'          => 12,
                'fecha_registro'       => '2026-04-14',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
            ],
            [
                'id_registro_alumno'   => 13,
                'cuenta'               => '202610013',
                'id_periodo'           => 12,
                'id_docente_actividad' => 13,
                'liberacion'           => 13,
                'id_semestre'          => 1,
                'fecha_registro'       => '2026-04-23',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
            ],
            [
                'id_registro_alumno'   => 14,
                'cuenta'               => '202610014',
                'id_periodo'           => 12,
                'id_docente_actividad' => 14,
                'liberacion'           => 14,
                'id_semestre'          => 2,
                'fecha_registro'       => '2026-05-02',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
            ],
            [
                'id_registro_alumno'   => 15,
                'cuenta'               => '202610015',
                'id_periodo'           => 15,
                'id_docente_actividad' => 15,
                'liberacion'           => 15,
                'id_semestre'          => 3,
                'fecha_registro'       => '2026-05-11',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
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
