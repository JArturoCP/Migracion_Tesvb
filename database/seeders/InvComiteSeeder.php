<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_comite`.
 */
class InvComiteSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_comite` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvInvestigadoresSeeder::class,
        ]);

        $tabla = 'inv_comite';

        $llaves = [
            ['id_comite'],
        ];

        $registros = [
            [
                'id_comite'       => 1,
                'id_investigador' => 1,
                'vigencia_inicio' => '2026-01-05',
                'vigencia_fin'    => '2026-01-05',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 2,
                'id_investigador' => 2,
                'vigencia_inicio' => '2026-01-14',
                'vigencia_fin'    => '2026-01-14',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 3,
                'id_investigador' => 3,
                'vigencia_inicio' => '2026-01-23',
                'vigencia_fin'    => '2026-01-23',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 4,
                'id_investigador' => 4,
                'vigencia_inicio' => '2026-02-01',
                'vigencia_fin'    => '2026-02-01',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 5,
                'id_investigador' => 5,
                'vigencia_inicio' => '2026-02-10',
                'vigencia_fin'    => '2026-02-10',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 6,
                'id_investigador' => 6,
                'vigencia_inicio' => '2026-02-19',
                'vigencia_fin'    => '2026-02-19',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 7,
                'id_investigador' => 7,
                'vigencia_inicio' => '2026-02-28',
                'vigencia_fin'    => '2026-02-28',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 8,
                'id_investigador' => 8,
                'vigencia_inicio' => '2026-03-09',
                'vigencia_fin'    => '2026-03-09',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 9,
                'id_investigador' => 9,
                'vigencia_inicio' => '2026-03-18',
                'vigencia_fin'    => '2026-03-18',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 10,
                'id_investigador' => 10,
                'vigencia_inicio' => '2026-03-27',
                'vigencia_fin'    => '2026-03-27',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 11,
                'id_investigador' => 11,
                'vigencia_inicio' => '2026-04-05',
                'vigencia_fin'    => '2026-04-05',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 12,
                'id_investigador' => 12,
                'vigencia_inicio' => '2026-04-14',
                'vigencia_fin'    => '2026-04-14',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 13,
                'id_investigador' => 13,
                'vigencia_inicio' => '2026-04-23',
                'vigencia_fin'    => '2026-04-23',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 14,
                'id_investigador' => 14,
                'vigencia_inicio' => '2026-05-02',
                'vigencia_fin'    => '2026-05-02',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_comite'       => 15,
                'id_investigador' => 15,
                'vigencia_inicio' => '2026-05-11',
                'vigencia_fin'    => '2026-05-11',
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
                'deleted_at'      => null,
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
