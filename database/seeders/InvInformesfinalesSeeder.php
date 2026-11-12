<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_informesfinales`.
 */
class InvInformesfinalesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_informesfinales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_informesfinales';

        $llaves = [
            ['id_informefinal'],
        ];

        $registros = [
            [
                'id_informefinal' => 1,
                'id_protocolo'    => 1,
                'fecha'           => '2026-01-05',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 2,
                'id_protocolo'    => 2,
                'fecha'           => '2026-01-14',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 3,
                'id_protocolo'    => 3,
                'fecha'           => '2026-01-23',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 4,
                'id_protocolo'    => 4,
                'fecha'           => '2026-02-01',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 5,
                'id_protocolo'    => 5,
                'fecha'           => '2026-02-10',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 6,
                'id_protocolo'    => 6,
                'fecha'           => '2026-02-19',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 7,
                'id_protocolo'    => 7,
                'fecha'           => '2026-02-28',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 8,
                'id_protocolo'    => 8,
                'fecha'           => '2026-03-09',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 9,
                'id_protocolo'    => 9,
                'fecha'           => '2026-03-18',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 10,
                'id_protocolo'    => 10,
                'fecha'           => '2026-03-27',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 11,
                'id_protocolo'    => 11,
                'fecha'           => '2026-04-05',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 12,
                'id_protocolo'    => 12,
                'fecha'           => '2026-04-14',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 13,
                'id_protocolo'    => 13,
                'fecha'           => '2026-04-23',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 14,
                'id_protocolo'    => 14,
                'fecha'           => '2026-05-02',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_informefinal' => 15,
                'id_protocolo'    => 15,
                'fecha'           => '2026-05-11',
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
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
