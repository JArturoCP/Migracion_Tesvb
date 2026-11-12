<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_act_semestre`.
 */
class EvaActSemestreSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_act_semestre` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'eva_act_semestre';

        $llaves = [
            ['id_act_semestre'],
        ];

        $registros = [
            [
                'id_act_semestre'      => 1,
                'id_periodo'           => 12,
                'id_alumno'            => 1,
                'semestre_actualizado' => 1,
                'fecha_actualizacion'  => '2026-01-05',
            ],
            [
                'id_act_semestre'      => 2,
                'id_periodo'           => 12,
                'id_alumno'            => 2,
                'semestre_actualizado' => 2,
                'fecha_actualizacion'  => '2026-01-14',
            ],
            [
                'id_act_semestre'      => 3,
                'id_periodo'           => 3,
                'id_alumno'            => 3,
                'semestre_actualizado' => 3,
                'fecha_actualizacion'  => '2026-01-23',
            ],
            [
                'id_act_semestre'      => 4,
                'id_periodo'           => 12,
                'id_alumno'            => 4,
                'semestre_actualizado' => 4,
                'fecha_actualizacion'  => '2026-02-01',
            ],
            [
                'id_act_semestre'      => 5,
                'id_periodo'           => 12,
                'id_alumno'            => 5,
                'semestre_actualizado' => 5,
                'fecha_actualizacion'  => '2026-02-10',
            ],
            [
                'id_act_semestre'      => 6,
                'id_periodo'           => 6,
                'id_alumno'            => 6,
                'semestre_actualizado' => 6,
                'fecha_actualizacion'  => '2026-02-19',
            ],
            [
                'id_act_semestre'      => 7,
                'id_periodo'           => 12,
                'id_alumno'            => 7,
                'semestre_actualizado' => 7,
                'fecha_actualizacion'  => '2026-02-28',
            ],
            [
                'id_act_semestre'      => 8,
                'id_periodo'           => 12,
                'id_alumno'            => 8,
                'semestre_actualizado' => 8,
                'fecha_actualizacion'  => '2026-03-09',
            ],
            [
                'id_act_semestre'      => 9,
                'id_periodo'           => 9,
                'id_alumno'            => 9,
                'semestre_actualizado' => 9,
                'fecha_actualizacion'  => '2026-03-18',
            ],
            [
                'id_act_semestre'      => 10,
                'id_periodo'           => 12,
                'id_alumno'            => 10,
                'semestre_actualizado' => 10,
                'fecha_actualizacion'  => '2026-03-27',
            ],
            [
                'id_act_semestre'      => 11,
                'id_periodo'           => 12,
                'id_alumno'            => 11,
                'semestre_actualizado' => 11,
                'fecha_actualizacion'  => '2026-04-05',
            ],
            [
                'id_act_semestre'      => 12,
                'id_periodo'           => 12,
                'id_alumno'            => 12,
                'semestre_actualizado' => 12,
                'fecha_actualizacion'  => '2026-04-14',
            ],
            [
                'id_act_semestre'      => 13,
                'id_periodo'           => 12,
                'id_alumno'            => 13,
                'semestre_actualizado' => 13,
                'fecha_actualizacion'  => '2026-04-23',
            ],
            [
                'id_act_semestre'      => 14,
                'id_periodo'           => 12,
                'id_alumno'            => 14,
                'semestre_actualizado' => 14,
                'fecha_actualizacion'  => '2026-05-02',
            ],
            [
                'id_act_semestre'      => 15,
                'id_periodo'           => 15,
                'id_alumno'            => 15,
                'semestre_actualizado' => 15,
                'fecha_actualizacion'  => '2026-05-11',
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
