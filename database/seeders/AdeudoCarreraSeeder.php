<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `adeudo_carrera`.
 */
class AdeudoCarreraSeeder extends Seeder
{
    /**
     * Pobla la tabla `adeudo_carrera` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'adeudo_carrera';

        $llaves = [
            ['id_adeudo_carrera'],
        ];

        $registros = [
            [
                'id_adeudo_carrera' => 1,
                'id_carrera'        => 1,
                'id_alumno'         => 1,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 1.',
            ],
            [
                'id_adeudo_carrera' => 2,
                'id_carrera'        => 2,
                'id_alumno'         => 2,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 2.',
            ],
            [
                'id_adeudo_carrera' => 3,
                'id_carrera'        => 3,
                'id_alumno'         => 3,
                'id_periodo'        => 3,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 3.',
            ],
            [
                'id_adeudo_carrera' => 4,
                'id_carrera'        => 4,
                'id_alumno'         => 4,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 4.',
            ],
            [
                'id_adeudo_carrera' => 5,
                'id_carrera'        => 5,
                'id_alumno'         => 5,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 5.',
            ],
            [
                'id_adeudo_carrera' => 6,
                'id_carrera'        => 6,
                'id_alumno'         => 6,
                'id_periodo'        => 6,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 6.',
            ],
            [
                'id_adeudo_carrera' => 7,
                'id_carrera'        => 7,
                'id_alumno'         => 7,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 7.',
            ],
            [
                'id_adeudo_carrera' => 8,
                'id_carrera'        => 1,
                'id_alumno'         => 8,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 8.',
            ],
            [
                'id_adeudo_carrera' => 9,
                'id_carrera'        => 2,
                'id_alumno'         => 9,
                'id_periodo'        => 9,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 9.',
            ],
            [
                'id_adeudo_carrera' => 10,
                'id_carrera'        => 3,
                'id_alumno'         => 10,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 10.',
            ],
            [
                'id_adeudo_carrera' => 11,
                'id_carrera'        => 4,
                'id_alumno'         => 11,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 11.',
            ],
            [
                'id_adeudo_carrera' => 12,
                'id_carrera'        => 5,
                'id_alumno'         => 12,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 12.',
            ],
            [
                'id_adeudo_carrera' => 13,
                'id_carrera'        => 6,
                'id_alumno'         => 13,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 13.',
            ],
            [
                'id_adeudo_carrera' => 14,
                'id_carrera'        => 7,
                'id_alumno'         => 14,
                'id_periodo'        => 12,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 14.',
            ],
            [
                'id_adeudo_carrera' => 15,
                'id_carrera'        => 1,
                'id_alumno'         => 15,
                'id_periodo'        => 15,
                'comentario'        => 'Comentario de adeudo carrera: registro de prueba número 15.',
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
