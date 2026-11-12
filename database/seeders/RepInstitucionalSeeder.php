<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rep_institucional`.
 */
class RepInstitucionalSeeder extends Seeder
{
    /**
     * Pobla la tabla `rep_institucional` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'rep_institucional';

        $llaves = [
            ['id_repinstitucional'],
        ];

        $registros = [
            [
                'id_repinstitucional' => 1,
                'id_carrera'          => 1,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 1.',
                'fecha_registro'      => '2026-01-05',
            ],
            [
                'id_repinstitucional' => 2,
                'id_carrera'          => 2,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 2.',
                'fecha_registro'      => '2026-01-14',
            ],
            [
                'id_repinstitucional' => 3,
                'id_carrera'          => 3,
                'id_periodo'          => 3,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 3.',
                'fecha_registro'      => '2026-01-23',
            ],
            [
                'id_repinstitucional' => 4,
                'id_carrera'          => 4,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 4.',
                'fecha_registro'      => '2026-02-01',
            ],
            [
                'id_repinstitucional' => 5,
                'id_carrera'          => 5,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 5.',
                'fecha_registro'      => '2026-02-10',
            ],
            [
                'id_repinstitucional' => 6,
                'id_carrera'          => 6,
                'id_periodo'          => 6,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 6.',
                'fecha_registro'      => '2026-02-19',
            ],
            [
                'id_repinstitucional' => 7,
                'id_carrera'          => 7,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 7.',
                'fecha_registro'      => '2026-02-28',
            ],
            [
                'id_repinstitucional' => 8,
                'id_carrera'          => 1,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 8.',
                'fecha_registro'      => '2026-03-09',
            ],
            [
                'id_repinstitucional' => 9,
                'id_carrera'          => 2,
                'id_periodo'          => 9,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 9.',
                'fecha_registro'      => '2026-03-18',
            ],
            [
                'id_repinstitucional' => 10,
                'id_carrera'          => 3,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 10.',
                'fecha_registro'      => '2026-03-27',
            ],
            [
                'id_repinstitucional' => 11,
                'id_carrera'          => 4,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 11.',
                'fecha_registro'      => '2026-04-05',
            ],
            [
                'id_repinstitucional' => 12,
                'id_carrera'          => 5,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 12.',
                'fecha_registro'      => '2026-04-14',
            ],
            [
                'id_repinstitucional' => 13,
                'id_carrera'          => 6,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 13.',
                'fecha_registro'      => '2026-04-23',
            ],
            [
                'id_repinstitucional' => 14,
                'id_carrera'          => 7,
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 14.',
                'fecha_registro'      => '2026-05-02',
            ],
            [
                'id_repinstitucional' => 15,
                'id_carrera'          => 1,
                'id_periodo'          => 15,
                'observaciones'       => 'Observaciones de institucional: registro de prueba número 15.',
                'fecha_registro'      => '2026-05-11',
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
