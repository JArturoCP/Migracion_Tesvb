<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_jurado_alumno`.
 */
class TiJuradoAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_jurado_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPersonalesSeeder::class,
            TiTipoJuradoSeeder::class,
        ]);

        $tabla = 'ti_jurado_alumno';

        $llaves = [
            ['id_jurado_alumno'],
        ];

        $registros = [
            [
                'id_jurado_alumno' => 1,
                'id_alumno'        => 1,
                'id_tipo_jurado'   => 1,
                'fecha_registro'   => '2026-01-05',
                'id_personal'      => 1,
            ],
            [
                'id_jurado_alumno' => 2,
                'id_alumno'        => 2,
                'id_tipo_jurado'   => 2,
                'fecha_registro'   => '2026-01-14',
                'id_personal'      => 2,
            ],
            [
                'id_jurado_alumno' => 3,
                'id_alumno'        => 3,
                'id_tipo_jurado'   => 3,
                'fecha_registro'   => '2026-01-23',
                'id_personal'      => 3,
            ],
            [
                'id_jurado_alumno' => 4,
                'id_alumno'        => 4,
                'id_tipo_jurado'   => 4,
                'fecha_registro'   => '2026-02-01',
                'id_personal'      => 4,
            ],
            [
                'id_jurado_alumno' => 5,
                'id_alumno'        => 5,
                'id_tipo_jurado'   => 5,
                'fecha_registro'   => '2026-02-10',
                'id_personal'      => 5,
            ],
            [
                'id_jurado_alumno' => 6,
                'id_alumno'        => 6,
                'id_tipo_jurado'   => 6,
                'fecha_registro'   => '2026-02-19',
                'id_personal'      => 6,
            ],
            [
                'id_jurado_alumno' => 7,
                'id_alumno'        => 7,
                'id_tipo_jurado'   => 7,
                'fecha_registro'   => '2026-02-28',
                'id_personal'      => 7,
            ],
            [
                'id_jurado_alumno' => 8,
                'id_alumno'        => 8,
                'id_tipo_jurado'   => 8,
                'fecha_registro'   => '2026-03-09',
                'id_personal'      => 8,
            ],
            [
                'id_jurado_alumno' => 9,
                'id_alumno'        => 9,
                'id_tipo_jurado'   => 9,
                'fecha_registro'   => '2026-03-18',
                'id_personal'      => 9,
            ],
            [
                'id_jurado_alumno' => 10,
                'id_alumno'        => 10,
                'id_tipo_jurado'   => 10,
                'fecha_registro'   => '2026-03-27',
                'id_personal'      => 10,
            ],
            [
                'id_jurado_alumno' => 11,
                'id_alumno'        => 11,
                'id_tipo_jurado'   => 11,
                'fecha_registro'   => '2026-04-05',
                'id_personal'      => 11,
            ],
            [
                'id_jurado_alumno' => 12,
                'id_alumno'        => 12,
                'id_tipo_jurado'   => 12,
                'fecha_registro'   => '2026-04-14',
                'id_personal'      => 12,
            ],
            [
                'id_jurado_alumno' => 13,
                'id_alumno'        => 13,
                'id_tipo_jurado'   => 13,
                'fecha_registro'   => '2026-04-23',
                'id_personal'      => 13,
            ],
            [
                'id_jurado_alumno' => 14,
                'id_alumno'        => 14,
                'id_tipo_jurado'   => 14,
                'fecha_registro'   => '2026-05-02',
                'id_personal'      => 14,
            ],
            [
                'id_jurado_alumno' => 15,
                'id_alumno'        => 15,
                'id_tipo_jurado'   => 15,
                'fecha_registro'   => '2026-05-11',
                'id_personal'      => 15,
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
