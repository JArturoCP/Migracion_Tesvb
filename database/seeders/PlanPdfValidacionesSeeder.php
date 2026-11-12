<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_pdf_validaciones`.
 */
class PlanPdfValidacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_pdf_validaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PdfsSeeder::class,
            PlanEncabezadoSeeder::class,
        ]);

        $tabla = 'plan_pdf_validaciones';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'                 => 1,
                'pdf_id'             => 1,
                'id_plan_encabezado' => 1,
                'id_materia'         => 1,
                'grupo'              => 'Grupo pdf validaci 1',
                'estado_anterior'    => 1,
                'estado_nuevo'       => 1,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 1.',
                'id_usuario'         => 1,
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
            ],
            [
                'id'                 => 2,
                'pdf_id'             => 2,
                'id_plan_encabezado' => 2,
                'id_materia'         => 2,
                'grupo'              => 'Grupo pdf validaci 2',
                'estado_anterior'    => 2,
                'estado_nuevo'       => 2,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 2.',
                'id_usuario'         => 2,
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
            ],
            [
                'id'                 => 3,
                'pdf_id'             => 3,
                'id_plan_encabezado' => 3,
                'id_materia'         => 3,
                'grupo'              => 'Grupo pdf validaci 3',
                'estado_anterior'    => 3,
                'estado_nuevo'       => 3,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 3.',
                'id_usuario'         => 3,
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
            ],
            [
                'id'                 => 4,
                'pdf_id'             => 4,
                'id_plan_encabezado' => 4,
                'id_materia'         => 4,
                'grupo'              => 'Grupo pdf validaci 4',
                'estado_anterior'    => 4,
                'estado_nuevo'       => 4,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 4.',
                'id_usuario'         => 4,
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
            ],
            [
                'id'                 => 5,
                'pdf_id'             => 5,
                'id_plan_encabezado' => 5,
                'id_materia'         => 5,
                'grupo'              => 'Grupo pdf validaci 5',
                'estado_anterior'    => 5,
                'estado_nuevo'       => 5,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 5.',
                'id_usuario'         => 5,
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
            ],
            [
                'id'                 => 6,
                'pdf_id'             => 6,
                'id_plan_encabezado' => 6,
                'id_materia'         => 6,
                'grupo'              => 'Grupo pdf validaci 6',
                'estado_anterior'    => 6,
                'estado_nuevo'       => 6,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 6.',
                'id_usuario'         => 6,
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
            ],
            [
                'id'                 => 7,
                'pdf_id'             => 7,
                'id_plan_encabezado' => 7,
                'id_materia'         => 7,
                'grupo'              => 'Grupo pdf validaci 7',
                'estado_anterior'    => 7,
                'estado_nuevo'       => 7,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 7.',
                'id_usuario'         => 7,
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
            ],
            [
                'id'                 => 8,
                'pdf_id'             => 8,
                'id_plan_encabezado' => 8,
                'id_materia'         => 8,
                'grupo'              => 'Grupo pdf validaci 8',
                'estado_anterior'    => 8,
                'estado_nuevo'       => 8,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 8.',
                'id_usuario'         => 8,
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
            ],
            [
                'id'                 => 9,
                'pdf_id'             => 9,
                'id_plan_encabezado' => 9,
                'id_materia'         => 9,
                'grupo'              => 'Grupo pdf validaci 9',
                'estado_anterior'    => 9,
                'estado_nuevo'       => 9,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 9.',
                'id_usuario'         => 9,
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
            ],
            [
                'id'                 => 10,
                'pdf_id'             => 10,
                'id_plan_encabezado' => 10,
                'id_materia'         => 10,
                'grupo'              => 'Grupo pdf validac 10',
                'estado_anterior'    => 10,
                'estado_nuevo'       => 10,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 10.',
                'id_usuario'         => 10,
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
            ],
            [
                'id'                 => 11,
                'pdf_id'             => 11,
                'id_plan_encabezado' => 11,
                'id_materia'         => 11,
                'grupo'              => 'Grupo pdf validac 11',
                'estado_anterior'    => 11,
                'estado_nuevo'       => 11,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 11.',
                'id_usuario'         => 11,
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
            ],
            [
                'id'                 => 12,
                'pdf_id'             => 12,
                'id_plan_encabezado' => 12,
                'id_materia'         => 12,
                'grupo'              => 'Grupo pdf validac 12',
                'estado_anterior'    => 12,
                'estado_nuevo'       => 12,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 12.',
                'id_usuario'         => 12,
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
            ],
            [
                'id'                 => 13,
                'pdf_id'             => 13,
                'id_plan_encabezado' => 13,
                'id_materia'         => 13,
                'grupo'              => 'Grupo pdf validac 13',
                'estado_anterior'    => 13,
                'estado_nuevo'       => 13,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 13.',
                'id_usuario'         => 13,
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
            ],
            [
                'id'                 => 14,
                'pdf_id'             => 14,
                'id_plan_encabezado' => 14,
                'id_materia'         => 14,
                'grupo'              => 'Grupo pdf validac 14',
                'estado_anterior'    => 14,
                'estado_nuevo'       => 14,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 14.',
                'id_usuario'         => 14,
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
            ],
            [
                'id'                 => 15,
                'pdf_id'             => 15,
                'id_plan_encabezado' => 15,
                'id_materia'         => 15,
                'grupo'              => 'Grupo pdf validac 15',
                'estado_anterior'    => 15,
                'estado_nuevo'       => 15,
                'comentario'         => 'Comentario de pdf validaciones: registro de prueba número 15.',
                'id_usuario'         => 15,
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
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
