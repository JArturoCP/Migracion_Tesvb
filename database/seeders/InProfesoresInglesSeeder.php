<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_profesores_ingles`.
 */
class InProfesoresInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_profesores_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralTiposUsuarioSeeder::class,
            InNivelInglesSeeder::class,
            InSexoSeeder::class,
        ]);

        $tabla = 'in_profesores_ingles';

        $llaves = [
            ['id_profesores'],
        ];

        $registros = [
            [
                'id_profesores'        => 1,
                'nombre'               => 'Daniela',
                'apellido_paterno'     => 'Hernández',
                'apellido_materno'     => 'Mendoza',
                'id_nivel_ingles'      => 1,
                'id_tipo_titulo'       => 1,
                'fecha_emision_titulo' => '2026-01-05',
                'horas_maximas'        => 20,
                'id_sexo'              => 1,
                'id_tipo_usuario'      => 1,
                'updated_at'           => '2026-01-05 09:00:00',
                'created_at'           => '2026-01-05 09:00:00',
                'estado_eliminacion'   => '0',
            ],
            [
                'id_profesores'        => 2,
                'nombre'               => 'Carlos Eduardo',
                'apellido_paterno'     => 'Sánchez',
                'apellido_materno'     => 'Rojas',
                'id_nivel_ingles'      => 2,
                'id_tipo_titulo'       => 2,
                'fecha_emision_titulo' => '2026-01-14',
                'horas_maximas'        => 20,
                'id_sexo'              => 2,
                'id_tipo_usuario'      => 2,
                'updated_at'           => '2026-01-14 10:00:00',
                'created_at'           => '2026-01-14 10:00:00',
                'estado_eliminacion'   => '0',
            ],
            [
                'id_profesores'        => 3,
                'nombre'               => 'Valeria',
                'apellido_paterno'     => 'Jiménez',
                'apellido_materno'     => 'Herrera',
                'id_nivel_ingles'      => 3,
                'id_tipo_titulo'       => 3,
                'fecha_emision_titulo' => '2026-01-23',
                'horas_maximas'        => 20,
                'id_sexo'              => 3,
                'id_tipo_usuario'      => 3,
                'updated_at'           => '2026-01-23 11:00:00',
                'created_at'           => '2026-01-23 11:00:00',
                'estado_eliminacion'   => '0',
            ],
            [
                'id_profesores'        => 4,
                'nombre'               => 'Miguel Ángel',
                'apellido_paterno'     => 'Pérez',
                'apellido_materno'     => 'Vega',
                'id_nivel_ingles'      => 4,
                'id_tipo_titulo'       => 4,
                'fecha_emision_titulo' => '2026-02-01',
                'horas_maximas'        => 20,
                'id_sexo'              => 4,
                'id_tipo_usuario'      => 4,
                'updated_at'           => '2026-02-01 12:00:00',
                'created_at'           => '2026-02-01 12:00:00',
                'estado_eliminacion'   => '0',
            ],
            [
                'id_profesores'        => 5,
                'nombre'               => 'Fernanda',
                'apellido_paterno'     => 'Vázquez',
                'apellido_materno'     => 'Díaz',
                'id_nivel_ingles'      => 5,
                'id_tipo_titulo'       => 5,
                'fecha_emision_titulo' => '2026-02-10',
                'horas_maximas'        => 20,
                'id_sexo'              => 5,
                'id_tipo_usuario'      => 5,
                'updated_at'           => '2026-02-10 13:00:00',
                'created_at'           => '2026-02-10 13:00:00',
                'estado_eliminacion'   => '0',
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
