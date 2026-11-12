<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `tu_eva_fo40`.
 */
class TuEvaFo40Seeder extends Seeder
{
    /**
     * Pobla la tabla `tu_eva_fo40` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ExpAsignaCoordinadorSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'tu_eva_fo40';

        $llaves = [
            ['id_fo40'],
        ];

        $registros = [
            [
                'id_fo40'               => 1,
                'periodo'               => 1,
                'id_personal'           => 1,
                'id_asigna_coordinador' => 1,
                'se1'                   => 1,
                'se2'                   => 1,
                'com'                   => 'Com eva fo40 1',
                'com2'                  => 'Com2 eva fo40 1',
                'fecha_registro'        => '2026-01-05 09:00:00',
                'fecha_registro2'       => '2026-01-05 09:00:00',
                'res1'                  => 'Res1 eva fo40 1',
                'res2'                  => 'Res2 eva fo40 1',
                'con'                   => 1,
            ],
            [
                'id_fo40'               => 2,
                'periodo'               => 2,
                'id_personal'           => 2,
                'id_asigna_coordinador' => 2,
                'se1'                   => 2,
                'se2'                   => 2,
                'com'                   => 'Com eva fo40 2',
                'com2'                  => 'Com2 eva fo40 2',
                'fecha_registro'        => '2026-01-14 10:00:00',
                'fecha_registro2'       => '2026-01-14 10:00:00',
                'res1'                  => 'Res1 eva fo40 2',
                'res2'                  => 'Res2 eva fo40 2',
                'con'                   => 2,
            ],
            [
                'id_fo40'               => 3,
                'periodo'               => 3,
                'id_personal'           => 3,
                'id_asigna_coordinador' => 3,
                'se1'                   => 3,
                'se2'                   => 3,
                'com'                   => 'Com eva fo40 3',
                'com2'                  => 'Com2 eva fo40 3',
                'fecha_registro'        => '2026-01-23 11:00:00',
                'fecha_registro2'       => '2026-01-23 11:00:00',
                'res1'                  => 'Res1 eva fo40 3',
                'res2'                  => 'Res2 eva fo40 3',
                'con'                   => 3,
            ],
            [
                'id_fo40'               => 4,
                'periodo'               => 4,
                'id_personal'           => 4,
                'id_asigna_coordinador' => 4,
                'se1'                   => 4,
                'se2'                   => 4,
                'com'                   => 'Com eva fo40 4',
                'com2'                  => 'Com2 eva fo40 4',
                'fecha_registro'        => '2026-02-01 12:00:00',
                'fecha_registro2'       => '2026-02-01 12:00:00',
                'res1'                  => 'Res1 eva fo40 4',
                'res2'                  => 'Res2 eva fo40 4',
                'con'                   => 4,
            ],
            [
                'id_fo40'               => 5,
                'periodo'               => 5,
                'id_personal'           => 5,
                'id_asigna_coordinador' => 5,
                'se1'                   => 5,
                'se2'                   => 5,
                'com'                   => 'Com eva fo40 5',
                'com2'                  => 'Com2 eva fo40 5',
                'fecha_registro'        => '2026-02-10 13:00:00',
                'fecha_registro2'       => '2026-02-10 13:00:00',
                'res1'                  => 'Res1 eva fo40 5',
                'res2'                  => 'Res2 eva fo40 5',
                'con'                   => 5,
            ],
            [
                'id_fo40'               => 6,
                'periodo'               => 6,
                'id_personal'           => 6,
                'id_asigna_coordinador' => 6,
                'se1'                   => 6,
                'se2'                   => 6,
                'com'                   => 'Com eva fo40 6',
                'com2'                  => 'Com2 eva fo40 6',
                'fecha_registro'        => '2026-02-19 14:00:00',
                'fecha_registro2'       => '2026-02-19 14:00:00',
                'res1'                  => 'Res1 eva fo40 6',
                'res2'                  => 'Res2 eva fo40 6',
                'con'                   => 6,
            ],
            [
                'id_fo40'               => 7,
                'periodo'               => 7,
                'id_personal'           => 7,
                'id_asigna_coordinador' => 7,
                'se1'                   => 7,
                'se2'                   => 7,
                'com'                   => 'Com eva fo40 7',
                'com2'                  => 'Com2 eva fo40 7',
                'fecha_registro'        => '2026-02-28 15:00:00',
                'fecha_registro2'       => '2026-02-28 15:00:00',
                'res1'                  => 'Res1 eva fo40 7',
                'res2'                  => 'Res2 eva fo40 7',
                'con'                   => 7,
            ],
            [
                'id_fo40'               => 8,
                'periodo'               => 8,
                'id_personal'           => 8,
                'id_asigna_coordinador' => 8,
                'se1'                   => 8,
                'se2'                   => 8,
                'com'                   => 'Com eva fo40 8',
                'com2'                  => 'Com2 eva fo40 8',
                'fecha_registro'        => '2026-03-09 16:00:00',
                'fecha_registro2'       => '2026-03-09 16:00:00',
                'res1'                  => 'Res1 eva fo40 8',
                'res2'                  => 'Res2 eva fo40 8',
                'con'                   => 8,
            ],
            [
                'id_fo40'               => 9,
                'periodo'               => 9,
                'id_personal'           => 9,
                'id_asigna_coordinador' => 9,
                'se1'                   => 9,
                'se2'                   => 9,
                'com'                   => 'Com eva fo40 9',
                'com2'                  => 'Com2 eva fo40 9',
                'fecha_registro'        => '2026-03-18 08:00:00',
                'fecha_registro2'       => '2026-03-18 08:00:00',
                'res1'                  => 'Res1 eva fo40 9',
                'res2'                  => 'Res2 eva fo40 9',
                'con'                   => 9,
            ],
            [
                'id_fo40'               => 10,
                'periodo'               => 10,
                'id_personal'           => 10,
                'id_asigna_coordinador' => 10,
                'se1'                   => 10,
                'se2'                   => 10,
                'com'                   => 'Com eva fo40 10',
                'com2'                  => 'Com2 eva fo40 10',
                'fecha_registro'        => '2026-03-27 09:00:00',
                'fecha_registro2'       => '2026-03-27 09:00:00',
                'res1'                  => 'Res1 eva fo40 10',
                'res2'                  => 'Res2 eva fo40 10',
                'con'                   => 10,
            ],
            [
                'id_fo40'               => 11,
                'periodo'               => 11,
                'id_personal'           => 11,
                'id_asigna_coordinador' => 11,
                'se1'                   => 11,
                'se2'                   => 11,
                'com'                   => 'Com eva fo40 11',
                'com2'                  => 'Com2 eva fo40 11',
                'fecha_registro'        => '2026-04-05 10:00:00',
                'fecha_registro2'       => '2026-04-05 10:00:00',
                'res1'                  => 'Res1 eva fo40 11',
                'res2'                  => 'Res2 eva fo40 11',
                'con'                   => 11,
            ],
            [
                'id_fo40'               => 12,
                'periodo'               => 12,
                'id_personal'           => 12,
                'id_asigna_coordinador' => 12,
                'se1'                   => 12,
                'se2'                   => 12,
                'com'                   => 'Com eva fo40 12',
                'com2'                  => 'Com2 eva fo40 12',
                'fecha_registro'        => '2026-04-14 11:00:00',
                'fecha_registro2'       => '2026-04-14 11:00:00',
                'res1'                  => 'Res1 eva fo40 12',
                'res2'                  => 'Res2 eva fo40 12',
                'con'                   => 12,
            ],
            [
                'id_fo40'               => 13,
                'periodo'               => 13,
                'id_personal'           => 13,
                'id_asigna_coordinador' => 13,
                'se1'                   => 13,
                'se2'                   => 13,
                'com'                   => 'Com eva fo40 13',
                'com2'                  => 'Com2 eva fo40 13',
                'fecha_registro'        => '2026-04-23 12:00:00',
                'fecha_registro2'       => '2026-04-23 12:00:00',
                'res1'                  => 'Res1 eva fo40 13',
                'res2'                  => 'Res2 eva fo40 13',
                'con'                   => 13,
            ],
            [
                'id_fo40'               => 14,
                'periodo'               => 14,
                'id_personal'           => 14,
                'id_asigna_coordinador' => 14,
                'se1'                   => 14,
                'se2'                   => 14,
                'com'                   => 'Com eva fo40 14',
                'com2'                  => 'Com2 eva fo40 14',
                'fecha_registro'        => '2026-05-02 13:00:00',
                'fecha_registro2'       => '2026-05-02 13:00:00',
                'res1'                  => 'Res1 eva fo40 14',
                'res2'                  => 'Res2 eva fo40 14',
                'con'                   => 14,
            ],
            [
                'id_fo40'               => 15,
                'periodo'               => 15,
                'id_personal'           => 15,
                'id_asigna_coordinador' => 15,
                'se1'                   => 15,
                'se2'                   => 15,
                'com'                   => 'Com eva fo40 15',
                'com2'                  => 'Com2 eva fo40 15',
                'fecha_registro'        => '2026-05-11 14:00:00',
                'fecha_registro2'       => '2026-05-11 14:00:00',
                'res1'                  => 'Res1 eva fo40 15',
                'res2'                  => 'Res2 eva fo40 15',
                'con'                   => 15,
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
