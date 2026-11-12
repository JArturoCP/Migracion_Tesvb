<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_niveles_ingles`.
 */
class InNivelesInglesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_niveles_ingles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'in_niveles_ingles';

        $llaves = [
            ['id_niveles_ingles'],
        ];

        $registros = [
            [
                'id_niveles_ingles' => 1,
                'descripcion'       => 'Descripcion niveles ingles 1',
                'clave'             => 'CLV-001',
            ],
            [
                'id_niveles_ingles' => 2,
                'descripcion'       => 'Descripcion niveles ingles 2',
                'clave'             => 'CLV-002',
            ],
            [
                'id_niveles_ingles' => 3,
                'descripcion'       => 'Descripcion niveles ingles 3',
                'clave'             => 'CLV-003',
            ],
            [
                'id_niveles_ingles' => 4,
                'descripcion'       => 'Descripcion niveles ingles 4',
                'clave'             => 'CLV-004',
            ],
            [
                'id_niveles_ingles' => 5,
                'descripcion'       => 'Descripcion niveles ingles 5',
                'clave'             => 'CLV-005',
            ],
            [
                'id_niveles_ingles' => 6,
                'descripcion'       => 'Descripcion niveles ingles 6',
                'clave'             => 'CLV-006',
            ],
            [
                'id_niveles_ingles' => 7,
                'descripcion'       => 'Descripcion niveles ingles 7',
                'clave'             => 'CLV-007',
            ],
            [
                'id_niveles_ingles' => 8,
                'descripcion'       => 'Descripcion niveles ingles 8',
                'clave'             => 'CLV-008',
            ],
            [
                'id_niveles_ingles' => 9,
                'descripcion'       => 'Descripcion niveles ingles 9',
                'clave'             => 'CLV-009',
            ],
            [
                'id_niveles_ingles' => 10,
                'descripcion'       => 'Descripcion niveles ingles 10',
                'clave'             => 'CLV-010',
            ],
            [
                'id_niveles_ingles' => 11,
                'descripcion'       => 'Descripcion niveles ingles 11',
                'clave'             => 'CLV-011',
            ],
            [
                'id_niveles_ingles' => 12,
                'descripcion'       => 'Descripcion niveles ingles 12',
                'clave'             => 'CLV-012',
            ],
            [
                'id_niveles_ingles' => 13,
                'descripcion'       => 'Descripcion niveles ingles 13',
                'clave'             => 'CLV-013',
            ],
            [
                'id_niveles_ingles' => 14,
                'descripcion'       => 'Descripcion niveles ingles 14',
                'clave'             => 'CLV-014',
            ],
            [
                'id_niveles_ingles' => 15,
                'descripcion'       => 'Descripcion niveles ingles 15',
                'clave'             => 'CLV-015',
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
