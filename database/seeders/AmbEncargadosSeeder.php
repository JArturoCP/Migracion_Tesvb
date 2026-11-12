<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `amb_encargados`.
 */
class AmbEncargadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `amb_encargados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AmbProcedimientosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'amb_encargados';

        $llaves = [
            ['id_encargado'],
        ];

        $registros = [
            [
                'id_encargado'     => 1,
                'id_personal'      => 1,
                'id_procedimiento' => 1,
                'fecha_reg'        => '2026-01-05',
            ],
            [
                'id_encargado'     => 2,
                'id_personal'      => 2,
                'id_procedimiento' => 2,
                'fecha_reg'        => '2026-01-14',
            ],
            [
                'id_encargado'     => 3,
                'id_personal'      => 3,
                'id_procedimiento' => 3,
                'fecha_reg'        => '2026-01-23',
            ],
            [
                'id_encargado'     => 4,
                'id_personal'      => 4,
                'id_procedimiento' => 4,
                'fecha_reg'        => '2026-02-01',
            ],
            [
                'id_encargado'     => 5,
                'id_personal'      => 5,
                'id_procedimiento' => 5,
                'fecha_reg'        => '2026-02-10',
            ],
            [
                'id_encargado'     => 6,
                'id_personal'      => 6,
                'id_procedimiento' => 6,
                'fecha_reg'        => '2026-02-19',
            ],
            [
                'id_encargado'     => 7,
                'id_personal'      => 7,
                'id_procedimiento' => 7,
                'fecha_reg'        => '2026-02-28',
            ],
            [
                'id_encargado'     => 8,
                'id_personal'      => 8,
                'id_procedimiento' => 8,
                'fecha_reg'        => '2026-03-09',
            ],
            [
                'id_encargado'     => 9,
                'id_personal'      => 9,
                'id_procedimiento' => 9,
                'fecha_reg'        => '2026-03-18',
            ],
            [
                'id_encargado'     => 10,
                'id_personal'      => 10,
                'id_procedimiento' => 10,
                'fecha_reg'        => '2026-03-27',
            ],
            [
                'id_encargado'     => 11,
                'id_personal'      => 11,
                'id_procedimiento' => 11,
                'fecha_reg'        => '2026-04-05',
            ],
            [
                'id_encargado'     => 12,
                'id_personal'      => 12,
                'id_procedimiento' => 12,
                'fecha_reg'        => '2026-04-14',
            ],
            [
                'id_encargado'     => 13,
                'id_personal'      => 13,
                'id_procedimiento' => 13,
                'fecha_reg'        => '2026-04-23',
            ],
            [
                'id_encargado'     => 14,
                'id_personal'      => 14,
                'id_procedimiento' => 14,
                'fecha_reg'        => '2026-05-02',
            ],
            [
                'id_encargado'     => 15,
                'id_personal'      => 15,
                'id_procedimiento' => 15,
                'fecha_reg'        => '2026-05-11',
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
