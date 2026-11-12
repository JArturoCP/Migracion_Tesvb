<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_informe`.
 */
class AudInformeSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_informe` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAuditoriaSeeder::class,
        ]);

        $tabla = 'aud_informe';

        $llaves = [
            ['id_informe'],
        ];

        $registros = [
            [
                'id_informe'   => 1,
                'id_auditoria' => 1,
                'resumen'      => 'Resumen de informe: registro de prueba número 1.',
                'cierre'       => 'Cierre de informe: registro de prueba número 1.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 1.',
                'created_at'   => '2026-01-05 09:00:00',
                'updated_at'   => '2026-01-05 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 2,
                'id_auditoria' => 2,
                'resumen'      => 'Resumen de informe: registro de prueba número 2.',
                'cierre'       => 'Cierre de informe: registro de prueba número 2.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 2.',
                'created_at'   => '2026-01-14 10:00:00',
                'updated_at'   => '2026-01-14 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 3,
                'id_auditoria' => 3,
                'resumen'      => 'Resumen de informe: registro de prueba número 3.',
                'cierre'       => 'Cierre de informe: registro de prueba número 3.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 3.',
                'created_at'   => '2026-01-23 11:00:00',
                'updated_at'   => '2026-01-23 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 4,
                'id_auditoria' => 4,
                'resumen'      => 'Resumen de informe: registro de prueba número 4.',
                'cierre'       => 'Cierre de informe: registro de prueba número 4.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 4.',
                'created_at'   => '2026-02-01 12:00:00',
                'updated_at'   => '2026-02-01 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 5,
                'id_auditoria' => 5,
                'resumen'      => 'Resumen de informe: registro de prueba número 5.',
                'cierre'       => 'Cierre de informe: registro de prueba número 5.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 5.',
                'created_at'   => '2026-02-10 13:00:00',
                'updated_at'   => '2026-02-10 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 6,
                'id_auditoria' => 6,
                'resumen'      => 'Resumen de informe: registro de prueba número 6.',
                'cierre'       => 'Cierre de informe: registro de prueba número 6.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 6.',
                'created_at'   => '2026-02-19 14:00:00',
                'updated_at'   => '2026-02-19 14:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 7,
                'id_auditoria' => 7,
                'resumen'      => 'Resumen de informe: registro de prueba número 7.',
                'cierre'       => 'Cierre de informe: registro de prueba número 7.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 7.',
                'created_at'   => '2026-02-28 15:00:00',
                'updated_at'   => '2026-02-28 15:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 8,
                'id_auditoria' => 8,
                'resumen'      => 'Resumen de informe: registro de prueba número 8.',
                'cierre'       => 'Cierre de informe: registro de prueba número 8.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 8.',
                'created_at'   => '2026-03-09 16:00:00',
                'updated_at'   => '2026-03-09 16:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 9,
                'id_auditoria' => 9,
                'resumen'      => 'Resumen de informe: registro de prueba número 9.',
                'cierre'       => 'Cierre de informe: registro de prueba número 9.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 9.',
                'created_at'   => '2026-03-18 08:00:00',
                'updated_at'   => '2026-03-18 08:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 10,
                'id_auditoria' => 10,
                'resumen'      => 'Resumen de informe: registro de prueba número 10.',
                'cierre'       => 'Cierre de informe: registro de prueba número 10.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 10.',
                'created_at'   => '2026-03-27 09:00:00',
                'updated_at'   => '2026-03-27 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 11,
                'id_auditoria' => 11,
                'resumen'      => 'Resumen de informe: registro de prueba número 11.',
                'cierre'       => 'Cierre de informe: registro de prueba número 11.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 11.',
                'created_at'   => '2026-04-05 10:00:00',
                'updated_at'   => '2026-04-05 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 12,
                'id_auditoria' => 12,
                'resumen'      => 'Resumen de informe: registro de prueba número 12.',
                'cierre'       => 'Cierre de informe: registro de prueba número 12.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 12.',
                'created_at'   => '2026-04-14 11:00:00',
                'updated_at'   => '2026-04-14 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 13,
                'id_auditoria' => 13,
                'resumen'      => 'Resumen de informe: registro de prueba número 13.',
                'cierre'       => 'Cierre de informe: registro de prueba número 13.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 13.',
                'created_at'   => '2026-04-23 12:00:00',
                'updated_at'   => '2026-04-23 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 14,
                'id_auditoria' => 14,
                'resumen'      => 'Resumen de informe: registro de prueba número 14.',
                'cierre'       => 'Cierre de informe: registro de prueba número 14.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 14.',
                'created_at'   => '2026-05-02 13:00:00',
                'updated_at'   => '2026-05-02 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_informe'   => 15,
                'id_auditoria' => 15,
                'resumen'      => 'Resumen de informe: registro de prueba número 15.',
                'cierre'       => 'Cierre de informe: registro de prueba número 15.',
                'conclusiones' => 'Conclusiones de informe: registro de prueba número 15.',
                'created_at'   => '2026-05-11 14:00:00',
                'updated_at'   => '2026-05-11 14:00:00',
                'deleted_at'   => null,
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
