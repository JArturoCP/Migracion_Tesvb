<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_auditoria_proceso`.
 */
class AudAuditoriaProcesoSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_auditoria_proceso` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAuditoriaSeeder::class,
            RiProcesoSeeder::class,
        ]);

        $tabla = 'aud_auditoria_proceso';

        $llaves = [
            ['id_auditoria_proceso'],
        ];

        $registros = [
            [
                'id_auditoria_proceso' => 1,
                'id_auditoria'         => 1,
                'id_proceso'           => 1,
                'created_at'           => '2026-01-05',
                'updated_at'           => '2026-01-05',
                'deleted_at'           => '2026-01-05',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 1.',
            ],
            [
                'id_auditoria_proceso' => 2,
                'id_auditoria'         => 2,
                'id_proceso'           => 2,
                'created_at'           => '2026-01-14',
                'updated_at'           => '2026-01-14',
                'deleted_at'           => '2026-01-14',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 2.',
            ],
            [
                'id_auditoria_proceso' => 3,
                'id_auditoria'         => 3,
                'id_proceso'           => 3,
                'created_at'           => '2026-01-23',
                'updated_at'           => '2026-01-23',
                'deleted_at'           => '2026-01-23',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 3.',
            ],
            [
                'id_auditoria_proceso' => 4,
                'id_auditoria'         => 4,
                'id_proceso'           => 4,
                'created_at'           => '2026-02-01',
                'updated_at'           => '2026-02-01',
                'deleted_at'           => '2026-02-01',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 4.',
            ],
            [
                'id_auditoria_proceso' => 5,
                'id_auditoria'         => 5,
                'id_proceso'           => 5,
                'created_at'           => '2026-02-10',
                'updated_at'           => '2026-02-10',
                'deleted_at'           => '2026-02-10',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 5.',
            ],
            [
                'id_auditoria_proceso' => 6,
                'id_auditoria'         => 6,
                'id_proceso'           => 6,
                'created_at'           => '2026-02-19',
                'updated_at'           => '2026-02-19',
                'deleted_at'           => '2026-02-19',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 6.',
            ],
            [
                'id_auditoria_proceso' => 7,
                'id_auditoria'         => 7,
                'id_proceso'           => 7,
                'created_at'           => '2026-02-28',
                'updated_at'           => '2026-02-28',
                'deleted_at'           => '2026-02-28',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 7.',
            ],
            [
                'id_auditoria_proceso' => 8,
                'id_auditoria'         => 8,
                'id_proceso'           => 8,
                'created_at'           => '2026-03-09',
                'updated_at'           => '2026-03-09',
                'deleted_at'           => '2026-03-09',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 8.',
            ],
            [
                'id_auditoria_proceso' => 9,
                'id_auditoria'         => 9,
                'id_proceso'           => 9,
                'created_at'           => '2026-03-18',
                'updated_at'           => '2026-03-18',
                'deleted_at'           => '2026-03-18',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 9.',
            ],
            [
                'id_auditoria_proceso' => 10,
                'id_auditoria'         => 10,
                'id_proceso'           => 10,
                'created_at'           => '2026-03-27',
                'updated_at'           => '2026-03-27',
                'deleted_at'           => '2026-03-27',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 10.',
            ],
            [
                'id_auditoria_proceso' => 11,
                'id_auditoria'         => 11,
                'id_proceso'           => 11,
                'created_at'           => '2026-04-05',
                'updated_at'           => '2026-04-05',
                'deleted_at'           => '2026-04-05',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 11.',
            ],
            [
                'id_auditoria_proceso' => 12,
                'id_auditoria'         => 12,
                'id_proceso'           => 12,
                'created_at'           => '2026-04-14',
                'updated_at'           => '2026-04-14',
                'deleted_at'           => '2026-04-14',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 12.',
            ],
            [
                'id_auditoria_proceso' => 13,
                'id_auditoria'         => 13,
                'id_proceso'           => 13,
                'created_at'           => '2026-04-23',
                'updated_at'           => '2026-04-23',
                'deleted_at'           => '2026-04-23',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 13.',
            ],
            [
                'id_auditoria_proceso' => 14,
                'id_auditoria'         => 14,
                'id_proceso'           => 14,
                'created_at'           => '2026-05-02',
                'updated_at'           => '2026-05-02',
                'deleted_at'           => '2026-05-02',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 14.',
            ],
            [
                'id_auditoria_proceso' => 15,
                'id_auditoria'         => 15,
                'id_proceso'           => 15,
                'created_at'           => '2026-05-11',
                'updated_at'           => '2026-05-11',
                'deleted_at'           => '2026-05-11',
                'observacion'          => 'Observacion de auditoria proceso: registro de prueba número 15.',
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
