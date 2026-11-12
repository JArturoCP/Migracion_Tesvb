<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `actividades_complementarias`.
 */
class ActividadesComplementariasSeeder extends Seeder
{
    /**
     * Pobla la tabla `actividades_complementarias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleCategoriasSeeder::class,
            ActcompleJefaturasSeeder::class,
        ]);

        $tabla = 'actividades_complementarias';

        $llaves = [
            ['id_actividad_comple'],
        ];

        $registros = [
            [
                'id_actividad_comple' => 1,
                'descripcion'         => 'Descripcion actividades complementarias 1',
                'horas'               => 40,
                'creditos'            => 1,
                'id_categoria'        => 1,
                'id_jefatura'         => 1,
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
                'estado'              => 1,
            ],
            [
                'id_actividad_comple' => 2,
                'descripcion'         => 'Descripcion actividades complementarias 2',
                'horas'               => 40,
                'creditos'            => 2,
                'id_categoria'        => 2,
                'id_jefatura'         => 2,
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
                'estado'              => 2,
            ],
            [
                'id_actividad_comple' => 3,
                'descripcion'         => 'Descripcion actividades complementarias 3',
                'horas'               => 40,
                'creditos'            => 3,
                'id_categoria'        => 3,
                'id_jefatura'         => 3,
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
                'estado'              => 3,
            ],
            [
                'id_actividad_comple' => 4,
                'descripcion'         => 'Descripcion actividades complementarias 4',
                'horas'               => 40,
                'creditos'            => 4,
                'id_categoria'        => 4,
                'id_jefatura'         => 4,
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
                'estado'              => 4,
            ],
            [
                'id_actividad_comple' => 5,
                'descripcion'         => 'Descripcion actividades complementarias 5',
                'horas'               => 40,
                'creditos'            => 5,
                'id_categoria'        => 5,
                'id_jefatura'         => 5,
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
                'estado'              => 5,
            ],
            [
                'id_actividad_comple' => 6,
                'descripcion'         => 'Descripcion actividades complementarias 6',
                'horas'               => 40,
                'creditos'            => 6,
                'id_categoria'        => 6,
                'id_jefatura'         => 6,
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
                'estado'              => 6,
            ],
            [
                'id_actividad_comple' => 7,
                'descripcion'         => 'Descripcion actividades complementarias 7',
                'horas'               => 40,
                'creditos'            => 7,
                'id_categoria'        => 7,
                'id_jefatura'         => 7,
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
                'estado'              => 7,
            ],
            [
                'id_actividad_comple' => 8,
                'descripcion'         => 'Descripcion actividades complementarias 8',
                'horas'               => 40,
                'creditos'            => 8,
                'id_categoria'        => 8,
                'id_jefatura'         => 8,
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
                'estado'              => 8,
            ],
            [
                'id_actividad_comple' => 9,
                'descripcion'         => 'Descripcion actividades complementarias 9',
                'horas'               => 40,
                'creditos'            => 9,
                'id_categoria'        => 9,
                'id_jefatura'         => 9,
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
                'estado'              => 9,
            ],
            [
                'id_actividad_comple' => 10,
                'descripcion'         => 'Descripcion actividades complementarias 10',
                'horas'               => 40,
                'creditos'            => 10,
                'id_categoria'        => 10,
                'id_jefatura'         => 10,
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
                'estado'              => 10,
            ],
            [
                'id_actividad_comple' => 11,
                'descripcion'         => 'Descripcion actividades complementarias 11',
                'horas'               => 40,
                'creditos'            => 11,
                'id_categoria'        => 11,
                'id_jefatura'         => 11,
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
                'estado'              => 11,
            ],
            [
                'id_actividad_comple' => 12,
                'descripcion'         => 'Descripcion actividades complementarias 12',
                'horas'               => 40,
                'creditos'            => 12,
                'id_categoria'        => 12,
                'id_jefatura'         => 12,
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
                'estado'              => 12,
            ],
            [
                'id_actividad_comple' => 13,
                'descripcion'         => 'Descripcion actividades complementarias 13',
                'horas'               => 40,
                'creditos'            => 13,
                'id_categoria'        => 13,
                'id_jefatura'         => 13,
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
                'estado'              => 13,
            ],
            [
                'id_actividad_comple' => 14,
                'descripcion'         => 'Descripcion actividades complementarias 14',
                'horas'               => 40,
                'creditos'            => 14,
                'id_categoria'        => 14,
                'id_jefatura'         => 14,
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
                'estado'              => 14,
            ],
            [
                'id_actividad_comple' => 15,
                'descripcion'         => 'Descripcion actividades complementarias 15',
                'horas'               => 40,
                'creditos'            => 15,
                'id_categoria'        => 15,
                'id_jefatura'         => 15,
                'created_at'          => '2026-05-11 14:00:00',
                'updated_at'          => '2026-05-11 14:00:00',
                'estado'              => 15,
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
