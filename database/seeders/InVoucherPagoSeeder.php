<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_voucher_pago`.
 */
class InVoucherPagoSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_voucher_pago` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            InPeriodosSeeder::class,
        ]);

        $tabla = 'in_voucher_pago';

        $llaves = [
            ['id_voucher'],
        ];

        $registros = [
            [
                'id_voucher'               => 1,
                'id_usuario'               => 1,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 1.',
                'linea_captura'            => 'Linea captura voucher pago 1',
                'fecha_cambio'             => '2026-01-05',
                'id_estado_carga_voucher'  => 1,
                'id_estado_valida_voucher' => 1,
                'id_periodo_ingles'        => 1,
                'num_veces_usado'          => 1,
                'id_tipo_voucher'          => 1,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 1.',
                'estado_agregacion_excel'  => 1,
                'created_at'               => '2026-01-05 09:00:00',
                'updated_at'               => '2026-01-05 09:00:00',
            ],
            [
                'id_voucher'               => 2,
                'id_usuario'               => 2,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 2.',
                'linea_captura'            => 'Linea captura voucher pago 2',
                'fecha_cambio'             => '2026-01-14',
                'id_estado_carga_voucher'  => 2,
                'id_estado_valida_voucher' => 2,
                'id_periodo_ingles'        => 2,
                'num_veces_usado'          => 2,
                'id_tipo_voucher'          => 2,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 2.',
                'estado_agregacion_excel'  => 2,
                'created_at'               => '2026-01-14 10:00:00',
                'updated_at'               => '2026-01-14 10:00:00',
            ],
            [
                'id_voucher'               => 3,
                'id_usuario'               => 3,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 3.',
                'linea_captura'            => 'Linea captura voucher pago 3',
                'fecha_cambio'             => '2026-01-23',
                'id_estado_carga_voucher'  => 3,
                'id_estado_valida_voucher' => 3,
                'id_periodo_ingles'        => 3,
                'num_veces_usado'          => 3,
                'id_tipo_voucher'          => 3,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 3.',
                'estado_agregacion_excel'  => 3,
                'created_at'               => '2026-01-23 11:00:00',
                'updated_at'               => '2026-01-23 11:00:00',
            ],
            [
                'id_voucher'               => 4,
                'id_usuario'               => 4,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 4.',
                'linea_captura'            => 'Linea captura voucher pago 4',
                'fecha_cambio'             => '2026-02-01',
                'id_estado_carga_voucher'  => 4,
                'id_estado_valida_voucher' => 4,
                'id_periodo_ingles'        => 4,
                'num_veces_usado'          => 4,
                'id_tipo_voucher'          => 4,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 4.',
                'estado_agregacion_excel'  => 4,
                'created_at'               => '2026-02-01 12:00:00',
                'updated_at'               => '2026-02-01 12:00:00',
            ],
            [
                'id_voucher'               => 5,
                'id_usuario'               => 5,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 5.',
                'linea_captura'            => 'Linea captura voucher pago 5',
                'fecha_cambio'             => '2026-02-10',
                'id_estado_carga_voucher'  => 5,
                'id_estado_valida_voucher' => 5,
                'id_periodo_ingles'        => 5,
                'num_veces_usado'          => 5,
                'id_tipo_voucher'          => 5,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 5.',
                'estado_agregacion_excel'  => 5,
                'created_at'               => '2026-02-10 13:00:00',
                'updated_at'               => '2026-02-10 13:00:00',
            ],
            [
                'id_voucher'               => 6,
                'id_usuario'               => 6,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 6.',
                'linea_captura'            => 'Linea captura voucher pago 6',
                'fecha_cambio'             => '2026-02-19',
                'id_estado_carga_voucher'  => 6,
                'id_estado_valida_voucher' => 6,
                'id_periodo_ingles'        => 6,
                'num_veces_usado'          => 6,
                'id_tipo_voucher'          => 6,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 6.',
                'estado_agregacion_excel'  => 6,
                'created_at'               => '2026-02-19 14:00:00',
                'updated_at'               => '2026-02-19 14:00:00',
            ],
            [
                'id_voucher'               => 7,
                'id_usuario'               => 7,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 7.',
                'linea_captura'            => 'Linea captura voucher pago 7',
                'fecha_cambio'             => '2026-02-28',
                'id_estado_carga_voucher'  => 7,
                'id_estado_valida_voucher' => 7,
                'id_periodo_ingles'        => 7,
                'num_veces_usado'          => 7,
                'id_tipo_voucher'          => 7,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 7.',
                'estado_agregacion_excel'  => 7,
                'created_at'               => '2026-02-28 15:00:00',
                'updated_at'               => '2026-02-28 15:00:00',
            ],
            [
                'id_voucher'               => 8,
                'id_usuario'               => 8,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 8.',
                'linea_captura'            => 'Linea captura voucher pago 8',
                'fecha_cambio'             => '2026-03-09',
                'id_estado_carga_voucher'  => 8,
                'id_estado_valida_voucher' => 8,
                'id_periodo_ingles'        => 8,
                'num_veces_usado'          => 8,
                'id_tipo_voucher'          => 8,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 8.',
                'estado_agregacion_excel'  => 8,
                'created_at'               => '2026-03-09 16:00:00',
                'updated_at'               => '2026-03-09 16:00:00',
            ],
            [
                'id_voucher'               => 9,
                'id_usuario'               => 9,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 9.',
                'linea_captura'            => 'Linea captura voucher pago 9',
                'fecha_cambio'             => '2026-03-18',
                'id_estado_carga_voucher'  => 9,
                'id_estado_valida_voucher' => 9,
                'id_periodo_ingles'        => 9,
                'num_veces_usado'          => 9,
                'id_tipo_voucher'          => 9,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 9.',
                'estado_agregacion_excel'  => 9,
                'created_at'               => '2026-03-18 08:00:00',
                'updated_at'               => '2026-03-18 08:00:00',
            ],
            [
                'id_voucher'               => 10,
                'id_usuario'               => 10,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 10.',
                'linea_captura'            => 'Linea captura voucher pago 10',
                'fecha_cambio'             => '2026-03-27',
                'id_estado_carga_voucher'  => 10,
                'id_estado_valida_voucher' => 10,
                'id_periodo_ingles'        => 10,
                'num_veces_usado'          => 10,
                'id_tipo_voucher'          => 10,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 10.',
                'estado_agregacion_excel'  => 10,
                'created_at'               => '2026-03-27 09:00:00',
                'updated_at'               => '2026-03-27 09:00:00',
            ],
            [
                'id_voucher'               => 11,
                'id_usuario'               => 11,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 11.',
                'linea_captura'            => 'Linea captura voucher pago 11',
                'fecha_cambio'             => '2026-04-05',
                'id_estado_carga_voucher'  => 11,
                'id_estado_valida_voucher' => 11,
                'id_periodo_ingles'        => 11,
                'num_veces_usado'          => 11,
                'id_tipo_voucher'          => 11,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 11.',
                'estado_agregacion_excel'  => 11,
                'created_at'               => '2026-04-05 10:00:00',
                'updated_at'               => '2026-04-05 10:00:00',
            ],
            [
                'id_voucher'               => 12,
                'id_usuario'               => 12,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 12.',
                'linea_captura'            => 'Linea captura voucher pago 12',
                'fecha_cambio'             => '2026-04-14',
                'id_estado_carga_voucher'  => 12,
                'id_estado_valida_voucher' => 12,
                'id_periodo_ingles'        => 12,
                'num_veces_usado'          => 12,
                'id_tipo_voucher'          => 12,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 12.',
                'estado_agregacion_excel'  => 12,
                'created_at'               => '2026-04-14 11:00:00',
                'updated_at'               => '2026-04-14 11:00:00',
            ],
            [
                'id_voucher'               => 13,
                'id_usuario'               => 13,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 13.',
                'linea_captura'            => 'Linea captura voucher pago 13',
                'fecha_cambio'             => '2026-04-23',
                'id_estado_carga_voucher'  => 13,
                'id_estado_valida_voucher' => 13,
                'id_periodo_ingles'        => 13,
                'num_veces_usado'          => 13,
                'id_tipo_voucher'          => 13,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 13.',
                'estado_agregacion_excel'  => 13,
                'created_at'               => '2026-04-23 12:00:00',
                'updated_at'               => '2026-04-23 12:00:00',
            ],
            [
                'id_voucher'               => 14,
                'id_usuario'               => 14,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 14.',
                'linea_captura'            => 'Linea captura voucher pago 14',
                'fecha_cambio'             => '2026-05-02',
                'id_estado_carga_voucher'  => 14,
                'id_estado_valida_voucher' => 14,
                'id_periodo_ingles'        => 14,
                'num_veces_usado'          => 14,
                'id_tipo_voucher'          => 14,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 14.',
                'estado_agregacion_excel'  => 14,
                'created_at'               => '2026-05-02 13:00:00',
                'updated_at'               => '2026-05-02 13:00:00',
            ],
            [
                'id_voucher'               => 15,
                'id_usuario'               => 15,
                'voucher'                  => 'Voucher de voucher pago: registro de prueba número 15.',
                'linea_captura'            => 'Linea captura voucher pago 15',
                'fecha_cambio'             => '2026-05-11',
                'id_estado_carga_voucher'  => 15,
                'id_estado_valida_voucher' => 15,
                'id_periodo_ingles'        => 15,
                'num_veces_usado'          => 15,
                'id_tipo_voucher'          => 15,
                'comentario'               => 'Comentario de voucher pago: registro de prueba número 15.',
                'estado_agregacion_excel'  => 15,
                'created_at'               => '2026-05-11 14:00:00',
                'updated_at'               => '2026-05-11 14:00:00',
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
