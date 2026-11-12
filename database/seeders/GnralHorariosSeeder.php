<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_horarios`.
 */
class GnralHorariosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_horarios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodoCarrerasSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'gnral_horarios';

        $llaves = [
            ['id_horario_profesor'],
        ];

        $registros = [
            [
                'id_horario_profesor' => 1,
                'id_periodo_carrera'  => 1,
                'id_personal'         => 1,
                'aprobado'            => '1',
                'updated_at'          => '2026-01-05 09:00:00',
                'created_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_horario_profesor' => 2,
                'id_periodo_carrera'  => 2,
                'id_personal'         => 2,
                'aprobado'            => '2',
                'updated_at'          => '2026-01-14 10:00:00',
                'created_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_horario_profesor' => 3,
                'id_periodo_carrera'  => 3,
                'id_personal'         => 3,
                'aprobado'            => '3',
                'updated_at'          => '2026-01-23 11:00:00',
                'created_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_horario_profesor' => 4,
                'id_periodo_carrera'  => 4,
                'id_personal'         => 4,
                'aprobado'            => '4',
                'updated_at'          => '2026-02-01 12:00:00',
                'created_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_horario_profesor' => 5,
                'id_periodo_carrera'  => 5,
                'id_personal'         => 5,
                'aprobado'            => '5',
                'updated_at'          => '2026-02-10 13:00:00',
                'created_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_horario_profesor' => 6,
                'id_periodo_carrera'  => 6,
                'id_personal'         => 6,
                'aprobado'            => '6',
                'updated_at'          => '2026-02-19 14:00:00',
                'created_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_horario_profesor' => 7,
                'id_periodo_carrera'  => 7,
                'id_personal'         => 7,
                'aprobado'            => '7',
                'updated_at'          => '2026-02-28 15:00:00',
                'created_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_horario_profesor' => 8,
                'id_periodo_carrera'  => 8,
                'id_personal'         => 8,
                'aprobado'            => '8',
                'updated_at'          => '2026-03-09 16:00:00',
                'created_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_horario_profesor' => 9,
                'id_periodo_carrera'  => 9,
                'id_personal'         => 9,
                'aprobado'            => '9',
                'updated_at'          => '2026-03-18 08:00:00',
                'created_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_horario_profesor' => 10,
                'id_periodo_carrera'  => 10,
                'id_personal'         => 10,
                'aprobado'            => '10',
                'updated_at'          => '2026-03-27 09:00:00',
                'created_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_horario_profesor' => 11,
                'id_periodo_carrera'  => 11,
                'id_personal'         => 11,
                'aprobado'            => '11',
                'updated_at'          => '2026-04-05 10:00:00',
                'created_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_horario_profesor' => 12,
                'id_periodo_carrera'  => 12,
                'id_personal'         => 12,
                'aprobado'            => '12',
                'updated_at'          => '2026-04-14 11:00:00',
                'created_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_horario_profesor' => 13,
                'id_periodo_carrera'  => 13,
                'id_personal'         => 13,
                'aprobado'            => '13',
                'updated_at'          => '2026-04-23 12:00:00',
                'created_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_horario_profesor' => 14,
                'id_periodo_carrera'  => 14,
                'id_personal'         => 14,
                'aprobado'            => '14',
                'updated_at'          => '2026-05-02 13:00:00',
                'created_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_horario_profesor' => 15,
                'id_periodo_carrera'  => 15,
                'id_personal'         => 15,
                'aprobado'            => '15',
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
