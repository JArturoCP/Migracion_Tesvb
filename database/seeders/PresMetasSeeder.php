<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_metas`.
 */
class PresMetasSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_metas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresProyectosSeeder::class,
        ]);

        $tabla = 'pres_metas';

        $llaves = [
            ['id_meta'],
        ];

        $registros = [
            [
                'id_meta'            => 1,
                'meta'               => 'Meta de metas: registro de prueba número 1.',
                'id_proyecto'        => 1,
                'fecha_registro'     => '2026-01-05',
                'fecha_modificacion' => '2026-01-05',
            ],
            [
                'id_meta'            => 2,
                'meta'               => 'Meta de metas: registro de prueba número 2.',
                'id_proyecto'        => 2,
                'fecha_registro'     => '2026-01-14',
                'fecha_modificacion' => '2026-01-14',
            ],
            [
                'id_meta'            => 3,
                'meta'               => 'Meta de metas: registro de prueba número 3.',
                'id_proyecto'        => 3,
                'fecha_registro'     => '2026-01-23',
                'fecha_modificacion' => '2026-01-23',
            ],
            [
                'id_meta'            => 4,
                'meta'               => 'Meta de metas: registro de prueba número 4.',
                'id_proyecto'        => 4,
                'fecha_registro'     => '2026-02-01',
                'fecha_modificacion' => '2026-02-01',
            ],
            [
                'id_meta'            => 5,
                'meta'               => 'Meta de metas: registro de prueba número 5.',
                'id_proyecto'        => 5,
                'fecha_registro'     => '2026-02-10',
                'fecha_modificacion' => '2026-02-10',
            ],
            [
                'id_meta'            => 6,
                'meta'               => 'Meta de metas: registro de prueba número 6.',
                'id_proyecto'        => 6,
                'fecha_registro'     => '2026-02-19',
                'fecha_modificacion' => '2026-02-19',
            ],
            [
                'id_meta'            => 7,
                'meta'               => 'Meta de metas: registro de prueba número 7.',
                'id_proyecto'        => 7,
                'fecha_registro'     => '2026-02-28',
                'fecha_modificacion' => '2026-02-28',
            ],
            [
                'id_meta'            => 8,
                'meta'               => 'Meta de metas: registro de prueba número 8.',
                'id_proyecto'        => 8,
                'fecha_registro'     => '2026-03-09',
                'fecha_modificacion' => '2026-03-09',
            ],
            [
                'id_meta'            => 9,
                'meta'               => 'Meta de metas: registro de prueba número 9.',
                'id_proyecto'        => 9,
                'fecha_registro'     => '2026-03-18',
                'fecha_modificacion' => '2026-03-18',
            ],
            [
                'id_meta'            => 10,
                'meta'               => 'Meta de metas: registro de prueba número 10.',
                'id_proyecto'        => 10,
                'fecha_registro'     => '2026-03-27',
                'fecha_modificacion' => '2026-03-27',
            ],
            [
                'id_meta'            => 11,
                'meta'               => 'Meta de metas: registro de prueba número 11.',
                'id_proyecto'        => 11,
                'fecha_registro'     => '2026-04-05',
                'fecha_modificacion' => '2026-04-05',
            ],
            [
                'id_meta'            => 12,
                'meta'               => 'Meta de metas: registro de prueba número 12.',
                'id_proyecto'        => 12,
                'fecha_registro'     => '2026-04-14',
                'fecha_modificacion' => '2026-04-14',
            ],
            [
                'id_meta'            => 13,
                'meta'               => 'Meta de metas: registro de prueba número 13.',
                'id_proyecto'        => 13,
                'fecha_registro'     => '2026-04-23',
                'fecha_modificacion' => '2026-04-23',
            ],
            [
                'id_meta'            => 14,
                'meta'               => 'Meta de metas: registro de prueba número 14.',
                'id_proyecto'        => 14,
                'fecha_registro'     => '2026-05-02',
                'fecha_modificacion' => '2026-05-02',
            ],
            [
                'id_meta'            => 15,
                'meta'               => 'Meta de metas: registro de prueba número 15.',
                'id_proyecto'        => 15,
                'fecha_registro'     => '2026-05-11',
                'fecha_modificacion' => '2026-05-11',
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
