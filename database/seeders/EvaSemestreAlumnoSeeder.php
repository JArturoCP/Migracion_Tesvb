<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_semestre_alumno`.
 */
class EvaSemestreAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_semestre_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'eva_semestre_alumno';

        $llaves = [
            ['id_semestres_al'],
        ];

        $registros = [
            [
                'id_semestres_al'        => 1,
                'id_periodo'             => 12,
                'id_semestre'            => 1,
                'id_estado_autorizacion' => 1,
                'id_alumno'              => 1,
                'fecha_registro'         => '2026-01-05',
                'fecha_mod'              => '2026-01-05',
                'id_usuario_mod'         => 1,
                'datos_completos'        => 'Datos completos semestre alumno 1',
                'id_estado_rev'          => 1,
            ],
            [
                'id_semestres_al'        => 2,
                'id_periodo'             => 12,
                'id_semestre'            => 2,
                'id_estado_autorizacion' => 2,
                'id_alumno'              => 2,
                'fecha_registro'         => '2026-01-14',
                'fecha_mod'              => '2026-01-14',
                'id_usuario_mod'         => 2,
                'datos_completos'        => 'Datos completos semestre alumno 2',
                'id_estado_rev'          => 2,
            ],
            [
                'id_semestres_al'        => 3,
                'id_periodo'             => 3,
                'id_semestre'            => 3,
                'id_estado_autorizacion' => 3,
                'id_alumno'              => 3,
                'fecha_registro'         => '2026-01-23',
                'fecha_mod'              => '2026-01-23',
                'id_usuario_mod'         => 3,
                'datos_completos'        => 'Datos completos semestre alumno 3',
                'id_estado_rev'          => 3,
            ],
            [
                'id_semestres_al'        => 4,
                'id_periodo'             => 12,
                'id_semestre'            => 4,
                'id_estado_autorizacion' => 4,
                'id_alumno'              => 4,
                'fecha_registro'         => '2026-02-01',
                'fecha_mod'              => '2026-02-01',
                'id_usuario_mod'         => 4,
                'datos_completos'        => 'Datos completos semestre alumno 4',
                'id_estado_rev'          => 4,
            ],
            [
                'id_semestres_al'        => 5,
                'id_periodo'             => 12,
                'id_semestre'            => 5,
                'id_estado_autorizacion' => 5,
                'id_alumno'              => 5,
                'fecha_registro'         => '2026-02-10',
                'fecha_mod'              => '2026-02-10',
                'id_usuario_mod'         => 5,
                'datos_completos'        => 'Datos completos semestre alumno 5',
                'id_estado_rev'          => 5,
            ],
            [
                'id_semestres_al'        => 6,
                'id_periodo'             => 6,
                'id_semestre'            => 6,
                'id_estado_autorizacion' => 6,
                'id_alumno'              => 6,
                'fecha_registro'         => '2026-02-19',
                'fecha_mod'              => '2026-02-19',
                'id_usuario_mod'         => 6,
                'datos_completos'        => 'Datos completos semestre alumno 6',
                'id_estado_rev'          => 6,
            ],
            [
                'id_semestres_al'        => 7,
                'id_periodo'             => 12,
                'id_semestre'            => 7,
                'id_estado_autorizacion' => 7,
                'id_alumno'              => 7,
                'fecha_registro'         => '2026-02-28',
                'fecha_mod'              => '2026-02-28',
                'id_usuario_mod'         => 7,
                'datos_completos'        => 'Datos completos semestre alumno 7',
                'id_estado_rev'          => 7,
            ],
            [
                'id_semestres_al'        => 8,
                'id_periodo'             => 12,
                'id_semestre'            => 8,
                'id_estado_autorizacion' => 8,
                'id_alumno'              => 8,
                'fecha_registro'         => '2026-03-09',
                'fecha_mod'              => '2026-03-09',
                'id_usuario_mod'         => 8,
                'datos_completos'        => 'Datos completos semestre alumno 8',
                'id_estado_rev'          => 8,
            ],
            [
                'id_semestres_al'        => 9,
                'id_periodo'             => 9,
                'id_semestre'            => 9,
                'id_estado_autorizacion' => 9,
                'id_alumno'              => 9,
                'fecha_registro'         => '2026-03-18',
                'fecha_mod'              => '2026-03-18',
                'id_usuario_mod'         => 9,
                'datos_completos'        => 'Datos completos semestre alumno 9',
                'id_estado_rev'          => 9,
            ],
            [
                'id_semestres_al'        => 10,
                'id_periodo'             => 12,
                'id_semestre'            => 10,
                'id_estado_autorizacion' => 10,
                'id_alumno'              => 10,
                'fecha_registro'         => '2026-03-27',
                'fecha_mod'              => '2026-03-27',
                'id_usuario_mod'         => 10,
                'datos_completos'        => 'Datos completos semestre alumno 10',
                'id_estado_rev'          => 10,
            ],
            [
                'id_semestres_al'        => 11,
                'id_periodo'             => 12,
                'id_semestre'            => 11,
                'id_estado_autorizacion' => 11,
                'id_alumno'              => 11,
                'fecha_registro'         => '2026-04-05',
                'fecha_mod'              => '2026-04-05',
                'id_usuario_mod'         => 11,
                'datos_completos'        => 'Datos completos semestre alumno 11',
                'id_estado_rev'          => 11,
            ],
            [
                'id_semestres_al'        => 12,
                'id_periodo'             => 12,
                'id_semestre'            => 12,
                'id_estado_autorizacion' => 12,
                'id_alumno'              => 12,
                'fecha_registro'         => '2026-04-14',
                'fecha_mod'              => '2026-04-14',
                'id_usuario_mod'         => 12,
                'datos_completos'        => 'Datos completos semestre alumno 12',
                'id_estado_rev'          => 12,
            ],
            [
                'id_semestres_al'        => 13,
                'id_periodo'             => 12,
                'id_semestre'            => 1,
                'id_estado_autorizacion' => 13,
                'id_alumno'              => 13,
                'fecha_registro'         => '2026-04-23',
                'fecha_mod'              => '2026-04-23',
                'id_usuario_mod'         => 13,
                'datos_completos'        => 'Datos completos semestre alumno 13',
                'id_estado_rev'          => 13,
            ],
            [
                'id_semestres_al'        => 14,
                'id_periodo'             => 12,
                'id_semestre'            => 2,
                'id_estado_autorizacion' => 14,
                'id_alumno'              => 14,
                'fecha_registro'         => '2026-05-02',
                'fecha_mod'              => '2026-05-02',
                'id_usuario_mod'         => 14,
                'datos_completos'        => 'Datos completos semestre alumno 14',
                'id_estado_rev'          => 14,
            ],
            [
                'id_semestres_al'        => 15,
                'id_periodo'             => 15,
                'id_semestre'            => 3,
                'id_estado_autorizacion' => 15,
                'id_alumno'              => 15,
                'fecha_registro'         => '2026-05-11',
                'fecha_mod'              => '2026-05-11',
                'id_usuario_mod'         => 15,
                'datos_completos'        => 'Datos completos semestre alumno 15',
                'id_estado_rev'          => 15,
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
