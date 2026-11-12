<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_area_personal`.
 */
class ArAreaPersonalSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_area_personal` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArAreasAtencionSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_area_personal';

        $llaves = [
            ['id_area_personal'],
            ['id_area_atencion', 'id_personal'],
        ];

        $registros = [
            [
                'id_area_personal' => 1,
                'id_area_atencion' => 1,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 1',
                'activo'           => 1,
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_area_personal' => 2,
                'id_area_atencion' => 2,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 2',
                'activo'           => 1,
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_area_personal' => 3,
                'id_area_atencion' => 3,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 3',
                'activo'           => 1,
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_area_personal' => 4,
                'id_area_atencion' => 4,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 4',
                'activo'           => 1,
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_area_personal' => 5,
                'id_area_atencion' => 5,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 5',
                'activo'           => 1,
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_area_personal' => 6,
                'id_area_atencion' => 6,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 6',
                'activo'           => 1,
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_area_personal' => 7,
                'id_area_atencion' => 7,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 7',
                'activo'           => 1,
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_area_personal' => 8,
                'id_area_atencion' => 8,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 8',
                'activo'           => 1,
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_area_personal' => 9,
                'id_area_atencion' => 9,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 9',
                'activo'           => 1,
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_area_personal' => 10,
                'id_area_atencion' => 10,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 10',
                'activo'           => 1,
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_area_personal' => 11,
                'id_area_atencion' => 11,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 11',
                'activo'           => 1,
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_area_personal' => 12,
                'id_area_atencion' => 12,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 12',
                'activo'           => 1,
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_area_personal' => 13,
                'id_area_atencion' => 13,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 13',
                'activo'           => 1,
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_area_personal' => 14,
                'id_area_atencion' => 14,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 14',
                'activo'           => 1,
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_area_personal' => 15,
                'id_area_atencion' => 15,
                'id_personal'      => 1,
                'rol_area'         => 'Rol area area personal 15',
                'activo'           => 1,
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
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
