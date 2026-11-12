<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_hrs_ingles_profesor`.
 */
class InHrsInglesProfesorSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_hrs_ingles_profesor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralGruposSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'in_hrs_ingles_profesor';

        $llaves = [
            ['id_hrs_ingles_profesor'],
        ];

        $registros = [
            [
                'id_hrs_ingles_profesor' => 1,
                'id_profesor'            => 1,
                'id_grupo'               => 1,
                'id_nivel'               => 1,
                'id_periodo'             => 12,
                'id_estado'              => 1,
                'fecha_activacion'       => '2026-01-05',
            ],
            [
                'id_hrs_ingles_profesor' => 2,
                'id_profesor'            => 2,
                'id_grupo'               => 2,
                'id_nivel'               => 2,
                'id_periodo'             => 12,
                'id_estado'              => 2,
                'fecha_activacion'       => '2026-01-14',
            ],
            [
                'id_hrs_ingles_profesor' => 3,
                'id_profesor'            => 3,
                'id_grupo'               => 3,
                'id_nivel'               => 3,
                'id_periodo'             => 3,
                'id_estado'              => 3,
                'fecha_activacion'       => '2026-01-23',
            ],
            [
                'id_hrs_ingles_profesor' => 4,
                'id_profesor'            => 4,
                'id_grupo'               => 4,
                'id_nivel'               => 4,
                'id_periodo'             => 12,
                'id_estado'              => 4,
                'fecha_activacion'       => '2026-02-01',
            ],
            [
                'id_hrs_ingles_profesor' => 5,
                'id_profesor'            => 5,
                'id_grupo'               => 5,
                'id_nivel'               => 5,
                'id_periodo'             => 12,
                'id_estado'              => 5,
                'fecha_activacion'       => '2026-02-10',
            ],
            [
                'id_hrs_ingles_profesor' => 6,
                'id_profesor'            => 6,
                'id_grupo'               => 6,
                'id_nivel'               => 6,
                'id_periodo'             => 6,
                'id_estado'              => 6,
                'fecha_activacion'       => '2026-02-19',
            ],
            [
                'id_hrs_ingles_profesor' => 7,
                'id_profesor'            => 7,
                'id_grupo'               => 7,
                'id_nivel'               => 7,
                'id_periodo'             => 12,
                'id_estado'              => 7,
                'fecha_activacion'       => '2026-02-28',
            ],
            [
                'id_hrs_ingles_profesor' => 8,
                'id_profesor'            => 8,
                'id_grupo'               => 8,
                'id_nivel'               => 8,
                'id_periodo'             => 12,
                'id_estado'              => 8,
                'fecha_activacion'       => '2026-03-09',
            ],
            [
                'id_hrs_ingles_profesor' => 9,
                'id_profesor'            => 9,
                'id_grupo'               => 9,
                'id_nivel'               => 9,
                'id_periodo'             => 9,
                'id_estado'              => 9,
                'fecha_activacion'       => '2026-03-18',
            ],
            [
                'id_hrs_ingles_profesor' => 10,
                'id_profesor'            => 10,
                'id_grupo'               => 10,
                'id_nivel'               => 10,
                'id_periodo'             => 12,
                'id_estado'              => 10,
                'fecha_activacion'       => '2026-03-27',
            ],
            [
                'id_hrs_ingles_profesor' => 11,
                'id_profesor'            => 11,
                'id_grupo'               => 11,
                'id_nivel'               => 11,
                'id_periodo'             => 12,
                'id_estado'              => 11,
                'fecha_activacion'       => '2026-04-05',
            ],
            [
                'id_hrs_ingles_profesor' => 12,
                'id_profesor'            => 12,
                'id_grupo'               => 12,
                'id_nivel'               => 12,
                'id_periodo'             => 12,
                'id_estado'              => 12,
                'fecha_activacion'       => '2026-04-14',
            ],
            [
                'id_hrs_ingles_profesor' => 13,
                'id_profesor'            => 13,
                'id_grupo'               => 13,
                'id_nivel'               => 13,
                'id_periodo'             => 12,
                'id_estado'              => 13,
                'fecha_activacion'       => '2026-04-23',
            ],
            [
                'id_hrs_ingles_profesor' => 14,
                'id_profesor'            => 14,
                'id_grupo'               => 14,
                'id_nivel'               => 14,
                'id_periodo'             => 12,
                'id_estado'              => 14,
                'fecha_activacion'       => '2026-05-02',
            ],
            [
                'id_hrs_ingles_profesor' => 15,
                'id_profesor'            => 15,
                'id_grupo'               => 15,
                'id_nivel'               => 15,
                'id_periodo'             => 15,
                'id_estado'              => 15,
                'fecha_activacion'       => '2026-05-11',
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
