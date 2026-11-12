<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `prorroga_solicitudes`.
 */
class ProrrogaSolicitudesSeeder extends Seeder
{
    /**
     * Pobla la tabla `prorroga_solicitudes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'prorroga_solicitudes';

        $llaves = [
            ['id_prorroga_solicitudes'],
        ];

        $registros = [
            [
                'id_prorroga_solicitudes' => 1,
                'id_alumno'               => 1,
                'id_semestre'             => 1,
                'fecha_efectuar'          => '2026-01-05',
                'fecha_solicitud'         => '2026-01-05',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 2,
                'id_alumno'               => 2,
                'id_semestre'             => 2,
                'fecha_efectuar'          => '2026-01-14',
                'fecha_solicitud'         => '2026-01-14',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 3,
                'id_alumno'               => 3,
                'id_semestre'             => 3,
                'fecha_efectuar'          => '2026-01-23',
                'fecha_solicitud'         => '2026-01-23',
                'id_periodo'              => 3,
            ],
            [
                'id_prorroga_solicitudes' => 4,
                'id_alumno'               => 4,
                'id_semestre'             => 4,
                'fecha_efectuar'          => '2026-02-01',
                'fecha_solicitud'         => '2026-02-01',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 5,
                'id_alumno'               => 5,
                'id_semestre'             => 5,
                'fecha_efectuar'          => '2026-02-10',
                'fecha_solicitud'         => '2026-02-10',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 6,
                'id_alumno'               => 6,
                'id_semestre'             => 6,
                'fecha_efectuar'          => '2026-02-19',
                'fecha_solicitud'         => '2026-02-19',
                'id_periodo'              => 6,
            ],
            [
                'id_prorroga_solicitudes' => 7,
                'id_alumno'               => 7,
                'id_semestre'             => 7,
                'fecha_efectuar'          => '2026-02-28',
                'fecha_solicitud'         => '2026-02-28',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 8,
                'id_alumno'               => 8,
                'id_semestre'             => 8,
                'fecha_efectuar'          => '2026-03-09',
                'fecha_solicitud'         => '2026-03-09',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 9,
                'id_alumno'               => 9,
                'id_semestre'             => 9,
                'fecha_efectuar'          => '2026-03-18',
                'fecha_solicitud'         => '2026-03-18',
                'id_periodo'              => 9,
            ],
            [
                'id_prorroga_solicitudes' => 10,
                'id_alumno'               => 10,
                'id_semestre'             => 10,
                'fecha_efectuar'          => '2026-03-27',
                'fecha_solicitud'         => '2026-03-27',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 11,
                'id_alumno'               => 11,
                'id_semestre'             => 11,
                'fecha_efectuar'          => '2026-04-05',
                'fecha_solicitud'         => '2026-04-05',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 12,
                'id_alumno'               => 12,
                'id_semestre'             => 12,
                'fecha_efectuar'          => '2026-04-14',
                'fecha_solicitud'         => '2026-04-14',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 13,
                'id_alumno'               => 13,
                'id_semestre'             => 1,
                'fecha_efectuar'          => '2026-04-23',
                'fecha_solicitud'         => '2026-04-23',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 14,
                'id_alumno'               => 14,
                'id_semestre'             => 2,
                'fecha_efectuar'          => '2026-05-02',
                'fecha_solicitud'         => '2026-05-02',
                'id_periodo'              => 12,
            ],
            [
                'id_prorroga_solicitudes' => 15,
                'id_alumno'               => 15,
                'id_semestre'             => 3,
                'fecha_efectuar'          => '2026-05-11',
                'fecha_solicitud'         => '2026-05-11',
                'id_periodo'              => 15,
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
