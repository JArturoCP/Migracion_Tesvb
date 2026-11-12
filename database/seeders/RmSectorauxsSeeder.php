<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `rm_sectorauxs`.
 */
class RmSectorauxsSeeder extends Seeder
{
    /**
     * Pobla la tabla `rm_sectorauxs` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralUnidadAdministrativaSeeder::class,
        ]);

        $tabla = 'rm_sectorauxs';

        $llaves = [
            ['id'],
            ['csp'],
        ];

        $registros = [
            [
                'id'         => 1,
                'nombre'     => 'Nombre sectorauxs 1',
                'csp'        => 'CLV-001',
                'puesto'     => 'Puesto sectorauxs 1',
                'fechain'    => '2026-01-05',
                'id_area'    => 1,
                'condicion'  => 1,
                'created_at' => '2026-01-05 09:00:00',
                'updated_at' => '2026-01-05 09:00:00',
            ],
            [
                'id'         => 2,
                'nombre'     => 'Nombre sectorauxs 2',
                'csp'        => 'CLV-002',
                'puesto'     => 'Puesto sectorauxs 2',
                'fechain'    => '2026-01-14',
                'id_area'    => 2,
                'condicion'  => 1,
                'created_at' => '2026-01-14 10:00:00',
                'updated_at' => '2026-01-14 10:00:00',
            ],
            [
                'id'         => 3,
                'nombre'     => 'Nombre sectorauxs 3',
                'csp'        => 'CLV-003',
                'puesto'     => 'Puesto sectorauxs 3',
                'fechain'    => '2026-01-23',
                'id_area'    => 3,
                'condicion'  => 1,
                'created_at' => '2026-01-23 11:00:00',
                'updated_at' => '2026-01-23 11:00:00',
            ],
            [
                'id'         => 4,
                'nombre'     => 'Nombre sectorauxs 4',
                'csp'        => 'CLV-004',
                'puesto'     => 'Puesto sectorauxs 4',
                'fechain'    => '2026-02-01',
                'id_area'    => 4,
                'condicion'  => 1,
                'created_at' => '2026-02-01 12:00:00',
                'updated_at' => '2026-02-01 12:00:00',
            ],
            [
                'id'         => 5,
                'nombre'     => 'Nombre sectorauxs 5',
                'csp'        => 'CLV-005',
                'puesto'     => 'Puesto sectorauxs 5',
                'fechain'    => '2026-02-10',
                'id_area'    => 5,
                'condicion'  => 1,
                'created_at' => '2026-02-10 13:00:00',
                'updated_at' => '2026-02-10 13:00:00',
            ],
            [
                'id'         => 6,
                'nombre'     => 'Nombre sectorauxs 6',
                'csp'        => 'CLV-006',
                'puesto'     => 'Puesto sectorauxs 6',
                'fechain'    => '2026-02-19',
                'id_area'    => 6,
                'condicion'  => 1,
                'created_at' => '2026-02-19 14:00:00',
                'updated_at' => '2026-02-19 14:00:00',
            ],
            [
                'id'         => 7,
                'nombre'     => 'Nombre sectorauxs 7',
                'csp'        => 'CLV-007',
                'puesto'     => 'Puesto sectorauxs 7',
                'fechain'    => '2026-02-28',
                'id_area'    => 7,
                'condicion'  => 1,
                'created_at' => '2026-02-28 15:00:00',
                'updated_at' => '2026-02-28 15:00:00',
            ],
            [
                'id'         => 8,
                'nombre'     => 'Nombre sectorauxs 8',
                'csp'        => 'CLV-008',
                'puesto'     => 'Puesto sectorauxs 8',
                'fechain'    => '2026-03-09',
                'id_area'    => 8,
                'condicion'  => 1,
                'created_at' => '2026-03-09 16:00:00',
                'updated_at' => '2026-03-09 16:00:00',
            ],
            [
                'id'         => 9,
                'nombre'     => 'Nombre sectorauxs 9',
                'csp'        => 'CLV-009',
                'puesto'     => 'Puesto sectorauxs 9',
                'fechain'    => '2026-03-18',
                'id_area'    => 9,
                'condicion'  => 1,
                'created_at' => '2026-03-18 08:00:00',
                'updated_at' => '2026-03-18 08:00:00',
            ],
            [
                'id'         => 10,
                'nombre'     => 'Nombre sectorauxs 10',
                'csp'        => 'CLV-010',
                'puesto'     => 'Puesto sectorauxs 10',
                'fechain'    => '2026-03-27',
                'id_area'    => 10,
                'condicion'  => 1,
                'created_at' => '2026-03-27 09:00:00',
                'updated_at' => '2026-03-27 09:00:00',
            ],
            [
                'id'         => 11,
                'nombre'     => 'Nombre sectorauxs 11',
                'csp'        => 'CLV-011',
                'puesto'     => 'Puesto sectorauxs 11',
                'fechain'    => '2026-04-05',
                'id_area'    => 11,
                'condicion'  => 1,
                'created_at' => '2026-04-05 10:00:00',
                'updated_at' => '2026-04-05 10:00:00',
            ],
            [
                'id'         => 12,
                'nombre'     => 'Nombre sectorauxs 12',
                'csp'        => 'CLV-012',
                'puesto'     => 'Puesto sectorauxs 12',
                'fechain'    => '2026-04-14',
                'id_area'    => 12,
                'condicion'  => 1,
                'created_at' => '2026-04-14 11:00:00',
                'updated_at' => '2026-04-14 11:00:00',
            ],
            [
                'id'         => 13,
                'nombre'     => 'Nombre sectorauxs 13',
                'csp'        => 'CLV-013',
                'puesto'     => 'Puesto sectorauxs 13',
                'fechain'    => '2026-04-23',
                'id_area'    => 13,
                'condicion'  => 1,
                'created_at' => '2026-04-23 12:00:00',
                'updated_at' => '2026-04-23 12:00:00',
            ],
            [
                'id'         => 14,
                'nombre'     => 'Nombre sectorauxs 14',
                'csp'        => 'CLV-014',
                'puesto'     => 'Puesto sectorauxs 14',
                'fechain'    => '2026-05-02',
                'id_area'    => 14,
                'condicion'  => 1,
                'created_at' => '2026-05-02 13:00:00',
                'updated_at' => '2026-05-02 13:00:00',
            ],
            [
                'id'         => 15,
                'nombre'     => 'Nombre sectorauxs 15',
                'csp'        => 'CLV-015',
                'puesto'     => 'Puesto sectorauxs 15',
                'fechain'    => '2026-05-11',
                'id_area'    => 15,
                'condicion'  => 1,
                'created_at' => '2026-05-11 14:00:00',
                'updated_at' => '2026-05-11 14:00:00',
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
