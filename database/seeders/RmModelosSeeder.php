<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_modelos`.
 */
class RmModelosSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_modelos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_modelos';

        $llaves = [
            ['id'],
            ['modelo'],
        ];

        $registros = [
            [
                'id'         => 1,
                'modelo'     => 'Modelo modelos 1',
                'condicion'  => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'modelo'     => 'Modelo modelos 2',
                'condicion'  => 1,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'modelo'     => 'Modelo modelos 3',
                'condicion'  => 1,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'modelo'     => 'Modelo modelos 4',
                'condicion'  => 1,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'modelo'     => 'Modelo modelos 5',
                'condicion'  => 1,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'modelo'     => 'Modelo modelos 6',
                'condicion'  => 1,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'modelo'     => 'Modelo modelos 7',
                'condicion'  => 1,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'modelo'     => 'Modelo modelos 8',
                'condicion'  => 1,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'modelo'     => 'Modelo modelos 9',
                'condicion'  => 1,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'modelo'     => 'Modelo modelos 10',
                'condicion'  => 1,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'modelo'     => 'Modelo modelos 11',
                'condicion'  => 1,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'modelo'     => 'Modelo modelos 12',
                'condicion'  => 1,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'modelo'     => 'Modelo modelos 13',
                'condicion'  => 1,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'modelo'     => 'Modelo modelos 14',
                'condicion'  => 1,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'modelo'     => 'Modelo modelos 15',
                'condicion'  => 1,
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
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
