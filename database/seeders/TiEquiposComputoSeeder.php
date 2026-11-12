<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ti_equipos_computo`.
 */
class TiEquiposComputoSeeder extends Seeder
{
    /**
     * Pobla la tabla `ti_equipos_computo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            TiRegDatosAlumSeeder::class,
        ]);

        $tabla = 'ti_equipos_computo';

        $llaves = [
            ['id_equipo_computo'],
        ];

        $registros = [
            [
                'id_equipo_computo' => 1,
                'id_reg_dato_alum'  => 1,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 1.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 1.',
                'folio_fiscal'      => 'TESVB-2026-0001',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 1.',
                'fecha_registro'    => '2026-01-05',
            ],
            [
                'id_equipo_computo' => 2,
                'id_reg_dato_alum'  => 2,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 2.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 2.',
                'folio_fiscal'      => 'TESVB-2026-0002',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 2.',
                'fecha_registro'    => '2026-01-14',
            ],
            [
                'id_equipo_computo' => 3,
                'id_reg_dato_alum'  => 3,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 3.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 3.',
                'folio_fiscal'      => 'TESVB-2026-0003',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 3.',
                'fecha_registro'    => '2026-01-23',
            ],
            [
                'id_equipo_computo' => 4,
                'id_reg_dato_alum'  => 4,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 4.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 4.',
                'folio_fiscal'      => 'TESVB-2026-0004',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 4.',
                'fecha_registro'    => '2026-02-01',
            ],
            [
                'id_equipo_computo' => 5,
                'id_reg_dato_alum'  => 5,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 5.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 5.',
                'folio_fiscal'      => 'TESVB-2026-0005',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 5.',
                'fecha_registro'    => '2026-02-10',
            ],
            [
                'id_equipo_computo' => 6,
                'id_reg_dato_alum'  => 6,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 6.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 6.',
                'folio_fiscal'      => 'TESVB-2026-0006',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 6.',
                'fecha_registro'    => '2026-02-19',
            ],
            [
                'id_equipo_computo' => 7,
                'id_reg_dato_alum'  => 7,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 7.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 7.',
                'folio_fiscal'      => 'TESVB-2026-0007',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 7.',
                'fecha_registro'    => '2026-02-28',
            ],
            [
                'id_equipo_computo' => 8,
                'id_reg_dato_alum'  => 8,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 8.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 8.',
                'folio_fiscal'      => 'TESVB-2026-0008',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 8.',
                'fecha_registro'    => '2026-03-09',
            ],
            [
                'id_equipo_computo' => 9,
                'id_reg_dato_alum'  => 9,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 9.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 9.',
                'folio_fiscal'      => 'TESVB-2026-0009',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 9.',
                'fecha_registro'    => '2026-03-18',
            ],
            [
                'id_equipo_computo' => 10,
                'id_reg_dato_alum'  => 10,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 10.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 10.',
                'folio_fiscal'      => 'TESVB-2026-0010',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 10.',
                'fecha_registro'    => '2026-03-27',
            ],
            [
                'id_equipo_computo' => 11,
                'id_reg_dato_alum'  => 11,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 11.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 11.',
                'folio_fiscal'      => 'TESVB-2026-0011',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 11.',
                'fecha_registro'    => '2026-04-05',
            ],
            [
                'id_equipo_computo' => 12,
                'id_reg_dato_alum'  => 12,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 12.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 12.',
                'folio_fiscal'      => 'TESVB-2026-0012',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 12.',
                'fecha_registro'    => '2026-04-14',
            ],
            [
                'id_equipo_computo' => 13,
                'id_reg_dato_alum'  => 13,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 13.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 13.',
                'folio_fiscal'      => 'TESVB-2026-0013',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 13.',
                'fecha_registro'    => '2026-04-23',
            ],
            [
                'id_equipo_computo' => 14,
                'id_reg_dato_alum'  => 14,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 14.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 14.',
                'folio_fiscal'      => 'TESVB-2026-0014',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 14.',
                'fecha_registro'    => '2026-05-02',
            ],
            [
                'id_equipo_computo' => 15,
                'id_reg_dato_alum'  => 15,
                'nombre_equipo'     => 'Nombre equipo de equipos computo: registro de prueba número 15.',
                'descripcion'       => 'Descripcion de equipos computo: registro de prueba número 15.',
                'folio_fiscal'      => 'TESVB-2026-0015',
                'nombre_tienda'     => 'Nombre tienda de equipos computo: registro de prueba número 15.',
                'fecha_registro'    => '2026-05-11',
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
