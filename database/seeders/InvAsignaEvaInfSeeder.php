<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_asigna_eva_inf`.
 */
class InvAsignaEvaInfSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_asigna_eva_inf` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvAsignaInformesSeeder::class,
            InvPregInformesSeeder::class,
        ]);

        $tabla = 'inv_asigna_eva_inf';

        $llaves = [
            ['id_asigna_eval_inf'],
        ];

        $registros = [
            [
                'id_asigna_eval_inf' => 1,
                'id_asigna_informes' => 1,
                'id_pregunta'        => 1,
                'id_resultado'       => 1,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 1.',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 2,
                'id_asigna_informes' => 2,
                'id_pregunta'        => 2,
                'id_resultado'       => 2,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 2.',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 3,
                'id_asigna_informes' => 3,
                'id_pregunta'        => 3,
                'id_resultado'       => 3,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 3.',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 4,
                'id_asigna_informes' => 4,
                'id_pregunta'        => 4,
                'id_resultado'       => 4,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 4.',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 5,
                'id_asigna_informes' => 5,
                'id_pregunta'        => 5,
                'id_resultado'       => 5,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 5.',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 6,
                'id_asigna_informes' => 6,
                'id_pregunta'        => 6,
                'id_resultado'       => 6,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 6.',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 7,
                'id_asigna_informes' => 7,
                'id_pregunta'        => 7,
                'id_resultado'       => 7,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 7.',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 8,
                'id_asigna_informes' => 8,
                'id_pregunta'        => 8,
                'id_resultado'       => 8,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 8.',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 9,
                'id_asigna_informes' => 9,
                'id_pregunta'        => 9,
                'id_resultado'       => 9,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 9.',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 10,
                'id_asigna_informes' => 10,
                'id_pregunta'        => 10,
                'id_resultado'       => 10,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 10.',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 11,
                'id_asigna_informes' => 11,
                'id_pregunta'        => 11,
                'id_resultado'       => 11,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 11.',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 12,
                'id_asigna_informes' => 12,
                'id_pregunta'        => 12,
                'id_resultado'       => 12,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 12.',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 13,
                'id_asigna_informes' => 13,
                'id_pregunta'        => 13,
                'id_resultado'       => 13,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 13.',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 14,
                'id_asigna_informes' => 14,
                'id_pregunta'        => 14,
                'id_resultado'       => 14,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 14.',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_eval_inf' => 15,
                'id_asigna_informes' => 15,
                'id_pregunta'        => 15,
                'id_resultado'       => 15,
                'valor'              => 'Valor de asigna eva inf: registro de prueba número 15.',
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'deleted_at'         => null,
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
