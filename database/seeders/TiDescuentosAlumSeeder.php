<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_descuentos_alum`.
 */
class TiDescuentosAlumSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_descuentos_alum` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            TiPreparatatoriaSeeder::class,
            TiTiposDescSeeder::class,
        ]);

        $tabla = 'ti_descuentos_alum';

        $llaves = [
            ['id_descuento_alum'],
        ];

        $registros = [
            [
                'id_descuento_alum'    => 1,
                'id_tipo_desc'         => 1,
                'fecha_registro'       => '2026-01-05',
                'fecha_entrego'        => '2026-01-05',
                'id_alumno'            => 1,
                'telefono'             => '7262600001',
                'id_preparatoria'      => 1,
                'id_liberado'          => 1,
                'fecha_liberacion'     => '2026-01-05',
                'id_liberado_titulado' => 1,
            ],
            [
                'id_descuento_alum'    => 2,
                'id_tipo_desc'         => 2,
                'fecha_registro'       => '2026-01-14',
                'fecha_entrego'        => '2026-01-14',
                'id_alumno'            => 2,
                'telefono'             => '7262600002',
                'id_preparatoria'      => 2,
                'id_liberado'          => 2,
                'fecha_liberacion'     => '2026-01-14',
                'id_liberado_titulado' => 2,
            ],
            [
                'id_descuento_alum'    => 3,
                'id_tipo_desc'         => 3,
                'fecha_registro'       => '2026-01-23',
                'fecha_entrego'        => '2026-01-23',
                'id_alumno'            => 3,
                'telefono'             => '7262600003',
                'id_preparatoria'      => 3,
                'id_liberado'          => 3,
                'fecha_liberacion'     => '2026-01-23',
                'id_liberado_titulado' => 3,
            ],
            [
                'id_descuento_alum'    => 4,
                'id_tipo_desc'         => 4,
                'fecha_registro'       => '2026-02-01',
                'fecha_entrego'        => '2026-02-01',
                'id_alumno'            => 4,
                'telefono'             => '7262600004',
                'id_preparatoria'      => 4,
                'id_liberado'          => 4,
                'fecha_liberacion'     => '2026-02-01',
                'id_liberado_titulado' => 4,
            ],
            [
                'id_descuento_alum'    => 5,
                'id_tipo_desc'         => 5,
                'fecha_registro'       => '2026-02-10',
                'fecha_entrego'        => '2026-02-10',
                'id_alumno'            => 5,
                'telefono'             => '7262600005',
                'id_preparatoria'      => 5,
                'id_liberado'          => 5,
                'fecha_liberacion'     => '2026-02-10',
                'id_liberado_titulado' => 5,
            ],
            [
                'id_descuento_alum'    => 6,
                'id_tipo_desc'         => 6,
                'fecha_registro'       => '2026-02-19',
                'fecha_entrego'        => '2026-02-19',
                'id_alumno'            => 6,
                'telefono'             => '7262600006',
                'id_preparatoria'      => 6,
                'id_liberado'          => 6,
                'fecha_liberacion'     => '2026-02-19',
                'id_liberado_titulado' => 6,
            ],
            [
                'id_descuento_alum'    => 7,
                'id_tipo_desc'         => 7,
                'fecha_registro'       => '2026-02-28',
                'fecha_entrego'        => '2026-02-28',
                'id_alumno'            => 7,
                'telefono'             => '7262600007',
                'id_preparatoria'      => 7,
                'id_liberado'          => 7,
                'fecha_liberacion'     => '2026-02-28',
                'id_liberado_titulado' => 7,
            ],
            [
                'id_descuento_alum'    => 8,
                'id_tipo_desc'         => 8,
                'fecha_registro'       => '2026-03-09',
                'fecha_entrego'        => '2026-03-09',
                'id_alumno'            => 8,
                'telefono'             => '7262600008',
                'id_preparatoria'      => 8,
                'id_liberado'          => 8,
                'fecha_liberacion'     => '2026-03-09',
                'id_liberado_titulado' => 8,
            ],
            [
                'id_descuento_alum'    => 9,
                'id_tipo_desc'         => 9,
                'fecha_registro'       => '2026-03-18',
                'fecha_entrego'        => '2026-03-18',
                'id_alumno'            => 9,
                'telefono'             => '7262600009',
                'id_preparatoria'      => 9,
                'id_liberado'          => 9,
                'fecha_liberacion'     => '2026-03-18',
                'id_liberado_titulado' => 9,
            ],
            [
                'id_descuento_alum'    => 10,
                'id_tipo_desc'         => 10,
                'fecha_registro'       => '2026-03-27',
                'fecha_entrego'        => '2026-03-27',
                'id_alumno'            => 10,
                'telefono'             => '7262600010',
                'id_preparatoria'      => 10,
                'id_liberado'          => 10,
                'fecha_liberacion'     => '2026-03-27',
                'id_liberado_titulado' => 10,
            ],
            [
                'id_descuento_alum'    => 11,
                'id_tipo_desc'         => 11,
                'fecha_registro'       => '2026-04-05',
                'fecha_entrego'        => '2026-04-05',
                'id_alumno'            => 11,
                'telefono'             => '7262600011',
                'id_preparatoria'      => 11,
                'id_liberado'          => 11,
                'fecha_liberacion'     => '2026-04-05',
                'id_liberado_titulado' => 11,
            ],
            [
                'id_descuento_alum'    => 12,
                'id_tipo_desc'         => 12,
                'fecha_registro'       => '2026-04-14',
                'fecha_entrego'        => '2026-04-14',
                'id_alumno'            => 12,
                'telefono'             => '7262600012',
                'id_preparatoria'      => 12,
                'id_liberado'          => 12,
                'fecha_liberacion'     => '2026-04-14',
                'id_liberado_titulado' => 12,
            ],
            [
                'id_descuento_alum'    => 13,
                'id_tipo_desc'         => 13,
                'fecha_registro'       => '2026-04-23',
                'fecha_entrego'        => '2026-04-23',
                'id_alumno'            => 13,
                'telefono'             => '7262600013',
                'id_preparatoria'      => 13,
                'id_liberado'          => 13,
                'fecha_liberacion'     => '2026-04-23',
                'id_liberado_titulado' => 13,
            ],
            [
                'id_descuento_alum'    => 14,
                'id_tipo_desc'         => 14,
                'fecha_registro'       => '2026-05-02',
                'fecha_entrego'        => '2026-05-02',
                'id_alumno'            => 14,
                'telefono'             => '7262600014',
                'id_preparatoria'      => 14,
                'id_liberado'          => 14,
                'fecha_liberacion'     => '2026-05-02',
                'id_liberado_titulado' => 14,
            ],
            [
                'id_descuento_alum'    => 15,
                'id_tipo_desc'         => 15,
                'fecha_registro'       => '2026-05-11',
                'fecha_entrego'        => '2026-05-11',
                'id_alumno'            => 15,
                'telefono'             => '7262600015',
                'id_preparatoria'      => 15,
                'id_liberado'          => 15,
                'fecha_liberacion'     => '2026-05-11',
                'id_liberado_titulado' => 15,
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
