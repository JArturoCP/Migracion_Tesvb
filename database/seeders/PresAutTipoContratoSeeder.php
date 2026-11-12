<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_aut_tipo_contrato`.
 */
class PresAutTipoContratoSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_aut_tipo_contrato` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'pres_aut_tipo_contrato';

        $llaves = [
            ['id_tipo_contrato'],
        ];

        $registros = [
            [
                'id_tipo_contrato' => 1,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 1',
            ],
            [
                'id_tipo_contrato' => 2,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 2',
            ],
            [
                'id_tipo_contrato' => 3,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 3',
            ],
            [
                'id_tipo_contrato' => 4,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 4',
            ],
            [
                'id_tipo_contrato' => 5,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 5',
            ],
            [
                'id_tipo_contrato' => 6,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 6',
            ],
            [
                'id_tipo_contrato' => 7,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 7',
            ],
            [
                'id_tipo_contrato' => 8,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 8',
            ],
            [
                'id_tipo_contrato' => 9,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 9',
            ],
            [
                'id_tipo_contrato' => 10,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 10',
            ],
            [
                'id_tipo_contrato' => 11,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 11',
            ],
            [
                'id_tipo_contrato' => 12,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 12',
            ],
            [
                'id_tipo_contrato' => 13,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 13',
            ],
            [
                'id_tipo_contrato' => 14,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 14',
            ],
            [
                'id_tipo_contrato' => 15,
                'tipo_contrato'    => 'Tipo contrato aut tipo contrato 15',
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
