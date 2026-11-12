<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_pregunta`.
 */
class EvaPreguntaSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_pregunta` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaCriterioSeeder::class,
        ]);

        $tabla = 'eva_pregunta';

        $llaves = [
            ['no_pregunta'],
        ];

        $registros = [
            [
                'no_pregunta'     => 1,
                'descripcion'     => 'Descripcion pregunta 1',
                'id_criterio'     => 1,
                'tipo'            => 1,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 1.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 1.',
            ],
            [
                'no_pregunta'     => 2,
                'descripcion'     => 'Descripcion pregunta 2',
                'id_criterio'     => 2,
                'tipo'            => 2,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 2.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 2.',
            ],
            [
                'no_pregunta'     => 3,
                'descripcion'     => 'Descripcion pregunta 3',
                'id_criterio'     => 3,
                'tipo'            => 3,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 3.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 3.',
            ],
            [
                'no_pregunta'     => 4,
                'descripcion'     => 'Descripcion pregunta 4',
                'id_criterio'     => 4,
                'tipo'            => 4,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 4.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 4.',
            ],
            [
                'no_pregunta'     => 5,
                'descripcion'     => 'Descripcion pregunta 5',
                'id_criterio'     => 5,
                'tipo'            => 5,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 5.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 5.',
            ],
            [
                'no_pregunta'     => 6,
                'descripcion'     => 'Descripcion pregunta 6',
                'id_criterio'     => 6,
                'tipo'            => 6,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 6.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 6.',
            ],
            [
                'no_pregunta'     => 7,
                'descripcion'     => 'Descripcion pregunta 7',
                'id_criterio'     => 7,
                'tipo'            => 7,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 7.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 7.',
            ],
            [
                'no_pregunta'     => 8,
                'descripcion'     => 'Descripcion pregunta 8',
                'id_criterio'     => 8,
                'tipo'            => 8,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 8.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 8.',
            ],
            [
                'no_pregunta'     => 9,
                'descripcion'     => 'Descripcion pregunta 9',
                'id_criterio'     => 9,
                'tipo'            => 9,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 9.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 9.',
            ],
            [
                'no_pregunta'     => 10,
                'descripcion'     => 'Descripcion pregunta 10',
                'id_criterio'     => 10,
                'tipo'            => 10,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 10.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 10.',
            ],
            [
                'no_pregunta'     => 11,
                'descripcion'     => 'Descripcion pregunta 11',
                'id_criterio'     => 11,
                'tipo'            => 11,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 11.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 11.',
            ],
            [
                'no_pregunta'     => 12,
                'descripcion'     => 'Descripcion pregunta 12',
                'id_criterio'     => 12,
                'tipo'            => 12,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 12.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 12.',
            ],
            [
                'no_pregunta'     => 13,
                'descripcion'     => 'Descripcion pregunta 13',
                'id_criterio'     => 13,
                'tipo'            => 13,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 13.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 13.',
            ],
            [
                'no_pregunta'     => 14,
                'descripcion'     => 'Descripcion pregunta 14',
                'id_criterio'     => 14,
                'tipo'            => 14,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 14.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 14.',
            ],
            [
                'no_pregunta'     => 15,
                'descripcion'     => 'Descripcion pregunta 15',
                'id_criterio'     => 15,
                'tipo'            => 15,
                'recomendaciones' => 'Recomendaciones de pregunta: registro de prueba número 15.',
                'felicitaciones'  => 'Felicitaciones de pregunta: registro de prueba número 15.',
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
