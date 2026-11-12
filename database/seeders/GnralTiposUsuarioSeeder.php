<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_tipos_usuario`.
 */
class GnralTiposUsuarioSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_tipos_usuario` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_tipos_usuario';

        $llaves = [
            ['id_tipo_usuario'],
        ];

        $registros = [
            [
                'id_tipo_usuario' => 1,
                'descripcion'     => 'ALUMNO',
            ],
            [
                'id_tipo_usuario' => 2,
                'descripcion'     => 'PERSONAL',
            ],
            [
                'id_tipo_usuario' => 3,
                'descripcion'     => 'PROFESOR DE INGLÉS',
            ],
            [
                'id_tipo_usuario' => 4,
                'descripcion'     => 'TIPO DE USUARIO 4',
            ],
            [
                'id_tipo_usuario' => 5,
                'descripcion'     => 'TIPO DE USUARIO 5',
            ],
            [
                'id_tipo_usuario' => 6,
                'descripcion'     => 'TIPO DE USUARIO 6',
            ],
            [
                'id_tipo_usuario' => 7,
                'descripcion'     => 'TIPO DE USUARIO 7',
            ],
            [
                'id_tipo_usuario' => 8,
                'descripcion'     => 'TIPO DE USUARIO 8',
            ],
            [
                'id_tipo_usuario' => 9,
                'descripcion'     => 'TIPO DE USUARIO 9',
            ],
            [
                'id_tipo_usuario' => 10,
                'descripcion'     => 'TIPO DE USUARIO 10',
            ],
            [
                'id_tipo_usuario' => 11,
                'descripcion'     => 'TIPO DE USUARIO 11',
            ],
            [
                'id_tipo_usuario' => 12,
                'descripcion'     => 'TIPO DE USUARIO 12',
            ],
            [
                'id_tipo_usuario' => 13,
                'descripcion'     => 'TIPO DE USUARIO 13',
            ],
            [
                'id_tipo_usuario' => 14,
                'descripcion'     => 'TIPO DE USUARIO 14',
            ],
            [
                'id_tipo_usuario' => 15,
                'descripcion'     => 'TIPO DE USUARIO 15',
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
