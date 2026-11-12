<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_comentarios_alcances`.
 */
class ResiComentariosAlcancesSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_comentarios_alcances` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAlcancesSeeder::class,
            ResiAnteproyectoSeeder::class,
            ResiEstadoEvaluacionSeeder::class,
        ]);

        $tabla = 'resi_comentarios_alcances';

        $llaves = [
            ['id_comentario_alcances'],
        ];

        $registros = [
            [
                'id_comentario_alcances' => 1,
                'id_alcances'            => 1,
                'id_anteproyecto'        => 1,
                'id_profesor'            => 1,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 1.',
                'id_estado_evaluacion'   => 1,
                'numero_evaluacion'      => 1,
                'estado_evaluacion'      => 1,
            ],
            [
                'id_comentario_alcances' => 2,
                'id_alcances'            => 2,
                'id_anteproyecto'        => 2,
                'id_profesor'            => 2,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 2.',
                'id_estado_evaluacion'   => 2,
                'numero_evaluacion'      => 2,
                'estado_evaluacion'      => 2,
            ],
            [
                'id_comentario_alcances' => 3,
                'id_alcances'            => 3,
                'id_anteproyecto'        => 3,
                'id_profesor'            => 3,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 3.',
                'id_estado_evaluacion'   => 3,
                'numero_evaluacion'      => 3,
                'estado_evaluacion'      => 3,
            ],
            [
                'id_comentario_alcances' => 4,
                'id_alcances'            => 4,
                'id_anteproyecto'        => 4,
                'id_profesor'            => 4,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 4.',
                'id_estado_evaluacion'   => 4,
                'numero_evaluacion'      => 4,
                'estado_evaluacion'      => 4,
            ],
            [
                'id_comentario_alcances' => 5,
                'id_alcances'            => 5,
                'id_anteproyecto'        => 5,
                'id_profesor'            => 5,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 5.',
                'id_estado_evaluacion'   => 5,
                'numero_evaluacion'      => 5,
                'estado_evaluacion'      => 5,
            ],
            [
                'id_comentario_alcances' => 6,
                'id_alcances'            => 6,
                'id_anteproyecto'        => 6,
                'id_profesor'            => 6,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 6.',
                'id_estado_evaluacion'   => 6,
                'numero_evaluacion'      => 6,
                'estado_evaluacion'      => 6,
            ],
            [
                'id_comentario_alcances' => 7,
                'id_alcances'            => 7,
                'id_anteproyecto'        => 7,
                'id_profesor'            => 7,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 7.',
                'id_estado_evaluacion'   => 7,
                'numero_evaluacion'      => 7,
                'estado_evaluacion'      => 7,
            ],
            [
                'id_comentario_alcances' => 8,
                'id_alcances'            => 8,
                'id_anteproyecto'        => 8,
                'id_profesor'            => 8,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 8.',
                'id_estado_evaluacion'   => 8,
                'numero_evaluacion'      => 8,
                'estado_evaluacion'      => 8,
            ],
            [
                'id_comentario_alcances' => 9,
                'id_alcances'            => 9,
                'id_anteproyecto'        => 9,
                'id_profesor'            => 9,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 9.',
                'id_estado_evaluacion'   => 9,
                'numero_evaluacion'      => 9,
                'estado_evaluacion'      => 9,
            ],
            [
                'id_comentario_alcances' => 10,
                'id_alcances'            => 10,
                'id_anteproyecto'        => 10,
                'id_profesor'            => 10,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 10.',
                'id_estado_evaluacion'   => 10,
                'numero_evaluacion'      => 10,
                'estado_evaluacion'      => 10,
            ],
            [
                'id_comentario_alcances' => 11,
                'id_alcances'            => 11,
                'id_anteproyecto'        => 11,
                'id_profesor'            => 11,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 11.',
                'id_estado_evaluacion'   => 11,
                'numero_evaluacion'      => 11,
                'estado_evaluacion'      => 11,
            ],
            [
                'id_comentario_alcances' => 12,
                'id_alcances'            => 12,
                'id_anteproyecto'        => 12,
                'id_profesor'            => 12,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 12.',
                'id_estado_evaluacion'   => 12,
                'numero_evaluacion'      => 12,
                'estado_evaluacion'      => 12,
            ],
            [
                'id_comentario_alcances' => 13,
                'id_alcances'            => 13,
                'id_anteproyecto'        => 13,
                'id_profesor'            => 13,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 13.',
                'id_estado_evaluacion'   => 13,
                'numero_evaluacion'      => 13,
                'estado_evaluacion'      => 13,
            ],
            [
                'id_comentario_alcances' => 14,
                'id_alcances'            => 14,
                'id_anteproyecto'        => 14,
                'id_profesor'            => 14,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 14.',
                'id_estado_evaluacion'   => 14,
                'numero_evaluacion'      => 14,
                'estado_evaluacion'      => 14,
            ],
            [
                'id_comentario_alcances' => 15,
                'id_alcances'            => 15,
                'id_anteproyecto'        => 15,
                'id_profesor'            => 15,
                'comentario'             => 'Comentario de comentarios alcances: registro de prueba número 15.',
                'id_estado_evaluacion'   => 15,
                'numero_evaluacion'      => 15,
                'estado_evaluacion'      => 15,
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
