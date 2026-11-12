<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_distribucion_horas`.
 */
class HrsDistribucionHorasSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_distribucion_horas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralMateriasSeeder::class,
            GnralPeriodoCarrerasSeeder::class,
        ]);

        $tabla = 'hrs_distribucion_horas';

        $llaves = [
            ['id_distribucion_hora'],
        ];

        $registros = [
            [
                'id_distribucion_hora' => 1,
                'no_alum'              => 1,
                'alum_otras_carreras'  => 1,
                'hrs_docente'          => 1,
                'hrs_dir_atm_hono'     => 1,
                'directivo'            => 1,
                'atm'                  => 1,
                'honorarios'           => 1,
                'id_periodo_carrera'   => 1,
                'id_materia'           => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
            ],
            [
                'id_distribucion_hora' => 2,
                'no_alum'              => 2,
                'alum_otras_carreras'  => 2,
                'hrs_docente'          => 2,
                'hrs_dir_atm_hono'     => 2,
                'directivo'            => 2,
                'atm'                  => 2,
                'honorarios'           => 2,
                'id_periodo_carrera'   => 2,
                'id_materia'           => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
            ],
            [
                'id_distribucion_hora' => 3,
                'no_alum'              => 3,
                'alum_otras_carreras'  => 3,
                'hrs_docente'          => 3,
                'hrs_dir_atm_hono'     => 3,
                'directivo'            => 3,
                'atm'                  => 3,
                'honorarios'           => 3,
                'id_periodo_carrera'   => 3,
                'id_materia'           => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
            ],
            [
                'id_distribucion_hora' => 4,
                'no_alum'              => 4,
                'alum_otras_carreras'  => 4,
                'hrs_docente'          => 4,
                'hrs_dir_atm_hono'     => 4,
                'directivo'            => 4,
                'atm'                  => 4,
                'honorarios'           => 4,
                'id_periodo_carrera'   => 4,
                'id_materia'           => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
            ],
            [
                'id_distribucion_hora' => 5,
                'no_alum'              => 5,
                'alum_otras_carreras'  => 5,
                'hrs_docente'          => 5,
                'hrs_dir_atm_hono'     => 5,
                'directivo'            => 5,
                'atm'                  => 5,
                'honorarios'           => 5,
                'id_periodo_carrera'   => 5,
                'id_materia'           => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
            ],
            [
                'id_distribucion_hora' => 6,
                'no_alum'              => 6,
                'alum_otras_carreras'  => 6,
                'hrs_docente'          => 6,
                'hrs_dir_atm_hono'     => 6,
                'directivo'            => 6,
                'atm'                  => 6,
                'honorarios'           => 6,
                'id_periodo_carrera'   => 6,
                'id_materia'           => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
            ],
            [
                'id_distribucion_hora' => 7,
                'no_alum'              => 7,
                'alum_otras_carreras'  => 7,
                'hrs_docente'          => 7,
                'hrs_dir_atm_hono'     => 7,
                'directivo'            => 7,
                'atm'                  => 7,
                'honorarios'           => 7,
                'id_periodo_carrera'   => 7,
                'id_materia'           => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
            ],
            [
                'id_distribucion_hora' => 8,
                'no_alum'              => 8,
                'alum_otras_carreras'  => 8,
                'hrs_docente'          => 8,
                'hrs_dir_atm_hono'     => 8,
                'directivo'            => 8,
                'atm'                  => 8,
                'honorarios'           => 8,
                'id_periodo_carrera'   => 8,
                'id_materia'           => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
            ],
            [
                'id_distribucion_hora' => 9,
                'no_alum'              => 9,
                'alum_otras_carreras'  => 9,
                'hrs_docente'          => 9,
                'hrs_dir_atm_hono'     => 9,
                'directivo'            => 9,
                'atm'                  => 9,
                'honorarios'           => 9,
                'id_periodo_carrera'   => 9,
                'id_materia'           => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
            ],
            [
                'id_distribucion_hora' => 10,
                'no_alum'              => 10,
                'alum_otras_carreras'  => 10,
                'hrs_docente'          => 10,
                'hrs_dir_atm_hono'     => 10,
                'directivo'            => 10,
                'atm'                  => 10,
                'honorarios'           => 10,
                'id_periodo_carrera'   => 10,
                'id_materia'           => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
            ],
            [
                'id_distribucion_hora' => 11,
                'no_alum'              => 11,
                'alum_otras_carreras'  => 11,
                'hrs_docente'          => 11,
                'hrs_dir_atm_hono'     => 11,
                'directivo'            => 11,
                'atm'                  => 11,
                'honorarios'           => 11,
                'id_periodo_carrera'   => 11,
                'id_materia'           => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
            ],
            [
                'id_distribucion_hora' => 12,
                'no_alum'              => 12,
                'alum_otras_carreras'  => 12,
                'hrs_docente'          => 12,
                'hrs_dir_atm_hono'     => 12,
                'directivo'            => 12,
                'atm'                  => 12,
                'honorarios'           => 12,
                'id_periodo_carrera'   => 12,
                'id_materia'           => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
            ],
            [
                'id_distribucion_hora' => 13,
                'no_alum'              => 13,
                'alum_otras_carreras'  => 13,
                'hrs_docente'          => 13,
                'hrs_dir_atm_hono'     => 13,
                'directivo'            => 13,
                'atm'                  => 13,
                'honorarios'           => 13,
                'id_periodo_carrera'   => 13,
                'id_materia'           => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
            ],
            [
                'id_distribucion_hora' => 14,
                'no_alum'              => 14,
                'alum_otras_carreras'  => 14,
                'hrs_docente'          => 14,
                'hrs_dir_atm_hono'     => 14,
                'directivo'            => 14,
                'atm'                  => 14,
                'honorarios'           => 14,
                'id_periodo_carrera'   => 14,
                'id_materia'           => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
            ],
            [
                'id_distribucion_hora' => 15,
                'no_alum'              => 15,
                'alum_otras_carreras'  => 15,
                'hrs_docente'          => 15,
                'hrs_dir_atm_hono'     => 15,
                'directivo'            => 15,
                'atm'                  => 15,
                'honorarios'           => 15,
                'id_periodo_carrera'   => 15,
                'id_materia'           => 15,
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
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
