<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_vulnerabilidad`.
 */
class BecaVulnerabilidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_vulnerabilidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'beca_vulnerabilidad';

        $llaves = [
            ['id_vulnerabilidad'],
        ];

        $registros = [
            [
                'id_vulnerabilidad' => 1,
                'id_estado'         => 1,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-01-05',
                'id_alumno'         => 1,
            ],
            [
                'id_vulnerabilidad' => 2,
                'id_estado'         => 2,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-01-14',
                'id_alumno'         => 2,
            ],
            [
                'id_vulnerabilidad' => 3,
                'id_estado'         => 3,
                'id_periodo'        => 3,
                'fecha_registro'    => '2026-01-23',
                'id_alumno'         => 3,
            ],
            [
                'id_vulnerabilidad' => 4,
                'id_estado'         => 4,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-02-01',
                'id_alumno'         => 4,
            ],
            [
                'id_vulnerabilidad' => 5,
                'id_estado'         => 5,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-02-10',
                'id_alumno'         => 5,
            ],
            [
                'id_vulnerabilidad' => 6,
                'id_estado'         => 6,
                'id_periodo'        => 6,
                'fecha_registro'    => '2026-02-19',
                'id_alumno'         => 6,
            ],
            [
                'id_vulnerabilidad' => 7,
                'id_estado'         => 7,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-02-28',
                'id_alumno'         => 7,
            ],
            [
                'id_vulnerabilidad' => 8,
                'id_estado'         => 8,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-03-09',
                'id_alumno'         => 8,
            ],
            [
                'id_vulnerabilidad' => 9,
                'id_estado'         => 9,
                'id_periodo'        => 9,
                'fecha_registro'    => '2026-03-18',
                'id_alumno'         => 9,
            ],
            [
                'id_vulnerabilidad' => 10,
                'id_estado'         => 10,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-03-27',
                'id_alumno'         => 10,
            ],
            [
                'id_vulnerabilidad' => 11,
                'id_estado'         => 11,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-04-05',
                'id_alumno'         => 11,
            ],
            [
                'id_vulnerabilidad' => 12,
                'id_estado'         => 12,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-04-14',
                'id_alumno'         => 12,
            ],
            [
                'id_vulnerabilidad' => 13,
                'id_estado'         => 13,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-04-23',
                'id_alumno'         => 13,
            ],
            [
                'id_vulnerabilidad' => 14,
                'id_estado'         => 14,
                'id_periodo'        => 12,
                'fecha_registro'    => '2026-05-02',
                'id_alumno'         => 14,
            ],
            [
                'id_vulnerabilidad' => 15,
                'id_estado'         => 15,
                'id_periodo'        => 15,
                'fecha_registro'    => '2026-05-11',
                'id_alumno'         => 15,
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
