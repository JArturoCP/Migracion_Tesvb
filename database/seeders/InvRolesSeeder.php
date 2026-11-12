<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_roles`.
 */
class InvRolesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_roles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_roles';

        $llaves = [
            ['id_rol'],
        ];

        $registros = [
            [
                'id_rol'        => 1,
                'descripcion_r' => 'Descripcion r roles 1',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 2,
                'descripcion_r' => 'Descripcion r roles 2',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 3,
                'descripcion_r' => 'Descripcion r roles 3',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 4,
                'descripcion_r' => 'Descripcion r roles 4',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 5,
                'descripcion_r' => 'Descripcion r roles 5',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 6,
                'descripcion_r' => 'Descripcion r roles 6',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 7,
                'descripcion_r' => 'Descripcion r roles 7',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 8,
                'descripcion_r' => 'Descripcion r roles 8',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 9,
                'descripcion_r' => 'Descripcion r roles 9',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 10,
                'descripcion_r' => 'Descripcion r roles 10',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 11,
                'descripcion_r' => 'Descripcion r roles 11',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 12,
                'descripcion_r' => 'Descripcion r roles 12',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 13,
                'descripcion_r' => 'Descripcion r roles 13',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 14,
                'descripcion_r' => 'Descripcion r roles 14',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_rol'        => 15,
                'descripcion_r' => 'Descripcion r roles 15',
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
