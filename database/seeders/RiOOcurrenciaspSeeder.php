<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ri_o_ocurrenciasp`.
 */
class RiOOcurrenciaspSeeder extends Seeder
{
    /**
     * Pobla la tabla `ri_o_ocurrenciasp` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ri_o_ocurrenciasp';

        $llaves = [
            ['id_ocurrenciap'],
        ];

        $registros = [
            [
                'id_ocurrenciap'   => 1,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 1',
                'calificacion'     => 77,
                'updated_at'       => '2026-01-05 09:00:00',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_ocurrenciap'   => 2,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 2',
                'calificacion'     => 84,
                'updated_at'       => '2026-01-14 10:00:00',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_ocurrenciap'   => 3,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 3',
                'calificacion'     => 91,
                'updated_at'       => '2026-01-23 11:00:00',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_ocurrenciap'   => 4,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 4',
                'calificacion'     => 98,
                'updated_at'       => '2026-02-01 12:00:00',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_ocurrenciap'   => 5,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 5',
                'calificacion'     => 74,
                'updated_at'       => '2026-02-10 13:00:00',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_ocurrenciap'   => 6,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 6',
                'calificacion'     => 81,
                'updated_at'       => '2026-02-19 14:00:00',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_ocurrenciap'   => 7,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 7',
                'calificacion'     => 88,
                'updated_at'       => '2026-02-28 15:00:00',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_ocurrenciap'   => 8,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 8',
                'calificacion'     => 95,
                'updated_at'       => '2026-03-09 16:00:00',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_ocurrenciap'   => 9,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 9',
                'calificacion'     => 71,
                'updated_at'       => '2026-03-18 08:00:00',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_ocurrenciap'   => 10,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 10',
                'calificacion'     => 78,
                'updated_at'       => '2026-03-27 09:00:00',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_ocurrenciap'   => 11,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 11',
                'calificacion'     => 85,
                'updated_at'       => '2026-04-05 10:00:00',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_ocurrenciap'   => 12,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 12',
                'calificacion'     => 92,
                'updated_at'       => '2026-04-14 11:00:00',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_ocurrenciap'   => 13,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 13',
                'calificacion'     => 99,
                'updated_at'       => '2026-04-23 12:00:00',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_ocurrenciap'   => 14,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 14',
                'calificacion'     => 75,
                'updated_at'       => '2026-05-02 13:00:00',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_ocurrenciap'   => 15,
                'des_ocurrenciasp' => 'Des ocurrenciasp o ocurrenciasp 15',
                'calificacion'     => 82,
                'updated_at'       => '2026-05-11 14:00:00',
                'created_at'       => '2026-05-11 14:00:00',
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
