<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pmcodigos_material`.
 */
class PmcodigosMaterialSeeder extends Seeder
{
    /**
     * Pobla la tabla `pmcodigos_material` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PmprestamosMaterialesSeeder::class,
        ]);

        $tabla = 'pmcodigos_material';

        $llaves = [
            ['id_codigo'],
            ['codigo', 'deleted_at'],
        ];

        $registros = [
            [
                'id_codigo'   => 1,
                'id_material' => 1,
                'codigo'      => 'CLV-001',
                'updated_at'  => '2026-01-05 09:00:00',
                'created_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 2,
                'id_material' => 2,
                'codigo'      => 'CLV-002',
                'updated_at'  => '2026-01-14 10:00:00',
                'created_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 3,
                'id_material' => 3,
                'codigo'      => 'CLV-003',
                'updated_at'  => '2026-01-23 11:00:00',
                'created_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 4,
                'id_material' => 4,
                'codigo'      => 'CLV-004',
                'updated_at'  => '2026-02-01 12:00:00',
                'created_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 5,
                'id_material' => 5,
                'codigo'      => 'CLV-005',
                'updated_at'  => '2026-02-10 13:00:00',
                'created_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 6,
                'id_material' => 6,
                'codigo'      => 'CLV-006',
                'updated_at'  => '2026-02-19 14:00:00',
                'created_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 7,
                'id_material' => 7,
                'codigo'      => 'CLV-007',
                'updated_at'  => '2026-02-28 15:00:00',
                'created_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 8,
                'id_material' => 8,
                'codigo'      => 'CLV-008',
                'updated_at'  => '2026-03-09 16:00:00',
                'created_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 9,
                'id_material' => 9,
                'codigo'      => 'CLV-009',
                'updated_at'  => '2026-03-18 08:00:00',
                'created_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 10,
                'id_material' => 10,
                'codigo'      => 'CLV-010',
                'updated_at'  => '2026-03-27 09:00:00',
                'created_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 11,
                'id_material' => 11,
                'codigo'      => 'CLV-011',
                'updated_at'  => '2026-04-05 10:00:00',
                'created_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 12,
                'id_material' => 12,
                'codigo'      => 'CLV-012',
                'updated_at'  => '2026-04-14 11:00:00',
                'created_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 13,
                'id_material' => 13,
                'codigo'      => 'CLV-013',
                'updated_at'  => '2026-04-23 12:00:00',
                'created_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 14,
                'id_material' => 14,
                'codigo'      => 'CLV-014',
                'updated_at'  => '2026-05-02 13:00:00',
                'created_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_codigo'   => 15,
                'id_material' => 15,
                'codigo'      => 'CLV-015',
                'updated_at'  => '2026-05-11 14:00:00',
                'created_at'  => '2026-05-11 14:00:00',
                'deleted_at'  => null,
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
