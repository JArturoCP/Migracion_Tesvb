<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_grupo_semestre`.
 */
class TuGrupoSemestreSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_grupo_semestre` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaTutorSeeder::class,
        ]);

        $tabla = 'tu_grupo_semestre';

        $llaves = [
            ['id_grupo_semestre'],
        ];

        $registros = [
            [
                'id_grupo_semestre' => 1,
                'id_asigna_tutor'   => 1,
                'id_grupo_tutorias' => 1,
                'fecha_registro'    => '2026-01-05',
            ],
            [
                'id_grupo_semestre' => 2,
                'id_asigna_tutor'   => 2,
                'id_grupo_tutorias' => 2,
                'fecha_registro'    => '2026-01-14',
            ],
            [
                'id_grupo_semestre' => 3,
                'id_asigna_tutor'   => 3,
                'id_grupo_tutorias' => 3,
                'fecha_registro'    => '2026-01-23',
            ],
            [
                'id_grupo_semestre' => 4,
                'id_asigna_tutor'   => 4,
                'id_grupo_tutorias' => 4,
                'fecha_registro'    => '2026-02-01',
            ],
            [
                'id_grupo_semestre' => 5,
                'id_asigna_tutor'   => 5,
                'id_grupo_tutorias' => 5,
                'fecha_registro'    => '2026-02-10',
            ],
            [
                'id_grupo_semestre' => 6,
                'id_asigna_tutor'   => 6,
                'id_grupo_tutorias' => 6,
                'fecha_registro'    => '2026-02-19',
            ],
            [
                'id_grupo_semestre' => 7,
                'id_asigna_tutor'   => 7,
                'id_grupo_tutorias' => 7,
                'fecha_registro'    => '2026-02-28',
            ],
            [
                'id_grupo_semestre' => 8,
                'id_asigna_tutor'   => 8,
                'id_grupo_tutorias' => 8,
                'fecha_registro'    => '2026-03-09',
            ],
            [
                'id_grupo_semestre' => 9,
                'id_asigna_tutor'   => 9,
                'id_grupo_tutorias' => 9,
                'fecha_registro'    => '2026-03-18',
            ],
            [
                'id_grupo_semestre' => 10,
                'id_asigna_tutor'   => 10,
                'id_grupo_tutorias' => 10,
                'fecha_registro'    => '2026-03-27',
            ],
            [
                'id_grupo_semestre' => 11,
                'id_asigna_tutor'   => 11,
                'id_grupo_tutorias' => 11,
                'fecha_registro'    => '2026-04-05',
            ],
            [
                'id_grupo_semestre' => 12,
                'id_asigna_tutor'   => 12,
                'id_grupo_tutorias' => 12,
                'fecha_registro'    => '2026-04-14',
            ],
            [
                'id_grupo_semestre' => 13,
                'id_asigna_tutor'   => 13,
                'id_grupo_tutorias' => 13,
                'fecha_registro'    => '2026-04-23',
            ],
            [
                'id_grupo_semestre' => 14,
                'id_asigna_tutor'   => 14,
                'id_grupo_tutorias' => 14,
                'fecha_registro'    => '2026-05-02',
            ],
            [
                'id_grupo_semestre' => 15,
                'id_asigna_tutor'   => 15,
                'id_grupo_tutorias' => 15,
                'fecha_registro'    => '2026-05-11',
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
