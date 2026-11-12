<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_horarios_dias`.
 */
class TiHorariosDiasSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_horarios_dias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_horarios_dias';

        $llaves = [
            ['id_horarios_dias'],
        ];

        $registros = [
            [
                'id_horarios_dias' => 1,
                'horario_dia'      => '07:00-08:00',
                'hora'             => '07:00-08:00',
            ],
            [
                'id_horarios_dias' => 2,
                'horario_dia'      => '08:00-09:00',
                'hora'             => '08:00-09:00',
            ],
            [
                'id_horarios_dias' => 3,
                'horario_dia'      => '09:00-10:00',
                'hora'             => '09:00-10:00',
            ],
            [
                'id_horarios_dias' => 4,
                'horario_dia'      => '10:00-11:00',
                'hora'             => '10:00-11:00',
            ],
            [
                'id_horarios_dias' => 5,
                'horario_dia'      => '11:00-12:00',
                'hora'             => '11:00-12:00',
            ],
            [
                'id_horarios_dias' => 6,
                'horario_dia'      => '12:00-13:00',
                'hora'             => '12:00-13:00',
            ],
            [
                'id_horarios_dias' => 7,
                'horario_dia'      => '13:00-14:00',
                'hora'             => '13:00-14:00',
            ],
            [
                'id_horarios_dias' => 8,
                'horario_dia'      => '14:00-15:00',
                'hora'             => '14:00-15:00',
            ],
            [
                'id_horarios_dias' => 9,
                'horario_dia'      => '15:00-16:00',
                'hora'             => '15:00-16:00',
            ],
            [
                'id_horarios_dias' => 10,
                'horario_dia'      => '16:00-17:00',
                'hora'             => '16:00-17:00',
            ],
            [
                'id_horarios_dias' => 11,
                'horario_dia'      => '17:00-18:00',
                'hora'             => '17:00-18:00',
            ],
            [
                'id_horarios_dias' => 12,
                'horario_dia'      => '18:00-19:00',
                'hora'             => '18:00-19:00',
            ],
            [
                'id_horarios_dias' => 13,
                'horario_dia'      => '07:00-08:00',
                'hora'             => '07:00-08:00',
            ],
            [
                'id_horarios_dias' => 14,
                'horario_dia'      => '08:00-09:00',
                'hora'             => '08:00-09:00',
            ],
            [
                'id_horarios_dias' => 15,
                'horario_dia'      => '09:00-10:00',
                'hora'             => '09:00-10:00',
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
