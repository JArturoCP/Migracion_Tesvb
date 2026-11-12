<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_control_modulos`.
 */
class AudControlModulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_control_modulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_control_modulos';

        $llaves = [
            ['id_control'],
            ['clave_modulo'],
        ];

        $registros = [
            [
                'id_control'      => 1,
                'clave_modulo'    => 'CLV-001',
                'nombre_modulo'   => 'Nombre modulo control modulos 1',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 1.',
                'actualizado_por' => 1,
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 2,
                'clave_modulo'    => 'CLV-002',
                'nombre_modulo'   => 'Nombre modulo control modulos 2',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 2.',
                'actualizado_por' => 2,
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 3,
                'clave_modulo'    => 'CLV-003',
                'nombre_modulo'   => 'Nombre modulo control modulos 3',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 3.',
                'actualizado_por' => 3,
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 4,
                'clave_modulo'    => 'CLV-004',
                'nombre_modulo'   => 'Nombre modulo control modulos 4',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 4.',
                'actualizado_por' => 4,
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 5,
                'clave_modulo'    => 'CLV-005',
                'nombre_modulo'   => 'Nombre modulo control modulos 5',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 5.',
                'actualizado_por' => 5,
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 6,
                'clave_modulo'    => 'CLV-006',
                'nombre_modulo'   => 'Nombre modulo control modulos 6',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 6.',
                'actualizado_por' => 6,
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 7,
                'clave_modulo'    => 'CLV-007',
                'nombre_modulo'   => 'Nombre modulo control modulos 7',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 7.',
                'actualizado_por' => 7,
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 8,
                'clave_modulo'    => 'CLV-008',
                'nombre_modulo'   => 'Nombre modulo control modulos 8',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 8.',
                'actualizado_por' => 8,
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 9,
                'clave_modulo'    => 'CLV-009',
                'nombre_modulo'   => 'Nombre modulo control modulos 9',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 9.',
                'actualizado_por' => 9,
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 10,
                'clave_modulo'    => 'CLV-010',
                'nombre_modulo'   => 'Nombre modulo control modulos 10',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 10.',
                'actualizado_por' => 10,
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 11,
                'clave_modulo'    => 'CLV-011',
                'nombre_modulo'   => 'Nombre modulo control modulos 11',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 11.',
                'actualizado_por' => 11,
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 12,
                'clave_modulo'    => 'CLV-012',
                'nombre_modulo'   => 'Nombre modulo control modulos 12',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 12.',
                'actualizado_por' => 12,
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 13,
                'clave_modulo'    => 'CLV-013',
                'nombre_modulo'   => 'Nombre modulo control modulos 13',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 13.',
                'actualizado_por' => 13,
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 14,
                'clave_modulo'    => 'CLV-014',
                'nombre_modulo'   => 'Nombre modulo control modulos 14',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 14.',
                'actualizado_por' => 14,
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_control'      => 15,
                'clave_modulo'    => 'CLV-015',
                'nombre_modulo'   => 'Nombre modulo control modulos 15',
                'cerrado'         => 1,
                'mensaje_cierre'  => 'Mensaje cierre de control modulos: registro de prueba número 15.',
                'actualizado_por' => 15,
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
                'deleted_at'      => null,
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
