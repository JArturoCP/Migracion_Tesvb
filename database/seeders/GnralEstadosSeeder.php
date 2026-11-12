<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_estados`.
 */
class GnralEstadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_estados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_estados';

        $llaves = [
            ['id_estado'],
        ];

        $registros = [
            [
                'id_estado'     => 1,
                'nombre_estado' => 'MÉXICO',
            ],
            [
                'id_estado'     => 2,
                'nombre_estado' => 'MICHOACÁN',
            ],
            [
                'id_estado'     => 3,
                'nombre_estado' => 'QUERÉTARO',
            ],
            [
                'id_estado'     => 4,
                'nombre_estado' => 'GUERRERO',
            ],
            [
                'id_estado'     => 5,
                'nombre_estado' => 'MORELOS',
            ],
            [
                'id_estado'     => 6,
                'nombre_estado' => 'HIDALGO',
            ],
            [
                'id_estado'     => 7,
                'nombre_estado' => 'PUEBLA',
            ],
            [
                'id_estado'     => 8,
                'nombre_estado' => 'TLAXCALA',
            ],
            [
                'id_estado'     => 9,
                'nombre_estado' => 'JALISCO',
            ],
            [
                'id_estado'     => 10,
                'nombre_estado' => 'GUANAJUATO',
            ],
            [
                'id_estado'     => 11,
                'nombre_estado' => 'CIUDAD DE MÉXICO',
            ],
            [
                'id_estado'     => 12,
                'nombre_estado' => 'OAXACA',
            ],
            [
                'id_estado'     => 13,
                'nombre_estado' => 'VERACRUZ',
            ],
            [
                'id_estado'     => 14,
                'nombre_estado' => 'SAN LUIS POTOSÍ',
            ],
            [
                'id_estado'     => 15,
                'nombre_estado' => 'AGUASCALIENTES',
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
