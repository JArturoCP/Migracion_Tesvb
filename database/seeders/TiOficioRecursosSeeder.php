<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_oficio_recursos`.
 */
class TiOficioRecursosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_oficio_recursos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralAlumnosSeeder::class,
        ]);

        $tabla = 'ti_oficio_recursos';

        $llaves = [
            ['id_oficio_recursos'],
        ];

        $registros = [
            [
                'id_oficio_recursos'     => 1,
                'fecha_oficio_recursos'  => '2026-01-05',
                'numero_oficio_recursos' => 'TESVB-2026-0001',
                'id_alumno'              => 1,
            ],
            [
                'id_oficio_recursos'     => 2,
                'fecha_oficio_recursos'  => '2026-01-14',
                'numero_oficio_recursos' => 'TESVB-2026-0002',
                'id_alumno'              => 2,
            ],
            [
                'id_oficio_recursos'     => 3,
                'fecha_oficio_recursos'  => '2026-01-23',
                'numero_oficio_recursos' => 'TESVB-2026-0003',
                'id_alumno'              => 3,
            ],
            [
                'id_oficio_recursos'     => 4,
                'fecha_oficio_recursos'  => '2026-02-01',
                'numero_oficio_recursos' => 'TESVB-2026-0004',
                'id_alumno'              => 4,
            ],
            [
                'id_oficio_recursos'     => 5,
                'fecha_oficio_recursos'  => '2026-02-10',
                'numero_oficio_recursos' => 'TESVB-2026-0005',
                'id_alumno'              => 5,
            ],
            [
                'id_oficio_recursos'     => 6,
                'fecha_oficio_recursos'  => '2026-02-19',
                'numero_oficio_recursos' => 'TESVB-2026-0006',
                'id_alumno'              => 6,
            ],
            [
                'id_oficio_recursos'     => 7,
                'fecha_oficio_recursos'  => '2026-02-28',
                'numero_oficio_recursos' => 'TESVB-2026-0007',
                'id_alumno'              => 7,
            ],
            [
                'id_oficio_recursos'     => 8,
                'fecha_oficio_recursos'  => '2026-03-09',
                'numero_oficio_recursos' => 'TESVB-2026-0008',
                'id_alumno'              => 8,
            ],
            [
                'id_oficio_recursos'     => 9,
                'fecha_oficio_recursos'  => '2026-03-18',
                'numero_oficio_recursos' => 'TESVB-2026-0009',
                'id_alumno'              => 9,
            ],
            [
                'id_oficio_recursos'     => 10,
                'fecha_oficio_recursos'  => '2026-03-27',
                'numero_oficio_recursos' => 'TESVB-2026-0010',
                'id_alumno'              => 10,
            ],
            [
                'id_oficio_recursos'     => 11,
                'fecha_oficio_recursos'  => '2026-04-05',
                'numero_oficio_recursos' => 'TESVB-2026-0011',
                'id_alumno'              => 11,
            ],
            [
                'id_oficio_recursos'     => 12,
                'fecha_oficio_recursos'  => '2026-04-14',
                'numero_oficio_recursos' => 'TESVB-2026-0012',
                'id_alumno'              => 12,
            ],
            [
                'id_oficio_recursos'     => 13,
                'fecha_oficio_recursos'  => '2026-04-23',
                'numero_oficio_recursos' => 'TESVB-2026-0013',
                'id_alumno'              => 13,
            ],
            [
                'id_oficio_recursos'     => 14,
                'fecha_oficio_recursos'  => '2026-05-02',
                'numero_oficio_recursos' => 'TESVB-2026-0014',
                'id_alumno'              => 14,
            ],
            [
                'id_oficio_recursos'     => 15,
                'fecha_oficio_recursos'  => '2026-05-11',
                'numero_oficio_recursos' => 'TESVB-2026-0015',
                'id_alumno'              => 15,
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
