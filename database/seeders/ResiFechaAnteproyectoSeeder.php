<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_fecha_anteproyecto`.
 */
class ResiFechaAnteproyectoSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_fecha_anteproyecto` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_fecha_anteproyecto';

        $llaves = [
            ['id_fecha_anteproyecto'],
        ];

        $registros = [
            [
                'id_fecha_anteproyecto' => 1,
                'fecha'                 => '2026-01-05',
                'semana'                => 1,
            ],
            [
                'id_fecha_anteproyecto' => 2,
                'fecha'                 => '2026-01-14',
                'semana'                => 2,
            ],
            [
                'id_fecha_anteproyecto' => 3,
                'fecha'                 => '2026-01-23',
                'semana'                => 3,
            ],
            [
                'id_fecha_anteproyecto' => 4,
                'fecha'                 => '2026-02-01',
                'semana'                => 4,
            ],
            [
                'id_fecha_anteproyecto' => 5,
                'fecha'                 => '2026-02-10',
                'semana'                => 5,
            ],
            [
                'id_fecha_anteproyecto' => 6,
                'fecha'                 => '2026-02-19',
                'semana'                => 6,
            ],
            [
                'id_fecha_anteproyecto' => 7,
                'fecha'                 => '2026-02-28',
                'semana'                => 7,
            ],
            [
                'id_fecha_anteproyecto' => 8,
                'fecha'                 => '2026-03-09',
                'semana'                => 8,
            ],
            [
                'id_fecha_anteproyecto' => 9,
                'fecha'                 => '2026-03-18',
                'semana'                => 9,
            ],
            [
                'id_fecha_anteproyecto' => 10,
                'fecha'                 => '2026-03-27',
                'semana'                => 10,
            ],
            [
                'id_fecha_anteproyecto' => 11,
                'fecha'                 => '2026-04-05',
                'semana'                => 11,
            ],
            [
                'id_fecha_anteproyecto' => 12,
                'fecha'                 => '2026-04-14',
                'semana'                => 12,
            ],
            [
                'id_fecha_anteproyecto' => 13,
                'fecha'                 => '2026-04-23',
                'semana'                => 13,
            ],
            [
                'id_fecha_anteproyecto' => 14,
                'fecha'                 => '2026-05-02',
                'semana'                => 14,
            ],
            [
                'id_fecha_anteproyecto' => 15,
                'fecha'                 => '2026-05-11',
                'semana'                => 15,
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
