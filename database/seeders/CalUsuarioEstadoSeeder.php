<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `cal_usuario_estado`.
 */
class CalUsuarioEstadoSeeder extends Seeder
{
    /**
     * Pobla la tabla `cal_usuario_estado` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            EvaValidacionCargaSeeder::class,
        ]);

        $tabla = 'cal_usuario_estado';

        $llaves = [
            ['id_usuario_estado'],
        ];

        $registros = [
            [
                'id_usuario_estado'   => 1,
                'id_usuario'          => 1,
                'fecha'               => '2026-01-05',
                'id_validacion_carga' => 1,
                'estado'              => 'Estado usuario estado 1',
                'id_estado'           => 1,
            ],
            [
                'id_usuario_estado'   => 2,
                'id_usuario'          => 2,
                'fecha'               => '2026-01-14',
                'id_validacion_carga' => 2,
                'estado'              => 'Estado usuario estado 2',
                'id_estado'           => 2,
            ],
            [
                'id_usuario_estado'   => 3,
                'id_usuario'          => 3,
                'fecha'               => '2026-01-23',
                'id_validacion_carga' => 3,
                'estado'              => 'Estado usuario estado 3',
                'id_estado'           => 3,
            ],
            [
                'id_usuario_estado'   => 4,
                'id_usuario'          => 4,
                'fecha'               => '2026-02-01',
                'id_validacion_carga' => 4,
                'estado'              => 'Estado usuario estado 4',
                'id_estado'           => 4,
            ],
            [
                'id_usuario_estado'   => 5,
                'id_usuario'          => 5,
                'fecha'               => '2026-02-10',
                'id_validacion_carga' => 5,
                'estado'              => 'Estado usuario estado 5',
                'id_estado'           => 5,
            ],
            [
                'id_usuario_estado'   => 6,
                'id_usuario'          => 6,
                'fecha'               => '2026-02-19',
                'id_validacion_carga' => 6,
                'estado'              => 'Estado usuario estado 6',
                'id_estado'           => 6,
            ],
            [
                'id_usuario_estado'   => 7,
                'id_usuario'          => 7,
                'fecha'               => '2026-02-28',
                'id_validacion_carga' => 7,
                'estado'              => 'Estado usuario estado 7',
                'id_estado'           => 7,
            ],
            [
                'id_usuario_estado'   => 8,
                'id_usuario'          => 8,
                'fecha'               => '2026-03-09',
                'id_validacion_carga' => 8,
                'estado'              => 'Estado usuario estado 8',
                'id_estado'           => 8,
            ],
            [
                'id_usuario_estado'   => 9,
                'id_usuario'          => 9,
                'fecha'               => '2026-03-18',
                'id_validacion_carga' => 9,
                'estado'              => 'Estado usuario estado 9',
                'id_estado'           => 9,
            ],
            [
                'id_usuario_estado'   => 10,
                'id_usuario'          => 10,
                'fecha'               => '2026-03-27',
                'id_validacion_carga' => 10,
                'estado'              => 'Estado usuario estado 10',
                'id_estado'           => 10,
            ],
            [
                'id_usuario_estado'   => 11,
                'id_usuario'          => 11,
                'fecha'               => '2026-04-05',
                'id_validacion_carga' => 11,
                'estado'              => 'Estado usuario estado 11',
                'id_estado'           => 11,
            ],
            [
                'id_usuario_estado'   => 12,
                'id_usuario'          => 12,
                'fecha'               => '2026-04-14',
                'id_validacion_carga' => 12,
                'estado'              => 'Estado usuario estado 12',
                'id_estado'           => 12,
            ],
            [
                'id_usuario_estado'   => 13,
                'id_usuario'          => 13,
                'fecha'               => '2026-04-23',
                'id_validacion_carga' => 13,
                'estado'              => 'Estado usuario estado 13',
                'id_estado'           => 13,
            ],
            [
                'id_usuario_estado'   => 14,
                'id_usuario'          => 14,
                'fecha'               => '2026-05-02',
                'id_validacion_carga' => 14,
                'estado'              => 'Estado usuario estado 14',
                'id_estado'           => 14,
            ],
            [
                'id_usuario_estado'   => 15,
                'id_usuario'          => 15,
                'fecha'               => '2026-05-11',
                'id_validacion_carga' => 15,
                'estado'              => 'Estado usuario estado 15',
                'id_estado'           => 15,
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
