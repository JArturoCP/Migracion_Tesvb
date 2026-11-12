<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_proyecto`.
 */
class ResiProyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_proyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiTipoProyectoSeeder::class,
        ]);

        $tabla = 'resi_proyecto';

        $llaves = [
            ['id_proyecto'],
        ];

        $registros = [
            [
                'id_proyecto'      => 1,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 1.',
                'id_tipo_proyecto' => 1,
            ],
            [
                'id_proyecto'      => 2,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 2.',
                'id_tipo_proyecto' => 2,
            ],
            [
                'id_proyecto'      => 3,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 3.',
                'id_tipo_proyecto' => 3,
            ],
            [
                'id_proyecto'      => 4,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 4.',
                'id_tipo_proyecto' => 4,
            ],
            [
                'id_proyecto'      => 5,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 5.',
                'id_tipo_proyecto' => 5,
            ],
            [
                'id_proyecto'      => 6,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 6.',
                'id_tipo_proyecto' => 6,
            ],
            [
                'id_proyecto'      => 7,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 7.',
                'id_tipo_proyecto' => 7,
            ],
            [
                'id_proyecto'      => 8,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 8.',
                'id_tipo_proyecto' => 8,
            ],
            [
                'id_proyecto'      => 9,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 9.',
                'id_tipo_proyecto' => 9,
            ],
            [
                'id_proyecto'      => 10,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 10.',
                'id_tipo_proyecto' => 10,
            ],
            [
                'id_proyecto'      => 11,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 11.',
                'id_tipo_proyecto' => 11,
            ],
            [
                'id_proyecto'      => 12,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 12.',
                'id_tipo_proyecto' => 12,
            ],
            [
                'id_proyecto'      => 13,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 13.',
                'id_tipo_proyecto' => 13,
            ],
            [
                'id_proyecto'      => 14,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 14.',
                'id_tipo_proyecto' => 14,
            ],
            [
                'id_proyecto'      => 15,
                'nom_proyecto'     => 'Nom proyecto de proyecto: registro de prueba número 15.',
                'id_tipo_proyecto' => 15,
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
