<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_periodos_semestres_act`.
 */
class EvaPeriodosSemestresActSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_periodos_semestres_act` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'eva_periodos_semestres_act';

        $llaves = [
            ['id_periodos_sem_act'],
        ];

        $registros = [
            [
                'id_periodos_sem_act'     => 1,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 1,
                'fecha_registro'          => '2026-01-05',
                'fecha_actualizacion'     => '2026-01-05',
            ],
            [
                'id_periodos_sem_act'     => 2,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 2,
                'fecha_registro'          => '2026-01-14',
                'fecha_actualizacion'     => '2026-01-14',
            ],
            [
                'id_periodos_sem_act'     => 3,
                'id_periodo'              => 3,
                'id_estado_actualizacion' => 3,
                'fecha_registro'          => '2026-01-23',
                'fecha_actualizacion'     => '2026-01-23',
            ],
            [
                'id_periodos_sem_act'     => 4,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 4,
                'fecha_registro'          => '2026-02-01',
                'fecha_actualizacion'     => '2026-02-01',
            ],
            [
                'id_periodos_sem_act'     => 5,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 5,
                'fecha_registro'          => '2026-02-10',
                'fecha_actualizacion'     => '2026-02-10',
            ],
            [
                'id_periodos_sem_act'     => 6,
                'id_periodo'              => 6,
                'id_estado_actualizacion' => 6,
                'fecha_registro'          => '2026-02-19',
                'fecha_actualizacion'     => '2026-02-19',
            ],
            [
                'id_periodos_sem_act'     => 7,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 7,
                'fecha_registro'          => '2026-02-28',
                'fecha_actualizacion'     => '2026-02-28',
            ],
            [
                'id_periodos_sem_act'     => 8,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 8,
                'fecha_registro'          => '2026-03-09',
                'fecha_actualizacion'     => '2026-03-09',
            ],
            [
                'id_periodos_sem_act'     => 9,
                'id_periodo'              => 9,
                'id_estado_actualizacion' => 9,
                'fecha_registro'          => '2026-03-18',
                'fecha_actualizacion'     => '2026-03-18',
            ],
            [
                'id_periodos_sem_act'     => 10,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 10,
                'fecha_registro'          => '2026-03-27',
                'fecha_actualizacion'     => '2026-03-27',
            ],
            [
                'id_periodos_sem_act'     => 11,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 11,
                'fecha_registro'          => '2026-04-05',
                'fecha_actualizacion'     => '2026-04-05',
            ],
            [
                'id_periodos_sem_act'     => 12,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 12,
                'fecha_registro'          => '2026-04-14',
                'fecha_actualizacion'     => '2026-04-14',
            ],
            [
                'id_periodos_sem_act'     => 13,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 13,
                'fecha_registro'          => '2026-04-23',
                'fecha_actualizacion'     => '2026-04-23',
            ],
            [
                'id_periodos_sem_act'     => 14,
                'id_periodo'              => 12,
                'id_estado_actualizacion' => 14,
                'fecha_registro'          => '2026-05-02',
                'fecha_actualizacion'     => '2026-05-02',
            ],
            [
                'id_periodos_sem_act'     => 15,
                'id_periodo'              => 15,
                'id_estado_actualizacion' => 15,
                'fecha_registro'          => '2026-05-11',
                'fecha_actualizacion'     => '2026-05-11',
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
