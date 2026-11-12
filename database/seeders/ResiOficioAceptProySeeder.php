<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_oficio_acept_proy`.
 */
class ResiOficioAceptProySeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_oficio_acept_proy` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAsesoresSeeder::class,
        ]);

        $tabla = 'resi_oficio_acept_proy';

        $llaves = [
            ['id_oficio_aceptacion'],
        ];

        $registros = [
            [
                'id_oficio_aceptacion' => 1,
                'numero_oficio'        => 'TESVB-2026-0001',
                'id_asesores'          => 1,
                'fecha_registro'       => '2026-01-05',
                'fecha_m'              => '2026-01-05',
            ],
            [
                'id_oficio_aceptacion' => 2,
                'numero_oficio'        => 'TESVB-2026-0002',
                'id_asesores'          => 2,
                'fecha_registro'       => '2026-01-14',
                'fecha_m'              => '2026-01-14',
            ],
            [
                'id_oficio_aceptacion' => 3,
                'numero_oficio'        => 'TESVB-2026-0003',
                'id_asesores'          => 3,
                'fecha_registro'       => '2026-01-23',
                'fecha_m'              => '2026-01-23',
            ],
            [
                'id_oficio_aceptacion' => 4,
                'numero_oficio'        => 'TESVB-2026-0004',
                'id_asesores'          => 4,
                'fecha_registro'       => '2026-02-01',
                'fecha_m'              => '2026-02-01',
            ],
            [
                'id_oficio_aceptacion' => 5,
                'numero_oficio'        => 'TESVB-2026-0005',
                'id_asesores'          => 5,
                'fecha_registro'       => '2026-02-10',
                'fecha_m'              => '2026-02-10',
            ],
            [
                'id_oficio_aceptacion' => 6,
                'numero_oficio'        => 'TESVB-2026-0006',
                'id_asesores'          => 6,
                'fecha_registro'       => '2026-02-19',
                'fecha_m'              => '2026-02-19',
            ],
            [
                'id_oficio_aceptacion' => 7,
                'numero_oficio'        => 'TESVB-2026-0007',
                'id_asesores'          => 7,
                'fecha_registro'       => '2026-02-28',
                'fecha_m'              => '2026-02-28',
            ],
            [
                'id_oficio_aceptacion' => 8,
                'numero_oficio'        => 'TESVB-2026-0008',
                'id_asesores'          => 8,
                'fecha_registro'       => '2026-03-09',
                'fecha_m'              => '2026-03-09',
            ],
            [
                'id_oficio_aceptacion' => 9,
                'numero_oficio'        => 'TESVB-2026-0009',
                'id_asesores'          => 9,
                'fecha_registro'       => '2026-03-18',
                'fecha_m'              => '2026-03-18',
            ],
            [
                'id_oficio_aceptacion' => 10,
                'numero_oficio'        => 'TESVB-2026-0010',
                'id_asesores'          => 10,
                'fecha_registro'       => '2026-03-27',
                'fecha_m'              => '2026-03-27',
            ],
            [
                'id_oficio_aceptacion' => 11,
                'numero_oficio'        => 'TESVB-2026-0011',
                'id_asesores'          => 11,
                'fecha_registro'       => '2026-04-05',
                'fecha_m'              => '2026-04-05',
            ],
            [
                'id_oficio_aceptacion' => 12,
                'numero_oficio'        => 'TESVB-2026-0012',
                'id_asesores'          => 12,
                'fecha_registro'       => '2026-04-14',
                'fecha_m'              => '2026-04-14',
            ],
            [
                'id_oficio_aceptacion' => 13,
                'numero_oficio'        => 'TESVB-2026-0013',
                'id_asesores'          => 13,
                'fecha_registro'       => '2026-04-23',
                'fecha_m'              => '2026-04-23',
            ],
            [
                'id_oficio_aceptacion' => 14,
                'numero_oficio'        => 'TESVB-2026-0014',
                'id_asesores'          => 14,
                'fecha_registro'       => '2026-05-02',
                'fecha_m'              => '2026-05-02',
            ],
            [
                'id_oficio_aceptacion' => 15,
                'numero_oficio'        => 'TESVB-2026-0015',
                'id_asesores'          => 15,
                'fecha_registro'       => '2026-05-11',
                'fecha_m'              => '2026-05-11',
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
