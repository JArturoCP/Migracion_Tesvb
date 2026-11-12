<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_rhps`.
 */
class HrsRhpsSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_rhps` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralHorasProfesoresSeeder::class,
            HrsAulasSeeder::class,
            HrsSemanasSeeder::class,
        ]);

        $tabla = 'hrs_rhps';

        $llaves = [
            ['id_rhps'],
        ];

        $registros = [
            [
                'id_rhps'         => 1,
                'id_hrs_profesor' => 1,
                'id_semana'       => 1,
                'id_cargo'        => 'Id cargo rhps 1',
                'id_aula'         => 1,
                'updated_at'      => '2026-01-05 09:00:00',
                'created_at'      => '2026-01-05 09:00:00',
            ],
            [
                'id_rhps'         => 2,
                'id_hrs_profesor' => 2,
                'id_semana'       => 2,
                'id_cargo'        => 'Id cargo rhps 2',
                'id_aula'         => 2,
                'updated_at'      => '2026-01-14 10:00:00',
                'created_at'      => '2026-01-14 10:00:00',
            ],
            [
                'id_rhps'         => 3,
                'id_hrs_profesor' => 3,
                'id_semana'       => 3,
                'id_cargo'        => 'Id cargo rhps 3',
                'id_aula'         => 3,
                'updated_at'      => '2026-01-23 11:00:00',
                'created_at'      => '2026-01-23 11:00:00',
            ],
            [
                'id_rhps'         => 4,
                'id_hrs_profesor' => 4,
                'id_semana'       => 4,
                'id_cargo'        => 'Id cargo rhps 4',
                'id_aula'         => 4,
                'updated_at'      => '2026-02-01 12:00:00',
                'created_at'      => '2026-02-01 12:00:00',
            ],
            [
                'id_rhps'         => 5,
                'id_hrs_profesor' => 5,
                'id_semana'       => 5,
                'id_cargo'        => 'Id cargo rhps 5',
                'id_aula'         => 5,
                'updated_at'      => '2026-02-10 13:00:00',
                'created_at'      => '2026-02-10 13:00:00',
            ],
            [
                'id_rhps'         => 6,
                'id_hrs_profesor' => 6,
                'id_semana'       => 6,
                'id_cargo'        => 'Id cargo rhps 6',
                'id_aula'         => 6,
                'updated_at'      => '2026-02-19 14:00:00',
                'created_at'      => '2026-02-19 14:00:00',
            ],
            [
                'id_rhps'         => 7,
                'id_hrs_profesor' => 7,
                'id_semana'       => 7,
                'id_cargo'        => 'Id cargo rhps 7',
                'id_aula'         => 7,
                'updated_at'      => '2026-02-28 15:00:00',
                'created_at'      => '2026-02-28 15:00:00',
            ],
            [
                'id_rhps'         => 8,
                'id_hrs_profesor' => 8,
                'id_semana'       => 8,
                'id_cargo'        => 'Id cargo rhps 8',
                'id_aula'         => 8,
                'updated_at'      => '2026-03-09 16:00:00',
                'created_at'      => '2026-03-09 16:00:00',
            ],
            [
                'id_rhps'         => 9,
                'id_hrs_profesor' => 9,
                'id_semana'       => 9,
                'id_cargo'        => 'Id cargo rhps 9',
                'id_aula'         => 9,
                'updated_at'      => '2026-03-18 08:00:00',
                'created_at'      => '2026-03-18 08:00:00',
            ],
            [
                'id_rhps'         => 10,
                'id_hrs_profesor' => 10,
                'id_semana'       => 10,
                'id_cargo'        => 'Id cargo rhps 10',
                'id_aula'         => 10,
                'updated_at'      => '2026-03-27 09:00:00',
                'created_at'      => '2026-03-27 09:00:00',
            ],
            [
                'id_rhps'         => 11,
                'id_hrs_profesor' => 11,
                'id_semana'       => 11,
                'id_cargo'        => 'Id cargo rhps 11',
                'id_aula'         => 11,
                'updated_at'      => '2026-04-05 10:00:00',
                'created_at'      => '2026-04-05 10:00:00',
            ],
            [
                'id_rhps'         => 12,
                'id_hrs_profesor' => 12,
                'id_semana'       => 12,
                'id_cargo'        => 'Id cargo rhps 12',
                'id_aula'         => 12,
                'updated_at'      => '2026-04-14 11:00:00',
                'created_at'      => '2026-04-14 11:00:00',
            ],
            [
                'id_rhps'         => 13,
                'id_hrs_profesor' => 13,
                'id_semana'       => 13,
                'id_cargo'        => 'Id cargo rhps 13',
                'id_aula'         => 13,
                'updated_at'      => '2026-04-23 12:00:00',
                'created_at'      => '2026-04-23 12:00:00',
            ],
            [
                'id_rhps'         => 14,
                'id_hrs_profesor' => 14,
                'id_semana'       => 14,
                'id_cargo'        => 'Id cargo rhps 14',
                'id_aula'         => 14,
                'updated_at'      => '2026-05-02 13:00:00',
                'created_at'      => '2026-05-02 13:00:00',
            ],
            [
                'id_rhps'         => 15,
                'id_hrs_profesor' => 15,
                'id_semana'       => 15,
                'id_cargo'        => 'Id cargo rhps 15',
                'id_aula'         => 15,
                'updated_at'      => '2026-05-11 14:00:00',
                'created_at'      => '2026-05-11 14:00:00',
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
