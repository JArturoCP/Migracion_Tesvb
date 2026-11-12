<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_preg_informes`.
 */
class InvPregInformesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_preg_informes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_preg_informes';

        $llaves = [
            ['id_pregunta'],
        ];

        $registros = [
            [
                'id_pregunta' => 1,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 1.',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 2,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 2.',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 3,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 3.',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 4,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 4.',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 5,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 5.',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 6,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 6.',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 7,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 7.',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 8,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 8.',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 9,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 9.',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 10,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 10.',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 11,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 11.',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 12,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 12.',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 13,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 13.',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 14,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 14.',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_pregunta' => 15,
                'descripcion' => 'Descripcion de preg informes: registro de prueba número 15.',
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
                'deleted_at'  => null,
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
