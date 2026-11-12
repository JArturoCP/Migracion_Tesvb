<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de la tabla `egel_nuevos_docentes`.
 */
class EgelNuevosDocentesSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_nuevos_docentes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'egel_nuevos_docentes';

        $llaves = [
            ['id_egel_nuevo_docente'],
        ];

        $registros = [
            [
                'id_egel_nuevo_docente' => 1,
                'nombre_docente'        => 'María José Hernández Romero',
                'correo'                => 'docentes01@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 1,
                'created_at'            => '2026-01-05 09:00:00',
                'updated_at'            => '2026-01-05 09:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 2,
                'nombre_docente'        => 'Jorge Alberto Sánchez Castillo',
                'correo'                => 'docentes02@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 2,
                'created_at'            => '2026-01-14 10:00:00',
                'updated_at'            => '2026-01-14 10:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 3,
                'nombre_docente'        => 'Daniela Jiménez Torres',
                'correo'                => 'docentes03@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 3,
                'created_at'            => '2026-01-23 11:00:00',
                'updated_at'            => '2026-01-23 11:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 4,
                'nombre_docente'        => 'Carlos Eduardo Pérez Aguilar',
                'correo'                => 'docentes04@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 4,
                'created_at'            => '2026-02-01 12:00:00',
                'updated_at'            => '2026-02-01 12:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 5,
                'nombre_docente'        => 'Valeria Vázquez Navarro',
                'correo'                => 'docentes05@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 5,
                'created_at'            => '2026-02-10 13:00:00',
                'updated_at'            => '2026-02-10 13:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 6,
                'nombre_docente'        => 'Miguel Ángel Rodríguez Ruiz',
                'correo'                => 'docentes06@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 6,
                'created_at'            => '2026-02-19 14:00:00',
                'updated_at'            => '2026-02-19 14:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 7,
                'nombre_docente'        => 'Fernanda Morales Reyes',
                'correo'                => 'docentes07@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 7,
                'created_at'            => '2026-02-28 15:00:00',
                'updated_at'            => '2026-02-28 15:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 8,
                'nombre_docente'        => 'José Antonio González Medina',
                'correo'                => 'docentes08@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 1,
                'created_at'            => '2026-03-09 16:00:00',
                'updated_at'            => '2026-03-09 16:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 9,
                'nombre_docente'        => 'Andrea Gómez Ortiz',
                'correo'                => 'docentes09@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 2,
                'created_at'            => '2026-03-18 08:00:00',
                'updated_at'            => '2026-03-18 08:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 10,
                'nombre_docente'        => 'Diego López Mendoza',
                'correo'                => 'docentes10@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 3,
                'created_at'            => '2026-03-27 09:00:00',
                'updated_at'            => '2026-03-27 09:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 11,
                'nombre_docente'        => 'Paola Flores Rojas',
                'correo'                => 'docentes11@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 4,
                'created_at'            => '2026-04-05 10:00:00',
                'updated_at'            => '2026-04-05 10:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 12,
                'nombre_docente'        => 'Ricardo Martínez Herrera',
                'correo'                => 'docentes12@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 5,
                'created_at'            => '2026-04-14 11:00:00',
                'updated_at'            => '2026-04-14 11:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 13,
                'nombre_docente'        => 'Itzel Cruz Vega',
                'correo'                => 'docentes13@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 6,
                'created_at'            => '2026-04-23 12:00:00',
                'updated_at'            => '2026-04-23 12:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 14,
                'nombre_docente'        => 'Ana Karen Martínez Ruiz',
                'correo'                => 'docentes14@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 7,
                'created_at'            => '2026-05-02 13:00:00',
                'updated_at'            => '2026-05-02 13:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
            ],
            [
                'id_egel_nuevo_docente' => 15,
                'nombre_docente'        => 'Luis Fernando Cruz Reyes',
                'correo'                => 'docentes15@example.com',
                'password'              => Hash::make(UsersSeeder::PASSWORD_PRUEBA),
                'id_carrera'            => 1,
                'created_at'            => '2026-05-11 14:00:00',
                'updated_at'            => '2026-05-11 14:00:00',
                'password_visible'      => UsersSeeder::PASSWORD_PRUEBA,
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
