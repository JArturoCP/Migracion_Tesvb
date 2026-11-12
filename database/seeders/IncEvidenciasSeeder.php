<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_evidencias`.
 */
class IncEvidenciasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_evidencias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
            IncSolicitudesSeeder::class,
            IncTipoEvidenciaSeeder::class,
        ]);

        $tabla = 'inc_evidencias';

        $llaves = [
            ['id_evid'],
        ];

        $registros = [
            [
                'id_evid'          => 1,
                'id_tipo_evid'     => 1,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 1.',
                'fecha_envio'      => '2026-01-05 09:00:00',
                'id_solicitud'     => 1,
                'id_personal'      => 1,
                'id_jefe'          => 1,
                'fecha_solicita'   => '2026-01-05',
                'fecha_solicita_2' => '2026-01-05',
                'no_folio'         => 'TESVB-2026-0001',
                'no_fecha'         => 1,
                'id_autorizado'    => 1,
            ],
            [
                'id_evid'          => 2,
                'id_tipo_evid'     => 2,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 2.',
                'fecha_envio'      => '2026-01-14 10:00:00',
                'id_solicitud'     => 2,
                'id_personal'      => 2,
                'id_jefe'          => 2,
                'fecha_solicita'   => '2026-01-14',
                'fecha_solicita_2' => '2026-01-14',
                'no_folio'         => 'TESVB-2026-0002',
                'no_fecha'         => 2,
                'id_autorizado'    => 2,
            ],
            [
                'id_evid'          => 3,
                'id_tipo_evid'     => 3,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 3.',
                'fecha_envio'      => '2026-01-23 11:00:00',
                'id_solicitud'     => 3,
                'id_personal'      => 3,
                'id_jefe'          => 3,
                'fecha_solicita'   => '2026-01-23',
                'fecha_solicita_2' => '2026-01-23',
                'no_folio'         => 'TESVB-2026-0003',
                'no_fecha'         => 3,
                'id_autorizado'    => 3,
            ],
            [
                'id_evid'          => 4,
                'id_tipo_evid'     => 4,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 4.',
                'fecha_envio'      => '2026-02-01 12:00:00',
                'id_solicitud'     => 4,
                'id_personal'      => 4,
                'id_jefe'          => 4,
                'fecha_solicita'   => '2026-02-01',
                'fecha_solicita_2' => '2026-02-01',
                'no_folio'         => 'TESVB-2026-0004',
                'no_fecha'         => 4,
                'id_autorizado'    => 4,
            ],
            [
                'id_evid'          => 5,
                'id_tipo_evid'     => 5,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 5.',
                'fecha_envio'      => '2026-02-10 13:00:00',
                'id_solicitud'     => 5,
                'id_personal'      => 5,
                'id_jefe'          => 5,
                'fecha_solicita'   => '2026-02-10',
                'fecha_solicita_2' => '2026-02-10',
                'no_folio'         => 'TESVB-2026-0005',
                'no_fecha'         => 5,
                'id_autorizado'    => 5,
            ],
            [
                'id_evid'          => 6,
                'id_tipo_evid'     => 6,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 6.',
                'fecha_envio'      => '2026-02-19 14:00:00',
                'id_solicitud'     => 6,
                'id_personal'      => 6,
                'id_jefe'          => 6,
                'fecha_solicita'   => '2026-02-19',
                'fecha_solicita_2' => '2026-02-19',
                'no_folio'         => 'TESVB-2026-0006',
                'no_fecha'         => 6,
                'id_autorizado'    => 6,
            ],
            [
                'id_evid'          => 7,
                'id_tipo_evid'     => 7,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 7.',
                'fecha_envio'      => '2026-02-28 15:00:00',
                'id_solicitud'     => 7,
                'id_personal'      => 7,
                'id_jefe'          => 7,
                'fecha_solicita'   => '2026-02-28',
                'fecha_solicita_2' => '2026-02-28',
                'no_folio'         => 'TESVB-2026-0007',
                'no_fecha'         => 7,
                'id_autorizado'    => 7,
            ],
            [
                'id_evid'          => 8,
                'id_tipo_evid'     => 8,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 8.',
                'fecha_envio'      => '2026-03-09 16:00:00',
                'id_solicitud'     => 8,
                'id_personal'      => 8,
                'id_jefe'          => 8,
                'fecha_solicita'   => '2026-03-09',
                'fecha_solicita_2' => '2026-03-09',
                'no_folio'         => 'TESVB-2026-0008',
                'no_fecha'         => 8,
                'id_autorizado'    => 8,
            ],
            [
                'id_evid'          => 9,
                'id_tipo_evid'     => 9,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 9.',
                'fecha_envio'      => '2026-03-18 08:00:00',
                'id_solicitud'     => 9,
                'id_personal'      => 9,
                'id_jefe'          => 9,
                'fecha_solicita'   => '2026-03-18',
                'fecha_solicita_2' => '2026-03-18',
                'no_folio'         => 'TESVB-2026-0009',
                'no_fecha'         => 9,
                'id_autorizado'    => 9,
            ],
            [
                'id_evid'          => 10,
                'id_tipo_evid'     => 10,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 10.',
                'fecha_envio'      => '2026-03-27 09:00:00',
                'id_solicitud'     => 10,
                'id_personal'      => 10,
                'id_jefe'          => 10,
                'fecha_solicita'   => '2026-03-27',
                'fecha_solicita_2' => '2026-03-27',
                'no_folio'         => 'TESVB-2026-0010',
                'no_fecha'         => 10,
                'id_autorizado'    => 10,
            ],
            [
                'id_evid'          => 11,
                'id_tipo_evid'     => 11,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 11.',
                'fecha_envio'      => '2026-04-05 10:00:00',
                'id_solicitud'     => 11,
                'id_personal'      => 11,
                'id_jefe'          => 11,
                'fecha_solicita'   => '2026-04-05',
                'fecha_solicita_2' => '2026-04-05',
                'no_folio'         => 'TESVB-2026-0011',
                'no_fecha'         => 11,
                'id_autorizado'    => 11,
            ],
            [
                'id_evid'          => 12,
                'id_tipo_evid'     => 12,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 12.',
                'fecha_envio'      => '2026-04-14 11:00:00',
                'id_solicitud'     => 12,
                'id_personal'      => 12,
                'id_jefe'          => 12,
                'fecha_solicita'   => '2026-04-14',
                'fecha_solicita_2' => '2026-04-14',
                'no_folio'         => 'TESVB-2026-0012',
                'no_fecha'         => 12,
                'id_autorizado'    => 12,
            ],
            [
                'id_evid'          => 13,
                'id_tipo_evid'     => 13,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 13.',
                'fecha_envio'      => '2026-04-23 12:00:00',
                'id_solicitud'     => 13,
                'id_personal'      => 13,
                'id_jefe'          => 13,
                'fecha_solicita'   => '2026-04-23',
                'fecha_solicita_2' => '2026-04-23',
                'no_folio'         => 'TESVB-2026-0013',
                'no_fecha'         => 13,
                'id_autorizado'    => 13,
            ],
            [
                'id_evid'          => 14,
                'id_tipo_evid'     => 14,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 14.',
                'fecha_envio'      => '2026-05-02 13:00:00',
                'id_solicitud'     => 14,
                'id_personal'      => 14,
                'id_jefe'          => 14,
                'fecha_solicita'   => '2026-05-02',
                'fecha_solicita_2' => '2026-05-02',
                'no_folio'         => 'TESVB-2026-0014',
                'no_fecha'         => 14,
                'id_autorizado'    => 14,
            ],
            [
                'id_evid'          => 15,
                'id_tipo_evid'     => 15,
                'arch_evidencia'   => 'Arch evidencia de evidencias: registro de prueba número 15.',
                'fecha_envio'      => '2026-05-11 14:00:00',
                'id_solicitud'     => 15,
                'id_personal'      => 15,
                'id_jefe'          => 15,
                'fecha_solicita'   => '2026-05-11',
                'fecha_solicita_2' => '2026-05-11',
                'no_folio'         => 'TESVB-2026-0015',
                'no_fecha'         => 15,
                'id_autorizado'    => 15,
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
