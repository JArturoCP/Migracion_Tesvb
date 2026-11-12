<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_secciones`.
 */
class EgelSeccionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_secciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
        ]);

        $tabla = 'egel_secciones';

        $llaves = [
            ['id_seccion'],
        ];

        $registros = [
            [
                'id_seccion'     => 1,
                'nombre'         => 'Nombre secciones 1',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 1.',
                'activo'         => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'id_examen_egel' => 1,
            ],
            [
                'id_seccion'     => 2,
                'nombre'         => 'Nombre secciones 2',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 2.',
                'activo'         => 1,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'id_examen_egel' => 2,
            ],
            [
                'id_seccion'     => 3,
                'nombre'         => 'Nombre secciones 3',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 3.',
                'activo'         => 1,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'id_examen_egel' => 3,
            ],
            [
                'id_seccion'     => 4,
                'nombre'         => 'Nombre secciones 4',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 4.',
                'activo'         => 1,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'id_examen_egel' => 4,
            ],
            [
                'id_seccion'     => 5,
                'nombre'         => 'Nombre secciones 5',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 5.',
                'activo'         => 1,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'id_examen_egel' => 5,
            ],
            [
                'id_seccion'     => 6,
                'nombre'         => 'Nombre secciones 6',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 6.',
                'activo'         => 1,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'id_examen_egel' => 6,
            ],
            [
                'id_seccion'     => 7,
                'nombre'         => 'Nombre secciones 7',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 7.',
                'activo'         => 1,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'id_examen_egel' => 7,
            ],
            [
                'id_seccion'     => 8,
                'nombre'         => 'Nombre secciones 8',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 8.',
                'activo'         => 1,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'id_examen_egel' => 8,
            ],
            [
                'id_seccion'     => 9,
                'nombre'         => 'Nombre secciones 9',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 9.',
                'activo'         => 1,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'id_examen_egel' => 9,
            ],
            [
                'id_seccion'     => 10,
                'nombre'         => 'Nombre secciones 10',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 10.',
                'activo'         => 1,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'id_examen_egel' => 10,
            ],
            [
                'id_seccion'     => 11,
                'nombre'         => 'Nombre secciones 11',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 11.',
                'activo'         => 1,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'id_examen_egel' => 11,
            ],
            [
                'id_seccion'     => 12,
                'nombre'         => 'Nombre secciones 12',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 12.',
                'activo'         => 1,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'id_examen_egel' => 12,
            ],
            [
                'id_seccion'     => 13,
                'nombre'         => 'Nombre secciones 13',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 13.',
                'activo'         => 1,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'id_examen_egel' => 13,
            ],
            [
                'id_seccion'     => 14,
                'nombre'         => 'Nombre secciones 14',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 14.',
                'activo'         => 1,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'id_examen_egel' => 14,
            ],
            [
                'id_seccion'     => 15,
                'nombre'         => 'Nombre secciones 15',
                'descripcion'    => 'Descripcion de secciones: registro de prueba número 15.',
                'activo'         => 1,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'id_examen_egel' => 15,
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
