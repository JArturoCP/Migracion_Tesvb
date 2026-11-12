<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_estrategia_materias`.
 */
class ArEstrategiaMateriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_estrategia_materias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArEstrategiasReprobacionSeeder::class,
            CalUnidadesSeeder::class,
            EvaCargaAcademicaSeeder::class,
            GnralMateriasSeeder::class,
        ]);

        $tabla = 'ar_estrategia_materias';

        $llaves = [
            ['id_ar_estrategia_materia'],
            ['id_ar_estrategia', 'id_materia', 'id_unidad'],
        ];

        $registros = [
            [
                'id_ar_estrategia_materia' => 1,
                'id_ar_estrategia'         => 1,
                'id_materia'               => 1,
                'id_carga_academica'       => 1,
                'id_unidad'                => 1,
                'calificacion'             => 77,
                'created_at'               => '2026-01-05 09:00:00',
                'updated_at'               => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 2,
                'id_ar_estrategia'         => 2,
                'id_materia'               => 1,
                'id_carga_academica'       => 2,
                'id_unidad'                => 1,
                'calificacion'             => 84,
                'created_at'               => '2026-01-14 10:00:00',
                'updated_at'               => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 3,
                'id_ar_estrategia'         => 3,
                'id_materia'               => 1,
                'id_carga_academica'       => 3,
                'id_unidad'                => 1,
                'calificacion'             => 91,
                'created_at'               => '2026-01-23 11:00:00',
                'updated_at'               => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 4,
                'id_ar_estrategia'         => 4,
                'id_materia'               => 1,
                'id_carga_academica'       => 4,
                'id_unidad'                => 1,
                'calificacion'             => 98,
                'created_at'               => '2026-02-01 12:00:00',
                'updated_at'               => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 5,
                'id_ar_estrategia'         => 5,
                'id_materia'               => 1,
                'id_carga_academica'       => 5,
                'id_unidad'                => 1,
                'calificacion'             => 74,
                'created_at'               => '2026-02-10 13:00:00',
                'updated_at'               => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 6,
                'id_ar_estrategia'         => 6,
                'id_materia'               => 1,
                'id_carga_academica'       => 6,
                'id_unidad'                => 1,
                'calificacion'             => 81,
                'created_at'               => '2026-02-19 14:00:00',
                'updated_at'               => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 7,
                'id_ar_estrategia'         => 7,
                'id_materia'               => 1,
                'id_carga_academica'       => 7,
                'id_unidad'                => 1,
                'calificacion'             => 88,
                'created_at'               => '2026-02-28 15:00:00',
                'updated_at'               => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 8,
                'id_ar_estrategia'         => 8,
                'id_materia'               => 1,
                'id_carga_academica'       => 8,
                'id_unidad'                => 1,
                'calificacion'             => 95,
                'created_at'               => '2026-03-09 16:00:00',
                'updated_at'               => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 9,
                'id_ar_estrategia'         => 9,
                'id_materia'               => 1,
                'id_carga_academica'       => 9,
                'id_unidad'                => 1,
                'calificacion'             => 71,
                'created_at'               => '2026-03-18 08:00:00',
                'updated_at'               => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 10,
                'id_ar_estrategia'         => 10,
                'id_materia'               => 1,
                'id_carga_academica'       => 10,
                'id_unidad'                => 1,
                'calificacion'             => 78,
                'created_at'               => '2026-03-27 09:00:00',
                'updated_at'               => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 11,
                'id_ar_estrategia'         => 11,
                'id_materia'               => 1,
                'id_carga_academica'       => 11,
                'id_unidad'                => 1,
                'calificacion'             => 85,
                'created_at'               => '2026-04-05 10:00:00',
                'updated_at'               => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 12,
                'id_ar_estrategia'         => 12,
                'id_materia'               => 1,
                'id_carga_academica'       => 12,
                'id_unidad'                => 1,
                'calificacion'             => 92,
                'created_at'               => '2026-04-14 11:00:00',
                'updated_at'               => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 13,
                'id_ar_estrategia'         => 13,
                'id_materia'               => 1,
                'id_carga_academica'       => 13,
                'id_unidad'                => 1,
                'calificacion'             => 99,
                'created_at'               => '2026-04-23 12:00:00',
                'updated_at'               => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 14,
                'id_ar_estrategia'         => 14,
                'id_materia'               => 1,
                'id_carga_academica'       => 14,
                'id_unidad'                => 1,
                'calificacion'             => 75,
                'created_at'               => '2026-05-02 13:00:00',
                'updated_at'               => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_estrategia_materia' => 15,
                'id_ar_estrategia'         => 15,
                'id_materia'               => 1,
                'id_carga_academica'       => 15,
                'id_unidad'                => 1,
                'calificacion'             => 82,
                'created_at'               => '2026-05-11 14:00:00',
                'updated_at'               => '2026-05-11 14:00:00',
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
