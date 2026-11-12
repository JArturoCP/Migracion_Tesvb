<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_especialidad`.
 */
class CalEspecialidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_especialidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'cal_especialidad';

        $llaves = [
            ['id_especialidad'],
        ];

        $registros = [
            [
                'id_especialidad' => 1,
                'especialidad'    => 'Especialidad especialidad 1',
                'id_carrera'      => 1,
            ],
            [
                'id_especialidad' => 2,
                'especialidad'    => 'Especialidad especialidad 2',
                'id_carrera'      => 2,
            ],
            [
                'id_especialidad' => 3,
                'especialidad'    => 'Especialidad especialidad 3',
                'id_carrera'      => 3,
            ],
            [
                'id_especialidad' => 4,
                'especialidad'    => 'Especialidad especialidad 4',
                'id_carrera'      => 4,
            ],
            [
                'id_especialidad' => 5,
                'especialidad'    => 'Especialidad especialidad 5',
                'id_carrera'      => 5,
            ],
            [
                'id_especialidad' => 6,
                'especialidad'    => 'Especialidad especialidad 6',
                'id_carrera'      => 6,
            ],
            [
                'id_especialidad' => 7,
                'especialidad'    => 'Especialidad especialidad 7',
                'id_carrera'      => 7,
            ],
            [
                'id_especialidad' => 8,
                'especialidad'    => 'Especialidad especialidad 8',
                'id_carrera'      => 1,
            ],
            [
                'id_especialidad' => 9,
                'especialidad'    => 'Especialidad especialidad 9',
                'id_carrera'      => 2,
            ],
            [
                'id_especialidad' => 10,
                'especialidad'    => 'Especialidad especialidad 10',
                'id_carrera'      => 3,
            ],
            [
                'id_especialidad' => 11,
                'especialidad'    => 'Especialidad especialidad 11',
                'id_carrera'      => 4,
            ],
            [
                'id_especialidad' => 12,
                'especialidad'    => 'Especialidad especialidad 12',
                'id_carrera'      => 5,
            ],
            [
                'id_especialidad' => 13,
                'especialidad'    => 'Especialidad especialidad 13',
                'id_carrera'      => 6,
            ],
            [
                'id_especialidad' => 14,
                'especialidad'    => 'Especialidad especialidad 14',
                'id_carrera'      => 7,
            ],
            [
                'id_especialidad' => 15,
                'especialidad'    => 'Especialidad especialidad 15',
                'id_carrera'      => 1,
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
