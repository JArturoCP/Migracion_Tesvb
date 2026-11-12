<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_secuencia_didacticas`.
 */
class PlanSecuenciaDidacticasSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_secuencia_didacticas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_secuencia_didacticas';

        $llaves = [
            ['id_secuencia'],
        ];

        $registros = [
            [
                'id_secuencia'   => 1,
                'id_encabezado'  => 1,
                'horas_teoria'   => 1,
                'horas_practica' => 1,
                'fecha_sesion'   => '2026-01-05',
                'numero_sesion'  => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'id_unidad'      => 1,
            ],
            [
                'id_secuencia'   => 2,
                'id_encabezado'  => 2,
                'horas_teoria'   => 2,
                'horas_practica' => 2,
                'fecha_sesion'   => '2026-01-14',
                'numero_sesion'  => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'id_unidad'      => 2,
            ],
            [
                'id_secuencia'   => 3,
                'id_encabezado'  => 3,
                'horas_teoria'   => 3,
                'horas_practica' => 3,
                'fecha_sesion'   => '2026-01-23',
                'numero_sesion'  => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'id_unidad'      => 3,
            ],
            [
                'id_secuencia'   => 4,
                'id_encabezado'  => 4,
                'horas_teoria'   => 4,
                'horas_practica' => 4,
                'fecha_sesion'   => '2026-02-01',
                'numero_sesion'  => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'id_unidad'      => 4,
            ],
            [
                'id_secuencia'   => 5,
                'id_encabezado'  => 5,
                'horas_teoria'   => 5,
                'horas_practica' => 5,
                'fecha_sesion'   => '2026-02-10',
                'numero_sesion'  => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'id_unidad'      => 5,
            ],
            [
                'id_secuencia'   => 6,
                'id_encabezado'  => 6,
                'horas_teoria'   => 6,
                'horas_practica' => 6,
                'fecha_sesion'   => '2026-02-19',
                'numero_sesion'  => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'id_unidad'      => 6,
            ],
            [
                'id_secuencia'   => 7,
                'id_encabezado'  => 7,
                'horas_teoria'   => 7,
                'horas_practica' => 7,
                'fecha_sesion'   => '2026-02-28',
                'numero_sesion'  => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'id_unidad'      => 7,
            ],
            [
                'id_secuencia'   => 8,
                'id_encabezado'  => 8,
                'horas_teoria'   => 8,
                'horas_practica' => 8,
                'fecha_sesion'   => '2026-03-09',
                'numero_sesion'  => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'id_unidad'      => 8,
            ],
            [
                'id_secuencia'   => 9,
                'id_encabezado'  => 9,
                'horas_teoria'   => 9,
                'horas_practica' => 9,
                'fecha_sesion'   => '2026-03-18',
                'numero_sesion'  => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'id_unidad'      => 9,
            ],
            [
                'id_secuencia'   => 10,
                'id_encabezado'  => 10,
                'horas_teoria'   => 10,
                'horas_practica' => 10,
                'fecha_sesion'   => '2026-03-27',
                'numero_sesion'  => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'id_unidad'      => 10,
            ],
            [
                'id_secuencia'   => 11,
                'id_encabezado'  => 11,
                'horas_teoria'   => 11,
                'horas_practica' => 11,
                'fecha_sesion'   => '2026-04-05',
                'numero_sesion'  => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'id_unidad'      => 11,
            ],
            [
                'id_secuencia'   => 12,
                'id_encabezado'  => 12,
                'horas_teoria'   => 12,
                'horas_practica' => 12,
                'fecha_sesion'   => '2026-04-14',
                'numero_sesion'  => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'id_unidad'      => 12,
            ],
            [
                'id_secuencia'   => 13,
                'id_encabezado'  => 13,
                'horas_teoria'   => 13,
                'horas_practica' => 13,
                'fecha_sesion'   => '2026-04-23',
                'numero_sesion'  => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'id_unidad'      => 13,
            ],
            [
                'id_secuencia'   => 14,
                'id_encabezado'  => 14,
                'horas_teoria'   => 14,
                'horas_practica' => 14,
                'fecha_sesion'   => '2026-05-02',
                'numero_sesion'  => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'id_unidad'      => 14,
            ],
            [
                'id_secuencia'   => 15,
                'id_encabezado'  => 15,
                'horas_teoria'   => 15,
                'horas_practica' => 15,
                'fecha_sesion'   => '2026-05-11',
                'numero_sesion'  => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'id_unidad'      => 15,
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
