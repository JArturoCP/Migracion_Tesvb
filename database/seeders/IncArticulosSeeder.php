<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_articulos`.
 */
class IncArticulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_articulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            IncDirigidoSeeder::class,
            IncEstadoEvidenciaSeeder::class,
        ]);

        $tabla = 'inc_articulos';

        $llaves = [
            ['id_articulo'],
        ];

        $registros = [
            [
                'id_articulo'         => 1,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 1.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 1.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 1.',
                'id_estado_evid'      => 1,
                'id_dirigido'         => 1,
            ],
            [
                'id_articulo'         => 2,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 2.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 2.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 2.',
                'id_estado_evid'      => 2,
                'id_dirigido'         => 2,
            ],
            [
                'id_articulo'         => 3,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 3.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 3.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 3.',
                'id_estado_evid'      => 3,
                'id_dirigido'         => 3,
            ],
            [
                'id_articulo'         => 4,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 4.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 4.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 4.',
                'id_estado_evid'      => 4,
                'id_dirigido'         => 4,
            ],
            [
                'id_articulo'         => 5,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 5.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 5.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 5.',
                'id_estado_evid'      => 5,
                'id_dirigido'         => 5,
            ],
            [
                'id_articulo'         => 6,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 6.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 6.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 6.',
                'id_estado_evid'      => 6,
                'id_dirigido'         => 6,
            ],
            [
                'id_articulo'         => 7,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 7.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 7.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 7.',
                'id_estado_evid'      => 7,
                'id_dirigido'         => 7,
            ],
            [
                'id_articulo'         => 8,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 8.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 8.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 8.',
                'id_estado_evid'      => 8,
                'id_dirigido'         => 8,
            ],
            [
                'id_articulo'         => 9,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 9.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 9.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 9.',
                'id_estado_evid'      => 9,
                'id_dirigido'         => 9,
            ],
            [
                'id_articulo'         => 10,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 10.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 10.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 10.',
                'id_estado_evid'      => 10,
                'id_dirigido'         => 10,
            ],
            [
                'id_articulo'         => 11,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 11.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 11.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 11.',
                'id_estado_evid'      => 11,
                'id_dirigido'         => 11,
            ],
            [
                'id_articulo'         => 12,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 12.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 12.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 12.',
                'id_estado_evid'      => 12,
                'id_dirigido'         => 12,
            ],
            [
                'id_articulo'         => 13,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 13.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 13.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 13.',
                'id_estado_evid'      => 13,
                'id_dirigido'         => 13,
            ],
            [
                'id_articulo'         => 14,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 14.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 14.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 14.',
                'id_estado_evid'      => 14,
                'id_dirigido'         => 14,
            ],
            [
                'id_articulo'         => 15,
                'nombre_articulo'     => 'Nombre articulo de articulos: registro de prueba número 15.',
                'nombre_articulosolo' => 'Nombre articulosolo de articulos: registro de prueba número 15.',
                'descripcion_art'     => 'Descripcion art de articulos: registro de prueba número 15.',
                'id_estado_evid'      => 15,
                'id_dirigido'         => 15,
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
