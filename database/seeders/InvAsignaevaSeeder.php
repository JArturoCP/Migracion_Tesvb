<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_asignaeva`.
 */
class InvAsignaevaSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_asignaeva` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvInvestigadoresSeeder::class,
        ]);

        $tabla = 'inv_asignaeva';

        $llaves = [
            ['id_asignaeva'],
        ];

        $registros = [
            [
                'id_asignaeva'     => 1,
                'propietario_id'   => 1,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 1,
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 2,
                'propietario_id'   => 2,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 2,
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 3,
                'propietario_id'   => 3,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 3,
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 4,
                'propietario_id'   => 4,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 4,
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 5,
                'propietario_id'   => 5,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 5,
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 6,
                'propietario_id'   => 6,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 6,
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 7,
                'propietario_id'   => 7,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 7,
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 8,
                'propietario_id'   => 8,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 8,
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 9,
                'propietario_id'   => 9,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 9,
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 10,
                'propietario_id'   => 10,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 10,
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 11,
                'propietario_id'   => 11,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 11,
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 12,
                'propietario_id'   => 12,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 12,
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 13,
                'propietario_id'   => 13,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 13,
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 14,
                'propietario_id'   => 14,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 14,
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_asignaeva'     => 15,
                'propietario_id'   => 15,
                'propietario_type' => 'App\\User',
                'id_investigador'  => 15,
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
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
