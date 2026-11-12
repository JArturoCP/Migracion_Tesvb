<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_registros_coordinadores`.
 */
class ActcompleRegistrosCoordinadoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_registros_coordinadores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleDocenteActividadSeeder::class,
            GnralPeriodoCarrerasSeeder::class,
        ]);

        $tabla = 'actcomple_registros_coordinadores';

        $llaves = [
            ['id_reg_coordinador'],
        ];

        $registros = [
            [
                'id_reg_coordinador'   => 1,
                'vigencia'             => 1,
                'no_evidencias'        => 1,
                'rubrica'              => 'Rubrica registros coordinadores 1',
                'id_periodo_carrera'   => 1,
                'fecha_registro'       => '2026-01-05',
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'id_docente_actividad' => 1,
                'estado_evidencias'    => 1,
            ],
            [
                'id_reg_coordinador'   => 2,
                'vigencia'             => 2,
                'no_evidencias'        => 2,
                'rubrica'              => 'Rubrica registros coordinadores 2',
                'id_periodo_carrera'   => 2,
                'fecha_registro'       => '2026-01-14',
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'id_docente_actividad' => 2,
                'estado_evidencias'    => 2,
            ],
            [
                'id_reg_coordinador'   => 3,
                'vigencia'             => 3,
                'no_evidencias'        => 3,
                'rubrica'              => 'Rubrica registros coordinadores 3',
                'id_periodo_carrera'   => 3,
                'fecha_registro'       => '2026-01-23',
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'id_docente_actividad' => 3,
                'estado_evidencias'    => 3,
            ],
            [
                'id_reg_coordinador'   => 4,
                'vigencia'             => 4,
                'no_evidencias'        => 4,
                'rubrica'              => 'Rubrica registros coordinadores 4',
                'id_periodo_carrera'   => 4,
                'fecha_registro'       => '2026-02-01',
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'id_docente_actividad' => 4,
                'estado_evidencias'    => 4,
            ],
            [
                'id_reg_coordinador'   => 5,
                'vigencia'             => 5,
                'no_evidencias'        => 5,
                'rubrica'              => 'Rubrica registros coordinadores 5',
                'id_periodo_carrera'   => 5,
                'fecha_registro'       => '2026-02-10',
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'id_docente_actividad' => 5,
                'estado_evidencias'    => 5,
            ],
            [
                'id_reg_coordinador'   => 6,
                'vigencia'             => 6,
                'no_evidencias'        => 6,
                'rubrica'              => 'Rubrica registros coordinadores 6',
                'id_periodo_carrera'   => 6,
                'fecha_registro'       => '2026-02-19',
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'id_docente_actividad' => 6,
                'estado_evidencias'    => 6,
            ],
            [
                'id_reg_coordinador'   => 7,
                'vigencia'             => 7,
                'no_evidencias'        => 7,
                'rubrica'              => 'Rubrica registros coordinadores 7',
                'id_periodo_carrera'   => 7,
                'fecha_registro'       => '2026-02-28',
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'id_docente_actividad' => 7,
                'estado_evidencias'    => 7,
            ],
            [
                'id_reg_coordinador'   => 8,
                'vigencia'             => 8,
                'no_evidencias'        => 8,
                'rubrica'              => 'Rubrica registros coordinadores 8',
                'id_periodo_carrera'   => 8,
                'fecha_registro'       => '2026-03-09',
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'id_docente_actividad' => 8,
                'estado_evidencias'    => 8,
            ],
            [
                'id_reg_coordinador'   => 9,
                'vigencia'             => 9,
                'no_evidencias'        => 9,
                'rubrica'              => 'Rubrica registros coordinadores 9',
                'id_periodo_carrera'   => 9,
                'fecha_registro'       => '2026-03-18',
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'id_docente_actividad' => 9,
                'estado_evidencias'    => 9,
            ],
            [
                'id_reg_coordinador'   => 10,
                'vigencia'             => 10,
                'no_evidencias'        => 10,
                'rubrica'              => 'Rubrica registros coordinadores 10',
                'id_periodo_carrera'   => 10,
                'fecha_registro'       => '2026-03-27',
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'id_docente_actividad' => 10,
                'estado_evidencias'    => 10,
            ],
            [
                'id_reg_coordinador'   => 11,
                'vigencia'             => 11,
                'no_evidencias'        => 11,
                'rubrica'              => 'Rubrica registros coordinadores 11',
                'id_periodo_carrera'   => 11,
                'fecha_registro'       => '2026-04-05',
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'id_docente_actividad' => 11,
                'estado_evidencias'    => 11,
            ],
            [
                'id_reg_coordinador'   => 12,
                'vigencia'             => 12,
                'no_evidencias'        => 12,
                'rubrica'              => 'Rubrica registros coordinadores 12',
                'id_periodo_carrera'   => 12,
                'fecha_registro'       => '2026-04-14',
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'id_docente_actividad' => 12,
                'estado_evidencias'    => 12,
            ],
            [
                'id_reg_coordinador'   => 13,
                'vigencia'             => 13,
                'no_evidencias'        => 13,
                'rubrica'              => 'Rubrica registros coordinadores 13',
                'id_periodo_carrera'   => 13,
                'fecha_registro'       => '2026-04-23',
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'id_docente_actividad' => 13,
                'estado_evidencias'    => 13,
            ],
            [
                'id_reg_coordinador'   => 14,
                'vigencia'             => 14,
                'no_evidencias'        => 14,
                'rubrica'              => 'Rubrica registros coordinadores 14',
                'id_periodo_carrera'   => 14,
                'fecha_registro'       => '2026-05-02',
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'id_docente_actividad' => 14,
                'estado_evidencias'    => 14,
            ],
            [
                'id_reg_coordinador'   => 15,
                'vigencia'             => 15,
                'no_evidencias'        => 15,
                'rubrica'              => 'Rubrica registros coordinadores 15',
                'id_periodo_carrera'   => 15,
                'fecha_registro'       => '2026-05-11',
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'id_docente_actividad' => 15,
                'estado_evidencias'    => 15,
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
