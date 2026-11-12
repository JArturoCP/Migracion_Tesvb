<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ipomex_jefes_articulos`.
 */
class IpomexJefesArticulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ipomex_jefes_articulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            IpomexFraccionesGeneralesSeeder::class,
        ]);

        $tabla = 'ipomex_jefes_articulos';

        $llaves = [
            ['id_jefes_articulos'],
        ];

        $registros = [
            [
                'id_jefes_articulos'  => 1,
                'id_unidad_admin'     => 1,
                'id_fraccion_general' => 1,
            ],
            [
                'id_jefes_articulos'  => 2,
                'id_unidad_admin'     => 2,
                'id_fraccion_general' => 2,
            ],
            [
                'id_jefes_articulos'  => 3,
                'id_unidad_admin'     => 3,
                'id_fraccion_general' => 3,
            ],
            [
                'id_jefes_articulos'  => 4,
                'id_unidad_admin'     => 4,
                'id_fraccion_general' => 4,
            ],
            [
                'id_jefes_articulos'  => 5,
                'id_unidad_admin'     => 5,
                'id_fraccion_general' => 5,
            ],
            [
                'id_jefes_articulos'  => 6,
                'id_unidad_admin'     => 6,
                'id_fraccion_general' => 6,
            ],
            [
                'id_jefes_articulos'  => 7,
                'id_unidad_admin'     => 7,
                'id_fraccion_general' => 7,
            ],
            [
                'id_jefes_articulos'  => 8,
                'id_unidad_admin'     => 8,
                'id_fraccion_general' => 8,
            ],
            [
                'id_jefes_articulos'  => 9,
                'id_unidad_admin'     => 9,
                'id_fraccion_general' => 9,
            ],
            [
                'id_jefes_articulos'  => 10,
                'id_unidad_admin'     => 10,
                'id_fraccion_general' => 10,
            ],
            [
                'id_jefes_articulos'  => 11,
                'id_unidad_admin'     => 11,
                'id_fraccion_general' => 11,
            ],
            [
                'id_jefes_articulos'  => 12,
                'id_unidad_admin'     => 12,
                'id_fraccion_general' => 12,
            ],
            [
                'id_jefes_articulos'  => 13,
                'id_unidad_admin'     => 13,
                'id_fraccion_general' => 13,
            ],
            [
                'id_jefes_articulos'  => 14,
                'id_unidad_admin'     => 14,
                'id_fraccion_general' => 14,
            ],
            [
                'id_jefes_articulos'  => 15,
                'id_unidad_admin'     => 15,
                'id_fraccion_general' => 15,
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
