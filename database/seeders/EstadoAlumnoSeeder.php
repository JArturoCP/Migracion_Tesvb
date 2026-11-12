<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `estado_alumno`.
 */
class EstadoAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `estado_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'estado_alumno';

        $llaves = [
            ['id_estado_alumno'],
        ];

        $registros = [
            [
                'id_estado_alumno' => 1,
                'estado'           => 'Estado de estado alumno: registro de prueba número 1.',
            ],
            [
                'id_estado_alumno' => 2,
                'estado'           => 'Estado de estado alumno: registro de prueba número 2.',
            ],
            [
                'id_estado_alumno' => 3,
                'estado'           => 'Estado de estado alumno: registro de prueba número 3.',
            ],
            [
                'id_estado_alumno' => 4,
                'estado'           => 'Estado de estado alumno: registro de prueba número 4.',
            ],
            [
                'id_estado_alumno' => 5,
                'estado'           => 'Estado de estado alumno: registro de prueba número 5.',
            ],
            [
                'id_estado_alumno' => 6,
                'estado'           => 'Estado de estado alumno: registro de prueba número 6.',
            ],
            [
                'id_estado_alumno' => 7,
                'estado'           => 'Estado de estado alumno: registro de prueba número 7.',
            ],
            [
                'id_estado_alumno' => 8,
                'estado'           => 'Estado de estado alumno: registro de prueba número 8.',
            ],
            [
                'id_estado_alumno' => 9,
                'estado'           => 'Estado de estado alumno: registro de prueba número 9.',
            ],
            [
                'id_estado_alumno' => 10,
                'estado'           => 'Estado de estado alumno: registro de prueba número 10.',
            ],
            [
                'id_estado_alumno' => 11,
                'estado'           => 'Estado de estado alumno: registro de prueba número 11.',
            ],
            [
                'id_estado_alumno' => 12,
                'estado'           => 'Estado de estado alumno: registro de prueba número 12.',
            ],
            [
                'id_estado_alumno' => 13,
                'estado'           => 'Estado de estado alumno: registro de prueba número 13.',
            ],
            [
                'id_estado_alumno' => 14,
                'estado'           => 'Estado de estado alumno: registro de prueba número 14.',
            ],
            [
                'id_estado_alumno' => 15,
                'estado'           => 'Estado de estado alumno: registro de prueba número 15.',
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
