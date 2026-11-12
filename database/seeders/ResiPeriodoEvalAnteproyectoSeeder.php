<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_periodo_eval_anteproyecto`.
 */
class ResiPeriodoEvalAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_periodo_eval_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'resi_periodo_eval_anteproyecto';

        $llaves = [
            ['id_periodo_eval_anteproyecto'],
        ];

        $registros = [
            [
                'id_periodo_eval_anteproyecto' => 1,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-01-05',
                'fecha_final'                  => '2026-01-05',
                'estado_periodo'               => 1,
                'updated_at'                   => '2026-01-05 09:00:00',
                'created_at'                   => '2026-01-05 09:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 2,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-01-14',
                'fecha_final'                  => '2026-01-14',
                'estado_periodo'               => 2,
                'updated_at'                   => '2026-01-14 10:00:00',
                'created_at'                   => '2026-01-14 10:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 3,
                'id_periodo'                   => 3,
                'fecha_inicio'                 => '2026-01-23',
                'fecha_final'                  => '2026-01-23',
                'estado_periodo'               => 3,
                'updated_at'                   => '2026-01-23 11:00:00',
                'created_at'                   => '2026-01-23 11:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 4,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-02-01',
                'fecha_final'                  => '2026-02-01',
                'estado_periodo'               => 4,
                'updated_at'                   => '2026-02-01 12:00:00',
                'created_at'                   => '2026-02-01 12:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 5,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-02-10',
                'fecha_final'                  => '2026-02-10',
                'estado_periodo'               => 5,
                'updated_at'                   => '2026-02-10 13:00:00',
                'created_at'                   => '2026-02-10 13:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 6,
                'id_periodo'                   => 6,
                'fecha_inicio'                 => '2026-02-19',
                'fecha_final'                  => '2026-02-19',
                'estado_periodo'               => 6,
                'updated_at'                   => '2026-02-19 14:00:00',
                'created_at'                   => '2026-02-19 14:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 7,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-02-28',
                'fecha_final'                  => '2026-02-28',
                'estado_periodo'               => 7,
                'updated_at'                   => '2026-02-28 15:00:00',
                'created_at'                   => '2026-02-28 15:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 8,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-03-09',
                'fecha_final'                  => '2026-03-09',
                'estado_periodo'               => 8,
                'updated_at'                   => '2026-03-09 16:00:00',
                'created_at'                   => '2026-03-09 16:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 9,
                'id_periodo'                   => 9,
                'fecha_inicio'                 => '2026-03-18',
                'fecha_final'                  => '2026-03-18',
                'estado_periodo'               => 9,
                'updated_at'                   => '2026-03-18 08:00:00',
                'created_at'                   => '2026-03-18 08:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 10,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-03-27',
                'fecha_final'                  => '2026-03-27',
                'estado_periodo'               => 10,
                'updated_at'                   => '2026-03-27 09:00:00',
                'created_at'                   => '2026-03-27 09:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 11,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-04-05',
                'fecha_final'                  => '2026-04-05',
                'estado_periodo'               => 11,
                'updated_at'                   => '2026-04-05 10:00:00',
                'created_at'                   => '2026-04-05 10:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 12,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-04-14',
                'fecha_final'                  => '2026-04-14',
                'estado_periodo'               => 12,
                'updated_at'                   => '2026-04-14 11:00:00',
                'created_at'                   => '2026-04-14 11:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 13,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-04-23',
                'fecha_final'                  => '2026-04-23',
                'estado_periodo'               => 13,
                'updated_at'                   => '2026-04-23 12:00:00',
                'created_at'                   => '2026-04-23 12:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 14,
                'id_periodo'                   => 12,
                'fecha_inicio'                 => '2026-05-02',
                'fecha_final'                  => '2026-05-02',
                'estado_periodo'               => 14,
                'updated_at'                   => '2026-05-02 13:00:00',
                'created_at'                   => '2026-05-02 13:00:00',
            ],
            [
                'id_periodo_eval_anteproyecto' => 15,
                'id_periodo'                   => 15,
                'fecha_inicio'                 => '2026-05-11',
                'fecha_final'                  => '2026-05-11',
                'estado_periodo'               => 15,
                'updated_at'                   => '2026-05-11 14:00:00',
                'created_at'                   => '2026-05-11 14:00:00',
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
