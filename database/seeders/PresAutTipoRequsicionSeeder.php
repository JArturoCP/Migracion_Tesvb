<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_tipo_requsicion`.
 */
class PresAutTipoRequsicionSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_tipo_requsicion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_aut_tipo_requsicion';

        $llaves = [
            ['id_tipo_requicion'],
        ];

        $registros = [
            [
                'id_tipo_requicion' => 1,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 1',
            ],
            [
                'id_tipo_requicion' => 2,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 2',
            ],
            [
                'id_tipo_requicion' => 3,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 3',
            ],
            [
                'id_tipo_requicion' => 4,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 4',
            ],
            [
                'id_tipo_requicion' => 5,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 5',
            ],
            [
                'id_tipo_requicion' => 6,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 6',
            ],
            [
                'id_tipo_requicion' => 7,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 7',
            ],
            [
                'id_tipo_requicion' => 8,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 8',
            ],
            [
                'id_tipo_requicion' => 9,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 9',
            ],
            [
                'id_tipo_requicion' => 10,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 10',
            ],
            [
                'id_tipo_requicion' => 11,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 11',
            ],
            [
                'id_tipo_requicion' => 12,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 12',
            ],
            [
                'id_tipo_requicion' => 13,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 13',
            ],
            [
                'id_tipo_requicion' => 14,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 14',
            ],
            [
                'id_tipo_requicion' => 15,
                'tipo_requisicion'  => 'Tipo requisicion aut tipo requsicion 15',
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
