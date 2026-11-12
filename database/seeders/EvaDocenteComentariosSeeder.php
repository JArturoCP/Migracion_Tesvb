<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_docente_comentarios`.
 */
class EvaDocenteComentariosSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_docente_comentarios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaAlumnoMateriasSeeder::class,
        ]);

        $tabla = 'eva_docente_comentarios';

        $llaves = [
            ['id_comentario'],
        ];

        $registros = [
            [
                'id_comentario'     => 1,
                'id_alumno_materia' => 1,
                'comentario'        => 'Comentario docente comentarios 1',
                'created_at'        => '2026-01-05 09:00:00',
                'updated_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_comentario'     => 2,
                'id_alumno_materia' => 2,
                'comentario'        => 'Comentario docente comentarios 2',
                'created_at'        => '2026-01-14 10:00:00',
                'updated_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_comentario'     => 3,
                'id_alumno_materia' => 3,
                'comentario'        => 'Comentario docente comentarios 3',
                'created_at'        => '2026-01-23 11:00:00',
                'updated_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_comentario'     => 4,
                'id_alumno_materia' => 4,
                'comentario'        => 'Comentario docente comentarios 4',
                'created_at'        => '2026-02-01 12:00:00',
                'updated_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_comentario'     => 5,
                'id_alumno_materia' => 5,
                'comentario'        => 'Comentario docente comentarios 5',
                'created_at'        => '2026-02-10 13:00:00',
                'updated_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_comentario'     => 6,
                'id_alumno_materia' => 6,
                'comentario'        => 'Comentario docente comentarios 6',
                'created_at'        => '2026-02-19 14:00:00',
                'updated_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_comentario'     => 7,
                'id_alumno_materia' => 7,
                'comentario'        => 'Comentario docente comentarios 7',
                'created_at'        => '2026-02-28 15:00:00',
                'updated_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_comentario'     => 8,
                'id_alumno_materia' => 8,
                'comentario'        => 'Comentario docente comentarios 8',
                'created_at'        => '2026-03-09 16:00:00',
                'updated_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_comentario'     => 9,
                'id_alumno_materia' => 9,
                'comentario'        => 'Comentario docente comentarios 9',
                'created_at'        => '2026-03-18 08:00:00',
                'updated_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_comentario'     => 10,
                'id_alumno_materia' => 10,
                'comentario'        => 'Comentario docente comentarios 10',
                'created_at'        => '2026-03-27 09:00:00',
                'updated_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_comentario'     => 11,
                'id_alumno_materia' => 11,
                'comentario'        => 'Comentario docente comentarios 11',
                'created_at'        => '2026-04-05 10:00:00',
                'updated_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_comentario'     => 12,
                'id_alumno_materia' => 12,
                'comentario'        => 'Comentario docente comentarios 12',
                'created_at'        => '2026-04-14 11:00:00',
                'updated_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_comentario'     => 13,
                'id_alumno_materia' => 13,
                'comentario'        => 'Comentario docente comentarios 13',
                'created_at'        => '2026-04-23 12:00:00',
                'updated_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_comentario'     => 14,
                'id_alumno_materia' => 14,
                'comentario'        => 'Comentario docente comentarios 14',
                'created_at'        => '2026-05-02 13:00:00',
                'updated_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_comentario'     => 15,
                'id_alumno_materia' => 15,
                'comentario'        => 'Comentario docente comentarios 15',
                'created_at'        => '2026-05-11 14:00:00',
                'updated_at'        => '2026-05-11 14:00:00',
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
