<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_calificar_residencia`.
 */
class ResiCalificarResidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_calificar_residencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_calificar_residencia';

        $llaves = [
            ['id_calificar_residencia'],
        ];

        $registros = [
            [
                'id_calificar_residencia' => 1,
                'uno_externo'             => 1,
                'dos_externo'             => 1,
                'tres_externo'            => 1,
                'cuatro_externo'          => 1,
                'cinco_externo'           => 1,
                'seis_externo'            => 1,
                'uno_interno'             => 1,
                'dos_interno'             => 1,
                'tres_interno'            => 1,
                'cuatro_interno'          => 1,
                'cinco_interno'           => 1,
                'seis_interno'            => 1,
                'id_anteproyecto'         => 1,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 1.',
            ],
            [
                'id_calificar_residencia' => 2,
                'uno_externo'             => 2,
                'dos_externo'             => 2,
                'tres_externo'            => 2,
                'cuatro_externo'          => 2,
                'cinco_externo'           => 2,
                'seis_externo'            => 2,
                'uno_interno'             => 2,
                'dos_interno'             => 2,
                'tres_interno'            => 2,
                'cuatro_interno'          => 2,
                'cinco_interno'           => 2,
                'seis_interno'            => 2,
                'id_anteproyecto'         => 2,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 2.',
            ],
            [
                'id_calificar_residencia' => 3,
                'uno_externo'             => 3,
                'dos_externo'             => 3,
                'tres_externo'            => 3,
                'cuatro_externo'          => 3,
                'cinco_externo'           => 3,
                'seis_externo'            => 3,
                'uno_interno'             => 3,
                'dos_interno'             => 3,
                'tres_interno'            => 3,
                'cuatro_interno'          => 3,
                'cinco_interno'           => 3,
                'seis_interno'            => 3,
                'id_anteproyecto'         => 3,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 3.',
            ],
            [
                'id_calificar_residencia' => 4,
                'uno_externo'             => 4,
                'dos_externo'             => 4,
                'tres_externo'            => 4,
                'cuatro_externo'          => 4,
                'cinco_externo'           => 4,
                'seis_externo'            => 4,
                'uno_interno'             => 4,
                'dos_interno'             => 4,
                'tres_interno'            => 4,
                'cuatro_interno'          => 4,
                'cinco_interno'           => 4,
                'seis_interno'            => 4,
                'id_anteproyecto'         => 4,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 4.',
            ],
            [
                'id_calificar_residencia' => 5,
                'uno_externo'             => 5,
                'dos_externo'             => 5,
                'tres_externo'            => 5,
                'cuatro_externo'          => 5,
                'cinco_externo'           => 5,
                'seis_externo'            => 5,
                'uno_interno'             => 5,
                'dos_interno'             => 5,
                'tres_interno'            => 5,
                'cuatro_interno'          => 5,
                'cinco_interno'           => 5,
                'seis_interno'            => 5,
                'id_anteproyecto'         => 5,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 5.',
            ],
            [
                'id_calificar_residencia' => 6,
                'uno_externo'             => 6,
                'dos_externo'             => 6,
                'tres_externo'            => 6,
                'cuatro_externo'          => 6,
                'cinco_externo'           => 6,
                'seis_externo'            => 6,
                'uno_interno'             => 6,
                'dos_interno'             => 6,
                'tres_interno'            => 6,
                'cuatro_interno'          => 6,
                'cinco_interno'           => 6,
                'seis_interno'            => 6,
                'id_anteproyecto'         => 6,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 6.',
            ],
            [
                'id_calificar_residencia' => 7,
                'uno_externo'             => 7,
                'dos_externo'             => 7,
                'tres_externo'            => 7,
                'cuatro_externo'          => 7,
                'cinco_externo'           => 7,
                'seis_externo'            => 7,
                'uno_interno'             => 7,
                'dos_interno'             => 7,
                'tres_interno'            => 7,
                'cuatro_interno'          => 7,
                'cinco_interno'           => 7,
                'seis_interno'            => 7,
                'id_anteproyecto'         => 7,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 7.',
            ],
            [
                'id_calificar_residencia' => 8,
                'uno_externo'             => 8,
                'dos_externo'             => 8,
                'tres_externo'            => 8,
                'cuatro_externo'          => 8,
                'cinco_externo'           => 8,
                'seis_externo'            => 8,
                'uno_interno'             => 8,
                'dos_interno'             => 8,
                'tres_interno'            => 8,
                'cuatro_interno'          => 8,
                'cinco_interno'           => 8,
                'seis_interno'            => 8,
                'id_anteproyecto'         => 8,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 8.',
            ],
            [
                'id_calificar_residencia' => 9,
                'uno_externo'             => 9,
                'dos_externo'             => 9,
                'tres_externo'            => 9,
                'cuatro_externo'          => 9,
                'cinco_externo'           => 9,
                'seis_externo'            => 9,
                'uno_interno'             => 9,
                'dos_interno'             => 9,
                'tres_interno'            => 9,
                'cuatro_interno'          => 9,
                'cinco_interno'           => 9,
                'seis_interno'            => 9,
                'id_anteproyecto'         => 9,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 9.',
            ],
            [
                'id_calificar_residencia' => 10,
                'uno_externo'             => 10,
                'dos_externo'             => 10,
                'tres_externo'            => 10,
                'cuatro_externo'          => 10,
                'cinco_externo'           => 10,
                'seis_externo'            => 10,
                'uno_interno'             => 10,
                'dos_interno'             => 10,
                'tres_interno'            => 10,
                'cuatro_interno'          => 10,
                'cinco_interno'           => 10,
                'seis_interno'            => 10,
                'id_anteproyecto'         => 10,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 10.',
            ],
            [
                'id_calificar_residencia' => 11,
                'uno_externo'             => 11,
                'dos_externo'             => 11,
                'tres_externo'            => 11,
                'cuatro_externo'          => 11,
                'cinco_externo'           => 11,
                'seis_externo'            => 11,
                'uno_interno'             => 11,
                'dos_interno'             => 11,
                'tres_interno'            => 11,
                'cuatro_interno'          => 11,
                'cinco_interno'           => 11,
                'seis_interno'            => 11,
                'id_anteproyecto'         => 11,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 11.',
            ],
            [
                'id_calificar_residencia' => 12,
                'uno_externo'             => 12,
                'dos_externo'             => 12,
                'tres_externo'            => 12,
                'cuatro_externo'          => 12,
                'cinco_externo'           => 12,
                'seis_externo'            => 12,
                'uno_interno'             => 12,
                'dos_interno'             => 12,
                'tres_interno'            => 12,
                'cuatro_interno'          => 12,
                'cinco_interno'           => 12,
                'seis_interno'            => 12,
                'id_anteproyecto'         => 12,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 12.',
            ],
            [
                'id_calificar_residencia' => 13,
                'uno_externo'             => 13,
                'dos_externo'             => 13,
                'tres_externo'            => 13,
                'cuatro_externo'          => 13,
                'cinco_externo'           => 13,
                'seis_externo'            => 13,
                'uno_interno'             => 13,
                'dos_interno'             => 13,
                'tres_interno'            => 13,
                'cuatro_interno'          => 13,
                'cinco_interno'           => 13,
                'seis_interno'            => 13,
                'id_anteproyecto'         => 13,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 13.',
            ],
            [
                'id_calificar_residencia' => 14,
                'uno_externo'             => 14,
                'dos_externo'             => 14,
                'tres_externo'            => 14,
                'cuatro_externo'          => 14,
                'cinco_externo'           => 14,
                'seis_externo'            => 14,
                'uno_interno'             => 14,
                'dos_interno'             => 14,
                'tres_interno'            => 14,
                'cuatro_interno'          => 14,
                'cinco_interno'           => 14,
                'seis_interno'            => 14,
                'id_anteproyecto'         => 14,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 14.',
            ],
            [
                'id_calificar_residencia' => 15,
                'uno_externo'             => 15,
                'dos_externo'             => 15,
                'tres_externo'            => 15,
                'cuatro_externo'          => 15,
                'cinco_externo'           => 15,
                'seis_externo'            => 15,
                'uno_interno'             => 15,
                'dos_interno'             => 15,
                'tres_interno'            => 15,
                'cuatro_interno'          => 15,
                'cinco_interno'           => 15,
                'seis_interno'            => 15,
                'id_anteproyecto'         => 15,
                'observacion'             => 'Observacion de calificar residencia: registro de prueba número 15.',
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
