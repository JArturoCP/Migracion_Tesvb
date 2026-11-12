<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_archivos`.
 */
class PlanArchivosSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_archivos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_archivos';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'         => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
                'id_temario' => 1,
                'grupo'      => 1,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_1.pdf',
            ],
            [
                'id'         => 2,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
                'id_temario' => 2,
                'grupo'      => 2,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_2.pdf',
            ],
            [
                'id'         => 3,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
                'id_temario' => 3,
                'grupo'      => 3,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_3.pdf',
            ],
            [
                'id'         => 4,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
                'id_temario' => 4,
                'grupo'      => 4,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_4.pdf',
            ],
            [
                'id'         => 5,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
                'id_temario' => 5,
                'grupo'      => 5,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_5.pdf',
            ],
            [
                'id'         => 6,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
                'id_temario' => 6,
                'grupo'      => 6,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_6.pdf',
            ],
            [
                'id'         => 7,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
                'id_temario' => 7,
                'grupo'      => 7,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_7.pdf',
            ],
            [
                'id'         => 8,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
                'id_temario' => 8,
                'grupo'      => 8,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_8.pdf',
            ],
            [
                'id'         => 9,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
                'id_temario' => 9,
                'grupo'      => 9,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_9.pdf',
            ],
            [
                'id'         => 10,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
                'id_temario' => 10,
                'grupo'      => 10,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_10.pdf',
            ],
            [
                'id'         => 11,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
                'id_temario' => 11,
                'grupo'      => 11,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_11.pdf',
            ],
            [
                'id'         => 12,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
                'id_temario' => 12,
                'grupo'      => 12,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_12.pdf',
            ],
            [
                'id'         => 13,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
                'id_temario' => 13,
                'grupo'      => 13,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_13.pdf',
            ],
            [
                'id'         => 14,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
                'id_temario' => 14,
                'grupo'      => 14,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_14.pdf',
            ],
            [
                'id'         => 15,
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
                'id_temario' => 15,
                'grupo'      => 15,
                'archivo'    => 'documentos/plan_archivos/plan_archivos_15.pdf',
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
