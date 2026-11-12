<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_actividades`.
 */
class InvActividadesSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_actividades` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_actividades';

        $llaves = [
            ['id_actividad'],
        ];

        $registros = [
            [
                'id_actividad'     => 1,
                'id_protocolo'     => 1,
                'descripcion'      => 'Descripcion actividades 1',
                'etiqueta'         => 'Etiqueta actividades 1',
                'f_inicial'        => '2026-01-05',
                'f_final'          => '2026-01-05',
                'monto_solicitado' => 1500.0,
                'created_at'       => '2026-01-05 09:00:00',
                'updated_at'       => '2026-01-05 09:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 2,
                'id_protocolo'     => 2,
                'descripcion'      => 'Descripcion actividades 2',
                'etiqueta'         => 'Etiqueta actividades 2',
                'f_inicial'        => '2026-01-14',
                'f_final'          => '2026-01-14',
                'monto_solicitado' => 3000.0,
                'created_at'       => '2026-01-14 10:00:00',
                'updated_at'       => '2026-01-14 10:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 3,
                'id_protocolo'     => 3,
                'descripcion'      => 'Descripcion actividades 3',
                'etiqueta'         => 'Etiqueta actividades 3',
                'f_inicial'        => '2026-01-23',
                'f_final'          => '2026-01-23',
                'monto_solicitado' => 4500.0,
                'created_at'       => '2026-01-23 11:00:00',
                'updated_at'       => '2026-01-23 11:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 4,
                'id_protocolo'     => 4,
                'descripcion'      => 'Descripcion actividades 4',
                'etiqueta'         => 'Etiqueta actividades 4',
                'f_inicial'        => '2026-02-01',
                'f_final'          => '2026-02-01',
                'monto_solicitado' => 6000.0,
                'created_at'       => '2026-02-01 12:00:00',
                'updated_at'       => '2026-02-01 12:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 5,
                'id_protocolo'     => 5,
                'descripcion'      => 'Descripcion actividades 5',
                'etiqueta'         => 'Etiqueta actividades 5',
                'f_inicial'        => '2026-02-10',
                'f_final'          => '2026-02-10',
                'monto_solicitado' => 7500.0,
                'created_at'       => '2026-02-10 13:00:00',
                'updated_at'       => '2026-02-10 13:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 6,
                'id_protocolo'     => 6,
                'descripcion'      => 'Descripcion actividades 6',
                'etiqueta'         => 'Etiqueta actividades 6',
                'f_inicial'        => '2026-02-19',
                'f_final'          => '2026-02-19',
                'monto_solicitado' => 9000.0,
                'created_at'       => '2026-02-19 14:00:00',
                'updated_at'       => '2026-02-19 14:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 7,
                'id_protocolo'     => 7,
                'descripcion'      => 'Descripcion actividades 7',
                'etiqueta'         => 'Etiqueta actividades 7',
                'f_inicial'        => '2026-02-28',
                'f_final'          => '2026-02-28',
                'monto_solicitado' => 10500.0,
                'created_at'       => '2026-02-28 15:00:00',
                'updated_at'       => '2026-02-28 15:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 8,
                'id_protocolo'     => 8,
                'descripcion'      => 'Descripcion actividades 8',
                'etiqueta'         => 'Etiqueta actividades 8',
                'f_inicial'        => '2026-03-09',
                'f_final'          => '2026-03-09',
                'monto_solicitado' => 12000.0,
                'created_at'       => '2026-03-09 16:00:00',
                'updated_at'       => '2026-03-09 16:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 9,
                'id_protocolo'     => 9,
                'descripcion'      => 'Descripcion actividades 9',
                'etiqueta'         => 'Etiqueta actividades 9',
                'f_inicial'        => '2026-03-18',
                'f_final'          => '2026-03-18',
                'monto_solicitado' => 13500.0,
                'created_at'       => '2026-03-18 08:00:00',
                'updated_at'       => '2026-03-18 08:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 10,
                'id_protocolo'     => 10,
                'descripcion'      => 'Descripcion actividades 10',
                'etiqueta'         => 'Etiqueta actividades 10',
                'f_inicial'        => '2026-03-27',
                'f_final'          => '2026-03-27',
                'monto_solicitado' => 15000.0,
                'created_at'       => '2026-03-27 09:00:00',
                'updated_at'       => '2026-03-27 09:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 11,
                'id_protocolo'     => 11,
                'descripcion'      => 'Descripcion actividades 11',
                'etiqueta'         => 'Etiqueta actividades 11',
                'f_inicial'        => '2026-04-05',
                'f_final'          => '2026-04-05',
                'monto_solicitado' => 16500.0,
                'created_at'       => '2026-04-05 10:00:00',
                'updated_at'       => '2026-04-05 10:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 12,
                'id_protocolo'     => 12,
                'descripcion'      => 'Descripcion actividades 12',
                'etiqueta'         => 'Etiqueta actividades 12',
                'f_inicial'        => '2026-04-14',
                'f_final'          => '2026-04-14',
                'monto_solicitado' => 18000.0,
                'created_at'       => '2026-04-14 11:00:00',
                'updated_at'       => '2026-04-14 11:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 13,
                'id_protocolo'     => 13,
                'descripcion'      => 'Descripcion actividades 13',
                'etiqueta'         => 'Etiqueta actividades 13',
                'f_inicial'        => '2026-04-23',
                'f_final'          => '2026-04-23',
                'monto_solicitado' => 19500.0,
                'created_at'       => '2026-04-23 12:00:00',
                'updated_at'       => '2026-04-23 12:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 14,
                'id_protocolo'     => 14,
                'descripcion'      => 'Descripcion actividades 14',
                'etiqueta'         => 'Etiqueta actividades 14',
                'f_inicial'        => '2026-05-02',
                'f_final'          => '2026-05-02',
                'monto_solicitado' => 21000.0,
                'created_at'       => '2026-05-02 13:00:00',
                'updated_at'       => '2026-05-02 13:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
            ],
            [
                'id_actividad'     => 15,
                'id_protocolo'     => 15,
                'descripcion'      => 'Descripcion actividades 15',
                'etiqueta'         => 'Etiqueta actividades 15',
                'f_inicial'        => '2026-05-11',
                'f_final'          => '2026-05-11',
                'monto_solicitado' => 22500.0,
                'created_at'       => '2026-05-11 14:00:00',
                'updated_at'       => '2026-05-11 14:00:00',
                'deleted_at'       => null,
                'colaboracion'     => 1,
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
