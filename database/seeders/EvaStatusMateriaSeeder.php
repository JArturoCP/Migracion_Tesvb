<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_status_materia`.
 */
class EvaStatusMateriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_status_materia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'eva_status_materia';

        $llaves = [
            ['id_status_materia', 'nombre_status'],
        ];

        $registros = [
            [
                'id_status_materia' => 1,
                'nombre_status'     => 'Nombre status status materia 1',
            ],
            [
                'id_status_materia' => 2,
                'nombre_status'     => 'Nombre status status materia 2',
            ],
            [
                'id_status_materia' => 3,
                'nombre_status'     => 'Nombre status status materia 3',
            ],
            [
                'id_status_materia' => 4,
                'nombre_status'     => 'Nombre status status materia 4',
            ],
            [
                'id_status_materia' => 5,
                'nombre_status'     => 'Nombre status status materia 5',
            ],
            [
                'id_status_materia' => 6,
                'nombre_status'     => 'Nombre status status materia 6',
            ],
            [
                'id_status_materia' => 7,
                'nombre_status'     => 'Nombre status status materia 7',
            ],
            [
                'id_status_materia' => 8,
                'nombre_status'     => 'Nombre status status materia 8',
            ],
            [
                'id_status_materia' => 9,
                'nombre_status'     => 'Nombre status status materia 9',
            ],
            [
                'id_status_materia' => 10,
                'nombre_status'     => 'Nombre status status materia 10',
            ],
            [
                'id_status_materia' => 11,
                'nombre_status'     => 'Nombre status status materia 11',
            ],
            [
                'id_status_materia' => 12,
                'nombre_status'     => 'Nombre status status materia 12',
            ],
            [
                'id_status_materia' => 13,
                'nombre_status'     => 'Nombre status status materia 13',
            ],
            [
                'id_status_materia' => 14,
                'nombre_status'     => 'Nombre status status materia 14',
            ],
            [
                'id_status_materia' => 15,
                'nombre_status'     => 'Nombre status status materia 15',
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
