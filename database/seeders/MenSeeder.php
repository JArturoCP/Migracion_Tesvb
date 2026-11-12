<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `men`.
 */
class MenSeeder extends Seeder
{
    /**
     * Pobla la tabla `men` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'men';

        $llaves = [
            ['id', 'des'],
        ];

        $registros = [
            [
                'id'  => 1,
                'des' => 'Bienvenido(a) al Sistema Integral del TESVB (datos de prueba).',
            ],
            [
                'id'  => 2,
                'des' => 'Recuerda revisar tu carga académica del periodo vigente.',
            ],
            [
                'id'  => 3,
                'des' => 'Mensaje informativo de prueba.',
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
