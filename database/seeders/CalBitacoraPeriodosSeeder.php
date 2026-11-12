<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_bitacora_periodos`.
 */
class CalBitacoraPeriodosSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_bitacora_periodos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalPeriodosCalificaSeeder::class,
            CalUnidadesSeeder::class,
            GnralGruposSeeder::class,
            GnralMateriasSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'cal_bitacora_periodos';

        $llaves = [
            ['id_bitacora_periodo'],
        ];

        $registros = [
            [
                'id_bitacora_periodo' => 1,
                'id_periodo_cal'      => 1,
                'id_unidad'           => 1,
                'id_grupo'            => 1,
                'id_materia'          => 1,
                'docente'             => 'María José Hernández Romero',
                'fecha_antigua'       => '2026-01-05',
                'fecha_nueva'         => '2026-01-05',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 1.',
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_bitacora_periodo' => 2,
                'id_periodo_cal'      => 2,
                'id_unidad'           => 2,
                'id_grupo'            => 2,
                'id_materia'          => 2,
                'docente'             => 'Jorge Alberto Sánchez Castillo',
                'fecha_antigua'       => '2026-01-14',
                'fecha_nueva'         => '2026-01-14',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 2.',
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_bitacora_periodo' => 3,
                'id_periodo_cal'      => 3,
                'id_unidad'           => 3,
                'id_grupo'            => 3,
                'id_materia'          => 3,
                'docente'             => 'Daniela Jiménez Torres',
                'fecha_antigua'       => '2026-01-23',
                'fecha_nueva'         => '2026-01-23',
                'id_periodo'          => 3,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 3.',
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_bitacora_periodo' => 4,
                'id_periodo_cal'      => 4,
                'id_unidad'           => 4,
                'id_grupo'            => 4,
                'id_materia'          => 4,
                'docente'             => 'Carlos Eduardo Pérez Aguilar',
                'fecha_antigua'       => '2026-02-01',
                'fecha_nueva'         => '2026-02-01',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 4.',
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_bitacora_periodo' => 5,
                'id_periodo_cal'      => 5,
                'id_unidad'           => 5,
                'id_grupo'            => 5,
                'id_materia'          => 5,
                'docente'             => 'Valeria Vázquez Navarro',
                'fecha_antigua'       => '2026-02-10',
                'fecha_nueva'         => '2026-02-10',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 5.',
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_bitacora_periodo' => 6,
                'id_periodo_cal'      => 6,
                'id_unidad'           => 6,
                'id_grupo'            => 6,
                'id_materia'          => 6,
                'docente'             => 'Miguel Ángel Rodríguez Ruiz',
                'fecha_antigua'       => '2026-02-19',
                'fecha_nueva'         => '2026-02-19',
                'id_periodo'          => 6,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 6.',
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_bitacora_periodo' => 7,
                'id_periodo_cal'      => 7,
                'id_unidad'           => 7,
                'id_grupo'            => 7,
                'id_materia'          => 7,
                'docente'             => 'Fernanda Morales Reyes',
                'fecha_antigua'       => '2026-02-28',
                'fecha_nueva'         => '2026-02-28',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 7.',
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_bitacora_periodo' => 8,
                'id_periodo_cal'      => 8,
                'id_unidad'           => 8,
                'id_grupo'            => 8,
                'id_materia'          => 8,
                'docente'             => 'José Antonio González Medina',
                'fecha_antigua'       => '2026-03-09',
                'fecha_nueva'         => '2026-03-09',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 8.',
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_bitacora_periodo' => 9,
                'id_periodo_cal'      => 9,
                'id_unidad'           => 1,
                'id_grupo'            => 9,
                'id_materia'          => 9,
                'docente'             => 'Andrea Gómez Ortiz',
                'fecha_antigua'       => '2026-03-18',
                'fecha_nueva'         => '2026-03-18',
                'id_periodo'          => 9,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 9.',
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_bitacora_periodo' => 10,
                'id_periodo_cal'      => 10,
                'id_unidad'           => 2,
                'id_grupo'            => 10,
                'id_materia'          => 10,
                'docente'             => 'Diego López Mendoza',
                'fecha_antigua'       => '2026-03-27',
                'fecha_nueva'         => '2026-03-27',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 10.',
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_bitacora_periodo' => 11,
                'id_periodo_cal'      => 11,
                'id_unidad'           => 3,
                'id_grupo'            => 11,
                'id_materia'          => 11,
                'docente'             => 'Paola Flores Rojas',
                'fecha_antigua'       => '2026-04-05',
                'fecha_nueva'         => '2026-04-05',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 11.',
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_bitacora_periodo' => 12,
                'id_periodo_cal'      => 12,
                'id_unidad'           => 4,
                'id_grupo'            => 12,
                'id_materia'          => 12,
                'docente'             => 'Ricardo Martínez Herrera',
                'fecha_antigua'       => '2026-04-14',
                'fecha_nueva'         => '2026-04-14',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 12.',
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_bitacora_periodo' => 13,
                'id_periodo_cal'      => 13,
                'id_unidad'           => 5,
                'id_grupo'            => 13,
                'id_materia'          => 13,
                'docente'             => 'Itzel Cruz Vega',
                'fecha_antigua'       => '2026-04-23',
                'fecha_nueva'         => '2026-04-23',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 13.',
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_bitacora_periodo' => 14,
                'id_periodo_cal'      => 14,
                'id_unidad'           => 6,
                'id_grupo'            => 14,
                'id_materia'          => 14,
                'docente'             => 'Ana Karen Martínez Ruiz',
                'fecha_antigua'       => '2026-05-02',
                'fecha_nueva'         => '2026-05-02',
                'id_periodo'          => 12,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 14.',
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_bitacora_periodo' => 15,
                'id_periodo_cal'      => 15,
                'id_unidad'           => 7,
                'id_grupo'            => 15,
                'id_materia'          => 15,
                'docente'             => 'Luis Fernando Cruz Reyes',
                'fecha_antigua'       => '2026-05-11',
                'fecha_nueva'         => '2026-05-11',
                'id_periodo'          => 15,
                'observaciones'       => 'Observaciones de bitacora periodos: registro de prueba número 15.',
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
