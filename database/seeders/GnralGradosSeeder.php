<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_grados`.
 */
class GnralGradosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_grados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_grados';

        $llaves = [
            ['id_grado'],
        ];

        $registros = [
            [
                'id_grado' => 1,
                'des'      => 1,
            ],
            [
                'id_grado' => 2,
                'des'      => 2,
            ],
            [
                'id_grado' => 3,
                'des'      => 3,
            ],
            [
                'id_grado' => 4,
                'des'      => 4,
            ],
            [
                'id_grado' => 5,
                'des'      => 5,
            ],
            [
                'id_grado' => 6,
                'des'      => 6,
            ],
            [
                'id_grado' => 7,
                'des'      => 7,
            ],
            [
                'id_grado' => 8,
                'des'      => 8,
            ],
            [
                'id_grado' => 9,
                'des'      => 9,
            ],
            [
                'id_grado' => 10,
                'des'      => 10,
            ],
            [
                'id_grado' => 11,
                'des'      => 11,
            ],
            [
                'id_grado' => 12,
                'des'      => 12,
            ],
            [
                'id_grado' => 13,
                'des'      => 13,
            ],
            [
                'id_grado' => 14,
                'des'      => 14,
            ],
            [
                'id_grado' => 15,
                'des'      => 15,
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
