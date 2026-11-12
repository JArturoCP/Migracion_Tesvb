<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eva_validacion_de_cargas`.
 */
class EvaValidacionDeCargasSeeder extends Seeder
{
    /**
     * Pobla la tabla `eva_validacion_de_cargas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'eva_validacion_de_cargas';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'                => 1,
                'id_alumno'         => 1,
                'id_periodo'        => 12,
                'estado_validacion' => 1,
                'descripcion'       => 'Descripcion validacion de cargas 1',
                'no_pregunta'       => 1,
                'created_at'        => '2026-01-05 09:00:00',
                'updated_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id'                => 2,
                'id_alumno'         => 2,
                'id_periodo'        => 12,
                'estado_validacion' => 2,
                'descripcion'       => 'Descripcion validacion de cargas 2',
                'no_pregunta'       => 2,
                'created_at'        => '2026-01-14 10:00:00',
                'updated_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id'                => 3,
                'id_alumno'         => 3,
                'id_periodo'        => 3,
                'estado_validacion' => 3,
                'descripcion'       => 'Descripcion validacion de cargas 3',
                'no_pregunta'       => 3,
                'created_at'        => '2026-01-23 11:00:00',
                'updated_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id'                => 4,
                'id_alumno'         => 4,
                'id_periodo'        => 12,
                'estado_validacion' => 4,
                'descripcion'       => 'Descripcion validacion de cargas 4',
                'no_pregunta'       => 4,
                'created_at'        => '2026-02-01 12:00:00',
                'updated_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id'                => 5,
                'id_alumno'         => 5,
                'id_periodo'        => 12,
                'estado_validacion' => 5,
                'descripcion'       => 'Descripcion validacion de cargas 5',
                'no_pregunta'       => 5,
                'created_at'        => '2026-02-10 13:00:00',
                'updated_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id'                => 6,
                'id_alumno'         => 6,
                'id_periodo'        => 6,
                'estado_validacion' => 6,
                'descripcion'       => 'Descripcion validacion de cargas 6',
                'no_pregunta'       => 6,
                'created_at'        => '2026-02-19 14:00:00',
                'updated_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id'                => 7,
                'id_alumno'         => 7,
                'id_periodo'        => 12,
                'estado_validacion' => 7,
                'descripcion'       => 'Descripcion validacion de cargas 7',
                'no_pregunta'       => 7,
                'created_at'        => '2026-02-28 15:00:00',
                'updated_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id'                => 8,
                'id_alumno'         => 8,
                'id_periodo'        => 12,
                'estado_validacion' => 8,
                'descripcion'       => 'Descripcion validacion de cargas 8',
                'no_pregunta'       => 8,
                'created_at'        => '2026-03-09 16:00:00',
                'updated_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id'                => 9,
                'id_alumno'         => 9,
                'id_periodo'        => 9,
                'estado_validacion' => 9,
                'descripcion'       => 'Descripcion validacion de cargas 9',
                'no_pregunta'       => 9,
                'created_at'        => '2026-03-18 08:00:00',
                'updated_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id'                => 10,
                'id_alumno'         => 10,
                'id_periodo'        => 12,
                'estado_validacion' => 10,
                'descripcion'       => 'Descripcion validacion de cargas 10',
                'no_pregunta'       => 10,
                'created_at'        => '2026-03-27 09:00:00',
                'updated_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id'                => 11,
                'id_alumno'         => 11,
                'id_periodo'        => 12,
                'estado_validacion' => 11,
                'descripcion'       => 'Descripcion validacion de cargas 11',
                'no_pregunta'       => 11,
                'created_at'        => '2026-04-05 10:00:00',
                'updated_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id'                => 12,
                'id_alumno'         => 12,
                'id_periodo'        => 12,
                'estado_validacion' => 12,
                'descripcion'       => 'Descripcion validacion de cargas 12',
                'no_pregunta'       => 12,
                'created_at'        => '2026-04-14 11:00:00',
                'updated_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id'                => 13,
                'id_alumno'         => 13,
                'id_periodo'        => 12,
                'estado_validacion' => 13,
                'descripcion'       => 'Descripcion validacion de cargas 13',
                'no_pregunta'       => 13,
                'created_at'        => '2026-04-23 12:00:00',
                'updated_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id'                => 14,
                'id_alumno'         => 14,
                'id_periodo'        => 12,
                'estado_validacion' => 14,
                'descripcion'       => 'Descripcion validacion de cargas 14',
                'no_pregunta'       => 14,
                'created_at'        => '2026-05-02 13:00:00',
                'updated_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id'                => 15,
                'id_alumno'         => 15,
                'id_periodo'        => 15,
                'estado_validacion' => 15,
                'descripcion'       => 'Descripcion validacion de cargas 15',
                'no_pregunta'       => 15,
                'created_at'        => '2026-05-11 14:00:00',
                'updated_at'        => '2026-05-11 14:00:00',
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
