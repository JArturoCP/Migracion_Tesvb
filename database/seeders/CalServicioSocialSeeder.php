<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_servicio_social`.
 */
class CalServicioSocialSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_servicio_social` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'cal_servicio_social';

        $llaves = [
            ['id_servicio_social'],
            ['id_alumno'],
        ];

        $registros = [
            [
                'id_servicio_social' => 1,
                'id_alumno'          => 1,
                'calificacion'       => 77,
                'fecha_termino'      => '2026-01-05',
                'clave'              => 'CLV-001',
            ],
            [
                'id_servicio_social' => 2,
                'id_alumno'          => 2,
                'calificacion'       => 84,
                'fecha_termino'      => '2026-01-14',
                'clave'              => 'CLV-002',
            ],
            [
                'id_servicio_social' => 3,
                'id_alumno'          => 3,
                'calificacion'       => 91,
                'fecha_termino'      => '2026-01-23',
                'clave'              => 'CLV-003',
            ],
            [
                'id_servicio_social' => 4,
                'id_alumno'          => 4,
                'calificacion'       => 98,
                'fecha_termino'      => '2026-02-01',
                'clave'              => 'CLV-004',
            ],
            [
                'id_servicio_social' => 5,
                'id_alumno'          => 5,
                'calificacion'       => 74,
                'fecha_termino'      => '2026-02-10',
                'clave'              => 'CLV-005',
            ],
            [
                'id_servicio_social' => 6,
                'id_alumno'          => 6,
                'calificacion'       => 81,
                'fecha_termino'      => '2026-02-19',
                'clave'              => 'CLV-006',
            ],
            [
                'id_servicio_social' => 7,
                'id_alumno'          => 7,
                'calificacion'       => 88,
                'fecha_termino'      => '2026-02-28',
                'clave'              => 'CLV-007',
            ],
            [
                'id_servicio_social' => 8,
                'id_alumno'          => 8,
                'calificacion'       => 95,
                'fecha_termino'      => '2026-03-09',
                'clave'              => 'CLV-008',
            ],
            [
                'id_servicio_social' => 9,
                'id_alumno'          => 9,
                'calificacion'       => 71,
                'fecha_termino'      => '2026-03-18',
                'clave'              => 'CLV-009',
            ],
            [
                'id_servicio_social' => 10,
                'id_alumno'          => 10,
                'calificacion'       => 78,
                'fecha_termino'      => '2026-03-27',
                'clave'              => 'CLV-010',
            ],
            [
                'id_servicio_social' => 11,
                'id_alumno'          => 11,
                'calificacion'       => 85,
                'fecha_termino'      => '2026-04-05',
                'clave'              => 'CLV-011',
            ],
            [
                'id_servicio_social' => 12,
                'id_alumno'          => 12,
                'calificacion'       => 92,
                'fecha_termino'      => '2026-04-14',
                'clave'              => 'CLV-012',
            ],
            [
                'id_servicio_social' => 13,
                'id_alumno'          => 13,
                'calificacion'       => 99,
                'fecha_termino'      => '2026-04-23',
                'clave'              => 'CLV-013',
            ],
            [
                'id_servicio_social' => 14,
                'id_alumno'          => 14,
                'calificacion'       => 75,
                'fecha_termino'      => '2026-05-02',
                'clave'              => 'CLV-014',
            ],
            [
                'id_servicio_social' => 15,
                'id_alumno'          => 15,
                'calificacion'       => 82,
                'fecha_termino'      => '2026-05-11',
                'clave'              => 'CLV-015',
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
