<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_act_extra_clases`.
 */
class HrsActExtraClasesSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_act_extra_clases` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'hrs_act_extra_clases';

        $llaves = [
            ['id_act_extra_clase'],
        ];

        $registros = [
            [
                'id_act_extra_clase'     => 1,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 1',
                'actividad'              => 'Actividad act extra clases 1',
                'id_carrera'             => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
            ],
            [
                'id_act_extra_clase'     => 2,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 2',
                'actividad'              => 'Actividad act extra clases 2',
                'id_carrera'             => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
            ],
            [
                'id_act_extra_clase'     => 3,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 3',
                'actividad'              => 'Actividad act extra clases 3',
                'id_carrera'             => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
            ],
            [
                'id_act_extra_clase'     => 4,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 4',
                'actividad'              => 'Actividad act extra clases 4',
                'id_carrera'             => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
            ],
            [
                'id_act_extra_clase'     => 5,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 5',
                'actividad'              => 'Actividad act extra clases 5',
                'id_carrera'             => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
            ],
            [
                'id_act_extra_clase'     => 6,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 6',
                'actividad'              => 'Actividad act extra clases 6',
                'id_carrera'             => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
            ],
            [
                'id_act_extra_clase'     => 7,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 7',
                'actividad'              => 'Actividad act extra clases 7',
                'id_carrera'             => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
            ],
            [
                'id_act_extra_clase'     => 8,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 8',
                'actividad'              => 'Actividad act extra clases 8',
                'id_carrera'             => 1,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
            ],
            [
                'id_act_extra_clase'     => 9,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 9',
                'actividad'              => 'Actividad act extra clases 9',
                'id_carrera'             => 2,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
            ],
            [
                'id_act_extra_clase'     => 10,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 10',
                'actividad'              => 'Actividad act extra clases 10',
                'id_carrera'             => 3,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
            ],
            [
                'id_act_extra_clase'     => 11,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 11',
                'actividad'              => 'Actividad act extra clases 11',
                'id_carrera'             => 4,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
            ],
            [
                'id_act_extra_clase'     => 12,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 12',
                'actividad'              => 'Actividad act extra clases 12',
                'id_carrera'             => 5,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
            ],
            [
                'id_act_extra_clase'     => 13,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 13',
                'actividad'              => 'Actividad act extra clases 13',
                'id_carrera'             => 6,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
            ],
            [
                'id_act_extra_clase'     => 14,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 14',
                'actividad'              => 'Actividad act extra clases 14',
                'id_carrera'             => 7,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
            ],
            [
                'id_act_extra_clase'     => 15,
                'id_hrs_actividad_extra' => 'Id hrs actividad extra act extra clases 15',
                'actividad'              => 'Actividad act extra clases 15',
                'id_carrera'             => 1,
                'created_at'             => '2026-05-11 14:00:00',
                'updated_at'             => '2026-05-11 14:00:00',
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
