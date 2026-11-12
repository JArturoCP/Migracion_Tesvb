<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_asigna_audi`.
 */
class AudAsignaAudiSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_asigna_audi` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAuditoriaSeeder::class,
            AudCategoriaSeeder::class,
        ]);

        $tabla = 'aud_asigna_audi';

        $llaves = [
            ['id_asigna_audi'],
        ];

        $registros = [
            [
                'id_asigna_audi' => 1,
                'id_auditoria'   => 1,
                'id_auditor'     => 1,
                'id_categoria'   => 1,
                'created_at'     => '2026-01-05',
                'updated_at'     => '2026-01-05',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 2,
                'id_auditoria'   => 2,
                'id_auditor'     => 2,
                'id_categoria'   => 2,
                'created_at'     => '2026-01-14',
                'updated_at'     => '2026-01-14',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 3,
                'id_auditoria'   => 3,
                'id_auditor'     => 3,
                'id_categoria'   => 3,
                'created_at'     => '2026-01-23',
                'updated_at'     => '2026-01-23',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 4,
                'id_auditoria'   => 4,
                'id_auditor'     => 4,
                'id_categoria'   => 4,
                'created_at'     => '2026-02-01',
                'updated_at'     => '2026-02-01',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 5,
                'id_auditoria'   => 5,
                'id_auditor'     => 5,
                'id_categoria'   => 5,
                'created_at'     => '2026-02-10',
                'updated_at'     => '2026-02-10',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 6,
                'id_auditoria'   => 6,
                'id_auditor'     => 6,
                'id_categoria'   => 6,
                'created_at'     => '2026-02-19',
                'updated_at'     => '2026-02-19',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 7,
                'id_auditoria'   => 7,
                'id_auditor'     => 7,
                'id_categoria'   => 7,
                'created_at'     => '2026-02-28',
                'updated_at'     => '2026-02-28',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 8,
                'id_auditoria'   => 8,
                'id_auditor'     => 8,
                'id_categoria'   => 8,
                'created_at'     => '2026-03-09',
                'updated_at'     => '2026-03-09',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 9,
                'id_auditoria'   => 9,
                'id_auditor'     => 9,
                'id_categoria'   => 9,
                'created_at'     => '2026-03-18',
                'updated_at'     => '2026-03-18',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 10,
                'id_auditoria'   => 10,
                'id_auditor'     => 10,
                'id_categoria'   => 10,
                'created_at'     => '2026-03-27',
                'updated_at'     => '2026-03-27',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 11,
                'id_auditoria'   => 11,
                'id_auditor'     => 11,
                'id_categoria'   => 11,
                'created_at'     => '2026-04-05',
                'updated_at'     => '2026-04-05',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 12,
                'id_auditoria'   => 12,
                'id_auditor'     => 12,
                'id_categoria'   => 12,
                'created_at'     => '2026-04-14',
                'updated_at'     => '2026-04-14',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 13,
                'id_auditoria'   => 13,
                'id_auditor'     => 13,
                'id_categoria'   => 13,
                'created_at'     => '2026-04-23',
                'updated_at'     => '2026-04-23',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 14,
                'id_auditoria'   => 14,
                'id_auditor'     => 14,
                'id_categoria'   => 14,
                'created_at'     => '2026-05-02',
                'updated_at'     => '2026-05-02',
                'deleted_at'     => null,
            ],
            [
                'id_asigna_audi' => 15,
                'id_auditoria'   => 15,
                'id_auditor'     => 15,
                'id_categoria'   => 15,
                'created_at'     => '2026-05-11',
                'updated_at'     => '2026-05-11',
                'deleted_at'     => null,
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
