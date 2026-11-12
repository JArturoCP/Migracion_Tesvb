<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_evidencias_alumno`.
 */
class ActcompleEvidenciasAlumnoSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_evidencias_alumno` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleRegistroAlumnosSeeder::class,
        ]);

        $tabla = 'actcomple_evidencias_alumno';

        $llaves = [
            ['id_evidencia_alumno'],
        ];

        $registros = [
            [
                'id_evidencia_alumno' => 1,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_1.pdf',
                'id_registro_alumno'  => 1,
                'numero_evidencias'   => 1,
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_evidencia_alumno' => 2,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_2.pdf',
                'id_registro_alumno'  => 2,
                'numero_evidencias'   => 2,
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_evidencia_alumno' => 3,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_3.pdf',
                'id_registro_alumno'  => 3,
                'numero_evidencias'   => 3,
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_evidencia_alumno' => 4,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_4.pdf',
                'id_registro_alumno'  => 4,
                'numero_evidencias'   => 4,
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_evidencia_alumno' => 5,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_5.pdf',
                'id_registro_alumno'  => 5,
                'numero_evidencias'   => 5,
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_evidencia_alumno' => 6,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_6.pdf',
                'id_registro_alumno'  => 6,
                'numero_evidencias'   => 6,
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_evidencia_alumno' => 7,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_7.pdf',
                'id_registro_alumno'  => 7,
                'numero_evidencias'   => 7,
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_evidencia_alumno' => 8,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_8.pdf',
                'id_registro_alumno'  => 8,
                'numero_evidencias'   => 8,
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_evidencia_alumno' => 9,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_9.pdf',
                'id_registro_alumno'  => 9,
                'numero_evidencias'   => 9,
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_evidencia_alumno' => 10,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_10.pdf',
                'id_registro_alumno'  => 10,
                'numero_evidencias'   => 10,
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_evidencia_alumno' => 11,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_11.pdf',
                'id_registro_alumno'  => 11,
                'numero_evidencias'   => 11,
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_evidencia_alumno' => 12,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_12.pdf',
                'id_registro_alumno'  => 12,
                'numero_evidencias'   => 12,
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_evidencia_alumno' => 13,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_13.pdf',
                'id_registro_alumno'  => 13,
                'numero_evidencias'   => 13,
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_evidencia_alumno' => 14,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_14.pdf',
                'id_registro_alumno'  => 14,
                'numero_evidencias'   => 14,
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_evidencia_alumno' => 15,
                'archivo'             => 'documentos/actcomple_evidencias_alumno/actcomple_evidencias_alumno_15.pdf',
                'id_registro_alumno'  => 15,
                'numero_evidencias'   => 15,
                'created_at'          => '2026-05-11 14:00:00',
                'updated_at'          => '2026-05-11 14:00:00',
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
