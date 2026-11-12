<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_unidades`.
 */
class PlanUnidadesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_unidades` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_unidades';

        $llaves = [
            ['id_unidad'],
        ];

        $registros = [
            [
                'id_unidad'   => 1,
                'numero'      => 1,
                'nombre'      => 'Nombre unidades 1',
                'id_temario'  => 1,
                'competencia' => 'Competencia de unidades: registro de prueba número 1.',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_unidad'   => 2,
                'numero'      => 2,
                'nombre'      => 'Nombre unidades 2',
                'id_temario'  => 2,
                'competencia' => 'Competencia de unidades: registro de prueba número 2.',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_unidad'   => 3,
                'numero'      => 3,
                'nombre'      => 'Nombre unidades 3',
                'id_temario'  => 3,
                'competencia' => 'Competencia de unidades: registro de prueba número 3.',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_unidad'   => 4,
                'numero'      => 4,
                'nombre'      => 'Nombre unidades 4',
                'id_temario'  => 4,
                'competencia' => 'Competencia de unidades: registro de prueba número 4.',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_unidad'   => 5,
                'numero'      => 5,
                'nombre'      => 'Nombre unidades 5',
                'id_temario'  => 5,
                'competencia' => 'Competencia de unidades: registro de prueba número 5.',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_unidad'   => 6,
                'numero'      => 6,
                'nombre'      => 'Nombre unidades 6',
                'id_temario'  => 6,
                'competencia' => 'Competencia de unidades: registro de prueba número 6.',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_unidad'   => 7,
                'numero'      => 7,
                'nombre'      => 'Nombre unidades 7',
                'id_temario'  => 7,
                'competencia' => 'Competencia de unidades: registro de prueba número 7.',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_unidad'   => 8,
                'numero'      => 8,
                'nombre'      => 'Nombre unidades 8',
                'id_temario'  => 8,
                'competencia' => 'Competencia de unidades: registro de prueba número 8.',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_unidad'   => 9,
                'numero'      => 9,
                'nombre'      => 'Nombre unidades 9',
                'id_temario'  => 9,
                'competencia' => 'Competencia de unidades: registro de prueba número 9.',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_unidad'   => 10,
                'numero'      => 10,
                'nombre'      => 'Nombre unidades 10',
                'id_temario'  => 10,
                'competencia' => 'Competencia de unidades: registro de prueba número 10.',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_unidad'   => 11,
                'numero'      => 11,
                'nombre'      => 'Nombre unidades 11',
                'id_temario'  => 11,
                'competencia' => 'Competencia de unidades: registro de prueba número 11.',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_unidad'   => 12,
                'numero'      => 12,
                'nombre'      => 'Nombre unidades 12',
                'id_temario'  => 12,
                'competencia' => 'Competencia de unidades: registro de prueba número 12.',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_unidad'   => 13,
                'numero'      => 13,
                'nombre'      => 'Nombre unidades 13',
                'id_temario'  => 13,
                'competencia' => 'Competencia de unidades: registro de prueba número 13.',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_unidad'   => 14,
                'numero'      => 14,
                'nombre'      => 'Nombre unidades 14',
                'id_temario'  => 14,
                'competencia' => 'Competencia de unidades: registro de prueba número 14.',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_unidad'   => 15,
                'numero'      => 15,
                'nombre'      => 'Nombre unidades 15',
                'id_temario'  => 15,
                'competencia' => 'Competencia de unidades: registro de prueba número 15.',
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
