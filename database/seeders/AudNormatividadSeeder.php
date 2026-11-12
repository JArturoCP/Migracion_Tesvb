<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_normatividad`.
 */
class AudNormatividadSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_normatividad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_normatividad';

        $llaves = [
            ['id_normatividad'],
        ];

        $registros = [
            [
                'id_normatividad' => 1,
                'descripcion'     => 'Descripcion normatividad 1',
                'created_at'      => '2026-01-05',
                'updated_at'      => '2026-01-05',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 2,
                'descripcion'     => 'Descripcion normatividad 2',
                'created_at'      => '2026-01-14',
                'updated_at'      => '2026-01-14',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 3,
                'descripcion'     => 'Descripcion normatividad 3',
                'created_at'      => '2026-01-23',
                'updated_at'      => '2026-01-23',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 4,
                'descripcion'     => 'Descripcion normatividad 4',
                'created_at'      => '2026-02-01',
                'updated_at'      => '2026-02-01',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 5,
                'descripcion'     => 'Descripcion normatividad 5',
                'created_at'      => '2026-02-10',
                'updated_at'      => '2026-02-10',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 6,
                'descripcion'     => 'Descripcion normatividad 6',
                'created_at'      => '2026-02-19',
                'updated_at'      => '2026-02-19',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 7,
                'descripcion'     => 'Descripcion normatividad 7',
                'created_at'      => '2026-02-28',
                'updated_at'      => '2026-02-28',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 8,
                'descripcion'     => 'Descripcion normatividad 8',
                'created_at'      => '2026-03-09',
                'updated_at'      => '2026-03-09',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 9,
                'descripcion'     => 'Descripcion normatividad 9',
                'created_at'      => '2026-03-18',
                'updated_at'      => '2026-03-18',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 10,
                'descripcion'     => 'Descripcion normatividad 10',
                'created_at'      => '2026-03-27',
                'updated_at'      => '2026-03-27',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 11,
                'descripcion'     => 'Descripcion normatividad 11',
                'created_at'      => '2026-04-05',
                'updated_at'      => '2026-04-05',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 12,
                'descripcion'     => 'Descripcion normatividad 12',
                'created_at'      => '2026-04-14',
                'updated_at'      => '2026-04-14',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 13,
                'descripcion'     => 'Descripcion normatividad 13',
                'created_at'      => '2026-04-23',
                'updated_at'      => '2026-04-23',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 14,
                'descripcion'     => 'Descripcion normatividad 14',
                'created_at'      => '2026-05-02',
                'updated_at'      => '2026-05-02',
                'deleted_at'      => null,
            ],
            [
                'id_normatividad' => 15,
                'descripcion'     => 'Descripcion normatividad 15',
                'created_at'      => '2026-05-11',
                'updated_at'      => '2026-05-11',
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
