<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `lb_profesores_materia`.
 */
class LbProfesoresMateriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `lb_profesores_materia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
            HrsSemanasSeeder::class,
            LbLaboratoriosSeeder::class,
        ]);

        $tabla = 'lb_profesores_materia';

        $llaves = [
            ['id_profesores_materia'],
        ];

        $registros = [
            [
                'id_profesores_materia' => 1,
                'id_semana'             => 1,
                'id_laboratorio'        => 1,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 1.',
                'id_profesor'           => 1,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 2,
                'id_semana'             => 2,
                'id_laboratorio'        => 2,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 2.',
                'id_profesor'           => 2,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 3,
                'id_semana'             => 3,
                'id_laboratorio'        => 3,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 3.',
                'id_profesor'           => 3,
                'id_periodo'            => 3,
            ],
            [
                'id_profesores_materia' => 4,
                'id_semana'             => 4,
                'id_laboratorio'        => 4,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 4.',
                'id_profesor'           => 4,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 5,
                'id_semana'             => 5,
                'id_laboratorio'        => 5,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 5.',
                'id_profesor'           => 5,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 6,
                'id_semana'             => 6,
                'id_laboratorio'        => 6,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 6.',
                'id_profesor'           => 6,
                'id_periodo'            => 6,
            ],
            [
                'id_profesores_materia' => 7,
                'id_semana'             => 7,
                'id_laboratorio'        => 7,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 7.',
                'id_profesor'           => 7,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 8,
                'id_semana'             => 8,
                'id_laboratorio'        => 8,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 8.',
                'id_profesor'           => 8,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 9,
                'id_semana'             => 9,
                'id_laboratorio'        => 9,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 9.',
                'id_profesor'           => 9,
                'id_periodo'            => 9,
            ],
            [
                'id_profesores_materia' => 10,
                'id_semana'             => 10,
                'id_laboratorio'        => 10,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 10.',
                'id_profesor'           => 10,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 11,
                'id_semana'             => 11,
                'id_laboratorio'        => 11,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 11.',
                'id_profesor'           => 11,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 12,
                'id_semana'             => 12,
                'id_laboratorio'        => 12,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 12.',
                'id_profesor'           => 12,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 13,
                'id_semana'             => 13,
                'id_laboratorio'        => 13,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 13.',
                'id_profesor'           => 13,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 14,
                'id_semana'             => 14,
                'id_laboratorio'        => 14,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 14.',
                'id_profesor'           => 14,
                'id_periodo'            => 12,
            ],
            [
                'id_profesores_materia' => 15,
                'id_semana'             => 15,
                'id_laboratorio'        => 15,
                'descripcion'           => 'Descripcion de profesores materia: registro de prueba número 15.',
                'id_profesor'           => 15,
                'id_periodo'            => 15,
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
