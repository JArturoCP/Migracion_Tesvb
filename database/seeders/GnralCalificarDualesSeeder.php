<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_calificar_duales`.
 */
class GnralCalificarDualesSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_calificar_duales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralGruposSeeder::class,
            GnralMateriasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'gnral_calificar_duales';

        $llaves = [
            ['id_duales'],
        ];

        $registros = [
            [
                'id_duales'          => 1,
                'id_materia'         => 1,
                'status'             => 1,
                'id_periodo'         => 12,
                'id_grupo'           => 1,
                'calificar_sumativa' => 77,
            ],
            [
                'id_duales'          => 2,
                'id_materia'         => 2,
                'status'             => 2,
                'id_periodo'         => 12,
                'id_grupo'           => 2,
                'calificar_sumativa' => 84,
            ],
            [
                'id_duales'          => 3,
                'id_materia'         => 3,
                'status'             => 3,
                'id_periodo'         => 3,
                'id_grupo'           => 3,
                'calificar_sumativa' => 91,
            ],
            [
                'id_duales'          => 4,
                'id_materia'         => 4,
                'status'             => 4,
                'id_periodo'         => 12,
                'id_grupo'           => 4,
                'calificar_sumativa' => 98,
            ],
            [
                'id_duales'          => 5,
                'id_materia'         => 5,
                'status'             => 5,
                'id_periodo'         => 12,
                'id_grupo'           => 5,
                'calificar_sumativa' => 74,
            ],
            [
                'id_duales'          => 6,
                'id_materia'         => 6,
                'status'             => 6,
                'id_periodo'         => 6,
                'id_grupo'           => 6,
                'calificar_sumativa' => 81,
            ],
            [
                'id_duales'          => 7,
                'id_materia'         => 7,
                'status'             => 7,
                'id_periodo'         => 12,
                'id_grupo'           => 7,
                'calificar_sumativa' => 88,
            ],
            [
                'id_duales'          => 8,
                'id_materia'         => 8,
                'status'             => 8,
                'id_periodo'         => 12,
                'id_grupo'           => 8,
                'calificar_sumativa' => 95,
            ],
            [
                'id_duales'          => 9,
                'id_materia'         => 9,
                'status'             => 9,
                'id_periodo'         => 9,
                'id_grupo'           => 9,
                'calificar_sumativa' => 71,
            ],
            [
                'id_duales'          => 10,
                'id_materia'         => 10,
                'status'             => 10,
                'id_periodo'         => 12,
                'id_grupo'           => 10,
                'calificar_sumativa' => 78,
            ],
            [
                'id_duales'          => 11,
                'id_materia'         => 11,
                'status'             => 11,
                'id_periodo'         => 12,
                'id_grupo'           => 11,
                'calificar_sumativa' => 85,
            ],
            [
                'id_duales'          => 12,
                'id_materia'         => 12,
                'status'             => 12,
                'id_periodo'         => 12,
                'id_grupo'           => 12,
                'calificar_sumativa' => 92,
            ],
            [
                'id_duales'          => 13,
                'id_materia'         => 13,
                'status'             => 13,
                'id_periodo'         => 12,
                'id_grupo'           => 13,
                'calificar_sumativa' => 99,
            ],
            [
                'id_duales'          => 14,
                'id_materia'         => 14,
                'status'             => 14,
                'id_periodo'         => 12,
                'id_grupo'           => 14,
                'calificar_sumativa' => 75,
            ],
            [
                'id_duales'          => 15,
                'id_materia'         => 15,
                'status'             => 15,
                'id_periodo'         => 15,
                'id_grupo'           => 15,
                'calificar_sumativa' => 82,
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
