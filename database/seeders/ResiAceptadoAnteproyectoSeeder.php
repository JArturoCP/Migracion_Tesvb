<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_aceptado_anteproyecto`.
 */
class ResiAceptadoAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_aceptado_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_aceptado_anteproyecto';

        $llaves = [
            ['id_aceptado'],
        ];

        $registros = [
            [
                'id_aceptado'     => 1,
                'id_anteproyecto' => 1,
                'id_profesor'     => 1,
            ],
            [
                'id_aceptado'     => 2,
                'id_anteproyecto' => 2,
                'id_profesor'     => 2,
            ],
            [
                'id_aceptado'     => 3,
                'id_anteproyecto' => 3,
                'id_profesor'     => 3,
            ],
            [
                'id_aceptado'     => 4,
                'id_anteproyecto' => 4,
                'id_profesor'     => 4,
            ],
            [
                'id_aceptado'     => 5,
                'id_anteproyecto' => 5,
                'id_profesor'     => 5,
            ],
            [
                'id_aceptado'     => 6,
                'id_anteproyecto' => 6,
                'id_profesor'     => 6,
            ],
            [
                'id_aceptado'     => 7,
                'id_anteproyecto' => 7,
                'id_profesor'     => 7,
            ],
            [
                'id_aceptado'     => 8,
                'id_anteproyecto' => 8,
                'id_profesor'     => 8,
            ],
            [
                'id_aceptado'     => 9,
                'id_anteproyecto' => 9,
                'id_profesor'     => 9,
            ],
            [
                'id_aceptado'     => 10,
                'id_anteproyecto' => 10,
                'id_profesor'     => 10,
            ],
            [
                'id_aceptado'     => 11,
                'id_anteproyecto' => 11,
                'id_profesor'     => 11,
            ],
            [
                'id_aceptado'     => 12,
                'id_anteproyecto' => 12,
                'id_profesor'     => 12,
            ],
            [
                'id_aceptado'     => 13,
                'id_anteproyecto' => 13,
                'id_profesor'     => 13,
            ],
            [
                'id_aceptado'     => 14,
                'id_anteproyecto' => 14,
                'id_profesor'     => 14,
            ],
            [
                'id_aceptado'     => 15,
                'id_anteproyecto' => 15,
                'id_profesor'     => 15,
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
