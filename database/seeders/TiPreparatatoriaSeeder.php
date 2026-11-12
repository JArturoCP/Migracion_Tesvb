<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_preparatatoria`.
 */
class TiPreparatatoriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_preparatatoria` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            TiEntidadesFederativasSeeder::class,
            TiTipoEstudioAntecedenteSeeder::class,
        ]);

        $tabla = 'ti_preparatatoria';

        $llaves = [
            ['id_preparatoria'],
        ];

        $registros = [
            [
                'id_preparatoria'             => 1,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 1.',
                'id_entidad_federativa'       => 1,
                'id_tipo_estudio_antecedente' => 1,
                'fecha_registro'              => '2026-01-05',
            ],
            [
                'id_preparatoria'             => 2,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 2.',
                'id_entidad_federativa'       => 2,
                'id_tipo_estudio_antecedente' => 2,
                'fecha_registro'              => '2026-01-14',
            ],
            [
                'id_preparatoria'             => 3,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 3.',
                'id_entidad_federativa'       => 3,
                'id_tipo_estudio_antecedente' => 3,
                'fecha_registro'              => '2026-01-23',
            ],
            [
                'id_preparatoria'             => 4,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 4.',
                'id_entidad_federativa'       => 4,
                'id_tipo_estudio_antecedente' => 4,
                'fecha_registro'              => '2026-02-01',
            ],
            [
                'id_preparatoria'             => 5,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 5.',
                'id_entidad_federativa'       => 5,
                'id_tipo_estudio_antecedente' => 5,
                'fecha_registro'              => '2026-02-10',
            ],
            [
                'id_preparatoria'             => 6,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 6.',
                'id_entidad_federativa'       => 6,
                'id_tipo_estudio_antecedente' => 6,
                'fecha_registro'              => '2026-02-19',
            ],
            [
                'id_preparatoria'             => 7,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 7.',
                'id_entidad_federativa'       => 7,
                'id_tipo_estudio_antecedente' => 7,
                'fecha_registro'              => '2026-02-28',
            ],
            [
                'id_preparatoria'             => 8,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 8.',
                'id_entidad_federativa'       => 8,
                'id_tipo_estudio_antecedente' => 8,
                'fecha_registro'              => '2026-03-09',
            ],
            [
                'id_preparatoria'             => 9,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 9.',
                'id_entidad_federativa'       => 9,
                'id_tipo_estudio_antecedente' => 9,
                'fecha_registro'              => '2026-03-18',
            ],
            [
                'id_preparatoria'             => 10,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 10.',
                'id_entidad_federativa'       => 10,
                'id_tipo_estudio_antecedente' => 10,
                'fecha_registro'              => '2026-03-27',
            ],
            [
                'id_preparatoria'             => 11,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 11.',
                'id_entidad_federativa'       => 11,
                'id_tipo_estudio_antecedente' => 11,
                'fecha_registro'              => '2026-04-05',
            ],
            [
                'id_preparatoria'             => 12,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 12.',
                'id_entidad_federativa'       => 12,
                'id_tipo_estudio_antecedente' => 12,
                'fecha_registro'              => '2026-04-14',
            ],
            [
                'id_preparatoria'             => 13,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 13.',
                'id_entidad_federativa'       => 13,
                'id_tipo_estudio_antecedente' => 13,
                'fecha_registro'              => '2026-04-23',
            ],
            [
                'id_preparatoria'             => 14,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 14.',
                'id_entidad_federativa'       => 14,
                'id_tipo_estudio_antecedente' => 14,
                'fecha_registro'              => '2026-05-02',
            ],
            [
                'id_preparatoria'             => 15,
                'preparatoria'                => 'Preparatoria de preparatatoria: registro de prueba número 15.',
                'id_entidad_federativa'       => 15,
                'id_tipo_estudio_antecedente' => 15,
                'fecha_registro'              => '2026-05-11',
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
