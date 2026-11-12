<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_calificar_sumativas`.
 */
class GnralCalificarSumativasSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_calificar_sumativas` con registros ficticios.
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

        $tabla = 'gnral_calificar_sumativas';

        $llaves = [
            ['id_calificar_sumativas'],
        ];

        $registros = [
            [
                'id_calificar_sumativas' => 1,
                'id_materia'             => 1,
                'id_grupo'               => 1,
                'id_estado'              => 1,
                'id_periodo'             => 12,
                'fecha'                  => '2026-01-05',
            ],
            [
                'id_calificar_sumativas' => 2,
                'id_materia'             => 2,
                'id_grupo'               => 2,
                'id_estado'              => 2,
                'id_periodo'             => 12,
                'fecha'                  => '2026-01-14',
            ],
            [
                'id_calificar_sumativas' => 3,
                'id_materia'             => 3,
                'id_grupo'               => 3,
                'id_estado'              => 3,
                'id_periodo'             => 3,
                'fecha'                  => '2026-01-23',
            ],
            [
                'id_calificar_sumativas' => 4,
                'id_materia'             => 4,
                'id_grupo'               => 4,
                'id_estado'              => 4,
                'id_periodo'             => 12,
                'fecha'                  => '2026-02-01',
            ],
            [
                'id_calificar_sumativas' => 5,
                'id_materia'             => 5,
                'id_grupo'               => 5,
                'id_estado'              => 5,
                'id_periodo'             => 12,
                'fecha'                  => '2026-02-10',
            ],
            [
                'id_calificar_sumativas' => 6,
                'id_materia'             => 6,
                'id_grupo'               => 6,
                'id_estado'              => 6,
                'id_periodo'             => 6,
                'fecha'                  => '2026-02-19',
            ],
            [
                'id_calificar_sumativas' => 7,
                'id_materia'             => 7,
                'id_grupo'               => 7,
                'id_estado'              => 7,
                'id_periodo'             => 12,
                'fecha'                  => '2026-02-28',
            ],
            [
                'id_calificar_sumativas' => 8,
                'id_materia'             => 8,
                'id_grupo'               => 8,
                'id_estado'              => 8,
                'id_periodo'             => 12,
                'fecha'                  => '2026-03-09',
            ],
            [
                'id_calificar_sumativas' => 9,
                'id_materia'             => 9,
                'id_grupo'               => 9,
                'id_estado'              => 9,
                'id_periodo'             => 9,
                'fecha'                  => '2026-03-18',
            ],
            [
                'id_calificar_sumativas' => 10,
                'id_materia'             => 10,
                'id_grupo'               => 10,
                'id_estado'              => 10,
                'id_periodo'             => 12,
                'fecha'                  => '2026-03-27',
            ],
            [
                'id_calificar_sumativas' => 11,
                'id_materia'             => 11,
                'id_grupo'               => 11,
                'id_estado'              => 11,
                'id_periodo'             => 12,
                'fecha'                  => '2026-04-05',
            ],
            [
                'id_calificar_sumativas' => 12,
                'id_materia'             => 12,
                'id_grupo'               => 12,
                'id_estado'              => 12,
                'id_periodo'             => 12,
                'fecha'                  => '2026-04-14',
            ],
            [
                'id_calificar_sumativas' => 13,
                'id_materia'             => 13,
                'id_grupo'               => 13,
                'id_estado'              => 13,
                'id_periodo'             => 12,
                'fecha'                  => '2026-04-23',
            ],
            [
                'id_calificar_sumativas' => 14,
                'id_materia'             => 14,
                'id_grupo'               => 14,
                'id_estado'              => 14,
                'id_periodo'             => 12,
                'fecha'                  => '2026-05-02',
            ],
            [
                'id_calificar_sumativas' => 15,
                'id_materia'             => 15,
                'id_grupo'               => 15,
                'id_estado'              => 15,
                'id_periodo'             => 15,
                'fecha'                  => '2026-05-11',
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
