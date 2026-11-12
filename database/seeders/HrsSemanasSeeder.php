<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_semanas`.
 */
class HrsSemanasSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_semanas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_semanas';

        $llaves = [
            ['id_semana'],
        ];

        $registros = [
            [
                'id_semana' => 1,
                'dia'       => 'LUNES',
                'hora'      => '07:00-08:00',
            ],
            [
                'id_semana' => 2,
                'dia'       => 'MARTES',
                'hora'      => '07:00-08:00',
            ],
            [
                'id_semana' => 3,
                'dia'       => 'MIÉRCOLES',
                'hora'      => '07:00-08:00',
            ],
            [
                'id_semana' => 4,
                'dia'       => 'JUEVES',
                'hora'      => '07:00-08:00',
            ],
            [
                'id_semana' => 5,
                'dia'       => 'VIERNES',
                'hora'      => '07:00-08:00',
            ],
            [
                'id_semana' => 6,
                'dia'       => 'LUNES',
                'hora'      => '08:00-09:00',
            ],
            [
                'id_semana' => 7,
                'dia'       => 'MARTES',
                'hora'      => '08:00-09:00',
            ],
            [
                'id_semana' => 8,
                'dia'       => 'MIÉRCOLES',
                'hora'      => '08:00-09:00',
            ],
            [
                'id_semana' => 9,
                'dia'       => 'JUEVES',
                'hora'      => '08:00-09:00',
            ],
            [
                'id_semana' => 10,
                'dia'       => 'VIERNES',
                'hora'      => '08:00-09:00',
            ],
            [
                'id_semana' => 11,
                'dia'       => 'LUNES',
                'hora'      => '09:00-10:00',
            ],
            [
                'id_semana' => 12,
                'dia'       => 'MARTES',
                'hora'      => '09:00-10:00',
            ],
            [
                'id_semana' => 13,
                'dia'       => 'MIÉRCOLES',
                'hora'      => '09:00-10:00',
            ],
            [
                'id_semana' => 14,
                'dia'       => 'JUEVES',
                'hora'      => '09:00-10:00',
            ],
            [
                'id_semana' => 15,
                'dia'       => 'VIERNES',
                'hora'      => '09:00-10:00',
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
