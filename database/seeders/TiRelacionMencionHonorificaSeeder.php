<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_relacion_mencion_honorifica`.
 */
class TiRelacionMencionHonorificaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_relacion_mencion_honorifica` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_relacion_mencion_honorifica';

        $llaves = [
            ['id_relacion_mencion_honorifica'],
        ];

        $registros = [
            [
                'id_relacion_mencion_honorifica' => 1,
                'fecha'                          => '2026-01-05',
                'numero_oficio'                  => 'TESVB-2026-0001',
                'id_estado'                      => 1,
                'fecha_registro'                 => '2026-01-05',
            ],
            [
                'id_relacion_mencion_honorifica' => 2,
                'fecha'                          => '2026-01-14',
                'numero_oficio'                  => 'TESVB-2026-0002',
                'id_estado'                      => 2,
                'fecha_registro'                 => '2026-01-14',
            ],
            [
                'id_relacion_mencion_honorifica' => 3,
                'fecha'                          => '2026-01-23',
                'numero_oficio'                  => 'TESVB-2026-0003',
                'id_estado'                      => 3,
                'fecha_registro'                 => '2026-01-23',
            ],
            [
                'id_relacion_mencion_honorifica' => 4,
                'fecha'                          => '2026-02-01',
                'numero_oficio'                  => 'TESVB-2026-0004',
                'id_estado'                      => 4,
                'fecha_registro'                 => '2026-02-01',
            ],
            [
                'id_relacion_mencion_honorifica' => 5,
                'fecha'                          => '2026-02-10',
                'numero_oficio'                  => 'TESVB-2026-0005',
                'id_estado'                      => 5,
                'fecha_registro'                 => '2026-02-10',
            ],
            [
                'id_relacion_mencion_honorifica' => 6,
                'fecha'                          => '2026-02-19',
                'numero_oficio'                  => 'TESVB-2026-0006',
                'id_estado'                      => 6,
                'fecha_registro'                 => '2026-02-19',
            ],
            [
                'id_relacion_mencion_honorifica' => 7,
                'fecha'                          => '2026-02-28',
                'numero_oficio'                  => 'TESVB-2026-0007',
                'id_estado'                      => 7,
                'fecha_registro'                 => '2026-02-28',
            ],
            [
                'id_relacion_mencion_honorifica' => 8,
                'fecha'                          => '2026-03-09',
                'numero_oficio'                  => 'TESVB-2026-0008',
                'id_estado'                      => 8,
                'fecha_registro'                 => '2026-03-09',
            ],
            [
                'id_relacion_mencion_honorifica' => 9,
                'fecha'                          => '2026-03-18',
                'numero_oficio'                  => 'TESVB-2026-0009',
                'id_estado'                      => 9,
                'fecha_registro'                 => '2026-03-18',
            ],
            [
                'id_relacion_mencion_honorifica' => 10,
                'fecha'                          => '2026-03-27',
                'numero_oficio'                  => 'TESVB-2026-0010',
                'id_estado'                      => 10,
                'fecha_registro'                 => '2026-03-27',
            ],
            [
                'id_relacion_mencion_honorifica' => 11,
                'fecha'                          => '2026-04-05',
                'numero_oficio'                  => 'TESVB-2026-0011',
                'id_estado'                      => 11,
                'fecha_registro'                 => '2026-04-05',
            ],
            [
                'id_relacion_mencion_honorifica' => 12,
                'fecha'                          => '2026-04-14',
                'numero_oficio'                  => 'TESVB-2026-0012',
                'id_estado'                      => 12,
                'fecha_registro'                 => '2026-04-14',
            ],
            [
                'id_relacion_mencion_honorifica' => 13,
                'fecha'                          => '2026-04-23',
                'numero_oficio'                  => 'TESVB-2026-0013',
                'id_estado'                      => 13,
                'fecha_registro'                 => '2026-04-23',
            ],
            [
                'id_relacion_mencion_honorifica' => 14,
                'fecha'                          => '2026-05-02',
                'numero_oficio'                  => 'TESVB-2026-0014',
                'id_estado'                      => 14,
                'fecha_registro'                 => '2026-05-02',
            ],
            [
                'id_relacion_mencion_honorifica' => 15,
                'fecha'                          => '2026-05-11',
                'numero_oficio'                  => 'TESVB-2026-0015',
                'id_estado'                      => 15,
                'fecha_registro'                 => '2026-05-11',
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
