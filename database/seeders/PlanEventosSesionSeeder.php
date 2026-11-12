<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_eventos_sesion`.
 */
class PlanEventosSesionSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_eventos_sesion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PlanEventosSeeder::class,
        ]);

        $tabla = 'plan_eventos_sesion';

        $llaves = [
            ['id_evento_sesion'],
        ];

        $registros = [
            [
                'id_evento_sesion' => 1,
                'id_evento'        => 1,
                'id_secuencia'     => 1,
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'id_unidad'        => 1,
            ],
            [
                'id_evento_sesion' => 2,
                'id_evento'        => 2,
                'id_secuencia'     => 2,
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'id_unidad'        => 2,
            ],
            [
                'id_evento_sesion' => 3,
                'id_evento'        => 3,
                'id_secuencia'     => 3,
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'id_unidad'        => 3,
            ],
            [
                'id_evento_sesion' => 4,
                'id_evento'        => 4,
                'id_secuencia'     => 4,
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'id_unidad'        => 4,
            ],
            [
                'id_evento_sesion' => 5,
                'id_evento'        => 5,
                'id_secuencia'     => 5,
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'id_unidad'        => 5,
            ],
            [
                'id_evento_sesion' => 6,
                'id_evento'        => 6,
                'id_secuencia'     => 6,
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'id_unidad'        => 6,
            ],
            [
                'id_evento_sesion' => 7,
                'id_evento'        => 7,
                'id_secuencia'     => 7,
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'id_unidad'        => 7,
            ],
            [
                'id_evento_sesion' => 8,
                'id_evento'        => 8,
                'id_secuencia'     => 8,
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'id_unidad'        => 8,
            ],
            [
                'id_evento_sesion' => 9,
                'id_evento'        => 9,
                'id_secuencia'     => 9,
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'id_unidad'        => 9,
            ],
            [
                'id_evento_sesion' => 10,
                'id_evento'        => 10,
                'id_secuencia'     => 10,
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'id_unidad'        => 10,
            ],
            [
                'id_evento_sesion' => 11,
                'id_evento'        => 11,
                'id_secuencia'     => 11,
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'id_unidad'        => 11,
            ],
            [
                'id_evento_sesion' => 12,
                'id_evento'        => 12,
                'id_secuencia'     => 12,
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'id_unidad'        => 12,
            ],
            [
                'id_evento_sesion' => 13,
                'id_evento'        => 13,
                'id_secuencia'     => 13,
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'id_unidad'        => 13,
            ],
            [
                'id_evento_sesion' => 14,
                'id_evento'        => 14,
                'id_secuencia'     => 14,
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'id_unidad'        => 14,
            ],
            [
                'id_evento_sesion' => 15,
                'id_evento'        => 15,
                'id_secuencia'     => 15,
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'id_unidad'        => 15,
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
