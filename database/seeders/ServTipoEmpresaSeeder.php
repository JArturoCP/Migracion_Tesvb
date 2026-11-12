<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `serv_tipo_empresa`.
 */
class ServTipoEmpresaSeeder extends Seeder
{
    /**
     * Pobla la tabla `serv_tipo_empresa` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'serv_tipo_empresa';

        $llaves = [
            ['id_tipo_empresa'],
        ];

        $registros = [
            [
                'id_tipo_empresa' => 1,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 1',
            ],
            [
                'id_tipo_empresa' => 2,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 2',
            ],
            [
                'id_tipo_empresa' => 3,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 3',
            ],
            [
                'id_tipo_empresa' => 4,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 4',
            ],
            [
                'id_tipo_empresa' => 5,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 5',
            ],
            [
                'id_tipo_empresa' => 6,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 6',
            ],
            [
                'id_tipo_empresa' => 7,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 7',
            ],
            [
                'id_tipo_empresa' => 8,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 8',
            ],
            [
                'id_tipo_empresa' => 9,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 9',
            ],
            [
                'id_tipo_empresa' => 10,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 10',
            ],
            [
                'id_tipo_empresa' => 11,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 11',
            ],
            [
                'id_tipo_empresa' => 12,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 12',
            ],
            [
                'id_tipo_empresa' => 13,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 13',
            ],
            [
                'id_tipo_empresa' => 14,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 14',
            ],
            [
                'id_tipo_empresa' => 15,
                'tipo_empresa'    => 'Tipo empresa tipo empresa 15',
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
