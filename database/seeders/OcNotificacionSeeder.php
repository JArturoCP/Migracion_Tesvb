<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_notificacion`.
 */
class OcNotificacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_notificacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            OcOficioPersonalSeeder::class,
        ]);

        $tabla = 'oc_notificacion';

        $llaves = [
            ['id_notificacion'],
        ];

        $registros = [
            [
                'id_notificacion'    => 1,
                'id_usuario'         => 1,
                'id_oficio_personal' => 1,
            ],
            [
                'id_notificacion'    => 2,
                'id_usuario'         => 2,
                'id_oficio_personal' => 2,
            ],
            [
                'id_notificacion'    => 3,
                'id_usuario'         => 3,
                'id_oficio_personal' => 3,
            ],
            [
                'id_notificacion'    => 4,
                'id_usuario'         => 4,
                'id_oficio_personal' => 4,
            ],
            [
                'id_notificacion'    => 5,
                'id_usuario'         => 5,
                'id_oficio_personal' => 5,
            ],
            [
                'id_notificacion'    => 6,
                'id_usuario'         => 6,
                'id_oficio_personal' => 6,
            ],
            [
                'id_notificacion'    => 7,
                'id_usuario'         => 7,
                'id_oficio_personal' => 7,
            ],
            [
                'id_notificacion'    => 8,
                'id_usuario'         => 8,
                'id_oficio_personal' => 8,
            ],
            [
                'id_notificacion'    => 9,
                'id_usuario'         => 9,
                'id_oficio_personal' => 9,
            ],
            [
                'id_notificacion'    => 10,
                'id_usuario'         => 10,
                'id_oficio_personal' => 10,
            ],
            [
                'id_notificacion'    => 11,
                'id_usuario'         => 11,
                'id_oficio_personal' => 11,
            ],
            [
                'id_notificacion'    => 12,
                'id_usuario'         => 12,
                'id_oficio_personal' => 12,
            ],
            [
                'id_notificacion'    => 13,
                'id_usuario'         => 13,
                'id_oficio_personal' => 13,
            ],
            [
                'id_notificacion'    => 14,
                'id_usuario'         => 14,
                'id_oficio_personal' => 14,
            ],
            [
                'id_notificacion'    => 15,
                'id_usuario'         => 15,
                'id_oficio_personal' => 15,
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
