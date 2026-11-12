<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_estado`.
 */
class InvEstadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_estado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_estado';

        $llaves = [
            ['id_productose'],
        ];

        $registros = [
            [
                'id_productose'  => 1,
                'descripcion_pe' => 'Descripcion pe estado 1',
                'estado'         => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 2,
                'descripcion_pe' => 'Descripcion pe estado 2',
                'estado'         => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 3,
                'descripcion_pe' => 'Descripcion pe estado 3',
                'estado'         => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 4,
                'descripcion_pe' => 'Descripcion pe estado 4',
                'estado'         => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 5,
                'descripcion_pe' => 'Descripcion pe estado 5',
                'estado'         => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 6,
                'descripcion_pe' => 'Descripcion pe estado 6',
                'estado'         => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 7,
                'descripcion_pe' => 'Descripcion pe estado 7',
                'estado'         => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 8,
                'descripcion_pe' => 'Descripcion pe estado 8',
                'estado'         => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 9,
                'descripcion_pe' => 'Descripcion pe estado 9',
                'estado'         => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 10,
                'descripcion_pe' => 'Descripcion pe estado 10',
                'estado'         => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 11,
                'descripcion_pe' => 'Descripcion pe estado 11',
                'estado'         => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 12,
                'descripcion_pe' => 'Descripcion pe estado 12',
                'estado'         => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 13,
                'descripcion_pe' => 'Descripcion pe estado 13',
                'estado'         => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 14,
                'descripcion_pe' => 'Descripcion pe estado 14',
                'estado'         => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_productose'  => 15,
                'descripcion_pe' => 'Descripcion pe estado 15',
                'estado'         => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'deleted_at'     => null,
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
