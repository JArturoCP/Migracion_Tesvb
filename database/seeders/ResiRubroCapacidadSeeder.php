<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_rubro_capacidad`.
 */
class ResiRubroCapacidadSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_rubro_capacidad` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
            ResiCronogramaSeeder::class,
        ]);

        $tabla = 'resi_rubro_capacidad';

        $llaves = [
            ['id_rubro_capacidad'],
        ];

        $registros = [
            [
                'id_rubro_capacidad' => 1,
                'id_cronograma'      => 1,
                'calificacion'       => 77,
                'id_anteproyecto'    => 1,
                'semana'             => 1,
            ],
            [
                'id_rubro_capacidad' => 2,
                'id_cronograma'      => 2,
                'calificacion'       => 84,
                'id_anteproyecto'    => 2,
                'semana'             => 2,
            ],
            [
                'id_rubro_capacidad' => 3,
                'id_cronograma'      => 3,
                'calificacion'       => 91,
                'id_anteproyecto'    => 3,
                'semana'             => 3,
            ],
            [
                'id_rubro_capacidad' => 4,
                'id_cronograma'      => 4,
                'calificacion'       => 98,
                'id_anteproyecto'    => 4,
                'semana'             => 4,
            ],
            [
                'id_rubro_capacidad' => 5,
                'id_cronograma'      => 5,
                'calificacion'       => 74,
                'id_anteproyecto'    => 5,
                'semana'             => 5,
            ],
            [
                'id_rubro_capacidad' => 6,
                'id_cronograma'      => 6,
                'calificacion'       => 81,
                'id_anteproyecto'    => 6,
                'semana'             => 6,
            ],
            [
                'id_rubro_capacidad' => 7,
                'id_cronograma'      => 7,
                'calificacion'       => 88,
                'id_anteproyecto'    => 7,
                'semana'             => 7,
            ],
            [
                'id_rubro_capacidad' => 8,
                'id_cronograma'      => 8,
                'calificacion'       => 95,
                'id_anteproyecto'    => 8,
                'semana'             => 8,
            ],
            [
                'id_rubro_capacidad' => 9,
                'id_cronograma'      => 9,
                'calificacion'       => 71,
                'id_anteproyecto'    => 9,
                'semana'             => 9,
            ],
            [
                'id_rubro_capacidad' => 10,
                'id_cronograma'      => 10,
                'calificacion'       => 78,
                'id_anteproyecto'    => 10,
                'semana'             => 10,
            ],
            [
                'id_rubro_capacidad' => 11,
                'id_cronograma'      => 11,
                'calificacion'       => 85,
                'id_anteproyecto'    => 11,
                'semana'             => 11,
            ],
            [
                'id_rubro_capacidad' => 12,
                'id_cronograma'      => 12,
                'calificacion'       => 92,
                'id_anteproyecto'    => 12,
                'semana'             => 12,
            ],
            [
                'id_rubro_capacidad' => 13,
                'id_cronograma'      => 13,
                'calificacion'       => 99,
                'id_anteproyecto'    => 13,
                'semana'             => 13,
            ],
            [
                'id_rubro_capacidad' => 14,
                'id_cronograma'      => 14,
                'calificacion'       => 75,
                'id_anteproyecto'    => 14,
                'semana'             => 14,
            ],
            [
                'id_rubro_capacidad' => 15,
                'id_cronograma'      => 15,
                'calificacion'       => 82,
                'id_anteproyecto'    => 15,
                'semana'             => 15,
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
