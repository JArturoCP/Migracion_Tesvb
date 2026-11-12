<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_eliminacion_materia`.
 */
class CalEliminacionMateriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_eliminacion_materia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaCargaAcademicaSeeder::class,
        ]);

        $tabla = 'cal_eliminacion_materia';

        $llaves = [
            ['id_eliminacion_materia'],
        ];

        $registros = [
            [
                'id_eliminacion_materia' => 1,
                'id_carga_academica'     => 1,
                'fecha'                  => '2026-01-05',
            ],
            [
                'id_eliminacion_materia' => 2,
                'id_carga_academica'     => 2,
                'fecha'                  => '2026-01-14',
            ],
            [
                'id_eliminacion_materia' => 3,
                'id_carga_academica'     => 3,
                'fecha'                  => '2026-01-23',
            ],
            [
                'id_eliminacion_materia' => 4,
                'id_carga_academica'     => 4,
                'fecha'                  => '2026-02-01',
            ],
            [
                'id_eliminacion_materia' => 5,
                'id_carga_academica'     => 5,
                'fecha'                  => '2026-02-10',
            ],
            [
                'id_eliminacion_materia' => 6,
                'id_carga_academica'     => 6,
                'fecha'                  => '2026-02-19',
            ],
            [
                'id_eliminacion_materia' => 7,
                'id_carga_academica'     => 7,
                'fecha'                  => '2026-02-28',
            ],
            [
                'id_eliminacion_materia' => 8,
                'id_carga_academica'     => 8,
                'fecha'                  => '2026-03-09',
            ],
            [
                'id_eliminacion_materia' => 9,
                'id_carga_academica'     => 9,
                'fecha'                  => '2026-03-18',
            ],
            [
                'id_eliminacion_materia' => 10,
                'id_carga_academica'     => 10,
                'fecha'                  => '2026-03-27',
            ],
            [
                'id_eliminacion_materia' => 11,
                'id_carga_academica'     => 11,
                'fecha'                  => '2026-04-05',
            ],
            [
                'id_eliminacion_materia' => 12,
                'id_carga_academica'     => 12,
                'fecha'                  => '2026-04-14',
            ],
            [
                'id_eliminacion_materia' => 13,
                'id_carga_academica'     => 13,
                'fecha'                  => '2026-04-23',
            ],
            [
                'id_eliminacion_materia' => 14,
                'id_carga_academica'     => 14,
                'fecha'                  => '2026-05-02',
            ],
            [
                'id_eliminacion_materia' => 15,
                'id_carga_academica'     => 15,
                'fecha'                  => '2026-05-11',
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
