<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `aud_objetivo_auditoria`.
 */
class AudObjetivoAuditoriaSeeder extends Seeder
{
    /**
     * Pobla la tabla `aud_objetivo_auditoria` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            AudObjetivoSeeder::class,
            AudProgramaSeeder::class,
        ]);

        $tabla = 'aud_objetivo_auditoria';

        $llaves = [
            ['id_objetivo_programa'],
        ];

        $registros = [
            [
                'id_objetivo_programa' => 1,
                'id_objetivo'          => 1,
                'id_programa'          => 1,
                'created_at'           => '2026-01-05',
                'updated_at'           => '2026-01-05',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 2,
                'id_objetivo'          => 2,
                'id_programa'          => 2,
                'created_at'           => '2026-01-14',
                'updated_at'           => '2026-01-14',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 3,
                'id_objetivo'          => 3,
                'id_programa'          => 3,
                'created_at'           => '2026-01-23',
                'updated_at'           => '2026-01-23',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 4,
                'id_objetivo'          => 4,
                'id_programa'          => 4,
                'created_at'           => '2026-02-01',
                'updated_at'           => '2026-02-01',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 5,
                'id_objetivo'          => 5,
                'id_programa'          => 5,
                'created_at'           => '2026-02-10',
                'updated_at'           => '2026-02-10',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 6,
                'id_objetivo'          => 6,
                'id_programa'          => 6,
                'created_at'           => '2026-02-19',
                'updated_at'           => '2026-02-19',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 7,
                'id_objetivo'          => 7,
                'id_programa'          => 7,
                'created_at'           => '2026-02-28',
                'updated_at'           => '2026-02-28',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 8,
                'id_objetivo'          => 8,
                'id_programa'          => 8,
                'created_at'           => '2026-03-09',
                'updated_at'           => '2026-03-09',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 9,
                'id_objetivo'          => 9,
                'id_programa'          => 9,
                'created_at'           => '2026-03-18',
                'updated_at'           => '2026-03-18',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 10,
                'id_objetivo'          => 10,
                'id_programa'          => 10,
                'created_at'           => '2026-03-27',
                'updated_at'           => '2026-03-27',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 11,
                'id_objetivo'          => 11,
                'id_programa'          => 11,
                'created_at'           => '2026-04-05',
                'updated_at'           => '2026-04-05',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 12,
                'id_objetivo'          => 12,
                'id_programa'          => 12,
                'created_at'           => '2026-04-14',
                'updated_at'           => '2026-04-14',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 13,
                'id_objetivo'          => 13,
                'id_programa'          => 13,
                'created_at'           => '2026-04-23',
                'updated_at'           => '2026-04-23',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 14,
                'id_objetivo'          => 14,
                'id_programa'          => 14,
                'created_at'           => '2026-05-02',
                'updated_at'           => '2026-05-02',
                'deleted_at'           => null,
            ],
            [
                'id_objetivo_programa' => 15,
                'id_objetivo'          => 15,
                'id_programa'          => 15,
                'created_at'           => '2026-05-11',
                'updated_at'           => '2026-05-11',
                'deleted_at'           => null,
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
