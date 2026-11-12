<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_sector`.
 */
class ResiSectorSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_sector` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_sector';

        $llaves = [
            ['id_sector'],
        ];

        $registros = [
            [
                'id_sector'   => 1,
                'descripcion' => 'Descripcion sector 1',
            ],
            [
                'id_sector'   => 2,
                'descripcion' => 'Descripcion sector 2',
            ],
            [
                'id_sector'   => 3,
                'descripcion' => 'Descripcion sector 3',
            ],
            [
                'id_sector'   => 4,
                'descripcion' => 'Descripcion sector 4',
            ],
            [
                'id_sector'   => 5,
                'descripcion' => 'Descripcion sector 5',
            ],
            [
                'id_sector'   => 6,
                'descripcion' => 'Descripcion sector 6',
            ],
            [
                'id_sector'   => 7,
                'descripcion' => 'Descripcion sector 7',
            ],
            [
                'id_sector'   => 8,
                'descripcion' => 'Descripcion sector 8',
            ],
            [
                'id_sector'   => 9,
                'descripcion' => 'Descripcion sector 9',
            ],
            [
                'id_sector'   => 10,
                'descripcion' => 'Descripcion sector 10',
            ],
            [
                'id_sector'   => 11,
                'descripcion' => 'Descripcion sector 11',
            ],
            [
                'id_sector'   => 12,
                'descripcion' => 'Descripcion sector 12',
            ],
            [
                'id_sector'   => 13,
                'descripcion' => 'Descripcion sector 13',
            ],
            [
                'id_sector'   => 14,
                'descripcion' => 'Descripcion sector 14',
            ],
            [
                'id_sector'   => 15,
                'descripcion' => 'Descripcion sector 15',
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
