<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_objetivos`.
 */
class ResiObjetivosSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_objetivos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_objetivos';

        $llaves = [
            ['id_objetivos'],
        ];

        $registros = [
            [
                'id_objetivos'                       => 1,
                'id_anteproyecto'                    => 1,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 1.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 1.',
                'estado'                             => 1,
                'id_periodo_evaluacion_anteproyecto' => 1,
                'estado_aceptado_objetivos'          => 1,
            ],
            [
                'id_objetivos'                       => 2,
                'id_anteproyecto'                    => 2,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 2.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 2.',
                'estado'                             => 2,
                'id_periodo_evaluacion_anteproyecto' => 2,
                'estado_aceptado_objetivos'          => 2,
            ],
            [
                'id_objetivos'                       => 3,
                'id_anteproyecto'                    => 3,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 3.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 3.',
                'estado'                             => 3,
                'id_periodo_evaluacion_anteproyecto' => 3,
                'estado_aceptado_objetivos'          => 3,
            ],
            [
                'id_objetivos'                       => 4,
                'id_anteproyecto'                    => 4,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 4.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 4.',
                'estado'                             => 4,
                'id_periodo_evaluacion_anteproyecto' => 4,
                'estado_aceptado_objetivos'          => 4,
            ],
            [
                'id_objetivos'                       => 5,
                'id_anteproyecto'                    => 5,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 5.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 5.',
                'estado'                             => 5,
                'id_periodo_evaluacion_anteproyecto' => 5,
                'estado_aceptado_objetivos'          => 5,
            ],
            [
                'id_objetivos'                       => 6,
                'id_anteproyecto'                    => 6,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 6.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 6.',
                'estado'                             => 6,
                'id_periodo_evaluacion_anteproyecto' => 6,
                'estado_aceptado_objetivos'          => 6,
            ],
            [
                'id_objetivos'                       => 7,
                'id_anteproyecto'                    => 7,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 7.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 7.',
                'estado'                             => 7,
                'id_periodo_evaluacion_anteproyecto' => 7,
                'estado_aceptado_objetivos'          => 7,
            ],
            [
                'id_objetivos'                       => 8,
                'id_anteproyecto'                    => 8,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 8.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 8.',
                'estado'                             => 8,
                'id_periodo_evaluacion_anteproyecto' => 8,
                'estado_aceptado_objetivos'          => 8,
            ],
            [
                'id_objetivos'                       => 9,
                'id_anteproyecto'                    => 9,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 9.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 9.',
                'estado'                             => 9,
                'id_periodo_evaluacion_anteproyecto' => 9,
                'estado_aceptado_objetivos'          => 9,
            ],
            [
                'id_objetivos'                       => 10,
                'id_anteproyecto'                    => 10,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 10.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 10.',
                'estado'                             => 10,
                'id_periodo_evaluacion_anteproyecto' => 10,
                'estado_aceptado_objetivos'          => 10,
            ],
            [
                'id_objetivos'                       => 11,
                'id_anteproyecto'                    => 11,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 11.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 11.',
                'estado'                             => 11,
                'id_periodo_evaluacion_anteproyecto' => 11,
                'estado_aceptado_objetivos'          => 11,
            ],
            [
                'id_objetivos'                       => 12,
                'id_anteproyecto'                    => 12,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 12.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 12.',
                'estado'                             => 12,
                'id_periodo_evaluacion_anteproyecto' => 12,
                'estado_aceptado_objetivos'          => 12,
            ],
            [
                'id_objetivos'                       => 13,
                'id_anteproyecto'                    => 13,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 13.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 13.',
                'estado'                             => 13,
                'id_periodo_evaluacion_anteproyecto' => 13,
                'estado_aceptado_objetivos'          => 13,
            ],
            [
                'id_objetivos'                       => 14,
                'id_anteproyecto'                    => 14,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 14.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 14.',
                'estado'                             => 14,
                'id_periodo_evaluacion_anteproyecto' => 14,
                'estado_aceptado_objetivos'          => 14,
            ],
            [
                'id_objetivos'                       => 15,
                'id_anteproyecto'                    => 15,
                'obj_general'                        => 'Obj general de objetivos: registro de prueba número 15.',
                'obj_especifico'                     => 'Obj especifico de objetivos: registro de prueba número 15.',
                'estado'                             => 15,
                'id_periodo_evaluacion_anteproyecto' => 15,
                'estado_aceptado_objetivos'          => 15,
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
