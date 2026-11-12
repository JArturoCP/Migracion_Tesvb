<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_planseguimiento`.
 */
class RiOPlanseguimientoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_planseguimiento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiRegOportunidadSeeder::class,
        ]);

        $tabla = 'ri_o_planseguimiento';

        $llaves = [
            ['id_planseguimiento'],
        ];

        $registros = [
            [
                'id_planseguimiento'  => 1,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 1.',
                'id_oportunidad'      => 1,
                'fecha_inicial'       => '2026-01-05',
                'fecha'               => '2026-01-05',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 1',
                'created_at'          => '2026-01-05',
                'updated_at'          => '2026-01-05',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_1.pdf',
                'status'              => 1,
            ],
            [
                'id_planseguimiento'  => 2,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 2.',
                'id_oportunidad'      => 2,
                'fecha_inicial'       => '2026-01-14',
                'fecha'               => '2026-01-14',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 2',
                'created_at'          => '2026-01-14',
                'updated_at'          => '2026-01-14',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_2.pdf',
                'status'              => 2,
            ],
            [
                'id_planseguimiento'  => 3,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 3.',
                'id_oportunidad'      => 3,
                'fecha_inicial'       => '2026-01-23',
                'fecha'               => '2026-01-23',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 3',
                'created_at'          => '2026-01-23',
                'updated_at'          => '2026-01-23',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_3.pdf',
                'status'              => 3,
            ],
            [
                'id_planseguimiento'  => 4,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 4.',
                'id_oportunidad'      => 4,
                'fecha_inicial'       => '2026-02-01',
                'fecha'               => '2026-02-01',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 4',
                'created_at'          => '2026-02-01',
                'updated_at'          => '2026-02-01',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_4.pdf',
                'status'              => 4,
            ],
            [
                'id_planseguimiento'  => 5,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 5.',
                'id_oportunidad'      => 5,
                'fecha_inicial'       => '2026-02-10',
                'fecha'               => '2026-02-10',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 5',
                'created_at'          => '2026-02-10',
                'updated_at'          => '2026-02-10',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_5.pdf',
                'status'              => 5,
            ],
            [
                'id_planseguimiento'  => 6,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 6.',
                'id_oportunidad'      => 6,
                'fecha_inicial'       => '2026-02-19',
                'fecha'               => '2026-02-19',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 6',
                'created_at'          => '2026-02-19',
                'updated_at'          => '2026-02-19',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_6.pdf',
                'status'              => 6,
            ],
            [
                'id_planseguimiento'  => 7,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 7.',
                'id_oportunidad'      => 7,
                'fecha_inicial'       => '2026-02-28',
                'fecha'               => '2026-02-28',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 7',
                'created_at'          => '2026-02-28',
                'updated_at'          => '2026-02-28',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_7.pdf',
                'status'              => 7,
            ],
            [
                'id_planseguimiento'  => 8,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 8.',
                'id_oportunidad'      => 8,
                'fecha_inicial'       => '2026-03-09',
                'fecha'               => '2026-03-09',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 8',
                'created_at'          => '2026-03-09',
                'updated_at'          => '2026-03-09',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_8.pdf',
                'status'              => 8,
            ],
            [
                'id_planseguimiento'  => 9,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 9.',
                'id_oportunidad'      => 9,
                'fecha_inicial'       => '2026-03-18',
                'fecha'               => '2026-03-18',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 9',
                'created_at'          => '2026-03-18',
                'updated_at'          => '2026-03-18',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_9.pdf',
                'status'              => 9,
            ],
            [
                'id_planseguimiento'  => 10,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 10.',
                'id_oportunidad'      => 10,
                'fecha_inicial'       => '2026-03-27',
                'fecha'               => '2026-03-27',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 10',
                'created_at'          => '2026-03-27',
                'updated_at'          => '2026-03-27',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_10.pdf',
                'status'              => 10,
            ],
            [
                'id_planseguimiento'  => 11,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 11.',
                'id_oportunidad'      => 11,
                'fecha_inicial'       => '2026-04-05',
                'fecha'               => '2026-04-05',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 11',
                'created_at'          => '2026-04-05',
                'updated_at'          => '2026-04-05',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_11.pdf',
                'status'              => 11,
            ],
            [
                'id_planseguimiento'  => 12,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 12.',
                'id_oportunidad'      => 12,
                'fecha_inicial'       => '2026-04-14',
                'fecha'               => '2026-04-14',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 12',
                'created_at'          => '2026-04-14',
                'updated_at'          => '2026-04-14',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_12.pdf',
                'status'              => 12,
            ],
            [
                'id_planseguimiento'  => 13,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 13.',
                'id_oportunidad'      => 13,
                'fecha_inicial'       => '2026-04-23',
                'fecha'               => '2026-04-23',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 13',
                'created_at'          => '2026-04-23',
                'updated_at'          => '2026-04-23',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_13.pdf',
                'status'              => 13,
            ],
            [
                'id_planseguimiento'  => 14,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 14.',
                'id_oportunidad'      => 14,
                'fecha_inicial'       => '2026-05-02',
                'fecha'               => '2026-05-02',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 14',
                'created_at'          => '2026-05-02',
                'updated_at'          => '2026-05-02',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_14.pdf',
                'status'              => 14,
            ],
            [
                'id_planseguimiento'  => 15,
                'des_planseguimiento' => 'Des planseguimiento de o planseguimiento: registro de prueba número 15.',
                'id_oportunidad'      => 15,
                'fecha_inicial'       => '2026-05-11',
                'fecha'               => '2026-05-11',
                'released'            => 1,
                'comments'            => 'Comments o planseguimiento 15',
                'created_at'          => '2026-05-11',
                'updated_at'          => '2026-05-11',
                'file'                => 'documentos/ri_o_planseguimiento/ri_o_planseguimiento_15.pdf',
                'status'              => 15,
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
