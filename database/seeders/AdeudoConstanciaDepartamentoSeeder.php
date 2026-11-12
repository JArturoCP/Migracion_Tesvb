<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `adeudo_constancia_departamento`.
 */
class AdeudoConstanciaDepartamentoSeeder extends Seeder
{
    /**
     * Pobla la tabla `adeudo_constancia_departamento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralDepartamentosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'adeudo_constancia_departamento';

        $llaves = [
            ['id_adeudo_constancia'],
        ];

        $registros = [
            [
                'id_adeudo_constancia' => 1,
                'id_alumno'            => 1,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 1.',
                'fecha_registro'       => '2026-01-05',
                'id_departamento'      => 0,
            ],
            [
                'id_adeudo_constancia' => 2,
                'id_alumno'            => 2,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 2.',
                'fecha_registro'       => '2026-01-14',
                'id_departamento'      => 1,
            ],
            [
                'id_adeudo_constancia' => 3,
                'id_alumno'            => 3,
                'id_periodo'           => 3,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 3.',
                'fecha_registro'       => '2026-01-23',
                'id_departamento'      => 2,
            ],
            [
                'id_adeudo_constancia' => 4,
                'id_alumno'            => 4,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 4.',
                'fecha_registro'       => '2026-02-01',
                'id_departamento'      => 3,
            ],
            [
                'id_adeudo_constancia' => 5,
                'id_alumno'            => 5,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 5.',
                'fecha_registro'       => '2026-02-10',
                'id_departamento'      => 4,
            ],
            [
                'id_adeudo_constancia' => 6,
                'id_alumno'            => 6,
                'id_periodo'           => 6,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 6.',
                'fecha_registro'       => '2026-02-19',
                'id_departamento'      => 5,
            ],
            [
                'id_adeudo_constancia' => 7,
                'id_alumno'            => 7,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 7.',
                'fecha_registro'       => '2026-02-28',
                'id_departamento'      => 6,
            ],
            [
                'id_adeudo_constancia' => 8,
                'id_alumno'            => 8,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 8.',
                'fecha_registro'       => '2026-03-09',
                'id_departamento'      => 7,
            ],
            [
                'id_adeudo_constancia' => 9,
                'id_alumno'            => 9,
                'id_periodo'           => 9,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 9.',
                'fecha_registro'       => '2026-03-18',
                'id_departamento'      => 8,
            ],
            [
                'id_adeudo_constancia' => 10,
                'id_alumno'            => 10,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 10.',
                'fecha_registro'       => '2026-03-27',
                'id_departamento'      => 9,
            ],
            [
                'id_adeudo_constancia' => 11,
                'id_alumno'            => 11,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 11.',
                'fecha_registro'       => '2026-04-05',
                'id_departamento'      => 10,
            ],
            [
                'id_adeudo_constancia' => 12,
                'id_alumno'            => 12,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 12.',
                'fecha_registro'       => '2026-04-14',
                'id_departamento'      => 0,
            ],
            [
                'id_adeudo_constancia' => 13,
                'id_alumno'            => 13,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 13.',
                'fecha_registro'       => '2026-04-23',
                'id_departamento'      => 1,
            ],
            [
                'id_adeudo_constancia' => 14,
                'id_alumno'            => 14,
                'id_periodo'           => 12,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 14.',
                'fecha_registro'       => '2026-05-02',
                'id_departamento'      => 2,
            ],
            [
                'id_adeudo_constancia' => 15,
                'id_alumno'            => 15,
                'id_periodo'           => 15,
                'comentario'           => 'Comentario de adeudo constancia departamento: registro de prueba número 15.',
                'fecha_registro'       => '2026-05-11',
                'id_departamento'      => 3,
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
