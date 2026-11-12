<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_duales_actuales`.
 */
class CalDualesActualesSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_duales_actuales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'cal_duales_actuales';

        $llaves = [
            ['id_duales_actuales'],
        ];

        $registros = [
            [
                'id_duales_actuales' => 1,
                'id_periodo'         => 12,
                'id_alumno'          => 1,
                'id_estado'          => 1,
                'id_personal'        => 1,
            ],
            [
                'id_duales_actuales' => 2,
                'id_periodo'         => 12,
                'id_alumno'          => 2,
                'id_estado'          => 2,
                'id_personal'        => 2,
            ],
            [
                'id_duales_actuales' => 3,
                'id_periodo'         => 3,
                'id_alumno'          => 3,
                'id_estado'          => 3,
                'id_personal'        => 3,
            ],
            [
                'id_duales_actuales' => 4,
                'id_periodo'         => 12,
                'id_alumno'          => 4,
                'id_estado'          => 4,
                'id_personal'        => 4,
            ],
            [
                'id_duales_actuales' => 5,
                'id_periodo'         => 12,
                'id_alumno'          => 5,
                'id_estado'          => 5,
                'id_personal'        => 5,
            ],
            [
                'id_duales_actuales' => 6,
                'id_periodo'         => 6,
                'id_alumno'          => 6,
                'id_estado'          => 6,
                'id_personal'        => 6,
            ],
            [
                'id_duales_actuales' => 7,
                'id_periodo'         => 12,
                'id_alumno'          => 7,
                'id_estado'          => 7,
                'id_personal'        => 7,
            ],
            [
                'id_duales_actuales' => 8,
                'id_periodo'         => 12,
                'id_alumno'          => 8,
                'id_estado'          => 8,
                'id_personal'        => 8,
            ],
            [
                'id_duales_actuales' => 9,
                'id_periodo'         => 9,
                'id_alumno'          => 9,
                'id_estado'          => 9,
                'id_personal'        => 9,
            ],
            [
                'id_duales_actuales' => 10,
                'id_periodo'         => 12,
                'id_alumno'          => 10,
                'id_estado'          => 10,
                'id_personal'        => 10,
            ],
            [
                'id_duales_actuales' => 11,
                'id_periodo'         => 12,
                'id_alumno'          => 11,
                'id_estado'          => 11,
                'id_personal'        => 11,
            ],
            [
                'id_duales_actuales' => 12,
                'id_periodo'         => 12,
                'id_alumno'          => 12,
                'id_estado'          => 12,
                'id_personal'        => 12,
            ],
            [
                'id_duales_actuales' => 13,
                'id_periodo'         => 12,
                'id_alumno'          => 13,
                'id_estado'          => 13,
                'id_personal'        => 13,
            ],
            [
                'id_duales_actuales' => 14,
                'id_periodo'         => 12,
                'id_alumno'          => 14,
                'id_estado'          => 14,
                'id_personal'        => 14,
            ],
            [
                'id_duales_actuales' => 15,
                'id_periodo'         => 15,
                'id_alumno'          => 15,
                'id_estado'          => 15,
                'id_personal'        => 15,
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
