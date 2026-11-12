<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `model_has_roles`.
 */
class ModelHasRolesSeeder extends Seeder
{
    /**
     * Pobla la tabla `model_has_roles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RolesSeeder::class,
        ]);

        $tabla = 'model_has_roles';

        $llaves = [
            ['role_id', 'model_id', 'model_type'],
        ];

        $registros = [
            [
                'role_id'    => 1,
                'model_type' => 'App\\User',
                'model_id'   => 21,
            ],
            [
                'role_id'    => 2,
                'model_type' => 'App\\User',
                'model_id'   => 22,
            ],
            [
                'role_id'    => 3,
                'model_type' => 'App\\User',
                'model_id'   => 23,
            ],
            [
                'role_id'    => 4,
                'model_type' => 'App\\User',
                'model_id'   => 24,
            ],
            [
                'role_id'    => 5,
                'model_type' => 'App\\User',
                'model_id'   => 25,
            ],
            [
                'role_id'    => 1,
                'model_type' => 'App\\User',
                'model_id'   => 26,
            ],
            [
                'role_id'    => 2,
                'model_type' => 'App\\User',
                'model_id'   => 27,
            ],
            [
                'role_id'    => 3,
                'model_type' => 'App\\User',
                'model_id'   => 28,
            ],
            [
                'role_id'    => 4,
                'model_type' => 'App\\User',
                'model_id'   => 29,
            ],
            [
                'role_id'    => 5,
                'model_type' => 'App\\User',
                'model_id'   => 30,
            ],
            [
                'role_id'    => 1,
                'model_type' => 'App\\User',
                'model_id'   => 31,
            ],
            [
                'role_id'    => 2,
                'model_type' => 'App\\User',
                'model_id'   => 32,
            ],
            [
                'role_id'    => 3,
                'model_type' => 'App\\User',
                'model_id'   => 33,
            ],
            [
                'role_id'    => 4,
                'model_type' => 'App\\User',
                'model_id'   => 34,
            ],
            [
                'role_id'    => 5,
                'model_type' => 'App\\User',
                'model_id'   => 35,
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
