<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_evidencias`.
 */
class InvEvidenciasSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_evidencias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProductoseSeeder::class,
        ]);

        $tabla = 'inv_evidencias';

        $llaves = [
            ['id_evidencia'],
        ];

        $registros = [
            [
                'id_evidencia'   => 1,
                'descripcion_ev' => 'Descripcion ev evidencias 1',
                'id_productose'  => 1,
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 2,
                'descripcion_ev' => 'Descripcion ev evidencias 2',
                'id_productose'  => 2,
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 3,
                'descripcion_ev' => 'Descripcion ev evidencias 3',
                'id_productose'  => 3,
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 4,
                'descripcion_ev' => 'Descripcion ev evidencias 4',
                'id_productose'  => 4,
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 5,
                'descripcion_ev' => 'Descripcion ev evidencias 5',
                'id_productose'  => 5,
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 6,
                'descripcion_ev' => 'Descripcion ev evidencias 6',
                'id_productose'  => 6,
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 7,
                'descripcion_ev' => 'Descripcion ev evidencias 7',
                'id_productose'  => 7,
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 8,
                'descripcion_ev' => 'Descripcion ev evidencias 8',
                'id_productose'  => 8,
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 9,
                'descripcion_ev' => 'Descripcion ev evidencias 9',
                'id_productose'  => 9,
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 10,
                'descripcion_ev' => 'Descripcion ev evidencias 10',
                'id_productose'  => 10,
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 11,
                'descripcion_ev' => 'Descripcion ev evidencias 11',
                'id_productose'  => 11,
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 12,
                'descripcion_ev' => 'Descripcion ev evidencias 12',
                'id_productose'  => 12,
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 13,
                'descripcion_ev' => 'Descripcion ev evidencias 13',
                'id_productose'  => 13,
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 14,
                'descripcion_ev' => 'Descripcion ev evidencias 14',
                'id_productose'  => 14,
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_evidencia'   => 15,
                'descripcion_ev' => 'Descripcion ev evidencias 15',
                'id_productose'  => 15,
                'created_at'     => '2026-05-11 14:00:00',
                'updated_at'     => '2026-05-11 14:00:00',
                'deleted_at'     => null,
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
