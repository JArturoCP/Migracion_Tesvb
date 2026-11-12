<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_contar_evaluaciones`.
 */
class ResiContarEvaluacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_contar_evaluaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_contar_evaluaciones';

        $llaves = [
            ['id_contar_evaluaciones'],
        ];

        $registros = [
            [
                'id_contar_evaluaciones' => 1,
                'id_anteproyecto'        => 1,
                'numero_evaluacion'      => 1,
            ],
            [
                'id_contar_evaluaciones' => 2,
                'id_anteproyecto'        => 2,
                'numero_evaluacion'      => 2,
            ],
            [
                'id_contar_evaluaciones' => 3,
                'id_anteproyecto'        => 3,
                'numero_evaluacion'      => 3,
            ],
            [
                'id_contar_evaluaciones' => 4,
                'id_anteproyecto'        => 4,
                'numero_evaluacion'      => 4,
            ],
            [
                'id_contar_evaluaciones' => 5,
                'id_anteproyecto'        => 5,
                'numero_evaluacion'      => 5,
            ],
            [
                'id_contar_evaluaciones' => 6,
                'id_anteproyecto'        => 6,
                'numero_evaluacion'      => 6,
            ],
            [
                'id_contar_evaluaciones' => 7,
                'id_anteproyecto'        => 7,
                'numero_evaluacion'      => 7,
            ],
            [
                'id_contar_evaluaciones' => 8,
                'id_anteproyecto'        => 8,
                'numero_evaluacion'      => 8,
            ],
            [
                'id_contar_evaluaciones' => 9,
                'id_anteproyecto'        => 9,
                'numero_evaluacion'      => 9,
            ],
            [
                'id_contar_evaluaciones' => 10,
                'id_anteproyecto'        => 10,
                'numero_evaluacion'      => 10,
            ],
            [
                'id_contar_evaluaciones' => 11,
                'id_anteproyecto'        => 11,
                'numero_evaluacion'      => 11,
            ],
            [
                'id_contar_evaluaciones' => 12,
                'id_anteproyecto'        => 12,
                'numero_evaluacion'      => 12,
            ],
            [
                'id_contar_evaluaciones' => 13,
                'id_anteproyecto'        => 13,
                'numero_evaluacion'      => 13,
            ],
            [
                'id_contar_evaluaciones' => 14,
                'id_anteproyecto'        => 14,
                'numero_evaluacion'      => 14,
            ],
            [
                'id_contar_evaluaciones' => 15,
                'id_anteproyecto'        => 15,
                'numero_evaluacion'      => 15,
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
