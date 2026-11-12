<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_proy_empresa`.
 */
class ResiProyEmpresaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_proy_empresa` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
            ResiEmpresaSeeder::class,
            ResiGiroSeeder::class,
            ResiSectorSeeder::class,
        ]);

        $tabla = 'resi_proy_empresa';

        $llaves = [
            ['id_proy_empresa'],
        ];

        $registros = [
            [
                'id_proy_empresa'     => 1,
                'id_empresa'          => 1,
                'id_anteproyecto'     => 1,
                'asesor'              => 'Asesor proy empresa 1',
                'puesto'              => 'Puesto proy empresa 1',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 1.',
                'id_giro'             => 1,
                'id_sector'           => 1,
            ],
            [
                'id_proy_empresa'     => 2,
                'id_empresa'          => 2,
                'id_anteproyecto'     => 2,
                'asesor'              => 'Asesor proy empresa 2',
                'puesto'              => 'Puesto proy empresa 2',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 2.',
                'id_giro'             => 2,
                'id_sector'           => 2,
            ],
            [
                'id_proy_empresa'     => 3,
                'id_empresa'          => 3,
                'id_anteproyecto'     => 3,
                'asesor'              => 'Asesor proy empresa 3',
                'puesto'              => 'Puesto proy empresa 3',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 3.',
                'id_giro'             => 3,
                'id_sector'           => 3,
            ],
            [
                'id_proy_empresa'     => 4,
                'id_empresa'          => 4,
                'id_anteproyecto'     => 4,
                'asesor'              => 'Asesor proy empresa 4',
                'puesto'              => 'Puesto proy empresa 4',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 4.',
                'id_giro'             => 4,
                'id_sector'           => 4,
            ],
            [
                'id_proy_empresa'     => 5,
                'id_empresa'          => 5,
                'id_anteproyecto'     => 5,
                'asesor'              => 'Asesor proy empresa 5',
                'puesto'              => 'Puesto proy empresa 5',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 5.',
                'id_giro'             => 5,
                'id_sector'           => 5,
            ],
            [
                'id_proy_empresa'     => 6,
                'id_empresa'          => 6,
                'id_anteproyecto'     => 6,
                'asesor'              => 'Asesor proy empresa 6',
                'puesto'              => 'Puesto proy empresa 6',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 6.',
                'id_giro'             => 6,
                'id_sector'           => 6,
            ],
            [
                'id_proy_empresa'     => 7,
                'id_empresa'          => 7,
                'id_anteproyecto'     => 7,
                'asesor'              => 'Asesor proy empresa 7',
                'puesto'              => 'Puesto proy empresa 7',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 7.',
                'id_giro'             => 7,
                'id_sector'           => 7,
            ],
            [
                'id_proy_empresa'     => 8,
                'id_empresa'          => 8,
                'id_anteproyecto'     => 8,
                'asesor'              => 'Asesor proy empresa 8',
                'puesto'              => 'Puesto proy empresa 8',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 8.',
                'id_giro'             => 8,
                'id_sector'           => 8,
            ],
            [
                'id_proy_empresa'     => 9,
                'id_empresa'          => 9,
                'id_anteproyecto'     => 9,
                'asesor'              => 'Asesor proy empresa 9',
                'puesto'              => 'Puesto proy empresa 9',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 9.',
                'id_giro'             => 9,
                'id_sector'           => 9,
            ],
            [
                'id_proy_empresa'     => 10,
                'id_empresa'          => 10,
                'id_anteproyecto'     => 10,
                'asesor'              => 'Asesor proy empresa 10',
                'puesto'              => 'Puesto proy empresa 10',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 10.',
                'id_giro'             => 10,
                'id_sector'           => 10,
            ],
            [
                'id_proy_empresa'     => 11,
                'id_empresa'          => 11,
                'id_anteproyecto'     => 11,
                'asesor'              => 'Asesor proy empresa 11',
                'puesto'              => 'Puesto proy empresa 11',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 11.',
                'id_giro'             => 11,
                'id_sector'           => 11,
            ],
            [
                'id_proy_empresa'     => 12,
                'id_empresa'          => 12,
                'id_anteproyecto'     => 12,
                'asesor'              => 'Asesor proy empresa 12',
                'puesto'              => 'Puesto proy empresa 12',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 12.',
                'id_giro'             => 12,
                'id_sector'           => 12,
            ],
            [
                'id_proy_empresa'     => 13,
                'id_empresa'          => 13,
                'id_anteproyecto'     => 13,
                'asesor'              => 'Asesor proy empresa 13',
                'puesto'              => 'Puesto proy empresa 13',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 13.',
                'id_giro'             => 13,
                'id_sector'           => 13,
            ],
            [
                'id_proy_empresa'     => 14,
                'id_empresa'          => 14,
                'id_anteproyecto'     => 14,
                'asesor'              => 'Asesor proy empresa 14',
                'puesto'              => 'Puesto proy empresa 14',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 14.',
                'id_giro'             => 14,
                'id_sector'           => 14,
            ],
            [
                'id_proy_empresa'     => 15,
                'id_empresa'          => 15,
                'id_anteproyecto'     => 15,
                'asesor'              => 'Asesor proy empresa 15',
                'puesto'              => 'Puesto proy empresa 15',
                'informacion_empresa' => 'Informacion empresa de proy empresa: registro de prueba número 15.',
                'id_giro'             => 15,
                'id_sector'           => 15,
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
