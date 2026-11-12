<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_reportes`.
 */
class AudReportesSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_reportes` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudAgendaSeeder::class,
        ]);

        $tabla = 'aud_reportes';

        $llaves = [
            ['id_reporte'],
        ];

        $registros = [
            [
                'id_reporte'  => 1,
                'id_agenda'   => 1,
                'id_auditado' => 1,
                'fecha'       => '2026-01-05',
                'created_at'  => '2026-01-05',
                'updated_at'  => '2026-01-05',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 2,
                'id_agenda'   => 2,
                'id_auditado' => 2,
                'fecha'       => '2026-01-14',
                'created_at'  => '2026-01-14',
                'updated_at'  => '2026-01-14',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 3,
                'id_agenda'   => 3,
                'id_auditado' => 3,
                'fecha'       => '2026-01-23',
                'created_at'  => '2026-01-23',
                'updated_at'  => '2026-01-23',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 4,
                'id_agenda'   => 4,
                'id_auditado' => 4,
                'fecha'       => '2026-02-01',
                'created_at'  => '2026-02-01',
                'updated_at'  => '2026-02-01',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 5,
                'id_agenda'   => 5,
                'id_auditado' => 5,
                'fecha'       => '2026-02-10',
                'created_at'  => '2026-02-10',
                'updated_at'  => '2026-02-10',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 6,
                'id_agenda'   => 6,
                'id_auditado' => 6,
                'fecha'       => '2026-02-19',
                'created_at'  => '2026-02-19',
                'updated_at'  => '2026-02-19',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 7,
                'id_agenda'   => 7,
                'id_auditado' => 7,
                'fecha'       => '2026-02-28',
                'created_at'  => '2026-02-28',
                'updated_at'  => '2026-02-28',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 8,
                'id_agenda'   => 8,
                'id_auditado' => 8,
                'fecha'       => '2026-03-09',
                'created_at'  => '2026-03-09',
                'updated_at'  => '2026-03-09',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 9,
                'id_agenda'   => 9,
                'id_auditado' => 9,
                'fecha'       => '2026-03-18',
                'created_at'  => '2026-03-18',
                'updated_at'  => '2026-03-18',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 10,
                'id_agenda'   => 10,
                'id_auditado' => 10,
                'fecha'       => '2026-03-27',
                'created_at'  => '2026-03-27',
                'updated_at'  => '2026-03-27',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 11,
                'id_agenda'   => 11,
                'id_auditado' => 11,
                'fecha'       => '2026-04-05',
                'created_at'  => '2026-04-05',
                'updated_at'  => '2026-04-05',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 12,
                'id_agenda'   => 12,
                'id_auditado' => 12,
                'fecha'       => '2026-04-14',
                'created_at'  => '2026-04-14',
                'updated_at'  => '2026-04-14',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 13,
                'id_agenda'   => 13,
                'id_auditado' => 13,
                'fecha'       => '2026-04-23',
                'created_at'  => '2026-04-23',
                'updated_at'  => '2026-04-23',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 14,
                'id_agenda'   => 14,
                'id_auditado' => 14,
                'fecha'       => '2026-05-02',
                'created_at'  => '2026-05-02',
                'updated_at'  => '2026-05-02',
                'deleted_at'  => null,
            ],
            [
                'id_reporte'  => 15,
                'id_agenda'   => 15,
                'id_auditado' => 15,
                'fecha'       => '2026-05-11',
                'created_at'  => '2026-05-11',
                'updated_at'  => '2026-05-11',
                'deleted_at'  => null,
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
