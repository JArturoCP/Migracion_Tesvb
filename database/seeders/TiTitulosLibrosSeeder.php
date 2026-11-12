<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_titulos_libros`.
 */
class TiTitulosLibrosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_titulos_libros` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            TiRegDatosAlumSeeder::class,
        ]);

        $tabla = 'ti_titulos_libros';

        $llaves = [
            ['id_titulo_libro'],
        ];

        $registros = [
            [
                'id_titulo_libro'    => 1,
                'id_reg_dato_alumno' => 1,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 1.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 1.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 1.',
                'fecha_registro'     => '2026-01-05',
            ],
            [
                'id_titulo_libro'    => 2,
                'id_reg_dato_alumno' => 2,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 2.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 2.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 2.',
                'fecha_registro'     => '2026-01-14',
            ],
            [
                'id_titulo_libro'    => 3,
                'id_reg_dato_alumno' => 3,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 3.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 3.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 3.',
                'fecha_registro'     => '2026-01-23',
            ],
            [
                'id_titulo_libro'    => 4,
                'id_reg_dato_alumno' => 4,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 4.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 4.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 4.',
                'fecha_registro'     => '2026-02-01',
            ],
            [
                'id_titulo_libro'    => 5,
                'id_reg_dato_alumno' => 5,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 5.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 5.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 5.',
                'fecha_registro'     => '2026-02-10',
            ],
            [
                'id_titulo_libro'    => 6,
                'id_reg_dato_alumno' => 6,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 6.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 6.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 6.',
                'fecha_registro'     => '2026-02-19',
            ],
            [
                'id_titulo_libro'    => 7,
                'id_reg_dato_alumno' => 7,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 7.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 7.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 7.',
                'fecha_registro'     => '2026-02-28',
            ],
            [
                'id_titulo_libro'    => 8,
                'id_reg_dato_alumno' => 8,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 8.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 8.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 8.',
                'fecha_registro'     => '2026-03-09',
            ],
            [
                'id_titulo_libro'    => 9,
                'id_reg_dato_alumno' => 9,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 9.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 9.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 9.',
                'fecha_registro'     => '2026-03-18',
            ],
            [
                'id_titulo_libro'    => 10,
                'id_reg_dato_alumno' => 10,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 10.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 10.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 10.',
                'fecha_registro'     => '2026-03-27',
            ],
            [
                'id_titulo_libro'    => 11,
                'id_reg_dato_alumno' => 11,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 11.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 11.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 11.',
                'fecha_registro'     => '2026-04-05',
            ],
            [
                'id_titulo_libro'    => 12,
                'id_reg_dato_alumno' => 12,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 12.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 12.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 12.',
                'fecha_registro'     => '2026-04-14',
            ],
            [
                'id_titulo_libro'    => 13,
                'id_reg_dato_alumno' => 13,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 13.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 13.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 13.',
                'fecha_registro'     => '2026-04-23',
            ],
            [
                'id_titulo_libro'    => 14,
                'id_reg_dato_alumno' => 14,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 14.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 14.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 14.',
                'fecha_registro'     => '2026-05-02',
            ],
            [
                'id_titulo_libro'    => 15,
                'id_reg_dato_alumno' => 15,
                'titulo'             => 'Titulo de titulos libros: registro de prueba número 15.',
                'autor'              => 'Autor de titulos libros: registro de prueba número 15.',
                'editorial'          => 'Editorial de titulos libros: registro de prueba número 15.',
                'fecha_registro'     => '2026-05-11',
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
