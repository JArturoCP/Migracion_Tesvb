<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `plan_discapacidad_descripciones`.
 */
class PlanDiscapacidadDescripcionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `plan_discapacidad_descripciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PlanTemariosSeeder::class,
        ]);

        $tabla = 'plan_discapacidad_descripciones';

        $llaves = [
            ['id'],
        ];

        $registros = [
            [
                'id'          => 1,
                'id_temario'  => 1,
                'grupo'       => 1,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 1.',
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id'          => 2,
                'id_temario'  => 2,
                'grupo'       => 2,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 2.',
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id'          => 3,
                'id_temario'  => 3,
                'grupo'       => 3,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 3.',
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id'          => 4,
                'id_temario'  => 4,
                'grupo'       => 4,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 4.',
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id'          => 5,
                'id_temario'  => 5,
                'grupo'       => 5,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 5.',
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id'          => 6,
                'id_temario'  => 6,
                'grupo'       => 6,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 6.',
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id'          => 7,
                'id_temario'  => 7,
                'grupo'       => 7,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 7.',
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id'          => 8,
                'id_temario'  => 8,
                'grupo'       => 8,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 8.',
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id'          => 9,
                'id_temario'  => 9,
                'grupo'       => 9,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 9.',
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id'          => 10,
                'id_temario'  => 10,
                'grupo'       => 10,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 10.',
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id'          => 11,
                'id_temario'  => 11,
                'grupo'       => 11,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 11.',
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id'          => 12,
                'id_temario'  => 12,
                'grupo'       => 12,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 12.',
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id'          => 13,
                'id_temario'  => 13,
                'grupo'       => 13,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 13.',
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id'          => 14,
                'id_temario'  => 14,
                'grupo'       => 14,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 14.',
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id'          => 15,
                'id_temario'  => 15,
                'grupo'       => 15,
                'descripcion' => 'Descripcion de discapacidad descripciones: registro de prueba número 15.',
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
