<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_autorizar`.
 */
class BecaAutorizarSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_autorizar` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            BecaDescuentoSeeder::class,
            GnralAlumnosSeeder::class,
            GnralPeriodosSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'beca_autorizar';

        $llaves = [
            ['id_autorizar'],
        ];

        $registros = [
            [
                'id_autorizar' => 1,
                'id_alumno'    => 1,
                'id_descuento' => 1,
                'promedio'     => 7.3,
                'id_estado'    => 1,
                'id_periodo'   => 12,
                'id_semestre'  => 1,
                'fecha'        => '2026-01-05',
            ],
            [
                'id_autorizar' => 2,
                'id_alumno'    => 2,
                'id_descuento' => 2,
                'promedio'     => 7.6,
                'id_estado'    => 2,
                'id_periodo'   => 12,
                'id_semestre'  => 2,
                'fecha'        => '2026-01-14',
            ],
            [
                'id_autorizar' => 3,
                'id_alumno'    => 3,
                'id_descuento' => 3,
                'promedio'     => 7.9,
                'id_estado'    => 3,
                'id_periodo'   => 3,
                'id_semestre'  => 3,
                'fecha'        => '2026-01-23',
            ],
            [
                'id_autorizar' => 4,
                'id_alumno'    => 4,
                'id_descuento' => 4,
                'promedio'     => 8.2,
                'id_estado'    => 4,
                'id_periodo'   => 12,
                'id_semestre'  => 4,
                'fecha'        => '2026-02-01',
            ],
            [
                'id_autorizar' => 5,
                'id_alumno'    => 5,
                'id_descuento' => 5,
                'promedio'     => 8.5,
                'id_estado'    => 5,
                'id_periodo'   => 12,
                'id_semestre'  => 5,
                'fecha'        => '2026-02-10',
            ],
            [
                'id_autorizar' => 6,
                'id_alumno'    => 6,
                'id_descuento' => 6,
                'promedio'     => 8.8,
                'id_estado'    => 6,
                'id_periodo'   => 6,
                'id_semestre'  => 6,
                'fecha'        => '2026-02-19',
            ],
            [
                'id_autorizar' => 7,
                'id_alumno'    => 7,
                'id_descuento' => 7,
                'promedio'     => 9.1,
                'id_estado'    => 7,
                'id_periodo'   => 12,
                'id_semestre'  => 7,
                'fecha'        => '2026-02-28',
            ],
            [
                'id_autorizar' => 8,
                'id_alumno'    => 8,
                'id_descuento' => 8,
                'promedio'     => 9.4,
                'id_estado'    => 8,
                'id_periodo'   => 12,
                'id_semestre'  => 8,
                'fecha'        => '2026-03-09',
            ],
            [
                'id_autorizar' => 9,
                'id_alumno'    => 9,
                'id_descuento' => 9,
                'promedio'     => 9.7,
                'id_estado'    => 9,
                'id_periodo'   => 9,
                'id_semestre'  => 9,
                'fecha'        => '2026-03-18',
            ],
            [
                'id_autorizar' => 10,
                'id_alumno'    => 10,
                'id_descuento' => 10,
                'promedio'     => 7.0,
                'id_estado'    => 10,
                'id_periodo'   => 12,
                'id_semestre'  => 10,
                'fecha'        => '2026-03-27',
            ],
            [
                'id_autorizar' => 11,
                'id_alumno'    => 11,
                'id_descuento' => 11,
                'promedio'     => 7.3,
                'id_estado'    => 11,
                'id_periodo'   => 12,
                'id_semestre'  => 11,
                'fecha'        => '2026-04-05',
            ],
            [
                'id_autorizar' => 12,
                'id_alumno'    => 12,
                'id_descuento' => 12,
                'promedio'     => 7.6,
                'id_estado'    => 12,
                'id_periodo'   => 12,
                'id_semestre'  => 12,
                'fecha'        => '2026-04-14',
            ],
            [
                'id_autorizar' => 13,
                'id_alumno'    => 13,
                'id_descuento' => 13,
                'promedio'     => 7.9,
                'id_estado'    => 13,
                'id_periodo'   => 12,
                'id_semestre'  => 1,
                'fecha'        => '2026-04-23',
            ],
            [
                'id_autorizar' => 14,
                'id_alumno'    => 14,
                'id_descuento' => 14,
                'promedio'     => 8.2,
                'id_estado'    => 14,
                'id_periodo'   => 12,
                'id_semestre'  => 2,
                'fecha'        => '2026-05-02',
            ],
            [
                'id_autorizar' => 15,
                'id_alumno'    => 15,
                'id_descuento' => 15,
                'promedio'     => 8.5,
                'id_estado'    => 15,
                'id_periodo'   => 15,
                'id_semestre'  => 3,
                'fecha'        => '2026-05-11',
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
