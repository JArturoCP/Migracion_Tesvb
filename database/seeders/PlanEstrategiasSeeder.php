<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_estrategias`.
 */
class PlanEstrategiasSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_estrategias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'plan_estrategias';

        $llaves = [
            ['id_estrategia'],
        ];

        $registros = [
            [
                'id_estrategia'  => 1,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 1.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 1.',
                'created_at'     => '2026-01-05',
                'updated_at'     => '2026-01-05',
            ],
            [
                'id_estrategia'  => 2,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 2.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 2.',
                'created_at'     => '2026-01-14',
                'updated_at'     => '2026-01-14',
            ],
            [
                'id_estrategia'  => 3,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 3.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 3.',
                'created_at'     => '2026-01-23',
                'updated_at'     => '2026-01-23',
            ],
            [
                'id_estrategia'  => 4,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 4.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 4.',
                'created_at'     => '2026-02-01',
                'updated_at'     => '2026-02-01',
            ],
            [
                'id_estrategia'  => 5,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 5.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 5.',
                'created_at'     => '2026-02-10',
                'updated_at'     => '2026-02-10',
            ],
            [
                'id_estrategia'  => 6,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 6.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 6.',
                'created_at'     => '2026-02-19',
                'updated_at'     => '2026-02-19',
            ],
            [
                'id_estrategia'  => 7,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 7.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 7.',
                'created_at'     => '2026-02-28',
                'updated_at'     => '2026-02-28',
            ],
            [
                'id_estrategia'  => 8,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 8.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 8.',
                'created_at'     => '2026-03-09',
                'updated_at'     => '2026-03-09',
            ],
            [
                'id_estrategia'  => 9,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 9.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 9.',
                'created_at'     => '2026-03-18',
                'updated_at'     => '2026-03-18',
            ],
            [
                'id_estrategia'  => 10,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 10.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 10.',
                'created_at'     => '2026-03-27',
                'updated_at'     => '2026-03-27',
            ],
            [
                'id_estrategia'  => 11,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 11.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 11.',
                'created_at'     => '2026-04-05',
                'updated_at'     => '2026-04-05',
            ],
            [
                'id_estrategia'  => 12,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 12.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 12.',
                'created_at'     => '2026-04-14',
                'updated_at'     => '2026-04-14',
            ],
            [
                'id_estrategia'  => 13,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 13.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 13.',
                'created_at'     => '2026-04-23',
                'updated_at'     => '2026-04-23',
            ],
            [
                'id_estrategia'  => 14,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 14.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 14.',
                'created_at'     => '2026-05-02',
                'updated_at'     => '2026-05-02',
            ],
            [
                'id_estrategia'  => 15,
                'id_tema_sesion' => 'Id tema sesion de estrategias: registro de prueba número 15.',
                'estrategias'    => 'Estrategias de estrategias: registro de prueba número 15.',
                'created_at'     => '2026-05-11',
                'updated_at'     => '2026-05-11',
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
