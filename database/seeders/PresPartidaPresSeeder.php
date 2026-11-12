<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_partida_pres`.
 */
class PresPartidaPresSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_partida_pres` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresCapitulosSeeder::class,
        ]);

        $tabla = 'pres_partida_pres';

        $llaves = [
            ['id_partida_pres'],
        ];

        $registros = [
            [
                'id_partida_pres'    => 1,
                'id_capitulo'        => 1,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 1.',
                'clave_presupuestal' => 1,
                'fecha_registro'     => '2026-01-05',
                'fecha_modificacion' => '2026-01-05',
            ],
            [
                'id_partida_pres'    => 2,
                'id_capitulo'        => 2,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 2.',
                'clave_presupuestal' => 2,
                'fecha_registro'     => '2026-01-14',
                'fecha_modificacion' => '2026-01-14',
            ],
            [
                'id_partida_pres'    => 3,
                'id_capitulo'        => 3,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 3.',
                'clave_presupuestal' => 3,
                'fecha_registro'     => '2026-01-23',
                'fecha_modificacion' => '2026-01-23',
            ],
            [
                'id_partida_pres'    => 4,
                'id_capitulo'        => 4,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 4.',
                'clave_presupuestal' => 4,
                'fecha_registro'     => '2026-02-01',
                'fecha_modificacion' => '2026-02-01',
            ],
            [
                'id_partida_pres'    => 5,
                'id_capitulo'        => 5,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 5.',
                'clave_presupuestal' => 5,
                'fecha_registro'     => '2026-02-10',
                'fecha_modificacion' => '2026-02-10',
            ],
            [
                'id_partida_pres'    => 6,
                'id_capitulo'        => 6,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 6.',
                'clave_presupuestal' => 6,
                'fecha_registro'     => '2026-02-19',
                'fecha_modificacion' => '2026-02-19',
            ],
            [
                'id_partida_pres'    => 7,
                'id_capitulo'        => 7,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 7.',
                'clave_presupuestal' => 7,
                'fecha_registro'     => '2026-02-28',
                'fecha_modificacion' => '2026-02-28',
            ],
            [
                'id_partida_pres'    => 8,
                'id_capitulo'        => 8,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 8.',
                'clave_presupuestal' => 8,
                'fecha_registro'     => '2026-03-09',
                'fecha_modificacion' => '2026-03-09',
            ],
            [
                'id_partida_pres'    => 9,
                'id_capitulo'        => 9,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 9.',
                'clave_presupuestal' => 9,
                'fecha_registro'     => '2026-03-18',
                'fecha_modificacion' => '2026-03-18',
            ],
            [
                'id_partida_pres'    => 10,
                'id_capitulo'        => 10,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 10.',
                'clave_presupuestal' => 10,
                'fecha_registro'     => '2026-03-27',
                'fecha_modificacion' => '2026-03-27',
            ],
            [
                'id_partida_pres'    => 11,
                'id_capitulo'        => 11,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 11.',
                'clave_presupuestal' => 11,
                'fecha_registro'     => '2026-04-05',
                'fecha_modificacion' => '2026-04-05',
            ],
            [
                'id_partida_pres'    => 12,
                'id_capitulo'        => 12,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 12.',
                'clave_presupuestal' => 12,
                'fecha_registro'     => '2026-04-14',
                'fecha_modificacion' => '2026-04-14',
            ],
            [
                'id_partida_pres'    => 13,
                'id_capitulo'        => 13,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 13.',
                'clave_presupuestal' => 13,
                'fecha_registro'     => '2026-04-23',
                'fecha_modificacion' => '2026-04-23',
            ],
            [
                'id_partida_pres'    => 14,
                'id_capitulo'        => 14,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 14.',
                'clave_presupuestal' => 14,
                'fecha_registro'     => '2026-05-02',
                'fecha_modificacion' => '2026-05-02',
            ],
            [
                'id_partida_pres'    => 15,
                'id_capitulo'        => 15,
                'nombre_partida'     => 'Nombre partida de partida pres: registro de prueba número 15.',
                'clave_presupuestal' => 15,
                'fecha_registro'     => '2026-05-11',
                'fecha_modificacion' => '2026-05-11',
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
