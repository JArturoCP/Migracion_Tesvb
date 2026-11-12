<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inc_dirigido`.
 */
class IncDirigidoSeeder extends Seeder
{
    /**
     * Pobla la tabla `inc_dirigido` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inc_dirigido';

        $llaves = [
            ['id_dirigido'],
        ];

        $registros = [
            [
                'id_dirigido'          => 1,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 1',
            ],
            [
                'id_dirigido'          => 2,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 2',
            ],
            [
                'id_dirigido'          => 3,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 3',
            ],
            [
                'id_dirigido'          => 4,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 4',
            ],
            [
                'id_dirigido'          => 5,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 5',
            ],
            [
                'id_dirigido'          => 6,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 6',
            ],
            [
                'id_dirigido'          => 7,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 7',
            ],
            [
                'id_dirigido'          => 8,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 8',
            ],
            [
                'id_dirigido'          => 9,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 9',
            ],
            [
                'id_dirigido'          => 10,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 10',
            ],
            [
                'id_dirigido'          => 11,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 11',
            ],
            [
                'id_dirigido'          => 12,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 12',
            ],
            [
                'id_dirigido'          => 13,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 13',
            ],
            [
                'id_dirigido'          => 14,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 14',
            ],
            [
                'id_dirigido'          => 15,
                'descripcion_dirigido' => 'Descripcion dirigido dirigido 15',
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
