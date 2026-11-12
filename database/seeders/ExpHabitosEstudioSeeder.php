<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_habitos_estudio`.
 */
class ExpHabitosEstudioSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_habitos_estudio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpOpcIntelectualSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'exp_habitos_estudio';

        $llaves = [
            ['id_exp_habitos_estudio'],
        ];

        $registros = [
            [
                'id_exp_habitos_estudio'      => 1,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 1',
                'id_opc_intelectual'          => 1,
                'forma_estudio'               => 'Forma estudio habitos estudio 1',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 1',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 1',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 1',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 1',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 1',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 1',
                'id_alumno'                   => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 2,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 2',
                'id_opc_intelectual'          => 2,
                'forma_estudio'               => 'Forma estudio habitos estudio 2',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 2',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 2',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 2',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 2',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 2',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 2',
                'id_alumno'                   => 2,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 3,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 3',
                'id_opc_intelectual'          => 3,
                'forma_estudio'               => 'Forma estudio habitos estudio 3',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 3',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 3',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 3',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 3',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 3',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 3',
                'id_alumno'                   => 3,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 4,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 4',
                'id_opc_intelectual'          => 4,
                'forma_estudio'               => 'Forma estudio habitos estudio 4',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 4',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 4',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 4',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 4',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 4',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 4',
                'id_alumno'                   => 4,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 5,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 5',
                'id_opc_intelectual'          => 5,
                'forma_estudio'               => 'Forma estudio habitos estudio 5',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 5',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 5',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 5',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 5',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 5',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 5',
                'id_alumno'                   => 5,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 6,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 6',
                'id_opc_intelectual'          => 6,
                'forma_estudio'               => 'Forma estudio habitos estudio 6',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 6',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 6',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 6',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 6',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 6',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 6',
                'id_alumno'                   => 6,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 7,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 7',
                'id_opc_intelectual'          => 7,
                'forma_estudio'               => 'Forma estudio habitos estudio 7',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 7',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 7',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 7',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 7',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 7',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 7',
                'id_alumno'                   => 7,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 8,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 8',
                'id_opc_intelectual'          => 8,
                'forma_estudio'               => 'Forma estudio habitos estudio 8',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 8',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 8',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 8',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 8',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 8',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 8',
                'id_alumno'                   => 8,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 9,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 9',
                'id_opc_intelectual'          => 9,
                'forma_estudio'               => 'Forma estudio habitos estudio 9',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 9',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 9',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 9',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 9',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 9',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 9',
                'id_alumno'                   => 9,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 10,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 10',
                'id_opc_intelectual'          => 10,
                'forma_estudio'               => 'Forma estudio habitos estudio 10',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 10',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 10',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 10',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 10',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 10',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 10',
                'id_alumno'                   => 10,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 11,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 11',
                'id_opc_intelectual'          => 11,
                'forma_estudio'               => 'Forma estudio habitos estudio 11',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 11',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 11',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 11',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 11',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 11',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 11',
                'id_alumno'                   => 11,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 12,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 12',
                'id_opc_intelectual'          => 12,
                'forma_estudio'               => 'Forma estudio habitos estudio 12',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 12',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 12',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 12',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 12',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 12',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 12',
                'id_alumno'                   => 12,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 13,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 13',
                'id_opc_intelectual'          => 13,
                'forma_estudio'               => 'Forma estudio habitos estudio 13',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 13',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 13',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 13',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 13',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 13',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 13',
                'id_alumno'                   => 13,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 14,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 14',
                'id_opc_intelectual'          => 14,
                'forma_estudio'               => 'Forma estudio habitos estudio 14',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 14',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 14',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 14',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 14',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 14',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 14',
                'id_alumno'                   => 14,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
            ],
            [
                'id_exp_habitos_estudio'      => 15,
                'tiempo_empleado_estudiar'    => 'Tiempo empleado estudiar habitos estudio 15',
                'id_opc_intelectual'          => 15,
                'forma_estudio'               => 'Forma estudio habitos estudio 15',
                'tiempo_libre'                => 'Tiempo libre habitos estudio 15',
                'asignatura_preferida'        => 'Asignatura preferida habitos estudio 15',
                'porque_asignatura'           => 'Porque asignatura habitos estudio 15',
                'asignatura_dificil'          => 'Asignatura dificil habitos estudio 15',
                'porque_asignatura_dificil'   => 'Porque asignatura dificil habitos estudio 15',
                'opinion_tu_mismo_estudiante' => 'Opinion tu mismo estudiante habitos estudio 15',
                'id_alumno'                   => 15,
                'created_at'                  => '2026-05-11 14:00:00',
                'updated_at'                  => '2026-05-11 14:00:00',
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
