<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `in_bitacora_periodo`.
 */
class InBitacoraPeriodoSeeder extends Seeder
{
    /**
     * Pobla la tabla `in_bitacora_periodo` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            CalUnidadesSeeder::class,
            GnralGruposSeeder::class,
            GnralPeriodosSeeder::class,
        ]);

        $tabla = 'in_bitacora_periodo';

        $llaves = [
            ['id_bitacora_periodo'],
        ];

        $registros = [
            [
                'id_bitacora_periodo' => 1,
                'id_unidad'           => 1,
                'id_nivel'            => 1,
                'id_grupo'            => 1,
                'fecha_anterior'      => '2026-01-05',
                'fecha_registrada'    => '2026-01-05',
                'fecha_modificacion'  => '2026-01-05 09:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 1,
            ],
            [
                'id_bitacora_periodo' => 2,
                'id_unidad'           => 2,
                'id_nivel'            => 2,
                'id_grupo'            => 2,
                'fecha_anterior'      => '2026-01-14',
                'fecha_registrada'    => '2026-01-14',
                'fecha_modificacion'  => '2026-01-14 10:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 2,
            ],
            [
                'id_bitacora_periodo' => 3,
                'id_unidad'           => 3,
                'id_nivel'            => 3,
                'id_grupo'            => 3,
                'fecha_anterior'      => '2026-01-23',
                'fecha_registrada'    => '2026-01-23',
                'fecha_modificacion'  => '2026-01-23 11:00:00',
                'id_periodo'          => 3,
                'id_profesor'         => 3,
            ],
            [
                'id_bitacora_periodo' => 4,
                'id_unidad'           => 4,
                'id_nivel'            => 4,
                'id_grupo'            => 4,
                'fecha_anterior'      => '2026-02-01',
                'fecha_registrada'    => '2026-02-01',
                'fecha_modificacion'  => '2026-02-01 12:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 4,
            ],
            [
                'id_bitacora_periodo' => 5,
                'id_unidad'           => 5,
                'id_nivel'            => 5,
                'id_grupo'            => 5,
                'fecha_anterior'      => '2026-02-10',
                'fecha_registrada'    => '2026-02-10',
                'fecha_modificacion'  => '2026-02-10 13:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 5,
            ],
            [
                'id_bitacora_periodo' => 6,
                'id_unidad'           => 6,
                'id_nivel'            => 6,
                'id_grupo'            => 6,
                'fecha_anterior'      => '2026-02-19',
                'fecha_registrada'    => '2026-02-19',
                'fecha_modificacion'  => '2026-02-19 14:00:00',
                'id_periodo'          => 6,
                'id_profesor'         => 6,
            ],
            [
                'id_bitacora_periodo' => 7,
                'id_unidad'           => 7,
                'id_nivel'            => 7,
                'id_grupo'            => 7,
                'fecha_anterior'      => '2026-02-28',
                'fecha_registrada'    => '2026-02-28',
                'fecha_modificacion'  => '2026-02-28 15:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 7,
            ],
            [
                'id_bitacora_periodo' => 8,
                'id_unidad'           => 8,
                'id_nivel'            => 8,
                'id_grupo'            => 8,
                'fecha_anterior'      => '2026-03-09',
                'fecha_registrada'    => '2026-03-09',
                'fecha_modificacion'  => '2026-03-09 16:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 8,
            ],
            [
                'id_bitacora_periodo' => 9,
                'id_unidad'           => 1,
                'id_nivel'            => 9,
                'id_grupo'            => 9,
                'fecha_anterior'      => '2026-03-18',
                'fecha_registrada'    => '2026-03-18',
                'fecha_modificacion'  => '2026-03-18 08:00:00',
                'id_periodo'          => 9,
                'id_profesor'         => 9,
            ],
            [
                'id_bitacora_periodo' => 10,
                'id_unidad'           => 2,
                'id_nivel'            => 10,
                'id_grupo'            => 10,
                'fecha_anterior'      => '2026-03-27',
                'fecha_registrada'    => '2026-03-27',
                'fecha_modificacion'  => '2026-03-27 09:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 10,
            ],
            [
                'id_bitacora_periodo' => 11,
                'id_unidad'           => 3,
                'id_nivel'            => 11,
                'id_grupo'            => 11,
                'fecha_anterior'      => '2026-04-05',
                'fecha_registrada'    => '2026-04-05',
                'fecha_modificacion'  => '2026-04-05 10:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 11,
            ],
            [
                'id_bitacora_periodo' => 12,
                'id_unidad'           => 4,
                'id_nivel'            => 12,
                'id_grupo'            => 12,
                'fecha_anterior'      => '2026-04-14',
                'fecha_registrada'    => '2026-04-14',
                'fecha_modificacion'  => '2026-04-14 11:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 12,
            ],
            [
                'id_bitacora_periodo' => 13,
                'id_unidad'           => 5,
                'id_nivel'            => 13,
                'id_grupo'            => 13,
                'fecha_anterior'      => '2026-04-23',
                'fecha_registrada'    => '2026-04-23',
                'fecha_modificacion'  => '2026-04-23 12:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 13,
            ],
            [
                'id_bitacora_periodo' => 14,
                'id_unidad'           => 6,
                'id_nivel'            => 14,
                'id_grupo'            => 14,
                'fecha_anterior'      => '2026-05-02',
                'fecha_registrada'    => '2026-05-02',
                'fecha_modificacion'  => '2026-05-02 13:00:00',
                'id_periodo'          => 12,
                'id_profesor'         => 14,
            ],
            [
                'id_bitacora_periodo' => 15,
                'id_unidad'           => 7,
                'id_nivel'            => 15,
                'id_grupo'            => 15,
                'fecha_anterior'      => '2026-05-11',
                'fecha_registrada'    => '2026-05-11',
                'fecha_modificacion'  => '2026-05-11 14:00:00',
                'id_periodo'          => 15,
                'id_profesor'         => 15,
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
