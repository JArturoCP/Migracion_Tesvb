<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_notas`.
 */
class AudNotasSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_notas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudClasificacionSeeder::class,
            AudReportesSeeder::class,
        ]);

        $tabla = 'aud_notas';

        $llaves = [
            ['id_notas'],
        ];

        $registros = [
            [
                'id_notas'         => 1,
                'id_reporte'       => 1,
                'punto_proceso'    => 'Punto proceso notas 1',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 1.',
                'id_clasificacion' => 1,
                'created_at'       => '2026-01-05',
                'updated_at'       => '2026-01-05',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 1.',
                'dias'             => 1,
                'clave_nota'       => 'CLV-001',
            ],
            [
                'id_notas'         => 2,
                'id_reporte'       => 2,
                'punto_proceso'    => 'Punto proceso notas 2',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 2.',
                'id_clasificacion' => 2,
                'created_at'       => '2026-01-14',
                'updated_at'       => '2026-01-14',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 2.',
                'dias'             => 2,
                'clave_nota'       => 'CLV-002',
            ],
            [
                'id_notas'         => 3,
                'id_reporte'       => 3,
                'punto_proceso'    => 'Punto proceso notas 3',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 3.',
                'id_clasificacion' => 3,
                'created_at'       => '2026-01-23',
                'updated_at'       => '2026-01-23',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 3.',
                'dias'             => 3,
                'clave_nota'       => 'CLV-003',
            ],
            [
                'id_notas'         => 4,
                'id_reporte'       => 4,
                'punto_proceso'    => 'Punto proceso notas 4',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 4.',
                'id_clasificacion' => 4,
                'created_at'       => '2026-02-01',
                'updated_at'       => '2026-02-01',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 4.',
                'dias'             => 4,
                'clave_nota'       => 'CLV-004',
            ],
            [
                'id_notas'         => 5,
                'id_reporte'       => 5,
                'punto_proceso'    => 'Punto proceso notas 5',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 5.',
                'id_clasificacion' => 5,
                'created_at'       => '2026-02-10',
                'updated_at'       => '2026-02-10',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 5.',
                'dias'             => 5,
                'clave_nota'       => 'CLV-005',
            ],
            [
                'id_notas'         => 6,
                'id_reporte'       => 6,
                'punto_proceso'    => 'Punto proceso notas 6',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 6.',
                'id_clasificacion' => 6,
                'created_at'       => '2026-02-19',
                'updated_at'       => '2026-02-19',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 6.',
                'dias'             => 6,
                'clave_nota'       => 'CLV-006',
            ],
            [
                'id_notas'         => 7,
                'id_reporte'       => 7,
                'punto_proceso'    => 'Punto proceso notas 7',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 7.',
                'id_clasificacion' => 7,
                'created_at'       => '2026-02-28',
                'updated_at'       => '2026-02-28',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 7.',
                'dias'             => 7,
                'clave_nota'       => 'CLV-007',
            ],
            [
                'id_notas'         => 8,
                'id_reporte'       => 8,
                'punto_proceso'    => 'Punto proceso notas 8',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 8.',
                'id_clasificacion' => 8,
                'created_at'       => '2026-03-09',
                'updated_at'       => '2026-03-09',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 8.',
                'dias'             => 8,
                'clave_nota'       => 'CLV-008',
            ],
            [
                'id_notas'         => 9,
                'id_reporte'       => 9,
                'punto_proceso'    => 'Punto proceso notas 9',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 9.',
                'id_clasificacion' => 9,
                'created_at'       => '2026-03-18',
                'updated_at'       => '2026-03-18',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 9.',
                'dias'             => 9,
                'clave_nota'       => 'CLV-009',
            ],
            [
                'id_notas'         => 10,
                'id_reporte'       => 10,
                'punto_proceso'    => 'Punto proceso notas 10',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 10.',
                'id_clasificacion' => 10,
                'created_at'       => '2026-03-27',
                'updated_at'       => '2026-03-27',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 10.',
                'dias'             => 10,
                'clave_nota'       => 'CLV-010',
            ],
            [
                'id_notas'         => 11,
                'id_reporte'       => 11,
                'punto_proceso'    => 'Punto proceso notas 11',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 11.',
                'id_clasificacion' => 11,
                'created_at'       => '2026-04-05',
                'updated_at'       => '2026-04-05',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 11.',
                'dias'             => 11,
                'clave_nota'       => 'CLV-011',
            ],
            [
                'id_notas'         => 12,
                'id_reporte'       => 12,
                'punto_proceso'    => 'Punto proceso notas 12',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 12.',
                'id_clasificacion' => 12,
                'created_at'       => '2026-04-14',
                'updated_at'       => '2026-04-14',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 12.',
                'dias'             => 12,
                'clave_nota'       => 'CLV-012',
            ],
            [
                'id_notas'         => 13,
                'id_reporte'       => 13,
                'punto_proceso'    => 'Punto proceso notas 13',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 13.',
                'id_clasificacion' => 13,
                'created_at'       => '2026-04-23',
                'updated_at'       => '2026-04-23',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 13.',
                'dias'             => 13,
                'clave_nota'       => 'CLV-013',
            ],
            [
                'id_notas'         => 14,
                'id_reporte'       => 14,
                'punto_proceso'    => 'Punto proceso notas 14',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 14.',
                'id_clasificacion' => 14,
                'created_at'       => '2026-05-02',
                'updated_at'       => '2026-05-02',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 14.',
                'dias'             => 14,
                'clave_nota'       => 'CLV-014',
            ],
            [
                'id_notas'         => 15,
                'id_reporte'       => 15,
                'punto_proceso'    => 'Punto proceso notas 15',
                'observaciones'    => 'Observaciones de notas: registro de prueba número 15.',
                'id_clasificacion' => 15,
                'created_at'       => '2026-05-11',
                'updated_at'       => '2026-05-11',
                'deleted_at'       => null,
                'autorizacion'     => DB::raw("b'01'"),
                'resultado'        => 'Resultado de notas: registro de prueba número 15.',
                'dias'             => 15,
                'clave_nota'       => 'CLV-015',
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
