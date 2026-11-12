<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_validacion_carga`.
 */
class EvaValidacionCargaSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_validacion_carga` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'eva_validacion_carga';

        $llaves = [
            ['id_validacion_carga'],
        ];

        $registros = [
            [
                'id_validacion_carga' => 1,
                'descripcion'         => 1,
            ],
            [
                'id_validacion_carga' => 2,
                'descripcion'         => 2,
            ],
            [
                'id_validacion_carga' => 3,
                'descripcion'         => 3,
            ],
            [
                'id_validacion_carga' => 4,
                'descripcion'         => 4,
            ],
            [
                'id_validacion_carga' => 5,
                'descripcion'         => 5,
            ],
            [
                'id_validacion_carga' => 6,
                'descripcion'         => 6,
            ],
            [
                'id_validacion_carga' => 7,
                'descripcion'         => 7,
            ],
            [
                'id_validacion_carga' => 8,
                'descripcion'         => 8,
            ],
            [
                'id_validacion_carga' => 9,
                'descripcion'         => 9,
            ],
            [
                'id_validacion_carga' => 10,
                'descripcion'         => 10,
            ],
            [
                'id_validacion_carga' => 11,
                'descripcion'         => 11,
            ],
            [
                'id_validacion_carga' => 12,
                'descripcion'         => 12,
            ],
            [
                'id_validacion_carga' => 13,
                'descripcion'         => 13,
            ],
            [
                'id_validacion_carga' => 14,
                'descripcion'         => 14,
            ],
            [
                'id_validacion_carga' => 15,
                'descripcion'         => 15,
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
