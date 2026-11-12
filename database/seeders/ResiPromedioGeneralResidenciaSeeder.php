<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_promedio_general_residencia`.
 */
class ResiPromedioGeneralResidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_promedio_general_residencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_promedio_general_residencia';

        $llaves = [
            ['id_promedio_general'],
        ];

        $registros = [
            [
                'id_promedio_general'       => 1,
                'calificacion_seguimiento'  => 77,
                'calif_externo_interno'     => 77,
                'promedio_general'          => 1,
                'id_anteproyecto'           => 1,
                'fecha_registro'            => '2026-01-05',
                'id_calificar_departamento' => 1,
            ],
            [
                'id_promedio_general'       => 2,
                'calificacion_seguimiento'  => 84,
                'calif_externo_interno'     => 84,
                'promedio_general'          => 2,
                'id_anteproyecto'           => 2,
                'fecha_registro'            => '2026-01-14',
                'id_calificar_departamento' => 2,
            ],
            [
                'id_promedio_general'       => 3,
                'calificacion_seguimiento'  => 91,
                'calif_externo_interno'     => 91,
                'promedio_general'          => 3,
                'id_anteproyecto'           => 3,
                'fecha_registro'            => '2026-01-23',
                'id_calificar_departamento' => 3,
            ],
            [
                'id_promedio_general'       => 4,
                'calificacion_seguimiento'  => 98,
                'calif_externo_interno'     => 98,
                'promedio_general'          => 4,
                'id_anteproyecto'           => 4,
                'fecha_registro'            => '2026-02-01',
                'id_calificar_departamento' => 4,
            ],
            [
                'id_promedio_general'       => 5,
                'calificacion_seguimiento'  => 74,
                'calif_externo_interno'     => 74,
                'promedio_general'          => 5,
                'id_anteproyecto'           => 5,
                'fecha_registro'            => '2026-02-10',
                'id_calificar_departamento' => 5,
            ],
            [
                'id_promedio_general'       => 6,
                'calificacion_seguimiento'  => 81,
                'calif_externo_interno'     => 81,
                'promedio_general'          => 6,
                'id_anteproyecto'           => 6,
                'fecha_registro'            => '2026-02-19',
                'id_calificar_departamento' => 6,
            ],
            [
                'id_promedio_general'       => 7,
                'calificacion_seguimiento'  => 88,
                'calif_externo_interno'     => 88,
                'promedio_general'          => 7,
                'id_anteproyecto'           => 7,
                'fecha_registro'            => '2026-02-28',
                'id_calificar_departamento' => 7,
            ],
            [
                'id_promedio_general'       => 8,
                'calificacion_seguimiento'  => 95,
                'calif_externo_interno'     => 95,
                'promedio_general'          => 8,
                'id_anteproyecto'           => 8,
                'fecha_registro'            => '2026-03-09',
                'id_calificar_departamento' => 8,
            ],
            [
                'id_promedio_general'       => 9,
                'calificacion_seguimiento'  => 71,
                'calif_externo_interno'     => 71,
                'promedio_general'          => 9,
                'id_anteproyecto'           => 9,
                'fecha_registro'            => '2026-03-18',
                'id_calificar_departamento' => 9,
            ],
            [
                'id_promedio_general'       => 10,
                'calificacion_seguimiento'  => 78,
                'calif_externo_interno'     => 78,
                'promedio_general'          => 10,
                'id_anteproyecto'           => 10,
                'fecha_registro'            => '2026-03-27',
                'id_calificar_departamento' => 10,
            ],
            [
                'id_promedio_general'       => 11,
                'calificacion_seguimiento'  => 85,
                'calif_externo_interno'     => 85,
                'promedio_general'          => 11,
                'id_anteproyecto'           => 11,
                'fecha_registro'            => '2026-04-05',
                'id_calificar_departamento' => 11,
            ],
            [
                'id_promedio_general'       => 12,
                'calificacion_seguimiento'  => 92,
                'calif_externo_interno'     => 92,
                'promedio_general'          => 12,
                'id_anteproyecto'           => 12,
                'fecha_registro'            => '2026-04-14',
                'id_calificar_departamento' => 12,
            ],
            [
                'id_promedio_general'       => 13,
                'calificacion_seguimiento'  => 99,
                'calif_externo_interno'     => 99,
                'promedio_general'          => 13,
                'id_anteproyecto'           => 13,
                'fecha_registro'            => '2026-04-23',
                'id_calificar_departamento' => 13,
            ],
            [
                'id_promedio_general'       => 14,
                'calificacion_seguimiento'  => 75,
                'calif_externo_interno'     => 75,
                'promedio_general'          => 14,
                'id_anteproyecto'           => 14,
                'fecha_registro'            => '2026-05-02',
                'id_calificar_departamento' => 14,
            ],
            [
                'id_promedio_general'       => 15,
                'calificacion_seguimiento'  => 82,
                'calif_externo_interno'     => 82,
                'promedio_general'          => 15,
                'id_anteproyecto'           => 15,
                'fecha_registro'            => '2026-05-11',
                'id_calificar_departamento' => 15,
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
