<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_categorias`.
 */
class InvCategoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_categorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvTiposSeeder::class,
        ]);

        $tabla = 'inv_categorias';

        $llaves = [
            ['id_categoria'],
        ];

        $registros = [
            [
                'id_categoria' => 1,
                'id_tipo'      => 1,
                'descripcion'  => 'Descripcion categorias 1',
                'created_at'   => '2026-01-05 09:00:00',
                'updated_at'   => '2026-01-05 09:00:00',
            ],
            [
                'id_categoria' => 2,
                'id_tipo'      => 2,
                'descripcion'  => 'Descripcion categorias 2',
                'created_at'   => '2026-01-14 10:00:00',
                'updated_at'   => '2026-01-14 10:00:00',
            ],
            [
                'id_categoria' => 3,
                'id_tipo'      => 3,
                'descripcion'  => 'Descripcion categorias 3',
                'created_at'   => '2026-01-23 11:00:00',
                'updated_at'   => '2026-01-23 11:00:00',
            ],
            [
                'id_categoria' => 4,
                'id_tipo'      => 4,
                'descripcion'  => 'Descripcion categorias 4',
                'created_at'   => '2026-02-01 12:00:00',
                'updated_at'   => '2026-02-01 12:00:00',
            ],
            [
                'id_categoria' => 5,
                'id_tipo'      => 5,
                'descripcion'  => 'Descripcion categorias 5',
                'created_at'   => '2026-02-10 13:00:00',
                'updated_at'   => '2026-02-10 13:00:00',
            ],
            [
                'id_categoria' => 6,
                'id_tipo'      => 6,
                'descripcion'  => 'Descripcion categorias 6',
                'created_at'   => '2026-02-19 14:00:00',
                'updated_at'   => '2026-02-19 14:00:00',
            ],
            [
                'id_categoria' => 7,
                'id_tipo'      => 7,
                'descripcion'  => 'Descripcion categorias 7',
                'created_at'   => '2026-02-28 15:00:00',
                'updated_at'   => '2026-02-28 15:00:00',
            ],
            [
                'id_categoria' => 8,
                'id_tipo'      => 8,
                'descripcion'  => 'Descripcion categorias 8',
                'created_at'   => '2026-03-09 16:00:00',
                'updated_at'   => '2026-03-09 16:00:00',
            ],
            [
                'id_categoria' => 9,
                'id_tipo'      => 9,
                'descripcion'  => 'Descripcion categorias 9',
                'created_at'   => '2026-03-18 08:00:00',
                'updated_at'   => '2026-03-18 08:00:00',
            ],
            [
                'id_categoria' => 10,
                'id_tipo'      => 10,
                'descripcion'  => 'Descripcion categorias 10',
                'created_at'   => '2026-03-27 09:00:00',
                'updated_at'   => '2026-03-27 09:00:00',
            ],
            [
                'id_categoria' => 11,
                'id_tipo'      => 11,
                'descripcion'  => 'Descripcion categorias 11',
                'created_at'   => '2026-04-05 10:00:00',
                'updated_at'   => '2026-04-05 10:00:00',
            ],
            [
                'id_categoria' => 12,
                'id_tipo'      => 12,
                'descripcion'  => 'Descripcion categorias 12',
                'created_at'   => '2026-04-14 11:00:00',
                'updated_at'   => '2026-04-14 11:00:00',
            ],
            [
                'id_categoria' => 13,
                'id_tipo'      => 13,
                'descripcion'  => 'Descripcion categorias 13',
                'created_at'   => '2026-04-23 12:00:00',
                'updated_at'   => '2026-04-23 12:00:00',
            ],
            [
                'id_categoria' => 14,
                'id_tipo'      => 14,
                'descripcion'  => 'Descripcion categorias 14',
                'created_at'   => '2026-05-02 13:00:00',
                'updated_at'   => '2026-05-02 13:00:00',
            ],
            [
                'id_categoria' => 15,
                'id_tipo'      => 15,
                'descripcion'  => 'Descripcion categorias 15',
                'created_at'   => '2026-05-11 14:00:00',
                'updated_at'   => '2026-05-11 14:00:00',
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
