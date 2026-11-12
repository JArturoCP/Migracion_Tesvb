<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_promedio_rubros`.
 */
class ResiPromedioRubrosSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_promedio_rubros` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
            ResiCronogramaSeeder::class,
        ]);

        $tabla = 'resi_promedio_rubros';

        $llaves = [
            ['id_promedios'],
        ];

        $registros = [
            [
                'id_promedios'    => 1,
                'id_cronograma'   => 1,
                'id_semana'       => 1,
                'id_anteproyecto' => 1,
                'promedio'        => 77,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 1.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 1.',
            ],
            [
                'id_promedios'    => 2,
                'id_cronograma'   => 2,
                'id_semana'       => 2,
                'id_anteproyecto' => 2,
                'promedio'        => 84,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 2.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 2.',
            ],
            [
                'id_promedios'    => 3,
                'id_cronograma'   => 3,
                'id_semana'       => 3,
                'id_anteproyecto' => 3,
                'promedio'        => 91,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 3.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 3.',
            ],
            [
                'id_promedios'    => 4,
                'id_cronograma'   => 4,
                'id_semana'       => 4,
                'id_anteproyecto' => 4,
                'promedio'        => 98,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 4.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 4.',
            ],
            [
                'id_promedios'    => 5,
                'id_cronograma'   => 5,
                'id_semana'       => 5,
                'id_anteproyecto' => 5,
                'promedio'        => 74,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 5.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 5.',
            ],
            [
                'id_promedios'    => 6,
                'id_cronograma'   => 6,
                'id_semana'       => 6,
                'id_anteproyecto' => 6,
                'promedio'        => 81,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 6.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 6.',
            ],
            [
                'id_promedios'    => 7,
                'id_cronograma'   => 7,
                'id_semana'       => 7,
                'id_anteproyecto' => 7,
                'promedio'        => 88,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 7.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 7.',
            ],
            [
                'id_promedios'    => 8,
                'id_cronograma'   => 8,
                'id_semana'       => 8,
                'id_anteproyecto' => 8,
                'promedio'        => 95,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 8.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 8.',
            ],
            [
                'id_promedios'    => 9,
                'id_cronograma'   => 9,
                'id_semana'       => 9,
                'id_anteproyecto' => 9,
                'promedio'        => 71,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 9.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 9.',
            ],
            [
                'id_promedios'    => 10,
                'id_cronograma'   => 10,
                'id_semana'       => 10,
                'id_anteproyecto' => 10,
                'promedio'        => 78,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 10.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 10.',
            ],
            [
                'id_promedios'    => 11,
                'id_cronograma'   => 11,
                'id_semana'       => 11,
                'id_anteproyecto' => 11,
                'promedio'        => 85,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 11.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 11.',
            ],
            [
                'id_promedios'    => 12,
                'id_cronograma'   => 12,
                'id_semana'       => 12,
                'id_anteproyecto' => 12,
                'promedio'        => 92,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 12.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 12.',
            ],
            [
                'id_promedios'    => 13,
                'id_cronograma'   => 13,
                'id_semana'       => 13,
                'id_anteproyecto' => 13,
                'promedio'        => 99,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 13.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 13.',
            ],
            [
                'id_promedios'    => 14,
                'id_cronograma'   => 14,
                'id_semana'       => 14,
                'id_anteproyecto' => 14,
                'promedio'        => 75,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 14.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 14.',
            ],
            [
                'id_promedios'    => 15,
                'id_cronograma'   => 15,
                'id_semana'       => 15,
                'id_anteproyecto' => 15,
                'promedio'        => 82,
                'observaciones'   => 'Observaciones de promedio rubros: registro de prueba número 15.',
                'pendientes'      => 'Pendientes de promedio rubros: registro de prueba número 15.',
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
