<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_actividades_extras`.
 */
class HrsActividadesExtrasSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_actividades_extras` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_actividades_extras';

        $llaves = [
            ['id_hrs_actividad_extra'],
        ];

        $registros = [
            [
                'id_hrs_actividad_extra' => 1,
                'descripcion'            => 'Descripcion actividades extras 1',
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 2,
                'descripcion'            => 'Descripcion actividades extras 2',
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 3,
                'descripcion'            => 'Descripcion actividades extras 3',
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 4,
                'descripcion'            => 'Descripcion actividades extras 4',
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 5,
                'descripcion'            => 'Descripcion actividades extras 5',
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 6,
                'descripcion'            => 'Descripcion actividades extras 6',
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 7,
                'descripcion'            => 'Descripcion actividades extras 7',
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 8,
                'descripcion'            => 'Descripcion actividades extras 8',
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 9,
                'descripcion'            => 'Descripcion actividades extras 9',
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 10,
                'descripcion'            => 'Descripcion actividades extras 10',
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 11,
                'descripcion'            => 'Descripcion actividades extras 11',
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 12,
                'descripcion'            => 'Descripcion actividades extras 12',
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 13,
                'descripcion'            => 'Descripcion actividades extras 13',
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 14,
                'descripcion'            => 'Descripcion actividades extras 14',
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
            ],
            [
                'id_hrs_actividad_extra' => 15,
                'descripcion'            => 'Descripcion actividades extras 15',
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
