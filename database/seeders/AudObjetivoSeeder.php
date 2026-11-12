<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_objetivo`.
 */
class AudObjetivoSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_objetivo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_objetivo';

        $llaves = [
            ['id_objetivo'],
        ];

        $registros = [
            [
                'id_objetivo' => 1,
                'descripcion' => 'Descripcion objetivo 1',
                'created_at'  => '2026-01-05',
                'updated_at'  => '2026-01-05',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 2,
                'descripcion' => 'Descripcion objetivo 2',
                'created_at'  => '2026-01-14',
                'updated_at'  => '2026-01-14',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 3,
                'descripcion' => 'Descripcion objetivo 3',
                'created_at'  => '2026-01-23',
                'updated_at'  => '2026-01-23',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 4,
                'descripcion' => 'Descripcion objetivo 4',
                'created_at'  => '2026-02-01',
                'updated_at'  => '2026-02-01',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 5,
                'descripcion' => 'Descripcion objetivo 5',
                'created_at'  => '2026-02-10',
                'updated_at'  => '2026-02-10',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 6,
                'descripcion' => 'Descripcion objetivo 6',
                'created_at'  => '2026-02-19',
                'updated_at'  => '2026-02-19',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 7,
                'descripcion' => 'Descripcion objetivo 7',
                'created_at'  => '2026-02-28',
                'updated_at'  => '2026-02-28',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 8,
                'descripcion' => 'Descripcion objetivo 8',
                'created_at'  => '2026-03-09',
                'updated_at'  => '2026-03-09',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 9,
                'descripcion' => 'Descripcion objetivo 9',
                'created_at'  => '2026-03-18',
                'updated_at'  => '2026-03-18',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 10,
                'descripcion' => 'Descripcion objetivo 10',
                'created_at'  => '2026-03-27',
                'updated_at'  => '2026-03-27',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 11,
                'descripcion' => 'Descripcion objetivo 11',
                'created_at'  => '2026-04-05',
                'updated_at'  => '2026-04-05',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 12,
                'descripcion' => 'Descripcion objetivo 12',
                'created_at'  => '2026-04-14',
                'updated_at'  => '2026-04-14',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 13,
                'descripcion' => 'Descripcion objetivo 13',
                'created_at'  => '2026-04-23',
                'updated_at'  => '2026-04-23',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 14,
                'descripcion' => 'Descripcion objetivo 14',
                'created_at'  => '2026-05-02',
                'updated_at'  => '2026-05-02',
                'deleted_at'  => null,
            ],
            [
                'id_objetivo' => 15,
                'descripcion' => 'Descripcion objetivo 15',
                'created_at'  => '2026-05-11',
                'updated_at'  => '2026-05-11',
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
