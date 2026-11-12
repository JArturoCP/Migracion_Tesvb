<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `amb_periodo_amb`.
 */
class AmbPeriodoAmbSeeder extends Seeder
{
    /**
     * Pobla la tabla `amb_periodo_amb` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'amb_periodo_amb';

        $llaves = [
            ['id_periodo_amb'],
        ];

        $registros = [
            [
                'id_periodo_amb'     => 1,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 1.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 1,
                'estado_periodo'     => 1,
                'fecha_registro'     => '2026-01-05',
            ],
            [
                'id_periodo_amb'     => 2,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 2.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 2,
                'estado_periodo'     => 2,
                'fecha_registro'     => '2026-01-14',
            ],
            [
                'id_periodo_amb'     => 3,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 3.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 3,
                'estado_periodo'     => 3,
                'fecha_registro'     => '2026-01-23',
            ],
            [
                'id_periodo_amb'     => 4,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 4.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 4,
                'estado_periodo'     => 4,
                'fecha_registro'     => '2026-02-01',
            ],
            [
                'id_periodo_amb'     => 5,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 5.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 5,
                'estado_periodo'     => 5,
                'fecha_registro'     => '2026-02-10',
            ],
            [
                'id_periodo_amb'     => 6,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 6.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 6,
                'estado_periodo'     => 6,
                'fecha_registro'     => '2026-02-19',
            ],
            [
                'id_periodo_amb'     => 7,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 7.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 7,
                'estado_periodo'     => 7,
                'fecha_registro'     => '2026-02-28',
            ],
            [
                'id_periodo_amb'     => 8,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 8.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 8,
                'estado_periodo'     => 8,
                'fecha_registro'     => '2026-03-09',
            ],
            [
                'id_periodo_amb'     => 9,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 9.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 9,
                'estado_periodo'     => 9,
                'fecha_registro'     => '2026-03-18',
            ],
            [
                'id_periodo_amb'     => 10,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 10.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 10,
                'estado_periodo'     => 10,
                'fecha_registro'     => '2026-03-27',
            ],
            [
                'id_periodo_amb'     => 11,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 11.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 11,
                'estado_periodo'     => 11,
                'fecha_registro'     => '2026-04-05',
            ],
            [
                'id_periodo_amb'     => 12,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 12.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 12,
                'estado_periodo'     => 12,
                'fecha_registro'     => '2026-04-14',
            ],
            [
                'id_periodo_amb'     => 13,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 13.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 1,
                'estado_periodo'     => 13,
                'fecha_registro'     => '2026-04-23',
            ],
            [
                'id_periodo_amb'     => 14,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 14.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 2,
                'estado_periodo'     => 14,
                'fecha_registro'     => '2026-05-02',
            ],
            [
                'id_periodo_amb'     => 15,
                'nombre_periodo_amb' => 'Nombre periodo amb de periodo amb: registro de prueba número 15.',
                'fecha_an'           => 2026,
                'fecha_mes'          => 3,
                'estado_periodo'     => 15,
                'fecha_registro'     => '2026-05-11',
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
