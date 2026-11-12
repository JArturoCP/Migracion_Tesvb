<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_semestres`.
 */
class GnralSemestresSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_semestres` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_semestres';

        $llaves = [
            ['id_semestre'],
        ];

        $registros = [
            [
                'id_semestre' => 1,
                'descripcion' => 'PRIMERO',
            ],
            [
                'id_semestre' => 2,
                'descripcion' => 'SEGUNDO',
            ],
            [
                'id_semestre' => 3,
                'descripcion' => 'TERCERO',
            ],
            [
                'id_semestre' => 4,
                'descripcion' => 'CUARTO',
            ],
            [
                'id_semestre' => 5,
                'descripcion' => 'QUINTO',
            ],
            [
                'id_semestre' => 6,
                'descripcion' => 'SEXTO',
            ],
            [
                'id_semestre' => 7,
                'descripcion' => 'SÉPTIMO',
            ],
            [
                'id_semestre' => 8,
                'descripcion' => 'OCTAVO',
            ],
            [
                'id_semestre' => 9,
                'descripcion' => 'NOVENO',
            ],
            [
                'id_semestre' => 10,
                'descripcion' => 'DÉCIMO',
            ],
            [
                'id_semestre' => 11,
                'descripcion' => 'UNDÉCIMO',
            ],
            [
                'id_semestre' => 12,
                'descripcion' => 'DUODÉCIMO',
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
