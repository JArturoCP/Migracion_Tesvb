<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_factores`.
 */
class RiFactoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_factores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiClasifFactorSeeder::class,
            RiRegistroRiesgoSeeder::class,
            RiTipoFSeeder::class,
        ]);

        $tabla = 'ri_factores';

        $llaves = [
            ['id_factor'],
        ];

        $registros = [
            [
                'id_factor'       => 1,
                'no_factor'       => 1,
                'id_reg_riesgo'   => 1,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 1.',
                'id_cl_f'         => 1,
                'id_tipo_f'       => 1,
                'tiene_controles' => '1',
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_factor'       => 2,
                'no_factor'       => 2,
                'id_reg_riesgo'   => 2,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 2.',
                'id_cl_f'         => 2,
                'id_tipo_f'       => 2,
                'tiene_controles' => '2',
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_factor'       => 3,
                'no_factor'       => 3,
                'id_reg_riesgo'   => 3,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 3.',
                'id_cl_f'         => 3,
                'id_tipo_f'       => 3,
                'tiene_controles' => '3',
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_factor'       => 4,
                'no_factor'       => 4,
                'id_reg_riesgo'   => 4,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 4.',
                'id_cl_f'         => 4,
                'id_tipo_f'       => 4,
                'tiene_controles' => '4',
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_factor'       => 5,
                'no_factor'       => 5,
                'id_reg_riesgo'   => 5,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 5.',
                'id_cl_f'         => 5,
                'id_tipo_f'       => 5,
                'tiene_controles' => '5',
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_factor'       => 6,
                'no_factor'       => 6,
                'id_reg_riesgo'   => 6,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 6.',
                'id_cl_f'         => 6,
                'id_tipo_f'       => 6,
                'tiene_controles' => '6',
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_factor'       => 7,
                'no_factor'       => 7,
                'id_reg_riesgo'   => 7,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 7.',
                'id_cl_f'         => 7,
                'id_tipo_f'       => 7,
                'tiene_controles' => '7',
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_factor'       => 8,
                'no_factor'       => 8,
                'id_reg_riesgo'   => 8,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 8.',
                'id_cl_f'         => 8,
                'id_tipo_f'       => 8,
                'tiene_controles' => '8',
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_factor'       => 9,
                'no_factor'       => 9,
                'id_reg_riesgo'   => 9,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 9.',
                'id_cl_f'         => 9,
                'id_tipo_f'       => 9,
                'tiene_controles' => '9',
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_factor'       => 10,
                'no_factor'       => 10,
                'id_reg_riesgo'   => 10,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 10.',
                'id_cl_f'         => 10,
                'id_tipo_f'       => 10,
                'tiene_controles' => '10',
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_factor'       => 11,
                'no_factor'       => 11,
                'id_reg_riesgo'   => 11,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 11.',
                'id_cl_f'         => 11,
                'id_tipo_f'       => 11,
                'tiene_controles' => '11',
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_factor'       => 12,
                'no_factor'       => 12,
                'id_reg_riesgo'   => 12,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 12.',
                'id_cl_f'         => 12,
                'id_tipo_f'       => 12,
                'tiene_controles' => '12',
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_factor'       => 13,
                'no_factor'       => 13,
                'id_reg_riesgo'   => 13,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 13.',
                'id_cl_f'         => 13,
                'id_tipo_f'       => 13,
                'tiene_controles' => '13',
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_factor'       => 14,
                'no_factor'       => 14,
                'id_reg_riesgo'   => 14,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 14.',
                'id_cl_f'         => 14,
                'id_tipo_f'       => 14,
                'tiene_controles' => '14',
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_factor'       => 15,
                'no_factor'       => 15,
                'id_reg_riesgo'   => 15,
                'descripcion_f'   => 'Descripcion f de factores: registro de prueba número 15.',
                'id_cl_f'         => 15,
                'id_tipo_f'       => 15,
                'tiene_controles' => '15',
                'updated_at'      => '2026-05-11 14:00:00',
                'created_at'      => '2026-05-11 14:00:00',
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
