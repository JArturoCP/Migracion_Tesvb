<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `egel_examenes`.
 */
class EgelExamenesSeeder extends Seeder
{
    /**
     * Pobla la tabla `egel_examenes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EgelPeriodoExamenSeeder::class,
            EgelPeriodoResultadosExamenSeeder::class,
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'egel_examenes';

        $llaves = [
            ['id_examen_egel'],
        ];

        $registros = [
            [
                'id_examen_egel'              => 1,
                'id_carrera'                  => 1,
                'nombre'                      => 'Nombre examenes 1',
                'estado'                      => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
                'id_periodo_examen'           => 1,
                'id_periodo_resultado_examen' => 1,
            ],
            [
                'id_examen_egel'              => 2,
                'id_carrera'                  => 2,
                'nombre'                      => 'Nombre examenes 2',
                'estado'                      => 1,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
                'id_periodo_examen'           => 2,
                'id_periodo_resultado_examen' => 2,
            ],
            [
                'id_examen_egel'              => 3,
                'id_carrera'                  => 3,
                'nombre'                      => 'Nombre examenes 3',
                'estado'                      => 1,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
                'id_periodo_examen'           => 3,
                'id_periodo_resultado_examen' => 3,
            ],
            [
                'id_examen_egel'              => 4,
                'id_carrera'                  => 4,
                'nombre'                      => 'Nombre examenes 4',
                'estado'                      => 1,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
                'id_periodo_examen'           => 4,
                'id_periodo_resultado_examen' => 4,
            ],
            [
                'id_examen_egel'              => 5,
                'id_carrera'                  => 5,
                'nombre'                      => 'Nombre examenes 5',
                'estado'                      => 1,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
                'id_periodo_examen'           => 5,
                'id_periodo_resultado_examen' => 5,
            ],
            [
                'id_examen_egel'              => 6,
                'id_carrera'                  => 6,
                'nombre'                      => 'Nombre examenes 6',
                'estado'                      => 1,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
                'id_periodo_examen'           => 6,
                'id_periodo_resultado_examen' => 6,
            ],
            [
                'id_examen_egel'              => 7,
                'id_carrera'                  => 7,
                'nombre'                      => 'Nombre examenes 7',
                'estado'                      => 1,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
                'id_periodo_examen'           => 7,
                'id_periodo_resultado_examen' => 7,
            ],
            [
                'id_examen_egel'              => 8,
                'id_carrera'                  => 1,
                'nombre'                      => 'Nombre examenes 8',
                'estado'                      => 1,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
                'id_periodo_examen'           => 8,
                'id_periodo_resultado_examen' => 8,
            ],
            [
                'id_examen_egel'              => 9,
                'id_carrera'                  => 2,
                'nombre'                      => 'Nombre examenes 9',
                'estado'                      => 1,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
                'id_periodo_examen'           => 9,
                'id_periodo_resultado_examen' => 9,
            ],
            [
                'id_examen_egel'              => 10,
                'id_carrera'                  => 3,
                'nombre'                      => 'Nombre examenes 10',
                'estado'                      => 1,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
                'id_periodo_examen'           => 10,
                'id_periodo_resultado_examen' => 10,
            ],
            [
                'id_examen_egel'              => 11,
                'id_carrera'                  => 4,
                'nombre'                      => 'Nombre examenes 11',
                'estado'                      => 1,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
                'id_periodo_examen'           => 11,
                'id_periodo_resultado_examen' => 11,
            ],
            [
                'id_examen_egel'              => 12,
                'id_carrera'                  => 5,
                'nombre'                      => 'Nombre examenes 12',
                'estado'                      => 1,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
                'id_periodo_examen'           => 12,
                'id_periodo_resultado_examen' => 12,
            ],
            [
                'id_examen_egel'              => 13,
                'id_carrera'                  => 6,
                'nombre'                      => 'Nombre examenes 13',
                'estado'                      => 1,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
                'id_periodo_examen'           => 13,
                'id_periodo_resultado_examen' => 13,
            ],
            [
                'id_examen_egel'              => 14,
                'id_carrera'                  => 7,
                'nombre'                      => 'Nombre examenes 14',
                'estado'                      => 1,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
                'id_periodo_examen'           => 14,
                'id_periodo_resultado_examen' => 14,
            ],
            [
                'id_examen_egel'              => 15,
                'id_carrera'                  => 1,
                'nombre'                      => 'Nombre examenes 15',
                'estado'                      => 1,
                'created_at'                  => '2026-05-11 14:00:00',
                'updated_at'                  => '2026-05-11 14:00:00',
                'id_periodo_examen'           => 15,
                'id_periodo_resultado_examen' => 15,
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
