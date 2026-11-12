<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_estado_numeros_titulos`.
 */
class TiEstadoNumerosTitulosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_estado_numeros_titulos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_estado_numeros_titulos';

        $llaves = [
            ['id_estado_numero_titulo'],
        ];

        $registros = [
            [
                'id_estado_numero_titulo' => 1,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 1',
                'clave'                   => 'CLV-001',
            ],
            [
                'id_estado_numero_titulo' => 2,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 2',
                'clave'                   => 'CLV-002',
            ],
            [
                'id_estado_numero_titulo' => 3,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 3',
                'clave'                   => 'CLV-003',
            ],
            [
                'id_estado_numero_titulo' => 4,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 4',
                'clave'                   => 'CLV-004',
            ],
            [
                'id_estado_numero_titulo' => 5,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 5',
                'clave'                   => 'CLV-005',
            ],
            [
                'id_estado_numero_titulo' => 6,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 6',
                'clave'                   => 'CLV-006',
            ],
            [
                'id_estado_numero_titulo' => 7,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 7',
                'clave'                   => 'CLV-007',
            ],
            [
                'id_estado_numero_titulo' => 8,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 8',
                'clave'                   => 'CLV-008',
            ],
            [
                'id_estado_numero_titulo' => 9,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 9',
                'clave'                   => 'CLV-009',
            ],
            [
                'id_estado_numero_titulo' => 10,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 10',
                'clave'                   => 'CLV-010',
            ],
            [
                'id_estado_numero_titulo' => 11,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 11',
                'clave'                   => 'CLV-011',
            ],
            [
                'id_estado_numero_titulo' => 12,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 12',
                'clave'                   => 'CLV-012',
            ],
            [
                'id_estado_numero_titulo' => 13,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 13',
                'clave'                   => 'CLV-013',
            ],
            [
                'id_estado_numero_titulo' => 14,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 14',
                'clave'                   => 'CLV-014',
            ],
            [
                'id_estado_numero_titulo' => 15,
                'estado_numero_titulo'    => 'Estado numero titulo estado numeros titulos 15',
                'clave'                   => 'CLV-015',
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
