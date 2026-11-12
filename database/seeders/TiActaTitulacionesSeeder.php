<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_acta_titulaciones`.
 */
class TiActaTitulacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_acta_titulaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'ti_acta_titulaciones';

        $llaves = [
            ['id_acta_titulacion'],
        ];

        $registros = [
            [
                'id_acta_titulacion'           => 1,
                'id_alumno'                    => 1,
                'numero_acta_titulacion'       => 1,
                'numero_libro_acta_titulacion' => 1,
                'foja_acta_titulacion'         => 1,
                'hora_conformidad_acta'        => '07:00-08:00',
                'hora_levantamiento_acta'      => '07:00-08:00',
                'fecha_registro'               => '2026-01-05',
                'id_autorizar'                 => 1,
            ],
            [
                'id_acta_titulacion'           => 2,
                'id_alumno'                    => 2,
                'numero_acta_titulacion'       => 2,
                'numero_libro_acta_titulacion' => 2,
                'foja_acta_titulacion'         => 2,
                'hora_conformidad_acta'        => '08:00-09:00',
                'hora_levantamiento_acta'      => '08:00-09:00',
                'fecha_registro'               => '2026-01-14',
                'id_autorizar'                 => 2,
            ],
            [
                'id_acta_titulacion'           => 3,
                'id_alumno'                    => 3,
                'numero_acta_titulacion'       => 3,
                'numero_libro_acta_titulacion' => 3,
                'foja_acta_titulacion'         => 3,
                'hora_conformidad_acta'        => '09:00-10:00',
                'hora_levantamiento_acta'      => '09:00-10:00',
                'fecha_registro'               => '2026-01-23',
                'id_autorizar'                 => 3,
            ],
            [
                'id_acta_titulacion'           => 4,
                'id_alumno'                    => 4,
                'numero_acta_titulacion'       => 4,
                'numero_libro_acta_titulacion' => 4,
                'foja_acta_titulacion'         => 4,
                'hora_conformidad_acta'        => '10:00-11:00',
                'hora_levantamiento_acta'      => '10:00-11:00',
                'fecha_registro'               => '2026-02-01',
                'id_autorizar'                 => 4,
            ],
            [
                'id_acta_titulacion'           => 5,
                'id_alumno'                    => 5,
                'numero_acta_titulacion'       => 5,
                'numero_libro_acta_titulacion' => 5,
                'foja_acta_titulacion'         => 5,
                'hora_conformidad_acta'        => '11:00-12:00',
                'hora_levantamiento_acta'      => '11:00-12:00',
                'fecha_registro'               => '2026-02-10',
                'id_autorizar'                 => 5,
            ],
            [
                'id_acta_titulacion'           => 6,
                'id_alumno'                    => 6,
                'numero_acta_titulacion'       => 6,
                'numero_libro_acta_titulacion' => 6,
                'foja_acta_titulacion'         => 6,
                'hora_conformidad_acta'        => '12:00-13:00',
                'hora_levantamiento_acta'      => '12:00-13:00',
                'fecha_registro'               => '2026-02-19',
                'id_autorizar'                 => 6,
            ],
            [
                'id_acta_titulacion'           => 7,
                'id_alumno'                    => 7,
                'numero_acta_titulacion'       => 7,
                'numero_libro_acta_titulacion' => 7,
                'foja_acta_titulacion'         => 7,
                'hora_conformidad_acta'        => '13:00-14:00',
                'hora_levantamiento_acta'      => '13:00-14:00',
                'fecha_registro'               => '2026-02-28',
                'id_autorizar'                 => 7,
            ],
            [
                'id_acta_titulacion'           => 8,
                'id_alumno'                    => 8,
                'numero_acta_titulacion'       => 8,
                'numero_libro_acta_titulacion' => 8,
                'foja_acta_titulacion'         => 8,
                'hora_conformidad_acta'        => '14:00-15:00',
                'hora_levantamiento_acta'      => '14:00-15:00',
                'fecha_registro'               => '2026-03-09',
                'id_autorizar'                 => 8,
            ],
            [
                'id_acta_titulacion'           => 9,
                'id_alumno'                    => 9,
                'numero_acta_titulacion'       => 9,
                'numero_libro_acta_titulacion' => 9,
                'foja_acta_titulacion'         => 9,
                'hora_conformidad_acta'        => '15:00-16:00',
                'hora_levantamiento_acta'      => '15:00-16:00',
                'fecha_registro'               => '2026-03-18',
                'id_autorizar'                 => 9,
            ],
            [
                'id_acta_titulacion'           => 10,
                'id_alumno'                    => 10,
                'numero_acta_titulacion'       => 10,
                'numero_libro_acta_titulacion' => 10,
                'foja_acta_titulacion'         => 10,
                'hora_conformidad_acta'        => '16:00-17:00',
                'hora_levantamiento_acta'      => '16:00-17:00',
                'fecha_registro'               => '2026-03-27',
                'id_autorizar'                 => 10,
            ],
            [
                'id_acta_titulacion'           => 11,
                'id_alumno'                    => 11,
                'numero_acta_titulacion'       => 11,
                'numero_libro_acta_titulacion' => 11,
                'foja_acta_titulacion'         => 11,
                'hora_conformidad_acta'        => '17:00-18:00',
                'hora_levantamiento_acta'      => '17:00-18:00',
                'fecha_registro'               => '2026-04-05',
                'id_autorizar'                 => 11,
            ],
            [
                'id_acta_titulacion'           => 12,
                'id_alumno'                    => 12,
                'numero_acta_titulacion'       => 12,
                'numero_libro_acta_titulacion' => 12,
                'foja_acta_titulacion'         => 12,
                'hora_conformidad_acta'        => '18:00-19:00',
                'hora_levantamiento_acta'      => '18:00-19:00',
                'fecha_registro'               => '2026-04-14',
                'id_autorizar'                 => 12,
            ],
            [
                'id_acta_titulacion'           => 13,
                'id_alumno'                    => 13,
                'numero_acta_titulacion'       => 13,
                'numero_libro_acta_titulacion' => 13,
                'foja_acta_titulacion'         => 13,
                'hora_conformidad_acta'        => '07:00-08:00',
                'hora_levantamiento_acta'      => '07:00-08:00',
                'fecha_registro'               => '2026-04-23',
                'id_autorizar'                 => 13,
            ],
            [
                'id_acta_titulacion'           => 14,
                'id_alumno'                    => 14,
                'numero_acta_titulacion'       => 14,
                'numero_libro_acta_titulacion' => 14,
                'foja_acta_titulacion'         => 14,
                'hora_conformidad_acta'        => '08:00-09:00',
                'hora_levantamiento_acta'      => '08:00-09:00',
                'fecha_registro'               => '2026-05-02',
                'id_autorizar'                 => 14,
            ],
            [
                'id_acta_titulacion'           => 15,
                'id_alumno'                    => 15,
                'numero_acta_titulacion'       => 15,
                'numero_libro_acta_titulacion' => 15,
                'foja_acta_titulacion'         => 15,
                'hora_conformidad_acta'        => '09:00-10:00',
                'hora_levantamiento_acta'      => '09:00-10:00',
                'fecha_registro'               => '2026-05-11',
                'id_autorizar'                 => 15,
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
