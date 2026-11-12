<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_caso_actividad_revisiones`.
 */
class ArCasoActividadRevisionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_caso_actividad_revisiones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArCasoActividadEntregasSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_caso_actividad_revisiones';

        $llaves = [
            ['id_ar_revision'],
        ];

        $registros = [
            [
                'id_ar_revision'         => 1,
                'id_ar_entrega'          => 1,
                'fecha_revision'         => '2026-01-05 09:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 77,
                'estado_revision'        => 'Estado revision caso activid 1',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 1.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 1.',
                'id_personal_revisa'     => 1,
                'id_usuario_revisa'      => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_revision'         => 2,
                'id_ar_entrega'          => 2,
                'fecha_revision'         => '2026-01-14 10:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 84,
                'estado_revision'        => 'Estado revision caso activid 2',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 2.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 2.',
                'id_personal_revisa'     => 2,
                'id_usuario_revisa'      => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_revision'         => 3,
                'id_ar_entrega'          => 3,
                'fecha_revision'         => '2026-01-23 11:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 91,
                'estado_revision'        => 'Estado revision caso activid 3',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 3.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 3.',
                'id_personal_revisa'     => 3,
                'id_usuario_revisa'      => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_revision'         => 4,
                'id_ar_entrega'          => 4,
                'fecha_revision'         => '2026-02-01 12:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 98,
                'estado_revision'        => 'Estado revision caso activid 4',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 4.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 4.',
                'id_personal_revisa'     => 4,
                'id_usuario_revisa'      => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_revision'         => 5,
                'id_ar_entrega'          => 5,
                'fecha_revision'         => '2026-02-10 13:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 74,
                'estado_revision'        => 'Estado revision caso activid 5',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 5.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 5.',
                'id_personal_revisa'     => 5,
                'id_usuario_revisa'      => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_revision'         => 6,
                'id_ar_entrega'          => 6,
                'fecha_revision'         => '2026-02-19 14:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 81,
                'estado_revision'        => 'Estado revision caso activid 6',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 6.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 6.',
                'id_personal_revisa'     => 6,
                'id_usuario_revisa'      => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_revision'         => 7,
                'id_ar_entrega'          => 7,
                'fecha_revision'         => '2026-02-28 15:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 88,
                'estado_revision'        => 'Estado revision caso activid 7',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 7.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 7.',
                'id_personal_revisa'     => 7,
                'id_usuario_revisa'      => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_revision'         => 8,
                'id_ar_entrega'          => 8,
                'fecha_revision'         => '2026-03-09 16:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 95,
                'estado_revision'        => 'Estado revision caso activid 8',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 8.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 8.',
                'id_personal_revisa'     => 8,
                'id_usuario_revisa'      => 8,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_revision'         => 9,
                'id_ar_entrega'          => 9,
                'fecha_revision'         => '2026-03-18 08:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 71,
                'estado_revision'        => 'Estado revision caso activid 9',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 9.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 9.',
                'id_personal_revisa'     => 9,
                'id_usuario_revisa'      => 9,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_revision'         => 10,
                'id_ar_entrega'          => 10,
                'fecha_revision'         => '2026-03-27 09:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 78,
                'estado_revision'        => 'Estado revision caso activi 10',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 10.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 10.',
                'id_personal_revisa'     => 10,
                'id_usuario_revisa'      => 10,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_revision'         => 11,
                'id_ar_entrega'          => 11,
                'fecha_revision'         => '2026-04-05 10:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 85,
                'estado_revision'        => 'Estado revision caso activi 11',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 11.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 11.',
                'id_personal_revisa'     => 11,
                'id_usuario_revisa'      => 11,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_revision'         => 12,
                'id_ar_entrega'          => 12,
                'fecha_revision'         => '2026-04-14 11:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 92,
                'estado_revision'        => 'Estado revision caso activi 12',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 12.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 12.',
                'id_personal_revisa'     => 12,
                'id_usuario_revisa'      => 12,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_revision'         => 13,
                'id_ar_entrega'          => 13,
                'fecha_revision'         => '2026-04-23 12:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 99,
                'estado_revision'        => 'Estado revision caso activi 13',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 13.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 13.',
                'id_personal_revisa'     => 13,
                'id_usuario_revisa'      => 13,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_revision'         => 14,
                'id_ar_entrega'          => 14,
                'fecha_revision'         => '2026-05-02 13:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 75,
                'estado_revision'        => 'Estado revision caso activi 14',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 14.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 14.',
                'id_personal_revisa'     => 14,
                'id_usuario_revisa'      => 14,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_revision'         => 15,
                'id_ar_entrega'          => 15,
                'fecha_revision'         => '2026-05-11 14:00:00',
                'validada'               => 1,
                'calificacion_estrellas' => 82,
                'estado_revision'        => 'Estado revision caso activi 15',
                'comentarios'            => 'Comentarios de caso actividad revisiones: registro de prueba número 15.',
                'recomendaciones'        => 'Recomendaciones de caso actividad revisiones: registro de prueba número 15.',
                'id_personal_revisa'     => 15,
                'id_usuario_revisa'      => 15,
                'created_at'             => '2026-05-11 14:00:00',
                'updated_at'             => '2026-05-11 14:00:00',
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
