<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `model_has_permissions`.
 */
class ModelHasPermissionsSeeder extends Seeder
{
    /**
     * Pobla la tabla `model_has_permissions` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PermissionsSeeder::class,
        ]);

        $tabla = 'model_has_permissions';

        $llaves = [
            ['permission_id', 'model_id', 'model_type'],
        ];

        $registros = [
            [
                'permission_id' => 1,
                'model_type'    => 'App\\User',
                'model_id'      => 21,
            ],
            [
                'permission_id' => 2,
                'model_type'    => 'App\\User',
                'model_id'      => 22,
            ],
            [
                'permission_id' => 3,
                'model_type'    => 'App\\User',
                'model_id'      => 23,
            ],
            [
                'permission_id' => 4,
                'model_type'    => 'App\\User',
                'model_id'      => 24,
            ],
            [
                'permission_id' => 5,
                'model_type'    => 'App\\User',
                'model_id'      => 25,
            ],
            [
                'permission_id' => 1,
                'model_type'    => 'App\\User',
                'model_id'      => 26,
            ],
            [
                'permission_id' => 2,
                'model_type'    => 'App\\User',
                'model_id'      => 27,
            ],
            [
                'permission_id' => 3,
                'model_type'    => 'App\\User',
                'model_id'      => 28,
            ],
            [
                'permission_id' => 4,
                'model_type'    => 'App\\User',
                'model_id'      => 29,
            ],
            [
                'permission_id' => 5,
                'model_type'    => 'App\\User',
                'model_id'      => 30,
            ],
            [
                'permission_id' => 1,
                'model_type'    => 'App\\User',
                'model_id'      => 31,
            ],
            [
                'permission_id' => 2,
                'model_type'    => 'App\\User',
                'model_id'      => 32,
            ],
            [
                'permission_id' => 3,
                'model_type'    => 'App\\User',
                'model_id'      => 33,
            ],
            [
                'permission_id' => 4,
                'model_type'    => 'App\\User',
                'model_id'      => 34,
            ],
            [
                'permission_id' => 5,
                'model_type'    => 'App\\User',
                'model_id'      => 35,
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
