<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_calificaciones_pre`.
 */
class EvaCalificacionesPreSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_calificaciones_pre` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaCriterioSeeder::class,
            GnralHorasProfesoresSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'eva_calificaciones_pre';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'              => 1,
                'id_periodo'      => 12,
                'no_pregunta'     => '0001',
                'calificacion_p'  => 7.3,
                'id_hrs_profesor' => 1,
                'id_criterio'     => 1,
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id'              => 2,
                'id_periodo'      => 12,
                'no_pregunta'     => '0002',
                'calificacion_p'  => 7.6,
                'id_hrs_profesor' => 2,
                'id_criterio'     => 2,
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id'              => 3,
                'id_periodo'      => 3,
                'no_pregunta'     => '0003',
                'calificacion_p'  => 7.9,
                'id_hrs_profesor' => 3,
                'id_criterio'     => 3,
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id'              => 4,
                'id_periodo'      => 12,
                'no_pregunta'     => '0004',
                'calificacion_p'  => 8.2,
                'id_hrs_profesor' => 4,
                'id_criterio'     => 4,
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id'              => 5,
                'id_periodo'      => 12,
                'no_pregunta'     => '0005',
                'calificacion_p'  => 8.5,
                'id_hrs_profesor' => 5,
                'id_criterio'     => 5,
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id'              => 6,
                'id_periodo'      => 6,
                'no_pregunta'     => '0006',
                'calificacion_p'  => 8.8,
                'id_hrs_profesor' => 6,
                'id_criterio'     => 6,
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id'              => 7,
                'id_periodo'      => 12,
                'no_pregunta'     => '0007',
                'calificacion_p'  => 9.1,
                'id_hrs_profesor' => 7,
                'id_criterio'     => 7,
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id'              => 8,
                'id_periodo'      => 12,
                'no_pregunta'     => '0008',
                'calificacion_p'  => 9.4,
                'id_hrs_profesor' => 8,
                'id_criterio'     => 8,
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id'              => 9,
                'id_periodo'      => 9,
                'no_pregunta'     => '0009',
                'calificacion_p'  => 9.7,
                'id_hrs_profesor' => 9,
                'id_criterio'     => 9,
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id'              => 10,
                'id_periodo'      => 12,
                'no_pregunta'     => '0010',
                'calificacion_p'  => 7.0,
                'id_hrs_profesor' => 10,
                'id_criterio'     => 10,
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id'              => 11,
                'id_periodo'      => 12,
                'no_pregunta'     => '0011',
                'calificacion_p'  => 7.3,
                'id_hrs_profesor' => 11,
                'id_criterio'     => 11,
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id'              => 12,
                'id_periodo'      => 12,
                'no_pregunta'     => '0012',
                'calificacion_p'  => 7.6,
                'id_hrs_profesor' => 12,
                'id_criterio'     => 12,
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id'              => 13,
                'id_periodo'      => 12,
                'no_pregunta'     => '0013',
                'calificacion_p'  => 7.9,
                'id_hrs_profesor' => 13,
                'id_criterio'     => 13,
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id'              => 14,
                'id_periodo'      => 12,
                'no_pregunta'     => '0014',
                'calificacion_p'  => 8.2,
                'id_hrs_profesor' => 14,
                'id_criterio'     => 14,
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id'              => 15,
                'id_periodo'      => 15,
                'no_pregunta'     => '0015',
                'calificacion_p'  => 8.5,
                'id_hrs_profesor' => 15,
                'id_criterio'     => 15,
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
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
