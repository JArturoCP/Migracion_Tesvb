<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_perfiles`.
 */
class GnralPerfilesSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_perfiles` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_perfiles';

        $llaves = [
            ['id_perfil'],
        ];

        $registros = [
            [
                'id_perfil'   => 1,
                'descripcion' => 'INGENIERO EN SISTEMAS',
                'updated_at'  => '2026-01-05 09:00:00',
                'created_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_perfil'   => 2,
                'descripcion' => 'INGENIERO INDUSTRIAL',
                'updated_at'  => '2026-01-14 10:00:00',
                'created_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_perfil'   => 3,
                'descripcion' => 'INGENIERO CIVIL',
                'updated_at'  => '2026-01-23 11:00:00',
                'created_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_perfil'   => 4,
                'descripcion' => 'LICENCIADO EN ADMINISTRACIÓN',
                'updated_at'  => '2026-02-01 12:00:00',
                'created_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_perfil'   => 5,
                'descripcion' => 'CHEF PROFESIONAL',
                'updated_at'  => '2026-02-10 13:00:00',
                'created_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_perfil'   => 6,
                'descripcion' => 'INGENIERO EN SISTEMAS',
                'updated_at'  => '2026-02-19 14:00:00',
                'created_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_perfil'   => 7,
                'descripcion' => 'INGENIERO INDUSTRIAL',
                'updated_at'  => '2026-02-28 15:00:00',
                'created_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_perfil'   => 8,
                'descripcion' => 'INGENIERO CIVIL',
                'updated_at'  => '2026-03-09 16:00:00',
                'created_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_perfil'   => 9,
                'descripcion' => 'LICENCIADO EN ADMINISTRACIÓN',
                'updated_at'  => '2026-03-18 08:00:00',
                'created_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_perfil'   => 10,
                'descripcion' => 'CHEF PROFESIONAL',
                'updated_at'  => '2026-03-27 09:00:00',
                'created_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_perfil'   => 11,
                'descripcion' => 'INGENIERO EN SISTEMAS',
                'updated_at'  => '2026-04-05 10:00:00',
                'created_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_perfil'   => 12,
                'descripcion' => 'INGENIERO INDUSTRIAL',
                'updated_at'  => '2026-04-14 11:00:00',
                'created_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_perfil'   => 13,
                'descripcion' => 'INGENIERO CIVIL',
                'updated_at'  => '2026-04-23 12:00:00',
                'created_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_perfil'   => 14,
                'descripcion' => 'LICENCIADO EN ADMINISTRACIÓN',
                'updated_at'  => '2026-05-02 13:00:00',
                'created_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_perfil'   => 15,
                'descripcion' => 'CHEF PROFESIONAL',
                'updated_at'  => '2026-05-11 14:00:00',
                'created_at'  => '2026-05-11 14:00:00',
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
