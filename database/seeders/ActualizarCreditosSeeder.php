<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actualizar_creditos`.
 */
class ActualizarCreditosSeeder extends Seeder
{
    /**
     * Pobla la tabla `actualizar_creditos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaValidacionDeCargasSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'actualizar_creditos';

        $llaves = [
            ['id_act_credito'],
        ];

        $registros = [
            [
                'id_act_credito' => 1,
                'id_alumno'      => 1,
                'id'             => 1,
                'credito_min'    => 1,
                'credito_max'    => 1,
            ],
            [
                'id_act_credito' => 2,
                'id_alumno'      => 2,
                'id'             => 2,
                'credito_min'    => 2,
                'credito_max'    => 2,
            ],
            [
                'id_act_credito' => 3,
                'id_alumno'      => 3,
                'id'             => 3,
                'credito_min'    => 3,
                'credito_max'    => 3,
            ],
            [
                'id_act_credito' => 4,
                'id_alumno'      => 4,
                'id'             => 4,
                'credito_min'    => 4,
                'credito_max'    => 4,
            ],
            [
                'id_act_credito' => 5,
                'id_alumno'      => 5,
                'id'             => 5,
                'credito_min'    => 5,
                'credito_max'    => 5,
            ],
            [
                'id_act_credito' => 6,
                'id_alumno'      => 6,
                'id'             => 6,
                'credito_min'    => 6,
                'credito_max'    => 6,
            ],
            [
                'id_act_credito' => 7,
                'id_alumno'      => 7,
                'id'             => 7,
                'credito_min'    => 7,
                'credito_max'    => 7,
            ],
            [
                'id_act_credito' => 8,
                'id_alumno'      => 8,
                'id'             => 8,
                'credito_min'    => 8,
                'credito_max'    => 8,
            ],
            [
                'id_act_credito' => 9,
                'id_alumno'      => 9,
                'id'             => 9,
                'credito_min'    => 9,
                'credito_max'    => 9,
            ],
            [
                'id_act_credito' => 10,
                'id_alumno'      => 10,
                'id'             => 10,
                'credito_min'    => 10,
                'credito_max'    => 10,
            ],
            [
                'id_act_credito' => 11,
                'id_alumno'      => 11,
                'id'             => 11,
                'credito_min'    => 11,
                'credito_max'    => 11,
            ],
            [
                'id_act_credito' => 12,
                'id_alumno'      => 12,
                'id'             => 12,
                'credito_min'    => 12,
                'credito_max'    => 12,
            ],
            [
                'id_act_credito' => 13,
                'id_alumno'      => 13,
                'id'             => 13,
                'credito_min'    => 13,
                'credito_max'    => 13,
            ],
            [
                'id_act_credito' => 14,
                'id_alumno'      => 14,
                'id'             => 14,
                'credito_min'    => 14,
                'credito_max'    => 14,
            ],
            [
                'id_act_credito' => 15,
                'id_alumno'      => 15,
                'id'             => 15,
                'credito_min'    => 15,
                'credito_max'    => 15,
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
