<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_academia`.
 */
class ResiAcademiaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_academia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            ResiCargoAcademiaSeeder::class,
        ]);

        $tabla = 'resi_academia';

        $llaves = [
            ['id_academia'],
        ];

        $registros = [
            [
                'id_academia'       => 1,
                'id_profesor'       => 1,
                'id_carrera'        => 1,
                'id_cargo_academia' => 1,
            ],
            [
                'id_academia'       => 2,
                'id_profesor'       => 2,
                'id_carrera'        => 2,
                'id_cargo_academia' => 2,
            ],
            [
                'id_academia'       => 3,
                'id_profesor'       => 3,
                'id_carrera'        => 3,
                'id_cargo_academia' => 3,
            ],
            [
                'id_academia'       => 4,
                'id_profesor'       => 4,
                'id_carrera'        => 4,
                'id_cargo_academia' => 4,
            ],
            [
                'id_academia'       => 5,
                'id_profesor'       => 5,
                'id_carrera'        => 5,
                'id_cargo_academia' => 5,
            ],
            [
                'id_academia'       => 6,
                'id_profesor'       => 6,
                'id_carrera'        => 6,
                'id_cargo_academia' => 6,
            ],
            [
                'id_academia'       => 7,
                'id_profesor'       => 7,
                'id_carrera'        => 7,
                'id_cargo_academia' => 7,
            ],
            [
                'id_academia'       => 8,
                'id_profesor'       => 8,
                'id_carrera'        => 1,
                'id_cargo_academia' => 8,
            ],
            [
                'id_academia'       => 9,
                'id_profesor'       => 9,
                'id_carrera'        => 2,
                'id_cargo_academia' => 9,
            ],
            [
                'id_academia'       => 10,
                'id_profesor'       => 10,
                'id_carrera'        => 3,
                'id_cargo_academia' => 10,
            ],
            [
                'id_academia'       => 11,
                'id_profesor'       => 11,
                'id_carrera'        => 4,
                'id_cargo_academia' => 11,
            ],
            [
                'id_academia'       => 12,
                'id_profesor'       => 12,
                'id_carrera'        => 5,
                'id_cargo_academia' => 12,
            ],
            [
                'id_academia'       => 13,
                'id_profesor'       => 13,
                'id_carrera'        => 6,
                'id_cargo_academia' => 13,
            ],
            [
                'id_academia'       => 14,
                'id_profesor'       => 14,
                'id_carrera'        => 7,
                'id_cargo_academia' => 14,
            ],
            [
                'id_academia'       => 15,
                'id_profesor'       => 15,
                'id_carrera'        => 1,
                'id_cargo_academia' => 15,
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
