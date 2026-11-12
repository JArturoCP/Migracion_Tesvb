<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_entidades_federativas`.
 */
class TiEntidadesFederativasSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_entidades_federativas` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'ti_entidades_federativas';

        $llaves = [
            ['id_entidad_federativa'],
        ];

        $registros = [
            [
                'id_entidad_federativa' => 1,
                'nom_entidad'           => 'Nom entidad entidades federativas 1',
                'clave_entidad'         => 'CLV-001',
                'fecha_registro'        => '2026-01-05',
            ],
            [
                'id_entidad_federativa' => 2,
                'nom_entidad'           => 'Nom entidad entidades federativas 2',
                'clave_entidad'         => 'CLV-002',
                'fecha_registro'        => '2026-01-14',
            ],
            [
                'id_entidad_federativa' => 3,
                'nom_entidad'           => 'Nom entidad entidades federativas 3',
                'clave_entidad'         => 'CLV-003',
                'fecha_registro'        => '2026-01-23',
            ],
            [
                'id_entidad_federativa' => 4,
                'nom_entidad'           => 'Nom entidad entidades federativas 4',
                'clave_entidad'         => 'CLV-004',
                'fecha_registro'        => '2026-02-01',
            ],
            [
                'id_entidad_federativa' => 5,
                'nom_entidad'           => 'Nom entidad entidades federativas 5',
                'clave_entidad'         => 'CLV-005',
                'fecha_registro'        => '2026-02-10',
            ],
            [
                'id_entidad_federativa' => 6,
                'nom_entidad'           => 'Nom entidad entidades federativas 6',
                'clave_entidad'         => 'CLV-006',
                'fecha_registro'        => '2026-02-19',
            ],
            [
                'id_entidad_federativa' => 7,
                'nom_entidad'           => 'Nom entidad entidades federativas 7',
                'clave_entidad'         => 'CLV-007',
                'fecha_registro'        => '2026-02-28',
            ],
            [
                'id_entidad_federativa' => 8,
                'nom_entidad'           => 'Nom entidad entidades federativas 8',
                'clave_entidad'         => 'CLV-008',
                'fecha_registro'        => '2026-03-09',
            ],
            [
                'id_entidad_federativa' => 9,
                'nom_entidad'           => 'Nom entidad entidades federativas 9',
                'clave_entidad'         => 'CLV-009',
                'fecha_registro'        => '2026-03-18',
            ],
            [
                'id_entidad_federativa' => 10,
                'nom_entidad'           => 'Nom entidad entidades federativas 10',
                'clave_entidad'         => 'CLV-010',
                'fecha_registro'        => '2026-03-27',
            ],
            [
                'id_entidad_federativa' => 11,
                'nom_entidad'           => 'Nom entidad entidades federativas 11',
                'clave_entidad'         => 'CLV-011',
                'fecha_registro'        => '2026-04-05',
            ],
            [
                'id_entidad_federativa' => 12,
                'nom_entidad'           => 'Nom entidad entidades federativas 12',
                'clave_entidad'         => 'CLV-012',
                'fecha_registro'        => '2026-04-14',
            ],
            [
                'id_entidad_federativa' => 13,
                'nom_entidad'           => 'Nom entidad entidades federativas 13',
                'clave_entidad'         => 'CLV-013',
                'fecha_registro'        => '2026-04-23',
            ],
            [
                'id_entidad_federativa' => 14,
                'nom_entidad'           => 'Nom entidad entidades federativas 14',
                'clave_entidad'         => 'CLV-014',
                'fecha_registro'        => '2026-05-02',
            ],
            [
                'id_entidad_federativa' => 15,
                'nom_entidad'           => 'Nom entidad entidades federativas 15',
                'clave_entidad'         => 'CLV-015',
                'fecha_registro'        => '2026-05-11',
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
