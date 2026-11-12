<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_accesos_datos_sensibles`.
 */
class ArAccesosDatosSensiblesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_accesos_datos_sensibles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_accesos_datos_sensibles';

        $llaves = [
            ['id_ar_acceso'],
        ];

        $registros = [
            [
                'id_ar_acceso'     => 1,
                'id_usuario'       => 1,
                'id_personal'      => 1,
                'modulo'           => 'Modulo accesos datos sensibles 1',
                'accion'           => 'Accion accesos datos sensibles 1',
                'id_referencia'    => 1,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 1',
                'fecha_acceso'     => '2026-01-05 09:00:00',
                'ip'               => '192.168.1.11',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_acceso'     => 2,
                'id_usuario'       => 2,
                'id_personal'      => 2,
                'modulo'           => 'Modulo accesos datos sensibles 2',
                'accion'           => 'Accion accesos datos sensibles 2',
                'id_referencia'    => 2,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 2',
                'fecha_acceso'     => '2026-01-14 10:00:00',
                'ip'               => '192.168.1.12',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_acceso'     => 3,
                'id_usuario'       => 3,
                'id_personal'      => 3,
                'modulo'           => 'Modulo accesos datos sensibles 3',
                'accion'           => 'Accion accesos datos sensibles 3',
                'id_referencia'    => 3,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 3',
                'fecha_acceso'     => '2026-01-23 11:00:00',
                'ip'               => '192.168.1.13',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_acceso'     => 4,
                'id_usuario'       => 4,
                'id_personal'      => 4,
                'modulo'           => 'Modulo accesos datos sensibles 4',
                'accion'           => 'Accion accesos datos sensibles 4',
                'id_referencia'    => 4,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 4',
                'fecha_acceso'     => '2026-02-01 12:00:00',
                'ip'               => '192.168.1.14',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_acceso'     => 5,
                'id_usuario'       => 5,
                'id_personal'      => 5,
                'modulo'           => 'Modulo accesos datos sensibles 5',
                'accion'           => 'Accion accesos datos sensibles 5',
                'id_referencia'    => 5,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 5',
                'fecha_acceso'     => '2026-02-10 13:00:00',
                'ip'               => '192.168.1.15',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_acceso'     => 6,
                'id_usuario'       => 6,
                'id_personal'      => 6,
                'modulo'           => 'Modulo accesos datos sensibles 6',
                'accion'           => 'Accion accesos datos sensibles 6',
                'id_referencia'    => 6,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 6',
                'fecha_acceso'     => '2026-02-19 14:00:00',
                'ip'               => '192.168.1.16',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_acceso'     => 7,
                'id_usuario'       => 7,
                'id_personal'      => 7,
                'modulo'           => 'Modulo accesos datos sensibles 7',
                'accion'           => 'Accion accesos datos sensibles 7',
                'id_referencia'    => 7,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 7',
                'fecha_acceso'     => '2026-02-28 15:00:00',
                'ip'               => '192.168.1.17',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_acceso'     => 8,
                'id_usuario'       => 8,
                'id_personal'      => 8,
                'modulo'           => 'Modulo accesos datos sensibles 8',
                'accion'           => 'Accion accesos datos sensibles 8',
                'id_referencia'    => 8,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 8',
                'fecha_acceso'     => '2026-03-09 16:00:00',
                'ip'               => '192.168.1.18',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_acceso'     => 9,
                'id_usuario'       => 9,
                'id_personal'      => 9,
                'modulo'           => 'Modulo accesos datos sensibles 9',
                'accion'           => 'Accion accesos datos sensibles 9',
                'id_referencia'    => 9,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 9',
                'fecha_acceso'     => '2026-03-18 08:00:00',
                'ip'               => '192.168.1.19',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_acceso'     => 10,
                'id_usuario'       => 10,
                'id_personal'      => 10,
                'modulo'           => 'Modulo accesos datos sensibles 10',
                'accion'           => 'Accion accesos datos sensibles 10',
                'id_referencia'    => 10,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 10',
                'fecha_acceso'     => '2026-03-27 09:00:00',
                'ip'               => '192.168.1.20',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_acceso'     => 11,
                'id_usuario'       => 11,
                'id_personal'      => 11,
                'modulo'           => 'Modulo accesos datos sensibles 11',
                'accion'           => 'Accion accesos datos sensibles 11',
                'id_referencia'    => 11,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 11',
                'fecha_acceso'     => '2026-04-05 10:00:00',
                'ip'               => '192.168.1.21',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_acceso'     => 12,
                'id_usuario'       => 12,
                'id_personal'      => 12,
                'modulo'           => 'Modulo accesos datos sensibles 12',
                'accion'           => 'Accion accesos datos sensibles 12',
                'id_referencia'    => 12,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 12',
                'fecha_acceso'     => '2026-04-14 11:00:00',
                'ip'               => '192.168.1.22',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_acceso'     => 13,
                'id_usuario'       => 13,
                'id_personal'      => 13,
                'modulo'           => 'Modulo accesos datos sensibles 13',
                'accion'           => 'Accion accesos datos sensibles 13',
                'id_referencia'    => 13,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 13',
                'fecha_acceso'     => '2026-04-23 12:00:00',
                'ip'               => '192.168.1.23',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_acceso'     => 14,
                'id_usuario'       => 14,
                'id_personal'      => 14,
                'modulo'           => 'Modulo accesos datos sensibles 14',
                'accion'           => 'Accion accesos datos sensibles 14',
                'id_referencia'    => 14,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 14',
                'fecha_acceso'     => '2026-05-02 13:00:00',
                'ip'               => '192.168.1.24',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_acceso'     => 15,
                'id_usuario'       => 15,
                'id_personal'      => 15,
                'modulo'           => 'Modulo accesos datos sensibles 15',
                'accion'           => 'Accion accesos datos sensibles 15',
                'id_referencia'    => 15,
                'tabla_referencia' => 'Tabla referencia accesos datos sensibles 15',
                'fecha_acceso'     => '2026-05-11 14:00:00',
                'ip'               => '192.168.1.25',
                'user_agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at'       => '2026-05-11 14:00:00',
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
