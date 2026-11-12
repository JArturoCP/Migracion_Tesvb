<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_anteproyecto_profesor`.
 */
class ResiAnteproyectoProfesorSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_anteproyecto_profesor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_anteproyecto_profesor';

        $llaves = [
            ['id_anteproyecto_profesor'],
        ];

        $registros = [
            [
                'id_anteproyecto_profesor' => 1,
                'id_anteproyecto'          => 1,
                'id_profesor'              => 1,
                'id_estado_enviar'         => 1,
            ],
            [
                'id_anteproyecto_profesor' => 2,
                'id_anteproyecto'          => 2,
                'id_profesor'              => 2,
                'id_estado_enviar'         => 2,
            ],
            [
                'id_anteproyecto_profesor' => 3,
                'id_anteproyecto'          => 3,
                'id_profesor'              => 3,
                'id_estado_enviar'         => 3,
            ],
            [
                'id_anteproyecto_profesor' => 4,
                'id_anteproyecto'          => 4,
                'id_profesor'              => 4,
                'id_estado_enviar'         => 4,
            ],
            [
                'id_anteproyecto_profesor' => 5,
                'id_anteproyecto'          => 5,
                'id_profesor'              => 5,
                'id_estado_enviar'         => 5,
            ],
            [
                'id_anteproyecto_profesor' => 6,
                'id_anteproyecto'          => 6,
                'id_profesor'              => 6,
                'id_estado_enviar'         => 6,
            ],
            [
                'id_anteproyecto_profesor' => 7,
                'id_anteproyecto'          => 7,
                'id_profesor'              => 7,
                'id_estado_enviar'         => 7,
            ],
            [
                'id_anteproyecto_profesor' => 8,
                'id_anteproyecto'          => 8,
                'id_profesor'              => 8,
                'id_estado_enviar'         => 8,
            ],
            [
                'id_anteproyecto_profesor' => 9,
                'id_anteproyecto'          => 9,
                'id_profesor'              => 9,
                'id_estado_enviar'         => 9,
            ],
            [
                'id_anteproyecto_profesor' => 10,
                'id_anteproyecto'          => 10,
                'id_profesor'              => 10,
                'id_estado_enviar'         => 10,
            ],
            [
                'id_anteproyecto_profesor' => 11,
                'id_anteproyecto'          => 11,
                'id_profesor'              => 11,
                'id_estado_enviar'         => 11,
            ],
            [
                'id_anteproyecto_profesor' => 12,
                'id_anteproyecto'          => 12,
                'id_profesor'              => 12,
                'id_estado_enviar'         => 12,
            ],
            [
                'id_anteproyecto_profesor' => 13,
                'id_anteproyecto'          => 13,
                'id_profesor'              => 13,
                'id_estado_enviar'         => 13,
            ],
            [
                'id_anteproyecto_profesor' => 14,
                'id_anteproyecto'          => 14,
                'id_profesor'              => 14,
                'id_estado_enviar'         => 14,
            ],
            [
                'id_anteproyecto_profesor' => 15,
                'id_anteproyecto'          => 15,
                'id_profesor'              => 15,
                'id_estado_enviar'         => 15,
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
