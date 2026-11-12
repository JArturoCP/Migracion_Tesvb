<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_alumno_materias`.
 */
class EvaAlumnoMateriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_alumno_materias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralHorasProfesoresSeeder::class,
        ]);

        $tabla = 'eva_alumno_materias';

        $llaves = [
            ['id_alumno_materia'],
        ];

        $registros = [
            [
                'id_alumno_materia' => 1,
                'cuenta'            => '202610001',
                'id_hrs_profesor'   => 1,
                'updated_at'        => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_alumno_materia' => 2,
                'cuenta'            => '202610002',
                'id_hrs_profesor'   => 2,
                'updated_at'        => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_alumno_materia' => 3,
                'cuenta'            => '202610003',
                'id_hrs_profesor'   => 3,
                'updated_at'        => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_alumno_materia' => 4,
                'cuenta'            => '202610004',
                'id_hrs_profesor'   => 4,
                'updated_at'        => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_alumno_materia' => 5,
                'cuenta'            => '202610005',
                'id_hrs_profesor'   => 5,
                'updated_at'        => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_alumno_materia' => 6,
                'cuenta'            => '202610006',
                'id_hrs_profesor'   => 6,
                'updated_at'        => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_alumno_materia' => 7,
                'cuenta'            => '202610007',
                'id_hrs_profesor'   => 7,
                'updated_at'        => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_alumno_materia' => 8,
                'cuenta'            => '202610008',
                'id_hrs_profesor'   => 8,
                'updated_at'        => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_alumno_materia' => 9,
                'cuenta'            => '202610009',
                'id_hrs_profesor'   => 9,
                'updated_at'        => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_alumno_materia' => 10,
                'cuenta'            => '202610010',
                'id_hrs_profesor'   => 10,
                'updated_at'        => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_alumno_materia' => 11,
                'cuenta'            => '202610011',
                'id_hrs_profesor'   => 11,
                'updated_at'        => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_alumno_materia' => 12,
                'cuenta'            => '202610012',
                'id_hrs_profesor'   => 12,
                'updated_at'        => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_alumno_materia' => 13,
                'cuenta'            => '202610013',
                'id_hrs_profesor'   => 13,
                'updated_at'        => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_alumno_materia' => 14,
                'cuenta'            => '202610014',
                'id_hrs_profesor'   => 14,
                'updated_at'        => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_alumno_materia' => 15,
                'cuenta'            => '202610015',
                'id_hrs_profesor'   => 15,
                'updated_at'        => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
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
