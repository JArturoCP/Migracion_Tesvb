<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_evidencias`.
 */
class AudEvidenciasSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_evidencias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_evidencias';

        $llaves = [
            ['id_evidencia'],
        ];

        $registros = [
            [
                'id_evidencia' => 1,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 1.',
            ],
            [
                'id_evidencia' => 2,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 2.',
            ],
            [
                'id_evidencia' => 3,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 3.',
            ],
            [
                'id_evidencia' => 4,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 4.',
            ],
            [
                'id_evidencia' => 5,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 5.',
            ],
            [
                'id_evidencia' => 6,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 6.',
            ],
            [
                'id_evidencia' => 7,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 7.',
            ],
            [
                'id_evidencia' => 8,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 8.',
            ],
            [
                'id_evidencia' => 9,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 9.',
            ],
            [
                'id_evidencia' => 10,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 10.',
            ],
            [
                'id_evidencia' => 11,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 11.',
            ],
            [
                'id_evidencia' => 12,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 12.',
            ],
            [
                'id_evidencia' => 13,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 13.',
            ],
            [
                'id_evidencia' => 14,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 14.',
            ],
            [
                'id_evidencia' => 15,
                'descripcion'  => 'Descripcion de evidencias: registro de prueba número 15.',
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
