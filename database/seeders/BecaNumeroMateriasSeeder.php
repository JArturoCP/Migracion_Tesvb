<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `beca_numero_materias`.
 */
class BecaNumeroMateriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `beca_numero_materias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            GnralPeriodosSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'beca_numero_materias';

        $llaves = [
            ['id_numero_materias'],
        ];

        $registros = [
            [
                'id_numero_materias' => 1,
                'id_semestre'        => 1,
                'id_carrera'         => 1,
                'id_periodo'         => 12,
                'numero_materias'    => 1,
            ],
            [
                'id_numero_materias' => 2,
                'id_semestre'        => 2,
                'id_carrera'         => 2,
                'id_periodo'         => 12,
                'numero_materias'    => 2,
            ],
            [
                'id_numero_materias' => 3,
                'id_semestre'        => 3,
                'id_carrera'         => 3,
                'id_periodo'         => 3,
                'numero_materias'    => 3,
            ],
            [
                'id_numero_materias' => 4,
                'id_semestre'        => 4,
                'id_carrera'         => 4,
                'id_periodo'         => 12,
                'numero_materias'    => 4,
            ],
            [
                'id_numero_materias' => 5,
                'id_semestre'        => 5,
                'id_carrera'         => 5,
                'id_periodo'         => 12,
                'numero_materias'    => 5,
            ],
            [
                'id_numero_materias' => 6,
                'id_semestre'        => 6,
                'id_carrera'         => 6,
                'id_periodo'         => 6,
                'numero_materias'    => 6,
            ],
            [
                'id_numero_materias' => 7,
                'id_semestre'        => 7,
                'id_carrera'         => 7,
                'id_periodo'         => 12,
                'numero_materias'    => 7,
            ],
            [
                'id_numero_materias' => 8,
                'id_semestre'        => 8,
                'id_carrera'         => 1,
                'id_periodo'         => 12,
                'numero_materias'    => 8,
            ],
            [
                'id_numero_materias' => 9,
                'id_semestre'        => 9,
                'id_carrera'         => 2,
                'id_periodo'         => 9,
                'numero_materias'    => 9,
            ],
            [
                'id_numero_materias' => 10,
                'id_semestre'        => 10,
                'id_carrera'         => 3,
                'id_periodo'         => 12,
                'numero_materias'    => 10,
            ],
            [
                'id_numero_materias' => 11,
                'id_semestre'        => 11,
                'id_carrera'         => 4,
                'id_periodo'         => 12,
                'numero_materias'    => 11,
            ],
            [
                'id_numero_materias' => 12,
                'id_semestre'        => 12,
                'id_carrera'         => 5,
                'id_periodo'         => 12,
                'numero_materias'    => 12,
            ],
            [
                'id_numero_materias' => 13,
                'id_semestre'        => 1,
                'id_carrera'         => 6,
                'id_periodo'         => 12,
                'numero_materias'    => 13,
            ],
            [
                'id_numero_materias' => 14,
                'id_semestre'        => 2,
                'id_carrera'         => 7,
                'id_periodo'         => 12,
                'numero_materias'    => 14,
            ],
            [
                'id_numero_materias' => 15,
                'id_semestre'        => 3,
                'id_carrera'         => 1,
                'id_periodo'         => 15,
                'numero_materias'    => 15,
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
