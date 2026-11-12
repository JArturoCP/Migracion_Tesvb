<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_materias_perfiles`.
 */
class GnralMateriasPerfilesSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_materias_perfiles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralMateriasSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'gnral_materias_perfiles';

        $llaves = [
            ['id_materia_perfil'],
        ];

        $registros = [
            [
                'id_materia_perfil' => 1,
                'id_personal'       => 1,
                'id_materia'        => 1,
                'mostrar'           => 1,
                'updated_at'        => '2026-01-05 09:00:00',
                'created_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_materia_perfil' => 2,
                'id_personal'       => 2,
                'id_materia'        => 2,
                'mostrar'           => 2,
                'updated_at'        => '2026-01-14 10:00:00',
                'created_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_materia_perfil' => 3,
                'id_personal'       => 3,
                'id_materia'        => 3,
                'mostrar'           => 3,
                'updated_at'        => '2026-01-23 11:00:00',
                'created_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_materia_perfil' => 4,
                'id_personal'       => 4,
                'id_materia'        => 4,
                'mostrar'           => 4,
                'updated_at'        => '2026-02-01 12:00:00',
                'created_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_materia_perfil' => 5,
                'id_personal'       => 5,
                'id_materia'        => 5,
                'mostrar'           => 5,
                'updated_at'        => '2026-02-10 13:00:00',
                'created_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_materia_perfil' => 6,
                'id_personal'       => 6,
                'id_materia'        => 6,
                'mostrar'           => 6,
                'updated_at'        => '2026-02-19 14:00:00',
                'created_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_materia_perfil' => 7,
                'id_personal'       => 7,
                'id_materia'        => 7,
                'mostrar'           => 7,
                'updated_at'        => '2026-02-28 15:00:00',
                'created_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_materia_perfil' => 8,
                'id_personal'       => 8,
                'id_materia'        => 8,
                'mostrar'           => 8,
                'updated_at'        => '2026-03-09 16:00:00',
                'created_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_materia_perfil' => 9,
                'id_personal'       => 9,
                'id_materia'        => 9,
                'mostrar'           => 9,
                'updated_at'        => '2026-03-18 08:00:00',
                'created_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_materia_perfil' => 10,
                'id_personal'       => 10,
                'id_materia'        => 10,
                'mostrar'           => 10,
                'updated_at'        => '2026-03-27 09:00:00',
                'created_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_materia_perfil' => 11,
                'id_personal'       => 11,
                'id_materia'        => 11,
                'mostrar'           => 11,
                'updated_at'        => '2026-04-05 10:00:00',
                'created_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_materia_perfil' => 12,
                'id_personal'       => 12,
                'id_materia'        => 12,
                'mostrar'           => 12,
                'updated_at'        => '2026-04-14 11:00:00',
                'created_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_materia_perfil' => 13,
                'id_personal'       => 13,
                'id_materia'        => 13,
                'mostrar'           => 13,
                'updated_at'        => '2026-04-23 12:00:00',
                'created_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_materia_perfil' => 14,
                'id_personal'       => 14,
                'id_materia'        => 14,
                'mostrar'           => 14,
                'updated_at'        => '2026-05-02 13:00:00',
                'created_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_materia_perfil' => 15,
                'id_personal'       => 15,
                'id_materia'        => 15,
                'mostrar'           => 15,
                'updated_at'        => '2026-05-11 14:00:00',
                'created_at'        => '2026-05-11 14:00:00',
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
