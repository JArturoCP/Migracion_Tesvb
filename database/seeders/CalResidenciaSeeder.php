<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_residencia`.
 */
class CalResidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_residencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'cal_residencia';

        $llaves = [
            ['id_cal_residencia'],
        ];

        $registros = [
            [
                'id_cal_residencia' => 1,
                'calificacion'      => 77,
                'id_alumno'         => 1,
                'fecha_termino'     => '2026-01-05',
                'clave'             => 'CLV-001',
            ],
            [
                'id_cal_residencia' => 2,
                'calificacion'      => 84,
                'id_alumno'         => 2,
                'fecha_termino'     => '2026-01-14',
                'clave'             => 'CLV-002',
            ],
            [
                'id_cal_residencia' => 3,
                'calificacion'      => 91,
                'id_alumno'         => 3,
                'fecha_termino'     => '2026-01-23',
                'clave'             => 'CLV-003',
            ],
            [
                'id_cal_residencia' => 4,
                'calificacion'      => 98,
                'id_alumno'         => 4,
                'fecha_termino'     => '2026-02-01',
                'clave'             => 'CLV-004',
            ],
            [
                'id_cal_residencia' => 5,
                'calificacion'      => 74,
                'id_alumno'         => 5,
                'fecha_termino'     => '2026-02-10',
                'clave'             => 'CLV-005',
            ],
            [
                'id_cal_residencia' => 6,
                'calificacion'      => 81,
                'id_alumno'         => 6,
                'fecha_termino'     => '2026-02-19',
                'clave'             => 'CLV-006',
            ],
            [
                'id_cal_residencia' => 7,
                'calificacion'      => 88,
                'id_alumno'         => 7,
                'fecha_termino'     => '2026-02-28',
                'clave'             => 'CLV-007',
            ],
            [
                'id_cal_residencia' => 8,
                'calificacion'      => 95,
                'id_alumno'         => 8,
                'fecha_termino'     => '2026-03-09',
                'clave'             => 'CLV-008',
            ],
            [
                'id_cal_residencia' => 9,
                'calificacion'      => 71,
                'id_alumno'         => 9,
                'fecha_termino'     => '2026-03-18',
                'clave'             => 'CLV-009',
            ],
            [
                'id_cal_residencia' => 10,
                'calificacion'      => 78,
                'id_alumno'         => 10,
                'fecha_termino'     => '2026-03-27',
                'clave'             => 'CLV-010',
            ],
            [
                'id_cal_residencia' => 11,
                'calificacion'      => 85,
                'id_alumno'         => 11,
                'fecha_termino'     => '2026-04-05',
                'clave'             => 'CLV-011',
            ],
            [
                'id_cal_residencia' => 12,
                'calificacion'      => 92,
                'id_alumno'         => 12,
                'fecha_termino'     => '2026-04-14',
                'clave'             => 'CLV-012',
            ],
            [
                'id_cal_residencia' => 13,
                'calificacion'      => 99,
                'id_alumno'         => 13,
                'fecha_termino'     => '2026-04-23',
                'clave'             => 'CLV-013',
            ],
            [
                'id_cal_residencia' => 14,
                'calificacion'      => 75,
                'id_alumno'         => 14,
                'fecha_termino'     => '2026-05-02',
                'clave'             => 'CLV-014',
            ],
            [
                'id_cal_residencia' => 15,
                'calificacion'      => 82,
                'id_alumno'         => 15,
                'fecha_termino'     => '2026-05-11',
                'clave'             => 'CLV-015',
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
