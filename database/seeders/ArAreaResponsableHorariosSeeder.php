<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_area_responsable_horarios`.
 */
class ArAreaResponsableHorariosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_area_responsable_horarios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArAreaResponsablesPeriodoSeeder::class,
            ArAreasAtencionSeeder::class,
            GnralPeriodosSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_area_responsable_horarios';

        $llaves = [
            ['id_area_responsable_horario'],
        ];

        $registros = [
            [
                'id_area_responsable_horario' => 1,
                'id_area_responsable_periodo' => 1,
                'id_area_atencion'            => 1,
                'id_periodo'                  => 12,
                'id_personal'                 => 1,
                'dia_semana'                  => 1,
                'hora_inicio'                 => '08:00:00',
                'hora_fin'                    => '08:00:00',
                'lugar'                       => 'Valle De Bravo',
                'cupo'                        => 1,
                'activo'                      => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
            ],
            [
                'id_area_responsable_horario' => 2,
                'id_area_responsable_periodo' => 2,
                'id_area_atencion'            => 2,
                'id_periodo'                  => 12,
                'id_personal'                 => 2,
                'dia_semana'                  => 2,
                'hora_inicio'                 => '09:00:00',
                'hora_fin'                    => '09:00:00',
                'lugar'                       => 'Amanalco',
                'cupo'                        => 2,
                'activo'                      => 1,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
            ],
            [
                'id_area_responsable_horario' => 3,
                'id_area_responsable_periodo' => 3,
                'id_area_atencion'            => 3,
                'id_periodo'                  => 3,
                'id_personal'                 => 3,
                'dia_semana'                  => 3,
                'hora_inicio'                 => '10:00:00',
                'hora_fin'                    => '10:00:00',
                'lugar'                       => 'Donato Guerra',
                'cupo'                        => 3,
                'activo'                      => 1,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
            ],
            [
                'id_area_responsable_horario' => 4,
                'id_area_responsable_periodo' => 4,
                'id_area_atencion'            => 4,
                'id_periodo'                  => 12,
                'id_personal'                 => 4,
                'dia_semana'                  => 4,
                'hora_inicio'                 => '11:00:00',
                'hora_fin'                    => '11:00:00',
                'lugar'                       => 'Villa De Allende',
                'cupo'                        => 4,
                'activo'                      => 1,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
            ],
            [
                'id_area_responsable_horario' => 5,
                'id_area_responsable_periodo' => 5,
                'id_area_atencion'            => 5,
                'id_periodo'                  => 12,
                'id_personal'                 => 5,
                'dia_semana'                  => 5,
                'hora_inicio'                 => '12:00:00',
                'hora_fin'                    => '12:00:00',
                'lugar'                       => 'Temascaltepec',
                'cupo'                        => 5,
                'activo'                      => 1,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
            ],
            [
                'id_area_responsable_horario' => 6,
                'id_area_responsable_periodo' => 6,
                'id_area_atencion'            => 6,
                'id_periodo'                  => 6,
                'id_personal'                 => 6,
                'dia_semana'                  => 1,
                'hora_inicio'                 => '13:00:00',
                'hora_fin'                    => '13:00:00',
                'lugar'                       => 'Ixtapan Del Oro',
                'cupo'                        => 6,
                'activo'                      => 1,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
            ],
            [
                'id_area_responsable_horario' => 7,
                'id_area_responsable_periodo' => 7,
                'id_area_atencion'            => 7,
                'id_periodo'                  => 12,
                'id_personal'                 => 7,
                'dia_semana'                  => 2,
                'hora_inicio'                 => '14:00:00',
                'hora_fin'                    => '14:00:00',
                'lugar'                       => 'Santo Tomás',
                'cupo'                        => 7,
                'activo'                      => 1,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
            ],
            [
                'id_area_responsable_horario' => 8,
                'id_area_responsable_periodo' => 8,
                'id_area_atencion'            => 8,
                'id_periodo'                  => 12,
                'id_personal'                 => 8,
                'dia_semana'                  => 3,
                'hora_inicio'                 => '15:00:00',
                'hora_fin'                    => '15:00:00',
                'lugar'                       => 'Otzoloapan',
                'cupo'                        => 8,
                'activo'                      => 1,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
            ],
            [
                'id_area_responsable_horario' => 9,
                'id_area_responsable_periodo' => 9,
                'id_area_atencion'            => 9,
                'id_periodo'                  => 9,
                'id_personal'                 => 9,
                'dia_semana'                  => 4,
                'hora_inicio'                 => '16:00:00',
                'hora_fin'                    => '16:00:00',
                'lugar'                       => 'Zacazonapan',
                'cupo'                        => 9,
                'activo'                      => 1,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
            ],
            [
                'id_area_responsable_horario' => 10,
                'id_area_responsable_periodo' => 10,
                'id_area_atencion'            => 10,
                'id_periodo'                  => 12,
                'id_personal'                 => 10,
                'dia_semana'                  => 5,
                'hora_inicio'                 => '17:00:00',
                'hora_fin'                    => '17:00:00',
                'lugar'                       => 'Villa Victoria',
                'cupo'                        => 10,
                'activo'                      => 1,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
            ],
            [
                'id_area_responsable_horario' => 11,
                'id_area_responsable_periodo' => 11,
                'id_area_atencion'            => 11,
                'id_periodo'                  => 12,
                'id_personal'                 => 11,
                'dia_semana'                  => 1,
                'hora_inicio'                 => '18:00:00',
                'hora_fin'                    => '18:00:00',
                'lugar'                       => 'Almoloya De Juárez',
                'cupo'                        => 11,
                'activo'                      => 1,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
            ],
            [
                'id_area_responsable_horario' => 12,
                'id_area_responsable_periodo' => 12,
                'id_area_atencion'            => 12,
                'id_periodo'                  => 12,
                'id_personal'                 => 12,
                'dia_semana'                  => 2,
                'hora_inicio'                 => '07:00:00',
                'hora_fin'                    => '07:00:00',
                'lugar'                       => 'Toluca',
                'cupo'                        => 12,
                'activo'                      => 1,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
            ],
            [
                'id_area_responsable_horario' => 13,
                'id_area_responsable_periodo' => 13,
                'id_area_atencion'            => 13,
                'id_periodo'                  => 12,
                'id_personal'                 => 13,
                'dia_semana'                  => 3,
                'hora_inicio'                 => '08:00:00',
                'hora_fin'                    => '08:00:00',
                'lugar'                       => 'Zinacantepec',
                'cupo'                        => 13,
                'activo'                      => 1,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
            ],
            [
                'id_area_responsable_horario' => 14,
                'id_area_responsable_periodo' => 14,
                'id_area_atencion'            => 14,
                'id_periodo'                  => 12,
                'id_personal'                 => 14,
                'dia_semana'                  => 4,
                'hora_inicio'                 => '09:00:00',
                'hora_fin'                    => '09:00:00',
                'lugar'                       => 'Tejupilco',
                'cupo'                        => 14,
                'activo'                      => 1,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
            ],
            [
                'id_area_responsable_horario' => 15,
                'id_area_responsable_periodo' => 15,
                'id_area_atencion'            => 15,
                'id_periodo'                  => 15,
                'id_personal'                 => 15,
                'dia_semana'                  => 5,
                'hora_inicio'                 => '10:00:00',
                'hora_fin'                    => '10:00:00',
                'lugar'                       => 'San José Del Rincón',
                'cupo'                        => 15,
                'activo'                      => 1,
                'created_at'                  => '2026-05-11 14:00:00',
                'updated_at'                  => '2026-05-11 14:00:00',
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
