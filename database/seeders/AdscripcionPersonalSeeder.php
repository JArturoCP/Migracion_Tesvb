<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `adscripcion_personal`.
 */
class AdscripcionPersonalSeeder extends Seeder
{
    /**
     * Pobla la tabla `adscripcion_personal` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralPersonalesSeeder::class,
            GnralUnidadPersonalSeeder::class,
        ]);

        $tabla = 'adscripcion_personal';

        $llaves = [
            ['id_adscripcion'],
        ];

        $registros = [
            [
                'id_adscripcion'    => 1,
                'id_personal'       => 1,
                'id_unidad_persona' => 1,
            ],
            [
                'id_adscripcion'    => 2,
                'id_personal'       => 2,
                'id_unidad_persona' => 2,
            ],
            [
                'id_adscripcion'    => 3,
                'id_personal'       => 3,
                'id_unidad_persona' => 3,
            ],
            [
                'id_adscripcion'    => 4,
                'id_personal'       => 4,
                'id_unidad_persona' => 4,
            ],
            [
                'id_adscripcion'    => 5,
                'id_personal'       => 5,
                'id_unidad_persona' => 5,
            ],
            [
                'id_adscripcion'    => 6,
                'id_personal'       => 6,
                'id_unidad_persona' => 6,
            ],
            [
                'id_adscripcion'    => 7,
                'id_personal'       => 7,
                'id_unidad_persona' => 7,
            ],
            [
                'id_adscripcion'    => 8,
                'id_personal'       => 8,
                'id_unidad_persona' => 8,
            ],
            [
                'id_adscripcion'    => 9,
                'id_personal'       => 9,
                'id_unidad_persona' => 9,
            ],
            [
                'id_adscripcion'    => 10,
                'id_personal'       => 10,
                'id_unidad_persona' => 10,
            ],
            [
                'id_adscripcion'    => 11,
                'id_personal'       => 11,
                'id_unidad_persona' => 11,
            ],
            [
                'id_adscripcion'    => 12,
                'id_personal'       => 12,
                'id_unidad_persona' => 12,
            ],
            [
                'id_adscripcion'    => 13,
                'id_personal'       => 13,
                'id_unidad_persona' => 13,
            ],
            [
                'id_adscripcion'    => 14,
                'id_personal'       => 14,
                'id_unidad_persona' => 14,
            ],
            [
                'id_adscripcion'    => 15,
                'id_personal'       => 15,
                'id_unidad_persona' => 15,
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
