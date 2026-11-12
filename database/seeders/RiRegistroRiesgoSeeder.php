<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_registro_riesgo`.
 */
class RiRegistroRiesgoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_registro_riesgo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiClasifRSeeder::class,
            RiRiesgoSeeder::class,
            RiSeleccionSeeder::class,
        ]);

        $tabla = 'ri_registro_riesgo';

        $llaves = [
            ['id_reg_riesgo'],
        ];

        $registros = [
            [
                'id_reg_riesgo'   => 1,
                'numero'          => '0001',
                'id_unidad_admin' => 1,
                'id_seleccion'    => 1,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 1.',
                'id_riesgo'       => 1,
                'id_nivel_des'    => 1,
                'id_cl_r'         => 1,
                'fecha'           => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_reg_riesgo'   => 2,
                'numero'          => '0002',
                'id_unidad_admin' => 2,
                'id_seleccion'    => 2,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 2.',
                'id_riesgo'       => 2,
                'id_nivel_des'    => 2,
                'id_cl_r'         => 2,
                'fecha'           => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_reg_riesgo'   => 3,
                'numero'          => '0003',
                'id_unidad_admin' => 3,
                'id_seleccion'    => 3,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 3.',
                'id_riesgo'       => 3,
                'id_nivel_des'    => 3,
                'id_cl_r'         => 3,
                'fecha'           => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_reg_riesgo'   => 4,
                'numero'          => '0004',
                'id_unidad_admin' => 4,
                'id_seleccion'    => 4,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 4.',
                'id_riesgo'       => 4,
                'id_nivel_des'    => 4,
                'id_cl_r'         => 4,
                'fecha'           => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_reg_riesgo'   => 5,
                'numero'          => '0005',
                'id_unidad_admin' => 5,
                'id_seleccion'    => 5,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 5.',
                'id_riesgo'       => 5,
                'id_nivel_des'    => 5,
                'id_cl_r'         => 5,
                'fecha'           => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_reg_riesgo'   => 6,
                'numero'          => '0006',
                'id_unidad_admin' => 6,
                'id_seleccion'    => 6,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 6.',
                'id_riesgo'       => 6,
                'id_nivel_des'    => 6,
                'id_cl_r'         => 6,
                'fecha'           => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_reg_riesgo'   => 7,
                'numero'          => '0007',
                'id_unidad_admin' => 7,
                'id_seleccion'    => 7,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 7.',
                'id_riesgo'       => 7,
                'id_nivel_des'    => 7,
                'id_cl_r'         => 7,
                'fecha'           => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_reg_riesgo'   => 8,
                'numero'          => '0008',
                'id_unidad_admin' => 8,
                'id_seleccion'    => 8,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 8.',
                'id_riesgo'       => 8,
                'id_nivel_des'    => 8,
                'id_cl_r'         => 8,
                'fecha'           => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_reg_riesgo'   => 9,
                'numero'          => '0009',
                'id_unidad_admin' => 9,
                'id_seleccion'    => 9,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 9.',
                'id_riesgo'       => 9,
                'id_nivel_des'    => 9,
                'id_cl_r'         => 9,
                'fecha'           => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_reg_riesgo'   => 10,
                'numero'          => '0010',
                'id_unidad_admin' => 10,
                'id_seleccion'    => 10,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 10.',
                'id_riesgo'       => 10,
                'id_nivel_des'    => 10,
                'id_cl_r'         => 10,
                'fecha'           => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_reg_riesgo'   => 11,
                'numero'          => '0011',
                'id_unidad_admin' => 11,
                'id_seleccion'    => 11,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 11.',
                'id_riesgo'       => 11,
                'id_nivel_des'    => 11,
                'id_cl_r'         => 11,
                'fecha'           => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_reg_riesgo'   => 12,
                'numero'          => '0012',
                'id_unidad_admin' => 12,
                'id_seleccion'    => 12,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 12.',
                'id_riesgo'       => 12,
                'id_nivel_des'    => 12,
                'id_cl_r'         => 12,
                'fecha'           => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_reg_riesgo'   => 13,
                'numero'          => '0013',
                'id_unidad_admin' => 13,
                'id_seleccion'    => 13,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 13.',
                'id_riesgo'       => 13,
                'id_nivel_des'    => 13,
                'id_cl_r'         => 13,
                'fecha'           => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_reg_riesgo'   => 14,
                'numero'          => '0014',
                'id_unidad_admin' => 14,
                'id_seleccion'    => 14,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 14.',
                'id_riesgo'       => 14,
                'id_nivel_des'    => 14,
                'id_cl_r'         => 14,
                'fecha'           => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_reg_riesgo'   => 15,
                'numero'          => '0015',
                'id_unidad_admin' => 15,
                'id_seleccion'    => 15,
                'descip_riesgo'   => 'Descip riesgo de registro riesgo: registro de prueba número 15.',
                'id_riesgo'       => 15,
                'id_nivel_des'    => 15,
                'id_cl_r'         => 15,
                'fecha'           => '2026-05-11 14:00:00',
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
