<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_evaluaciones`.
 */
class ActcompleEvaluacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_evaluaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleEvidenciasAlumnoSeeder::class,
        ]);

        $tabla = 'actcomple_evaluaciones';

        $llaves = [
            ['id_evaluacion'],
        ];

        $registros = [
            [
                'id_evaluacion'       => 1,
                'estado'              => 1,
                'abreviaciones'       => 'ABR1',
                'id_evidencia_alumno' => 1,
                'calificacion'        => 77,
                'updated_at'          => '2026-01-05 09:00:00',
                'created_at'          => '2026-01-05 09:00:00',
                'cuenta'              => 202610001,
            ],
            [
                'id_evaluacion'       => 2,
                'estado'              => 2,
                'abreviaciones'       => 'ABR2',
                'id_evidencia_alumno' => 2,
                'calificacion'        => 84,
                'updated_at'          => '2026-01-14 10:00:00',
                'created_at'          => '2026-01-14 10:00:00',
                'cuenta'              => 202610002,
            ],
            [
                'id_evaluacion'       => 3,
                'estado'              => 3,
                'abreviaciones'       => 'ABR3',
                'id_evidencia_alumno' => 3,
                'calificacion'        => 91,
                'updated_at'          => '2026-01-23 11:00:00',
                'created_at'          => '2026-01-23 11:00:00',
                'cuenta'              => 202610003,
            ],
            [
                'id_evaluacion'       => 4,
                'estado'              => 4,
                'abreviaciones'       => 'ABR4',
                'id_evidencia_alumno' => 4,
                'calificacion'        => 98,
                'updated_at'          => '2026-02-01 12:00:00',
                'created_at'          => '2026-02-01 12:00:00',
                'cuenta'              => 202610004,
            ],
            [
                'id_evaluacion'       => 5,
                'estado'              => 5,
                'abreviaciones'       => 'ABR5',
                'id_evidencia_alumno' => 5,
                'calificacion'        => 74,
                'updated_at'          => '2026-02-10 13:00:00',
                'created_at'          => '2026-02-10 13:00:00',
                'cuenta'              => 202610005,
            ],
            [
                'id_evaluacion'       => 6,
                'estado'              => 6,
                'abreviaciones'       => 'ABR6',
                'id_evidencia_alumno' => 6,
                'calificacion'        => 81,
                'updated_at'          => '2026-02-19 14:00:00',
                'created_at'          => '2026-02-19 14:00:00',
                'cuenta'              => 202610006,
            ],
            [
                'id_evaluacion'       => 7,
                'estado'              => 7,
                'abreviaciones'       => 'ABR7',
                'id_evidencia_alumno' => 7,
                'calificacion'        => 88,
                'updated_at'          => '2026-02-28 15:00:00',
                'created_at'          => '2026-02-28 15:00:00',
                'cuenta'              => 202610007,
            ],
            [
                'id_evaluacion'       => 8,
                'estado'              => 8,
                'abreviaciones'       => 'ABR8',
                'id_evidencia_alumno' => 8,
                'calificacion'        => 95,
                'updated_at'          => '2026-03-09 16:00:00',
                'created_at'          => '2026-03-09 16:00:00',
                'cuenta'              => 202610008,
            ],
            [
                'id_evaluacion'       => 9,
                'estado'              => 9,
                'abreviaciones'       => 'ABR9',
                'id_evidencia_alumno' => 9,
                'calificacion'        => 71,
                'updated_at'          => '2026-03-18 08:00:00',
                'created_at'          => '2026-03-18 08:00:00',
                'cuenta'              => 202610009,
            ],
            [
                'id_evaluacion'       => 10,
                'estado'              => 10,
                'abreviaciones'       => 'ABR10',
                'id_evidencia_alumno' => 10,
                'calificacion'        => 78,
                'updated_at'          => '2026-03-27 09:00:00',
                'created_at'          => '2026-03-27 09:00:00',
                'cuenta'              => 202610010,
            ],
            [
                'id_evaluacion'       => 11,
                'estado'              => 11,
                'abreviaciones'       => 'ABR11',
                'id_evidencia_alumno' => 11,
                'calificacion'        => 85,
                'updated_at'          => '2026-04-05 10:00:00',
                'created_at'          => '2026-04-05 10:00:00',
                'cuenta'              => 202610011,
            ],
            [
                'id_evaluacion'       => 12,
                'estado'              => 12,
                'abreviaciones'       => 'ABR12',
                'id_evidencia_alumno' => 12,
                'calificacion'        => 92,
                'updated_at'          => '2026-04-14 11:00:00',
                'created_at'          => '2026-04-14 11:00:00',
                'cuenta'              => 202610012,
            ],
            [
                'id_evaluacion'       => 13,
                'estado'              => 13,
                'abreviaciones'       => 'ABR13',
                'id_evidencia_alumno' => 13,
                'calificacion'        => 99,
                'updated_at'          => '2026-04-23 12:00:00',
                'created_at'          => '2026-04-23 12:00:00',
                'cuenta'              => 202610013,
            ],
            [
                'id_evaluacion'       => 14,
                'estado'              => 14,
                'abreviaciones'       => 'ABR14',
                'id_evidencia_alumno' => 14,
                'calificacion'        => 75,
                'updated_at'          => '2026-05-02 13:00:00',
                'created_at'          => '2026-05-02 13:00:00',
                'cuenta'              => 202610014,
            ],
            [
                'id_evaluacion'       => 15,
                'estado'              => 15,
                'abreviaciones'       => 'ABR15',
                'id_evidencia_alumno' => 15,
                'calificacion'        => 82,
                'updated_at'          => '2026-05-11 14:00:00',
                'created_at'          => '2026-05-11 14:00:00',
                'cuenta'              => 202610015,
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
