<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_provedores`.
 */
class RmProvedoresSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_provedores` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'rm_provedores';

        $llaves = [
            ['id'],
            ['nombre'],
        ];

        $registros = [
            [
                'id'         => 1,
                'nombre'     => 'Nombre provedores 1',
                'contacto'   => 'V1',
                'email'      => 'provedores01@example.com',
                'condicion'  => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'nombre'     => 'Nombre provedores 2',
                'contacto'   => 'V2',
                'email'      => 'provedores02@example.com',
                'condicion'  => 1,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'nombre'     => 'Nombre provedores 3',
                'contacto'   => 'V3',
                'email'      => 'provedores03@example.com',
                'condicion'  => 1,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'nombre'     => 'Nombre provedores 4',
                'contacto'   => 'V4',
                'email'      => 'provedores04@example.com',
                'condicion'  => 1,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'nombre'     => 'Nombre provedores 5',
                'contacto'   => 'V5',
                'email'      => 'provedores05@example.com',
                'condicion'  => 1,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'nombre'     => 'Nombre provedores 6',
                'contacto'   => 'V6',
                'email'      => 'provedores06@example.com',
                'condicion'  => 1,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'nombre'     => 'Nombre provedores 7',
                'contacto'   => 'V7',
                'email'      => 'provedores07@example.com',
                'condicion'  => 1,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'nombre'     => 'Nombre provedores 8',
                'contacto'   => 'V8',
                'email'      => 'provedores08@example.com',
                'condicion'  => 1,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'nombre'     => 'Nombre provedores 9',
                'contacto'   => 'V9',
                'email'      => 'provedores09@example.com',
                'condicion'  => 1,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'nombre'     => 'Nombre provedores 10',
                'contacto'   => 'V10',
                'email'      => 'provedores10@example.com',
                'condicion'  => 1,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'nombre'     => 'Nombre provedores 11',
                'contacto'   => 'V11',
                'email'      => 'provedores11@example.com',
                'condicion'  => 1,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'nombre'     => 'Nombre provedores 12',
                'contacto'   => 'V12',
                'email'      => 'provedores12@example.com',
                'condicion'  => 1,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'nombre'     => 'Nombre provedores 13',
                'contacto'   => 'V13',
                'email'      => 'provedores13@example.com',
                'condicion'  => 1,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'nombre'     => 'Nombre provedores 14',
                'contacto'   => 'V14',
                'email'      => 'provedores14@example.com',
                'condicion'  => 1,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'nombre'     => 'Nombre provedores 15',
                'contacto'   => 'V15',
                'email'      => 'provedores15@example.com',
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
