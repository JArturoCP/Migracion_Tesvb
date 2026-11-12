<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_resultados`.
 */
class InvResultadosSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_resultados` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'inv_resultados';

        $llaves = [
            ['id_resultado'],
        ];

        $registros = [
            [
                'id_resultado'  => 1,
                'descripcion_r' => 'Descripcion r resultados 1',
                'created_at'    => '2026-01-05 09:00:00',
                'updated_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 2,
                'descripcion_r' => 'Descripcion r resultados 2',
                'created_at'    => '2026-01-14 10:00:00',
                'updated_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 3,
                'descripcion_r' => 'Descripcion r resultados 3',
                'created_at'    => '2026-01-23 11:00:00',
                'updated_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 4,
                'descripcion_r' => 'Descripcion r resultados 4',
                'created_at'    => '2026-02-01 12:00:00',
                'updated_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 5,
                'descripcion_r' => 'Descripcion r resultados 5',
                'created_at'    => '2026-02-10 13:00:00',
                'updated_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 6,
                'descripcion_r' => 'Descripcion r resultados 6',
                'created_at'    => '2026-02-19 14:00:00',
                'updated_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 7,
                'descripcion_r' => 'Descripcion r resultados 7',
                'created_at'    => '2026-02-28 15:00:00',
                'updated_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 8,
                'descripcion_r' => 'Descripcion r resultados 8',
                'created_at'    => '2026-03-09 16:00:00',
                'updated_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 9,
                'descripcion_r' => 'Descripcion r resultados 9',
                'created_at'    => '2026-03-18 08:00:00',
                'updated_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 10,
                'descripcion_r' => 'Descripcion r resultados 10',
                'created_at'    => '2026-03-27 09:00:00',
                'updated_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 11,
                'descripcion_r' => 'Descripcion r resultados 11',
                'created_at'    => '2026-04-05 10:00:00',
                'updated_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 12,
                'descripcion_r' => 'Descripcion r resultados 12',
                'created_at'    => '2026-04-14 11:00:00',
                'updated_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 13,
                'descripcion_r' => 'Descripcion r resultados 13',
                'created_at'    => '2026-04-23 12:00:00',
                'updated_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 14,
                'descripcion_r' => 'Descripcion r resultados 14',
                'created_at'    => '2026-05-02 13:00:00',
                'updated_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_resultado'  => 15,
                'descripcion_r' => 'Descripcion r resultados 15',
                'created_at'    => '2026-05-11 14:00:00',
                'updated_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
