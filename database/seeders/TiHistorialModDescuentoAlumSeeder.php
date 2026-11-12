<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_historial_mod_descuento_alum`.
 */
class TiHistorialModDescuentoAlumSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_historial_mod_descuento_alum` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
            TiDescuentosAlumSeeder::class,
            TiNacionalidadSeeder::class,
            TiPreparatatoriaSeeder::class,
            TiTiposDescSeeder::class,
        ]);

        $tabla = 'ti_historial_mod_descuento_alum';

        $llaves = [
            ['id_historial_desc'],
        ];

        $registros = [
            [
                'id_historial_desc'  => 1,
                'id_personal'        => 1,
                'id_descuento_alumn' => 1,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 1.',
                'fecha_mod'          => '2026-01-05',
                'fecha_anterior'     => '2026-01-05',
                'fecha_actual'       => '2026-01-05',
                'id_tipo_desc'       => 1,
                'telefono'           => '7262600001',
                'id_nacionalidad'    => 1,
                'id_preparatoria'    => 1,
            ],
            [
                'id_historial_desc'  => 2,
                'id_personal'        => 2,
                'id_descuento_alumn' => 2,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 2.',
                'fecha_mod'          => '2026-01-14',
                'fecha_anterior'     => '2026-01-14',
                'fecha_actual'       => '2026-01-14',
                'id_tipo_desc'       => 2,
                'telefono'           => '7262600002',
                'id_nacionalidad'    => 2,
                'id_preparatoria'    => 2,
            ],
            [
                'id_historial_desc'  => 3,
                'id_personal'        => 3,
                'id_descuento_alumn' => 3,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 3.',
                'fecha_mod'          => '2026-01-23',
                'fecha_anterior'     => '2026-01-23',
                'fecha_actual'       => '2026-01-23',
                'id_tipo_desc'       => 3,
                'telefono'           => '7262600003',
                'id_nacionalidad'    => 3,
                'id_preparatoria'    => 3,
            ],
            [
                'id_historial_desc'  => 4,
                'id_personal'        => 4,
                'id_descuento_alumn' => 4,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 4.',
                'fecha_mod'          => '2026-02-01',
                'fecha_anterior'     => '2026-02-01',
                'fecha_actual'       => '2026-02-01',
                'id_tipo_desc'       => 4,
                'telefono'           => '7262600004',
                'id_nacionalidad'    => 4,
                'id_preparatoria'    => 4,
            ],
            [
                'id_historial_desc'  => 5,
                'id_personal'        => 5,
                'id_descuento_alumn' => 5,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 5.',
                'fecha_mod'          => '2026-02-10',
                'fecha_anterior'     => '2026-02-10',
                'fecha_actual'       => '2026-02-10',
                'id_tipo_desc'       => 5,
                'telefono'           => '7262600005',
                'id_nacionalidad'    => 5,
                'id_preparatoria'    => 5,
            ],
            [
                'id_historial_desc'  => 6,
                'id_personal'        => 6,
                'id_descuento_alumn' => 6,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 6.',
                'fecha_mod'          => '2026-02-19',
                'fecha_anterior'     => '2026-02-19',
                'fecha_actual'       => '2026-02-19',
                'id_tipo_desc'       => 6,
                'telefono'           => '7262600006',
                'id_nacionalidad'    => 6,
                'id_preparatoria'    => 6,
            ],
            [
                'id_historial_desc'  => 7,
                'id_personal'        => 7,
                'id_descuento_alumn' => 7,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 7.',
                'fecha_mod'          => '2026-02-28',
                'fecha_anterior'     => '2026-02-28',
                'fecha_actual'       => '2026-02-28',
                'id_tipo_desc'       => 7,
                'telefono'           => '7262600007',
                'id_nacionalidad'    => 7,
                'id_preparatoria'    => 7,
            ],
            [
                'id_historial_desc'  => 8,
                'id_personal'        => 8,
                'id_descuento_alumn' => 8,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 8.',
                'fecha_mod'          => '2026-03-09',
                'fecha_anterior'     => '2026-03-09',
                'fecha_actual'       => '2026-03-09',
                'id_tipo_desc'       => 8,
                'telefono'           => '7262600008',
                'id_nacionalidad'    => 8,
                'id_preparatoria'    => 8,
            ],
            [
                'id_historial_desc'  => 9,
                'id_personal'        => 9,
                'id_descuento_alumn' => 9,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 9.',
                'fecha_mod'          => '2026-03-18',
                'fecha_anterior'     => '2026-03-18',
                'fecha_actual'       => '2026-03-18',
                'id_tipo_desc'       => 9,
                'telefono'           => '7262600009',
                'id_nacionalidad'    => 9,
                'id_preparatoria'    => 9,
            ],
            [
                'id_historial_desc'  => 10,
                'id_personal'        => 10,
                'id_descuento_alumn' => 10,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 10.',
                'fecha_mod'          => '2026-03-27',
                'fecha_anterior'     => '2026-03-27',
                'fecha_actual'       => '2026-03-27',
                'id_tipo_desc'       => 10,
                'telefono'           => '7262600010',
                'id_nacionalidad'    => 10,
                'id_preparatoria'    => 10,
            ],
            [
                'id_historial_desc'  => 11,
                'id_personal'        => 11,
                'id_descuento_alumn' => 11,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 11.',
                'fecha_mod'          => '2026-04-05',
                'fecha_anterior'     => '2026-04-05',
                'fecha_actual'       => '2026-04-05',
                'id_tipo_desc'       => 11,
                'telefono'           => '7262600011',
                'id_nacionalidad'    => 11,
                'id_preparatoria'    => 11,
            ],
            [
                'id_historial_desc'  => 12,
                'id_personal'        => 12,
                'id_descuento_alumn' => 12,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 12.',
                'fecha_mod'          => '2026-04-14',
                'fecha_anterior'     => '2026-04-14',
                'fecha_actual'       => '2026-04-14',
                'id_tipo_desc'       => 12,
                'telefono'           => '7262600012',
                'id_nacionalidad'    => 12,
                'id_preparatoria'    => 12,
            ],
            [
                'id_historial_desc'  => 13,
                'id_personal'        => 13,
                'id_descuento_alumn' => 13,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 13.',
                'fecha_mod'          => '2026-04-23',
                'fecha_anterior'     => '2026-04-23',
                'fecha_actual'       => '2026-04-23',
                'id_tipo_desc'       => 13,
                'telefono'           => '7262600013',
                'id_nacionalidad'    => 13,
                'id_preparatoria'    => 13,
            ],
            [
                'id_historial_desc'  => 14,
                'id_personal'        => 14,
                'id_descuento_alumn' => 14,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 14.',
                'fecha_mod'          => '2026-05-02',
                'fecha_anterior'     => '2026-05-02',
                'fecha_actual'       => '2026-05-02',
                'id_tipo_desc'       => 14,
                'telefono'           => '7262600014',
                'id_nacionalidad'    => 14,
                'id_preparatoria'    => 14,
            ],
            [
                'id_historial_desc'  => 15,
                'id_personal'        => 15,
                'id_descuento_alumn' => 15,
                'accion'             => 'Accion de historial mod descuento alum: registro de prueba número 15.',
                'fecha_mod'          => '2026-05-11',
                'fecha_anterior'     => '2026-05-11',
                'fecha_actual'       => '2026-05-11',
                'id_tipo_desc'       => 15,
                'telefono'           => '7262600015',
                'id_nacionalidad'    => 15,
                'id_preparatoria'    => 15,
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
