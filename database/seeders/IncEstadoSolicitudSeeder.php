<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_estado_solicitud`.
 */
class IncEstadoSolicitudSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_estado_solicitud` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inc_estado_solicitud';

        $llaves = [
            ['id_estado_solicitud'],
        ];

        $registros = [
            [
                'id_estado_solicitud'       => 1,
                'descripcion_estado_oficio' => 'Descripcion e 1',
            ],
            [
                'id_estado_solicitud'       => 2,
                'descripcion_estado_oficio' => 'Descripcion e 2',
            ],
            [
                'id_estado_solicitud'       => 3,
                'descripcion_estado_oficio' => 'Descripcion e 3',
            ],
            [
                'id_estado_solicitud'       => 4,
                'descripcion_estado_oficio' => 'Descripcion e 4',
            ],
            [
                'id_estado_solicitud'       => 5,
                'descripcion_estado_oficio' => 'Descripcion e 5',
            ],
            [
                'id_estado_solicitud'       => 6,
                'descripcion_estado_oficio' => 'Descripcion e 6',
            ],
            [
                'id_estado_solicitud'       => 7,
                'descripcion_estado_oficio' => 'Descripcion e 7',
            ],
            [
                'id_estado_solicitud'       => 8,
                'descripcion_estado_oficio' => 'Descripcion e 8',
            ],
            [
                'id_estado_solicitud'       => 9,
                'descripcion_estado_oficio' => 'Descripcion e 9',
            ],
            [
                'id_estado_solicitud'       => 10,
                'descripcion_estado_oficio' => 'Descripcion 10',
            ],
            [
                'id_estado_solicitud'       => 11,
                'descripcion_estado_oficio' => 'Descripcion 11',
            ],
            [
                'id_estado_solicitud'       => 12,
                'descripcion_estado_oficio' => 'Descripcion 12',
            ],
            [
                'id_estado_solicitud'       => 13,
                'descripcion_estado_oficio' => 'Descripcion 13',
            ],
            [
                'id_estado_solicitud'       => 14,
                'descripcion_estado_oficio' => 'Descripcion 14',
            ],
            [
                'id_estado_solicitud'       => 15,
                'descripcion_estado_oficio' => 'Descripcion 15',
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
