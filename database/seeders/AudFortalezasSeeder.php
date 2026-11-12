<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_fortalezas`.
 */
class AudFortalezasSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_fortalezas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudInformeSeeder::class,
        ]);

        $tabla = 'aud_fortalezas';

        $llaves = [
            ['id_fortaleza'],
        ];

        $registros = [
            [
                'id_fortaleza'  => 1,
                'punto_proceso' => 'V1',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 1.',
                'id_informe'    => 1,
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 2,
                'punto_proceso' => 'V2',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 2.',
                'id_informe'    => 2,
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 3,
                'punto_proceso' => 'V3',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 3.',
                'id_informe'    => 3,
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 4,
                'punto_proceso' => 'V4',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 4.',
                'id_informe'    => 4,
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 5,
                'punto_proceso' => 'V5',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 5.',
                'id_informe'    => 5,
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 6,
                'punto_proceso' => 'V6',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 6.',
                'id_informe'    => 6,
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 7,
                'punto_proceso' => 'V7',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 7.',
                'id_informe'    => 7,
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 8,
                'punto_proceso' => 'V8',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 8.',
                'id_informe'    => 8,
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 9,
                'punto_proceso' => 'V9',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 9.',
                'id_informe'    => 9,
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 10,
                'punto_proceso' => 'V10',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 10.',
                'id_informe'    => 10,
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 11,
                'punto_proceso' => 'V11',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 11.',
                'id_informe'    => 11,
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 12,
                'punto_proceso' => 'V12',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 12.',
                'id_informe'    => 12,
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 13,
                'punto_proceso' => 'V13',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 13.',
                'id_informe'    => 13,
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 14,
                'punto_proceso' => 'V14',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 14.',
                'id_informe'    => 14,
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_fortaleza'  => 15,
                'punto_proceso' => 'V15',
                'descripcion_f' => 'Descripcion f de fortalezas: registro de prueba número 15.',
                'id_informe'    => 15,
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
