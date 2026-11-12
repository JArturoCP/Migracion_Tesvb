<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_estado_oficio`.
 */
class OcEstadoOficioSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_estado_oficio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_estado_oficio';

        $llaves = [
            ['id_notificacion'],
        ];

        $registros = [
            [
                'id_notificacion' => 1,
                'descripcion'     => 'Descripcion estado 1',
            ],
            [
                'id_notificacion' => 2,
                'descripcion'     => 'Descripcion estado 2',
            ],
            [
                'id_notificacion' => 3,
                'descripcion'     => 'Descripcion estado 3',
            ],
            [
                'id_notificacion' => 4,
                'descripcion'     => 'Descripcion estado 4',
            ],
            [
                'id_notificacion' => 5,
                'descripcion'     => 'Descripcion estado 5',
            ],
            [
                'id_notificacion' => 6,
                'descripcion'     => 'Descripcion estado 6',
            ],
            [
                'id_notificacion' => 7,
                'descripcion'     => 'Descripcion estado 7',
            ],
            [
                'id_notificacion' => 8,
                'descripcion'     => 'Descripcion estado 8',
            ],
            [
                'id_notificacion' => 9,
                'descripcion'     => 'Descripcion estado 9',
            ],
            [
                'id_notificacion' => 10,
                'descripcion'     => 'Descripcion estad 10',
            ],
            [
                'id_notificacion' => 11,
                'descripcion'     => 'Descripcion estad 11',
            ],
            [
                'id_notificacion' => 12,
                'descripcion'     => 'Descripcion estad 12',
            ],
            [
                'id_notificacion' => 13,
                'descripcion'     => 'Descripcion estad 13',
            ],
            [
                'id_notificacion' => 14,
                'descripcion'     => 'Descripcion estad 14',
            ],
            [
                'id_notificacion' => 15,
                'descripcion'     => 'Descripcion estad 15',
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
