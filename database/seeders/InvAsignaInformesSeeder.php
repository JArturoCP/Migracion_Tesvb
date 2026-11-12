<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_asigna_informes`.
 */
class InvAsignaInformesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_asigna_informes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvInformesSeeder::class,
        ]);

        $tabla = 'inv_asigna_informes';

        $llaves = [
            ['id_asigna_informes'],
        ];

        $registros = [
            [
                'id_asigna_informes' => 1,
                'id_informe'         => 1,
                'id_comite'          => 1,
                'id_resultado'       => 1,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 1.',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 2,
                'id_informe'         => 2,
                'id_comite'          => 2,
                'id_resultado'       => 2,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 2.',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 3,
                'id_informe'         => 3,
                'id_comite'          => 3,
                'id_resultado'       => 3,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 3.',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 4,
                'id_informe'         => 4,
                'id_comite'          => 4,
                'id_resultado'       => 4,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 4.',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 5,
                'id_informe'         => 5,
                'id_comite'          => 5,
                'id_resultado'       => 5,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 5.',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 6,
                'id_informe'         => 6,
                'id_comite'          => 6,
                'id_resultado'       => 6,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 6.',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 7,
                'id_informe'         => 7,
                'id_comite'          => 7,
                'id_resultado'       => 7,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 7.',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 8,
                'id_informe'         => 8,
                'id_comite'          => 8,
                'id_resultado'       => 8,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 8.',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 9,
                'id_informe'         => 9,
                'id_comite'          => 9,
                'id_resultado'       => 9,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 9.',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 10,
                'id_informe'         => 10,
                'id_comite'          => 10,
                'id_resultado'       => 10,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 10.',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 11,
                'id_informe'         => 11,
                'id_comite'          => 11,
                'id_resultado'       => 11,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 11.',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 12,
                'id_informe'         => 12,
                'id_comite'          => 12,
                'id_resultado'       => 12,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 12.',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 13,
                'id_informe'         => 13,
                'id_comite'          => 13,
                'id_resultado'       => 13,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 13.',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 14,
                'id_informe'         => 14,
                'id_comite'          => 14,
                'id_resultado'       => 14,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 14.',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_asigna_informes' => 15,
                'id_informe'         => 15,
                'id_comite'          => 15,
                'id_resultado'       => 15,
                'comentario'         => 'Comentario de asigna informes: registro de prueba número 15.',
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'deleted_at'         => null,
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
