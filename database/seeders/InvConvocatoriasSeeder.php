<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_convocatorias`.
 */
class InvConvocatoriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_convocatorias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_convocatorias';

        $llaves = [
            ['id_convocatoria'],
        ];

        $registros = [
            [
                'id_convocatoria' => 1,
                'fecha_inicio'    => '2026-01-05',
                'fecha_fin'       => '2026-01-05',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 1.',
                'created_at'      => '2026-01-05 09:00:00',
                'updated_at'      => '2026-01-05 09:00:00',
                'deleted_at'      => null,
                'id_estado'       => 1,
            ],
            [
                'id_convocatoria' => 2,
                'fecha_inicio'    => '2026-01-14',
                'fecha_fin'       => '2026-01-14',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 2.',
                'created_at'      => '2026-01-14 10:00:00',
                'updated_at'      => '2026-01-14 10:00:00',
                'deleted_at'      => null,
                'id_estado'       => 2,
            ],
            [
                'id_convocatoria' => 3,
                'fecha_inicio'    => '2026-01-23',
                'fecha_fin'       => '2026-01-23',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 3.',
                'created_at'      => '2026-01-23 11:00:00',
                'updated_at'      => '2026-01-23 11:00:00',
                'deleted_at'      => null,
                'id_estado'       => 3,
            ],
            [
                'id_convocatoria' => 4,
                'fecha_inicio'    => '2026-02-01',
                'fecha_fin'       => '2026-02-01',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 4.',
                'created_at'      => '2026-02-01 12:00:00',
                'updated_at'      => '2026-02-01 12:00:00',
                'deleted_at'      => null,
                'id_estado'       => 4,
            ],
            [
                'id_convocatoria' => 5,
                'fecha_inicio'    => '2026-02-10',
                'fecha_fin'       => '2026-02-10',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 5.',
                'created_at'      => '2026-02-10 13:00:00',
                'updated_at'      => '2026-02-10 13:00:00',
                'deleted_at'      => null,
                'id_estado'       => 5,
            ],
            [
                'id_convocatoria' => 6,
                'fecha_inicio'    => '2026-02-19',
                'fecha_fin'       => '2026-02-19',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 6.',
                'created_at'      => '2026-02-19 14:00:00',
                'updated_at'      => '2026-02-19 14:00:00',
                'deleted_at'      => null,
                'id_estado'       => 6,
            ],
            [
                'id_convocatoria' => 7,
                'fecha_inicio'    => '2026-02-28',
                'fecha_fin'       => '2026-02-28',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 7.',
                'created_at'      => '2026-02-28 15:00:00',
                'updated_at'      => '2026-02-28 15:00:00',
                'deleted_at'      => null,
                'id_estado'       => 7,
            ],
            [
                'id_convocatoria' => 8,
                'fecha_inicio'    => '2026-03-09',
                'fecha_fin'       => '2026-03-09',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 8.',
                'created_at'      => '2026-03-09 16:00:00',
                'updated_at'      => '2026-03-09 16:00:00',
                'deleted_at'      => null,
                'id_estado'       => 8,
            ],
            [
                'id_convocatoria' => 9,
                'fecha_inicio'    => '2026-03-18',
                'fecha_fin'       => '2026-03-18',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 9.',
                'created_at'      => '2026-03-18 08:00:00',
                'updated_at'      => '2026-03-18 08:00:00',
                'deleted_at'      => null,
                'id_estado'       => 9,
            ],
            [
                'id_convocatoria' => 10,
                'fecha_inicio'    => '2026-03-27',
                'fecha_fin'       => '2026-03-27',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 10.',
                'created_at'      => '2026-03-27 09:00:00',
                'updated_at'      => '2026-03-27 09:00:00',
                'deleted_at'      => null,
                'id_estado'       => 10,
            ],
            [
                'id_convocatoria' => 11,
                'fecha_inicio'    => '2026-04-05',
                'fecha_fin'       => '2026-04-05',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 11.',
                'created_at'      => '2026-04-05 10:00:00',
                'updated_at'      => '2026-04-05 10:00:00',
                'deleted_at'      => null,
                'id_estado'       => 11,
            ],
            [
                'id_convocatoria' => 12,
                'fecha_inicio'    => '2026-04-14',
                'fecha_fin'       => '2026-04-14',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 12.',
                'created_at'      => '2026-04-14 11:00:00',
                'updated_at'      => '2026-04-14 11:00:00',
                'deleted_at'      => null,
                'id_estado'       => 12,
            ],
            [
                'id_convocatoria' => 13,
                'fecha_inicio'    => '2026-04-23',
                'fecha_fin'       => '2026-04-23',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 13.',
                'created_at'      => '2026-04-23 12:00:00',
                'updated_at'      => '2026-04-23 12:00:00',
                'deleted_at'      => null,
                'id_estado'       => 13,
            ],
            [
                'id_convocatoria' => 14,
                'fecha_inicio'    => '2026-05-02',
                'fecha_fin'       => '2026-05-02',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 14.',
                'created_at'      => '2026-05-02 13:00:00',
                'updated_at'      => '2026-05-02 13:00:00',
                'deleted_at'      => null,
                'id_estado'       => 14,
            ],
            [
                'id_convocatoria' => 15,
                'fecha_inicio'    => '2026-05-11',
                'fecha_fin'       => '2026-05-11',
                'observaciones'   => 'Observaciones de convocatorias: registro de prueba número 15.',
                'created_at'      => '2026-05-11 14:00:00',
                'updated_at'      => '2026-05-11 14:00:00',
                'deleted_at'      => null,
                'id_estado'       => 15,
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
