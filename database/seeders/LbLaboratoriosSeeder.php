<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `lb_laboratorios`.
 */
class LbLaboratoriosSeeder extends Seeder
{
    /**
     * Pobla la tabla `lb_laboratorios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'lb_laboratorios';

        $llaves = [
            ['id_laboratorio'],
        ];

        $registros = [
            [
                'id_laboratorio' => 1,
                'descripcion'    => 'Descripcion laboratorios 1',
            ],
            [
                'id_laboratorio' => 2,
                'descripcion'    => 'Descripcion laboratorios 2',
            ],
            [
                'id_laboratorio' => 3,
                'descripcion'    => 'Descripcion laboratorios 3',
            ],
            [
                'id_laboratorio' => 4,
                'descripcion'    => 'Descripcion laboratorios 4',
            ],
            [
                'id_laboratorio' => 5,
                'descripcion'    => 'Descripcion laboratorios 5',
            ],
            [
                'id_laboratorio' => 6,
                'descripcion'    => 'Descripcion laboratorios 6',
            ],
            [
                'id_laboratorio' => 7,
                'descripcion'    => 'Descripcion laboratorios 7',
            ],
            [
                'id_laboratorio' => 8,
                'descripcion'    => 'Descripcion laboratorios 8',
            ],
            [
                'id_laboratorio' => 9,
                'descripcion'    => 'Descripcion laboratorios 9',
            ],
            [
                'id_laboratorio' => 10,
                'descripcion'    => 'Descripcion laboratorios 10',
            ],
            [
                'id_laboratorio' => 11,
                'descripcion'    => 'Descripcion laboratorios 11',
            ],
            [
                'id_laboratorio' => 12,
                'descripcion'    => 'Descripcion laboratorios 12',
            ],
            [
                'id_laboratorio' => 13,
                'descripcion'    => 'Descripcion laboratorios 13',
            ],
            [
                'id_laboratorio' => 14,
                'descripcion'    => 'Descripcion laboratorios 14',
            ],
            [
                'id_laboratorio' => 15,
                'descripcion'    => 'Descripcion laboratorios 15',
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
