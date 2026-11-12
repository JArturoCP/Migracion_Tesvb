<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_personal_docentes`.
 */
class HrsPersonalDocentesSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_personal_docentes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            HrsCasosFactibilidadesSeeder::class,
        ]);

        $tabla = 'hrs_personal_docentes';

        $llaves = [
            ['id_personal_docente'],
        ];

        $registros = [
            [
                'id_personal_docente'  => 1,
                'id_horario'           => 1,
                'caso'                 => 'V1',
                'id_caso_factibilidad' => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
            ],
            [
                'id_personal_docente'  => 2,
                'id_horario'           => 2,
                'caso'                 => 'V2',
                'id_caso_factibilidad' => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
            ],
            [
                'id_personal_docente'  => 3,
                'id_horario'           => 3,
                'caso'                 => 'V3',
                'id_caso_factibilidad' => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
            ],
            [
                'id_personal_docente'  => 4,
                'id_horario'           => 4,
                'caso'                 => 'V4',
                'id_caso_factibilidad' => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
            ],
            [
                'id_personal_docente'  => 5,
                'id_horario'           => 5,
                'caso'                 => 'V5',
                'id_caso_factibilidad' => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
            ],
            [
                'id_personal_docente'  => 6,
                'id_horario'           => 6,
                'caso'                 => 'V6',
                'id_caso_factibilidad' => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
            ],
            [
                'id_personal_docente'  => 7,
                'id_horario'           => 7,
                'caso'                 => 'V7',
                'id_caso_factibilidad' => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
            ],
            [
                'id_personal_docente'  => 8,
                'id_horario'           => 8,
                'caso'                 => 'V8',
                'id_caso_factibilidad' => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
            ],
            [
                'id_personal_docente'  => 9,
                'id_horario'           => 9,
                'caso'                 => 'V9',
                'id_caso_factibilidad' => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
            ],
            [
                'id_personal_docente'  => 10,
                'id_horario'           => 10,
                'caso'                 => 'V10',
                'id_caso_factibilidad' => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
            ],
            [
                'id_personal_docente'  => 11,
                'id_horario'           => 11,
                'caso'                 => 'V11',
                'id_caso_factibilidad' => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
            ],
            [
                'id_personal_docente'  => 12,
                'id_horario'           => 12,
                'caso'                 => 'V12',
                'id_caso_factibilidad' => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
            ],
            [
                'id_personal_docente'  => 13,
                'id_horario'           => 13,
                'caso'                 => 'V13',
                'id_caso_factibilidad' => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
            ],
            [
                'id_personal_docente'  => 14,
                'id_horario'           => 14,
                'caso'                 => 'V14',
                'id_caso_factibilidad' => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
            ],
            [
                'id_personal_docente'  => 15,
                'id_horario'           => 15,
                'caso'                 => 'V15',
                'id_caso_factibilidad' => 15,
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
