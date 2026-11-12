<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_investigador_estudiante`.
 */
class InvInvestigadorEstudianteSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_investigador_estudiante` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_investigador_estudiante';

        $llaves = [
            ['id_inv_estu'],
        ];

        $registros = [
            [
                'id_inv_estu'  => 1,
                'id_protocolo' => 1,
                'id_usuario'   => 1,
                'created_at'   => '2026-01-05 09:00:00',
                'updated_at'   => '2026-01-05 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 2,
                'id_protocolo' => 2,
                'id_usuario'   => 2,
                'created_at'   => '2026-01-14 10:00:00',
                'updated_at'   => '2026-01-14 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 3,
                'id_protocolo' => 3,
                'id_usuario'   => 3,
                'created_at'   => '2026-01-23 11:00:00',
                'updated_at'   => '2026-01-23 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 4,
                'id_protocolo' => 4,
                'id_usuario'   => 4,
                'created_at'   => '2026-02-01 12:00:00',
                'updated_at'   => '2026-02-01 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 5,
                'id_protocolo' => 5,
                'id_usuario'   => 5,
                'created_at'   => '2026-02-10 13:00:00',
                'updated_at'   => '2026-02-10 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 6,
                'id_protocolo' => 6,
                'id_usuario'   => 6,
                'created_at'   => '2026-02-19 14:00:00',
                'updated_at'   => '2026-02-19 14:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 7,
                'id_protocolo' => 7,
                'id_usuario'   => 7,
                'created_at'   => '2026-02-28 15:00:00',
                'updated_at'   => '2026-02-28 15:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 8,
                'id_protocolo' => 8,
                'id_usuario'   => 8,
                'created_at'   => '2026-03-09 16:00:00',
                'updated_at'   => '2026-03-09 16:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 9,
                'id_protocolo' => 9,
                'id_usuario'   => 9,
                'created_at'   => '2026-03-18 08:00:00',
                'updated_at'   => '2026-03-18 08:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 10,
                'id_protocolo' => 10,
                'id_usuario'   => 10,
                'created_at'   => '2026-03-27 09:00:00',
                'updated_at'   => '2026-03-27 09:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 11,
                'id_protocolo' => 11,
                'id_usuario'   => 11,
                'created_at'   => '2026-04-05 10:00:00',
                'updated_at'   => '2026-04-05 10:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 12,
                'id_protocolo' => 12,
                'id_usuario'   => 12,
                'created_at'   => '2026-04-14 11:00:00',
                'updated_at'   => '2026-04-14 11:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 13,
                'id_protocolo' => 13,
                'id_usuario'   => 13,
                'created_at'   => '2026-04-23 12:00:00',
                'updated_at'   => '2026-04-23 12:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 14,
                'id_protocolo' => 14,
                'id_usuario'   => 14,
                'created_at'   => '2026-05-02 13:00:00',
                'updated_at'   => '2026-05-02 13:00:00',
                'deleted_at'   => null,
            ],
            [
                'id_inv_estu'  => 15,
                'id_protocolo' => 15,
                'id_usuario'   => 15,
                'created_at'   => '2026-05-11 14:00:00',
                'updated_at'   => '2026-05-11 14:00:00',
                'deleted_at'   => null,
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
