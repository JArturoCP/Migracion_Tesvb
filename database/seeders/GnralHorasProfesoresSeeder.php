<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_horas_profesores`.
 */
class GnralHorasProfesoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_horas_profesores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralHorariosSeeder::class,
            GnralMateriasPerfilesSeeder::class,
        ]);

        $tabla = 'gnral_horas_profesores';

        $llaves = [
            ['id_hrs_profesor'],
        ];

        $registros = [
            [
                'id_hrs_profesor'     => 1,
                'id_horario_profesor' => 1,
                'grupo'               => 1,
                'id_materia_perfil'   => 1,
                'updated_at'          => '2026-01-05 09:00:00',
                'created_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_hrs_profesor'     => 2,
                'id_horario_profesor' => 2,
                'grupo'               => 2,
                'id_materia_perfil'   => 2,
                'updated_at'          => '2026-01-14 10:00:00',
                'created_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_hrs_profesor'     => 3,
                'id_horario_profesor' => 3,
                'grupo'               => 3,
                'id_materia_perfil'   => 3,
                'updated_at'          => '2026-01-23 11:00:00',
                'created_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_hrs_profesor'     => 4,
                'id_horario_profesor' => 4,
                'grupo'               => 4,
                'id_materia_perfil'   => 4,
                'updated_at'          => '2026-02-01 12:00:00',
                'created_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_hrs_profesor'     => 5,
                'id_horario_profesor' => 5,
                'grupo'               => 5,
                'id_materia_perfil'   => 5,
                'updated_at'          => '2026-02-10 13:00:00',
                'created_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_hrs_profesor'     => 6,
                'id_horario_profesor' => 6,
                'grupo'               => 6,
                'id_materia_perfil'   => 6,
                'updated_at'          => '2026-02-19 14:00:00',
                'created_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_hrs_profesor'     => 7,
                'id_horario_profesor' => 7,
                'grupo'               => 7,
                'id_materia_perfil'   => 7,
                'updated_at'          => '2026-02-28 15:00:00',
                'created_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_hrs_profesor'     => 8,
                'id_horario_profesor' => 8,
                'grupo'               => 8,
                'id_materia_perfil'   => 8,
                'updated_at'          => '2026-03-09 16:00:00',
                'created_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_hrs_profesor'     => 9,
                'id_horario_profesor' => 9,
                'grupo'               => 9,
                'id_materia_perfil'   => 9,
                'updated_at'          => '2026-03-18 08:00:00',
                'created_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_hrs_profesor'     => 10,
                'id_horario_profesor' => 10,
                'grupo'               => 10,
                'id_materia_perfil'   => 10,
                'updated_at'          => '2026-03-27 09:00:00',
                'created_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_hrs_profesor'     => 11,
                'id_horario_profesor' => 11,
                'grupo'               => 11,
                'id_materia_perfil'   => 11,
                'updated_at'          => '2026-04-05 10:00:00',
                'created_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_hrs_profesor'     => 12,
                'id_horario_profesor' => 12,
                'grupo'               => 12,
                'id_materia_perfil'   => 12,
                'updated_at'          => '2026-04-14 11:00:00',
                'created_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_hrs_profesor'     => 13,
                'id_horario_profesor' => 13,
                'grupo'               => 13,
                'id_materia_perfil'   => 13,
                'updated_at'          => '2026-04-23 12:00:00',
                'created_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_hrs_profesor'     => 14,
                'id_horario_profesor' => 14,
                'grupo'               => 14,
                'id_materia_perfil'   => 14,
                'updated_at'          => '2026-05-02 13:00:00',
                'created_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_hrs_profesor'     => 15,
                'id_horario_profesor' => 15,
                'grupo'               => 15,
                'id_materia_perfil'   => 15,
                'updated_at'          => '2026-05-11 14:00:00',
                'created_at'          => '2026-05-11 14:00:00',
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
