<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_asesores`.
 */
class ResiAsesoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_asesores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_asesores';

        $llaves = [
            ['id_asesores'],
        ];

        $registros = [
            [
                'id_asesores'     => 1,
                'id_profesor'     => 1,
                'id_carrera'      => 1,
                'id_anteproyecto' => 1,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 2,
                'id_profesor'     => 2,
                'id_carrera'      => 2,
                'id_anteproyecto' => 2,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 3,
                'id_profesor'     => 3,
                'id_carrera'      => 3,
                'id_anteproyecto' => 3,
                'id_periodo'      => 3,
            ],
            [
                'id_asesores'     => 4,
                'id_profesor'     => 4,
                'id_carrera'      => 4,
                'id_anteproyecto' => 4,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 5,
                'id_profesor'     => 5,
                'id_carrera'      => 5,
                'id_anteproyecto' => 5,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 6,
                'id_profesor'     => 6,
                'id_carrera'      => 6,
                'id_anteproyecto' => 6,
                'id_periodo'      => 6,
            ],
            [
                'id_asesores'     => 7,
                'id_profesor'     => 7,
                'id_carrera'      => 7,
                'id_anteproyecto' => 7,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 8,
                'id_profesor'     => 8,
                'id_carrera'      => 1,
                'id_anteproyecto' => 8,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 9,
                'id_profesor'     => 9,
                'id_carrera'      => 2,
                'id_anteproyecto' => 9,
                'id_periodo'      => 9,
            ],
            [
                'id_asesores'     => 10,
                'id_profesor'     => 10,
                'id_carrera'      => 3,
                'id_anteproyecto' => 10,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 11,
                'id_profesor'     => 11,
                'id_carrera'      => 4,
                'id_anteproyecto' => 11,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 12,
                'id_profesor'     => 12,
                'id_carrera'      => 5,
                'id_anteproyecto' => 12,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 13,
                'id_profesor'     => 13,
                'id_carrera'      => 6,
                'id_anteproyecto' => 13,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 14,
                'id_profesor'     => 14,
                'id_carrera'      => 7,
                'id_anteproyecto' => 14,
                'id_periodo'      => 12,
            ],
            [
                'id_asesores'     => 15,
                'id_profesor'     => 15,
                'id_carrera'      => 1,
                'id_anteproyecto' => 15,
                'id_periodo'      => 15,
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
