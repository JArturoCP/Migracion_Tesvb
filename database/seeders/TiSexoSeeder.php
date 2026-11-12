<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_sexo`.
 */
class TiSexoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_sexo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_sexo';

        $llaves = [
            ['id_sexo'],
        ];

        $registros = [
            [
                'id_sexo' => 1,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 2,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 3,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 4,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 5,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 6,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 7,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 8,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 9,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 10,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 11,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 12,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 13,
                'sexo'    => 'F',
            ],
            [
                'id_sexo' => 14,
                'sexo'    => 'M',
            ],
            [
                'id_sexo' => 15,
                'sexo'    => 'F',
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
