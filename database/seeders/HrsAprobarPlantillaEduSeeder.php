<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_aprobar_plantilla_edu`.
 */
class HrsAprobarPlantillaEduSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_aprobar_plantilla_edu` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'hrs_aprobar_plantilla_edu';

        $llaves = [
            ['id_aprobar_plantilla_edu'],
        ];

        $registros = [
            [
                'id_aprobar_plantilla_edu' => 1,
                'id_horario'               => 1,
                'hrs_clase'                => 1,
                'vinculacion'              => 1,
                'investigacion'            => 1,
                'gestion'                  => 1,
                'tutorias'                 => 1,
                'residencia'               => 1,
                'created_at'               => '2026-01-05 09:00:00',
                'updated_at'               => '2026-01-05 09:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 2,
                'id_horario'               => 2,
                'hrs_clase'                => 2,
                'vinculacion'              => 2,
                'investigacion'            => 2,
                'gestion'                  => 2,
                'tutorias'                 => 2,
                'residencia'               => 2,
                'created_at'               => '2026-01-14 10:00:00',
                'updated_at'               => '2026-01-14 10:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 3,
                'id_horario'               => 3,
                'hrs_clase'                => 3,
                'vinculacion'              => 3,
                'investigacion'            => 3,
                'gestion'                  => 3,
                'tutorias'                 => 3,
                'residencia'               => 3,
                'created_at'               => '2026-01-23 11:00:00',
                'updated_at'               => '2026-01-23 11:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 4,
                'id_horario'               => 4,
                'hrs_clase'                => 4,
                'vinculacion'              => 4,
                'investigacion'            => 4,
                'gestion'                  => 4,
                'tutorias'                 => 4,
                'residencia'               => 4,
                'created_at'               => '2026-02-01 12:00:00',
                'updated_at'               => '2026-02-01 12:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 5,
                'id_horario'               => 5,
                'hrs_clase'                => 5,
                'vinculacion'              => 5,
                'investigacion'            => 5,
                'gestion'                  => 5,
                'tutorias'                 => 5,
                'residencia'               => 5,
                'created_at'               => '2026-02-10 13:00:00',
                'updated_at'               => '2026-02-10 13:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 6,
                'id_horario'               => 6,
                'hrs_clase'                => 6,
                'vinculacion'              => 6,
                'investigacion'            => 6,
                'gestion'                  => 6,
                'tutorias'                 => 6,
                'residencia'               => 6,
                'created_at'               => '2026-02-19 14:00:00',
                'updated_at'               => '2026-02-19 14:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 7,
                'id_horario'               => 7,
                'hrs_clase'                => 7,
                'vinculacion'              => 7,
                'investigacion'            => 7,
                'gestion'                  => 7,
                'tutorias'                 => 7,
                'residencia'               => 7,
                'created_at'               => '2026-02-28 15:00:00',
                'updated_at'               => '2026-02-28 15:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 8,
                'id_horario'               => 8,
                'hrs_clase'                => 8,
                'vinculacion'              => 8,
                'investigacion'            => 8,
                'gestion'                  => 8,
                'tutorias'                 => 8,
                'residencia'               => 8,
                'created_at'               => '2026-03-09 16:00:00',
                'updated_at'               => '2026-03-09 16:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 9,
                'id_horario'               => 9,
                'hrs_clase'                => 9,
                'vinculacion'              => 9,
                'investigacion'            => 9,
                'gestion'                  => 9,
                'tutorias'                 => 9,
                'residencia'               => 9,
                'created_at'               => '2026-03-18 08:00:00',
                'updated_at'               => '2026-03-18 08:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 10,
                'id_horario'               => 10,
                'hrs_clase'                => 10,
                'vinculacion'              => 10,
                'investigacion'            => 10,
                'gestion'                  => 10,
                'tutorias'                 => 10,
                'residencia'               => 10,
                'created_at'               => '2026-03-27 09:00:00',
                'updated_at'               => '2026-03-27 09:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 11,
                'id_horario'               => 11,
                'hrs_clase'                => 11,
                'vinculacion'              => 11,
                'investigacion'            => 11,
                'gestion'                  => 11,
                'tutorias'                 => 11,
                'residencia'               => 11,
                'created_at'               => '2026-04-05 10:00:00',
                'updated_at'               => '2026-04-05 10:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 12,
                'id_horario'               => 12,
                'hrs_clase'                => 12,
                'vinculacion'              => 12,
                'investigacion'            => 12,
                'gestion'                  => 12,
                'tutorias'                 => 12,
                'residencia'               => 12,
                'created_at'               => '2026-04-14 11:00:00',
                'updated_at'               => '2026-04-14 11:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 13,
                'id_horario'               => 13,
                'hrs_clase'                => 13,
                'vinculacion'              => 13,
                'investigacion'            => 13,
                'gestion'                  => 13,
                'tutorias'                 => 13,
                'residencia'               => 13,
                'created_at'               => '2026-04-23 12:00:00',
                'updated_at'               => '2026-04-23 12:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 14,
                'id_horario'               => 14,
                'hrs_clase'                => 14,
                'vinculacion'              => 14,
                'investigacion'            => 14,
                'gestion'                  => 14,
                'tutorias'                 => 14,
                'residencia'               => 14,
                'created_at'               => '2026-05-02 13:00:00',
                'updated_at'               => '2026-05-02 13:00:00',
            ],
            [
                'id_aprobar_plantilla_edu' => 15,
                'id_horario'               => 15,
                'hrs_clase'                => 15,
                'vinculacion'              => 15,
                'investigacion'            => 15,
                'gestion'                  => 15,
                'tutorias'                 => 15,
                'residencia'               => 15,
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
