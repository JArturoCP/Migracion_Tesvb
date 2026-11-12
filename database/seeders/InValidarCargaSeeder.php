<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_validar_carga`.
 */
class InValidarCargaSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_validar_carga` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'in_validar_carga';

        $llaves = [
            ['id_validar_carga'],
        ];

        $registros = [
            [
                'id_validar_carga' => 1,
                'id_alumno'        => 1,
                'id_periodo'       => 12,
                'id_estado'        => 1,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 1.',
            ],
            [
                'id_validar_carga' => 2,
                'id_alumno'        => 2,
                'id_periodo'       => 12,
                'id_estado'        => 2,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 2.',
            ],
            [
                'id_validar_carga' => 3,
                'id_alumno'        => 3,
                'id_periodo'       => 3,
                'id_estado'        => 3,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 3.',
            ],
            [
                'id_validar_carga' => 4,
                'id_alumno'        => 4,
                'id_periodo'       => 12,
                'id_estado'        => 4,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 4.',
            ],
            [
                'id_validar_carga' => 5,
                'id_alumno'        => 5,
                'id_periodo'       => 12,
                'id_estado'        => 5,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 5.',
            ],
            [
                'id_validar_carga' => 6,
                'id_alumno'        => 6,
                'id_periodo'       => 6,
                'id_estado'        => 6,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 6.',
            ],
            [
                'id_validar_carga' => 7,
                'id_alumno'        => 7,
                'id_periodo'       => 12,
                'id_estado'        => 7,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 7.',
            ],
            [
                'id_validar_carga' => 8,
                'id_alumno'        => 8,
                'id_periodo'       => 12,
                'id_estado'        => 8,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 8.',
            ],
            [
                'id_validar_carga' => 9,
                'id_alumno'        => 9,
                'id_periodo'       => 9,
                'id_estado'        => 9,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 9.',
            ],
            [
                'id_validar_carga' => 10,
                'id_alumno'        => 10,
                'id_periodo'       => 12,
                'id_estado'        => 10,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 10.',
            ],
            [
                'id_validar_carga' => 11,
                'id_alumno'        => 11,
                'id_periodo'       => 12,
                'id_estado'        => 11,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 11.',
            ],
            [
                'id_validar_carga' => 12,
                'id_alumno'        => 12,
                'id_periodo'       => 12,
                'id_estado'        => 12,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 12.',
            ],
            [
                'id_validar_carga' => 13,
                'id_alumno'        => 13,
                'id_periodo'       => 12,
                'id_estado'        => 13,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 13.',
            ],
            [
                'id_validar_carga' => 14,
                'id_alumno'        => 14,
                'id_periodo'       => 12,
                'id_estado'        => 14,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 14.',
            ],
            [
                'id_validar_carga' => 15,
                'id_alumno'        => 15,
                'id_periodo'       => 15,
                'id_estado'        => 15,
                'comentario'       => 'Comentario de validar carga: registro de prueba número 15.',
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
