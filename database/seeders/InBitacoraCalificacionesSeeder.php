<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_bitacora_calificaciones`.
 */
class InBitacoraCalificacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_bitacora_calificaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            GnralPeriodosSeeder::class,
            InCargaAcademicaInglesSeeder::class,
        ]);

        $tabla = 'in_bitacora_calificaciones';

        $llaves = [
            ['id_bitacora_calificaciones'],
        ];

        $registros = [
            [
                'id_bitacora_calificaciones' => 1,
                'id_unidad'                  => 1,
                'id_carga_ingles'            => 1,
                'fecha_modificacion'         => '2026-01-05 09:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 1,
                'calificacion_registrada'    => 77,
                'calificacion_anterior'      => 77,
            ],
            [
                'id_bitacora_calificaciones' => 2,
                'id_unidad'                  => 2,
                'id_carga_ingles'            => 2,
                'fecha_modificacion'         => '2026-01-14 10:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 2,
                'calificacion_registrada'    => 84,
                'calificacion_anterior'      => 84,
            ],
            [
                'id_bitacora_calificaciones' => 3,
                'id_unidad'                  => 3,
                'id_carga_ingles'            => 3,
                'fecha_modificacion'         => '2026-01-23 11:00:00',
                'id_periodo'                 => 3,
                'id_profesor'                => 3,
                'calificacion_registrada'    => 91,
                'calificacion_anterior'      => 91,
            ],
            [
                'id_bitacora_calificaciones' => 4,
                'id_unidad'                  => 4,
                'id_carga_ingles'            => 4,
                'fecha_modificacion'         => '2026-02-01 12:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 4,
                'calificacion_registrada'    => 98,
                'calificacion_anterior'      => 98,
            ],
            [
                'id_bitacora_calificaciones' => 5,
                'id_unidad'                  => 5,
                'id_carga_ingles'            => 5,
                'fecha_modificacion'         => '2026-02-10 13:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 5,
                'calificacion_registrada'    => 74,
                'calificacion_anterior'      => 74,
            ],
            [
                'id_bitacora_calificaciones' => 6,
                'id_unidad'                  => 6,
                'id_carga_ingles'            => 6,
                'fecha_modificacion'         => '2026-02-19 14:00:00',
                'id_periodo'                 => 6,
                'id_profesor'                => 6,
                'calificacion_registrada'    => 81,
                'calificacion_anterior'      => 81,
            ],
            [
                'id_bitacora_calificaciones' => 7,
                'id_unidad'                  => 7,
                'id_carga_ingles'            => 7,
                'fecha_modificacion'         => '2026-02-28 15:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 7,
                'calificacion_registrada'    => 88,
                'calificacion_anterior'      => 88,
            ],
            [
                'id_bitacora_calificaciones' => 8,
                'id_unidad'                  => 8,
                'id_carga_ingles'            => 8,
                'fecha_modificacion'         => '2026-03-09 16:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 8,
                'calificacion_registrada'    => 95,
                'calificacion_anterior'      => 95,
            ],
            [
                'id_bitacora_calificaciones' => 9,
                'id_unidad'                  => 1,
                'id_carga_ingles'            => 9,
                'fecha_modificacion'         => '2026-03-18 08:00:00',
                'id_periodo'                 => 9,
                'id_profesor'                => 9,
                'calificacion_registrada'    => 71,
                'calificacion_anterior'      => 71,
            ],
            [
                'id_bitacora_calificaciones' => 10,
                'id_unidad'                  => 2,
                'id_carga_ingles'            => 10,
                'fecha_modificacion'         => '2026-03-27 09:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 10,
                'calificacion_registrada'    => 78,
                'calificacion_anterior'      => 78,
            ],
            [
                'id_bitacora_calificaciones' => 11,
                'id_unidad'                  => 3,
                'id_carga_ingles'            => 11,
                'fecha_modificacion'         => '2026-04-05 10:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 11,
                'calificacion_registrada'    => 85,
                'calificacion_anterior'      => 85,
            ],
            [
                'id_bitacora_calificaciones' => 12,
                'id_unidad'                  => 4,
                'id_carga_ingles'            => 12,
                'fecha_modificacion'         => '2026-04-14 11:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 12,
                'calificacion_registrada'    => 92,
                'calificacion_anterior'      => 92,
            ],
            [
                'id_bitacora_calificaciones' => 13,
                'id_unidad'                  => 5,
                'id_carga_ingles'            => 13,
                'fecha_modificacion'         => '2026-04-23 12:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 13,
                'calificacion_registrada'    => 99,
                'calificacion_anterior'      => 99,
            ],
            [
                'id_bitacora_calificaciones' => 14,
                'id_unidad'                  => 6,
                'id_carga_ingles'            => 14,
                'fecha_modificacion'         => '2026-05-02 13:00:00',
                'id_periodo'                 => 12,
                'id_profesor'                => 14,
                'calificacion_registrada'    => 75,
                'calificacion_anterior'      => 75,
            ],
            [
                'id_bitacora_calificaciones' => 15,
                'id_unidad'                  => 7,
                'id_carga_ingles'            => 15,
                'fecha_modificacion'         => '2026-05-11 14:00:00',
                'id_periodo'                 => 15,
                'id_profesor'                => 15,
                'calificacion_registrada'    => 82,
                'calificacion_anterior'      => 82,
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
