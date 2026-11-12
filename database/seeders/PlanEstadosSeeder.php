<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_estados`.
 */
class PlanEstadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_estados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_estados';

        $llaves = [
            ['id_estado'],
            ['nombre_estado'],
        ];

        $registros = [
            [
                'id_estado'     => 1,
                'nombre_estado' => 'Nombre estado estados 1',
            ],
            [
                'id_estado'     => 2,
                'nombre_estado' => 'Nombre estado estados 2',
            ],
            [
                'id_estado'     => 3,
                'nombre_estado' => 'Nombre estado estados 3',
            ],
            [
                'id_estado'     => 4,
                'nombre_estado' => 'Nombre estado estados 4',
            ],
            [
                'id_estado'     => 5,
                'nombre_estado' => 'Nombre estado estados 5',
            ],
            [
                'id_estado'     => 6,
                'nombre_estado' => 'Nombre estado estados 6',
            ],
            [
                'id_estado'     => 7,
                'nombre_estado' => 'Nombre estado estados 7',
            ],
            [
                'id_estado'     => 8,
                'nombre_estado' => 'Nombre estado estados 8',
            ],
            [
                'id_estado'     => 9,
                'nombre_estado' => 'Nombre estado estados 9',
            ],
            [
                'id_estado'     => 10,
                'nombre_estado' => 'Nombre estado estados 10',
            ],
            [
                'id_estado'     => 11,
                'nombre_estado' => 'Nombre estado estados 11',
            ],
            [
                'id_estado'     => 12,
                'nombre_estado' => 'Nombre estado estados 12',
            ],
            [
                'id_estado'     => 13,
                'nombre_estado' => 'Nombre estado estados 13',
            ],
            [
                'id_estado'     => 14,
                'nombre_estado' => 'Nombre estado estados 14',
            ],
            [
                'id_estado'     => 15,
                'nombre_estado' => 'Nombre estado estados 15',
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
