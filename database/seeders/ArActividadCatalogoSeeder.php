<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_actividad_catalogo`.
 */
class ArActividadCatalogoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_actividad_catalogo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArActividadCategoriasSeeder::class,
        ]);

        $tabla = 'ar_actividad_catalogo';

        $llaves = [
            ['id_actividad_catalogo'],
        ];

        $registros = [
            [
                'id_actividad_catalogo'  => 1,
                'id_categoria_actividad' => 1,
                'nombre'                 => 'Nombre actividad catalogo 1',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 1.',
                'activo'                 => 1,
                'orden'                  => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
            ],
            [
                'id_actividad_catalogo'  => 2,
                'id_categoria_actividad' => 2,
                'nombre'                 => 'Nombre actividad catalogo 2',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 2.',
                'activo'                 => 1,
                'orden'                  => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
            ],
            [
                'id_actividad_catalogo'  => 3,
                'id_categoria_actividad' => 3,
                'nombre'                 => 'Nombre actividad catalogo 3',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 3.',
                'activo'                 => 1,
                'orden'                  => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
            ],
            [
                'id_actividad_catalogo'  => 4,
                'id_categoria_actividad' => 4,
                'nombre'                 => 'Nombre actividad catalogo 4',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 4.',
                'activo'                 => 1,
                'orden'                  => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
            ],
            [
                'id_actividad_catalogo'  => 5,
                'id_categoria_actividad' => 5,
                'nombre'                 => 'Nombre actividad catalogo 5',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 5.',
                'activo'                 => 1,
                'orden'                  => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
            ],
            [
                'id_actividad_catalogo'  => 6,
                'id_categoria_actividad' => 6,
                'nombre'                 => 'Nombre actividad catalogo 6',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 6.',
                'activo'                 => 1,
                'orden'                  => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
            ],
            [
                'id_actividad_catalogo'  => 7,
                'id_categoria_actividad' => 7,
                'nombre'                 => 'Nombre actividad catalogo 7',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 7.',
                'activo'                 => 1,
                'orden'                  => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
            ],
            [
                'id_actividad_catalogo'  => 8,
                'id_categoria_actividad' => 8,
                'nombre'                 => 'Nombre actividad catalogo 8',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 8.',
                'activo'                 => 1,
                'orden'                  => 8,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
            ],
            [
                'id_actividad_catalogo'  => 9,
                'id_categoria_actividad' => 9,
                'nombre'                 => 'Nombre actividad catalogo 9',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 9.',
                'activo'                 => 1,
                'orden'                  => 9,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
            ],
            [
                'id_actividad_catalogo'  => 10,
                'id_categoria_actividad' => 10,
                'nombre'                 => 'Nombre actividad catalogo 10',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 10.',
                'activo'                 => 1,
                'orden'                  => 10,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
            ],
            [
                'id_actividad_catalogo'  => 11,
                'id_categoria_actividad' => 11,
                'nombre'                 => 'Nombre actividad catalogo 11',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 11.',
                'activo'                 => 1,
                'orden'                  => 11,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
            ],
            [
                'id_actividad_catalogo'  => 12,
                'id_categoria_actividad' => 12,
                'nombre'                 => 'Nombre actividad catalogo 12',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 12.',
                'activo'                 => 1,
                'orden'                  => 12,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
            ],
            [
                'id_actividad_catalogo'  => 13,
                'id_categoria_actividad' => 13,
                'nombre'                 => 'Nombre actividad catalogo 13',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 13.',
                'activo'                 => 1,
                'orden'                  => 13,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
            ],
            [
                'id_actividad_catalogo'  => 14,
                'id_categoria_actividad' => 14,
                'nombre'                 => 'Nombre actividad catalogo 14',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 14.',
                'activo'                 => 1,
                'orden'                  => 14,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
            ],
            [
                'id_actividad_catalogo'  => 15,
                'id_categoria_actividad' => 15,
                'nombre'                 => 'Nombre actividad catalogo 15',
                'descripcion'            => 'Descripcion de actividad catalogo: registro de prueba número 15.',
                'activo'                 => 1,
                'orden'                  => 15,
                'created_at'             => '2026-05-11 14:00:00',
                'updated_at'             => '2026-05-11 14:00:00',
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
