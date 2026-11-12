<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_mod_carga_usuario`.
 */
class InModCargaUsuarioSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_mod_carga_usuario` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InValidarCargaSeeder::class,
        ]);

        $tabla = 'in_mod_carga_usuario';

        $llaves = [
            ['id_mod_carga'],
        ];

        $registros = [
            [
                'id_mod_carga'     => 1,
                'id_usuario'       => 1,
                'fecha_cambio'     => '2026-01-05 09:00:00',
                'id_validar_carga' => 1,
            ],
            [
                'id_mod_carga'     => 2,
                'id_usuario'       => 2,
                'fecha_cambio'     => '2026-01-14 10:00:00',
                'id_validar_carga' => 2,
            ],
            [
                'id_mod_carga'     => 3,
                'id_usuario'       => 3,
                'fecha_cambio'     => '2026-01-23 11:00:00',
                'id_validar_carga' => 3,
            ],
            [
                'id_mod_carga'     => 4,
                'id_usuario'       => 4,
                'fecha_cambio'     => '2026-02-01 12:00:00',
                'id_validar_carga' => 4,
            ],
            [
                'id_mod_carga'     => 5,
                'id_usuario'       => 5,
                'fecha_cambio'     => '2026-02-10 13:00:00',
                'id_validar_carga' => 5,
            ],
            [
                'id_mod_carga'     => 6,
                'id_usuario'       => 6,
                'fecha_cambio'     => '2026-02-19 14:00:00',
                'id_validar_carga' => 6,
            ],
            [
                'id_mod_carga'     => 7,
                'id_usuario'       => 7,
                'fecha_cambio'     => '2026-02-28 15:00:00',
                'id_validar_carga' => 7,
            ],
            [
                'id_mod_carga'     => 8,
                'id_usuario'       => 8,
                'fecha_cambio'     => '2026-03-09 16:00:00',
                'id_validar_carga' => 8,
            ],
            [
                'id_mod_carga'     => 9,
                'id_usuario'       => 9,
                'fecha_cambio'     => '2026-03-18 08:00:00',
                'id_validar_carga' => 9,
            ],
            [
                'id_mod_carga'     => 10,
                'id_usuario'       => 10,
                'fecha_cambio'     => '2026-03-27 09:00:00',
                'id_validar_carga' => 10,
            ],
            [
                'id_mod_carga'     => 11,
                'id_usuario'       => 11,
                'fecha_cambio'     => '2026-04-05 10:00:00',
                'id_validar_carga' => 11,
            ],
            [
                'id_mod_carga'     => 12,
                'id_usuario'       => 12,
                'fecha_cambio'     => '2026-04-14 11:00:00',
                'id_validar_carga' => 12,
            ],
            [
                'id_mod_carga'     => 13,
                'id_usuario'       => 13,
                'fecha_cambio'     => '2026-04-23 12:00:00',
                'id_validar_carga' => 13,
            ],
            [
                'id_mod_carga'     => 14,
                'id_usuario'       => 14,
                'fecha_cambio'     => '2026-05-02 13:00:00',
                'id_validar_carga' => 14,
            ],
            [
                'id_mod_carga'     => 15,
                'id_usuario'       => 15,
                'fecha_cambio'     => '2026-05-11 14:00:00',
                'id_validar_carga' => 15,
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
