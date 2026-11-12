<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_colaboradores`.
 */
class InvColaboradoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_colaboradores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvInvestigadoresSeeder::class,
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_colaboradores';

        $llaves = [
            ['id_protocoloinv'],
        ];

        $registros = [
            [
                'id_protocoloinv' => 1,
                'id_protocolo'    => 1,
                'id_investigador' => 1,
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 2,
                'id_protocolo'    => 2,
                'id_investigador' => 2,
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 3,
                'id_protocolo'    => 3,
                'id_investigador' => 3,
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 4,
                'id_protocolo'    => 4,
                'id_investigador' => 4,
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 5,
                'id_protocolo'    => 5,
                'id_investigador' => 5,
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 6,
                'id_protocolo'    => 6,
                'id_investigador' => 6,
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 7,
                'id_protocolo'    => 7,
                'id_investigador' => 7,
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 8,
                'id_protocolo'    => 8,
                'id_investigador' => 8,
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 9,
                'id_protocolo'    => 9,
                'id_investigador' => 9,
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 10,
                'id_protocolo'    => 10,
                'id_investigador' => 10,
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 11,
                'id_protocolo'    => 11,
                'id_investigador' => 11,
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 12,
                'id_protocolo'    => 12,
                'id_investigador' => 12,
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 13,
                'id_protocolo'    => 13,
                'id_investigador' => 13,
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 14,
                'id_protocolo'    => 14,
                'id_investigador' => 14,
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
            ],
            [
                'id_protocoloinv' => 15,
                'id_protocolo'    => 15,
                'id_investigador' => 15,
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
