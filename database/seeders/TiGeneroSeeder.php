<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_genero`.
 */
class TiGeneroSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_genero` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_genero';

        $llaves = [
            ['id_genero'],
        ];

        $registros = [
            [
                'id_genero' => 1,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 2,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 3,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 4,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 5,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 6,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 7,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 8,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 9,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 10,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 11,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 12,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 13,
                'genero'    => 'F',
            ],
            [
                'id_genero' => 14,
                'genero'    => 'M',
            ],
            [
                'id_genero' => 15,
                'genero'    => 'F',
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
