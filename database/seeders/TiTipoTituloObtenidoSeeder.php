<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipo_titulo_obtenido`.
 */
class TiTipoTituloObtenidoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipo_titulo_obtenido` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'ti_tipo_titulo_obtenido';

        $llaves = [
            ['id_tipo_titulo'],
        ];

        $registros = [
            [
                'id_tipo_titulo' => 1,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 1.',
                'id_carrera'     => 1,
            ],
            [
                'id_tipo_titulo' => 2,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 2.',
                'id_carrera'     => 2,
            ],
            [
                'id_tipo_titulo' => 3,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 3.',
                'id_carrera'     => 3,
            ],
            [
                'id_tipo_titulo' => 4,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 4.',
                'id_carrera'     => 4,
            ],
            [
                'id_tipo_titulo' => 5,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 5.',
                'id_carrera'     => 5,
            ],
            [
                'id_tipo_titulo' => 6,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 6.',
                'id_carrera'     => 6,
            ],
            [
                'id_tipo_titulo' => 7,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 7.',
                'id_carrera'     => 7,
            ],
            [
                'id_tipo_titulo' => 8,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 8.',
                'id_carrera'     => 1,
            ],
            [
                'id_tipo_titulo' => 9,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 9.',
                'id_carrera'     => 2,
            ],
            [
                'id_tipo_titulo' => 10,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 10.',
                'id_carrera'     => 3,
            ],
            [
                'id_tipo_titulo' => 11,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 11.',
                'id_carrera'     => 4,
            ],
            [
                'id_tipo_titulo' => 12,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 12.',
                'id_carrera'     => 5,
            ],
            [
                'id_tipo_titulo' => 13,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 13.',
                'id_carrera'     => 6,
            ],
            [
                'id_tipo_titulo' => 14,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 14.',
                'id_carrera'     => 7,
            ],
            [
                'id_tipo_titulo' => 15,
                'tipo_titulo'    => 'Tipo titulo de tipo titulo obtenido: registro de prueba número 15.',
                'id_carrera'     => 1,
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
