<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pres_presupuesto_anteproyecto`.
 */
class PresPresupuestoAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `pres_presupuesto_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            PresProyectosSeeder::class,
        ]);

        $tabla = 'pres_presupuesto_anteproyecto';

        $llaves = [
            ['id_presupuesto'],
        ];

        $registros = [
            [
                'id_presupuesto' => 1,
                'id_proyecto'    => 1,
                'year'           => 2026,
                'fecha_registro' => '2026-01-05',
                'fecha_mod'      => '2026-01-05',
            ],
            [
                'id_presupuesto' => 2,
                'id_proyecto'    => 2,
                'year'           => 2026,
                'fecha_registro' => '2026-01-14',
                'fecha_mod'      => '2026-01-14',
            ],
            [
                'id_presupuesto' => 3,
                'id_proyecto'    => 3,
                'year'           => 2026,
                'fecha_registro' => '2026-01-23',
                'fecha_mod'      => '2026-01-23',
            ],
            [
                'id_presupuesto' => 4,
                'id_proyecto'    => 4,
                'year'           => 2026,
                'fecha_registro' => '2026-02-01',
                'fecha_mod'      => '2026-02-01',
            ],
            [
                'id_presupuesto' => 5,
                'id_proyecto'    => 5,
                'year'           => 2026,
                'fecha_registro' => '2026-02-10',
                'fecha_mod'      => '2026-02-10',
            ],
            [
                'id_presupuesto' => 6,
                'id_proyecto'    => 6,
                'year'           => 2026,
                'fecha_registro' => '2026-02-19',
                'fecha_mod'      => '2026-02-19',
            ],
            [
                'id_presupuesto' => 7,
                'id_proyecto'    => 7,
                'year'           => 2026,
                'fecha_registro' => '2026-02-28',
                'fecha_mod'      => '2026-02-28',
            ],
            [
                'id_presupuesto' => 8,
                'id_proyecto'    => 8,
                'year'           => 2026,
                'fecha_registro' => '2026-03-09',
                'fecha_mod'      => '2026-03-09',
            ],
            [
                'id_presupuesto' => 9,
                'id_proyecto'    => 9,
                'year'           => 2026,
                'fecha_registro' => '2026-03-18',
                'fecha_mod'      => '2026-03-18',
            ],
            [
                'id_presupuesto' => 10,
                'id_proyecto'    => 10,
                'year'           => 2026,
                'fecha_registro' => '2026-03-27',
                'fecha_mod'      => '2026-03-27',
            ],
            [
                'id_presupuesto' => 11,
                'id_proyecto'    => 11,
                'year'           => 2026,
                'fecha_registro' => '2026-04-05',
                'fecha_mod'      => '2026-04-05',
            ],
            [
                'id_presupuesto' => 12,
                'id_proyecto'    => 12,
                'year'           => 2026,
                'fecha_registro' => '2026-04-14',
                'fecha_mod'      => '2026-04-14',
            ],
            [
                'id_presupuesto' => 13,
                'id_proyecto'    => 13,
                'year'           => 2026,
                'fecha_registro' => '2026-04-23',
                'fecha_mod'      => '2026-04-23',
            ],
            [
                'id_presupuesto' => 14,
                'id_proyecto'    => 14,
                'year'           => 2026,
                'fecha_registro' => '2026-05-02',
                'fecha_mod'      => '2026-05-02',
            ],
            [
                'id_presupuesto' => 15,
                'id_proyecto'    => 15,
                'year'           => 2026,
                'fecha_registro' => '2026-05-11',
                'fecha_mod'      => '2026-05-11',
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
