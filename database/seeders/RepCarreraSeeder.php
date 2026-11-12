<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rep_carrera`.
 */
class RepCarreraSeeder extends Seeder
{
    /**
     * Pobla la tabla `rep_carrera` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaGeneracionSeeder::class,
        ]);

        $tabla = 'rep_carrera';

        $llaves = [
            ['id_repcarrera'],
        ];

        $registros = [
            [
                'id_repcarrera'        => 1,
                'id_asigna_generacion' => 1,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 1.',
                'fecha_registro'       => '2026-01-05',
            ],
            [
                'id_repcarrera'        => 2,
                'id_asigna_generacion' => 2,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 2.',
                'fecha_registro'       => '2026-01-14',
            ],
            [
                'id_repcarrera'        => 3,
                'id_asigna_generacion' => 3,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 3.',
                'fecha_registro'       => '2026-01-23',
            ],
            [
                'id_repcarrera'        => 4,
                'id_asigna_generacion' => 4,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 4.',
                'fecha_registro'       => '2026-02-01',
            ],
            [
                'id_repcarrera'        => 5,
                'id_asigna_generacion' => 5,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 5.',
                'fecha_registro'       => '2026-02-10',
            ],
            [
                'id_repcarrera'        => 6,
                'id_asigna_generacion' => 6,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 6.',
                'fecha_registro'       => '2026-02-19',
            ],
            [
                'id_repcarrera'        => 7,
                'id_asigna_generacion' => 7,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 7.',
                'fecha_registro'       => '2026-02-28',
            ],
            [
                'id_repcarrera'        => 8,
                'id_asigna_generacion' => 8,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 8.',
                'fecha_registro'       => '2026-03-09',
            ],
            [
                'id_repcarrera'        => 9,
                'id_asigna_generacion' => 9,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 9.',
                'fecha_registro'       => '2026-03-18',
            ],
            [
                'id_repcarrera'        => 10,
                'id_asigna_generacion' => 10,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 10.',
                'fecha_registro'       => '2026-03-27',
            ],
            [
                'id_repcarrera'        => 11,
                'id_asigna_generacion' => 11,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 11.',
                'fecha_registro'       => '2026-04-05',
            ],
            [
                'id_repcarrera'        => 12,
                'id_asigna_generacion' => 12,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 12.',
                'fecha_registro'       => '2026-04-14',
            ],
            [
                'id_repcarrera'        => 13,
                'id_asigna_generacion' => 13,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 13.',
                'fecha_registro'       => '2026-04-23',
            ],
            [
                'id_repcarrera'        => 14,
                'id_asigna_generacion' => 14,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 14.',
                'fecha_registro'       => '2026-05-02',
            ],
            [
                'id_repcarrera'        => 15,
                'id_asigna_generacion' => 15,
                'observaciones'        => 'Observaciones de carrera: registro de prueba número 15.',
                'fecha_registro'       => '2026-05-11',
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
