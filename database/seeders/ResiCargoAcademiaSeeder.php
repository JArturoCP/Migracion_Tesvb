<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_cargo_academia`.
 */
class ResiCargoAcademiaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_cargo_academia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_cargo_academia';

        $llaves = [
            ['id_cargo_academia'],
        ];

        $registros = [
            [
                'id_cargo_academia' => 1,
                'cargo'             => 'Cargo cargo academia 1',
            ],
            [
                'id_cargo_academia' => 2,
                'cargo'             => 'Cargo cargo academia 2',
            ],
            [
                'id_cargo_academia' => 3,
                'cargo'             => 'Cargo cargo academia 3',
            ],
            [
                'id_cargo_academia' => 4,
                'cargo'             => 'Cargo cargo academia 4',
            ],
            [
                'id_cargo_academia' => 5,
                'cargo'             => 'Cargo cargo academia 5',
            ],
            [
                'id_cargo_academia' => 6,
                'cargo'             => 'Cargo cargo academia 6',
            ],
            [
                'id_cargo_academia' => 7,
                'cargo'             => 'Cargo cargo academia 7',
            ],
            [
                'id_cargo_academia' => 8,
                'cargo'             => 'Cargo cargo academia 8',
            ],
            [
                'id_cargo_academia' => 9,
                'cargo'             => 'Cargo cargo academia 9',
            ],
            [
                'id_cargo_academia' => 10,
                'cargo'             => 'Cargo cargo academia 10',
            ],
            [
                'id_cargo_academia' => 11,
                'cargo'             => 'Cargo cargo academia 11',
            ],
            [
                'id_cargo_academia' => 12,
                'cargo'             => 'Cargo cargo academia 12',
            ],
            [
                'id_cargo_academia' => 13,
                'cargo'             => 'Cargo cargo academia 13',
            ],
            [
                'id_cargo_academia' => 14,
                'cargo'             => 'Cargo cargo academia 14',
            ],
            [
                'id_cargo_academia' => 15,
                'cargo'             => 'Cargo cargo academia 15',
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
