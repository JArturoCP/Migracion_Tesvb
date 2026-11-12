<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_productose`.
 */
class InvProductoseSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_productose` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_productose';

        $llaves = [
            ['id_productose'],
        ];

        $registros = [
            [
                'id_productose'  => 1,
                'descripcion_pe' => 'Descripcion pe productose 1',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 1.',
                'estado'         => 1,
                'updated_at'     => '2026-01-05 09:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-01-05 09:00:00',
            ],
            [
                'id_productose'  => 2,
                'descripcion_pe' => 'Descripcion pe productose 2',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 2.',
                'estado'         => 2,
                'updated_at'     => '2026-01-14 10:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-01-14 10:00:00',
            ],
            [
                'id_productose'  => 3,
                'descripcion_pe' => 'Descripcion pe productose 3',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 3.',
                'estado'         => 3,
                'updated_at'     => '2026-01-23 11:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-01-23 11:00:00',
            ],
            [
                'id_productose'  => 4,
                'descripcion_pe' => 'Descripcion pe productose 4',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 4.',
                'estado'         => 4,
                'updated_at'     => '2026-02-01 12:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-02-01 12:00:00',
            ],
            [
                'id_productose'  => 5,
                'descripcion_pe' => 'Descripcion pe productose 5',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 5.',
                'estado'         => 5,
                'updated_at'     => '2026-02-10 13:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-02-10 13:00:00',
            ],
            [
                'id_productose'  => 6,
                'descripcion_pe' => 'Descripcion pe productose 6',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 6.',
                'estado'         => 6,
                'updated_at'     => '2026-02-19 14:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-02-19 14:00:00',
            ],
            [
                'id_productose'  => 7,
                'descripcion_pe' => 'Descripcion pe productose 7',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 7.',
                'estado'         => 7,
                'updated_at'     => '2026-02-28 15:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-02-28 15:00:00',
            ],
            [
                'id_productose'  => 8,
                'descripcion_pe' => 'Descripcion pe productose 8',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 8.',
                'estado'         => 8,
                'updated_at'     => '2026-03-09 16:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-03-09 16:00:00',
            ],
            [
                'id_productose'  => 9,
                'descripcion_pe' => 'Descripcion pe productose 9',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 9.',
                'estado'         => 9,
                'updated_at'     => '2026-03-18 08:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-03-18 08:00:00',
            ],
            [
                'id_productose'  => 10,
                'descripcion_pe' => 'Descripcion pe productose 10',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 10.',
                'estado'         => 10,
                'updated_at'     => '2026-03-27 09:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-03-27 09:00:00',
            ],
            [
                'id_productose'  => 11,
                'descripcion_pe' => 'Descripcion pe productose 11',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 11.',
                'estado'         => 11,
                'updated_at'     => '2026-04-05 10:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-04-05 10:00:00',
            ],
            [
                'id_productose'  => 12,
                'descripcion_pe' => 'Descripcion pe productose 12',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 12.',
                'estado'         => 12,
                'updated_at'     => '2026-04-14 11:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-04-14 11:00:00',
            ],
            [
                'id_productose'  => 13,
                'descripcion_pe' => 'Descripcion pe productose 13',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 13.',
                'estado'         => 13,
                'updated_at'     => '2026-04-23 12:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-04-23 12:00:00',
            ],
            [
                'id_productose'  => 14,
                'descripcion_pe' => 'Descripcion pe productose 14',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 14.',
                'estado'         => 14,
                'updated_at'     => '2026-05-02 13:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-05-02 13:00:00',
            ],
            [
                'id_productose'  => 15,
                'descripcion_pe' => 'Descripcion pe productose 15',
                'fundamento'     => 'Fundamento de productose: registro de prueba número 15.',
                'estado'         => 15,
                'updated_at'     => '2026-05-11 14:00:00',
                'deleted_at'     => null,
                'created_at'     => '2026-05-11 14:00:00',
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
