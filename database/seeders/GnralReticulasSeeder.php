<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_reticulas`.
 */
class GnralReticulasSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_reticulas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'gnral_reticulas';

        $llaves = [
            ['id_reticula'],
        ];

        $registros = [
            [
                'id_reticula' => 1,
                'clave'       => 'CLV-001',
                'id_carrera'  => 1,
                'updated_at'  => '2026-01-05 09:00:00',
                'created_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_reticula' => 2,
                'clave'       => 'CLV-002',
                'id_carrera'  => 2,
                'updated_at'  => '2026-01-14 10:00:00',
                'created_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_reticula' => 3,
                'clave'       => 'CLV-003',
                'id_carrera'  => 3,
                'updated_at'  => '2026-01-23 11:00:00',
                'created_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_reticula' => 4,
                'clave'       => 'CLV-004',
                'id_carrera'  => 4,
                'updated_at'  => '2026-02-01 12:00:00',
                'created_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_reticula' => 5,
                'clave'       => 'CLV-005',
                'id_carrera'  => 5,
                'updated_at'  => '2026-02-10 13:00:00',
                'created_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_reticula' => 6,
                'clave'       => 'CLV-006',
                'id_carrera'  => 6,
                'updated_at'  => '2026-02-19 14:00:00',
                'created_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_reticula' => 7,
                'clave'       => 'CLV-007',
                'id_carrera'  => 7,
                'updated_at'  => '2026-02-28 15:00:00',
                'created_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_reticula' => 8,
                'clave'       => 'CLV-008',
                'id_carrera'  => 1,
                'updated_at'  => '2026-03-09 16:00:00',
                'created_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_reticula' => 9,
                'clave'       => 'CLV-009',
                'id_carrera'  => 2,
                'updated_at'  => '2026-03-18 08:00:00',
                'created_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_reticula' => 10,
                'clave'       => 'CLV-010',
                'id_carrera'  => 3,
                'updated_at'  => '2026-03-27 09:00:00',
                'created_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_reticula' => 11,
                'clave'       => 'CLV-011',
                'id_carrera'  => 4,
                'updated_at'  => '2026-04-05 10:00:00',
                'created_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_reticula' => 12,
                'clave'       => 'CLV-012',
                'id_carrera'  => 5,
                'updated_at'  => '2026-04-14 11:00:00',
                'created_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_reticula' => 13,
                'clave'       => 'CLV-013',
                'id_carrera'  => 6,
                'updated_at'  => '2026-04-23 12:00:00',
                'created_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_reticula' => 14,
                'clave'       => 'CLV-014',
                'id_carrera'  => 7,
                'updated_at'  => '2026-05-02 13:00:00',
                'created_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_reticula' => 15,
                'clave'       => 'CLV-015',
                'id_carrera'  => 1,
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
