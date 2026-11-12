<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_hrs_horas_profesor`.
 */
class InHrsHorasProfesorSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_hrs_horas_profesor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralGruposSeeder::class,
            GnralPeriodosSeeder::class,
            HrsSemanasSeeder::class,
        ]);

        $tabla = 'in_hrs_horas_profesor';

        $llaves = [
            ['id_hrs_horas_profesor'],
        ];

        $registros = [
            [
                'id_hrs_horas_profesor' => 1,
                'id_profesor'           => 1,
                'id_grupo'              => 1,
                'id_nivel'              => 1,
                'id_semana'             => 1,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 2,
                'id_profesor'           => 2,
                'id_grupo'              => 2,
                'id_nivel'              => 2,
                'id_semana'             => 2,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 3,
                'id_profesor'           => 3,
                'id_grupo'              => 3,
                'id_nivel'              => 3,
                'id_semana'             => 3,
                'id_periodo'            => 3,
            ],
            [
                'id_hrs_horas_profesor' => 4,
                'id_profesor'           => 4,
                'id_grupo'              => 4,
                'id_nivel'              => 4,
                'id_semana'             => 4,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 5,
                'id_profesor'           => 5,
                'id_grupo'              => 5,
                'id_nivel'              => 5,
                'id_semana'             => 5,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 6,
                'id_profesor'           => 6,
                'id_grupo'              => 6,
                'id_nivel'              => 6,
                'id_semana'             => 6,
                'id_periodo'            => 6,
            ],
            [
                'id_hrs_horas_profesor' => 7,
                'id_profesor'           => 7,
                'id_grupo'              => 7,
                'id_nivel'              => 7,
                'id_semana'             => 7,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 8,
                'id_profesor'           => 8,
                'id_grupo'              => 8,
                'id_nivel'              => 8,
                'id_semana'             => 8,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 9,
                'id_profesor'           => 9,
                'id_grupo'              => 9,
                'id_nivel'              => 9,
                'id_semana'             => 9,
                'id_periodo'            => 9,
            ],
            [
                'id_hrs_horas_profesor' => 10,
                'id_profesor'           => 10,
                'id_grupo'              => 10,
                'id_nivel'              => 10,
                'id_semana'             => 10,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 11,
                'id_profesor'           => 11,
                'id_grupo'              => 11,
                'id_nivel'              => 11,
                'id_semana'             => 11,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 12,
                'id_profesor'           => 12,
                'id_grupo'              => 12,
                'id_nivel'              => 12,
                'id_semana'             => 12,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 13,
                'id_profesor'           => 13,
                'id_grupo'              => 13,
                'id_nivel'              => 13,
                'id_semana'             => 13,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 14,
                'id_profesor'           => 14,
                'id_grupo'              => 14,
                'id_nivel'              => 14,
                'id_semana'             => 14,
                'id_periodo'            => 12,
            ],
            [
                'id_hrs_horas_profesor' => 15,
                'id_profesor'           => 15,
                'id_grupo'              => 15,
                'id_nivel'              => 15,
                'id_semana'             => 15,
                'id_periodo'            => 15,
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
