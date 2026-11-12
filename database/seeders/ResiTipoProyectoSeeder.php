<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_tipo_proyecto`.
 */
class ResiTipoProyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_tipo_proyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_tipo_proyecto';

        $llaves = [
            ['id_tipo_proyecto'],
        ];

        $registros = [
            [
                'id_tipo_proyecto' => 1,
                'descripcion'      => 'Descripcion tipo proyecto 1',
            ],
            [
                'id_tipo_proyecto' => 2,
                'descripcion'      => 'Descripcion tipo proyecto 2',
            ],
            [
                'id_tipo_proyecto' => 3,
                'descripcion'      => 'Descripcion tipo proyecto 3',
            ],
            [
                'id_tipo_proyecto' => 4,
                'descripcion'      => 'Descripcion tipo proyecto 4',
            ],
            [
                'id_tipo_proyecto' => 5,
                'descripcion'      => 'Descripcion tipo proyecto 5',
            ],
            [
                'id_tipo_proyecto' => 6,
                'descripcion'      => 'Descripcion tipo proyecto 6',
            ],
            [
                'id_tipo_proyecto' => 7,
                'descripcion'      => 'Descripcion tipo proyecto 7',
            ],
            [
                'id_tipo_proyecto' => 8,
                'descripcion'      => 'Descripcion tipo proyecto 8',
            ],
            [
                'id_tipo_proyecto' => 9,
                'descripcion'      => 'Descripcion tipo proyecto 9',
            ],
            [
                'id_tipo_proyecto' => 10,
                'descripcion'      => 'Descripcion tipo proyecto 10',
            ],
            [
                'id_tipo_proyecto' => 11,
                'descripcion'      => 'Descripcion tipo proyecto 11',
            ],
            [
                'id_tipo_proyecto' => 12,
                'descripcion'      => 'Descripcion tipo proyecto 12',
            ],
            [
                'id_tipo_proyecto' => 13,
                'descripcion'      => 'Descripcion tipo proyecto 13',
            ],
            [
                'id_tipo_proyecto' => 14,
                'descripcion'      => 'Descripcion tipo proyecto 14',
            ],
            [
                'id_tipo_proyecto' => 15,
                'descripcion'      => 'Descripcion tipo proyecto 15',
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
