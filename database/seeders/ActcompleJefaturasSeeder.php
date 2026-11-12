<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actcomple_jefaturas`.
 */
class ActcompleJefaturasSeeder extends Seeder
{
    /**
     * Pobla la tabla `actcomple_jefaturas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
        ]);

        $tabla = 'actcomple_jefaturas';

        $llaves = [
            ['id_jefatura'],
        ];

        $registros = [
            [
                'id_jefatura'  => 1,
                'nom_jefatura' => 'Nom jefatura jefaturas 1',
                'id_carrera'   => 1,
            ],
            [
                'id_jefatura'  => 2,
                'nom_jefatura' => 'Nom jefatura jefaturas 2',
                'id_carrera'   => 2,
            ],
            [
                'id_jefatura'  => 3,
                'nom_jefatura' => 'Nom jefatura jefaturas 3',
                'id_carrera'   => 3,
            ],
            [
                'id_jefatura'  => 4,
                'nom_jefatura' => 'Nom jefatura jefaturas 4',
                'id_carrera'   => 4,
            ],
            [
                'id_jefatura'  => 5,
                'nom_jefatura' => 'Nom jefatura jefaturas 5',
                'id_carrera'   => 5,
            ],
            [
                'id_jefatura'  => 6,
                'nom_jefatura' => 'Nom jefatura jefaturas 6',
                'id_carrera'   => 6,
            ],
            [
                'id_jefatura'  => 7,
                'nom_jefatura' => 'Nom jefatura jefaturas 7',
                'id_carrera'   => 7,
            ],
            [
                'id_jefatura'  => 8,
                'nom_jefatura' => 'Nom jefatura jefaturas 8',
                'id_carrera'   => 1,
            ],
            [
                'id_jefatura'  => 9,
                'nom_jefatura' => 'Nom jefatura jefaturas 9',
                'id_carrera'   => 2,
            ],
            [
                'id_jefatura'  => 10,
                'nom_jefatura' => 'Nom jefatura jefaturas 10',
                'id_carrera'   => 3,
            ],
            [
                'id_jefatura'  => 11,
                'nom_jefatura' => 'Nom jefatura jefaturas 11',
                'id_carrera'   => 4,
            ],
            [
                'id_jefatura'  => 12,
                'nom_jefatura' => 'Nom jefatura jefaturas 12',
                'id_carrera'   => 5,
            ],
            [
                'id_jefatura'  => 13,
                'nom_jefatura' => 'Nom jefatura jefaturas 13',
                'id_carrera'   => 6,
            ],
            [
                'id_jefatura'  => 14,
                'nom_jefatura' => 'Nom jefatura jefaturas 14',
                'id_carrera'   => 7,
            ],
            [
                'id_jefatura'  => 15,
                'nom_jefatura' => 'Nom jefatura jefaturas 15',
                'id_carrera'   => 1,
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
