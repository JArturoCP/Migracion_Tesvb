<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_temarios`.
 */
class PlanTemariosSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_temarios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralMateriasSeeder::class,
        ]);

        $tabla = 'plan_temarios';

        $llaves = [
            ['id_temario'],
        ];

        $registros = [
            [
                'id_temario'    => 1,
                'id_materia'    => 1,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 1.',
                'enlace'        => 'https://example.com/plan_temarios/1',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 1.',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
            ],
            [
                'id_temario'    => 2,
                'id_materia'    => 2,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 2.',
                'enlace'        => 'https://example.com/plan_temarios/2',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 2.',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
            ],
            [
                'id_temario'    => 3,
                'id_materia'    => 3,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 3.',
                'enlace'        => 'https://example.com/plan_temarios/3',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 3.',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
            ],
            [
                'id_temario'    => 4,
                'id_materia'    => 4,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 4.',
                'enlace'        => 'https://example.com/plan_temarios/4',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 4.',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
            ],
            [
                'id_temario'    => 5,
                'id_materia'    => 5,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 5.',
                'enlace'        => 'https://example.com/plan_temarios/5',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 5.',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
            ],
            [
                'id_temario'    => 6,
                'id_materia'    => 6,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 6.',
                'enlace'        => 'https://example.com/plan_temarios/6',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 6.',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
            ],
            [
                'id_temario'    => 7,
                'id_materia'    => 7,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 7.',
                'enlace'        => 'https://example.com/plan_temarios/7',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 7.',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
            ],
            [
                'id_temario'    => 8,
                'id_materia'    => 8,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 8.',
                'enlace'        => 'https://example.com/plan_temarios/8',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 8.',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
            ],
            [
                'id_temario'    => 9,
                'id_materia'    => 9,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 9.',
                'enlace'        => 'https://example.com/plan_temarios/9',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 9.',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
            ],
            [
                'id_temario'    => 10,
                'id_materia'    => 10,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 10.',
                'enlace'        => 'https://example.com/plan_temarios/10',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 10.',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
            ],
            [
                'id_temario'    => 11,
                'id_materia'    => 11,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 11.',
                'enlace'        => 'https://example.com/plan_temarios/11',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 11.',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
            ],
            [
                'id_temario'    => 12,
                'id_materia'    => 12,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 12.',
                'enlace'        => 'https://example.com/plan_temarios/12',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 12.',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
            ],
            [
                'id_temario'    => 13,
                'id_materia'    => 13,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 13.',
                'enlace'        => 'https://example.com/plan_temarios/13',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 13.',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
            ],
            [
                'id_temario'    => 14,
                'id_materia'    => 14,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 14.',
                'enlace'        => 'https://example.com/plan_temarios/14',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 14.',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
            ],
            [
                'id_temario'    => 15,
                'id_materia'    => 15,
                'competencia_d' => 'Competencia d de temarios: registro de prueba número 15.',
                'enlace'        => 'https://example.com/plan_temarios/15',
                'fuentes_i'     => 'Fuentes i de temarios: registro de prueba número 15.',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
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
