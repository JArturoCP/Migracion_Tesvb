<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ipomex_fracciones_generales`.
 */
class IpomexFraccionesGeneralesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ipomex_fracciones_generales` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            IpomexArticulosEstatalesSeeder::class,
            IpomexArticulosGeneralesSeeder::class,
        ]);

        $tabla = 'ipomex_fracciones_generales';

        $llaves = [
            ['id_fraccion_general'],
        ];

        $registros = [
            [
                'id_fraccion_general'           => 1,
                'id_articulo_general'           => 1,
                'id_articulo_estatal'           => 1,
                'fraccion_general'              => 'Fraccion general f 1',
                'tiene_fra_general'             => 1,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_1.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_1.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 1',
                'tiene_fra_estatal'             => 1,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_1.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 1.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 1',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 1.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 1.',
                'id_registro_actualizacion'     => 1,
            ],
            [
                'id_fraccion_general'           => 2,
                'id_articulo_general'           => 2,
                'id_articulo_estatal'           => 2,
                'fraccion_general'              => 'Fraccion general f 2',
                'tiene_fra_general'             => 2,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_2.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_2.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 2',
                'tiene_fra_estatal'             => 2,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_2.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 2.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 2',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 2.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 2.',
                'id_registro_actualizacion'     => 2,
            ],
            [
                'id_fraccion_general'           => 3,
                'id_articulo_general'           => 3,
                'id_articulo_estatal'           => 3,
                'fraccion_general'              => 'Fraccion general f 3',
                'tiene_fra_general'             => 3,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_3.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_3.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 3',
                'tiene_fra_estatal'             => 3,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_3.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 3.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 3',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 3.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 3.',
                'id_registro_actualizacion'     => 3,
            ],
            [
                'id_fraccion_general'           => 4,
                'id_articulo_general'           => 4,
                'id_articulo_estatal'           => 4,
                'fraccion_general'              => 'Fraccion general f 4',
                'tiene_fra_general'             => 4,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_4.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_4.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 4',
                'tiene_fra_estatal'             => 4,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_4.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 4.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 4',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 4.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 4.',
                'id_registro_actualizacion'     => 4,
            ],
            [
                'id_fraccion_general'           => 5,
                'id_articulo_general'           => 5,
                'id_articulo_estatal'           => 5,
                'fraccion_general'              => 'Fraccion general f 5',
                'tiene_fra_general'             => 5,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_5.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_5.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 5',
                'tiene_fra_estatal'             => 5,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_5.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 5.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 5',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 5.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 5.',
                'id_registro_actualizacion'     => 5,
            ],
            [
                'id_fraccion_general'           => 6,
                'id_articulo_general'           => 6,
                'id_articulo_estatal'           => 6,
                'fraccion_general'              => 'Fraccion general f 6',
                'tiene_fra_general'             => 6,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_6.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_6.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 6',
                'tiene_fra_estatal'             => 6,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_6.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 6.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 6',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 6.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 6.',
                'id_registro_actualizacion'     => 6,
            ],
            [
                'id_fraccion_general'           => 7,
                'id_articulo_general'           => 7,
                'id_articulo_estatal'           => 7,
                'fraccion_general'              => 'Fraccion general f 7',
                'tiene_fra_general'             => 7,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_7.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_7.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 7',
                'tiene_fra_estatal'             => 7,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_7.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 7.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 7',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 7.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 7.',
                'id_registro_actualizacion'     => 7,
            ],
            [
                'id_fraccion_general'           => 8,
                'id_articulo_general'           => 8,
                'id_articulo_estatal'           => 8,
                'fraccion_general'              => 'Fraccion general f 8',
                'tiene_fra_general'             => 8,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_8.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_8.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 8',
                'tiene_fra_estatal'             => 8,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_8.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 8.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 8',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 8.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 8.',
                'id_registro_actualizacion'     => 8,
            ],
            [
                'id_fraccion_general'           => 9,
                'id_articulo_general'           => 9,
                'id_articulo_estatal'           => 9,
                'fraccion_general'              => 'Fraccion general f 9',
                'tiene_fra_general'             => 9,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_9.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_9.pdf',
                'fraccion_estatal'              => 'Fraccion estatal f 9',
                'tiene_fra_estatal'             => 9,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_9.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 9.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 9',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 9.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 9.',
                'id_registro_actualizacion'     => 9,
            ],
            [
                'id_fraccion_general'           => 10,
                'id_articulo_general'           => 10,
                'id_articulo_estatal'           => 10,
                'fraccion_general'              => 'Fraccion general 10',
                'tiene_fra_general'             => 10,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_10.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_10.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 10',
                'tiene_fra_estatal'             => 10,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_10.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 10.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 10',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 10.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 10.',
                'id_registro_actualizacion'     => 10,
            ],
            [
                'id_fraccion_general'           => 11,
                'id_articulo_general'           => 11,
                'id_articulo_estatal'           => 11,
                'fraccion_general'              => 'Fraccion general 11',
                'tiene_fra_general'             => 11,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_11.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_11.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 11',
                'tiene_fra_estatal'             => 11,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_11.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 11.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 11',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 11.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 11.',
                'id_registro_actualizacion'     => 11,
            ],
            [
                'id_fraccion_general'           => 12,
                'id_articulo_general'           => 12,
                'id_articulo_estatal'           => 12,
                'fraccion_general'              => 'Fraccion general 12',
                'tiene_fra_general'             => 12,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_12.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_12.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 12',
                'tiene_fra_estatal'             => 12,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_12.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 12.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 12',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 12.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 12.',
                'id_registro_actualizacion'     => 12,
            ],
            [
                'id_fraccion_general'           => 13,
                'id_articulo_general'           => 13,
                'id_articulo_estatal'           => 13,
                'fraccion_general'              => 'Fraccion general 13',
                'tiene_fra_general'             => 13,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_13.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_13.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 13',
                'tiene_fra_estatal'             => 13,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_13.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 13.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 13',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 13.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 13.',
                'id_registro_actualizacion'     => 13,
            ],
            [
                'id_fraccion_general'           => 14,
                'id_articulo_general'           => 14,
                'id_articulo_estatal'           => 14,
                'fraccion_general'              => 'Fraccion general 14',
                'tiene_fra_general'             => 14,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_14.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_14.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 14',
                'tiene_fra_estatal'             => 14,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_14.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 14.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 14',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 14.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 14.',
                'id_registro_actualizacion'     => 14,
            ],
            [
                'id_fraccion_general'           => 15,
                'id_articulo_general'           => 15,
                'id_articulo_estatal'           => 15,
                'fraccion_general'              => 'Fraccion general 15',
                'tiene_fra_general'             => 15,
                'pdf_general'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_15.pdf',
                'pdf_general_2'                 => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_15.pdf',
                'fraccion_estatal'              => 'Fraccion estatal 15',
                'tiene_fra_estatal'             => 15,
                'pdf_estatal'                   => 'documentos/ipomex_fracciones_generales/ipomex_fracciones_generales_15.pdf',
                'denominacion_fraccion'         => 'Denominacion fraccion de fracciones generales: registro de prueba número 15.',
                'periodo_ley_general'           => 'Periodo ley general fracciones generales 15',
                'observacion_inf_general'       => 'Observacion inf general de fracciones generales: registro de prueba número 15.',
                'periodo_actualizacion_general' => 'Periodo actualizacion general de fracciones generales: registro de prueba número 15.',
                'id_registro_actualizacion'     => 15,
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
