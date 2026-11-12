<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_materiales_partidas`.
 */
class PresAutMaterialesPartidasSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_materiales_partidas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresAutSolicitudesPartidasSeeder::class,
        ]);

        $tabla = 'pres_aut_materiales_partidas';

        $llaves = [
            ['id_material_partida'],
        ];

        $registros = [
            [
                'id_material_partida'  => 1,
                'id_solicitud_partida' => 1,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 1.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 1',
                'cantidad'             => 1,
                'precio_unitario'      => 1500.0,
                'importe'              => 1500.0,
                'fecha_registro'       => '2026-01-05',
                'fecha_modificacion'   => '2026-01-05',
            ],
            [
                'id_material_partida'  => 2,
                'id_solicitud_partida' => 2,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 2.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 2',
                'cantidad'             => 2,
                'precio_unitario'      => 3000.0,
                'importe'              => 3000.0,
                'fecha_registro'       => '2026-01-14',
                'fecha_modificacion'   => '2026-01-14',
            ],
            [
                'id_material_partida'  => 3,
                'id_solicitud_partida' => 3,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 3.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 3',
                'cantidad'             => 3,
                'precio_unitario'      => 4500.0,
                'importe'              => 4500.0,
                'fecha_registro'       => '2026-01-23',
                'fecha_modificacion'   => '2026-01-23',
            ],
            [
                'id_material_partida'  => 4,
                'id_solicitud_partida' => 4,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 4.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 4',
                'cantidad'             => 4,
                'precio_unitario'      => 6000.0,
                'importe'              => 6000.0,
                'fecha_registro'       => '2026-02-01',
                'fecha_modificacion'   => '2026-02-01',
            ],
            [
                'id_material_partida'  => 5,
                'id_solicitud_partida' => 5,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 5.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 5',
                'cantidad'             => 5,
                'precio_unitario'      => 7500.0,
                'importe'              => 7500.0,
                'fecha_registro'       => '2026-02-10',
                'fecha_modificacion'   => '2026-02-10',
            ],
            [
                'id_material_partida'  => 6,
                'id_solicitud_partida' => 6,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 6.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 6',
                'cantidad'             => 6,
                'precio_unitario'      => 9000.0,
                'importe'              => 9000.0,
                'fecha_registro'       => '2026-02-19',
                'fecha_modificacion'   => '2026-02-19',
            ],
            [
                'id_material_partida'  => 7,
                'id_solicitud_partida' => 7,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 7.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 7',
                'cantidad'             => 7,
                'precio_unitario'      => 10500.0,
                'importe'              => 10500.0,
                'fecha_registro'       => '2026-02-28',
                'fecha_modificacion'   => '2026-02-28',
            ],
            [
                'id_material_partida'  => 8,
                'id_solicitud_partida' => 8,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 8.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 8',
                'cantidad'             => 8,
                'precio_unitario'      => 12000.0,
                'importe'              => 12000.0,
                'fecha_registro'       => '2026-03-09',
                'fecha_modificacion'   => '2026-03-09',
            ],
            [
                'id_material_partida'  => 9,
                'id_solicitud_partida' => 9,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 9.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 9',
                'cantidad'             => 9,
                'precio_unitario'      => 13500.0,
                'importe'              => 13500.0,
                'fecha_registro'       => '2026-03-18',
                'fecha_modificacion'   => '2026-03-18',
            ],
            [
                'id_material_partida'  => 10,
                'id_solicitud_partida' => 10,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 10.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 10',
                'cantidad'             => 10,
                'precio_unitario'      => 15000.0,
                'importe'              => 15000.0,
                'fecha_registro'       => '2026-03-27',
                'fecha_modificacion'   => '2026-03-27',
            ],
            [
                'id_material_partida'  => 11,
                'id_solicitud_partida' => 11,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 11.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 11',
                'cantidad'             => 11,
                'precio_unitario'      => 16500.0,
                'importe'              => 16500.0,
                'fecha_registro'       => '2026-04-05',
                'fecha_modificacion'   => '2026-04-05',
            ],
            [
                'id_material_partida'  => 12,
                'id_solicitud_partida' => 12,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 12.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 12',
                'cantidad'             => 12,
                'precio_unitario'      => 18000.0,
                'importe'              => 18000.0,
                'fecha_registro'       => '2026-04-14',
                'fecha_modificacion'   => '2026-04-14',
            ],
            [
                'id_material_partida'  => 13,
                'id_solicitud_partida' => 13,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 13.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 13',
                'cantidad'             => 13,
                'precio_unitario'      => 19500.0,
                'importe'              => 19500.0,
                'fecha_registro'       => '2026-04-23',
                'fecha_modificacion'   => '2026-04-23',
            ],
            [
                'id_material_partida'  => 14,
                'id_solicitud_partida' => 14,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 14.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 14',
                'cantidad'             => 14,
                'precio_unitario'      => 21000.0,
                'importe'              => 21000.0,
                'fecha_registro'       => '2026-05-02',
                'fecha_modificacion'   => '2026-05-02',
            ],
            [
                'id_material_partida'  => 15,
                'id_solicitud_partida' => 15,
                'descripcion'          => 'Descripcion de aut materiales partidas: registro de prueba número 15.',
                'unidad_medida'        => 'Unidad medida aut materiales partidas 15',
                'cantidad'             => 15,
                'precio_unitario'      => 22500.0,
                'importe'              => 22500.0,
                'fecha_registro'       => '2026-05-11',
                'fecha_modificacion'   => '2026-05-11',
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
