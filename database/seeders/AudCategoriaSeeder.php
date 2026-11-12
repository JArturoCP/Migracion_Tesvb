<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_categoria`.
 */
class AudCategoriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_categoria` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_categoria';

        $llaves = [
            ['id_categoria'],
        ];

        $registros = [
            [
                'id_categoria' => 1,
                'descripcion'  => 'Descripcion catego 1',
                'created_at'   => '2026-01-05',
                'updated_at'   => '2026-01-05',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 2,
                'descripcion'  => 'Descripcion catego 2',
                'created_at'   => '2026-01-14',
                'updated_at'   => '2026-01-14',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 3,
                'descripcion'  => 'Descripcion catego 3',
                'created_at'   => '2026-01-23',
                'updated_at'   => '2026-01-23',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 4,
                'descripcion'  => 'Descripcion catego 4',
                'created_at'   => '2026-02-01',
                'updated_at'   => '2026-02-01',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 5,
                'descripcion'  => 'Descripcion catego 5',
                'created_at'   => '2026-02-10',
                'updated_at'   => '2026-02-10',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 6,
                'descripcion'  => 'Descripcion catego 6',
                'created_at'   => '2026-02-19',
                'updated_at'   => '2026-02-19',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 7,
                'descripcion'  => 'Descripcion catego 7',
                'created_at'   => '2026-02-28',
                'updated_at'   => '2026-02-28',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 8,
                'descripcion'  => 'Descripcion catego 8',
                'created_at'   => '2026-03-09',
                'updated_at'   => '2026-03-09',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 9,
                'descripcion'  => 'Descripcion catego 9',
                'created_at'   => '2026-03-18',
                'updated_at'   => '2026-03-18',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 10,
                'descripcion'  => 'Descripcion categ 10',
                'created_at'   => '2026-03-27',
                'updated_at'   => '2026-03-27',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 11,
                'descripcion'  => 'Descripcion categ 11',
                'created_at'   => '2026-04-05',
                'updated_at'   => '2026-04-05',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 12,
                'descripcion'  => 'Descripcion categ 12',
                'created_at'   => '2026-04-14',
                'updated_at'   => '2026-04-14',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 13,
                'descripcion'  => 'Descripcion categ 13',
                'created_at'   => '2026-04-23',
                'updated_at'   => '2026-04-23',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 14,
                'descripcion'  => 'Descripcion categ 14',
                'created_at'   => '2026-05-02',
                'updated_at'   => '2026-05-02',
                'deleted_at'   => null,
            ],
            [
                'id_categoria' => 15,
                'descripcion'  => 'Descripcion categ 15',
                'created_at'   => '2026-05-11',
                'updated_at'   => '2026-05-11',
                'deleted_at'   => null,
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
