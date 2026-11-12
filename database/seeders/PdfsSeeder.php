<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pdfs`.
 */
class PdfsSeeder extends Seeder
{
    /**
     * Pobla la tabla `pdfs` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralGruposSeeder::class,
        ]);

        $tabla = 'pdfs';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'                 => 1,
                'id_materia'         => 1,
                'file_name'          => 'documentos/pdfs/pdfs_1.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_1.pdf',
                'created_at'         => '2026-01-05 09:00:00',
                'updated_at'         => '2026-01-05 09:00:00',
                'id_grupo'           => 1,
                'id_estado'          => 1,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 1.',
                'id_plan_encabezado' => 1,
            ],
            [
                'id'                 => 2,
                'id_materia'         => 2,
                'file_name'          => 'documentos/pdfs/pdfs_2.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_2.pdf',
                'created_at'         => '2026-01-14 10:00:00',
                'updated_at'         => '2026-01-14 10:00:00',
                'id_grupo'           => 2,
                'id_estado'          => 2,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 2.',
                'id_plan_encabezado' => 2,
            ],
            [
                'id'                 => 3,
                'id_materia'         => 3,
                'file_name'          => 'documentos/pdfs/pdfs_3.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_3.pdf',
                'created_at'         => '2026-01-23 11:00:00',
                'updated_at'         => '2026-01-23 11:00:00',
                'id_grupo'           => 3,
                'id_estado'          => 3,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 3.',
                'id_plan_encabezado' => 3,
            ],
            [
                'id'                 => 4,
                'id_materia'         => 4,
                'file_name'          => 'documentos/pdfs/pdfs_4.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_4.pdf',
                'created_at'         => '2026-02-01 12:00:00',
                'updated_at'         => '2026-02-01 12:00:00',
                'id_grupo'           => 4,
                'id_estado'          => 4,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 4.',
                'id_plan_encabezado' => 4,
            ],
            [
                'id'                 => 5,
                'id_materia'         => 5,
                'file_name'          => 'documentos/pdfs/pdfs_5.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_5.pdf',
                'created_at'         => '2026-02-10 13:00:00',
                'updated_at'         => '2026-02-10 13:00:00',
                'id_grupo'           => 5,
                'id_estado'          => 5,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 5.',
                'id_plan_encabezado' => 5,
            ],
            [
                'id'                 => 6,
                'id_materia'         => 6,
                'file_name'          => 'documentos/pdfs/pdfs_6.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_6.pdf',
                'created_at'         => '2026-02-19 14:00:00',
                'updated_at'         => '2026-02-19 14:00:00',
                'id_grupo'           => 6,
                'id_estado'          => 6,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 6.',
                'id_plan_encabezado' => 6,
            ],
            [
                'id'                 => 7,
                'id_materia'         => 7,
                'file_name'          => 'documentos/pdfs/pdfs_7.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_7.pdf',
                'created_at'         => '2026-02-28 15:00:00',
                'updated_at'         => '2026-02-28 15:00:00',
                'id_grupo'           => 7,
                'id_estado'          => 7,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 7.',
                'id_plan_encabezado' => 7,
            ],
            [
                'id'                 => 8,
                'id_materia'         => 8,
                'file_name'          => 'documentos/pdfs/pdfs_8.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_8.pdf',
                'created_at'         => '2026-03-09 16:00:00',
                'updated_at'         => '2026-03-09 16:00:00',
                'id_grupo'           => 8,
                'id_estado'          => 8,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 8.',
                'id_plan_encabezado' => 8,
            ],
            [
                'id'                 => 9,
                'id_materia'         => 9,
                'file_name'          => 'documentos/pdfs/pdfs_9.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_9.pdf',
                'created_at'         => '2026-03-18 08:00:00',
                'updated_at'         => '2026-03-18 08:00:00',
                'id_grupo'           => 9,
                'id_estado'          => 9,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 9.',
                'id_plan_encabezado' => 9,
            ],
            [
                'id'                 => 10,
                'id_materia'         => 10,
                'file_name'          => 'documentos/pdfs/pdfs_10.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_10.pdf',
                'created_at'         => '2026-03-27 09:00:00',
                'updated_at'         => '2026-03-27 09:00:00',
                'id_grupo'           => 10,
                'id_estado'          => 10,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 10.',
                'id_plan_encabezado' => 10,
            ],
            [
                'id'                 => 11,
                'id_materia'         => 11,
                'file_name'          => 'documentos/pdfs/pdfs_11.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_11.pdf',
                'created_at'         => '2026-04-05 10:00:00',
                'updated_at'         => '2026-04-05 10:00:00',
                'id_grupo'           => 11,
                'id_estado'          => 11,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 11.',
                'id_plan_encabezado' => 11,
            ],
            [
                'id'                 => 12,
                'id_materia'         => 12,
                'file_name'          => 'documentos/pdfs/pdfs_12.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_12.pdf',
                'created_at'         => '2026-04-14 11:00:00',
                'updated_at'         => '2026-04-14 11:00:00',
                'id_grupo'           => 12,
                'id_estado'          => 12,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 12.',
                'id_plan_encabezado' => 12,
            ],
            [
                'id'                 => 13,
                'id_materia'         => 13,
                'file_name'          => 'documentos/pdfs/pdfs_13.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_13.pdf',
                'created_at'         => '2026-04-23 12:00:00',
                'updated_at'         => '2026-04-23 12:00:00',
                'id_grupo'           => 13,
                'id_estado'          => 13,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 13.',
                'id_plan_encabezado' => 13,
            ],
            [
                'id'                 => 14,
                'id_materia'         => 14,
                'file_name'          => 'documentos/pdfs/pdfs_14.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_14.pdf',
                'created_at'         => '2026-05-02 13:00:00',
                'updated_at'         => '2026-05-02 13:00:00',
                'id_grupo'           => 14,
                'id_estado'          => 14,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 14.',
                'id_plan_encabezado' => 14,
            ],
            [
                'id'                 => 15,
                'id_materia'         => 15,
                'file_name'          => 'documentos/pdfs/pdfs_15.pdf',
                'file_path'          => 'documentos/pdfs/pdfs_15.pdf',
                'created_at'         => '2026-05-11 14:00:00',
                'updated_at'         => '2026-05-11 14:00:00',
                'id_grupo'           => 15,
                'id_estado'          => 15,
                'comentario'         => 'Comentario de pdfs: registro de prueba número 15.',
                'id_plan_encabezado' => 15,
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
