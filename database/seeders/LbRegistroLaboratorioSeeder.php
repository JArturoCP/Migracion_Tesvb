<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `lb_registro_laboratorio`.
 */
class LbRegistroLaboratorioSeeder extends Seeder
{
    /**
     * Pobla la tabla `lb_registro_laboratorio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            HrsSemanasSeeder::class,
            LbLaboratoriosSeeder::class,
        ]);

        $tabla = 'lb_registro_laboratorio';

        $llaves = [
            ['id_reg_laboratorio'],
        ];

        $registros = [
            [
                'id_reg_laboratorio'   => 1,
                'id_usuario'           => 'Id usuario registro laboratorio 1',
                'id_semana'            => 1,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 1.',
                'id_laboratorio'       => 1,
                'fecha_registro'       => '2026-01-05',
            ],
            [
                'id_reg_laboratorio'   => 2,
                'id_usuario'           => 'Id usuario registro laboratorio 2',
                'id_semana'            => 2,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 2.',
                'id_laboratorio'       => 2,
                'fecha_registro'       => '2026-01-14',
            ],
            [
                'id_reg_laboratorio'   => 3,
                'id_usuario'           => 'Id usuario registro laboratorio 3',
                'id_semana'            => 3,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 3.',
                'id_laboratorio'       => 3,
                'fecha_registro'       => '2026-01-23',
            ],
            [
                'id_reg_laboratorio'   => 4,
                'id_usuario'           => 'Id usuario registro laboratorio 4',
                'id_semana'            => 4,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 4.',
                'id_laboratorio'       => 4,
                'fecha_registro'       => '2026-02-01',
            ],
            [
                'id_reg_laboratorio'   => 5,
                'id_usuario'           => 'Id usuario registro laboratorio 5',
                'id_semana'            => 5,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 5.',
                'id_laboratorio'       => 5,
                'fecha_registro'       => '2026-02-10',
            ],
            [
                'id_reg_laboratorio'   => 6,
                'id_usuario'           => 'Id usuario registro laboratorio 6',
                'id_semana'            => 6,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 6.',
                'id_laboratorio'       => 6,
                'fecha_registro'       => '2026-02-19',
            ],
            [
                'id_reg_laboratorio'   => 7,
                'id_usuario'           => 'Id usuario registro laboratorio 7',
                'id_semana'            => 7,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 7.',
                'id_laboratorio'       => 7,
                'fecha_registro'       => '2026-02-28',
            ],
            [
                'id_reg_laboratorio'   => 8,
                'id_usuario'           => 'Id usuario registro laboratorio 8',
                'id_semana'            => 8,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 8.',
                'id_laboratorio'       => 8,
                'fecha_registro'       => '2026-03-09',
            ],
            [
                'id_reg_laboratorio'   => 9,
                'id_usuario'           => 'Id usuario registro laboratorio 9',
                'id_semana'            => 9,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 9.',
                'id_laboratorio'       => 9,
                'fecha_registro'       => '2026-03-18',
            ],
            [
                'id_reg_laboratorio'   => 10,
                'id_usuario'           => 'Id usuario registro laboratorio 10',
                'id_semana'            => 10,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 10.',
                'id_laboratorio'       => 10,
                'fecha_registro'       => '2026-03-27',
            ],
            [
                'id_reg_laboratorio'   => 11,
                'id_usuario'           => 'Id usuario registro laboratorio 11',
                'id_semana'            => 11,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 11.',
                'id_laboratorio'       => 11,
                'fecha_registro'       => '2026-04-05',
            ],
            [
                'id_reg_laboratorio'   => 12,
                'id_usuario'           => 'Id usuario registro laboratorio 12',
                'id_semana'            => 12,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 12.',
                'id_laboratorio'       => 12,
                'fecha_registro'       => '2026-04-14',
            ],
            [
                'id_reg_laboratorio'   => 13,
                'id_usuario'           => 'Id usuario registro laboratorio 13',
                'id_semana'            => 13,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 13.',
                'id_laboratorio'       => 13,
                'fecha_registro'       => '2026-04-23',
            ],
            [
                'id_reg_laboratorio'   => 14,
                'id_usuario'           => 'Id usuario registro laboratorio 14',
                'id_semana'            => 14,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 14.',
                'id_laboratorio'       => 14,
                'fecha_registro'       => '2026-05-02',
            ],
            [
                'id_reg_laboratorio'   => 15,
                'id_usuario'           => 'Id usuario registro laboratorio 15',
                'id_semana'            => 15,
                'descripcion_utilizar' => 'Descripcion utilizar de registro laboratorio: registro de prueba número 15.',
                'id_laboratorio'       => 15,
                'fecha_registro'       => '2026-05-11',
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
