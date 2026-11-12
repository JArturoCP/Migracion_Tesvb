<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_auditoria`.
 */
class AudAuditoriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_auditoria` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudProgramaSeeder::class,
        ]);

        $tabla = 'aud_auditoria';

        $llaves = [
            ['id_auditoria'],
        ];

        $registros = [
            [
                'id_auditoria' => 1,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 1.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 1.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 1.',
                'fecha_i'      => '2026-01-05',
                'fecha_f'      => '2026-01-05',
                'id_programa'  => 1,
                'created_at'   => '2026-01-05',
                'updated_at'   => '2026-01-05',
                'deleted_at'   => null,
                'asignado'     => 1,
            ],
            [
                'id_auditoria' => 2,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 2.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 2.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 2.',
                'fecha_i'      => '2026-01-14',
                'fecha_f'      => '2026-01-14',
                'id_programa'  => 2,
                'created_at'   => '2026-01-14',
                'updated_at'   => '2026-01-14',
                'deleted_at'   => null,
                'asignado'     => 2,
            ],
            [
                'id_auditoria' => 3,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 3.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 3.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 3.',
                'fecha_i'      => '2026-01-23',
                'fecha_f'      => '2026-01-23',
                'id_programa'  => 3,
                'created_at'   => '2026-01-23',
                'updated_at'   => '2026-01-23',
                'deleted_at'   => null,
                'asignado'     => 3,
            ],
            [
                'id_auditoria' => 4,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 4.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 4.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 4.',
                'fecha_i'      => '2026-02-01',
                'fecha_f'      => '2026-02-01',
                'id_programa'  => 4,
                'created_at'   => '2026-02-01',
                'updated_at'   => '2026-02-01',
                'deleted_at'   => null,
                'asignado'     => 4,
            ],
            [
                'id_auditoria' => 5,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 5.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 5.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 5.',
                'fecha_i'      => '2026-02-10',
                'fecha_f'      => '2026-02-10',
                'id_programa'  => 5,
                'created_at'   => '2026-02-10',
                'updated_at'   => '2026-02-10',
                'deleted_at'   => null,
                'asignado'     => 5,
            ],
            [
                'id_auditoria' => 6,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 6.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 6.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 6.',
                'fecha_i'      => '2026-02-19',
                'fecha_f'      => '2026-02-19',
                'id_programa'  => 6,
                'created_at'   => '2026-02-19',
                'updated_at'   => '2026-02-19',
                'deleted_at'   => null,
                'asignado'     => 6,
            ],
            [
                'id_auditoria' => 7,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 7.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 7.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 7.',
                'fecha_i'      => '2026-02-28',
                'fecha_f'      => '2026-02-28',
                'id_programa'  => 7,
                'created_at'   => '2026-02-28',
                'updated_at'   => '2026-02-28',
                'deleted_at'   => null,
                'asignado'     => 7,
            ],
            [
                'id_auditoria' => 8,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 8.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 8.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 8.',
                'fecha_i'      => '2026-03-09',
                'fecha_f'      => '2026-03-09',
                'id_programa'  => 8,
                'created_at'   => '2026-03-09',
                'updated_at'   => '2026-03-09',
                'deleted_at'   => null,
                'asignado'     => 8,
            ],
            [
                'id_auditoria' => 9,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 9.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 9.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 9.',
                'fecha_i'      => '2026-03-18',
                'fecha_f'      => '2026-03-18',
                'id_programa'  => 9,
                'created_at'   => '2026-03-18',
                'updated_at'   => '2026-03-18',
                'deleted_at'   => null,
                'asignado'     => 9,
            ],
            [
                'id_auditoria' => 10,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 10.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 10.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 10.',
                'fecha_i'      => '2026-03-27',
                'fecha_f'      => '2026-03-27',
                'id_programa'  => 10,
                'created_at'   => '2026-03-27',
                'updated_at'   => '2026-03-27',
                'deleted_at'   => null,
                'asignado'     => 10,
            ],
            [
                'id_auditoria' => 11,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 11.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 11.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 11.',
                'fecha_i'      => '2026-04-05',
                'fecha_f'      => '2026-04-05',
                'id_programa'  => 11,
                'created_at'   => '2026-04-05',
                'updated_at'   => '2026-04-05',
                'deleted_at'   => null,
                'asignado'     => 11,
            ],
            [
                'id_auditoria' => 12,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 12.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 12.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 12.',
                'fecha_i'      => '2026-04-14',
                'fecha_f'      => '2026-04-14',
                'id_programa'  => 12,
                'created_at'   => '2026-04-14',
                'updated_at'   => '2026-04-14',
                'deleted_at'   => null,
                'asignado'     => 12,
            ],
            [
                'id_auditoria' => 13,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 13.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 13.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 13.',
                'fecha_i'      => '2026-04-23',
                'fecha_f'      => '2026-04-23',
                'id_programa'  => 13,
                'created_at'   => '2026-04-23',
                'updated_at'   => '2026-04-23',
                'deleted_at'   => null,
                'asignado'     => 13,
            ],
            [
                'id_auditoria' => 14,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 14.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 14.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 14.',
                'fecha_i'      => '2026-05-02',
                'fecha_f'      => '2026-05-02',
                'id_programa'  => 14,
                'created_at'   => '2026-05-02',
                'updated_at'   => '2026-05-02',
                'deleted_at'   => null,
                'asignado'     => 14,
            ],
            [
                'id_auditoria' => 15,
                'objetivo'     => 'Objetivo de auditoria: registro de prueba número 15.',
                'alcance'      => 'Alcance de auditoria: registro de prueba número 15.',
                'criterio'     => 'Criterio de auditoria: registro de prueba número 15.',
                'fecha_i'      => '2026-05-11',
                'fecha_f'      => '2026-05-11',
                'id_programa'  => 15,
                'created_at'   => '2026-05-11',
                'updated_at'   => '2026-05-11',
                'deleted_at'   => null,
                'asignado'     => 15,
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
