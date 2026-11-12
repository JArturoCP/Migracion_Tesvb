<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_investigadoresexternos`.
 */
class InvInvestigadoresexternosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_investigadoresexternos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
            InvProyectosvinculacionSeeder::class,
        ]);

        $tabla = 'inv_investigadoresexternos';

        $llaves = [
            ['id_investigadorexterno'],
        ];

        $registros = [
            [
                'id_investigadorexterno' => 1,
                'id_protocolo'           => 1,
                'created_at'             => '2026-01-05 09:00:00',
                'updated_at'             => '2026-01-05 09:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 1',
                'id_proyectov'           => 1,
            ],
            [
                'id_investigadorexterno' => 2,
                'id_protocolo'           => 2,
                'created_at'             => '2026-01-14 10:00:00',
                'updated_at'             => '2026-01-14 10:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 2',
                'id_proyectov'           => 2,
            ],
            [
                'id_investigadorexterno' => 3,
                'id_protocolo'           => 3,
                'created_at'             => '2026-01-23 11:00:00',
                'updated_at'             => '2026-01-23 11:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 3',
                'id_proyectov'           => 3,
            ],
            [
                'id_investigadorexterno' => 4,
                'id_protocolo'           => 4,
                'created_at'             => '2026-02-01 12:00:00',
                'updated_at'             => '2026-02-01 12:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 4',
                'id_proyectov'           => 4,
            ],
            [
                'id_investigadorexterno' => 5,
                'id_protocolo'           => 5,
                'created_at'             => '2026-02-10 13:00:00',
                'updated_at'             => '2026-02-10 13:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 5',
                'id_proyectov'           => 5,
            ],
            [
                'id_investigadorexterno' => 6,
                'id_protocolo'           => 6,
                'created_at'             => '2026-02-19 14:00:00',
                'updated_at'             => '2026-02-19 14:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 6',
                'id_proyectov'           => 6,
            ],
            [
                'id_investigadorexterno' => 7,
                'id_protocolo'           => 7,
                'created_at'             => '2026-02-28 15:00:00',
                'updated_at'             => '2026-02-28 15:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 7',
                'id_proyectov'           => 7,
            ],
            [
                'id_investigadorexterno' => 8,
                'id_protocolo'           => 8,
                'created_at'             => '2026-03-09 16:00:00',
                'updated_at'             => '2026-03-09 16:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 8',
                'id_proyectov'           => 8,
            ],
            [
                'id_investigadorexterno' => 9,
                'id_protocolo'           => 9,
                'created_at'             => '2026-03-18 08:00:00',
                'updated_at'             => '2026-03-18 08:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 9',
                'id_proyectov'           => 9,
            ],
            [
                'id_investigadorexterno' => 10,
                'id_protocolo'           => 10,
                'created_at'             => '2026-03-27 09:00:00',
                'updated_at'             => '2026-03-27 09:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 10',
                'id_proyectov'           => 10,
            ],
            [
                'id_investigadorexterno' => 11,
                'id_protocolo'           => 11,
                'created_at'             => '2026-04-05 10:00:00',
                'updated_at'             => '2026-04-05 10:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 11',
                'id_proyectov'           => 11,
            ],
            [
                'id_investigadorexterno' => 12,
                'id_protocolo'           => 12,
                'created_at'             => '2026-04-14 11:00:00',
                'updated_at'             => '2026-04-14 11:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 12',
                'id_proyectov'           => 12,
            ],
            [
                'id_investigadorexterno' => 13,
                'id_protocolo'           => 13,
                'created_at'             => '2026-04-23 12:00:00',
                'updated_at'             => '2026-04-23 12:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 13',
                'id_proyectov'           => 13,
            ],
            [
                'id_investigadorexterno' => 14,
                'id_protocolo'           => 14,
                'created_at'             => '2026-05-02 13:00:00',
                'updated_at'             => '2026-05-02 13:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 14',
                'id_proyectov'           => 14,
            ],
            [
                'id_investigadorexterno' => 15,
                'id_protocolo'           => 15,
                'created_at'             => '2026-05-11 14:00:00',
                'updated_at'             => '2026-05-11 14:00:00',
                'deleted_at'             => null,
                'nombre'                 => 'Nombre investigadoresexternos 15',
                'id_proyectov'           => 15,
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
