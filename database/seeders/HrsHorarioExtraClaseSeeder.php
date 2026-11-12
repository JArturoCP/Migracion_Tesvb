<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_horario_extra_clase`.
 */
class HrsHorarioExtraClaseSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_horario_extra_clase` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            HrsAulasSeeder::class,
            HrsExtraClaseSeeder::class,
            HrsSemanasSeeder::class,
        ]);

        $tabla = 'hrs_horario_extra_clase';

        $llaves = [
            ['id_hr_extra'],
        ];

        $registros = [
            [
                'id_hr_extra'    => 1,
                'id_extra_clase' => 1,
                'id_semana'      => 1,
                'id_cargo'       => 'Id cargo horario e 1',
                'id_aula'        => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
            ],
            [
                'id_hr_extra'    => 2,
                'id_extra_clase' => 2,
                'id_semana'      => 2,
                'id_cargo'       => 'Id cargo horario e 2',
                'id_aula'        => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
            ],
            [
                'id_hr_extra'    => 3,
                'id_extra_clase' => 3,
                'id_semana'      => 3,
                'id_cargo'       => 'Id cargo horario e 3',
                'id_aula'        => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
            ],
            [
                'id_hr_extra'    => 4,
                'id_extra_clase' => 4,
                'id_semana'      => 4,
                'id_cargo'       => 'Id cargo horario e 4',
                'id_aula'        => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
            ],
            [
                'id_hr_extra'    => 5,
                'id_extra_clase' => 5,
                'id_semana'      => 5,
                'id_cargo'       => 'Id cargo horario e 5',
                'id_aula'        => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
            ],
            [
                'id_hr_extra'    => 6,
                'id_extra_clase' => 6,
                'id_semana'      => 6,
                'id_cargo'       => 'Id cargo horario e 6',
                'id_aula'        => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
            ],
            [
                'id_hr_extra'    => 7,
                'id_extra_clase' => 7,
                'id_semana'      => 7,
                'id_cargo'       => 'Id cargo horario e 7',
                'id_aula'        => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
            ],
            [
                'id_hr_extra'    => 8,
                'id_extra_clase' => 8,
                'id_semana'      => 8,
                'id_cargo'       => 'Id cargo horario e 8',
                'id_aula'        => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
            ],
            [
                'id_hr_extra'    => 9,
                'id_extra_clase' => 9,
                'id_semana'      => 9,
                'id_cargo'       => 'Id cargo horario e 9',
                'id_aula'        => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
            ],
            [
                'id_hr_extra'    => 10,
                'id_extra_clase' => 10,
                'id_semana'      => 10,
                'id_cargo'       => 'Id cargo horario 10',
                'id_aula'        => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
            ],
            [
                'id_hr_extra'    => 11,
                'id_extra_clase' => 11,
                'id_semana'      => 11,
                'id_cargo'       => 'Id cargo horario 11',
                'id_aula'        => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
            ],
            [
                'id_hr_extra'    => 12,
                'id_extra_clase' => 12,
                'id_semana'      => 12,
                'id_cargo'       => 'Id cargo horario 12',
                'id_aula'        => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
            ],
            [
                'id_hr_extra'    => 13,
                'id_extra_clase' => 13,
                'id_semana'      => 13,
                'id_cargo'       => 'Id cargo horario 13',
                'id_aula'        => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
            ],
            [
                'id_hr_extra'    => 14,
                'id_extra_clase' => 14,
                'id_semana'      => 14,
                'id_cargo'       => 'Id cargo horario 14',
                'id_aula'        => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
            ],
            [
                'id_hr_extra'    => 15,
                'id_extra_clase' => 15,
                'id_semana'      => 15,
                'id_cargo'       => 'Id cargo horario 15',
                'id_aula'        => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
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
