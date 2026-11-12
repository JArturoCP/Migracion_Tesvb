<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_instituciones`.
 */
class InvInstitucionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_instituciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_instituciones';

        $llaves = [
            ['id_institucion'],
        ];

        $registros = [
            [
                'id_institucion'   => 1,
                'desc_institucion' => 'Desc institucion instituciones 1',
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 2,
                'desc_institucion' => 'Desc institucion instituciones 2',
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 3,
                'desc_institucion' => 'Desc institucion instituciones 3',
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 4,
                'desc_institucion' => 'Desc institucion instituciones 4',
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 5,
                'desc_institucion' => 'Desc institucion instituciones 5',
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 6,
                'desc_institucion' => 'Desc institucion instituciones 6',
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 7,
                'desc_institucion' => 'Desc institucion instituciones 7',
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 8,
                'desc_institucion' => 'Desc institucion instituciones 8',
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 9,
                'desc_institucion' => 'Desc institucion instituciones 9',
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 10,
                'desc_institucion' => 'Desc institucion instituciones 10',
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 11,
                'desc_institucion' => 'Desc institucion instituciones 11',
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 12,
                'desc_institucion' => 'Desc institucion instituciones 12',
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 13,
                'desc_institucion' => 'Desc institucion instituciones 13',
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 14,
                'desc_institucion' => 'Desc institucion instituciones 14',
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'deleted_at'       => null,
            ],
            [
                'id_institucion'   => 15,
                'desc_institucion' => 'Desc institucion instituciones 15',
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'deleted_at'       => null,
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
