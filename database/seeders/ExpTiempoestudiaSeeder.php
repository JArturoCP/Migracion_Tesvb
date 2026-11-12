<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `exp_tiempoestudia`.
 */
class ExpTiempoestudiaSeeder extends Seeder
{
    /**
     * Pobla la tabla `exp_tiempoestudia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'exp_tiempoestudia';

        $llaves = [
            ['id_tiempoestudia'],
        ];

        $registros = [
            [
                'id_tiempoestudia'   => 1,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 1',
            ],
            [
                'id_tiempoestudia'   => 2,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 2',
            ],
            [
                'id_tiempoestudia'   => 3,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 3',
            ],
            [
                'id_tiempoestudia'   => 4,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 4',
            ],
            [
                'id_tiempoestudia'   => 5,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 5',
            ],
            [
                'id_tiempoestudia'   => 6,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 6',
            ],
            [
                'id_tiempoestudia'   => 7,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 7',
            ],
            [
                'id_tiempoestudia'   => 8,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 8',
            ],
            [
                'id_tiempoestudia'   => 9,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoest 9',
            ],
            [
                'id_tiempoestudia'   => 10,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 10',
            ],
            [
                'id_tiempoestudia'   => 11,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 11',
            ],
            [
                'id_tiempoestudia'   => 12,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 12',
            ],
            [
                'id_tiempoestudia'   => 13,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 13',
            ],
            [
                'id_tiempoestudia'   => 14,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 14',
            ],
            [
                'id_tiempoestudia'   => 15,
                'descripcion_tiempo' => 'Descripcion tiempo tiempoes 15',
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
