<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `amb_estado_doc`.
 */
class AmbEstadoDocSeeder extends Seeder
{
    /**
     * Pobla la tabla `amb_estado_doc` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AmbEncargadosSeeder::class,
            AmbPeriodoAmbSeeder::class,
        ]);

        $tabla = 'amb_estado_doc';

        $llaves = [
            ['id_estado_doc'],
        ];

        $registros = [
            [
                'id_estado_doc'  => 1,
                'id_encargado'   => 1,
                'id_periodo_amb' => 1,
                'estado_envio'   => 1,
                'fecha_registro' => '2026-01-05',
            ],
            [
                'id_estado_doc'  => 2,
                'id_encargado'   => 2,
                'id_periodo_amb' => 2,
                'estado_envio'   => 2,
                'fecha_registro' => '2026-01-14',
            ],
            [
                'id_estado_doc'  => 3,
                'id_encargado'   => 3,
                'id_periodo_amb' => 3,
                'estado_envio'   => 3,
                'fecha_registro' => '2026-01-23',
            ],
            [
                'id_estado_doc'  => 4,
                'id_encargado'   => 4,
                'id_periodo_amb' => 4,
                'estado_envio'   => 4,
                'fecha_registro' => '2026-02-01',
            ],
            [
                'id_estado_doc'  => 5,
                'id_encargado'   => 5,
                'id_periodo_amb' => 5,
                'estado_envio'   => 5,
                'fecha_registro' => '2026-02-10',
            ],
            [
                'id_estado_doc'  => 6,
                'id_encargado'   => 6,
                'id_periodo_amb' => 6,
                'estado_envio'   => 6,
                'fecha_registro' => '2026-02-19',
            ],
            [
                'id_estado_doc'  => 7,
                'id_encargado'   => 7,
                'id_periodo_amb' => 7,
                'estado_envio'   => 7,
                'fecha_registro' => '2026-02-28',
            ],
            [
                'id_estado_doc'  => 8,
                'id_encargado'   => 8,
                'id_periodo_amb' => 8,
                'estado_envio'   => 8,
                'fecha_registro' => '2026-03-09',
            ],
            [
                'id_estado_doc'  => 9,
                'id_encargado'   => 9,
                'id_periodo_amb' => 9,
                'estado_envio'   => 9,
                'fecha_registro' => '2026-03-18',
            ],
            [
                'id_estado_doc'  => 10,
                'id_encargado'   => 10,
                'id_periodo_amb' => 10,
                'estado_envio'   => 10,
                'fecha_registro' => '2026-03-27',
            ],
            [
                'id_estado_doc'  => 11,
                'id_encargado'   => 11,
                'id_periodo_amb' => 11,
                'estado_envio'   => 11,
                'fecha_registro' => '2026-04-05',
            ],
            [
                'id_estado_doc'  => 12,
                'id_encargado'   => 12,
                'id_periodo_amb' => 12,
                'estado_envio'   => 12,
                'fecha_registro' => '2026-04-14',
            ],
            [
                'id_estado_doc'  => 13,
                'id_encargado'   => 13,
                'id_periodo_amb' => 13,
                'estado_envio'   => 13,
                'fecha_registro' => '2026-04-23',
            ],
            [
                'id_estado_doc'  => 14,
                'id_encargado'   => 14,
                'id_periodo_amb' => 14,
                'estado_envio'   => 14,
                'fecha_registro' => '2026-05-02',
            ],
            [
                'id_estado_doc'  => 15,
                'id_encargado'   => 15,
                'id_periodo_amb' => 15,
                'estado_envio'   => 15,
                'fecha_registro' => '2026-05-11',
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
