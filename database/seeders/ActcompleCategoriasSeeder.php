<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_categorias`.
 */
class ActcompleCategoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_categorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'actcomple_categorias';

        $llaves = [
            ['id_categoria'],
        ];

        $registros = [
            [
                'id_categoria'    => 1,
                'descripcion_cat' => 'Descripcion cat categorias 1',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_categoria'    => 2,
                'descripcion_cat' => 'Descripcion cat categorias 2',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_categoria'    => 3,
                'descripcion_cat' => 'Descripcion cat categorias 3',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_categoria'    => 4,
                'descripcion_cat' => 'Descripcion cat categorias 4',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_categoria'    => 5,
                'descripcion_cat' => 'Descripcion cat categorias 5',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_categoria'    => 6,
                'descripcion_cat' => 'Descripcion cat categorias 6',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_categoria'    => 7,
                'descripcion_cat' => 'Descripcion cat categorias 7',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_categoria'    => 8,
                'descripcion_cat' => 'Descripcion cat categorias 8',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_categoria'    => 9,
                'descripcion_cat' => 'Descripcion cat categorias 9',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_categoria'    => 10,
                'descripcion_cat' => 'Descripcion cat categorias 10',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_categoria'    => 11,
                'descripcion_cat' => 'Descripcion cat categorias 11',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_categoria'    => 12,
                'descripcion_cat' => 'Descripcion cat categorias 12',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_categoria'    => 13,
                'descripcion_cat' => 'Descripcion cat categorias 13',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_categoria'    => 14,
                'descripcion_cat' => 'Descripcion cat categorias 14',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_categoria'    => 15,
                'descripcion_cat' => 'Descripcion cat categorias 15',
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
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
