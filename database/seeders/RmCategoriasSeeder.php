<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_categorias`.
 */
class RmCategoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_categorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_categorias';

        $llaves = [
            ['id'],
            ['nombre'],
        ];

        $registros = [
            [
                'id'          => 1,
                'nombre'      => 'Nombre categorias 1',
                'descripcion' => 'Descripcion categorias 1',
                'condicion'   => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id'          => 2,
                'nombre'      => 'Nombre categorias 2',
                'descripcion' => 'Descripcion categorias 2',
                'condicion'   => 1,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id'          => 3,
                'nombre'      => 'Nombre categorias 3',
                'descripcion' => 'Descripcion categorias 3',
                'condicion'   => 1,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id'          => 4,
                'nombre'      => 'Nombre categorias 4',
                'descripcion' => 'Descripcion categorias 4',
                'condicion'   => 1,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id'          => 5,
                'nombre'      => 'Nombre categorias 5',
                'descripcion' => 'Descripcion categorias 5',
                'condicion'   => 1,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id'          => 6,
                'nombre'      => 'Nombre categorias 6',
                'descripcion' => 'Descripcion categorias 6',
                'condicion'   => 1,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id'          => 7,
                'nombre'      => 'Nombre categorias 7',
                'descripcion' => 'Descripcion categorias 7',
                'condicion'   => 1,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id'          => 8,
                'nombre'      => 'Nombre categorias 8',
                'descripcion' => 'Descripcion categorias 8',
                'condicion'   => 1,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id'          => 9,
                'nombre'      => 'Nombre categorias 9',
                'descripcion' => 'Descripcion categorias 9',
                'condicion'   => 1,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id'          => 10,
                'nombre'      => 'Nombre categorias 10',
                'descripcion' => 'Descripcion categorias 10',
                'condicion'   => 1,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id'          => 11,
                'nombre'      => 'Nombre categorias 11',
                'descripcion' => 'Descripcion categorias 11',
                'condicion'   => 1,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id'          => 12,
                'nombre'      => 'Nombre categorias 12',
                'descripcion' => 'Descripcion categorias 12',
                'condicion'   => 1,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id'          => 13,
                'nombre'      => 'Nombre categorias 13',
                'descripcion' => 'Descripcion categorias 13',
                'condicion'   => 1,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id'          => 14,
                'nombre'      => 'Nombre categorias 14',
                'descripcion' => 'Descripcion categorias 14',
                'condicion'   => 1,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id'          => 15,
                'nombre'      => 'Nombre categorias 15',
                'descripcion' => 'Descripcion categorias 15',
                'condicion'   => 1,
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
