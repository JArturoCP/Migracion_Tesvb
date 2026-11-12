<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_bitacoras_bajas_temp_alumnos`.
 */
class CalBitacorasBajasTempAlumnosSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_bitacoras_bajas_temp_alumnos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaValidacionDeCargasSeeder::class,
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'cal_bitacoras_bajas_temp_alumnos';

        $llaves = [
            ['id_cal_bit_bajas'],
        ];

        $registros = [
            [
                'id_cal_bit_bajas' => 1,
                'id_alumno'        => 1,
                'id'               => 1,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 1.',
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_cal_bit_bajas' => 2,
                'id_alumno'        => 2,
                'id'               => 2,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 2.',
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_cal_bit_bajas' => 3,
                'id_alumno'        => 3,
                'id'               => 3,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 3.',
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_cal_bit_bajas' => 4,
                'id_alumno'        => 4,
                'id'               => 4,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 4.',
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_cal_bit_bajas' => 5,
                'id_alumno'        => 5,
                'id'               => 5,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 5.',
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_cal_bit_bajas' => 6,
                'id_alumno'        => 6,
                'id'               => 6,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 6.',
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_cal_bit_bajas' => 7,
                'id_alumno'        => 7,
                'id'               => 7,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 7.',
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_cal_bit_bajas' => 8,
                'id_alumno'        => 8,
                'id'               => 8,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 8.',
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_cal_bit_bajas' => 9,
                'id_alumno'        => 9,
                'id'               => 9,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 9.',
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_cal_bit_bajas' => 10,
                'id_alumno'        => 10,
                'id'               => 10,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 10.',
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_cal_bit_bajas' => 11,
                'id_alumno'        => 11,
                'id'               => 11,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 11.',
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_cal_bit_bajas' => 12,
                'id_alumno'        => 12,
                'id'               => 12,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 12.',
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_cal_bit_bajas' => 13,
                'id_alumno'        => 13,
                'id'               => 13,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 13.',
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_cal_bit_bajas' => 14,
                'id_alumno'        => 14,
                'id'               => 14,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 14.',
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_cal_bit_bajas' => 15,
                'id_alumno'        => 15,
                'id'               => 15,
                'observaciones'    => 'Observaciones de bitacoras bajas temp alumnos: registro de prueba número 15.',
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
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
