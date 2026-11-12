<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_aspectos`.
 */
class InvAspectosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_aspectos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_aspectos';

        $llaves = [
            ['id_aspecto'],
        ];

        $registros = [
            [
                'id_aspecto'    => 1,
                'descripcion_a' => 'Descripcion a aspectos 1',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 2,
                'descripcion_a' => 'Descripcion a aspectos 2',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 3,
                'descripcion_a' => 'Descripcion a aspectos 3',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 4,
                'descripcion_a' => 'Descripcion a aspectos 4',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 5,
                'descripcion_a' => 'Descripcion a aspectos 5',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 6,
                'descripcion_a' => 'Descripcion a aspectos 6',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 7,
                'descripcion_a' => 'Descripcion a aspectos 7',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 8,
                'descripcion_a' => 'Descripcion a aspectos 8',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 9,
                'descripcion_a' => 'Descripcion a aspectos 9',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 10,
                'descripcion_a' => 'Descripcion a aspectos 10',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 11,
                'descripcion_a' => 'Descripcion a aspectos 11',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 12,
                'descripcion_a' => 'Descripcion a aspectos 12',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 13,
                'descripcion_a' => 'Descripcion a aspectos 13',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 14,
                'descripcion_a' => 'Descripcion a aspectos 14',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_aspecto'    => 15,
                'descripcion_a' => 'Descripcion a aspectos 15',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
