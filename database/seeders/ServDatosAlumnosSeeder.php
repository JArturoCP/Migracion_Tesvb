<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_datos_alumnos`.
 */
class ServDatosAlumnosSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_datos_alumnos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            ServPeriodosSeeder::class,
            ServTipoEmpresaSeeder::class,
        ]);

        $tabla = 'serv_datos_alumnos';

        $llaves = [
            ['id_datos_alumnos'],
        ];

        $registros = [
            [
                'id_datos_alumnos'       => 1,
                'correo_electronico'     => 'alumnos01@example.com',
                'id_tipo_empresa'        => 1,
                'id_periodo'             => 1,
                'id_alumno'              => 1,
                'fecha_registro'         => '2026-01-05',
                'id_estado_enviado'      => 1,
                'id_estado_presentacion' => 1,
            ],
            [
                'id_datos_alumnos'       => 2,
                'correo_electronico'     => 'alumnos02@example.com',
                'id_tipo_empresa'        => 2,
                'id_periodo'             => 2,
                'id_alumno'              => 2,
                'fecha_registro'         => '2026-01-14',
                'id_estado_enviado'      => 2,
                'id_estado_presentacion' => 2,
            ],
            [
                'id_datos_alumnos'       => 3,
                'correo_electronico'     => 'alumnos03@example.com',
                'id_tipo_empresa'        => 3,
                'id_periodo'             => 3,
                'id_alumno'              => 3,
                'fecha_registro'         => '2026-01-23',
                'id_estado_enviado'      => 3,
                'id_estado_presentacion' => 3,
            ],
            [
                'id_datos_alumnos'       => 4,
                'correo_electronico'     => 'alumnos04@example.com',
                'id_tipo_empresa'        => 4,
                'id_periodo'             => 4,
                'id_alumno'              => 4,
                'fecha_registro'         => '2026-02-01',
                'id_estado_enviado'      => 4,
                'id_estado_presentacion' => 4,
            ],
            [
                'id_datos_alumnos'       => 5,
                'correo_electronico'     => 'alumnos05@example.com',
                'id_tipo_empresa'        => 5,
                'id_periodo'             => 5,
                'id_alumno'              => 5,
                'fecha_registro'         => '2026-02-10',
                'id_estado_enviado'      => 5,
                'id_estado_presentacion' => 5,
            ],
            [
                'id_datos_alumnos'       => 6,
                'correo_electronico'     => 'alumnos06@example.com',
                'id_tipo_empresa'        => 6,
                'id_periodo'             => 6,
                'id_alumno'              => 6,
                'fecha_registro'         => '2026-02-19',
                'id_estado_enviado'      => 6,
                'id_estado_presentacion' => 6,
            ],
            [
                'id_datos_alumnos'       => 7,
                'correo_electronico'     => 'alumnos07@example.com',
                'id_tipo_empresa'        => 7,
                'id_periodo'             => 7,
                'id_alumno'              => 7,
                'fecha_registro'         => '2026-02-28',
                'id_estado_enviado'      => 7,
                'id_estado_presentacion' => 7,
            ],
            [
                'id_datos_alumnos'       => 8,
                'correo_electronico'     => 'alumnos08@example.com',
                'id_tipo_empresa'        => 8,
                'id_periodo'             => 8,
                'id_alumno'              => 8,
                'fecha_registro'         => '2026-03-09',
                'id_estado_enviado'      => 8,
                'id_estado_presentacion' => 8,
            ],
            [
                'id_datos_alumnos'       => 9,
                'correo_electronico'     => 'alumnos09@example.com',
                'id_tipo_empresa'        => 9,
                'id_periodo'             => 9,
                'id_alumno'              => 9,
                'fecha_registro'         => '2026-03-18',
                'id_estado_enviado'      => 9,
                'id_estado_presentacion' => 9,
            ],
            [
                'id_datos_alumnos'       => 10,
                'correo_electronico'     => 'alumnos10@example.com',
                'id_tipo_empresa'        => 10,
                'id_periodo'             => 10,
                'id_alumno'              => 10,
                'fecha_registro'         => '2026-03-27',
                'id_estado_enviado'      => 10,
                'id_estado_presentacion' => 10,
            ],
            [
                'id_datos_alumnos'       => 11,
                'correo_electronico'     => 'alumnos11@example.com',
                'id_tipo_empresa'        => 11,
                'id_periodo'             => 11,
                'id_alumno'              => 11,
                'fecha_registro'         => '2026-04-05',
                'id_estado_enviado'      => 11,
                'id_estado_presentacion' => 11,
            ],
            [
                'id_datos_alumnos'       => 12,
                'correo_electronico'     => 'alumnos12@example.com',
                'id_tipo_empresa'        => 12,
                'id_periodo'             => 12,
                'id_alumno'              => 12,
                'fecha_registro'         => '2026-04-14',
                'id_estado_enviado'      => 12,
                'id_estado_presentacion' => 12,
            ],
            [
                'id_datos_alumnos'       => 13,
                'correo_electronico'     => 'alumnos13@example.com',
                'id_tipo_empresa'        => 13,
                'id_periodo'             => 13,
                'id_alumno'              => 13,
                'fecha_registro'         => '2026-04-23',
                'id_estado_enviado'      => 13,
                'id_estado_presentacion' => 13,
            ],
            [
                'id_datos_alumnos'       => 14,
                'correo_electronico'     => 'alumnos14@example.com',
                'id_tipo_empresa'        => 14,
                'id_periodo'             => 14,
                'id_alumno'              => 14,
                'fecha_registro'         => '2026-05-02',
                'id_estado_enviado'      => 14,
                'id_estado_presentacion' => 14,
            ],
            [
                'id_datos_alumnos'       => 15,
                'correo_electronico'     => 'alumnos15@example.com',
                'id_tipo_empresa'        => 15,
                'id_periodo'             => 15,
                'id_alumno'              => 15,
                'fecha_registro'         => '2026-05-11',
                'id_estado_enviado'      => 15,
                'id_estado_presentacion' => 15,
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
