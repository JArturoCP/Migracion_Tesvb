<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pmprestamos_materiales`.
 */
class PmprestamosMaterialesSeeder extends Seeder
{
    /**
     * Pobla la tabla `pmprestamos_materiales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pmprestamos_materiales';

        $llaves = [
            ['id_material'],
        ];

        $registros = [
            [
                'id_material' => 1,
                'descripcion' => 'Descripcion pmprestamos materiales 1',
                'cantidad'    => 1,
                'updated_at'  => '2026-01-05 09:00:00',
                'created_at'  => '2026-01-05 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 2,
                'descripcion' => 'Descripcion pmprestamos materiales 2',
                'cantidad'    => 2,
                'updated_at'  => '2026-01-14 10:00:00',
                'created_at'  => '2026-01-14 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 3,
                'descripcion' => 'Descripcion pmprestamos materiales 3',
                'cantidad'    => 3,
                'updated_at'  => '2026-01-23 11:00:00',
                'created_at'  => '2026-01-23 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 4,
                'descripcion' => 'Descripcion pmprestamos materiales 4',
                'cantidad'    => 4,
                'updated_at'  => '2026-02-01 12:00:00',
                'created_at'  => '2026-02-01 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 5,
                'descripcion' => 'Descripcion pmprestamos materiales 5',
                'cantidad'    => 5,
                'updated_at'  => '2026-02-10 13:00:00',
                'created_at'  => '2026-02-10 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 6,
                'descripcion' => 'Descripcion pmprestamos materiales 6',
                'cantidad'    => 6,
                'updated_at'  => '2026-02-19 14:00:00',
                'created_at'  => '2026-02-19 14:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 7,
                'descripcion' => 'Descripcion pmprestamos materiales 7',
                'cantidad'    => 7,
                'updated_at'  => '2026-02-28 15:00:00',
                'created_at'  => '2026-02-28 15:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 8,
                'descripcion' => 'Descripcion pmprestamos materiales 8',
                'cantidad'    => 8,
                'updated_at'  => '2026-03-09 16:00:00',
                'created_at'  => '2026-03-09 16:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 9,
                'descripcion' => 'Descripcion pmprestamos materiales 9',
                'cantidad'    => 9,
                'updated_at'  => '2026-03-18 08:00:00',
                'created_at'  => '2026-03-18 08:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 10,
                'descripcion' => 'Descripcion pmprestamos materiales 10',
                'cantidad'    => 10,
                'updated_at'  => '2026-03-27 09:00:00',
                'created_at'  => '2026-03-27 09:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 11,
                'descripcion' => 'Descripcion pmprestamos materiales 11',
                'cantidad'    => 11,
                'updated_at'  => '2026-04-05 10:00:00',
                'created_at'  => '2026-04-05 10:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 12,
                'descripcion' => 'Descripcion pmprestamos materiales 12',
                'cantidad'    => 12,
                'updated_at'  => '2026-04-14 11:00:00',
                'created_at'  => '2026-04-14 11:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 13,
                'descripcion' => 'Descripcion pmprestamos materiales 13',
                'cantidad'    => 13,
                'updated_at'  => '2026-04-23 12:00:00',
                'created_at'  => '2026-04-23 12:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 14,
                'descripcion' => 'Descripcion pmprestamos materiales 14',
                'cantidad'    => 14,
                'updated_at'  => '2026-05-02 13:00:00',
                'created_at'  => '2026-05-02 13:00:00',
                'deleted_at'  => null,
            ],
            [
                'id_material' => 15,
                'descripcion' => 'Descripcion pmprestamos materiales 15',
                'cantidad'    => 15,
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
