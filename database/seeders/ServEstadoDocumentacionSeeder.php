<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_estado_documentacion`.
 */
class ServEstadoDocumentacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_estado_documentacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'serv_estado_documentacion';

        $llaves = [
            ['id_estado_documentacion'],
        ];

        $registros = [
            [
                'id_estado_documentacion' => 1,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 1',
            ],
            [
                'id_estado_documentacion' => 2,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 2',
            ],
            [
                'id_estado_documentacion' => 3,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 3',
            ],
            [
                'id_estado_documentacion' => 4,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 4',
            ],
            [
                'id_estado_documentacion' => 5,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 5',
            ],
            [
                'id_estado_documentacion' => 6,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 6',
            ],
            [
                'id_estado_documentacion' => 7,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 7',
            ],
            [
                'id_estado_documentacion' => 8,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 8',
            ],
            [
                'id_estado_documentacion' => 9,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 9',
            ],
            [
                'id_estado_documentacion' => 10,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 10',
            ],
            [
                'id_estado_documentacion' => 11,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 11',
            ],
            [
                'id_estado_documentacion' => 12,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 12',
            ],
            [
                'id_estado_documentacion' => 13,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 13',
            ],
            [
                'id_estado_documentacion' => 14,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 14',
            ],
            [
                'id_estado_documentacion' => 15,
                'estado_documentacion'    => 'Estado documentacion estado documentacion 15',
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
