<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_numeros_titulos`.
 */
class TiNumerosTitulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_numeros_titulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            TiEstadoNumerosTitulosSeeder::class,
            TiRegDomoTitulosSeeder::class,
            TiTipoTitulacionSeeder::class,
        ]);

        $tabla = 'ti_numeros_titulos';

        $llaves = [
            ['id_numero_titulo'],
        ];

        $registros = [
            [
                'id_numero_titulo'         => 1,
                'id_reg_domo'              => 1,
                'numero_titulo'            => 1,
                'fecha_reg'                => '2026-01-05',
                'id_estado_numero_titulo'  => 1,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 1.',
                'id_alumno'                => 1,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 1',
                'id_tipo_titulacion'       => 1,
                'fecha_modificacion'       => '2026-01-05',
            ],
            [
                'id_numero_titulo'         => 2,
                'id_reg_domo'              => 2,
                'numero_titulo'            => 2,
                'fecha_reg'                => '2026-01-14',
                'id_estado_numero_titulo'  => 2,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 2.',
                'id_alumno'                => 2,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 2',
                'id_tipo_titulacion'       => 2,
                'fecha_modificacion'       => '2026-01-14',
            ],
            [
                'id_numero_titulo'         => 3,
                'id_reg_domo'              => 3,
                'numero_titulo'            => 3,
                'fecha_reg'                => '2026-01-23',
                'id_estado_numero_titulo'  => 3,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 3.',
                'id_alumno'                => 3,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 3',
                'id_tipo_titulacion'       => 3,
                'fecha_modificacion'       => '2026-01-23',
            ],
            [
                'id_numero_titulo'         => 4,
                'id_reg_domo'              => 4,
                'numero_titulo'            => 4,
                'fecha_reg'                => '2026-02-01',
                'id_estado_numero_titulo'  => 4,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 4.',
                'id_alumno'                => 4,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 4',
                'id_tipo_titulacion'       => 4,
                'fecha_modificacion'       => '2026-02-01',
            ],
            [
                'id_numero_titulo'         => 5,
                'id_reg_domo'              => 5,
                'numero_titulo'            => 5,
                'fecha_reg'                => '2026-02-10',
                'id_estado_numero_titulo'  => 5,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 5.',
                'id_alumno'                => 5,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 5',
                'id_tipo_titulacion'       => 5,
                'fecha_modificacion'       => '2026-02-10',
            ],
            [
                'id_numero_titulo'         => 6,
                'id_reg_domo'              => 6,
                'numero_titulo'            => 6,
                'fecha_reg'                => '2026-02-19',
                'id_estado_numero_titulo'  => 6,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 6.',
                'id_alumno'                => 6,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 6',
                'id_tipo_titulacion'       => 6,
                'fecha_modificacion'       => '2026-02-19',
            ],
            [
                'id_numero_titulo'         => 7,
                'id_reg_domo'              => 7,
                'numero_titulo'            => 7,
                'fecha_reg'                => '2026-02-28',
                'id_estado_numero_titulo'  => 7,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 7.',
                'id_alumno'                => 7,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 7',
                'id_tipo_titulacion'       => 7,
                'fecha_modificacion'       => '2026-02-28',
            ],
            [
                'id_numero_titulo'         => 8,
                'id_reg_domo'              => 8,
                'numero_titulo'            => 8,
                'fecha_reg'                => '2026-03-09',
                'id_estado_numero_titulo'  => 8,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 8.',
                'id_alumno'                => 8,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 8',
                'id_tipo_titulacion'       => 8,
                'fecha_modificacion'       => '2026-03-09',
            ],
            [
                'id_numero_titulo'         => 9,
                'id_reg_domo'              => 9,
                'numero_titulo'            => 9,
                'fecha_reg'                => '2026-03-18',
                'id_estado_numero_titulo'  => 9,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 9.',
                'id_alumno'                => 9,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 9',
                'id_tipo_titulacion'       => 9,
                'fecha_modificacion'       => '2026-03-18',
            ],
            [
                'id_numero_titulo'         => 10,
                'id_reg_domo'              => 10,
                'numero_titulo'            => 10,
                'fecha_reg'                => '2026-03-27',
                'id_estado_numero_titulo'  => 10,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 10.',
                'id_alumno'                => 10,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 10',
                'id_tipo_titulacion'       => 10,
                'fecha_modificacion'       => '2026-03-27',
            ],
            [
                'id_numero_titulo'         => 11,
                'id_reg_domo'              => 11,
                'numero_titulo'            => 11,
                'fecha_reg'                => '2026-04-05',
                'id_estado_numero_titulo'  => 11,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 11.',
                'id_alumno'                => 11,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 11',
                'id_tipo_titulacion'       => 11,
                'fecha_modificacion'       => '2026-04-05',
            ],
            [
                'id_numero_titulo'         => 12,
                'id_reg_domo'              => 12,
                'numero_titulo'            => 12,
                'fecha_reg'                => '2026-04-14',
                'id_estado_numero_titulo'  => 12,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 12.',
                'id_alumno'                => 12,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 12',
                'id_tipo_titulacion'       => 12,
                'fecha_modificacion'       => '2026-04-14',
            ],
            [
                'id_numero_titulo'         => 13,
                'id_reg_domo'              => 13,
                'numero_titulo'            => 13,
                'fecha_reg'                => '2026-04-23',
                'id_estado_numero_titulo'  => 13,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 13.',
                'id_alumno'                => 13,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 13',
                'id_tipo_titulacion'       => 13,
                'fecha_modificacion'       => '2026-04-23',
            ],
            [
                'id_numero_titulo'         => 14,
                'id_reg_domo'              => 14,
                'numero_titulo'            => 14,
                'fecha_reg'                => '2026-05-02',
                'id_estado_numero_titulo'  => 14,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 14.',
                'id_alumno'                => 14,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 14',
                'id_tipo_titulacion'       => 14,
                'fecha_modificacion'       => '2026-05-02',
            ],
            [
                'id_numero_titulo'         => 15,
                'id_reg_domo'              => 15,
                'numero_titulo'            => 15,
                'fecha_reg'                => '2026-05-11',
                'id_estado_numero_titulo'  => 15,
                'comentario'               => 'Comentario de numeros titulos: registro de prueba número 15.',
                'id_alumno'                => 15,
                'abreviatura_folio_titulo' => 'Abreviatura folio titulo numeros titulos 15',
                'id_tipo_titulacion'       => 15,
                'fecha_modificacion'       => '2026-05-11',
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
