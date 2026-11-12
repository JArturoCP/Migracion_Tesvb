<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_vehiculo`.
 */
class OcVehiculoSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_vehiculo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_vehiculo';

        $llaves = [
            ['id_vehiculo'],
        ];

        $registros = [
            [
                'id_vehiculo'   => 1,
                'modelo'        => 'Modelo vehiculo 1',
                'placas'        => 'Placas vehiculo 1',
                'id_asignacion' => 1,
            ],
            [
                'id_vehiculo'   => 2,
                'modelo'        => 'Modelo vehiculo 2',
                'placas'        => 'Placas vehiculo 2',
                'id_asignacion' => 2,
            ],
            [
                'id_vehiculo'   => 3,
                'modelo'        => 'Modelo vehiculo 3',
                'placas'        => 'Placas vehiculo 3',
                'id_asignacion' => 3,
            ],
            [
                'id_vehiculo'   => 4,
                'modelo'        => 'Modelo vehiculo 4',
                'placas'        => 'Placas vehiculo 4',
                'id_asignacion' => 4,
            ],
            [
                'id_vehiculo'   => 5,
                'modelo'        => 'Modelo vehiculo 5',
                'placas'        => 'Placas vehiculo 5',
                'id_asignacion' => 5,
            ],
            [
                'id_vehiculo'   => 6,
                'modelo'        => 'Modelo vehiculo 6',
                'placas'        => 'Placas vehiculo 6',
                'id_asignacion' => 6,
            ],
            [
                'id_vehiculo'   => 7,
                'modelo'        => 'Modelo vehiculo 7',
                'placas'        => 'Placas vehiculo 7',
                'id_asignacion' => 7,
            ],
            [
                'id_vehiculo'   => 8,
                'modelo'        => 'Modelo vehiculo 8',
                'placas'        => 'Placas vehiculo 8',
                'id_asignacion' => 8,
            ],
            [
                'id_vehiculo'   => 9,
                'modelo'        => 'Modelo vehiculo 9',
                'placas'        => 'Placas vehiculo 9',
                'id_asignacion' => 9,
            ],
            [
                'id_vehiculo'   => 10,
                'modelo'        => 'Modelo vehiculo 10',
                'placas'        => 'Placas vehiculo 10',
                'id_asignacion' => 10,
            ],
            [
                'id_vehiculo'   => 11,
                'modelo'        => 'Modelo vehiculo 11',
                'placas'        => 'Placas vehiculo 11',
                'id_asignacion' => 11,
            ],
            [
                'id_vehiculo'   => 12,
                'modelo'        => 'Modelo vehiculo 12',
                'placas'        => 'Placas vehiculo 12',
                'id_asignacion' => 12,
            ],
            [
                'id_vehiculo'   => 13,
                'modelo'        => 'Modelo vehiculo 13',
                'placas'        => 'Placas vehiculo 13',
                'id_asignacion' => 13,
            ],
            [
                'id_vehiculo'   => 14,
                'modelo'        => 'Modelo vehiculo 14',
                'placas'        => 'Placas vehiculo 14',
                'id_asignacion' => 14,
            ],
            [
                'id_vehiculo'   => 15,
                'modelo'        => 'Modelo vehiculo 15',
                'placas'        => 'Placas vehiculo 15',
                'id_asignacion' => 15,
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
