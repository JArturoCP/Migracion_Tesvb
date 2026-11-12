<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_oficio_personal`.
 */
class OcOficioPersonalSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_oficio_personal` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
            OcEstadoOficioSeeder::class,
            OcOficioSeeder::class,
        ]);

        $tabla = 'oc_oficio_personal';

        $llaves = [
            ['id_oficio_personal'],
        ];

        $registros = [
            [
                'id_oficio_personal' => 1,
                'anio'               => 'V1',
                'id_oficio'          => 1,
                'id_personal'        => 1,
                'viaticos'           => 1,
                'automovil'          => 1,
                'id_notificacion'    => 1,
                'no_oficio'          => 1,
                'estado_oficio'      => 1,
                'fecha_salida'       => '2026-01-05',
                'fecha_regreso'      => '2026-01-05',
            ],
            [
                'id_oficio_personal' => 2,
                'anio'               => 'V2',
                'id_oficio'          => 2,
                'id_personal'        => 2,
                'viaticos'           => 2,
                'automovil'          => 2,
                'id_notificacion'    => 2,
                'no_oficio'          => 2,
                'estado_oficio'      => 2,
                'fecha_salida'       => '2026-01-14',
                'fecha_regreso'      => '2026-01-14',
            ],
            [
                'id_oficio_personal' => 3,
                'anio'               => 'V3',
                'id_oficio'          => 3,
                'id_personal'        => 3,
                'viaticos'           => 3,
                'automovil'          => 3,
                'id_notificacion'    => 3,
                'no_oficio'          => 3,
                'estado_oficio'      => 3,
                'fecha_salida'       => '2026-01-23',
                'fecha_regreso'      => '2026-01-23',
            ],
            [
                'id_oficio_personal' => 4,
                'anio'               => 'V4',
                'id_oficio'          => 4,
                'id_personal'        => 4,
                'viaticos'           => 4,
                'automovil'          => 4,
                'id_notificacion'    => 4,
                'no_oficio'          => 4,
                'estado_oficio'      => 4,
                'fecha_salida'       => '2026-02-01',
                'fecha_regreso'      => '2026-02-01',
            ],
            [
                'id_oficio_personal' => 5,
                'anio'               => 'V5',
                'id_oficio'          => 5,
                'id_personal'        => 5,
                'viaticos'           => 5,
                'automovil'          => 5,
                'id_notificacion'    => 5,
                'no_oficio'          => 5,
                'estado_oficio'      => 5,
                'fecha_salida'       => '2026-02-10',
                'fecha_regreso'      => '2026-02-10',
            ],
            [
                'id_oficio_personal' => 6,
                'anio'               => 'V6',
                'id_oficio'          => 6,
                'id_personal'        => 6,
                'viaticos'           => 6,
                'automovil'          => 6,
                'id_notificacion'    => 6,
                'no_oficio'          => 6,
                'estado_oficio'      => 6,
                'fecha_salida'       => '2026-02-19',
                'fecha_regreso'      => '2026-02-19',
            ],
            [
                'id_oficio_personal' => 7,
                'anio'               => 'V7',
                'id_oficio'          => 7,
                'id_personal'        => 7,
                'viaticos'           => 7,
                'automovil'          => 7,
                'id_notificacion'    => 7,
                'no_oficio'          => 7,
                'estado_oficio'      => 7,
                'fecha_salida'       => '2026-02-28',
                'fecha_regreso'      => '2026-02-28',
            ],
            [
                'id_oficio_personal' => 8,
                'anio'               => 'V8',
                'id_oficio'          => 8,
                'id_personal'        => 8,
                'viaticos'           => 8,
                'automovil'          => 8,
                'id_notificacion'    => 8,
                'no_oficio'          => 8,
                'estado_oficio'      => 8,
                'fecha_salida'       => '2026-03-09',
                'fecha_regreso'      => '2026-03-09',
            ],
            [
                'id_oficio_personal' => 9,
                'anio'               => 'V9',
                'id_oficio'          => 9,
                'id_personal'        => 9,
                'viaticos'           => 9,
                'automovil'          => 9,
                'id_notificacion'    => 9,
                'no_oficio'          => 9,
                'estado_oficio'      => 9,
                'fecha_salida'       => '2026-03-18',
                'fecha_regreso'      => '2026-03-18',
            ],
            [
                'id_oficio_personal' => 10,
                'anio'               => 'V10',
                'id_oficio'          => 10,
                'id_personal'        => 10,
                'viaticos'           => 10,
                'automovil'          => 10,
                'id_notificacion'    => 10,
                'no_oficio'          => 10,
                'estado_oficio'      => 10,
                'fecha_salida'       => '2026-03-27',
                'fecha_regreso'      => '2026-03-27',
            ],
            [
                'id_oficio_personal' => 11,
                'anio'               => 'V11',
                'id_oficio'          => 11,
                'id_personal'        => 11,
                'viaticos'           => 11,
                'automovil'          => 11,
                'id_notificacion'    => 11,
                'no_oficio'          => 11,
                'estado_oficio'      => 11,
                'fecha_salida'       => '2026-04-05',
                'fecha_regreso'      => '2026-04-05',
            ],
            [
                'id_oficio_personal' => 12,
                'anio'               => 'V12',
                'id_oficio'          => 12,
                'id_personal'        => 12,
                'viaticos'           => 12,
                'automovil'          => 12,
                'id_notificacion'    => 12,
                'no_oficio'          => 12,
                'estado_oficio'      => 12,
                'fecha_salida'       => '2026-04-14',
                'fecha_regreso'      => '2026-04-14',
            ],
            [
                'id_oficio_personal' => 13,
                'anio'               => 'V13',
                'id_oficio'          => 13,
                'id_personal'        => 13,
                'viaticos'           => 13,
                'automovil'          => 13,
                'id_notificacion'    => 13,
                'no_oficio'          => 13,
                'estado_oficio'      => 13,
                'fecha_salida'       => '2026-04-23',
                'fecha_regreso'      => '2026-04-23',
            ],
            [
                'id_oficio_personal' => 14,
                'anio'               => 'V14',
                'id_oficio'          => 14,
                'id_personal'        => 14,
                'viaticos'           => 14,
                'automovil'          => 14,
                'id_notificacion'    => 14,
                'no_oficio'          => 14,
                'estado_oficio'      => 14,
                'fecha_salida'       => '2026-05-02',
                'fecha_regreso'      => '2026-05-02',
            ],
            [
                'id_oficio_personal' => 15,
                'anio'               => 'V15',
                'id_oficio'          => 15,
                'id_personal'        => 15,
                'viaticos'           => 15,
                'automovil'          => 15,
                'id_notificacion'    => 15,
                'no_oficio'          => 15,
                'estado_oficio'      => 15,
                'fecha_salida'       => '2026-05-11',
                'fecha_regreso'      => '2026-05-11',
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
