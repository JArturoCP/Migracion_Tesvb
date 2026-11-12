<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_autoevaluacion`.
 */
class TuEvaAutoevaluacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_autoevaluacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaTutorSeeder::class,
            TuEvaTiempoTutorSeeder::class,
        ]);

        $tabla = 'tu_eva_autoevaluacion';

        $llaves = [
            ['id_eva_autoevaluacion'],
        ];

        $registros = [
            [
                'id_eva_autoevaluacion' => 1,
                'fecha_de_registro'     => '2026-01-05 09:00:00',
                'id_asigna_tutor'       => 1,
                'id_eva_tiempo_tutor'   => 1,
                'satisfacion'           => 7.3,
                'necesidades'           => 7.3,
                'factores'              => 7.3,
                'comentario'            => 'Comentario eva autoevaluacion 1',
            ],
            [
                'id_eva_autoevaluacion' => 2,
                'fecha_de_registro'     => '2026-01-14 10:00:00',
                'id_asigna_tutor'       => 2,
                'id_eva_tiempo_tutor'   => 2,
                'satisfacion'           => 7.6,
                'necesidades'           => 7.6,
                'factores'              => 7.6,
                'comentario'            => 'Comentario eva autoevaluacion 2',
            ],
            [
                'id_eva_autoevaluacion' => 3,
                'fecha_de_registro'     => '2026-01-23 11:00:00',
                'id_asigna_tutor'       => 3,
                'id_eva_tiempo_tutor'   => 3,
                'satisfacion'           => 7.9,
                'necesidades'           => 7.9,
                'factores'              => 7.9,
                'comentario'            => 'Comentario eva autoevaluacion 3',
            ],
            [
                'id_eva_autoevaluacion' => 4,
                'fecha_de_registro'     => '2026-02-01 12:00:00',
                'id_asigna_tutor'       => 4,
                'id_eva_tiempo_tutor'   => 4,
                'satisfacion'           => 8.2,
                'necesidades'           => 8.2,
                'factores'              => 8.2,
                'comentario'            => 'Comentario eva autoevaluacion 4',
            ],
            [
                'id_eva_autoevaluacion' => 5,
                'fecha_de_registro'     => '2026-02-10 13:00:00',
                'id_asigna_tutor'       => 5,
                'id_eva_tiempo_tutor'   => 5,
                'satisfacion'           => 8.5,
                'necesidades'           => 8.5,
                'factores'              => 8.5,
                'comentario'            => 'Comentario eva autoevaluacion 5',
            ],
            [
                'id_eva_autoevaluacion' => 6,
                'fecha_de_registro'     => '2026-02-19 14:00:00',
                'id_asigna_tutor'       => 6,
                'id_eva_tiempo_tutor'   => 6,
                'satisfacion'           => 8.8,
                'necesidades'           => 8.8,
                'factores'              => 8.8,
                'comentario'            => 'Comentario eva autoevaluacion 6',
            ],
            [
                'id_eva_autoevaluacion' => 7,
                'fecha_de_registro'     => '2026-02-28 15:00:00',
                'id_asigna_tutor'       => 7,
                'id_eva_tiempo_tutor'   => 7,
                'satisfacion'           => 9.1,
                'necesidades'           => 9.1,
                'factores'              => 9.1,
                'comentario'            => 'Comentario eva autoevaluacion 7',
            ],
            [
                'id_eva_autoevaluacion' => 8,
                'fecha_de_registro'     => '2026-03-09 16:00:00',
                'id_asigna_tutor'       => 8,
                'id_eva_tiempo_tutor'   => 8,
                'satisfacion'           => 9.4,
                'necesidades'           => 9.4,
                'factores'              => 9.4,
                'comentario'            => 'Comentario eva autoevaluacion 8',
            ],
            [
                'id_eva_autoevaluacion' => 9,
                'fecha_de_registro'     => '2026-03-18 08:00:00',
                'id_asigna_tutor'       => 9,
                'id_eva_tiempo_tutor'   => 9,
                'satisfacion'           => 9.7,
                'necesidades'           => 9.7,
                'factores'              => 9.7,
                'comentario'            => 'Comentario eva autoevaluacion 9',
            ],
            [
                'id_eva_autoevaluacion' => 10,
                'fecha_de_registro'     => '2026-03-27 09:00:00',
                'id_asigna_tutor'       => 10,
                'id_eva_tiempo_tutor'   => 10,
                'satisfacion'           => 7.0,
                'necesidades'           => 7.0,
                'factores'              => 7.0,
                'comentario'            => 'Comentario eva autoevaluacion 10',
            ],
            [
                'id_eva_autoevaluacion' => 11,
                'fecha_de_registro'     => '2026-04-05 10:00:00',
                'id_asigna_tutor'       => 11,
                'id_eva_tiempo_tutor'   => 11,
                'satisfacion'           => 7.3,
                'necesidades'           => 7.3,
                'factores'              => 7.3,
                'comentario'            => 'Comentario eva autoevaluacion 11',
            ],
            [
                'id_eva_autoevaluacion' => 12,
                'fecha_de_registro'     => '2026-04-14 11:00:00',
                'id_asigna_tutor'       => 12,
                'id_eva_tiempo_tutor'   => 12,
                'satisfacion'           => 7.6,
                'necesidades'           => 7.6,
                'factores'              => 7.6,
                'comentario'            => 'Comentario eva autoevaluacion 12',
            ],
            [
                'id_eva_autoevaluacion' => 13,
                'fecha_de_registro'     => '2026-04-23 12:00:00',
                'id_asigna_tutor'       => 13,
                'id_eva_tiempo_tutor'   => 13,
                'satisfacion'           => 7.9,
                'necesidades'           => 7.9,
                'factores'              => 7.9,
                'comentario'            => 'Comentario eva autoevaluacion 13',
            ],
            [
                'id_eva_autoevaluacion' => 14,
                'fecha_de_registro'     => '2026-05-02 13:00:00',
                'id_asigna_tutor'       => 14,
                'id_eva_tiempo_tutor'   => 14,
                'satisfacion'           => 8.2,
                'necesidades'           => 8.2,
                'factores'              => 8.2,
                'comentario'            => 'Comentario eva autoevaluacion 14',
            ],
            [
                'id_eva_autoevaluacion' => 15,
                'fecha_de_registro'     => '2026-05-11 14:00:00',
                'id_asigna_tutor'       => 15,
                'id_eva_tiempo_tutor'   => 15,
                'satisfacion'           => 8.5,
                'necesidades'           => 8.5,
                'factores'              => 8.5,
                'comentario'            => 'Comentario eva autoevaluacion 15',
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
