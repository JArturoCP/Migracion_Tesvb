<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_periodo_carreras`.
 */
class GnralPeriodoCarrerasSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_periodo_carreras` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'gnral_periodo_carreras';

        $llaves = [
            ['id_periodo_carrera'],
        ];

        $registros = [
            [
                'id_periodo_carrera' => 1,
                'id_carrera'         => 1,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 2,
                'id_carrera'         => 2,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 3,
                'id_carrera'         => 3,
                'id_periodo'         => 3,
            ],
            [
                'id_periodo_carrera' => 4,
                'id_carrera'         => 4,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 5,
                'id_carrera'         => 5,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 6,
                'id_carrera'         => 6,
                'id_periodo'         => 6,
            ],
            [
                'id_periodo_carrera' => 7,
                'id_carrera'         => 7,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 8,
                'id_carrera'         => 1,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 9,
                'id_carrera'         => 2,
                'id_periodo'         => 9,
            ],
            [
                'id_periodo_carrera' => 10,
                'id_carrera'         => 3,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 11,
                'id_carrera'         => 4,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 12,
                'id_carrera'         => 5,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 13,
                'id_carrera'         => 6,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 14,
                'id_carrera'         => 7,
                'id_periodo'         => 12,
            ],
            [
                'id_periodo_carrera' => 15,
                'id_carrera'         => 1,
                'id_periodo'         => 15,
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
