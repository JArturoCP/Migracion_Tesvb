<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_proyectosvinculacion`.
 */
class InvProyectosvinculacionSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_proyectosvinculacion` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_proyectosvinculacion';

        $llaves = [
            ['id_proyectov'],
        ];

        $registros = [
            [
                'id_proyectov'      => 1,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 1',
                'convenio'          => 'Convenio proyectosvinculacion 1',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 1.',
                'created_at'        => '2026-01-05 09:00:00',
                'updated_at'        => '2026-01-05 09:00:00',
            ],
            [
                'id_proyectov'      => 2,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 2',
                'convenio'          => 'Convenio proyectosvinculacion 2',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 2.',
                'created_at'        => '2026-01-14 10:00:00',
                'updated_at'        => '2026-01-14 10:00:00',
            ],
            [
                'id_proyectov'      => 3,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 3',
                'convenio'          => 'Convenio proyectosvinculacion 3',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 3.',
                'created_at'        => '2026-01-23 11:00:00',
                'updated_at'        => '2026-01-23 11:00:00',
            ],
            [
                'id_proyectov'      => 4,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 4',
                'convenio'          => 'Convenio proyectosvinculacion 4',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 4.',
                'created_at'        => '2026-02-01 12:00:00',
                'updated_at'        => '2026-02-01 12:00:00',
            ],
            [
                'id_proyectov'      => 5,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 5',
                'convenio'          => 'Convenio proyectosvinculacion 5',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 5.',
                'created_at'        => '2026-02-10 13:00:00',
                'updated_at'        => '2026-02-10 13:00:00',
            ],
            [
                'id_proyectov'      => 6,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 6',
                'convenio'          => 'Convenio proyectosvinculacion 6',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 6.',
                'created_at'        => '2026-02-19 14:00:00',
                'updated_at'        => '2026-02-19 14:00:00',
            ],
            [
                'id_proyectov'      => 7,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 7',
                'convenio'          => 'Convenio proyectosvinculacion 7',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 7.',
                'created_at'        => '2026-02-28 15:00:00',
                'updated_at'        => '2026-02-28 15:00:00',
            ],
            [
                'id_proyectov'      => 8,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 8',
                'convenio'          => 'Convenio proyectosvinculacion 8',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 8.',
                'created_at'        => '2026-03-09 16:00:00',
                'updated_at'        => '2026-03-09 16:00:00',
            ],
            [
                'id_proyectov'      => 9,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 9',
                'convenio'          => 'Convenio proyectosvinculacion 9',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 9.',
                'created_at'        => '2026-03-18 08:00:00',
                'updated_at'        => '2026-03-18 08:00:00',
            ],
            [
                'id_proyectov'      => 10,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 10',
                'convenio'          => 'Convenio proyectosvinculacion 10',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 10.',
                'created_at'        => '2026-03-27 09:00:00',
                'updated_at'        => '2026-03-27 09:00:00',
            ],
            [
                'id_proyectov'      => 11,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 11',
                'convenio'          => 'Convenio proyectosvinculacion 11',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 11.',
                'created_at'        => '2026-04-05 10:00:00',
                'updated_at'        => '2026-04-05 10:00:00',
            ],
            [
                'id_proyectov'      => 12,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 12',
                'convenio'          => 'Convenio proyectosvinculacion 12',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 12.',
                'created_at'        => '2026-04-14 11:00:00',
                'updated_at'        => '2026-04-14 11:00:00',
            ],
            [
                'id_proyectov'      => 13,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 13',
                'convenio'          => 'Convenio proyectosvinculacion 13',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 13.',
                'created_at'        => '2026-04-23 12:00:00',
                'updated_at'        => '2026-04-23 12:00:00',
            ],
            [
                'id_proyectov'      => 14,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 14',
                'convenio'          => 'Convenio proyectosvinculacion 14',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 14.',
                'created_at'        => '2026-05-02 13:00:00',
                'updated_at'        => '2026-05-02 13:00:00',
            ],
            [
                'id_proyectov'      => 15,
                'desc_institucion'  => 'Desc institucion proyectosvinculacion 15',
                'convenio'          => 'Convenio proyectosvinculacion 15',
                'terminos_convenio' => 'Terminos convenio de proyectosvinculacion: registro de prueba número 15.',
                'created_at'        => '2026-05-11 14:00:00',
                'updated_at'        => '2026-05-11 14:00:00',
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
