<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_clasificacion`.
 */
class AudClasificacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_clasificacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'aud_clasificacion';

        $llaves = [
            ['id_clasificacion'],
        ];

        $registros = [
            [
                'id_clasificacion' => 1,
                'descripcion'      => 'Descripcion clasificaci 1',
                'created_at'       => '2026-01-05',
                'updated_at'       => '2026-01-05',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 2,
                'descripcion'      => 'Descripcion clasificaci 2',
                'created_at'       => '2026-01-14',
                'updated_at'       => '2026-01-14',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 3,
                'descripcion'      => 'Descripcion clasificaci 3',
                'created_at'       => '2026-01-23',
                'updated_at'       => '2026-01-23',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 4,
                'descripcion'      => 'Descripcion clasificaci 4',
                'created_at'       => '2026-02-01',
                'updated_at'       => '2026-02-01',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 5,
                'descripcion'      => 'Descripcion clasificaci 5',
                'created_at'       => '2026-02-10',
                'updated_at'       => '2026-02-10',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 6,
                'descripcion'      => 'Descripcion clasificaci 6',
                'created_at'       => '2026-02-19',
                'updated_at'       => '2026-02-19',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 7,
                'descripcion'      => 'Descripcion clasificaci 7',
                'created_at'       => '2026-02-28',
                'updated_at'       => '2026-02-28',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 8,
                'descripcion'      => 'Descripcion clasificaci 8',
                'created_at'       => '2026-03-09',
                'updated_at'       => '2026-03-09',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 9,
                'descripcion'      => 'Descripcion clasificaci 9',
                'created_at'       => '2026-03-18',
                'updated_at'       => '2026-03-18',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 10,
                'descripcion'      => 'Descripcion clasificac 10',
                'created_at'       => '2026-03-27',
                'updated_at'       => '2026-03-27',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 11,
                'descripcion'      => 'Descripcion clasificac 11',
                'created_at'       => '2026-04-05',
                'updated_at'       => '2026-04-05',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 12,
                'descripcion'      => 'Descripcion clasificac 12',
                'created_at'       => '2026-04-14',
                'updated_at'       => '2026-04-14',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 13,
                'descripcion'      => 'Descripcion clasificac 13',
                'created_at'       => '2026-04-23',
                'updated_at'       => '2026-04-23',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 14,
                'descripcion'      => 'Descripcion clasificac 14',
                'created_at'       => '2026-05-02',
                'updated_at'       => '2026-05-02',
                'deleted_at'       => null,
            ],
            [
                'id_clasificacion' => 15,
                'descripcion'      => 'Descripcion clasificac 15',
                'created_at'       => '2026-05-11',
                'updated_at'       => '2026-05-11',
                'deleted_at'       => null,
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
