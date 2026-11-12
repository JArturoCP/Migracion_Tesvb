<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_docente_actividad`.
 */
class ActcompleDocenteActividadSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_docente_actividad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActividadesComplementariasSeeder::class,
            GnralPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'actcomple_docente_actividad';

        $llaves = [
            ['id_docente_actividad'],
        ];

        $registros = [
            [
                'id_docente_actividad' => 1,
                'id_personal'          => 1,
                'id_actividad_comple'  => 1,
                'created_at'           => '2026-01-05 09:00:00',
                'updated_at'           => '2026-01-05 09:00:00',
                'estado'               => 1,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 2,
                'id_personal'          => 2,
                'id_actividad_comple'  => 2,
                'created_at'           => '2026-01-14 10:00:00',
                'updated_at'           => '2026-01-14 10:00:00',
                'estado'               => 2,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 3,
                'id_personal'          => 3,
                'id_actividad_comple'  => 3,
                'created_at'           => '2026-01-23 11:00:00',
                'updated_at'           => '2026-01-23 11:00:00',
                'estado'               => 3,
                'id_periodo'           => 3,
            ],
            [
                'id_docente_actividad' => 4,
                'id_personal'          => 4,
                'id_actividad_comple'  => 4,
                'created_at'           => '2026-02-01 12:00:00',
                'updated_at'           => '2026-02-01 12:00:00',
                'estado'               => 4,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 5,
                'id_personal'          => 5,
                'id_actividad_comple'  => 5,
                'created_at'           => '2026-02-10 13:00:00',
                'updated_at'           => '2026-02-10 13:00:00',
                'estado'               => 5,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 6,
                'id_personal'          => 6,
                'id_actividad_comple'  => 6,
                'created_at'           => '2026-02-19 14:00:00',
                'updated_at'           => '2026-02-19 14:00:00',
                'estado'               => 6,
                'id_periodo'           => 6,
            ],
            [
                'id_docente_actividad' => 7,
                'id_personal'          => 7,
                'id_actividad_comple'  => 7,
                'created_at'           => '2026-02-28 15:00:00',
                'updated_at'           => '2026-02-28 15:00:00',
                'estado'               => 7,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 8,
                'id_personal'          => 8,
                'id_actividad_comple'  => 8,
                'created_at'           => '2026-03-09 16:00:00',
                'updated_at'           => '2026-03-09 16:00:00',
                'estado'               => 8,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 9,
                'id_personal'          => 9,
                'id_actividad_comple'  => 9,
                'created_at'           => '2026-03-18 08:00:00',
                'updated_at'           => '2026-03-18 08:00:00',
                'estado'               => 9,
                'id_periodo'           => 9,
            ],
            [
                'id_docente_actividad' => 10,
                'id_personal'          => 10,
                'id_actividad_comple'  => 10,
                'created_at'           => '2026-03-27 09:00:00',
                'updated_at'           => '2026-03-27 09:00:00',
                'estado'               => 10,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 11,
                'id_personal'          => 11,
                'id_actividad_comple'  => 11,
                'created_at'           => '2026-04-05 10:00:00',
                'updated_at'           => '2026-04-05 10:00:00',
                'estado'               => 11,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 12,
                'id_personal'          => 12,
                'id_actividad_comple'  => 12,
                'created_at'           => '2026-04-14 11:00:00',
                'updated_at'           => '2026-04-14 11:00:00',
                'estado'               => 12,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 13,
                'id_personal'          => 13,
                'id_actividad_comple'  => 13,
                'created_at'           => '2026-04-23 12:00:00',
                'updated_at'           => '2026-04-23 12:00:00',
                'estado'               => 13,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 14,
                'id_personal'          => 14,
                'id_actividad_comple'  => 14,
                'created_at'           => '2026-05-02 13:00:00',
                'updated_at'           => '2026-05-02 13:00:00',
                'estado'               => 14,
                'id_periodo'           => 12,
            ],
            [
                'id_docente_actividad' => 15,
                'id_personal'          => 15,
                'id_actividad_comple'  => 15,
                'created_at'           => '2026-05-11 14:00:00',
                'updated_at'           => '2026-05-11 14:00:00',
                'estado'               => 15,
                'id_periodo'           => 15,
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
