<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_clave_carrera`.
 */
class TiClaveCarreraSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_clave_carrera` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'ti_clave_carrera';

        $llaves = [
            ['id_clave_carrera'],
        ];

        $registros = [
            [
                'id_clave_carrera' => 1,
                'id_carrera'       => 1,
                'clave'            => 'CLV-001',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 1.',
            ],
            [
                'id_clave_carrera' => 2,
                'id_carrera'       => 2,
                'clave'            => 'CLV-002',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 2.',
            ],
            [
                'id_clave_carrera' => 3,
                'id_carrera'       => 3,
                'clave'            => 'CLV-003',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 3.',
            ],
            [
                'id_clave_carrera' => 4,
                'id_carrera'       => 4,
                'clave'            => 'CLV-004',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 4.',
            ],
            [
                'id_clave_carrera' => 5,
                'id_carrera'       => 5,
                'clave'            => 'CLV-005',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 5.',
            ],
            [
                'id_clave_carrera' => 6,
                'id_carrera'       => 6,
                'clave'            => 'CLV-006',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 6.',
            ],
            [
                'id_clave_carrera' => 7,
                'id_carrera'       => 7,
                'clave'            => 'CLV-007',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 7.',
            ],
            [
                'id_clave_carrera' => 8,
                'id_carrera'       => 1,
                'clave'            => 'CLV-008',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 8.',
            ],
            [
                'id_clave_carrera' => 9,
                'id_carrera'       => 2,
                'clave'            => 'CLV-009',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 9.',
            ],
            [
                'id_clave_carrera' => 10,
                'id_carrera'       => 3,
                'clave'            => 'CLV-010',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 10.',
            ],
            [
                'id_clave_carrera' => 11,
                'id_carrera'       => 4,
                'clave'            => 'CLV-011',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 11.',
            ],
            [
                'id_clave_carrera' => 12,
                'id_carrera'       => 5,
                'clave'            => 'CLV-012',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 12.',
            ],
            [
                'id_clave_carrera' => 13,
                'id_carrera'       => 6,
                'clave'            => 'CLV-013',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 13.',
            ],
            [
                'id_clave_carrera' => 14,
                'id_carrera'       => 7,
                'clave'            => 'CLV-014',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 14.',
            ],
            [
                'id_clave_carrera' => 15,
                'id_carrera'       => 1,
                'clave'            => 'CLV-015',
                'carrera_cedula'   => 'Carrera cedula de clave carrera: registro de prueba número 15.',
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
