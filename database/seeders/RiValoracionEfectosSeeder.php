<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_valoracion_efectos`.
 */
class RiValoracionEfectosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_valoracion_efectos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiRegistroRiesgoSeeder::class,
        ]);

        $tabla = 'ri_valoracion_efectos';

        $llaves = [
            ['id_val_efecto'],
        ];

        $registros = [
            [
                'id_val_efecto'    => 1,
                'id_reg_riesgo'    => 1,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 1.',
                'grado_impacto'    => 1,
                'probabilidad'     => 1,
                'cuadrante'        => 'V1',
                'ocurrencia_final' => 1,
                'impacto_final'    => 1,
                'updated_at'       => '2026-01-05 09:00:00',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_val_efecto'    => 2,
                'id_reg_riesgo'    => 2,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 2.',
                'grado_impacto'    => 2,
                'probabilidad'     => 2,
                'cuadrante'        => 'V2',
                'ocurrencia_final' => 2,
                'impacto_final'    => 2,
                'updated_at'       => '2026-01-14 10:00:00',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_val_efecto'    => 3,
                'id_reg_riesgo'    => 3,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 3.',
                'grado_impacto'    => 3,
                'probabilidad'     => 3,
                'cuadrante'        => 'V3',
                'ocurrencia_final' => 3,
                'impacto_final'    => 3,
                'updated_at'       => '2026-01-23 11:00:00',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_val_efecto'    => 4,
                'id_reg_riesgo'    => 4,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 4.',
                'grado_impacto'    => 4,
                'probabilidad'     => 4,
                'cuadrante'        => 'V4',
                'ocurrencia_final' => 4,
                'impacto_final'    => 4,
                'updated_at'       => '2026-02-01 12:00:00',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_val_efecto'    => 5,
                'id_reg_riesgo'    => 5,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 5.',
                'grado_impacto'    => 5,
                'probabilidad'     => 5,
                'cuadrante'        => 'V5',
                'ocurrencia_final' => 5,
                'impacto_final'    => 5,
                'updated_at'       => '2026-02-10 13:00:00',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_val_efecto'    => 6,
                'id_reg_riesgo'    => 6,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 6.',
                'grado_impacto'    => 6,
                'probabilidad'     => 6,
                'cuadrante'        => 'V6',
                'ocurrencia_final' => 6,
                'impacto_final'    => 6,
                'updated_at'       => '2026-02-19 14:00:00',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_val_efecto'    => 7,
                'id_reg_riesgo'    => 7,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 7.',
                'grado_impacto'    => 7,
                'probabilidad'     => 7,
                'cuadrante'        => 'V7',
                'ocurrencia_final' => 7,
                'impacto_final'    => 7,
                'updated_at'       => '2026-02-28 15:00:00',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_val_efecto'    => 8,
                'id_reg_riesgo'    => 8,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 8.',
                'grado_impacto'    => 8,
                'probabilidad'     => 8,
                'cuadrante'        => 'V8',
                'ocurrencia_final' => 8,
                'impacto_final'    => 8,
                'updated_at'       => '2026-03-09 16:00:00',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_val_efecto'    => 9,
                'id_reg_riesgo'    => 9,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 9.',
                'grado_impacto'    => 9,
                'probabilidad'     => 9,
                'cuadrante'        => 'V9',
                'ocurrencia_final' => 9,
                'impacto_final'    => 9,
                'updated_at'       => '2026-03-18 08:00:00',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_val_efecto'    => 10,
                'id_reg_riesgo'    => 10,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 10.',
                'grado_impacto'    => 10,
                'probabilidad'     => 10,
                'cuadrante'        => 'V10',
                'ocurrencia_final' => 10,
                'impacto_final'    => 10,
                'updated_at'       => '2026-03-27 09:00:00',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_val_efecto'    => 11,
                'id_reg_riesgo'    => 11,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 11.',
                'grado_impacto'    => 11,
                'probabilidad'     => 11,
                'cuadrante'        => 'V11',
                'ocurrencia_final' => 11,
                'impacto_final'    => 11,
                'updated_at'       => '2026-04-05 10:00:00',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_val_efecto'    => 12,
                'id_reg_riesgo'    => 12,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 12.',
                'grado_impacto'    => 12,
                'probabilidad'     => 12,
                'cuadrante'        => 'V12',
                'ocurrencia_final' => 12,
                'impacto_final'    => 12,
                'updated_at'       => '2026-04-14 11:00:00',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_val_efecto'    => 13,
                'id_reg_riesgo'    => 13,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 13.',
                'grado_impacto'    => 13,
                'probabilidad'     => 13,
                'cuadrante'        => 'V13',
                'ocurrencia_final' => 13,
                'impacto_final'    => 13,
                'updated_at'       => '2026-04-23 12:00:00',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_val_efecto'    => 14,
                'id_reg_riesgo'    => 14,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 14.',
                'grado_impacto'    => 14,
                'probabilidad'     => 14,
                'cuadrante'        => 'V14',
                'ocurrencia_final' => 14,
                'impacto_final'    => 14,
                'updated_at'       => '2026-05-02 13:00:00',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_val_efecto'    => 15,
                'id_reg_riesgo'    => 15,
                'efecto'           => 'Efecto de valoracion efectos: registro de prueba número 15.',
                'grado_impacto'    => 15,
                'probabilidad'     => 15,
                'cuadrante'        => 'V15',
                'ocurrencia_final' => 15,
                'impacto_final'    => 15,
                'updated_at'       => '2026-05-11 14:00:00',
                'created_at'       => '2026-05-11 14:00:00',
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
