<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_tipo_informes`.
 */
class InvTipoInformesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_tipo_informes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_tipo_informes';

        $llaves = [
            ['id_tipo_informe'],
        ];

        $registros = [
            [
                'id_tipo_informe' => 1,
                'descripcion'     => 'Descripcion tipo informes 1',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 2,
                'descripcion'     => 'Descripcion tipo informes 2',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 3,
                'descripcion'     => 'Descripcion tipo informes 3',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 4,
                'descripcion'     => 'Descripcion tipo informes 4',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 5,
                'descripcion'     => 'Descripcion tipo informes 5',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 6,
                'descripcion'     => 'Descripcion tipo informes 6',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 7,
                'descripcion'     => 'Descripcion tipo informes 7',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 8,
                'descripcion'     => 'Descripcion tipo informes 8',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 9,
                'descripcion'     => 'Descripcion tipo informes 9',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 10,
                'descripcion'     => 'Descripcion tipo informes 10',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 11,
                'descripcion'     => 'Descripcion tipo informes 11',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 12,
                'descripcion'     => 'Descripcion tipo informes 12',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 13,
                'descripcion'     => 'Descripcion tipo informes 13',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 14,
                'descripcion'     => 'Descripcion tipo informes 14',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_tipo_informe' => 15,
                'descripcion'     => 'Descripcion tipo informes 15',
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
