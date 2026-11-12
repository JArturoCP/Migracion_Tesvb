<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_estado_documento`.
 */
class ServEstadoDocumentoSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_estado_documento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'serv_estado_documento';

        $llaves = [
            ['id_estado_documento'],
        ];

        $registros = [
            [
                'id_estado_documento' => 1,
                'descripcion'         => 'Descripcion estado documento 1',
            ],
            [
                'id_estado_documento' => 2,
                'descripcion'         => 'Descripcion estado documento 2',
            ],
            [
                'id_estado_documento' => 3,
                'descripcion'         => 'Descripcion estado documento 3',
            ],
            [
                'id_estado_documento' => 4,
                'descripcion'         => 'Descripcion estado documento 4',
            ],
            [
                'id_estado_documento' => 5,
                'descripcion'         => 'Descripcion estado documento 5',
            ],
            [
                'id_estado_documento' => 6,
                'descripcion'         => 'Descripcion estado documento 6',
            ],
            [
                'id_estado_documento' => 7,
                'descripcion'         => 'Descripcion estado documento 7',
            ],
            [
                'id_estado_documento' => 8,
                'descripcion'         => 'Descripcion estado documento 8',
            ],
            [
                'id_estado_documento' => 9,
                'descripcion'         => 'Descripcion estado documento 9',
            ],
            [
                'id_estado_documento' => 10,
                'descripcion'         => 'Descripcion estado documento 10',
            ],
            [
                'id_estado_documento' => 11,
                'descripcion'         => 'Descripcion estado documento 11',
            ],
            [
                'id_estado_documento' => 12,
                'descripcion'         => 'Descripcion estado documento 12',
            ],
            [
                'id_estado_documento' => 13,
                'descripcion'         => 'Descripcion estado documento 13',
            ],
            [
                'id_estado_documento' => 14,
                'descripcion'         => 'Descripcion estado documento 14',
            ],
            [
                'id_estado_documento' => 15,
                'descripcion'         => 'Descripcion estado documento 15',
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
