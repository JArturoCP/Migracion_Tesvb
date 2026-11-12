<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_carreras`.
 */
class GnralCarrerasSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_carreras` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_carreras';

        $llaves = [
            ['id_carrera'],
        ];

        $registros = [
            [
                'id_carrera'     => 1,
                'nombre'         => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
                'siglas'         => 'ISC',
                'COLOR'          => '#1565C0',
                'codigo_carrera' => 'ISIC-2010-224',
                'updated_at'     => '2026-01-05 09:00:00',
                'created_at'     => '2026-01-05 09:00:00',
            ],
            [
                'id_carrera'     => 2,
                'nombre'         => 'INGENIERÍA INDUSTRIAL',
                'siglas'         => 'IIND',
                'COLOR'          => '#2E7D32',
                'codigo_carrera' => 'IIND-2010-227',
                'updated_at'     => '2026-01-14 10:00:00',
                'created_at'     => '2026-01-14 10:00:00',
            ],
            [
                'id_carrera'     => 3,
                'nombre'         => 'INGENIERÍA CIVIL',
                'siglas'         => 'IC',
                'COLOR'          => '#F9A825',
                'codigo_carrera' => 'ICIV-2010-208',
                'updated_at'     => '2026-01-23 11:00:00',
                'created_at'     => '2026-01-23 11:00:00',
            ],
            [
                'id_carrera'     => 4,
                'nombre'         => 'INGENIERÍA EN GESTIÓN EMPRESARIAL',
                'siglas'         => 'IGE',
                'COLOR'          => '#C62828',
                'codigo_carrera' => 'IGEM-2009-201',
                'updated_at'     => '2026-02-01 12:00:00',
                'created_at'     => '2026-02-01 12:00:00',
            ],
            [
                'id_carrera'     => 5,
                'nombre'         => 'LICENCIATURA EN GASTRONOMÍA',
                'siglas'         => 'LG',
                'COLOR'          => '#6A1B9A',
                'codigo_carrera' => 'LGAS-2010-213',
                'updated_at'     => '2026-02-10 13:00:00',
                'created_at'     => '2026-02-10 13:00:00',
            ],
            [
                'id_carrera'     => 6,
                'nombre'         => 'INGENIERÍA ELECTRÓNICA',
                'siglas'         => 'IE',
                'COLOR'          => '#00838F',
                'codigo_carrera' => 'IELC-2010-211',
                'updated_at'     => '2026-02-19 14:00:00',
                'created_at'     => '2026-02-19 14:00:00',
            ],
            [
                'id_carrera'     => 7,
                'nombre'         => 'LICENCIATURA EN TURISMO',
                'siglas'         => 'LT',
                'COLOR'          => '#EF6C00',
                'codigo_carrera' => 'LTUR-2010-219',
                'updated_at'     => '2026-02-28 15:00:00',
                'created_at'     => '2026-02-28 15:00:00',
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
