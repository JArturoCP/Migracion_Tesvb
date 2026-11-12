<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_plantilla_periodo`.
 */
class InPlantillaPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_plantilla_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'in_plantilla_periodo';

        $llaves = [
            ['id_plantilla_periodo'],
        ];

        $registros = [
            [
                'id_plantilla_periodo' => 1,
                'id_periodo'           => 12,
                'id_profesor'          => 1,
            ],
            [
                'id_plantilla_periodo' => 2,
                'id_periodo'           => 12,
                'id_profesor'          => 2,
            ],
            [
                'id_plantilla_periodo' => 3,
                'id_periodo'           => 3,
                'id_profesor'          => 3,
            ],
            [
                'id_plantilla_periodo' => 4,
                'id_periodo'           => 12,
                'id_profesor'          => 4,
            ],
            [
                'id_plantilla_periodo' => 5,
                'id_periodo'           => 12,
                'id_profesor'          => 5,
            ],
            [
                'id_plantilla_periodo' => 6,
                'id_periodo'           => 6,
                'id_profesor'          => 6,
            ],
            [
                'id_plantilla_periodo' => 7,
                'id_periodo'           => 12,
                'id_profesor'          => 7,
            ],
            [
                'id_plantilla_periodo' => 8,
                'id_periodo'           => 12,
                'id_profesor'          => 8,
            ],
            [
                'id_plantilla_periodo' => 9,
                'id_periodo'           => 9,
                'id_profesor'          => 9,
            ],
            [
                'id_plantilla_periodo' => 10,
                'id_periodo'           => 12,
                'id_profesor'          => 10,
            ],
            [
                'id_plantilla_periodo' => 11,
                'id_periodo'           => 12,
                'id_profesor'          => 11,
            ],
            [
                'id_plantilla_periodo' => 12,
                'id_periodo'           => 12,
                'id_profesor'          => 12,
            ],
            [
                'id_plantilla_periodo' => 13,
                'id_periodo'           => 12,
                'id_profesor'          => 13,
            ],
            [
                'id_plantilla_periodo' => 14,
                'id_periodo'           => 12,
                'id_profesor'          => 14,
            ],
            [
                'id_plantilla_periodo' => 15,
                'id_periodo'           => 15,
                'id_profesor'          => 15,
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
