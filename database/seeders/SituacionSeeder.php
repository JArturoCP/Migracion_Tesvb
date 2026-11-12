<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `situacion`.
 */
class SituacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `situacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'situacion';

        $llaves = [
            ['id_situacion'],
        ];

        $registros = [
            [
                'id_situacion' => 1,
                'situacion'    => 'Situacion situacion 1',
                'abrevia'      => 'ABR1',
            ],
            [
                'id_situacion' => 2,
                'situacion'    => 'Situacion situacion 2',
                'abrevia'      => 'ABR2',
            ],
            [
                'id_situacion' => 3,
                'situacion'    => 'Situacion situacion 3',
                'abrevia'      => 'ABR3',
            ],
            [
                'id_situacion' => 4,
                'situacion'    => 'Situacion situacion 4',
                'abrevia'      => 'ABR4',
            ],
            [
                'id_situacion' => 5,
                'situacion'    => 'Situacion situacion 5',
                'abrevia'      => 'ABR5',
            ],
            [
                'id_situacion' => 6,
                'situacion'    => 'Situacion situacion 6',
                'abrevia'      => 'ABR6',
            ],
            [
                'id_situacion' => 7,
                'situacion'    => 'Situacion situacion 7',
                'abrevia'      => 'ABR7',
            ],
            [
                'id_situacion' => 8,
                'situacion'    => 'Situacion situacion 8',
                'abrevia'      => 'ABR8',
            ],
            [
                'id_situacion' => 9,
                'situacion'    => 'Situacion situacion 9',
                'abrevia'      => 'ABR9',
            ],
            [
                'id_situacion' => 10,
                'situacion'    => 'Situacion situacion 10',
                'abrevia'      => 'ABR10',
            ],
            [
                'id_situacion' => 11,
                'situacion'    => 'Situacion situacion 11',
                'abrevia'      => 'ABR11',
            ],
            [
                'id_situacion' => 12,
                'situacion'    => 'Situacion situacion 12',
                'abrevia'      => 'ABR12',
            ],
            [
                'id_situacion' => 13,
                'situacion'    => 'Situacion situacion 13',
                'abrevia'      => 'ABR13',
            ],
            [
                'id_situacion' => 14,
                'situacion'    => 'Situacion situacion 14',
                'abrevia'      => 'ABR14',
            ],
            [
                'id_situacion' => 15,
                'situacion'    => 'Situacion situacion 15',
                'abrevia'      => 'ABR15',
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
