<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_lineas`.
 */
class InvLineasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_lineas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_lineas';

        $llaves = [
            ['id_linea'],
        ];

        $registros = [
            [
                'id_linea'      => 1,
                'id_carrera'    => 1,
                'clave_linea'   => 'CLV-001',
                'descripcion_l' => 'Descripcion l lineas 1',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 2,
                'id_carrera'    => 2,
                'clave_linea'   => 'CLV-002',
                'descripcion_l' => 'Descripcion l lineas 2',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 3,
                'id_carrera'    => 3,
                'clave_linea'   => 'CLV-003',
                'descripcion_l' => 'Descripcion l lineas 3',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 4,
                'id_carrera'    => 4,
                'clave_linea'   => 'CLV-004',
                'descripcion_l' => 'Descripcion l lineas 4',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 5,
                'id_carrera'    => 5,
                'clave_linea'   => 'CLV-005',
                'descripcion_l' => 'Descripcion l lineas 5',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 6,
                'id_carrera'    => 6,
                'clave_linea'   => 'CLV-006',
                'descripcion_l' => 'Descripcion l lineas 6',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 7,
                'id_carrera'    => 7,
                'clave_linea'   => 'CLV-007',
                'descripcion_l' => 'Descripcion l lineas 7',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 8,
                'id_carrera'    => 8,
                'clave_linea'   => 'CLV-008',
                'descripcion_l' => 'Descripcion l lineas 8',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 9,
                'id_carrera'    => 9,
                'clave_linea'   => 'CLV-009',
                'descripcion_l' => 'Descripcion l lineas 9',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 10,
                'id_carrera'    => 10,
                'clave_linea'   => 'CLV-010',
                'descripcion_l' => 'Descripcion l lineas 10',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 11,
                'id_carrera'    => 11,
                'clave_linea'   => 'CLV-011',
                'descripcion_l' => 'Descripcion l lineas 11',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 12,
                'id_carrera'    => 12,
                'clave_linea'   => 'CLV-012',
                'descripcion_l' => 'Descripcion l lineas 12',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 13,
                'id_carrera'    => 13,
                'clave_linea'   => 'CLV-013',
                'descripcion_l' => 'Descripcion l lineas 13',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 14,
                'id_carrera'    => 14,
                'clave_linea'   => 'CLV-014',
                'descripcion_l' => 'Descripcion l lineas 14',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_linea'      => 15,
                'id_carrera'    => 15,
                'clave_linea'   => 'CLV-015',
                'descripcion_l' => 'Descripcion l lineas 15',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
