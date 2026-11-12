<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_requisitos`.
 */
class RiRequisitosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_requisitos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            RiUnidadParteSeeder::class,
        ]);

        $tabla = 'ri_requisitos';

        $llaves = [
            ['id_requisito'],
        ];

        $registros = [
            [
                'id_requisito'  => 1,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 1.',
                'id_uni_p'      => 1,
                'updated_at'    => '2026-01-05 09:00:00',
                'created_at'    => '2026-01-05 09:00:00',
            ],
            [
                'id_requisito'  => 2,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 2.',
                'id_uni_p'      => 2,
                'updated_at'    => '2026-01-14 10:00:00',
                'created_at'    => '2026-01-14 10:00:00',
            ],
            [
                'id_requisito'  => 3,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 3.',
                'id_uni_p'      => 3,
                'updated_at'    => '2026-01-23 11:00:00',
                'created_at'    => '2026-01-23 11:00:00',
            ],
            [
                'id_requisito'  => 4,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 4.',
                'id_uni_p'      => 4,
                'updated_at'    => '2026-02-01 12:00:00',
                'created_at'    => '2026-02-01 12:00:00',
            ],
            [
                'id_requisito'  => 5,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 5.',
                'id_uni_p'      => 5,
                'updated_at'    => '2026-02-10 13:00:00',
                'created_at'    => '2026-02-10 13:00:00',
            ],
            [
                'id_requisito'  => 6,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 6.',
                'id_uni_p'      => 6,
                'updated_at'    => '2026-02-19 14:00:00',
                'created_at'    => '2026-02-19 14:00:00',
            ],
            [
                'id_requisito'  => 7,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 7.',
                'id_uni_p'      => 7,
                'updated_at'    => '2026-02-28 15:00:00',
                'created_at'    => '2026-02-28 15:00:00',
            ],
            [
                'id_requisito'  => 8,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 8.',
                'id_uni_p'      => 8,
                'updated_at'    => '2026-03-09 16:00:00',
                'created_at'    => '2026-03-09 16:00:00',
            ],
            [
                'id_requisito'  => 9,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 9.',
                'id_uni_p'      => 9,
                'updated_at'    => '2026-03-18 08:00:00',
                'created_at'    => '2026-03-18 08:00:00',
            ],
            [
                'id_requisito'  => 10,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 10.',
                'id_uni_p'      => 10,
                'updated_at'    => '2026-03-27 09:00:00',
                'created_at'    => '2026-03-27 09:00:00',
            ],
            [
                'id_requisito'  => 11,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 11.',
                'id_uni_p'      => 11,
                'updated_at'    => '2026-04-05 10:00:00',
                'created_at'    => '2026-04-05 10:00:00',
            ],
            [
                'id_requisito'  => 12,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 12.',
                'id_uni_p'      => 12,
                'updated_at'    => '2026-04-14 11:00:00',
                'created_at'    => '2026-04-14 11:00:00',
            ],
            [
                'id_requisito'  => 13,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 13.',
                'id_uni_p'      => 13,
                'updated_at'    => '2026-04-23 12:00:00',
                'created_at'    => '2026-04-23 12:00:00',
            ],
            [
                'id_requisito'  => 14,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 14.',
                'id_uni_p'      => 14,
                'updated_at'    => '2026-05-02 13:00:00',
                'created_at'    => '2026-05-02 13:00:00',
            ],
            [
                'id_requisito'  => 15,
                'des_requisito' => 'Des requisito de requisitos: registro de prueba número 15.',
                'id_uni_p'      => 15,
                'updated_at'    => '2026-05-11 14:00:00',
                'created_at'    => '2026-05-11 14:00:00',
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
