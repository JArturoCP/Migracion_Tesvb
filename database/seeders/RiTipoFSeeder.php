<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_tipo_f`.
 */
class RiTipoFSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_tipo_f` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_tipo_f';

        $llaves = [
            ['id_tipo_f'],
        ];

        $registros = [
            [
                'id_tipo_f'  => 1,
                'des_tf'     => 'Des tf tipo f 1',
                'updated_at' => '2026-01-05 09:00:00',
                'created_at' => '2026-01-05 09:00:00',
            ],
            [
                'id_tipo_f'  => 2,
                'des_tf'     => 'Des tf tipo f 2',
                'updated_at' => '2026-01-14 10:00:00',
                'created_at' => '2026-01-14 10:00:00',
            ],
            [
                'id_tipo_f'  => 3,
                'des_tf'     => 'Des tf tipo f 3',
                'updated_at' => '2026-01-23 11:00:00',
                'created_at' => '2026-01-23 11:00:00',
            ],
            [
                'id_tipo_f'  => 4,
                'des_tf'     => 'Des tf tipo f 4',
                'updated_at' => '2026-02-01 12:00:00',
                'created_at' => '2026-02-01 12:00:00',
            ],
            [
                'id_tipo_f'  => 5,
                'des_tf'     => 'Des tf tipo f 5',
                'updated_at' => '2026-02-10 13:00:00',
                'created_at' => '2026-02-10 13:00:00',
            ],
            [
                'id_tipo_f'  => 6,
                'des_tf'     => 'Des tf tipo f 6',
                'updated_at' => '2026-02-19 14:00:00',
                'created_at' => '2026-02-19 14:00:00',
            ],
            [
                'id_tipo_f'  => 7,
                'des_tf'     => 'Des tf tipo f 7',
                'updated_at' => '2026-02-28 15:00:00',
                'created_at' => '2026-02-28 15:00:00',
            ],
            [
                'id_tipo_f'  => 8,
                'des_tf'     => 'Des tf tipo f 8',
                'updated_at' => '2026-03-09 16:00:00',
                'created_at' => '2026-03-09 16:00:00',
            ],
            [
                'id_tipo_f'  => 9,
                'des_tf'     => 'Des tf tipo f 9',
                'updated_at' => '2026-03-18 08:00:00',
                'created_at' => '2026-03-18 08:00:00',
            ],
            [
                'id_tipo_f'  => 10,
                'des_tf'     => 'Des tf tipo f 10',
                'updated_at' => '2026-03-27 09:00:00',
                'created_at' => '2026-03-27 09:00:00',
            ],
            [
                'id_tipo_f'  => 11,
                'des_tf'     => 'Des tf tipo f 11',
                'updated_at' => '2026-04-05 10:00:00',
                'created_at' => '2026-04-05 10:00:00',
            ],
            [
                'id_tipo_f'  => 12,
                'des_tf'     => 'Des tf tipo f 12',
                'updated_at' => '2026-04-14 11:00:00',
                'created_at' => '2026-04-14 11:00:00',
            ],
            [
                'id_tipo_f'  => 13,
                'des_tf'     => 'Des tf tipo f 13',
                'updated_at' => '2026-04-23 12:00:00',
                'created_at' => '2026-04-23 12:00:00',
            ],
            [
                'id_tipo_f'  => 14,
                'des_tf'     => 'Des tf tipo f 14',
                'updated_at' => '2026-05-02 13:00:00',
                'created_at' => '2026-05-02 13:00:00',
            ],
            [
                'id_tipo_f'  => 15,
                'des_tf'     => 'Des tf tipo f 15',
                'updated_at' => '2026-05-11 14:00:00',
                'created_at' => '2026-05-11 14:00:00',
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
