<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_sala`.
 */
class TiSalaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_sala` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_sala';

        $llaves = [
            ['id_sala'],
        ];

        $registros = [
            [
                'id_sala'     => 1,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 1.',
                'id_estado'   => 1,
            ],
            [
                'id_sala'     => 2,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 2.',
                'id_estado'   => 2,
            ],
            [
                'id_sala'     => 3,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 3.',
                'id_estado'   => 3,
            ],
            [
                'id_sala'     => 4,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 4.',
                'id_estado'   => 4,
            ],
            [
                'id_sala'     => 5,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 5.',
                'id_estado'   => 5,
            ],
            [
                'id_sala'     => 6,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 6.',
                'id_estado'   => 6,
            ],
            [
                'id_sala'     => 7,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 7.',
                'id_estado'   => 7,
            ],
            [
                'id_sala'     => 8,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 8.',
                'id_estado'   => 8,
            ],
            [
                'id_sala'     => 9,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 9.',
                'id_estado'   => 9,
            ],
            [
                'id_sala'     => 10,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 10.',
                'id_estado'   => 10,
            ],
            [
                'id_sala'     => 11,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 11.',
                'id_estado'   => 11,
            ],
            [
                'id_sala'     => 12,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 12.',
                'id_estado'   => 12,
            ],
            [
                'id_sala'     => 13,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 13.',
                'id_estado'   => 13,
            ],
            [
                'id_sala'     => 14,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 14.',
                'id_estado'   => 14,
            ],
            [
                'id_sala'     => 15,
                'nombre_sala' => 'Nombre sala de sala: registro de prueba número 15.',
                'id_estado'   => 15,
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
