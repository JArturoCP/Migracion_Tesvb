<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_actividad`.
 */
class AudActividadSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_actividad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_actividad';

        $llaves = [
            ['id_actividad'],
        ];

        $registros = [
            [
                'id_actividad' => 1,
                'descripcion'  => 'Descripcion actividad 1',
                'created_at'   => '2026-01-05 09:00:00',
                'updated_at'   => '2026-01-05 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 2,
                'descripcion'  => 'Descripcion actividad 2',
                'created_at'   => '2026-01-14 10:00:00',
                'updated_at'   => '2026-01-14 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 3,
                'descripcion'  => 'Descripcion actividad 3',
                'created_at'   => '2026-01-23 11:00:00',
                'updated_at'   => '2026-01-23 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 4,
                'descripcion'  => 'Descripcion actividad 4',
                'created_at'   => '2026-02-01 12:00:00',
                'updated_at'   => '2026-02-01 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 5,
                'descripcion'  => 'Descripcion actividad 5',
                'created_at'   => '2026-02-10 13:00:00',
                'updated_at'   => '2026-02-10 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 6,
                'descripcion'  => 'Descripcion actividad 6',
                'created_at'   => '2026-02-19 14:00:00',
                'updated_at'   => '2026-02-19 14:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 7,
                'descripcion'  => 'Descripcion actividad 7',
                'created_at'   => '2026-02-28 15:00:00',
                'updated_at'   => '2026-02-28 15:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 8,
                'descripcion'  => 'Descripcion actividad 8',
                'created_at'   => '2026-03-09 16:00:00',
                'updated_at'   => '2026-03-09 16:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 9,
                'descripcion'  => 'Descripcion actividad 9',
                'created_at'   => '2026-03-18 08:00:00',
                'updated_at'   => '2026-03-18 08:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 10,
                'descripcion'  => 'Descripcion actividad 10',
                'created_at'   => '2026-03-27 09:00:00',
                'updated_at'   => '2026-03-27 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 11,
                'descripcion'  => 'Descripcion actividad 11',
                'created_at'   => '2026-04-05 10:00:00',
                'updated_at'   => '2026-04-05 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 12,
                'descripcion'  => 'Descripcion actividad 12',
                'created_at'   => '2026-04-14 11:00:00',
                'updated_at'   => '2026-04-14 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 13,
                'descripcion'  => 'Descripcion actividad 13',
                'created_at'   => '2026-04-23 12:00:00',
                'updated_at'   => '2026-04-23 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 14,
                'descripcion'  => 'Descripcion actividad 14',
                'created_at'   => '2026-05-02 13:00:00',
                'updated_at'   => '2026-05-02 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_actividad' => 15,
                'descripcion'  => 'Descripcion actividad 15',
                'created_at'   => '2026-05-11 14:00:00',
                'updated_at'   => '2026-05-11 14:00:00',
                'deleted_at'   => null,
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
