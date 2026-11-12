<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `planeacion`.
 */
class PlaneacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `planeacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralSemestresSeeder::class,
            PlanEstadosSeeder::class,
        ]);

        $tabla = 'planeacion';

        $llaves = [
            ['id_planeacion'],
        ];

        $registros = [
            [
                'id_planeacion'       => 1,
                'fecha_inicio_sesion' => '2026-01-05',
                'fecha_fin_sesion'    => '2026-01-05',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 1.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 1.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 1.',
                'id_semestre'         => 1,
                'id_estado'           => 1,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 1.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 1.',
                'id_sugerencia'       => 1,
                'id_estrategia'       => 1,
                'estrategia'          => 'Estrategia planeacion 1',
                'evidencia'           => 'documentos/planeacion/planeacion_1.pdf',
                'id_evidencia'        => 1,
            ],
            [
                'id_planeacion'       => 2,
                'fecha_inicio_sesion' => '2026-01-14',
                'fecha_fin_sesion'    => '2026-01-14',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 2.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 2.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 2.',
                'id_semestre'         => 2,
                'id_estado'           => 2,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 2.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 2.',
                'id_sugerencia'       => 2,
                'id_estrategia'       => 2,
                'estrategia'          => 'Estrategia planeacion 2',
                'evidencia'           => 'documentos/planeacion/planeacion_2.pdf',
                'id_evidencia'        => 2,
            ],
            [
                'id_planeacion'       => 3,
                'fecha_inicio_sesion' => '2026-01-23',
                'fecha_fin_sesion'    => '2026-01-23',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 3.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 3.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 3.',
                'id_semestre'         => 3,
                'id_estado'           => 3,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 3.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 3.',
                'id_sugerencia'       => 3,
                'id_estrategia'       => 3,
                'estrategia'          => 'Estrategia planeacion 3',
                'evidencia'           => 'documentos/planeacion/planeacion_3.pdf',
                'id_evidencia'        => 3,
            ],
            [
                'id_planeacion'       => 4,
                'fecha_inicio_sesion' => '2026-02-01',
                'fecha_fin_sesion'    => '2026-02-01',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 4.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 4.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 4.',
                'id_semestre'         => 4,
                'id_estado'           => 4,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 4.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 4.',
                'id_sugerencia'       => 4,
                'id_estrategia'       => 4,
                'estrategia'          => 'Estrategia planeacion 4',
                'evidencia'           => 'documentos/planeacion/planeacion_4.pdf',
                'id_evidencia'        => 4,
            ],
            [
                'id_planeacion'       => 5,
                'fecha_inicio_sesion' => '2026-02-10',
                'fecha_fin_sesion'    => '2026-02-10',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 5.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 5.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 5.',
                'id_semestre'         => 5,
                'id_estado'           => 5,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 5.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 5.',
                'id_sugerencia'       => 5,
                'id_estrategia'       => 5,
                'estrategia'          => 'Estrategia planeacion 5',
                'evidencia'           => 'documentos/planeacion/planeacion_5.pdf',
                'id_evidencia'        => 5,
            ],
            [
                'id_planeacion'       => 6,
                'fecha_inicio_sesion' => '2026-02-19',
                'fecha_fin_sesion'    => '2026-02-19',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 6.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 6.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 6.',
                'id_semestre'         => 6,
                'id_estado'           => 6,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 6.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 6.',
                'id_sugerencia'       => 6,
                'id_estrategia'       => 6,
                'estrategia'          => 'Estrategia planeacion 6',
                'evidencia'           => 'documentos/planeacion/planeacion_6.pdf',
                'id_evidencia'        => 6,
            ],
            [
                'id_planeacion'       => 7,
                'fecha_inicio_sesion' => '2026-02-28',
                'fecha_fin_sesion'    => '2026-02-28',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 7.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 7.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 7.',
                'id_semestre'         => 7,
                'id_estado'           => 7,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 7.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 7.',
                'id_sugerencia'       => 7,
                'id_estrategia'       => 7,
                'estrategia'          => 'Estrategia planeacion 7',
                'evidencia'           => 'documentos/planeacion/planeacion_7.pdf',
                'id_evidencia'        => 7,
            ],
            [
                'id_planeacion'       => 8,
                'fecha_inicio_sesion' => '2026-03-09',
                'fecha_fin_sesion'    => '2026-03-09',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 8.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 8.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 8.',
                'id_semestre'         => 8,
                'id_estado'           => 8,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 8.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 8.',
                'id_sugerencia'       => 8,
                'id_estrategia'       => 8,
                'estrategia'          => 'Estrategia planeacion 8',
                'evidencia'           => 'documentos/planeacion/planeacion_8.pdf',
                'id_evidencia'        => 8,
            ],
            [
                'id_planeacion'       => 9,
                'fecha_inicio_sesion' => '2026-03-18',
                'fecha_fin_sesion'    => '2026-03-18',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 9.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 9.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 9.',
                'id_semestre'         => 9,
                'id_estado'           => 9,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 9.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 9.',
                'id_sugerencia'       => 9,
                'id_estrategia'       => 9,
                'estrategia'          => 'Estrategia planeacion 9',
                'evidencia'           => 'documentos/planeacion/planeacion_9.pdf',
                'id_evidencia'        => 9,
            ],
            [
                'id_planeacion'       => 10,
                'fecha_inicio_sesion' => '2026-03-27',
                'fecha_fin_sesion'    => '2026-03-27',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 10.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 10.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 10.',
                'id_semestre'         => 10,
                'id_estado'           => 10,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 10.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 10.',
                'id_sugerencia'       => 10,
                'id_estrategia'       => 10,
                'estrategia'          => 'Estrategia planeacion 10',
                'evidencia'           => 'documentos/planeacion/planeacion_10.pdf',
                'id_evidencia'        => 10,
            ],
            [
                'id_planeacion'       => 11,
                'fecha_inicio_sesion' => '2026-04-05',
                'fecha_fin_sesion'    => '2026-04-05',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 11.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 11.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 11.',
                'id_semestre'         => 11,
                'id_estado'           => 11,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 11.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 11.',
                'id_sugerencia'       => 11,
                'id_estrategia'       => 11,
                'estrategia'          => 'Estrategia planeacion 11',
                'evidencia'           => 'documentos/planeacion/planeacion_11.pdf',
                'id_evidencia'        => 11,
            ],
            [
                'id_planeacion'       => 12,
                'fecha_inicio_sesion' => '2026-04-14',
                'fecha_fin_sesion'    => '2026-04-14',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 12.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 12.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 12.',
                'id_semestre'         => 12,
                'id_estado'           => 12,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 12.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 12.',
                'id_sugerencia'       => 12,
                'id_estrategia'       => 12,
                'estrategia'          => 'Estrategia planeacion 12',
                'evidencia'           => 'documentos/planeacion/planeacion_12.pdf',
                'id_evidencia'        => 12,
            ],
            [
                'id_planeacion'       => 13,
                'fecha_inicio_sesion' => '2026-04-23',
                'fecha_fin_sesion'    => '2026-04-23',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 13.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 13.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 13.',
                'id_semestre'         => 1,
                'id_estado'           => 13,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 13.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 13.',
                'id_sugerencia'       => 13,
                'id_estrategia'       => 13,
                'estrategia'          => 'Estrategia planeacion 13',
                'evidencia'           => 'documentos/planeacion/planeacion_13.pdf',
                'id_evidencia'        => 13,
            ],
            [
                'id_planeacion'       => 14,
                'fecha_inicio_sesion' => '2026-05-02',
                'fecha_fin_sesion'    => '2026-05-02',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 14.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 14.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 14.',
                'id_semestre'         => 2,
                'id_estado'           => 14,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 14.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 14.',
                'id_sugerencia'       => 14,
                'id_estrategia'       => 14,
                'estrategia'          => 'Estrategia planeacion 14',
                'evidencia'           => 'documentos/planeacion/planeacion_14.pdf',
                'id_evidencia'        => 14,
            ],
            [
                'id_planeacion'       => 15,
                'fecha_inicio_sesion' => '2026-05-11',
                'fecha_fin_sesion'    => '2026-05-11',
                'desc_actividad'      => 'Desc actividad de planeacion: registro de prueba número 15.',
                'objetivo'            => 'Objetivo de planeacion: registro de prueba número 15.',
                'instrucciones'       => 'Instrucciones de planeacion: registro de prueba número 15.',
                'id_semestre'         => 3,
                'id_estado'           => 15,
                'comentarios'         => 'Comentarios de planeacion: registro de prueba número 15.',
                'sugerencia'          => 'Sugerencia de planeacion: registro de prueba número 15.',
                'id_sugerencia'       => 15,
                'id_estrategia'       => 15,
                'estrategia'          => 'Estrategia planeacion 15',
                'evidencia'           => 'documentos/planeacion/planeacion_15.pdf',
                'id_evidencia'        => 15,
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
