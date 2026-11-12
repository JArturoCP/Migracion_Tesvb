<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_oficio_vehiculo`.
 */
class OcOficioVehiculoSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_oficio_vehiculo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            OcOficioPersonalSeeder::class,
            OcVehiculoSeeder::class,
        ]);

        $tabla = 'oc_oficio_vehiculo';

        $llaves = [
            ['id_oficio_vehiculo'],
        ];

        $registros = [
            [
                'id_oficio_vehiculo' => 1,
                'id_vehiculo'        => 1,
                'id_oficio_personal' => 1,
                'fecha_salida'       => '2026-01-05',
                'fecha_regreso'      => '2026-01-05',
                'licencia'           => 'Licencia oficio vehiculo 1',
                'notificacion'       => 1,
            ],
            [
                'id_oficio_vehiculo' => 2,
                'id_vehiculo'        => 2,
                'id_oficio_personal' => 2,
                'fecha_salida'       => '2026-01-14',
                'fecha_regreso'      => '2026-01-14',
                'licencia'           => 'Licencia oficio vehiculo 2',
                'notificacion'       => 2,
            ],
            [
                'id_oficio_vehiculo' => 3,
                'id_vehiculo'        => 3,
                'id_oficio_personal' => 3,
                'fecha_salida'       => '2026-01-23',
                'fecha_regreso'      => '2026-01-23',
                'licencia'           => 'Licencia oficio vehiculo 3',
                'notificacion'       => 3,
            ],
            [
                'id_oficio_vehiculo' => 4,
                'id_vehiculo'        => 4,
                'id_oficio_personal' => 4,
                'fecha_salida'       => '2026-02-01',
                'fecha_regreso'      => '2026-02-01',
                'licencia'           => 'Licencia oficio vehiculo 4',
                'notificacion'       => 4,
            ],
            [
                'id_oficio_vehiculo' => 5,
                'id_vehiculo'        => 5,
                'id_oficio_personal' => 5,
                'fecha_salida'       => '2026-02-10',
                'fecha_regreso'      => '2026-02-10',
                'licencia'           => 'Licencia oficio vehiculo 5',
                'notificacion'       => 5,
            ],
            [
                'id_oficio_vehiculo' => 6,
                'id_vehiculo'        => 6,
                'id_oficio_personal' => 6,
                'fecha_salida'       => '2026-02-19',
                'fecha_regreso'      => '2026-02-19',
                'licencia'           => 'Licencia oficio vehiculo 6',
                'notificacion'       => 6,
            ],
            [
                'id_oficio_vehiculo' => 7,
                'id_vehiculo'        => 7,
                'id_oficio_personal' => 7,
                'fecha_salida'       => '2026-02-28',
                'fecha_regreso'      => '2026-02-28',
                'licencia'           => 'Licencia oficio vehiculo 7',
                'notificacion'       => 7,
            ],
            [
                'id_oficio_vehiculo' => 8,
                'id_vehiculo'        => 8,
                'id_oficio_personal' => 8,
                'fecha_salida'       => '2026-03-09',
                'fecha_regreso'      => '2026-03-09',
                'licencia'           => 'Licencia oficio vehiculo 8',
                'notificacion'       => 8,
            ],
            [
                'id_oficio_vehiculo' => 9,
                'id_vehiculo'        => 9,
                'id_oficio_personal' => 9,
                'fecha_salida'       => '2026-03-18',
                'fecha_regreso'      => '2026-03-18',
                'licencia'           => 'Licencia oficio vehiculo 9',
                'notificacion'       => 9,
            ],
            [
                'id_oficio_vehiculo' => 10,
                'id_vehiculo'        => 10,
                'id_oficio_personal' => 10,
                'fecha_salida'       => '2026-03-27',
                'fecha_regreso'      => '2026-03-27',
                'licencia'           => 'Licencia oficio vehiculo 10',
                'notificacion'       => 10,
            ],
            [
                'id_oficio_vehiculo' => 11,
                'id_vehiculo'        => 11,
                'id_oficio_personal' => 11,
                'fecha_salida'       => '2026-04-05',
                'fecha_regreso'      => '2026-04-05',
                'licencia'           => 'Licencia oficio vehiculo 11',
                'notificacion'       => 11,
            ],
            [
                'id_oficio_vehiculo' => 12,
                'id_vehiculo'        => 12,
                'id_oficio_personal' => 12,
                'fecha_salida'       => '2026-04-14',
                'fecha_regreso'      => '2026-04-14',
                'licencia'           => 'Licencia oficio vehiculo 12',
                'notificacion'       => 12,
            ],
            [
                'id_oficio_vehiculo' => 13,
                'id_vehiculo'        => 13,
                'id_oficio_personal' => 13,
                'fecha_salida'       => '2026-04-23',
                'fecha_regreso'      => '2026-04-23',
                'licencia'           => 'Licencia oficio vehiculo 13',
                'notificacion'       => 13,
            ],
            [
                'id_oficio_vehiculo' => 14,
                'id_vehiculo'        => 14,
                'id_oficio_personal' => 14,
                'fecha_salida'       => '2026-05-02',
                'fecha_regreso'      => '2026-05-02',
                'licencia'           => 'Licencia oficio vehiculo 14',
                'notificacion'       => 14,
            ],
            [
                'id_oficio_vehiculo' => 15,
                'id_vehiculo'        => 15,
                'id_oficio_personal' => 15,
                'fecha_salida'       => '2026-05-11',
                'fecha_regreso'      => '2026-05-11',
                'licencia'           => 'Licencia oficio vehiculo 15',
                'notificacion'       => 15,
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
