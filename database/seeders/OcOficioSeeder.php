<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_oficio`.
 */
class OcOficioSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_oficio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'oc_oficio';

        $llaves = [
            ['id_oficio'],
        ];

        $registros = [
            [
                'id_oficio'                 => 1,
                'fecha'                     => '2026-01-05',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 1.',
                'fecha_salida'              => '2026-01-05',
                'fecha_regreso'             => '2026-01-05',
                'hora_s'                    => '07:00-08:00',
                'hora_r'                    => '07:00-08:00',
                'id_lugar_salida'           => 1,
                'id_lugar_entrada'          => 1,
                'fecha_hora'                => '2026-01-05',
                'id_usuario'                => 1,
                'updated_at'                => '2026-01-05',
                'id_notificacion_solicitud' => 1,
            ],
            [
                'id_oficio'                 => 2,
                'fecha'                     => '2026-01-14',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 2.',
                'fecha_salida'              => '2026-01-14',
                'fecha_regreso'             => '2026-01-14',
                'hora_s'                    => '08:00-09:00',
                'hora_r'                    => '08:00-09:00',
                'id_lugar_salida'           => 2,
                'id_lugar_entrada'          => 2,
                'fecha_hora'                => '2026-01-14',
                'id_usuario'                => 2,
                'updated_at'                => '2026-01-14',
                'id_notificacion_solicitud' => 2,
            ],
            [
                'id_oficio'                 => 3,
                'fecha'                     => '2026-01-23',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 3.',
                'fecha_salida'              => '2026-01-23',
                'fecha_regreso'             => '2026-01-23',
                'hora_s'                    => '09:00-10:00',
                'hora_r'                    => '09:00-10:00',
                'id_lugar_salida'           => 3,
                'id_lugar_entrada'          => 3,
                'fecha_hora'                => '2026-01-23',
                'id_usuario'                => 3,
                'updated_at'                => '2026-01-23',
                'id_notificacion_solicitud' => 3,
            ],
            [
                'id_oficio'                 => 4,
                'fecha'                     => '2026-02-01',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 4.',
                'fecha_salida'              => '2026-02-01',
                'fecha_regreso'             => '2026-02-01',
                'hora_s'                    => '10:00-11:00',
                'hora_r'                    => '10:00-11:00',
                'id_lugar_salida'           => 4,
                'id_lugar_entrada'          => 4,
                'fecha_hora'                => '2026-02-01',
                'id_usuario'                => 4,
                'updated_at'                => '2026-02-01',
                'id_notificacion_solicitud' => 4,
            ],
            [
                'id_oficio'                 => 5,
                'fecha'                     => '2026-02-10',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 5.',
                'fecha_salida'              => '2026-02-10',
                'fecha_regreso'             => '2026-02-10',
                'hora_s'                    => '11:00-12:00',
                'hora_r'                    => '11:00-12:00',
                'id_lugar_salida'           => 5,
                'id_lugar_entrada'          => 5,
                'fecha_hora'                => '2026-02-10',
                'id_usuario'                => 5,
                'updated_at'                => '2026-02-10',
                'id_notificacion_solicitud' => 5,
            ],
            [
                'id_oficio'                 => 6,
                'fecha'                     => '2026-02-19',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 6.',
                'fecha_salida'              => '2026-02-19',
                'fecha_regreso'             => '2026-02-19',
                'hora_s'                    => '12:00-13:00',
                'hora_r'                    => '12:00-13:00',
                'id_lugar_salida'           => 6,
                'id_lugar_entrada'          => 6,
                'fecha_hora'                => '2026-02-19',
                'id_usuario'                => 6,
                'updated_at'                => '2026-02-19',
                'id_notificacion_solicitud' => 6,
            ],
            [
                'id_oficio'                 => 7,
                'fecha'                     => '2026-02-28',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 7.',
                'fecha_salida'              => '2026-02-28',
                'fecha_regreso'             => '2026-02-28',
                'hora_s'                    => '13:00-14:00',
                'hora_r'                    => '13:00-14:00',
                'id_lugar_salida'           => 7,
                'id_lugar_entrada'          => 7,
                'fecha_hora'                => '2026-02-28',
                'id_usuario'                => 7,
                'updated_at'                => '2026-02-28',
                'id_notificacion_solicitud' => 7,
            ],
            [
                'id_oficio'                 => 8,
                'fecha'                     => '2026-03-09',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 8.',
                'fecha_salida'              => '2026-03-09',
                'fecha_regreso'             => '2026-03-09',
                'hora_s'                    => '14:00-15:00',
                'hora_r'                    => '14:00-15:00',
                'id_lugar_salida'           => 8,
                'id_lugar_entrada'          => 8,
                'fecha_hora'                => '2026-03-09',
                'id_usuario'                => 8,
                'updated_at'                => '2026-03-09',
                'id_notificacion_solicitud' => 8,
            ],
            [
                'id_oficio'                 => 9,
                'fecha'                     => '2026-03-18',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 9.',
                'fecha_salida'              => '2026-03-18',
                'fecha_regreso'             => '2026-03-18',
                'hora_s'                    => '15:00-16:00',
                'hora_r'                    => '15:00-16:00',
                'id_lugar_salida'           => 9,
                'id_lugar_entrada'          => 9,
                'fecha_hora'                => '2026-03-18',
                'id_usuario'                => 9,
                'updated_at'                => '2026-03-18',
                'id_notificacion_solicitud' => 9,
            ],
            [
                'id_oficio'                 => 10,
                'fecha'                     => '2026-03-27',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 10.',
                'fecha_salida'              => '2026-03-27',
                'fecha_regreso'             => '2026-03-27',
                'hora_s'                    => '16:00-17:00',
                'hora_r'                    => '16:00-17:00',
                'id_lugar_salida'           => 10,
                'id_lugar_entrada'          => 10,
                'fecha_hora'                => '2026-03-27',
                'id_usuario'                => 10,
                'updated_at'                => '2026-03-27',
                'id_notificacion_solicitud' => 10,
            ],
            [
                'id_oficio'                 => 11,
                'fecha'                     => '2026-04-05',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 11.',
                'fecha_salida'              => '2026-04-05',
                'fecha_regreso'             => '2026-04-05',
                'hora_s'                    => '17:00-18:00',
                'hora_r'                    => '17:00-18:00',
                'id_lugar_salida'           => 11,
                'id_lugar_entrada'          => 11,
                'fecha_hora'                => '2026-04-05',
                'id_usuario'                => 11,
                'updated_at'                => '2026-04-05',
                'id_notificacion_solicitud' => 11,
            ],
            [
                'id_oficio'                 => 12,
                'fecha'                     => '2026-04-14',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 12.',
                'fecha_salida'              => '2026-04-14',
                'fecha_regreso'             => '2026-04-14',
                'hora_s'                    => '18:00-19:00',
                'hora_r'                    => '18:00-19:00',
                'id_lugar_salida'           => 12,
                'id_lugar_entrada'          => 12,
                'fecha_hora'                => '2026-04-14',
                'id_usuario'                => 12,
                'updated_at'                => '2026-04-14',
                'id_notificacion_solicitud' => 12,
            ],
            [
                'id_oficio'                 => 13,
                'fecha'                     => '2026-04-23',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 13.',
                'fecha_salida'              => '2026-04-23',
                'fecha_regreso'             => '2026-04-23',
                'hora_s'                    => '07:00-08:00',
                'hora_r'                    => '07:00-08:00',
                'id_lugar_salida'           => 13,
                'id_lugar_entrada'          => 13,
                'fecha_hora'                => '2026-04-23',
                'id_usuario'                => 13,
                'updated_at'                => '2026-04-23',
                'id_notificacion_solicitud' => 13,
            ],
            [
                'id_oficio'                 => 14,
                'fecha'                     => '2026-05-02',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 14.',
                'fecha_salida'              => '2026-05-02',
                'fecha_regreso'             => '2026-05-02',
                'hora_s'                    => '08:00-09:00',
                'hora_r'                    => '08:00-09:00',
                'id_lugar_salida'           => 14,
                'id_lugar_entrada'          => 14,
                'fecha_hora'                => '2026-05-02',
                'id_usuario'                => 14,
                'updated_at'                => '2026-05-02',
                'id_notificacion_solicitud' => 14,
            ],
            [
                'id_oficio'                 => 15,
                'fecha'                     => '2026-05-11',
                'desc_comision'             => 'Desc comision de oficio: registro de prueba número 15.',
                'fecha_salida'              => '2026-05-11',
                'fecha_regreso'             => '2026-05-11',
                'hora_s'                    => '09:00-10:00',
                'hora_r'                    => '09:00-10:00',
                'id_lugar_salida'           => 15,
                'id_lugar_entrada'          => 15,
                'fecha_hora'                => '2026-05-11',
                'id_usuario'                => 15,
                'updated_at'                => '2026-05-11',
                'id_notificacion_solicitud' => 15,
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
