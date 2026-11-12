<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_resultados_formulario`.
 */
class TuEvaResultadosFormularioSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_resultados_formulario` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaAlumnosSeeder::class,
            ExpAsignaTutorSeeder::class,
        ]);

        $tabla = 'tu_eva_resultados_formulario';

        $llaves = [
            ['id_eva_resultado'],
        ];

        $registros = [
            [
                'id_eva_resultado'                  => 1,
                'id_asigna_alumno'                  => 1,
                'id_asigna_tutor'                   => 1,
                'feccha_de_registro'                => '2026-01-05 09:00:00',
                'gestion'                           => 1,
                'actitud'                           => 1,
                'disponibilidad_confianza'          => 1,
                'servicios_del_programa_de_tutoria' => 1,
                'tus_logros_y_avances'              => 1,
                'comentario'                        => 'Comentario eva resultados formulario 1',
            ],
            [
                'id_eva_resultado'                  => 2,
                'id_asigna_alumno'                  => 2,
                'id_asigna_tutor'                   => 2,
                'feccha_de_registro'                => '2026-01-14 10:00:00',
                'gestion'                           => 2,
                'actitud'                           => 2,
                'disponibilidad_confianza'          => 2,
                'servicios_del_programa_de_tutoria' => 2,
                'tus_logros_y_avances'              => 2,
                'comentario'                        => 'Comentario eva resultados formulario 2',
            ],
            [
                'id_eva_resultado'                  => 3,
                'id_asigna_alumno'                  => 3,
                'id_asigna_tutor'                   => 3,
                'feccha_de_registro'                => '2026-01-23 11:00:00',
                'gestion'                           => 3,
                'actitud'                           => 3,
                'disponibilidad_confianza'          => 3,
                'servicios_del_programa_de_tutoria' => 3,
                'tus_logros_y_avances'              => 3,
                'comentario'                        => 'Comentario eva resultados formulario 3',
            ],
            [
                'id_eva_resultado'                  => 4,
                'id_asigna_alumno'                  => 4,
                'id_asigna_tutor'                   => 4,
                'feccha_de_registro'                => '2026-02-01 12:00:00',
                'gestion'                           => 4,
                'actitud'                           => 4,
                'disponibilidad_confianza'          => 4,
                'servicios_del_programa_de_tutoria' => 4,
                'tus_logros_y_avances'              => 4,
                'comentario'                        => 'Comentario eva resultados formulario 4',
            ],
            [
                'id_eva_resultado'                  => 5,
                'id_asigna_alumno'                  => 5,
                'id_asigna_tutor'                   => 5,
                'feccha_de_registro'                => '2026-02-10 13:00:00',
                'gestion'                           => 5,
                'actitud'                           => 5,
                'disponibilidad_confianza'          => 5,
                'servicios_del_programa_de_tutoria' => 5,
                'tus_logros_y_avances'              => 5,
                'comentario'                        => 'Comentario eva resultados formulario 5',
            ],
            [
                'id_eva_resultado'                  => 6,
                'id_asigna_alumno'                  => 6,
                'id_asigna_tutor'                   => 6,
                'feccha_de_registro'                => '2026-02-19 14:00:00',
                'gestion'                           => 6,
                'actitud'                           => 6,
                'disponibilidad_confianza'          => 6,
                'servicios_del_programa_de_tutoria' => 6,
                'tus_logros_y_avances'              => 6,
                'comentario'                        => 'Comentario eva resultados formulario 6',
            ],
            [
                'id_eva_resultado'                  => 7,
                'id_asigna_alumno'                  => 7,
                'id_asigna_tutor'                   => 7,
                'feccha_de_registro'                => '2026-02-28 15:00:00',
                'gestion'                           => 7,
                'actitud'                           => 7,
                'disponibilidad_confianza'          => 7,
                'servicios_del_programa_de_tutoria' => 7,
                'tus_logros_y_avances'              => 7,
                'comentario'                        => 'Comentario eva resultados formulario 7',
            ],
            [
                'id_eva_resultado'                  => 8,
                'id_asigna_alumno'                  => 8,
                'id_asigna_tutor'                   => 8,
                'feccha_de_registro'                => '2026-03-09 16:00:00',
                'gestion'                           => 8,
                'actitud'                           => 8,
                'disponibilidad_confianza'          => 8,
                'servicios_del_programa_de_tutoria' => 8,
                'tus_logros_y_avances'              => 8,
                'comentario'                        => 'Comentario eva resultados formulario 8',
            ],
            [
                'id_eva_resultado'                  => 9,
                'id_asigna_alumno'                  => 9,
                'id_asigna_tutor'                   => 9,
                'feccha_de_registro'                => '2026-03-18 08:00:00',
                'gestion'                           => 9,
                'actitud'                           => 9,
                'disponibilidad_confianza'          => 9,
                'servicios_del_programa_de_tutoria' => 9,
                'tus_logros_y_avances'              => 9,
                'comentario'                        => 'Comentario eva resultados formulario 9',
            ],
            [
                'id_eva_resultado'                  => 10,
                'id_asigna_alumno'                  => 10,
                'id_asigna_tutor'                   => 10,
                'feccha_de_registro'                => '2026-03-27 09:00:00',
                'gestion'                           => 10,
                'actitud'                           => 10,
                'disponibilidad_confianza'          => 10,
                'servicios_del_programa_de_tutoria' => 10,
                'tus_logros_y_avances'              => 10,
                'comentario'                        => 'Comentario eva resultados formulario 10',
            ],
            [
                'id_eva_resultado'                  => 11,
                'id_asigna_alumno'                  => 11,
                'id_asigna_tutor'                   => 11,
                'feccha_de_registro'                => '2026-04-05 10:00:00',
                'gestion'                           => 11,
                'actitud'                           => 11,
                'disponibilidad_confianza'          => 11,
                'servicios_del_programa_de_tutoria' => 11,
                'tus_logros_y_avances'              => 11,
                'comentario'                        => 'Comentario eva resultados formulario 11',
            ],
            [
                'id_eva_resultado'                  => 12,
                'id_asigna_alumno'                  => 12,
                'id_asigna_tutor'                   => 12,
                'feccha_de_registro'                => '2026-04-14 11:00:00',
                'gestion'                           => 12,
                'actitud'                           => 12,
                'disponibilidad_confianza'          => 12,
                'servicios_del_programa_de_tutoria' => 12,
                'tus_logros_y_avances'              => 12,
                'comentario'                        => 'Comentario eva resultados formulario 12',
            ],
            [
                'id_eva_resultado'                  => 13,
                'id_asigna_alumno'                  => 13,
                'id_asigna_tutor'                   => 13,
                'feccha_de_registro'                => '2026-04-23 12:00:00',
                'gestion'                           => 13,
                'actitud'                           => 13,
                'disponibilidad_confianza'          => 13,
                'servicios_del_programa_de_tutoria' => 13,
                'tus_logros_y_avances'              => 13,
                'comentario'                        => 'Comentario eva resultados formulario 13',
            ],
            [
                'id_eva_resultado'                  => 14,
                'id_asigna_alumno'                  => 14,
                'id_asigna_tutor'                   => 14,
                'feccha_de_registro'                => '2026-05-02 13:00:00',
                'gestion'                           => 14,
                'actitud'                           => 14,
                'disponibilidad_confianza'          => 14,
                'servicios_del_programa_de_tutoria' => 14,
                'tus_logros_y_avances'              => 14,
                'comentario'                        => 'Comentario eva resultados formulario 14',
            ],
            [
                'id_eva_resultado'                  => 15,
                'id_asigna_alumno'                  => 15,
                'id_asigna_tutor'                   => 15,
                'feccha_de_registro'                => '2026-05-11 14:00:00',
                'gestion'                           => 15,
                'actitud'                           => 15,
                'disponibilidad_confianza'          => 15,
                'servicios_del_programa_de_tutoria' => 15,
                'tus_logros_y_avances'              => 15,
                'comentario'                        => 'Comentario eva resultados formulario 15',
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
