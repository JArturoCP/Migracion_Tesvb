<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `role_has_permissions`.
 */
class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Pobla la tabla `role_has_permissions` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PermissionsSeeder::class,
            RolesSeeder::class,
        ]);

        $tabla = 'role_has_permissions';

        $llaves = [
            ['permission_id', 'role_id'],
        ];

        $registros = [
            [
                'permission_id' => 1,
                'role_id'       => 1,
            ],
            [
                'permission_id' => 2,
                'role_id'       => 1,
            ],
            [
                'permission_id' => 3,
                'role_id'       => 1,
            ],
            [
                'permission_id' => 4,
                'role_id'       => 1,
            ],
            [
                'permission_id' => 5,
                'role_id'       => 1,
            ],
            [
                'permission_id' => 1,
                'role_id'       => 2,
            ],
            [
                'permission_id' => 2,
                'role_id'       => 2,
            ],
            [
                'permission_id' => 3,
                'role_id'       => 2,
            ],
            [
                'permission_id' => 4,
                'role_id'       => 2,
            ],
            [
                'permission_id' => 5,
                'role_id'       => 2,
            ],
            [
                'permission_id' => 1,
                'role_id'       => 3,
            ],
            [
                'permission_id' => 2,
                'role_id'       => 3,
            ],
            [
                'permission_id' => 3,
                'role_id'       => 3,
            ],
            [
                'permission_id' => 4,
                'role_id'       => 3,
            ],
            [
                'permission_id' => 5,
                'role_id'       => 3,
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
