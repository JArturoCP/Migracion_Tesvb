<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de la tabla `computo_user`.
 */
class ComputoUserSeeder extends Seeder
{
    /**
     * Pobla la tabla `computo_user` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'computo_user';

        $llaves = [
            ['id_user_computo'],
        ];

        $registros = [
            [
                'id_user_computo'          => 1,
                'id_unidad_administrativa' => 1,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 2,
                'id_unidad_administrativa' => 2,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 3,
                'id_unidad_administrativa' => 3,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 4,
                'id_unidad_administrativa' => 4,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 5,
                'id_unidad_administrativa' => 5,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 6,
                'id_unidad_administrativa' => 6,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 7,
                'id_unidad_administrativa' => 7,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 8,
                'id_unidad_administrativa' => 8,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 9,
                'id_unidad_administrativa' => 9,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 10,
                'id_unidad_administrativa' => 10,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 11,
                'id_unidad_administrativa' => 11,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 12,
                'id_unidad_administrativa' => 12,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 13,
                'id_unidad_administrativa' => 13,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 14,
                'id_unidad_administrativa' => 14,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
            ],
            [
                'id_user_computo'          => 15,
                'id_unidad_administrativa' => 15,
                'contrasena'               => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
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
