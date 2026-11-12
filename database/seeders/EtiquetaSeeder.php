<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `etiqueta`.
 */
class EtiquetaSeeder extends Seeder
{
    /**
     * Pobla la tabla `etiqueta` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'etiqueta';

        $llaves = [
            ['id_etiqueta'],
        ];

        $registros = [
            [
                'id_etiqueta' => 1,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 1.',
            ],
            [
                'id_etiqueta' => 2,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 2.',
            ],
            [
                'id_etiqueta' => 3,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 3.',
            ],
            [
                'id_etiqueta' => 4,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 4.',
            ],
            [
                'id_etiqueta' => 5,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 5.',
            ],
            [
                'id_etiqueta' => 6,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 6.',
            ],
            [
                'id_etiqueta' => 7,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 7.',
            ],
            [
                'id_etiqueta' => 8,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 8.',
            ],
            [
                'id_etiqueta' => 9,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 9.',
            ],
            [
                'id_etiqueta' => 10,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 10.',
            ],
            [
                'id_etiqueta' => 11,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 11.',
            ],
            [
                'id_etiqueta' => 12,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 12.',
            ],
            [
                'id_etiqueta' => 13,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 13.',
            ],
            [
                'id_etiqueta' => 14,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 14.',
            ],
            [
                'id_etiqueta' => 15,
                'descripcion' => 'Descripcion de etiqueta: registro de prueba número 15.',
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
