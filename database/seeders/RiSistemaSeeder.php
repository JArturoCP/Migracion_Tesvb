<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_sistema`.
 */
class RiSistemaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_sistema` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_sistema';

        $llaves = [
            ['id_sistema'],
        ];

        $registros = [
            [
                'id_sistema'   => 1,
                'desc_sistema' => 'Desc sistema sistema 1',
                'updated_at'   => '2026-01-05 09:00:00',
                'created_at'   => '2026-01-05 09:00:00',
            ],
            [
                'id_sistema'   => 2,
                'desc_sistema' => 'Desc sistema sistema 2',
                'updated_at'   => '2026-01-14 10:00:00',
                'created_at'   => '2026-01-14 10:00:00',
            ],
            [
                'id_sistema'   => 3,
                'desc_sistema' => 'Desc sistema sistema 3',
                'updated_at'   => '2026-01-23 11:00:00',
                'created_at'   => '2026-01-23 11:00:00',
            ],
            [
                'id_sistema'   => 4,
                'desc_sistema' => 'Desc sistema sistema 4',
                'updated_at'   => '2026-02-01 12:00:00',
                'created_at'   => '2026-02-01 12:00:00',
            ],
            [
                'id_sistema'   => 5,
                'desc_sistema' => 'Desc sistema sistema 5',
                'updated_at'   => '2026-02-10 13:00:00',
                'created_at'   => '2026-02-10 13:00:00',
            ],
            [
                'id_sistema'   => 6,
                'desc_sistema' => 'Desc sistema sistema 6',
                'updated_at'   => '2026-02-19 14:00:00',
                'created_at'   => '2026-02-19 14:00:00',
            ],
            [
                'id_sistema'   => 7,
                'desc_sistema' => 'Desc sistema sistema 7',
                'updated_at'   => '2026-02-28 15:00:00',
                'created_at'   => '2026-02-28 15:00:00',
            ],
            [
                'id_sistema'   => 8,
                'desc_sistema' => 'Desc sistema sistema 8',
                'updated_at'   => '2026-03-09 16:00:00',
                'created_at'   => '2026-03-09 16:00:00',
            ],
            [
                'id_sistema'   => 9,
                'desc_sistema' => 'Desc sistema sistema 9',
                'updated_at'   => '2026-03-18 08:00:00',
                'created_at'   => '2026-03-18 08:00:00',
            ],
            [
                'id_sistema'   => 10,
                'desc_sistema' => 'Desc sistema sistema 10',
                'updated_at'   => '2026-03-27 09:00:00',
                'created_at'   => '2026-03-27 09:00:00',
            ],
            [
                'id_sistema'   => 11,
                'desc_sistema' => 'Desc sistema sistema 11',
                'updated_at'   => '2026-04-05 10:00:00',
                'created_at'   => '2026-04-05 10:00:00',
            ],
            [
                'id_sistema'   => 12,
                'desc_sistema' => 'Desc sistema sistema 12',
                'updated_at'   => '2026-04-14 11:00:00',
                'created_at'   => '2026-04-14 11:00:00',
            ],
            [
                'id_sistema'   => 13,
                'desc_sistema' => 'Desc sistema sistema 13',
                'updated_at'   => '2026-04-23 12:00:00',
                'created_at'   => '2026-04-23 12:00:00',
            ],
            [
                'id_sistema'   => 14,
                'desc_sistema' => 'Desc sistema sistema 14',
                'updated_at'   => '2026-05-02 13:00:00',
                'created_at'   => '2026-05-02 13:00:00',
            ],
            [
                'id_sistema'   => 15,
                'desc_sistema' => 'Desc sistema sistema 15',
                'updated_at'   => '2026-05-11 14:00:00',
                'created_at'   => '2026-05-11 14:00:00',
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
