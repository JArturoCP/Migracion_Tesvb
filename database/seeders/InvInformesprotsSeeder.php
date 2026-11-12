<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `inv_informesprots`.
 */
class InvInformesprotsSeeder extends Seeder
{
    /**
     * Pobla la tabla `inv_informesprots` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InvProtocolosSeeder::class,
        ]);

        $tabla = 'inv_informesprots';

        $llaves = [
            ['id_informeprot'],
        ];

        $registros = [
            [
                'id_informeprot' => 1,
                'id_protocolo'   => 1,
                'id_informe'     => 1,
                'fecha'          => '2026-01-05',
                'comentario'     => 'Comentario informesprots 1',
                'created_at'     => '2026-01-05 09:00:00',
                'updated_at'     => '2026-01-05 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 2,
                'id_protocolo'   => 2,
                'id_informe'     => 2,
                'fecha'          => '2026-01-14',
                'comentario'     => 'Comentario informesprots 2',
                'created_at'     => '2026-01-14 10:00:00',
                'updated_at'     => '2026-01-14 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 3,
                'id_protocolo'   => 3,
                'id_informe'     => 3,
                'fecha'          => '2026-01-23',
                'comentario'     => 'Comentario informesprots 3',
                'created_at'     => '2026-01-23 11:00:00',
                'updated_at'     => '2026-01-23 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 4,
                'id_protocolo'   => 4,
                'id_informe'     => 4,
                'fecha'          => '2026-02-01',
                'comentario'     => 'Comentario informesprots 4',
                'created_at'     => '2026-02-01 12:00:00',
                'updated_at'     => '2026-02-01 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 5,
                'id_protocolo'   => 5,
                'id_informe'     => 5,
                'fecha'          => '2026-02-10',
                'comentario'     => 'Comentario informesprots 5',
                'created_at'     => '2026-02-10 13:00:00',
                'updated_at'     => '2026-02-10 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 6,
                'id_protocolo'   => 6,
                'id_informe'     => 6,
                'fecha'          => '2026-02-19',
                'comentario'     => 'Comentario informesprots 6',
                'created_at'     => '2026-02-19 14:00:00',
                'updated_at'     => '2026-02-19 14:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 7,
                'id_protocolo'   => 7,
                'id_informe'     => 7,
                'fecha'          => '2026-02-28',
                'comentario'     => 'Comentario informesprots 7',
                'created_at'     => '2026-02-28 15:00:00',
                'updated_at'     => '2026-02-28 15:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 8,
                'id_protocolo'   => 8,
                'id_informe'     => 8,
                'fecha'          => '2026-03-09',
                'comentario'     => 'Comentario informesprots 8',
                'created_at'     => '2026-03-09 16:00:00',
                'updated_at'     => '2026-03-09 16:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 9,
                'id_protocolo'   => 9,
                'id_informe'     => 9,
                'fecha'          => '2026-03-18',
                'comentario'     => 'Comentario informesprots 9',
                'created_at'     => '2026-03-18 08:00:00',
                'updated_at'     => '2026-03-18 08:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 10,
                'id_protocolo'   => 10,
                'id_informe'     => 10,
                'fecha'          => '2026-03-27',
                'comentario'     => 'Comentario informesprots 10',
                'created_at'     => '2026-03-27 09:00:00',
                'updated_at'     => '2026-03-27 09:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 11,
                'id_protocolo'   => 11,
                'id_informe'     => 11,
                'fecha'          => '2026-04-05',
                'comentario'     => 'Comentario informesprots 11',
                'created_at'     => '2026-04-05 10:00:00',
                'updated_at'     => '2026-04-05 10:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 12,
                'id_protocolo'   => 12,
                'id_informe'     => 12,
                'fecha'          => '2026-04-14',
                'comentario'     => 'Comentario informesprots 12',
                'created_at'     => '2026-04-14 11:00:00',
                'updated_at'     => '2026-04-14 11:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 13,
                'id_protocolo'   => 13,
                'id_informe'     => 13,
                'fecha'          => '2026-04-23',
                'comentario'     => 'Comentario informesprots 13',
                'created_at'     => '2026-04-23 12:00:00',
                'updated_at'     => '2026-04-23 12:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 14,
                'id_protocolo'   => 14,
                'id_informe'     => 14,
                'fecha'          => '2026-05-02',
                'comentario'     => 'Comentario informesprots 14',
                'created_at'     => '2026-05-02 13:00:00',
                'updated_at'     => '2026-05-02 13:00:00',
                'deleted_at'     => null,
            ],
            [
                'id_informeprot' => 15,
                'id_protocolo'   => 15,
                'id_informe'     => 15,
                'fecha'          => '2026-05-11',
                'comentario'     => 'Comentario informesprots 15',
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
