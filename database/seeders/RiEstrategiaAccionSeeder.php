<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_estrategia_accion`.
 */
class RiEstrategiaAccionSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_estrategia_accion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiFactoresSeeder::class,
        ]);

        $tabla = 'ri_estrategia_accion';

        $llaves = [
            ['id_estrategia_a'],
        ];

        $registros = [
            [
                'id_estrategia_a' => 1,
                'id_factor'       => 1,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 1.',
                'fecha'           => '2026-01-05',
                'fecha_final'     => '2026-01-05',
                'id_unidad_admin' => 1,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 1',
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_1.pdf',
                'status'          => 1,
            ],
            [
                'id_estrategia_a' => 2,
                'id_factor'       => 2,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 2.',
                'fecha'           => '2026-01-14',
                'fecha_final'     => '2026-01-14',
                'id_unidad_admin' => 2,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 2',
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_2.pdf',
                'status'          => 2,
            ],
            [
                'id_estrategia_a' => 3,
                'id_factor'       => 3,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 3.',
                'fecha'           => '2026-01-23',
                'fecha_final'     => '2026-01-23',
                'id_unidad_admin' => 3,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 3',
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_3.pdf',
                'status'          => 3,
            ],
            [
                'id_estrategia_a' => 4,
                'id_factor'       => 4,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 4.',
                'fecha'           => '2026-02-01',
                'fecha_final'     => '2026-02-01',
                'id_unidad_admin' => 4,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 4',
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_4.pdf',
                'status'          => 4,
            ],
            [
                'id_estrategia_a' => 5,
                'id_factor'       => 5,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 5.',
                'fecha'           => '2026-02-10',
                'fecha_final'     => '2026-02-10',
                'id_unidad_admin' => 5,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 5',
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_5.pdf',
                'status'          => 5,
            ],
            [
                'id_estrategia_a' => 6,
                'id_factor'       => 6,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 6.',
                'fecha'           => '2026-02-19',
                'fecha_final'     => '2026-02-19',
                'id_unidad_admin' => 6,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 6',
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_6.pdf',
                'status'          => 6,
            ],
            [
                'id_estrategia_a' => 7,
                'id_factor'       => 7,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 7.',
                'fecha'           => '2026-02-28',
                'fecha_final'     => '2026-02-28',
                'id_unidad_admin' => 7,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 7',
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_7.pdf',
                'status'          => 7,
            ],
            [
                'id_estrategia_a' => 8,
                'id_factor'       => 8,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 8.',
                'fecha'           => '2026-03-09',
                'fecha_final'     => '2026-03-09',
                'id_unidad_admin' => 8,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 8',
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_8.pdf',
                'status'          => 8,
            ],
            [
                'id_estrategia_a' => 9,
                'id_factor'       => 9,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 9.',
                'fecha'           => '2026-03-18',
                'fecha_final'     => '2026-03-18',
                'id_unidad_admin' => 9,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 9',
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_9.pdf',
                'status'          => 9,
            ],
            [
                'id_estrategia_a' => 10,
                'id_factor'       => 10,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 10.',
                'fecha'           => '2026-03-27',
                'fecha_final'     => '2026-03-27',
                'id_unidad_admin' => 10,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 10',
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_10.pdf',
                'status'          => 10,
            ],
            [
                'id_estrategia_a' => 11,
                'id_factor'       => 11,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 11.',
                'fecha'           => '2026-04-05',
                'fecha_final'     => '2026-04-05',
                'id_unidad_admin' => 11,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 11',
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_11.pdf',
                'status'          => 11,
            ],
            [
                'id_estrategia_a' => 12,
                'id_factor'       => 12,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 12.',
                'fecha'           => '2026-04-14',
                'fecha_final'     => '2026-04-14',
                'id_unidad_admin' => 12,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 12',
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_12.pdf',
                'status'          => 12,
            ],
            [
                'id_estrategia_a' => 13,
                'id_factor'       => 13,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 13.',
                'fecha'           => '2026-04-23',
                'fecha_final'     => '2026-04-23',
                'id_unidad_admin' => 13,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 13',
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_13.pdf',
                'status'          => 13,
            ],
            [
                'id_estrategia_a' => 14,
                'id_factor'       => 14,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 14.',
                'fecha'           => '2026-05-02',
                'fecha_final'     => '2026-05-02',
                'id_unidad_admin' => 14,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 14',
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_14.pdf',
                'status'          => 14,
            ],
            [
                'id_estrategia_a' => 15,
                'id_factor'       => 15,
                'accion'          => 'Accion de estrategia accion: registro de prueba número 15.',
                'fecha'           => '2026-05-11',
                'fecha_final'     => '2026-05-11',
                'id_unidad_admin' => 15,
                'released'        => 1,
                'comments'        => 'Comments estrategia accion 15',
                'updated_at'      => '2026-05-11 14:00:00',
                'created_at'      => '2026-05-11 14:00:00',
                'file'            => 'documentos/ri_estrategia_accion/ri_estrategia_accion_15.pdf',
                'status'          => 15,
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
