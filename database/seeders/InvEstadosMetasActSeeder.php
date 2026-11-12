<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_estados_metas_act`.
 */
class InvEstadosMetasActSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_estados_metas_act` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_estados_metas_act';

        $llaves = [
            ['id_estado_meta_act'],
        ];

        $registros = [
            [
                'id_estado_meta_act' => 1,
                'estado'             => 1,
                'descripcion_estado' => 'Descripcion estado estados metas act 1',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 2,
                'estado'             => 2,
                'descripcion_estado' => 'Descripcion estado estados metas act 2',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 3,
                'estado'             => 3,
                'descripcion_estado' => 'Descripcion estado estados metas act 3',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 4,
                'estado'             => 4,
                'descripcion_estado' => 'Descripcion estado estados metas act 4',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 5,
                'estado'             => 5,
                'descripcion_estado' => 'Descripcion estado estados metas act 5',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 6,
                'estado'             => 6,
                'descripcion_estado' => 'Descripcion estado estados metas act 6',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 7,
                'estado'             => 7,
                'descripcion_estado' => 'Descripcion estado estados metas act 7',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 8,
                'estado'             => 8,
                'descripcion_estado' => 'Descripcion estado estados metas act 8',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 9,
                'estado'             => 9,
                'descripcion_estado' => 'Descripcion estado estados metas act 9',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 10,
                'estado'             => 10,
                'descripcion_estado' => 'Descripcion estado estados metas act 10',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 11,
                'estado'             => 11,
                'descripcion_estado' => 'Descripcion estado estados metas act 11',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 12,
                'estado'             => 12,
                'descripcion_estado' => 'Descripcion estado estados metas act 12',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 13,
                'estado'             => 13,
                'descripcion_estado' => 'Descripcion estado estados metas act 13',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 14,
                'estado'             => 14,
                'descripcion_estado' => 'Descripcion estado estados metas act 14',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'deleted_at'         => null,
            ],
            [
                'id_estado_meta_act' => 15,
                'estado'             => 15,
                'descripcion_estado' => 'Descripcion estado estados metas act 15',
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
