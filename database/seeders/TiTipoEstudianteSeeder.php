<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_tipo_estudiante`.
 */
class TiTipoEstudianteSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_tipo_estudiante` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_tipo_estudiante';

        $llaves = [
            ['id_tipo_estudiante'],
        ];

        $registros = [
            [
                'id_tipo_estudiante' => 1,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 1',
            ],
            [
                'id_tipo_estudiante' => 2,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 2',
            ],
            [
                'id_tipo_estudiante' => 3,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 3',
            ],
            [
                'id_tipo_estudiante' => 4,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 4',
            ],
            [
                'id_tipo_estudiante' => 5,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 5',
            ],
            [
                'id_tipo_estudiante' => 6,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 6',
            ],
            [
                'id_tipo_estudiante' => 7,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 7',
            ],
            [
                'id_tipo_estudiante' => 8,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 8',
            ],
            [
                'id_tipo_estudiante' => 9,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 9',
            ],
            [
                'id_tipo_estudiante' => 10,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 10',
            ],
            [
                'id_tipo_estudiante' => 11,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 11',
            ],
            [
                'id_tipo_estudiante' => 12,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 12',
            ],
            [
                'id_tipo_estudiante' => 13,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 13',
            ],
            [
                'id_tipo_estudiante' => 14,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 14',
            ],
            [
                'id_tipo_estudiante' => 15,
                'tipo_estudiante'    => 'Tipo estudiante tipo estudiante 15',
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
