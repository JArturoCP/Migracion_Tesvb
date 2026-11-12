<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ipomex_articulos_estatales`.
 */
class IpomexArticulosEstatalesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ipomex_articulos_estatales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ipomex_articulos_estatales';

        $llaves = [
            ['id_articulo_estatal'],
        ];

        $registros = [
            [
                'id_articulo_estatal' => 1,
                'descripcion'         => 1,
            ],
            [
                'id_articulo_estatal' => 2,
                'descripcion'         => 2,
            ],
            [
                'id_articulo_estatal' => 3,
                'descripcion'         => 3,
            ],
            [
                'id_articulo_estatal' => 4,
                'descripcion'         => 4,
            ],
            [
                'id_articulo_estatal' => 5,
                'descripcion'         => 5,
            ],
            [
                'id_articulo_estatal' => 6,
                'descripcion'         => 6,
            ],
            [
                'id_articulo_estatal' => 7,
                'descripcion'         => 7,
            ],
            [
                'id_articulo_estatal' => 8,
                'descripcion'         => 8,
            ],
            [
                'id_articulo_estatal' => 9,
                'descripcion'         => 9,
            ],
            [
                'id_articulo_estatal' => 10,
                'descripcion'         => 10,
            ],
            [
                'id_articulo_estatal' => 11,
                'descripcion'         => 11,
            ],
            [
                'id_articulo_estatal' => 12,
                'descripcion'         => 12,
            ],
            [
                'id_articulo_estatal' => 13,
                'descripcion'         => 13,
            ],
            [
                'id_articulo_estatal' => 14,
                'descripcion'         => 14,
            ],
            [
                'id_articulo_estatal' => 15,
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
