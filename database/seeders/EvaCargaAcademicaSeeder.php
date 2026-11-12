<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_carga_academica`.
 */
class EvaCargaAcademicaSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_carga_academica` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralMateriasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'eva_carga_academica';

        $llaves = [
            ['id_carga_academica'],
        ];

        $registros = [
            [
                'id_carga_academica' => 1,
                'id_alumno'          => 1,
                'id_materia'         => 1,
                'id_status_materia'  => 1,
                'id_tipo_curso'      => 1,
                'id_periodo'         => 12,
                'grupo'              => 1,
                'tipo_alumno'        => 'Tipo alumno carga academica 1',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
            ],
            [
                'id_carga_academica' => 2,
                'id_alumno'          => 2,
                'id_materia'         => 2,
                'id_status_materia'  => 2,
                'id_tipo_curso'      => 2,
                'id_periodo'         => 12,
                'grupo'              => 2,
                'tipo_alumno'        => 'Tipo alumno carga academica 2',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
            ],
            [
                'id_carga_academica' => 3,
                'id_alumno'          => 3,
                'id_materia'         => 3,
                'id_status_materia'  => 3,
                'id_tipo_curso'      => 3,
                'id_periodo'         => 3,
                'grupo'              => 3,
                'tipo_alumno'        => 'Tipo alumno carga academica 3',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
            ],
            [
                'id_carga_academica' => 4,
                'id_alumno'          => 4,
                'id_materia'         => 4,
                'id_status_materia'  => 4,
                'id_tipo_curso'      => 4,
                'id_periodo'         => 12,
                'grupo'              => 4,
                'tipo_alumno'        => 'Tipo alumno carga academica 4',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
            ],
            [
                'id_carga_academica' => 5,
                'id_alumno'          => 5,
                'id_materia'         => 5,
                'id_status_materia'  => 5,
                'id_tipo_curso'      => 5,
                'id_periodo'         => 12,
                'grupo'              => 5,
                'tipo_alumno'        => 'Tipo alumno carga academica 5',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
            ],
            [
                'id_carga_academica' => 6,
                'id_alumno'          => 6,
                'id_materia'         => 6,
                'id_status_materia'  => 6,
                'id_tipo_curso'      => 6,
                'id_periodo'         => 6,
                'grupo'              => 6,
                'tipo_alumno'        => 'Tipo alumno carga academica 6',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
            ],
            [
                'id_carga_academica' => 7,
                'id_alumno'          => 7,
                'id_materia'         => 7,
                'id_status_materia'  => 7,
                'id_tipo_curso'      => 7,
                'id_periodo'         => 12,
                'grupo'              => 7,
                'tipo_alumno'        => 'Tipo alumno carga academica 7',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
            ],
            [
                'id_carga_academica' => 8,
                'id_alumno'          => 8,
                'id_materia'         => 8,
                'id_status_materia'  => 8,
                'id_tipo_curso'      => 8,
                'id_periodo'         => 12,
                'grupo'              => 8,
                'tipo_alumno'        => 'Tipo alumno carga academica 8',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
            ],
            [
                'id_carga_academica' => 9,
                'id_alumno'          => 9,
                'id_materia'         => 9,
                'id_status_materia'  => 9,
                'id_tipo_curso'      => 9,
                'id_periodo'         => 9,
                'grupo'              => 9,
                'tipo_alumno'        => 'Tipo alumno carga academica 9',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
            ],
            [
                'id_carga_academica' => 10,
                'id_alumno'          => 10,
                'id_materia'         => 10,
                'id_status_materia'  => 10,
                'id_tipo_curso'      => 10,
                'id_periodo'         => 12,
                'grupo'              => 10,
                'tipo_alumno'        => 'Tipo alumno carga academica 10',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
            ],
            [
                'id_carga_academica' => 11,
                'id_alumno'          => 11,
                'id_materia'         => 11,
                'id_status_materia'  => 11,
                'id_tipo_curso'      => 11,
                'id_periodo'         => 12,
                'grupo'              => 11,
                'tipo_alumno'        => 'Tipo alumno carga academica 11',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
            ],
            [
                'id_carga_academica' => 12,
                'id_alumno'          => 12,
                'id_materia'         => 12,
                'id_status_materia'  => 12,
                'id_tipo_curso'      => 12,
                'id_periodo'         => 12,
                'grupo'              => 12,
                'tipo_alumno'        => 'Tipo alumno carga academica 12',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
            ],
            [
                'id_carga_academica' => 13,
                'id_alumno'          => 13,
                'id_materia'         => 13,
                'id_status_materia'  => 13,
                'id_tipo_curso'      => 13,
                'id_periodo'         => 12,
                'grupo'              => 13,
                'tipo_alumno'        => 'Tipo alumno carga academica 13',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
            ],
            [
                'id_carga_academica' => 14,
                'id_alumno'          => 14,
                'id_materia'         => 14,
                'id_status_materia'  => 14,
                'id_tipo_curso'      => 14,
                'id_periodo'         => 12,
                'grupo'              => 14,
                'tipo_alumno'        => 'Tipo alumno carga academica 14',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
            ],
            [
                'id_carga_academica' => 15,
                'id_alumno'          => 15,
                'id_materia'         => 15,
                'id_status_materia'  => 15,
                'id_tipo_curso'      => 15,
                'id_periodo'         => 15,
                'grupo'              => 15,
                'tipo_alumno'        => 'Tipo alumno carga academica 15',
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
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
