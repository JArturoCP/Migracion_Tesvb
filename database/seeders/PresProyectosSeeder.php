<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_proyectos`.
 */
class PresProyectosSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_proyectos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_proyectos';

        $llaves = [
            ['id_proyecto'],
        ];

        $registros = [
            [
                'id_proyecto'        => 1,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 1.',
                'year'               => 2026,
                'id_estado'          => 1,
                'fecha_registro'     => '2026-01-05',
                'fecha_modificacion' => '2026-01-05',
            ],
            [
                'id_proyecto'        => 2,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 2.',
                'year'               => 2026,
                'id_estado'          => 2,
                'fecha_registro'     => '2026-01-14',
                'fecha_modificacion' => '2026-01-14',
            ],
            [
                'id_proyecto'        => 3,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 3.',
                'year'               => 2026,
                'id_estado'          => 3,
                'fecha_registro'     => '2026-01-23',
                'fecha_modificacion' => '2026-01-23',
            ],
            [
                'id_proyecto'        => 4,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 4.',
                'year'               => 2026,
                'id_estado'          => 4,
                'fecha_registro'     => '2026-02-01',
                'fecha_modificacion' => '2026-02-01',
            ],
            [
                'id_proyecto'        => 5,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 5.',
                'year'               => 2026,
                'id_estado'          => 5,
                'fecha_registro'     => '2026-02-10',
                'fecha_modificacion' => '2026-02-10',
            ],
            [
                'id_proyecto'        => 6,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 6.',
                'year'               => 2026,
                'id_estado'          => 6,
                'fecha_registro'     => '2026-02-19',
                'fecha_modificacion' => '2026-02-19',
            ],
            [
                'id_proyecto'        => 7,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 7.',
                'year'               => 2026,
                'id_estado'          => 7,
                'fecha_registro'     => '2026-02-28',
                'fecha_modificacion' => '2026-02-28',
            ],
            [
                'id_proyecto'        => 8,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 8.',
                'year'               => 2026,
                'id_estado'          => 8,
                'fecha_registro'     => '2026-03-09',
                'fecha_modificacion' => '2026-03-09',
            ],
            [
                'id_proyecto'        => 9,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 9.',
                'year'               => 2026,
                'id_estado'          => 9,
                'fecha_registro'     => '2026-03-18',
                'fecha_modificacion' => '2026-03-18',
            ],
            [
                'id_proyecto'        => 10,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 10.',
                'year'               => 2026,
                'id_estado'          => 10,
                'fecha_registro'     => '2026-03-27',
                'fecha_modificacion' => '2026-03-27',
            ],
            [
                'id_proyecto'        => 11,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 11.',
                'year'               => 2026,
                'id_estado'          => 11,
                'fecha_registro'     => '2026-04-05',
                'fecha_modificacion' => '2026-04-05',
            ],
            [
                'id_proyecto'        => 12,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 12.',
                'year'               => 2026,
                'id_estado'          => 12,
                'fecha_registro'     => '2026-04-14',
                'fecha_modificacion' => '2026-04-14',
            ],
            [
                'id_proyecto'        => 13,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 13.',
                'year'               => 2026,
                'id_estado'          => 13,
                'fecha_registro'     => '2026-04-23',
                'fecha_modificacion' => '2026-04-23',
            ],
            [
                'id_proyecto'        => 14,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 14.',
                'year'               => 2026,
                'id_estado'          => 14,
                'fecha_registro'     => '2026-05-02',
                'fecha_modificacion' => '2026-05-02',
            ],
            [
                'id_proyecto'        => 15,
                'nombre_proyecto'    => 'Nombre proyecto de proyectos: registro de prueba número 15.',
                'year'               => 2026,
                'id_estado'          => 15,
                'fecha_registro'     => '2026-05-11',
                'fecha_modificacion' => '2026-05-11',
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
