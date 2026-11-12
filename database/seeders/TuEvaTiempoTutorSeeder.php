<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_tiempo_tutor`.
 */
class TuEvaTiempoTutorSeeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_tiempo_tutor` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'tu_eva_tiempo_tutor';

        $llaves = [
            ['id_eva_tiempo_tutor'],
        ];

        $registros = [
            [
                'id_eva_tiempo_tutor' => 1,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 1',
            ],
            [
                'id_eva_tiempo_tutor' => 2,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 2',
            ],
            [
                'id_eva_tiempo_tutor' => 3,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 3',
            ],
            [
                'id_eva_tiempo_tutor' => 4,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 4',
            ],
            [
                'id_eva_tiempo_tutor' => 5,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 5',
            ],
            [
                'id_eva_tiempo_tutor' => 6,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 6',
            ],
            [
                'id_eva_tiempo_tutor' => 7,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 7',
            ],
            [
                'id_eva_tiempo_tutor' => 8,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 8',
            ],
            [
                'id_eva_tiempo_tutor' => 9,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 9',
            ],
            [
                'id_eva_tiempo_tutor' => 10,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 10',
            ],
            [
                'id_eva_tiempo_tutor' => 11,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 11',
            ],
            [
                'id_eva_tiempo_tutor' => 12,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 12',
            ],
            [
                'id_eva_tiempo_tutor' => 13,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 13',
            ],
            [
                'id_eva_tiempo_tutor' => 14,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 14',
            ],
            [
                'id_eva_tiempo_tutor' => 15,
                'desctipcion'         => 'Desctipcion eva tiempo tutor 15',
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
