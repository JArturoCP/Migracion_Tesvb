<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_auditor_auditoria`.
 */
class AudAuditorAuditoriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_auditor_auditoria` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAuditoriaSeeder::class,
            AudCategoriaSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'aud_auditor_auditoria';

        $llaves = [
            ['id_auditor_auditoria'],
        ];

        $registros = [
            [
                'id_auditor_auditoria' => 1,
                'id_auditoria'         => 1,
                'id_personal'          => 1,
                'id_categoria'         => 1,
                'created_at'           => '2026-01-05',
                'updated_at'           => '2026-01-05',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 2,
                'id_auditoria'         => 2,
                'id_personal'          => 2,
                'id_categoria'         => 2,
                'created_at'           => '2026-01-14',
                'updated_at'           => '2026-01-14',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 3,
                'id_auditoria'         => 3,
                'id_personal'          => 3,
                'id_categoria'         => 3,
                'created_at'           => '2026-01-23',
                'updated_at'           => '2026-01-23',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 4,
                'id_auditoria'         => 4,
                'id_personal'          => 4,
                'id_categoria'         => 4,
                'created_at'           => '2026-02-01',
                'updated_at'           => '2026-02-01',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 5,
                'id_auditoria'         => 5,
                'id_personal'          => 5,
                'id_categoria'         => 5,
                'created_at'           => '2026-02-10',
                'updated_at'           => '2026-02-10',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 6,
                'id_auditoria'         => 6,
                'id_personal'          => 6,
                'id_categoria'         => 6,
                'created_at'           => '2026-02-19',
                'updated_at'           => '2026-02-19',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 7,
                'id_auditoria'         => 7,
                'id_personal'          => 7,
                'id_categoria'         => 7,
                'created_at'           => '2026-02-28',
                'updated_at'           => '2026-02-28',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 8,
                'id_auditoria'         => 8,
                'id_personal'          => 8,
                'id_categoria'         => 8,
                'created_at'           => '2026-03-09',
                'updated_at'           => '2026-03-09',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 9,
                'id_auditoria'         => 9,
                'id_personal'          => 9,
                'id_categoria'         => 9,
                'created_at'           => '2026-03-18',
                'updated_at'           => '2026-03-18',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 10,
                'id_auditoria'         => 10,
                'id_personal'          => 10,
                'id_categoria'         => 10,
                'created_at'           => '2026-03-27',
                'updated_at'           => '2026-03-27',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 11,
                'id_auditoria'         => 11,
                'id_personal'          => 11,
                'id_categoria'         => 11,
                'created_at'           => '2026-04-05',
                'updated_at'           => '2026-04-05',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 12,
                'id_auditoria'         => 12,
                'id_personal'          => 12,
                'id_categoria'         => 12,
                'created_at'           => '2026-04-14',
                'updated_at'           => '2026-04-14',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 13,
                'id_auditoria'         => 13,
                'id_personal'          => 13,
                'id_categoria'         => 13,
                'created_at'           => '2026-04-23',
                'updated_at'           => '2026-04-23',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 14,
                'id_auditoria'         => 14,
                'id_personal'          => 14,
                'id_categoria'         => 14,
                'created_at'           => '2026-05-02',
                'updated_at'           => '2026-05-02',
                'deleted_at'           => null,
            ],
            [
                'id_auditor_auditoria' => 15,
                'id_auditoria'         => 15,
                'id_personal'          => 15,
                'id_categoria'         => 15,
                'created_at'           => '2026-05-11',
                'updated_at'           => '2026-05-11',
                'deleted_at'           => null,
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
