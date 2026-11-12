<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_formulario_tutor`.
 */
class TuEvaFormularioTutorSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_formulario_tutor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaTutorSeeder::class,
            TuEvaCuestionarioSeeder::class,
        ]);

        $tabla = 'tu_eva_formulario_tutor';

        $llaves = [
            ['id_eva_formulario_tutor'],
        ];

        $registros = [
            [
                'id_eva_formulario_tutor' => 1,
                'fecha_de_registro'       => '2026-01-05 09:00:00',
                'id_asigna_tutor'         => 1,
                'id_eva_cuestionario'     => 1,
                'calificacion'            => 77,
            ],
            [
                'id_eva_formulario_tutor' => 2,
                'fecha_de_registro'       => '2026-01-14 10:00:00',
                'id_asigna_tutor'         => 2,
                'id_eva_cuestionario'     => 2,
                'calificacion'            => 84,
            ],
            [
                'id_eva_formulario_tutor' => 3,
                'fecha_de_registro'       => '2026-01-23 11:00:00',
                'id_asigna_tutor'         => 3,
                'id_eva_cuestionario'     => 3,
                'calificacion'            => 91,
            ],
            [
                'id_eva_formulario_tutor' => 4,
                'fecha_de_registro'       => '2026-02-01 12:00:00',
                'id_asigna_tutor'         => 4,
                'id_eva_cuestionario'     => 4,
                'calificacion'            => 98,
            ],
            [
                'id_eva_formulario_tutor' => 5,
                'fecha_de_registro'       => '2026-02-10 13:00:00',
                'id_asigna_tutor'         => 5,
                'id_eva_cuestionario'     => 5,
                'calificacion'            => 74,
            ],
            [
                'id_eva_formulario_tutor' => 6,
                'fecha_de_registro'       => '2026-02-19 14:00:00',
                'id_asigna_tutor'         => 6,
                'id_eva_cuestionario'     => 6,
                'calificacion'            => 81,
            ],
            [
                'id_eva_formulario_tutor' => 7,
                'fecha_de_registro'       => '2026-02-28 15:00:00',
                'id_asigna_tutor'         => 7,
                'id_eva_cuestionario'     => 7,
                'calificacion'            => 88,
            ],
            [
                'id_eva_formulario_tutor' => 8,
                'fecha_de_registro'       => '2026-03-09 16:00:00',
                'id_asigna_tutor'         => 8,
                'id_eva_cuestionario'     => 8,
                'calificacion'            => 95,
            ],
            [
                'id_eva_formulario_tutor' => 9,
                'fecha_de_registro'       => '2026-03-18 08:00:00',
                'id_asigna_tutor'         => 9,
                'id_eva_cuestionario'     => 9,
                'calificacion'            => 71,
            ],
            [
                'id_eva_formulario_tutor' => 10,
                'fecha_de_registro'       => '2026-03-27 09:00:00',
                'id_asigna_tutor'         => 10,
                'id_eva_cuestionario'     => 10,
                'calificacion'            => 78,
            ],
            [
                'id_eva_formulario_tutor' => 11,
                'fecha_de_registro'       => '2026-04-05 10:00:00',
                'id_asigna_tutor'         => 11,
                'id_eva_cuestionario'     => 11,
                'calificacion'            => 85,
            ],
            [
                'id_eva_formulario_tutor' => 12,
                'fecha_de_registro'       => '2026-04-14 11:00:00',
                'id_asigna_tutor'         => 12,
                'id_eva_cuestionario'     => 12,
                'calificacion'            => 92,
            ],
            [
                'id_eva_formulario_tutor' => 13,
                'fecha_de_registro'       => '2026-04-23 12:00:00',
                'id_asigna_tutor'         => 13,
                'id_eva_cuestionario'     => 13,
                'calificacion'            => 99,
            ],
            [
                'id_eva_formulario_tutor' => 14,
                'fecha_de_registro'       => '2026-05-02 13:00:00',
                'id_asigna_tutor'         => 14,
                'id_eva_cuestionario'     => 14,
                'calificacion'            => 75,
            ],
            [
                'id_eva_formulario_tutor' => 15,
                'fecha_de_registro'       => '2026-05-11 14:00:00',
                'id_asigna_tutor'         => 15,
                'id_eva_cuestionario'     => 15,
                'calificacion'            => 82,
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
