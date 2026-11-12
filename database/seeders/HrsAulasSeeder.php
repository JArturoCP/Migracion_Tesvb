<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_aulas`.
 */
class HrsAulasSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_aulas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralCarrerasSeeder::class,
            HrsEdificiosSeeder::class,
        ]);

        $tabla = 'hrs_aulas';

        $llaves = [
            ['id_aula'],
        ];

        $registros = [
            [
                'id_aula'     => 1,
                'id_carrera'  => 1,
                'nombre'      => 'Nombre aulas 1',
                'id_edificio' => 1,
                'comp'        => 1,
                'created_at'  => '2026-01-05 09:00:00',
                'updated_at'  => '2026-01-05 09:00:00',
            ],
            [
                'id_aula'     => 2,
                'id_carrera'  => 2,
                'nombre'      => 'Nombre aulas 2',
                'id_edificio' => 2,
                'comp'        => 2,
                'created_at'  => '2026-01-14 10:00:00',
                'updated_at'  => '2026-01-14 10:00:00',
            ],
            [
                'id_aula'     => 3,
                'id_carrera'  => 3,
                'nombre'      => 'Nombre aulas 3',
                'id_edificio' => 3,
                'comp'        => 3,
                'created_at'  => '2026-01-23 11:00:00',
                'updated_at'  => '2026-01-23 11:00:00',
            ],
            [
                'id_aula'     => 4,
                'id_carrera'  => 4,
                'nombre'      => 'Nombre aulas 4',
                'id_edificio' => 4,
                'comp'        => 4,
                'created_at'  => '2026-02-01 12:00:00',
                'updated_at'  => '2026-02-01 12:00:00',
            ],
            [
                'id_aula'     => 5,
                'id_carrera'  => 5,
                'nombre'      => 'Nombre aulas 5',
                'id_edificio' => 5,
                'comp'        => 5,
                'created_at'  => '2026-02-10 13:00:00',
                'updated_at'  => '2026-02-10 13:00:00',
            ],
            [
                'id_aula'     => 6,
                'id_carrera'  => 6,
                'nombre'      => 'Nombre aulas 6',
                'id_edificio' => 6,
                'comp'        => 6,
                'created_at'  => '2026-02-19 14:00:00',
                'updated_at'  => '2026-02-19 14:00:00',
            ],
            [
                'id_aula'     => 7,
                'id_carrera'  => 7,
                'nombre'      => 'Nombre aulas 7',
                'id_edificio' => 7,
                'comp'        => 7,
                'created_at'  => '2026-02-28 15:00:00',
                'updated_at'  => '2026-02-28 15:00:00',
            ],
            [
                'id_aula'     => 8,
                'id_carrera'  => 1,
                'nombre'      => 'Nombre aulas 8',
                'id_edificio' => 8,
                'comp'        => 8,
                'created_at'  => '2026-03-09 16:00:00',
                'updated_at'  => '2026-03-09 16:00:00',
            ],
            [
                'id_aula'     => 9,
                'id_carrera'  => 2,
                'nombre'      => 'Nombre aulas 9',
                'id_edificio' => 9,
                'comp'        => 9,
                'created_at'  => '2026-03-18 08:00:00',
                'updated_at'  => '2026-03-18 08:00:00',
            ],
            [
                'id_aula'     => 10,
                'id_carrera'  => 3,
                'nombre'      => 'Nombre aulas 10',
                'id_edificio' => 10,
                'comp'        => 10,
                'created_at'  => '2026-03-27 09:00:00',
                'updated_at'  => '2026-03-27 09:00:00',
            ],
            [
                'id_aula'     => 11,
                'id_carrera'  => 4,
                'nombre'      => 'Nombre aulas 11',
                'id_edificio' => 11,
                'comp'        => 11,
                'created_at'  => '2026-04-05 10:00:00',
                'updated_at'  => '2026-04-05 10:00:00',
            ],
            [
                'id_aula'     => 12,
                'id_carrera'  => 5,
                'nombre'      => 'Nombre aulas 12',
                'id_edificio' => 12,
                'comp'        => 12,
                'created_at'  => '2026-04-14 11:00:00',
                'updated_at'  => '2026-04-14 11:00:00',
            ],
            [
                'id_aula'     => 13,
                'id_carrera'  => 6,
                'nombre'      => 'Nombre aulas 13',
                'id_edificio' => 13,
                'comp'        => 13,
                'created_at'  => '2026-04-23 12:00:00',
                'updated_at'  => '2026-04-23 12:00:00',
            ],
            [
                'id_aula'     => 14,
                'id_carrera'  => 7,
                'nombre'      => 'Nombre aulas 14',
                'id_edificio' => 14,
                'comp'        => 14,
                'created_at'  => '2026-05-02 13:00:00',
                'updated_at'  => '2026-05-02 13:00:00',
            ],
            [
                'id_aula'     => 15,
                'id_carrera'  => 1,
                'nombre'      => 'Nombre aulas 15',
                'id_edificio' => 15,
                'comp'        => 15,
                'created_at'  => '2026-05-11 14:00:00',
                'updated_at'  => '2026-05-11 14:00:00',
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
