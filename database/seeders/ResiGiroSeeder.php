<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_giro`.
 */
class ResiGiroSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_giro` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_giro';

        $llaves = [
            ['id_giro'],
        ];

        $registros = [
            [
                'id_giro'     => 1,
                'descripcion' => 'Descripcion giro 1',
            ],
            [
                'id_giro'     => 2,
                'descripcion' => 'Descripcion giro 2',
            ],
            [
                'id_giro'     => 3,
                'descripcion' => 'Descripcion giro 3',
            ],
            [
                'id_giro'     => 4,
                'descripcion' => 'Descripcion giro 4',
            ],
            [
                'id_giro'     => 5,
                'descripcion' => 'Descripcion giro 5',
            ],
            [
                'id_giro'     => 6,
                'descripcion' => 'Descripcion giro 6',
            ],
            [
                'id_giro'     => 7,
                'descripcion' => 'Descripcion giro 7',
            ],
            [
                'id_giro'     => 8,
                'descripcion' => 'Descripcion giro 8',
            ],
            [
                'id_giro'     => 9,
                'descripcion' => 'Descripcion giro 9',
            ],
            [
                'id_giro'     => 10,
                'descripcion' => 'Descripcion giro 10',
            ],
            [
                'id_giro'     => 11,
                'descripcion' => 'Descripcion giro 11',
            ],
            [
                'id_giro'     => 12,
                'descripcion' => 'Descripcion giro 12',
            ],
            [
                'id_giro'     => 13,
                'descripcion' => 'Descripcion giro 13',
            ],
            [
                'id_giro'     => 14,
                'descripcion' => 'Descripcion giro 14',
            ],
            [
                'id_giro'     => 15,
                'descripcion' => 'Descripcion giro 15',
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
