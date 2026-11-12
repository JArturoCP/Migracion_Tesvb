<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_cargos`.
 */
class GnralCargosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_cargos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_cargos';

        $llaves = [
            ['id_cargo'],
        ];

        $registros = [
            [
                'id_cargo'   => 1,
                'cargo'      => 'DIRECTOR GENERAL',
                'abre'       => 'DG',
                'updated_at' => '2026-01-05 09:00:00',
                'created_at' => '2026-01-05 09:00:00',
            ],
            [
                'id_cargo'   => 2,
                'cargo'      => 'JEFE DE DIVISIÓN',
                'abre'       => 'JD',
                'updated_at' => '2026-01-14 10:00:00',
                'created_at' => '2026-01-14 10:00:00',
            ],
            [
                'id_cargo'   => 3,
                'cargo'      => 'DOCENTE',
                'abre'       => 'DOC',
                'updated_at' => '2026-01-23 11:00:00',
                'created_at' => '2026-01-23 11:00:00',
            ],
            [
                'id_cargo'   => 4,
                'cargo'      => 'SUBDIRECTOR ACADÉMICO',
                'abre'       => 'SA',
                'updated_at' => '2026-02-01 12:00:00',
                'created_at' => '2026-02-01 12:00:00',
            ],
            [
                'id_cargo'   => 5,
                'cargo'      => 'COORDINADOR',
                'abre'       => 'COORD',
                'updated_at' => '2026-02-10 13:00:00',
                'created_at' => '2026-02-10 13:00:00',
            ],
            [
                'id_cargo'   => 6,
                'cargo'      => 'DIRECTOR GENERAL',
                'abre'       => 'DG',
                'updated_at' => '2026-02-19 14:00:00',
                'created_at' => '2026-02-19 14:00:00',
            ],
            [
                'id_cargo'   => 7,
                'cargo'      => 'JEFE DE DIVISIÓN',
                'abre'       => 'JD',
                'updated_at' => '2026-02-28 15:00:00',
                'created_at' => '2026-02-28 15:00:00',
            ],
            [
                'id_cargo'   => 8,
                'cargo'      => 'DOCENTE',
                'abre'       => 'DOC',
                'updated_at' => '2026-03-09 16:00:00',
                'created_at' => '2026-03-09 16:00:00',
            ],
            [
                'id_cargo'   => 9,
                'cargo'      => 'SUBDIRECTOR ACADÉMICO',
                'abre'       => 'SA',
                'updated_at' => '2026-03-18 08:00:00',
                'created_at' => '2026-03-18 08:00:00',
            ],
            [
                'id_cargo'   => 10,
                'cargo'      => 'COORDINADOR',
                'abre'       => 'COORD',
                'updated_at' => '2026-03-27 09:00:00',
                'created_at' => '2026-03-27 09:00:00',
            ],
            [
                'id_cargo'   => 11,
                'cargo'      => 'DIRECTOR GENERAL',
                'abre'       => 'DG',
                'updated_at' => '2026-04-05 10:00:00',
                'created_at' => '2026-04-05 10:00:00',
            ],
            [
                'id_cargo'   => 12,
                'cargo'      => 'JEFE DE DIVISIÓN',
                'abre'       => 'JD',
                'updated_at' => '2026-04-14 11:00:00',
                'created_at' => '2026-04-14 11:00:00',
            ],
            [
                'id_cargo'   => 13,
                'cargo'      => 'DOCENTE',
                'abre'       => 'DOC',
                'updated_at' => '2026-04-23 12:00:00',
                'created_at' => '2026-04-23 12:00:00',
            ],
            [
                'id_cargo'   => 14,
                'cargo'      => 'SUBDIRECTOR ACADÉMICO',
                'abre'       => 'SA',
                'updated_at' => '2026-05-02 13:00:00',
                'created_at' => '2026-05-02 13:00:00',
            ],
            [
                'id_cargo'   => 15,
                'cargo'      => 'COORDINADOR',
                'abre'       => 'COORD',
                'updated_at' => '2026-05-11 14:00:00',
                'created_at' => '2026-05-11 14:00:00',
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
