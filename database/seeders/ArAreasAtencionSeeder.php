<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_areas_atencion`.
 */
class ArAreasAtencionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_areas_atencion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ar_areas_atencion';

        $llaves = [
            ['id_area_atencion'],
            ['nombre'],
        ];

        $registros = [
            [
                'id_area_atencion'       => 1,
                'nombre'                 => 'Nombre areas atencion 1',
                'descripcion'            => 'Descripcion areas atencion 1',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
            ],
            [
                'id_area_atencion'       => 2,
                'nombre'                 => 'Nombre areas atencion 2',
                'descripcion'            => 'Descripcion areas atencion 2',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
            ],
            [
                'id_area_atencion'       => 3,
                'nombre'                 => 'Nombre areas atencion 3',
                'descripcion'            => 'Descripcion areas atencion 3',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
            ],
            [
                'id_area_atencion'       => 4,
                'nombre'                 => 'Nombre areas atencion 4',
                'descripcion'            => 'Descripcion areas atencion 4',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
            ],
            [
                'id_area_atencion'       => 5,
                'nombre'                 => 'Nombre areas atencion 5',
                'descripcion'            => 'Descripcion areas atencion 5',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
            ],
            [
                'id_area_atencion'       => 6,
                'nombre'                 => 'Nombre areas atencion 6',
                'descripcion'            => 'Descripcion areas atencion 6',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
            ],
            [
                'id_area_atencion'       => 7,
                'nombre'                 => 'Nombre areas atencion 7',
                'descripcion'            => 'Descripcion areas atencion 7',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
            ],
            [
                'id_area_atencion'       => 8,
                'nombre'                 => 'Nombre areas atencion 8',
                'descripcion'            => 'Descripcion areas atencion 8',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 8,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
            ],
            [
                'id_area_atencion'       => 9,
                'nombre'                 => 'Nombre areas atencion 9',
                'descripcion'            => 'Descripcion areas atencion 9',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 9,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
            ],
            [
                'id_area_atencion'       => 10,
                'nombre'                 => 'Nombre areas atencion 10',
                'descripcion'            => 'Descripcion areas atencion 10',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 10,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
            ],
            [
                'id_area_atencion'       => 11,
                'nombre'                 => 'Nombre areas atencion 11',
                'descripcion'            => 'Descripcion areas atencion 11',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 11,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
            ],
            [
                'id_area_atencion'       => 12,
                'nombre'                 => 'Nombre areas atencion 12',
                'descripcion'            => 'Descripcion areas atencion 12',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 12,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
            ],
            [
                'id_area_atencion'       => 13,
                'nombre'                 => 'Nombre areas atencion 13',
                'descripcion'            => 'Descripcion areas atencion 13',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 13,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
            ],
            [
                'id_area_atencion'       => 14,
                'nombre'                 => 'Nombre areas atencion 14',
                'descripcion'            => 'Descripcion areas atencion 14',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
                'orden'                  => 14,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
            ],
            [
                'id_area_atencion'       => 15,
                'nombre'                 => 'Nombre areas atencion 15',
                'descripcion'            => 'Descripcion areas atencion 15',
                'activo'                 => 1,
                'requiere_citas'         => 1,
                'requiere_actividades'   => 1,
                'maneja_datos_sensibles' => 1,
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
