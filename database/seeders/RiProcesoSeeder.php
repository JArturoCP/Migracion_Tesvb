<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_proceso`.
 */
class RiProcesoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_proceso` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiSistemaSeeder::class,
        ]);

        $tabla = 'ri_proceso';

        $llaves = [
            ['id_proceso'],
        ];

        $registros = [
            [
                'id_proceso'  => 1,
                'clave'       => 'CLV-001',
                'des_proceso' => 'Des proceso proceso 1',
                'id_sistema'  => 1,
                'url'         => 'https://example.com/ri_proceso/1',
                'updated_at'  => '2026-01-05 09:00:00',
                'created_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_proceso'  => 2,
                'clave'       => 'CLV-002',
                'des_proceso' => 'Des proceso proceso 2',
                'id_sistema'  => 2,
                'url'         => 'https://example.com/ri_proceso/2',
                'updated_at'  => '2026-01-14 10:00:00',
                'created_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_proceso'  => 3,
                'clave'       => 'CLV-003',
                'des_proceso' => 'Des proceso proceso 3',
                'id_sistema'  => 3,
                'url'         => 'https://example.com/ri_proceso/3',
                'updated_at'  => '2026-01-23 11:00:00',
                'created_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_proceso'  => 4,
                'clave'       => 'CLV-004',
                'des_proceso' => 'Des proceso proceso 4',
                'id_sistema'  => 4,
                'url'         => 'https://example.com/ri_proceso/4',
                'updated_at'  => '2026-02-01 12:00:00',
                'created_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_proceso'  => 5,
                'clave'       => 'CLV-005',
                'des_proceso' => 'Des proceso proceso 5',
                'id_sistema'  => 5,
                'url'         => 'https://example.com/ri_proceso/5',
                'updated_at'  => '2026-02-10 13:00:00',
                'created_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_proceso'  => 6,
                'clave'       => 'CLV-006',
                'des_proceso' => 'Des proceso proceso 6',
                'id_sistema'  => 6,
                'url'         => 'https://example.com/ri_proceso/6',
                'updated_at'  => '2026-02-19 14:00:00',
                'created_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_proceso'  => 7,
                'clave'       => 'CLV-007',
                'des_proceso' => 'Des proceso proceso 7',
                'id_sistema'  => 7,
                'url'         => 'https://example.com/ri_proceso/7',
                'updated_at'  => '2026-02-28 15:00:00',
                'created_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_proceso'  => 8,
                'clave'       => 'CLV-008',
                'des_proceso' => 'Des proceso proceso 8',
                'id_sistema'  => 8,
                'url'         => 'https://example.com/ri_proceso/8',
                'updated_at'  => '2026-03-09 16:00:00',
                'created_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_proceso'  => 9,
                'clave'       => 'CLV-009',
                'des_proceso' => 'Des proceso proceso 9',
                'id_sistema'  => 9,
                'url'         => 'https://example.com/ri_proceso/9',
                'updated_at'  => '2026-03-18 08:00:00',
                'created_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_proceso'  => 10,
                'clave'       => 'CLV-010',
                'des_proceso' => 'Des proceso proceso 10',
                'id_sistema'  => 10,
                'url'         => 'https://example.com/ri_proceso/10',
                'updated_at'  => '2026-03-27 09:00:00',
                'created_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_proceso'  => 11,
                'clave'       => 'CLV-011',
                'des_proceso' => 'Des proceso proceso 11',
                'id_sistema'  => 11,
                'url'         => 'https://example.com/ri_proceso/11',
                'updated_at'  => '2026-04-05 10:00:00',
                'created_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_proceso'  => 12,
                'clave'       => 'CLV-012',
                'des_proceso' => 'Des proceso proceso 12',
                'id_sistema'  => 12,
                'url'         => 'https://example.com/ri_proceso/12',
                'updated_at'  => '2026-04-14 11:00:00',
                'created_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_proceso'  => 13,
                'clave'       => 'CLV-013',
                'des_proceso' => 'Des proceso proceso 13',
                'id_sistema'  => 13,
                'url'         => 'https://example.com/ri_proceso/13',
                'updated_at'  => '2026-04-23 12:00:00',
                'created_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_proceso'  => 14,
                'clave'       => 'CLV-014',
                'des_proceso' => 'Des proceso proceso 14',
                'id_sistema'  => 14,
                'url'         => 'https://example.com/ri_proceso/14',
                'updated_at'  => '2026-05-02 13:00:00',
                'created_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_proceso'  => 15,
                'clave'       => 'CLV-015',
                'des_proceso' => 'Des proceso proceso 15',
                'id_sistema'  => 15,
                'url'         => 'https://example.com/ri_proceso/15',
                'updated_at'  => '2026-05-11 14:00:00',
                'created_at'  => '2026-05-11 14:00:00',
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
