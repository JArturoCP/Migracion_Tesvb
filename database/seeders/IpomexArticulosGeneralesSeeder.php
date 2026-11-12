<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ipomex_articulos_generales`.
 */
class IpomexArticulosGeneralesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ipomex_articulos_generales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ipomex_articulos_generales';

        $llaves = [
            ['id_articulo_general'],
        ];

        $registros = [
            [
                'id_articulo_general' => 1,
                'descripcion'         => 1,
            ],
            [
                'id_articulo_general' => 2,
                'descripcion'         => 2,
            ],
            [
                'id_articulo_general' => 3,
                'descripcion'         => 3,
            ],
            [
                'id_articulo_general' => 4,
                'descripcion'         => 4,
            ],
            [
                'id_articulo_general' => 5,
                'descripcion'         => 5,
            ],
            [
                'id_articulo_general' => 6,
                'descripcion'         => 6,
            ],
            [
                'id_articulo_general' => 7,
                'descripcion'         => 7,
            ],
            [
                'id_articulo_general' => 8,
                'descripcion'         => 8,
            ],
            [
                'id_articulo_general' => 9,
                'descripcion'         => 9,
            ],
            [
                'id_articulo_general' => 10,
                'descripcion'         => 10,
            ],
            [
                'id_articulo_general' => 11,
                'descripcion'         => 11,
            ],
            [
                'id_articulo_general' => 12,
                'descripcion'         => 12,
            ],
            [
                'id_articulo_general' => 13,
                'descripcion'         => 13,
            ],
            [
                'id_articulo_general' => 14,
                'descripcion'         => 14,
            ],
            [
                'id_articulo_general' => 15,
                'descripcion'         => 15,
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
