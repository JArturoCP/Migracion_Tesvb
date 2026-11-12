<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_secciones_estado`.
 */
class EgelSeccionesEstadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_secciones_estado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelExamenesSeeder::class,
            EgelSeccionesSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'egel_secciones_estado';

        $llaves = [
            ['id_seccion_estado'],
        ];

        $registros = [
            [
                'id_seccion_estado' => 1,
                'id_alumno'         => 1,
                'id_seccion'        => 1,
                'completada'        => 1,
                'fecha_fin'         => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
                'updated_at'        => '2026-01-05 09:00:00',
                'id_examen_egel'    => 1,
            ],
            [
                'id_seccion_estado' => 2,
                'id_alumno'         => 2,
                'id_seccion'        => 2,
                'completada'        => 1,
                'fecha_fin'         => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
                'updated_at'        => '2026-01-14 10:00:00',
                'id_examen_egel'    => 2,
            ],
            [
                'id_seccion_estado' => 3,
                'id_alumno'         => 3,
                'id_seccion'        => 3,
                'completada'        => 1,
                'fecha_fin'         => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
                'updated_at'        => '2026-01-23 11:00:00',
                'id_examen_egel'    => 3,
            ],
            [
                'id_seccion_estado' => 4,
                'id_alumno'         => 4,
                'id_seccion'        => 4,
                'completada'        => 1,
                'fecha_fin'         => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
                'updated_at'        => '2026-02-01 12:00:00',
                'id_examen_egel'    => 4,
            ],
            [
                'id_seccion_estado' => 5,
                'id_alumno'         => 5,
                'id_seccion'        => 5,
                'completada'        => 1,
                'fecha_fin'         => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
                'updated_at'        => '2026-02-10 13:00:00',
                'id_examen_egel'    => 5,
            ],
            [
                'id_seccion_estado' => 6,
                'id_alumno'         => 6,
                'id_seccion'        => 6,
                'completada'        => 1,
                'fecha_fin'         => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
                'updated_at'        => '2026-02-19 14:00:00',
                'id_examen_egel'    => 6,
            ],
            [
                'id_seccion_estado' => 7,
                'id_alumno'         => 7,
                'id_seccion'        => 7,
                'completada'        => 1,
                'fecha_fin'         => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
                'updated_at'        => '2026-02-28 15:00:00',
                'id_examen_egel'    => 7,
            ],
            [
                'id_seccion_estado' => 8,
                'id_alumno'         => 8,
                'id_seccion'        => 8,
                'completada'        => 1,
                'fecha_fin'         => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
                'updated_at'        => '2026-03-09 16:00:00',
                'id_examen_egel'    => 8,
            ],
            [
                'id_seccion_estado' => 9,
                'id_alumno'         => 9,
                'id_seccion'        => 9,
                'completada'        => 1,
                'fecha_fin'         => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
                'updated_at'        => '2026-03-18 08:00:00',
                'id_examen_egel'    => 9,
            ],
            [
                'id_seccion_estado' => 10,
                'id_alumno'         => 10,
                'id_seccion'        => 10,
                'completada'        => 1,
                'fecha_fin'         => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
                'updated_at'        => '2026-03-27 09:00:00',
                'id_examen_egel'    => 10,
            ],
            [
                'id_seccion_estado' => 11,
                'id_alumno'         => 11,
                'id_seccion'        => 11,
                'completada'        => 1,
                'fecha_fin'         => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
                'updated_at'        => '2026-04-05 10:00:00',
                'id_examen_egel'    => 11,
            ],
            [
                'id_seccion_estado' => 12,
                'id_alumno'         => 12,
                'id_seccion'        => 12,
                'completada'        => 1,
                'fecha_fin'         => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
                'updated_at'        => '2026-04-14 11:00:00',
                'id_examen_egel'    => 12,
            ],
            [
                'id_seccion_estado' => 13,
                'id_alumno'         => 13,
                'id_seccion'        => 13,
                'completada'        => 1,
                'fecha_fin'         => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
                'updated_at'        => '2026-04-23 12:00:00',
                'id_examen_egel'    => 13,
            ],
            [
                'id_seccion_estado' => 14,
                'id_alumno'         => 14,
                'id_seccion'        => 14,
                'completada'        => 1,
                'fecha_fin'         => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
                'updated_at'        => '2026-05-02 13:00:00',
                'id_examen_egel'    => 14,
            ],
            [
                'id_seccion_estado' => 15,
                'id_alumno'         => 15,
                'id_seccion'        => 15,
                'completada'        => 1,
                'fecha_fin'         => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
                'updated_at'        => '2026-05-11 14:00:00',
                'id_examen_egel'    => 15,
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
