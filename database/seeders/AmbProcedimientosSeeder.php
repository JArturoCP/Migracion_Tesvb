<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `amb_procedimientos`.
 */
class AmbProcedimientosSeeder extends Seeder
{
    /**
     * Pobla la tabla `amb_procedimientos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'amb_procedimientos';

        $llaves = [
            ['id_procedimiento'],
        ];

        $registros = [
            [
                'id_procedimiento'  => 1,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 1.',
            ],
            [
                'id_procedimiento'  => 2,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 2.',
            ],
            [
                'id_procedimiento'  => 3,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 3.',
            ],
            [
                'id_procedimiento'  => 4,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 4.',
            ],
            [
                'id_procedimiento'  => 5,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 5.',
            ],
            [
                'id_procedimiento'  => 6,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 6.',
            ],
            [
                'id_procedimiento'  => 7,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 7.',
            ],
            [
                'id_procedimiento'  => 8,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 8.',
            ],
            [
                'id_procedimiento'  => 9,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 9.',
            ],
            [
                'id_procedimiento'  => 10,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 10.',
            ],
            [
                'id_procedimiento'  => 11,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 11.',
            ],
            [
                'id_procedimiento'  => 12,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 12.',
            ],
            [
                'id_procedimiento'  => 13,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 13.',
            ],
            [
                'id_procedimiento'  => 14,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 14.',
            ],
            [
                'id_procedimiento'  => 15,
                'nom_procedimiento' => 'Nom procedimiento de procedimientos: registro de prueba número 15.',
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
