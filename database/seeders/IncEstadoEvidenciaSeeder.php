<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_estado_evidencia`.
 */
class IncEstadoEvidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_estado_evidencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inc_estado_evidencia';

        $llaves = [
            ['id_estado_evid'],
        ];

        $registros = [
            [
                'id_estado_evid'          => 1,
                'descripcion_estado_evid' => 'V1',
            ],
            [
                'id_estado_evid'          => 2,
                'descripcion_estado_evid' => 'V2',
            ],
            [
                'id_estado_evid'          => 3,
                'descripcion_estado_evid' => 'V3',
            ],
            [
                'id_estado_evid'          => 4,
                'descripcion_estado_evid' => 'V4',
            ],
            [
                'id_estado_evid'          => 5,
                'descripcion_estado_evid' => 'V5',
            ],
            [
                'id_estado_evid'          => 6,
                'descripcion_estado_evid' => 'V6',
            ],
            [
                'id_estado_evid'          => 7,
                'descripcion_estado_evid' => 'V7',
            ],
            [
                'id_estado_evid'          => 8,
                'descripcion_estado_evid' => 'V8',
            ],
            [
                'id_estado_evid'          => 9,
                'descripcion_estado_evid' => 'V9',
            ],
            [
                'id_estado_evid'          => 10,
                'descripcion_estado_evid' => 'V10',
            ],
            [
                'id_estado_evid'          => 11,
                'descripcion_estado_evid' => 'V11',
            ],
            [
                'id_estado_evid'          => 12,
                'descripcion_estado_evid' => 'V12',
            ],
            [
                'id_estado_evid'          => 13,
                'descripcion_estado_evid' => 'V13',
            ],
            [
                'id_estado_evid'          => 14,
                'descripcion_estado_evid' => 'V14',
            ],
            [
                'id_estado_evid'          => 15,
                'descripcion_estado_evid' => 'V15',
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
