<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `permissions`.
 */
class PermissionsSeeder extends Seeder
{
    /**
     * Pobla la tabla `permissions` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'permissions';

        $llaves = [
            ['id'],
            ['name', 'guard_name'],
        ];

        $registros = [
            [
                'id'         => 1,
                'name'       => 'ver_panel',
                'guard_name' => 'web',
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'name'       => 'gestionar_usuarios',
                'guard_name' => 'web',
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'name'       => 'capturar_calificaciones',
                'guard_name' => 'web',
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'name'       => 'ver_reportes',
                'guard_name' => 'web',
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'name'       => 'gestionar_periodos',
                'guard_name' => 'web',
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
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
