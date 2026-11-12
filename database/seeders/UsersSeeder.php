<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de la tabla `users`.
 *
 * Cuentas de acceso de prueba (todas con la contraseña definida en PASSWORD_PRUEBA):
 *  - ingles01@example.com         tipo_usuario=3  Profesor de inglés
 *  - ingles02@example.com         tipo_usuario=3  Profesor de inglés
 *  - ingles03@example.com         tipo_usuario=3  Profesor de inglés
 *  - ingles04@example.com         tipo_usuario=3  Profesor de inglés
 *  - ingles05@example.com         tipo_usuario=3  Profesor de inglés
 *  - alumno01@example.com         tipo_usuario=1  Alumno
 *  - alumno02@example.com         tipo_usuario=1  Alumno
 *  - alumno03@example.com         tipo_usuario=1  Alumno
 *  - alumno04@example.com         tipo_usuario=1  Alumno
 *  - alumno05@example.com         tipo_usuario=1  Alumno
 *  - alumno06@example.com         tipo_usuario=1  Alumno
 *  - alumno07@example.com         tipo_usuario=1  Alumno
 *  - alumno08@example.com         tipo_usuario=1  Alumno
 *  - alumno09@example.com         tipo_usuario=1  Alumno
 *  - alumno10@example.com         tipo_usuario=1  Alumno
 *  - alumno11@example.com         tipo_usuario=1  Alumno
 *  - alumno12@example.com         tipo_usuario=1  Alumno
 *  - alumno13@example.com         tipo_usuario=1  Alumno
 *  - alumno14@example.com         tipo_usuario=1  Alumno
 *  - alumno15@example.com         tipo_usuario=1  Alumno
 *  - docente01@example.com        tipo_usuario=2  Personal - Docencia (departamento 0)
 *  - directivo@example.com        tipo_usuario=2  Personal - Dirección general (departamento 1)
 *  - jefe.division@example.com    tipo_usuario=2  Personal - Jefatura de división (departamento 2)
 *  - desarrollo@example.com       tipo_usuario=2  Personal - Desarrollo académico (departamento 4)
 *  - escolar@example.com          tipo_usuario=2  Personal - Control escolar (departamento 5)
 *  - rh@example.com               tipo_usuario=2  Personal - Recursos humanos (departamento 6)
 *  - computo@example.com          tipo_usuario=2  Personal - Centro de cómputo (departamento 7)
 *  - residencia@example.com       tipo_usuario=2  Personal - Residencias profesionales (departamento 8)
 *  - titulacion@example.com       tipo_usuario=2  Personal - Titulación (departamento 9)
 *  - finanzas@example.com         tipo_usuario=2  Personal - Finanzas (departamento 10)
 *  - consultas@example.com        tipo_usuario=2  Personal - Planeación y consultas (departamento 3)
 *  - docente02@example.com        tipo_usuario=2  Personal - Docencia (departamento 0)
 *  - docente03@example.com        tipo_usuario=2  Personal - Docencia (departamento 0)
 *  - docente04@example.com        tipo_usuario=2  Personal - Docencia (departamento 0)
 *  - docente05@example.com        tipo_usuario=2  Personal - Docencia (departamento 0)
 */
class UsersSeeder extends Seeder
{
    /**
     * Contraseña común de las cuentas de prueba (solo entorno local/desarrollo).
     */
    public const PASSWORD_PRUEBA = 'Tesvb.Prueba2026';

    /**
     * Pobla la tabla `users` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'users';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'             => 1,
                'email'          => 'ingles01@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 3,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'name'           => 'Daniela Hernández Mendoza',
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'email'          => 'ingles02@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 3,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'name'           => 'Carlos Eduardo Sánchez Rojas',
                'deleted_at'     => null,
            ],
            [
                'id'             => 3,
                'email'          => 'ingles03@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 3,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'name'           => 'Valeria Jiménez Herrera',
                'deleted_at'     => null,
            ],
            [
                'id'             => 4,
                'email'          => 'ingles04@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 3,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'name'           => 'Miguel Ángel Pérez Vega',
                'deleted_at'     => null,
            ],
            [
                'id'             => 5,
                'email'          => 'ingles05@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 3,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'name'           => 'Fernanda Vázquez Díaz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 6,
                'email'          => 'alumno01@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'name'           => 'Ana Karen Hernández Reyes',
                'deleted_at'     => null,
            ],
            [
                'id'             => 7,
                'email'          => 'alumno02@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'name'           => 'Luis Fernando Sánchez Medina',
                'deleted_at'     => null,
            ],
            [
                'id'             => 8,
                'email'          => 'alumno03@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'name'           => 'María José Jiménez Ortiz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 9,
                'email'          => 'alumno04@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'name'           => 'Jorge Alberto Pérez Mendoza',
                'deleted_at'     => null,
            ],
            [
                'id'             => 10,
                'email'          => 'alumno05@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'name'           => 'Daniela Vázquez Rojas',
                'deleted_at'     => null,
            ],
            [
                'id'             => 11,
                'email'          => 'alumno06@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'name'           => 'Carlos Eduardo Rodríguez Herrera',
                'deleted_at'     => null,
            ],
            [
                'id'             => 12,
                'email'          => 'alumno07@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'name'           => 'Valeria Morales Vega',
                'deleted_at'     => null,
            ],
            [
                'id'             => 13,
                'email'          => 'alumno08@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'name'           => 'Miguel Ángel González Díaz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 14,
                'email'          => 'alumno09@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'name'           => 'Fernanda Gómez Silva',
                'deleted_at'     => null,
            ],
            [
                'id'             => 15,
                'email'          => 'alumno10@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'name'           => 'José Antonio López Romero',
                'deleted_at'     => null,
            ],
            [
                'id'             => 16,
                'email'          => 'alumno11@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-05-20 15:00:00',
                'updated_at'     => '2026-05-20 15:00:00',
                'name'           => 'Andrea Flores Castillo',
                'deleted_at'     => null,
            ],
            [
                'id'             => 17,
                'email'          => 'alumno12@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-05-29 16:00:00',
                'updated_at'     => '2026-05-29 16:00:00',
                'name'           => 'Diego Martínez Torres',
                'deleted_at'     => null,
            ],
            [
                'id'             => 18,
                'email'          => 'alumno13@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-06-07 08:00:00',
                'updated_at'     => '2026-06-07 08:00:00',
                'name'           => 'Paola Cruz Aguilar',
                'deleted_at'     => null,
            ],
            [
                'id'             => 19,
                'email'          => 'alumno14@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-06-16 09:00:00',
                'updated_at'     => '2026-06-16 09:00:00',
                'name'           => 'Ricardo García Navarro',
                'deleted_at'     => null,
            ],
            [
                'id'             => 20,
                'email'          => 'alumno15@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 1,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-06-25 10:00:00',
                'updated_at'     => '2026-06-25 10:00:00',
                'name'           => 'Itzel Ramírez Ruiz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 21,
                'email'          => 'docente01@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-07-04 11:00:00',
                'updated_at'     => '2026-07-04 11:00:00',
                'name'           => 'María José Hernández Romero',
                'deleted_at'     => null,
            ],
            [
                'id'             => 22,
                'email'          => 'directivo@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-07-13 12:00:00',
                'updated_at'     => '2026-07-13 12:00:00',
                'name'           => 'Jorge Alberto Sánchez Castillo',
                'deleted_at'     => null,
            ],
            [
                'id'             => 23,
                'email'          => 'jefe.division@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-07-22 13:00:00',
                'updated_at'     => '2026-07-22 13:00:00',
                'name'           => 'Daniela Jiménez Torres',
                'deleted_at'     => null,
            ],
            [
                'id'             => 24,
                'email'          => 'desarrollo@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-07-31 14:00:00',
                'updated_at'     => '2026-07-31 14:00:00',
                'name'           => 'Carlos Eduardo Pérez Aguilar',
                'deleted_at'     => null,
            ],
            [
                'id'             => 25,
                'email'          => 'escolar@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-08-09 15:00:00',
                'updated_at'     => '2026-08-09 15:00:00',
                'name'           => 'Valeria Vázquez Navarro',
                'deleted_at'     => null,
            ],
            [
                'id'             => 26,
                'email'          => 'rh@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-08-18 16:00:00',
                'updated_at'     => '2026-08-18 16:00:00',
                'name'           => 'Miguel Ángel Rodríguez Ruiz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 27,
                'email'          => 'computo@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-08-27 08:00:00',
                'updated_at'     => '2026-08-27 08:00:00',
                'name'           => 'Fernanda Morales Reyes',
                'deleted_at'     => null,
            ],
            [
                'id'             => 28,
                'email'          => 'residencia@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-09-05 09:00:00',
                'updated_at'     => '2026-09-05 09:00:00',
                'name'           => 'José Antonio González Medina',
                'deleted_at'     => null,
            ],
            [
                'id'             => 29,
                'email'          => 'titulacion@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-09-14 10:00:00',
                'updated_at'     => '2026-09-14 10:00:00',
                'name'           => 'Andrea Gómez Ortiz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 30,
                'email'          => 'finanzas@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-09-23 11:00:00',
                'updated_at'     => '2026-09-23 11:00:00',
                'name'           => 'Diego López Mendoza',
                'deleted_at'     => null,
            ],
            [
                'id'             => 31,
                'email'          => 'consultas@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-10-02 12:00:00',
                'updated_at'     => '2026-10-02 12:00:00',
                'name'           => 'Paola Flores Rojas',
                'deleted_at'     => null,
            ],
            [
                'id'             => 32,
                'email'          => 'docente02@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-10-11 13:00:00',
                'updated_at'     => '2026-10-11 13:00:00',
                'name'           => 'Ricardo Martínez Herrera',
                'deleted_at'     => null,
            ],
            [
                'id'             => 33,
                'email'          => 'docente03@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-10-20 14:00:00',
                'updated_at'     => '2026-10-20 14:00:00',
                'name'           => 'Itzel Cruz Vega',
                'deleted_at'     => null,
            ],
            [
                'id'             => 34,
                'email'          => 'docente04@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-10-29 15:00:00',
                'updated_at'     => '2026-10-29 15:00:00',
                'name'           => 'Ana Karen Martínez Ruiz',
                'deleted_at'     => null,
            ],
            [
                'id'             => 35,
                'email'          => 'docente05@example.com',
                'password'       => Hash::make(self::PASSWORD_PRUEBA),
                'activated'      => 1,
                'tipo_usuario'   => 2,
                'info_ok'        => 1,
                'remember_token' => null,
                'created_at'     => '2026-11-07 16:00:00',
                'updated_at'     => '2026-11-07 16:00:00',
                'name'           => 'Luis Fernando Cruz Reyes',
                'deleted_at'     => null,
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
