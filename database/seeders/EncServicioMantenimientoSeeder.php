<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `enc_servicio_mantenimiento`.
 */
class EncServicioMantenimientoSeeder extends Seeder
{
    /**
     * Pobla la tabla `enc_servicio_mantenimiento` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EncTiposEncuestasSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'enc_servicio_mantenimiento';

        $llaves = [
            ['id_servicio_mantenimiento'],
        ];

        $registros = [
            [
                'id_servicio_mantenimiento' => 1,
                'id_tipo_encuesta'          => 1,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 1.',
                'id_personal'               => 1,
                'fecha_solicita'            => '2026-01-05',
                'fecha_encuesta'            => '2026-01-05',
                'cal_preg_1'                => 77,
                'cal_preg_2'                => 77,
                'cal_preg_3'                => 77,
                'cal_preg_4'                => 77,
                'year'                      => 2026,
                'mes'                       => 1,
                'id_estado'                 => 1,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 1.',
                'fecha_registro'            => '2026-01-05',
            ],
            [
                'id_servicio_mantenimiento' => 2,
                'id_tipo_encuesta'          => 2,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 2.',
                'id_personal'               => 2,
                'fecha_solicita'            => '2026-01-14',
                'fecha_encuesta'            => '2026-01-14',
                'cal_preg_1'                => 84,
                'cal_preg_2'                => 84,
                'cal_preg_3'                => 84,
                'cal_preg_4'                => 84,
                'year'                      => 2026,
                'mes'                       => 2,
                'id_estado'                 => 2,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 2.',
                'fecha_registro'            => '2026-01-14',
            ],
            [
                'id_servicio_mantenimiento' => 3,
                'id_tipo_encuesta'          => 3,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 3.',
                'id_personal'               => 3,
                'fecha_solicita'            => '2026-01-23',
                'fecha_encuesta'            => '2026-01-23',
                'cal_preg_1'                => 91,
                'cal_preg_2'                => 91,
                'cal_preg_3'                => 91,
                'cal_preg_4'                => 91,
                'year'                      => 2026,
                'mes'                       => 3,
                'id_estado'                 => 3,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 3.',
                'fecha_registro'            => '2026-01-23',
            ],
            [
                'id_servicio_mantenimiento' => 4,
                'id_tipo_encuesta'          => 4,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 4.',
                'id_personal'               => 4,
                'fecha_solicita'            => '2026-02-01',
                'fecha_encuesta'            => '2026-02-01',
                'cal_preg_1'                => 98,
                'cal_preg_2'                => 98,
                'cal_preg_3'                => 98,
                'cal_preg_4'                => 98,
                'year'                      => 2026,
                'mes'                       => 4,
                'id_estado'                 => 4,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 4.',
                'fecha_registro'            => '2026-02-01',
            ],
            [
                'id_servicio_mantenimiento' => 5,
                'id_tipo_encuesta'          => 5,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 5.',
                'id_personal'               => 5,
                'fecha_solicita'            => '2026-02-10',
                'fecha_encuesta'            => '2026-02-10',
                'cal_preg_1'                => 74,
                'cal_preg_2'                => 74,
                'cal_preg_3'                => 74,
                'cal_preg_4'                => 74,
                'year'                      => 2026,
                'mes'                       => 5,
                'id_estado'                 => 5,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 5.',
                'fecha_registro'            => '2026-02-10',
            ],
            [
                'id_servicio_mantenimiento' => 6,
                'id_tipo_encuesta'          => 6,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 6.',
                'id_personal'               => 6,
                'fecha_solicita'            => '2026-02-19',
                'fecha_encuesta'            => '2026-02-19',
                'cal_preg_1'                => 81,
                'cal_preg_2'                => 81,
                'cal_preg_3'                => 81,
                'cal_preg_4'                => 81,
                'year'                      => 2026,
                'mes'                       => 6,
                'id_estado'                 => 6,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 6.',
                'fecha_registro'            => '2026-02-19',
            ],
            [
                'id_servicio_mantenimiento' => 7,
                'id_tipo_encuesta'          => 7,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 7.',
                'id_personal'               => 7,
                'fecha_solicita'            => '2026-02-28',
                'fecha_encuesta'            => '2026-02-28',
                'cal_preg_1'                => 88,
                'cal_preg_2'                => 88,
                'cal_preg_3'                => 88,
                'cal_preg_4'                => 88,
                'year'                      => 2026,
                'mes'                       => 7,
                'id_estado'                 => 7,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 7.',
                'fecha_registro'            => '2026-02-28',
            ],
            [
                'id_servicio_mantenimiento' => 8,
                'id_tipo_encuesta'          => 8,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 8.',
                'id_personal'               => 8,
                'fecha_solicita'            => '2026-03-09',
                'fecha_encuesta'            => '2026-03-09',
                'cal_preg_1'                => 95,
                'cal_preg_2'                => 95,
                'cal_preg_3'                => 95,
                'cal_preg_4'                => 95,
                'year'                      => 2026,
                'mes'                       => 8,
                'id_estado'                 => 8,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 8.',
                'fecha_registro'            => '2026-03-09',
            ],
            [
                'id_servicio_mantenimiento' => 9,
                'id_tipo_encuesta'          => 9,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 9.',
                'id_personal'               => 9,
                'fecha_solicita'            => '2026-03-18',
                'fecha_encuesta'            => '2026-03-18',
                'cal_preg_1'                => 71,
                'cal_preg_2'                => 71,
                'cal_preg_3'                => 71,
                'cal_preg_4'                => 71,
                'year'                      => 2026,
                'mes'                       => 9,
                'id_estado'                 => 9,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 9.',
                'fecha_registro'            => '2026-03-18',
            ],
            [
                'id_servicio_mantenimiento' => 10,
                'id_tipo_encuesta'          => 10,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 10.',
                'id_personal'               => 10,
                'fecha_solicita'            => '2026-03-27',
                'fecha_encuesta'            => '2026-03-27',
                'cal_preg_1'                => 78,
                'cal_preg_2'                => 78,
                'cal_preg_3'                => 78,
                'cal_preg_4'                => 78,
                'year'                      => 2026,
                'mes'                       => 10,
                'id_estado'                 => 10,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 10.',
                'fecha_registro'            => '2026-03-27',
            ],
            [
                'id_servicio_mantenimiento' => 11,
                'id_tipo_encuesta'          => 11,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 11.',
                'id_personal'               => 11,
                'fecha_solicita'            => '2026-04-05',
                'fecha_encuesta'            => '2026-04-05',
                'cal_preg_1'                => 85,
                'cal_preg_2'                => 85,
                'cal_preg_3'                => 85,
                'cal_preg_4'                => 85,
                'year'                      => 2026,
                'mes'                       => 11,
                'id_estado'                 => 11,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 11.',
                'fecha_registro'            => '2026-04-05',
            ],
            [
                'id_servicio_mantenimiento' => 12,
                'id_tipo_encuesta'          => 12,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 12.',
                'id_personal'               => 12,
                'fecha_solicita'            => '2026-04-14',
                'fecha_encuesta'            => '2026-04-14',
                'cal_preg_1'                => 92,
                'cal_preg_2'                => 92,
                'cal_preg_3'                => 92,
                'cal_preg_4'                => 92,
                'year'                      => 2026,
                'mes'                       => 12,
                'id_estado'                 => 12,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 12.',
                'fecha_registro'            => '2026-04-14',
            ],
            [
                'id_servicio_mantenimiento' => 13,
                'id_tipo_encuesta'          => 13,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 13.',
                'id_personal'               => 13,
                'fecha_solicita'            => '2026-04-23',
                'fecha_encuesta'            => '2026-04-23',
                'cal_preg_1'                => 99,
                'cal_preg_2'                => 99,
                'cal_preg_3'                => 99,
                'cal_preg_4'                => 99,
                'year'                      => 2026,
                'mes'                       => 1,
                'id_estado'                 => 13,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 13.',
                'fecha_registro'            => '2026-04-23',
            ],
            [
                'id_servicio_mantenimiento' => 14,
                'id_tipo_encuesta'          => 14,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 14.',
                'id_personal'               => 14,
                'fecha_solicita'            => '2026-05-02',
                'fecha_encuesta'            => '2026-05-02',
                'cal_preg_1'                => 75,
                'cal_preg_2'                => 75,
                'cal_preg_3'                => 75,
                'cal_preg_4'                => 75,
                'year'                      => 2026,
                'mes'                       => 2,
                'id_estado'                 => 14,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 14.',
                'fecha_registro'            => '2026-05-02',
            ],
            [
                'id_servicio_mantenimiento' => 15,
                'id_tipo_encuesta'          => 15,
                'servicio_solicita'         => 'Servicio solicita de servicio mantenimiento: registro de prueba número 15.',
                'id_personal'               => 15,
                'fecha_solicita'            => '2026-05-11',
                'fecha_encuesta'            => '2026-05-11',
                'cal_preg_1'                => 82,
                'cal_preg_2'                => 82,
                'cal_preg_3'                => 82,
                'cal_preg_4'                => 82,
                'year'                      => 2026,
                'mes'                       => 3,
                'id_estado'                 => 15,
                'sugerencias'               => 'Sugerencias de servicio mantenimiento: registro de prueba número 15.',
                'fecha_registro'            => '2026-05-11',
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
