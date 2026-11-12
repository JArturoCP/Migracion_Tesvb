<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_tipo_evidencia`.
 */
class IncTipoEvidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_tipo_evidencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inc_tipo_evidencia';

        $llaves = [
            ['id_tipo_evid'],
        ];

        $registros = [
            [
                'id_tipo_evid'     => 1,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 1.',
            ],
            [
                'id_tipo_evid'     => 2,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 2.',
            ],
            [
                'id_tipo_evid'     => 3,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 3.',
            ],
            [
                'id_tipo_evid'     => 4,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 4.',
            ],
            [
                'id_tipo_evid'     => 5,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 5.',
            ],
            [
                'id_tipo_evid'     => 6,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 6.',
            ],
            [
                'id_tipo_evid'     => 7,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 7.',
            ],
            [
                'id_tipo_evid'     => 8,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 8.',
            ],
            [
                'id_tipo_evid'     => 9,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 9.',
            ],
            [
                'id_tipo_evid'     => 10,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 10.',
            ],
            [
                'id_tipo_evid'     => 11,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 11.',
            ],
            [
                'id_tipo_evid'     => 12,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 12.',
            ],
            [
                'id_tipo_evid'     => 13,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 13.',
            ],
            [
                'id_tipo_evid'     => 14,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 14.',
            ],
            [
                'id_tipo_evid'     => 15,
                'nombre_evidencia' => 'Nombre evidencia de tipo evidencia: registro de prueba número 15.',
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
