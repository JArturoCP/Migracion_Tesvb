<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_sexo`.
 */
class InSexoSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_sexo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_sexo';

        $llaves = [
            ['id_sexo'],
        ];

        $registros = [
            [
                'id_sexo'     => 1,
                'descripcion' => 'Descripcion sexo 1',
            ],
            [
                'id_sexo'     => 2,
                'descripcion' => 'Descripcion sexo 2',
            ],
            [
                'id_sexo'     => 3,
                'descripcion' => 'Descripcion sexo 3',
            ],
            [
                'id_sexo'     => 4,
                'descripcion' => 'Descripcion sexo 4',
            ],
            [
                'id_sexo'     => 5,
                'descripcion' => 'Descripcion sexo 5',
            ],
            [
                'id_sexo'     => 6,
                'descripcion' => 'Descripcion sexo 6',
            ],
            [
                'id_sexo'     => 7,
                'descripcion' => 'Descripcion sexo 7',
            ],
            [
                'id_sexo'     => 8,
                'descripcion' => 'Descripcion sexo 8',
            ],
            [
                'id_sexo'     => 9,
                'descripcion' => 'Descripcion sexo 9',
            ],
            [
                'id_sexo'     => 10,
                'descripcion' => 'Descripcion sexo 10',
            ],
            [
                'id_sexo'     => 11,
                'descripcion' => 'Descripcion sexo 11',
            ],
            [
                'id_sexo'     => 12,
                'descripcion' => 'Descripcion sexo 12',
            ],
            [
                'id_sexo'     => 13,
                'descripcion' => 'Descripcion sexo 13',
            ],
            [
                'id_sexo'     => 14,
                'descripcion' => 'Descripcion sexo 14',
            ],
            [
                'id_sexo'     => 15,
                'descripcion' => 'Descripcion sexo 15',
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
