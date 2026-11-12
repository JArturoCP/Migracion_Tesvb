<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_periodos_califica`.
 */
class CalPeriodosCalificaSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_periodos_califica` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            GnralGruposSeeder::class,
            GnralMateriasSeeder::class,
        ]);

        $tabla = 'cal_periodos_califica';

        $llaves = [
            ['id_periodo_cal'],
        ];

        $registros = [
            [
                'id_periodo_cal'       => 1,
                'fecha'                => '2026-01-05',
                'id_unidad'            => 1,
                'id_periodos'          => 1,
                'id_materia'           => 1,
                'id_grupo'             => 1,
                'evaluada'             => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 1',
            ],
            [
                'id_periodo_cal'       => 2,
                'fecha'                => '2026-01-14',
                'id_unidad'            => 2,
                'id_periodos'          => 2,
                'id_materia'           => 2,
                'id_grupo'             => 2,
                'evaluada'             => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 2',
            ],
            [
                'id_periodo_cal'       => 3,
                'fecha'                => '2026-01-23',
                'id_unidad'            => 3,
                'id_periodos'          => 3,
                'id_materia'           => 3,
                'id_grupo'             => 3,
                'evaluada'             => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 3',
            ],
            [
                'id_periodo_cal'       => 4,
                'fecha'                => '2026-02-01',
                'id_unidad'            => 4,
                'id_periodos'          => 4,
                'id_materia'           => 4,
                'id_grupo'             => 4,
                'evaluada'             => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 4',
            ],
            [
                'id_periodo_cal'       => 5,
                'fecha'                => '2026-02-10',
                'id_unidad'            => 5,
                'id_periodos'          => 5,
                'id_materia'           => 5,
                'id_grupo'             => 5,
                'evaluada'             => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 5',
            ],
            [
                'id_periodo_cal'       => 6,
                'fecha'                => '2026-02-19',
                'id_unidad'            => 6,
                'id_periodos'          => 6,
                'id_materia'           => 6,
                'id_grupo'             => 6,
                'evaluada'             => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 6',
            ],
            [
                'id_periodo_cal'       => 7,
                'fecha'                => '2026-02-28',
                'id_unidad'            => 7,
                'id_periodos'          => 7,
                'id_materia'           => 7,
                'id_grupo'             => 7,
                'evaluada'             => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 7',
            ],
            [
                'id_periodo_cal'       => 8,
                'fecha'                => '2026-03-09',
                'id_unidad'            => 8,
                'id_periodos'          => 8,
                'id_materia'           => 8,
                'id_grupo'             => 8,
                'evaluada'             => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 8',
            ],
            [
                'id_periodo_cal'       => 9,
                'fecha'                => '2026-03-18',
                'id_unidad'            => 1,
                'id_periodos'          => 9,
                'id_materia'           => 9,
                'id_grupo'             => 9,
                'evaluada'             => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 9',
            ],
            [
                'id_periodo_cal'       => 10,
                'fecha'                => '2026-03-27',
                'id_unidad'            => 2,
                'id_periodos'          => 10,
                'id_materia'           => 10,
                'id_grupo'             => 10,
                'evaluada'             => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 10',
            ],
            [
                'id_periodo_cal'       => 11,
                'fecha'                => '2026-04-05',
                'id_unidad'            => 3,
                'id_periodos'          => 11,
                'id_materia'           => 11,
                'id_grupo'             => 11,
                'evaluada'             => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 11',
            ],
            [
                'id_periodo_cal'       => 12,
                'fecha'                => '2026-04-14',
                'id_unidad'            => 4,
                'id_periodos'          => 12,
                'id_materia'           => 12,
                'id_grupo'             => 12,
                'evaluada'             => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 12',
            ],
            [
                'id_periodo_cal'       => 13,
                'fecha'                => '2026-04-23',
                'id_unidad'            => 5,
                'id_periodos'          => 13,
                'id_materia'           => 13,
                'id_grupo'             => 13,
                'evaluada'             => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 13',
            ],
            [
                'id_periodo_cal'       => 14,
                'fecha'                => '2026-05-02',
                'id_unidad'            => 6,
                'id_periodos'          => 14,
                'id_materia'           => 14,
                'id_grupo'             => 14,
                'evaluada'             => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 14',
            ],
            [
                'id_periodo_cal'       => 15,
                'fecha'                => '2026-05-11',
                'id_unidad'            => 7,
                'id_periodos'          => 15,
                'id_materia'           => 15,
                'id_grupo'             => 15,
                'evaluada'             => 15,
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'acciones_preventivas' => 'Acciones preventivas periodos califica 15',
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
