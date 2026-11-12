<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_eventos`.
 */
class PlanEventosSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_eventos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_eventos';

        $llaves = [
            ['id_evento'],
        ];

        $registros = [
            [
                'id_evento'   => 1,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 1.',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 2,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 2.',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 3,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 3.',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 4,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 4.',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 5,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 5.',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 6,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 6.',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 7,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 7.',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 8,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 8.',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 9,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 9.',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 10,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 10.',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 11,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 11.',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 12,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 12.',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 13,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 13.',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 14,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 14.',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_evento'   => 15,
                'descripcion' => 'Descripcion de eventos: registro de prueba número 15.',
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
                'deleted_at'  => null,
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
