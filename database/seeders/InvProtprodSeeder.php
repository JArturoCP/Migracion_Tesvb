<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_protprod`.
 */
class InvProtprodSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_protprod` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_protprod';

        $llaves = [
            ['id_protprod'],
        ];

        $registros = [
            [
                'id_protprod'      => 1,
                'id_protocolo'     => 1,
                'id_productoe'     => 1,
                'fecha'            => '2026-01-05',
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 1500.0,
            ],
            [
                'id_protprod'      => 2,
                'id_protocolo'     => 2,
                'id_productoe'     => 2,
                'fecha'            => '2026-01-14',
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 3000.0,
            ],
            [
                'id_protprod'      => 3,
                'id_protocolo'     => 3,
                'id_productoe'     => 3,
                'fecha'            => '2026-01-23',
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 4500.0,
            ],
            [
                'id_protprod'      => 4,
                'id_protocolo'     => 4,
                'id_productoe'     => 4,
                'fecha'            => '2026-02-01',
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 6000.0,
            ],
            [
                'id_protprod'      => 5,
                'id_protocolo'     => 5,
                'id_productoe'     => 5,
                'fecha'            => '2026-02-10',
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 7500.0,
            ],
            [
                'id_protprod'      => 6,
                'id_protocolo'     => 6,
                'id_productoe'     => 6,
                'fecha'            => '2026-02-19',
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 9000.0,
            ],
            [
                'id_protprod'      => 7,
                'id_protocolo'     => 7,
                'id_productoe'     => 7,
                'fecha'            => '2026-02-28',
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 10500.0,
            ],
            [
                'id_protprod'      => 8,
                'id_protocolo'     => 8,
                'id_productoe'     => 8,
                'fecha'            => '2026-03-09',
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 12000.0,
            ],
            [
                'id_protprod'      => 9,
                'id_protocolo'     => 9,
                'id_productoe'     => 9,
                'fecha'            => '2026-03-18',
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 13500.0,
            ],
            [
                'id_protprod'      => 10,
                'id_protocolo'     => 10,
                'id_productoe'     => 10,
                'fecha'            => '2026-03-27',
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 15000.0,
            ],
            [
                'id_protprod'      => 11,
                'id_protocolo'     => 11,
                'id_productoe'     => 11,
                'fecha'            => '2026-04-05',
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 16500.0,
            ],
            [
                'id_protprod'      => 12,
                'id_protocolo'     => 12,
                'id_productoe'     => 12,
                'fecha'            => '2026-04-14',
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 18000.0,
            ],
            [
                'id_protprod'      => 13,
                'id_protocolo'     => 13,
                'id_productoe'     => 13,
                'fecha'            => '2026-04-23',
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 19500.0,
            ],
            [
                'id_protprod'      => 14,
                'id_protocolo'     => 14,
                'id_productoe'     => 14,
                'fecha'            => '2026-05-02',
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 21000.0,
            ],
            [
                'id_protprod'      => 15,
                'id_protocolo'     => 15,
                'id_productoe'     => 15,
                'fecha'            => '2026-05-11',
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'deleted_at'       => null,
                'monto_solicitado' => 22500.0,
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
