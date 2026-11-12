<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_evaluacion_control`.
 */
class RiEvaluacionControlSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_evaluacion_control` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiFactoresSeeder::class,
            RiTipoEvaSeeder::class,
        ]);

        $tabla = 'ri_evaluacion_control';

        $llaves = [
            ['id_evaluacion'],
        ];

        $registros = [
            [
                'id_evaluacion'    => 1,
                'No_controles_eva' => '0001',
                'id_factor'        => 1,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 1.',
                'id_tipo_eva'      => 1,
                'documentado'      => 'V1',
                'formalizado'      => 'V1',
                'efectivo'         => 'V1',
                'aplica'           => 'V1',
                'resultado'        => 'Resultado evaluaci 1',
                'updated_at'       => '2026-01-05 09:00:00',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_evaluacion'    => 2,
                'No_controles_eva' => '0002',
                'id_factor'        => 2,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 2.',
                'id_tipo_eva'      => 2,
                'documentado'      => 'V2',
                'formalizado'      => 'V2',
                'efectivo'         => 'V2',
                'aplica'           => 'V2',
                'resultado'        => 'Resultado evaluaci 2',
                'updated_at'       => '2026-01-14 10:00:00',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_evaluacion'    => 3,
                'No_controles_eva' => '0003',
                'id_factor'        => 3,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 3.',
                'id_tipo_eva'      => 3,
                'documentado'      => 'V3',
                'formalizado'      => 'V3',
                'efectivo'         => 'V3',
                'aplica'           => 'V3',
                'resultado'        => 'Resultado evaluaci 3',
                'updated_at'       => '2026-01-23 11:00:00',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_evaluacion'    => 4,
                'No_controles_eva' => '0004',
                'id_factor'        => 4,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 4.',
                'id_tipo_eva'      => 4,
                'documentado'      => 'V4',
                'formalizado'      => 'V4',
                'efectivo'         => 'V4',
                'aplica'           => 'V4',
                'resultado'        => 'Resultado evaluaci 4',
                'updated_at'       => '2026-02-01 12:00:00',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_evaluacion'    => 5,
                'No_controles_eva' => '0005',
                'id_factor'        => 5,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 5.',
                'id_tipo_eva'      => 5,
                'documentado'      => 'V5',
                'formalizado'      => 'V5',
                'efectivo'         => 'V5',
                'aplica'           => 'V5',
                'resultado'        => 'Resultado evaluaci 5',
                'updated_at'       => '2026-02-10 13:00:00',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_evaluacion'    => 6,
                'No_controles_eva' => '0006',
                'id_factor'        => 6,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 6.',
                'id_tipo_eva'      => 6,
                'documentado'      => 'V6',
                'formalizado'      => 'V6',
                'efectivo'         => 'V6',
                'aplica'           => 'V6',
                'resultado'        => 'Resultado evaluaci 6',
                'updated_at'       => '2026-02-19 14:00:00',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_evaluacion'    => 7,
                'No_controles_eva' => '0007',
                'id_factor'        => 7,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 7.',
                'id_tipo_eva'      => 7,
                'documentado'      => 'V7',
                'formalizado'      => 'V7',
                'efectivo'         => 'V7',
                'aplica'           => 'V7',
                'resultado'        => 'Resultado evaluaci 7',
                'updated_at'       => '2026-02-28 15:00:00',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_evaluacion'    => 8,
                'No_controles_eva' => '0008',
                'id_factor'        => 8,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 8.',
                'id_tipo_eva'      => 8,
                'documentado'      => 'V8',
                'formalizado'      => 'V8',
                'efectivo'         => 'V8',
                'aplica'           => 'V8',
                'resultado'        => 'Resultado evaluaci 8',
                'updated_at'       => '2026-03-09 16:00:00',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_evaluacion'    => 9,
                'No_controles_eva' => '0009',
                'id_factor'        => 9,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 9.',
                'id_tipo_eva'      => 9,
                'documentado'      => 'V9',
                'formalizado'      => 'V9',
                'efectivo'         => 'V9',
                'aplica'           => 'V9',
                'resultado'        => 'Resultado evaluaci 9',
                'updated_at'       => '2026-03-18 08:00:00',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_evaluacion'    => 10,
                'No_controles_eva' => '0010',
                'id_factor'        => 10,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 10.',
                'id_tipo_eva'      => 10,
                'documentado'      => 'V10',
                'formalizado'      => 'V10',
                'efectivo'         => 'V10',
                'aplica'           => 'V10',
                'resultado'        => 'Resultado evaluac 10',
                'updated_at'       => '2026-03-27 09:00:00',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_evaluacion'    => 11,
                'No_controles_eva' => '0011',
                'id_factor'        => 11,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 11.',
                'id_tipo_eva'      => 11,
                'documentado'      => 'V11',
                'formalizado'      => 'V11',
                'efectivo'         => 'V11',
                'aplica'           => 'V11',
                'resultado'        => 'Resultado evaluac 11',
                'updated_at'       => '2026-04-05 10:00:00',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_evaluacion'    => 12,
                'No_controles_eva' => '0012',
                'id_factor'        => 12,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 12.',
                'id_tipo_eva'      => 12,
                'documentado'      => 'V12',
                'formalizado'      => 'V12',
                'efectivo'         => 'V12',
                'aplica'           => 'V12',
                'resultado'        => 'Resultado evaluac 12',
                'updated_at'       => '2026-04-14 11:00:00',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_evaluacion'    => 13,
                'No_controles_eva' => '0013',
                'id_factor'        => 13,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 13.',
                'id_tipo_eva'      => 13,
                'documentado'      => 'V13',
                'formalizado'      => 'V13',
                'efectivo'         => 'V13',
                'aplica'           => 'V13',
                'resultado'        => 'Resultado evaluac 13',
                'updated_at'       => '2026-04-23 12:00:00',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_evaluacion'    => 14,
                'No_controles_eva' => '0014',
                'id_factor'        => 14,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 14.',
                'id_tipo_eva'      => 14,
                'documentado'      => 'V14',
                'formalizado'      => 'V14',
                'efectivo'         => 'V14',
                'aplica'           => 'V14',
                'resultado'        => 'Resultado evaluac 14',
                'updated_at'       => '2026-05-02 13:00:00',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_evaluacion'    => 15,
                'No_controles_eva' => '0015',
                'id_factor'        => 15,
                'descripcion'      => 'Descripcion de evaluacion control: registro de prueba número 15.',
                'id_tipo_eva'      => 15,
                'documentado'      => 'V15',
                'formalizado'      => 'V15',
                'efectivo'         => 'V15',
                'aplica'           => 'V15',
                'resultado'        => 'Resultado evaluac 15',
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
