<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_revisores`.
 */
class ResiRevisoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_revisores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'resi_revisores';

        $llaves = [
            ['id_revisores'],
        ];

        $registros = [
            [
                'id_revisores' => 1,
                'id_profesor'  => 1,
                'id_carrera'   => 1,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 2,
                'id_profesor'  => 2,
                'id_carrera'   => 2,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 3,
                'id_profesor'  => 3,
                'id_carrera'   => 3,
                'id_periodo'   => 3,
            ],
            [
                'id_revisores' => 4,
                'id_profesor'  => 4,
                'id_carrera'   => 4,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 5,
                'id_profesor'  => 5,
                'id_carrera'   => 5,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 6,
                'id_profesor'  => 6,
                'id_carrera'   => 6,
                'id_periodo'   => 6,
            ],
            [
                'id_revisores' => 7,
                'id_profesor'  => 7,
                'id_carrera'   => 7,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 8,
                'id_profesor'  => 8,
                'id_carrera'   => 1,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 9,
                'id_profesor'  => 9,
                'id_carrera'   => 2,
                'id_periodo'   => 9,
            ],
            [
                'id_revisores' => 10,
                'id_profesor'  => 10,
                'id_carrera'   => 3,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 11,
                'id_profesor'  => 11,
                'id_carrera'   => 4,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 12,
                'id_profesor'  => 12,
                'id_carrera'   => 5,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 13,
                'id_profesor'  => 13,
                'id_carrera'   => 6,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 14,
                'id_profesor'  => 14,
                'id_carrera'   => 7,
                'id_periodo'   => 12,
            ],
            [
                'id_revisores' => 15,
                'id_profesor'  => 15,
                'id_carrera'   => 1,
                'id_periodo'   => 15,
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
