<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_area_responsables_periodo`.
 */
class ArAreaResponsablesPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_area_responsables_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArAreasAtencionSeeder::class,
            GnralPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_area_responsables_periodo';

        $llaves = [
            ['id_area_responsable_periodo'],
            ['id_area_atencion', 'id_periodo', 'id_personal'],
        ];

        $registros = [
            [
                'id_area_responsable_periodo' => 1,
                'id_area_atencion'            => 1,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 1',
                'activo'                      => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
            ],
            [
                'id_area_responsable_periodo' => 2,
                'id_area_atencion'            => 2,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 2',
                'activo'                      => 1,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
            ],
            [
                'id_area_responsable_periodo' => 3,
                'id_area_atencion'            => 3,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 3',
                'activo'                      => 1,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
            ],
            [
                'id_area_responsable_periodo' => 4,
                'id_area_atencion'            => 4,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 4',
                'activo'                      => 1,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
            ],
            [
                'id_area_responsable_periodo' => 5,
                'id_area_atencion'            => 5,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 5',
                'activo'                      => 1,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
            ],
            [
                'id_area_responsable_periodo' => 6,
                'id_area_atencion'            => 6,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 6',
                'activo'                      => 1,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
            ],
            [
                'id_area_responsable_periodo' => 7,
                'id_area_atencion'            => 7,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 7',
                'activo'                      => 1,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
            ],
            [
                'id_area_responsable_periodo' => 8,
                'id_area_atencion'            => 8,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 8',
                'activo'                      => 1,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
            ],
            [
                'id_area_responsable_periodo' => 9,
                'id_area_atencion'            => 9,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 9',
                'activo'                      => 1,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
            ],
            [
                'id_area_responsable_periodo' => 10,
                'id_area_atencion'            => 10,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 10',
                'activo'                      => 1,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
            ],
            [
                'id_area_responsable_periodo' => 11,
                'id_area_atencion'            => 11,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 11',
                'activo'                      => 1,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
            ],
            [
                'id_area_responsable_periodo' => 12,
                'id_area_atencion'            => 12,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 12',
                'activo'                      => 1,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
            ],
            [
                'id_area_responsable_periodo' => 13,
                'id_area_atencion'            => 13,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 13',
                'activo'                      => 1,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
            ],
            [
                'id_area_responsable_periodo' => 14,
                'id_area_atencion'            => 14,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 14',
                'activo'                      => 1,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
            ],
            [
                'id_area_responsable_periodo' => 15,
                'id_area_atencion'            => 15,
                'id_periodo'                  => 1,
                'id_personal'                 => 1,
                'rol_area'                    => 'Rol area area responsables periodo 15',
                'activo'                      => 1,
                'created_at'                  => '2026-05-11 14:00:00',
                'updated_at'                  => '2026-05-11 14:00:00',
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
