<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_anteproyecto`.
 */
class ResiAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
            ResiProyectoSeeder::class,
        ]);

        $tabla = 'resi_anteproyecto';

        $llaves = [
            ['id_anteproyecto'],
        ];

        $registros = [
            [
                'id_anteproyecto'                 => 1,
                'id_alumno'                       => 1,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 1,
                'id_proyecto'                     => 1,
                'fecha'                           => '2026-01-05',
                'estado_revision'                 => 1,
                'estado_notificaciones'           => 1,
                'estado_aceptado_portada'         => 1,
                'id_estado_aceptado_anteproyecto' => 1,
                'autorizacion_departamento'       => 1,
                'estado_permiso'                  => 1,
            ],
            [
                'id_anteproyecto'                 => 2,
                'id_alumno'                       => 2,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 2,
                'id_proyecto'                     => 2,
                'fecha'                           => '2026-01-14',
                'estado_revision'                 => 2,
                'estado_notificaciones'           => 2,
                'estado_aceptado_portada'         => 2,
                'id_estado_aceptado_anteproyecto' => 2,
                'autorizacion_departamento'       => 2,
                'estado_permiso'                  => 2,
            ],
            [
                'id_anteproyecto'                 => 3,
                'id_alumno'                       => 3,
                'id_periodo'                      => 3,
                'estado_enviado'                  => 3,
                'id_proyecto'                     => 3,
                'fecha'                           => '2026-01-23',
                'estado_revision'                 => 3,
                'estado_notificaciones'           => 3,
                'estado_aceptado_portada'         => 3,
                'id_estado_aceptado_anteproyecto' => 3,
                'autorizacion_departamento'       => 3,
                'estado_permiso'                  => 3,
            ],
            [
                'id_anteproyecto'                 => 4,
                'id_alumno'                       => 4,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 4,
                'id_proyecto'                     => 4,
                'fecha'                           => '2026-02-01',
                'estado_revision'                 => 4,
                'estado_notificaciones'           => 4,
                'estado_aceptado_portada'         => 4,
                'id_estado_aceptado_anteproyecto' => 4,
                'autorizacion_departamento'       => 4,
                'estado_permiso'                  => 4,
            ],
            [
                'id_anteproyecto'                 => 5,
                'id_alumno'                       => 5,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 5,
                'id_proyecto'                     => 5,
                'fecha'                           => '2026-02-10',
                'estado_revision'                 => 5,
                'estado_notificaciones'           => 5,
                'estado_aceptado_portada'         => 5,
                'id_estado_aceptado_anteproyecto' => 5,
                'autorizacion_departamento'       => 5,
                'estado_permiso'                  => 5,
            ],
            [
                'id_anteproyecto'                 => 6,
                'id_alumno'                       => 6,
                'id_periodo'                      => 6,
                'estado_enviado'                  => 6,
                'id_proyecto'                     => 6,
                'fecha'                           => '2026-02-19',
                'estado_revision'                 => 6,
                'estado_notificaciones'           => 6,
                'estado_aceptado_portada'         => 6,
                'id_estado_aceptado_anteproyecto' => 6,
                'autorizacion_departamento'       => 6,
                'estado_permiso'                  => 6,
            ],
            [
                'id_anteproyecto'                 => 7,
                'id_alumno'                       => 7,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 7,
                'id_proyecto'                     => 7,
                'fecha'                           => '2026-02-28',
                'estado_revision'                 => 7,
                'estado_notificaciones'           => 7,
                'estado_aceptado_portada'         => 7,
                'id_estado_aceptado_anteproyecto' => 7,
                'autorizacion_departamento'       => 7,
                'estado_permiso'                  => 7,
            ],
            [
                'id_anteproyecto'                 => 8,
                'id_alumno'                       => 8,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 8,
                'id_proyecto'                     => 8,
                'fecha'                           => '2026-03-09',
                'estado_revision'                 => 8,
                'estado_notificaciones'           => 8,
                'estado_aceptado_portada'         => 8,
                'id_estado_aceptado_anteproyecto' => 8,
                'autorizacion_departamento'       => 8,
                'estado_permiso'                  => 8,
            ],
            [
                'id_anteproyecto'                 => 9,
                'id_alumno'                       => 9,
                'id_periodo'                      => 9,
                'estado_enviado'                  => 9,
                'id_proyecto'                     => 9,
                'fecha'                           => '2026-03-18',
                'estado_revision'                 => 9,
                'estado_notificaciones'           => 9,
                'estado_aceptado_portada'         => 9,
                'id_estado_aceptado_anteproyecto' => 9,
                'autorizacion_departamento'       => 9,
                'estado_permiso'                  => 9,
            ],
            [
                'id_anteproyecto'                 => 10,
                'id_alumno'                       => 10,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 10,
                'id_proyecto'                     => 10,
                'fecha'                           => '2026-03-27',
                'estado_revision'                 => 10,
                'estado_notificaciones'           => 10,
                'estado_aceptado_portada'         => 10,
                'id_estado_aceptado_anteproyecto' => 10,
                'autorizacion_departamento'       => 10,
                'estado_permiso'                  => 10,
            ],
            [
                'id_anteproyecto'                 => 11,
                'id_alumno'                       => 11,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 11,
                'id_proyecto'                     => 11,
                'fecha'                           => '2026-04-05',
                'estado_revision'                 => 11,
                'estado_notificaciones'           => 11,
                'estado_aceptado_portada'         => 11,
                'id_estado_aceptado_anteproyecto' => 11,
                'autorizacion_departamento'       => 11,
                'estado_permiso'                  => 11,
            ],
            [
                'id_anteproyecto'                 => 12,
                'id_alumno'                       => 12,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 12,
                'id_proyecto'                     => 12,
                'fecha'                           => '2026-04-14',
                'estado_revision'                 => 12,
                'estado_notificaciones'           => 12,
                'estado_aceptado_portada'         => 12,
                'id_estado_aceptado_anteproyecto' => 12,
                'autorizacion_departamento'       => 12,
                'estado_permiso'                  => 12,
            ],
            [
                'id_anteproyecto'                 => 13,
                'id_alumno'                       => 13,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 13,
                'id_proyecto'                     => 13,
                'fecha'                           => '2026-04-23',
                'estado_revision'                 => 13,
                'estado_notificaciones'           => 13,
                'estado_aceptado_portada'         => 13,
                'id_estado_aceptado_anteproyecto' => 13,
                'autorizacion_departamento'       => 13,
                'estado_permiso'                  => 13,
            ],
            [
                'id_anteproyecto'                 => 14,
                'id_alumno'                       => 14,
                'id_periodo'                      => 12,
                'estado_enviado'                  => 14,
                'id_proyecto'                     => 14,
                'fecha'                           => '2026-05-02',
                'estado_revision'                 => 14,
                'estado_notificaciones'           => 14,
                'estado_aceptado_portada'         => 14,
                'id_estado_aceptado_anteproyecto' => 14,
                'autorizacion_departamento'       => 14,
                'estado_permiso'                  => 14,
            ],
            [
                'id_anteproyecto'                 => 15,
                'id_alumno'                       => 15,
                'id_periodo'                      => 15,
                'estado_enviado'                  => 15,
                'id_proyecto'                     => 15,
                'fecha'                           => '2026-05-11',
                'estado_revision'                 => 15,
                'estado_notificaciones'           => 15,
                'estado_aceptado_portada'         => 15,
                'id_estado_aceptado_anteproyecto' => 15,
                'autorizacion_departamento'       => 15,
                'estado_permiso'                  => 15,
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
