<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_bitacoras_sumativas`.
 */
class CalBitacorasSumativasSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_bitacoras_sumativas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalEvaluacionesSumativaSeeder::class,
            CalUnidadesSeeder::class,
            EvaCargaAcademicaSeeder::class,
            GnralMateriasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'cal_bitacoras_sumativas';

        $llaves = [
            ['id_bitacora_sumativas'],
        ];

        $registros = [
            [
                'id_bitacora_sumativas' => 1,
                'id_evaluacion'         => 1,
                'id_unidad'             => 1,
                'id_carga_academica'    => 1,
                'id_materia'            => 1,
                'docente'               => 'María José Hernández Romero',
                'cal_antigua'           => 77,
                'cal_nueva'             => 77,
                'id_periodo'            => 12,
                'created_at'            => '2026-01-05 09:00:00',
                'updated_at'            => '2026-01-05 09:00:00',
            ],
            [
                'id_bitacora_sumativas' => 2,
                'id_evaluacion'         => 2,
                'id_unidad'             => 2,
                'id_carga_academica'    => 2,
                'id_materia'            => 2,
                'docente'               => 'Jorge Alberto Sánchez Castillo',
                'cal_antigua'           => 84,
                'cal_nueva'             => 84,
                'id_periodo'            => 12,
                'created_at'            => '2026-01-14 10:00:00',
                'updated_at'            => '2026-01-14 10:00:00',
            ],
            [
                'id_bitacora_sumativas' => 3,
                'id_evaluacion'         => 3,
                'id_unidad'             => 3,
                'id_carga_academica'    => 3,
                'id_materia'            => 3,
                'docente'               => 'Daniela Jiménez Torres',
                'cal_antigua'           => 91,
                'cal_nueva'             => 91,
                'id_periodo'            => 3,
                'created_at'            => '2026-01-23 11:00:00',
                'updated_at'            => '2026-01-23 11:00:00',
            ],
            [
                'id_bitacora_sumativas' => 4,
                'id_evaluacion'         => 4,
                'id_unidad'             => 4,
                'id_carga_academica'    => 4,
                'id_materia'            => 4,
                'docente'               => 'Carlos Eduardo Pérez Aguilar',
                'cal_antigua'           => 98,
                'cal_nueva'             => 98,
                'id_periodo'            => 12,
                'created_at'            => '2026-02-01 12:00:00',
                'updated_at'            => '2026-02-01 12:00:00',
            ],
            [
                'id_bitacora_sumativas' => 5,
                'id_evaluacion'         => 5,
                'id_unidad'             => 5,
                'id_carga_academica'    => 5,
                'id_materia'            => 5,
                'docente'               => 'Valeria Vázquez Navarro',
                'cal_antigua'           => 74,
                'cal_nueva'             => 74,
                'id_periodo'            => 12,
                'created_at'            => '2026-02-10 13:00:00',
                'updated_at'            => '2026-02-10 13:00:00',
            ],
            [
                'id_bitacora_sumativas' => 6,
                'id_evaluacion'         => 6,
                'id_unidad'             => 6,
                'id_carga_academica'    => 6,
                'id_materia'            => 6,
                'docente'               => 'Miguel Ángel Rodríguez Ruiz',
                'cal_antigua'           => 81,
                'cal_nueva'             => 81,
                'id_periodo'            => 6,
                'created_at'            => '2026-02-19 14:00:00',
                'updated_at'            => '2026-02-19 14:00:00',
            ],
            [
                'id_bitacora_sumativas' => 7,
                'id_evaluacion'         => 7,
                'id_unidad'             => 7,
                'id_carga_academica'    => 7,
                'id_materia'            => 7,
                'docente'               => 'Fernanda Morales Reyes',
                'cal_antigua'           => 88,
                'cal_nueva'             => 88,
                'id_periodo'            => 12,
                'created_at'            => '2026-02-28 15:00:00',
                'updated_at'            => '2026-02-28 15:00:00',
            ],
            [
                'id_bitacora_sumativas' => 8,
                'id_evaluacion'         => 8,
                'id_unidad'             => 8,
                'id_carga_academica'    => 8,
                'id_materia'            => 8,
                'docente'               => 'José Antonio González Medina',
                'cal_antigua'           => 95,
                'cal_nueva'             => 95,
                'id_periodo'            => 12,
                'created_at'            => '2026-03-09 16:00:00',
                'updated_at'            => '2026-03-09 16:00:00',
            ],
            [
                'id_bitacora_sumativas' => 9,
                'id_evaluacion'         => 9,
                'id_unidad'             => 1,
                'id_carga_academica'    => 9,
                'id_materia'            => 9,
                'docente'               => 'Andrea Gómez Ortiz',
                'cal_antigua'           => 71,
                'cal_nueva'             => 71,
                'id_periodo'            => 9,
                'created_at'            => '2026-03-18 08:00:00',
                'updated_at'            => '2026-03-18 08:00:00',
            ],
            [
                'id_bitacora_sumativas' => 10,
                'id_evaluacion'         => 10,
                'id_unidad'             => 2,
                'id_carga_academica'    => 10,
                'id_materia'            => 10,
                'docente'               => 'Diego López Mendoza',
                'cal_antigua'           => 78,
                'cal_nueva'             => 78,
                'id_periodo'            => 12,
                'created_at'            => '2026-03-27 09:00:00',
                'updated_at'            => '2026-03-27 09:00:00',
            ],
            [
                'id_bitacora_sumativas' => 11,
                'id_evaluacion'         => 11,
                'id_unidad'             => 3,
                'id_carga_academica'    => 11,
                'id_materia'            => 11,
                'docente'               => 'Paola Flores Rojas',
                'cal_antigua'           => 85,
                'cal_nueva'             => 85,
                'id_periodo'            => 12,
                'created_at'            => '2026-04-05 10:00:00',
                'updated_at'            => '2026-04-05 10:00:00',
            ],
            [
                'id_bitacora_sumativas' => 12,
                'id_evaluacion'         => 12,
                'id_unidad'             => 4,
                'id_carga_academica'    => 12,
                'id_materia'            => 12,
                'docente'               => 'Ricardo Martínez Herrera',
                'cal_antigua'           => 92,
                'cal_nueva'             => 92,
                'id_periodo'            => 12,
                'created_at'            => '2026-04-14 11:00:00',
                'updated_at'            => '2026-04-14 11:00:00',
            ],
            [
                'id_bitacora_sumativas' => 13,
                'id_evaluacion'         => 13,
                'id_unidad'             => 5,
                'id_carga_academica'    => 13,
                'id_materia'            => 13,
                'docente'               => 'Itzel Cruz Vega',
                'cal_antigua'           => 99,
                'cal_nueva'             => 99,
                'id_periodo'            => 12,
                'created_at'            => '2026-04-23 12:00:00',
                'updated_at'            => '2026-04-23 12:00:00',
            ],
            [
                'id_bitacora_sumativas' => 14,
                'id_evaluacion'         => 14,
                'id_unidad'             => 6,
                'id_carga_academica'    => 14,
                'id_materia'            => 14,
                'docente'               => 'Ana Karen Martínez Ruiz',
                'cal_antigua'           => 75,
                'cal_nueva'             => 75,
                'id_periodo'            => 12,
                'created_at'            => '2026-05-02 13:00:00',
                'updated_at'            => '2026-05-02 13:00:00',
            ],
            [
                'id_bitacora_sumativas' => 15,
                'id_evaluacion'         => 15,
                'id_unidad'             => 7,
                'id_carga_academica'    => 15,
                'id_materia'            => 15,
                'docente'               => 'Luis Fernando Cruz Reyes',
                'cal_antigua'           => 82,
                'cal_nueva'             => 82,
                'id_periodo'            => 15,
                'created_at'            => '2026-05-11 14:00:00',
                'updated_at'            => '2026-05-11 14:00:00',
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
