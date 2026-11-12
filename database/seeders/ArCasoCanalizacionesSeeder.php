<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_caso_canalizaciones`.
 */
class ArCasoCanalizacionesSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_caso_canalizaciones` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArAreaResponsableHorariosSeeder::class,
            ArAreaResponsablesPeriodoSeeder::class,
            ArAreasAtencionSeeder::class,
            ArCasosEstudiantesSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_caso_canalizaciones';

        $llaves = [
            ['id_ar_caso_canalizacion'],
        ];

        $registros = [
            [
                'id_ar_caso_canalizacion'             => 1,
                'id_ar_caso'                          => 1,
                'id_area_origen'                      => 1,
                'id_area_destino'                     => 1,
                'id_causa_reprobacion'                => 1,
                'id_personal_canaliza'                => 1,
                'id_usuario_canaliza'                 => 1,
                'id_area_responsable_periodo_destino' => 1,
                'id_personal_responsable_destino'     => 1,
                'id_area_responsable_horario_destino' => 1,
                'fecha_canalizacion'                  => '2026-01-05 09:00:00',
                'estado'                              => 'Estado caso canalizaciones 1',
                'observaciones'                       => 'Observaciones caso canalizaciones 1',
                'created_at'                          => '2026-01-05 09:00:00',
                'updated_at'                          => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 2,
                'id_ar_caso'                          => 2,
                'id_area_origen'                      => 2,
                'id_area_destino'                     => 2,
                'id_causa_reprobacion'                => 2,
                'id_personal_canaliza'                => 2,
                'id_usuario_canaliza'                 => 2,
                'id_area_responsable_periodo_destino' => 2,
                'id_personal_responsable_destino'     => 2,
                'id_area_responsable_horario_destino' => 2,
                'fecha_canalizacion'                  => '2026-01-14 10:00:00',
                'estado'                              => 'Estado caso canalizaciones 2',
                'observaciones'                       => 'Observaciones caso canalizaciones 2',
                'created_at'                          => '2026-01-14 10:00:00',
                'updated_at'                          => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 3,
                'id_ar_caso'                          => 3,
                'id_area_origen'                      => 3,
                'id_area_destino'                     => 3,
                'id_causa_reprobacion'                => 3,
                'id_personal_canaliza'                => 3,
                'id_usuario_canaliza'                 => 3,
                'id_area_responsable_periodo_destino' => 3,
                'id_personal_responsable_destino'     => 3,
                'id_area_responsable_horario_destino' => 3,
                'fecha_canalizacion'                  => '2026-01-23 11:00:00',
                'estado'                              => 'Estado caso canalizaciones 3',
                'observaciones'                       => 'Observaciones caso canalizaciones 3',
                'created_at'                          => '2026-01-23 11:00:00',
                'updated_at'                          => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 4,
                'id_ar_caso'                          => 4,
                'id_area_origen'                      => 4,
                'id_area_destino'                     => 4,
                'id_causa_reprobacion'                => 4,
                'id_personal_canaliza'                => 4,
                'id_usuario_canaliza'                 => 4,
                'id_area_responsable_periodo_destino' => 4,
                'id_personal_responsable_destino'     => 4,
                'id_area_responsable_horario_destino' => 4,
                'fecha_canalizacion'                  => '2026-02-01 12:00:00',
                'estado'                              => 'Estado caso canalizaciones 4',
                'observaciones'                       => 'Observaciones caso canalizaciones 4',
                'created_at'                          => '2026-02-01 12:00:00',
                'updated_at'                          => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 5,
                'id_ar_caso'                          => 5,
                'id_area_origen'                      => 5,
                'id_area_destino'                     => 5,
                'id_causa_reprobacion'                => 5,
                'id_personal_canaliza'                => 5,
                'id_usuario_canaliza'                 => 5,
                'id_area_responsable_periodo_destino' => 5,
                'id_personal_responsable_destino'     => 5,
                'id_area_responsable_horario_destino' => 5,
                'fecha_canalizacion'                  => '2026-02-10 13:00:00',
                'estado'                              => 'Estado caso canalizaciones 5',
                'observaciones'                       => 'Observaciones caso canalizaciones 5',
                'created_at'                          => '2026-02-10 13:00:00',
                'updated_at'                          => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 6,
                'id_ar_caso'                          => 6,
                'id_area_origen'                      => 6,
                'id_area_destino'                     => 6,
                'id_causa_reprobacion'                => 6,
                'id_personal_canaliza'                => 6,
                'id_usuario_canaliza'                 => 6,
                'id_area_responsable_periodo_destino' => 6,
                'id_personal_responsable_destino'     => 6,
                'id_area_responsable_horario_destino' => 6,
                'fecha_canalizacion'                  => '2026-02-19 14:00:00',
                'estado'                              => 'Estado caso canalizaciones 6',
                'observaciones'                       => 'Observaciones caso canalizaciones 6',
                'created_at'                          => '2026-02-19 14:00:00',
                'updated_at'                          => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 7,
                'id_ar_caso'                          => 7,
                'id_area_origen'                      => 7,
                'id_area_destino'                     => 7,
                'id_causa_reprobacion'                => 7,
                'id_personal_canaliza'                => 7,
                'id_usuario_canaliza'                 => 7,
                'id_area_responsable_periodo_destino' => 7,
                'id_personal_responsable_destino'     => 7,
                'id_area_responsable_horario_destino' => 7,
                'fecha_canalizacion'                  => '2026-02-28 15:00:00',
                'estado'                              => 'Estado caso canalizaciones 7',
                'observaciones'                       => 'Observaciones caso canalizaciones 7',
                'created_at'                          => '2026-02-28 15:00:00',
                'updated_at'                          => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 8,
                'id_ar_caso'                          => 8,
                'id_area_origen'                      => 8,
                'id_area_destino'                     => 8,
                'id_causa_reprobacion'                => 8,
                'id_personal_canaliza'                => 8,
                'id_usuario_canaliza'                 => 8,
                'id_area_responsable_periodo_destino' => 8,
                'id_personal_responsable_destino'     => 8,
                'id_area_responsable_horario_destino' => 8,
                'fecha_canalizacion'                  => '2026-03-09 16:00:00',
                'estado'                              => 'Estado caso canalizaciones 8',
                'observaciones'                       => 'Observaciones caso canalizaciones 8',
                'created_at'                          => '2026-03-09 16:00:00',
                'updated_at'                          => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 9,
                'id_ar_caso'                          => 9,
                'id_area_origen'                      => 9,
                'id_area_destino'                     => 9,
                'id_causa_reprobacion'                => 9,
                'id_personal_canaliza'                => 9,
                'id_usuario_canaliza'                 => 9,
                'id_area_responsable_periodo_destino' => 9,
                'id_personal_responsable_destino'     => 9,
                'id_area_responsable_horario_destino' => 9,
                'fecha_canalizacion'                  => '2026-03-18 08:00:00',
                'estado'                              => 'Estado caso canalizaciones 9',
                'observaciones'                       => 'Observaciones caso canalizaciones 9',
                'created_at'                          => '2026-03-18 08:00:00',
                'updated_at'                          => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 10,
                'id_ar_caso'                          => 10,
                'id_area_origen'                      => 10,
                'id_area_destino'                     => 10,
                'id_causa_reprobacion'                => 10,
                'id_personal_canaliza'                => 10,
                'id_usuario_canaliza'                 => 10,
                'id_area_responsable_periodo_destino' => 10,
                'id_personal_responsable_destino'     => 10,
                'id_area_responsable_horario_destino' => 10,
                'fecha_canalizacion'                  => '2026-03-27 09:00:00',
                'estado'                              => 'Estado caso canalizaciones 10',
                'observaciones'                       => 'Observaciones caso canalizaciones 10',
                'created_at'                          => '2026-03-27 09:00:00',
                'updated_at'                          => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 11,
                'id_ar_caso'                          => 11,
                'id_area_origen'                      => 11,
                'id_area_destino'                     => 11,
                'id_causa_reprobacion'                => 11,
                'id_personal_canaliza'                => 11,
                'id_usuario_canaliza'                 => 11,
                'id_area_responsable_periodo_destino' => 11,
                'id_personal_responsable_destino'     => 11,
                'id_area_responsable_horario_destino' => 11,
                'fecha_canalizacion'                  => '2026-04-05 10:00:00',
                'estado'                              => 'Estado caso canalizaciones 11',
                'observaciones'                       => 'Observaciones caso canalizaciones 11',
                'created_at'                          => '2026-04-05 10:00:00',
                'updated_at'                          => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 12,
                'id_ar_caso'                          => 12,
                'id_area_origen'                      => 12,
                'id_area_destino'                     => 12,
                'id_causa_reprobacion'                => 12,
                'id_personal_canaliza'                => 12,
                'id_usuario_canaliza'                 => 12,
                'id_area_responsable_periodo_destino' => 12,
                'id_personal_responsable_destino'     => 12,
                'id_area_responsable_horario_destino' => 12,
                'fecha_canalizacion'                  => '2026-04-14 11:00:00',
                'estado'                              => 'Estado caso canalizaciones 12',
                'observaciones'                       => 'Observaciones caso canalizaciones 12',
                'created_at'                          => '2026-04-14 11:00:00',
                'updated_at'                          => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 13,
                'id_ar_caso'                          => 13,
                'id_area_origen'                      => 13,
                'id_area_destino'                     => 13,
                'id_causa_reprobacion'                => 13,
                'id_personal_canaliza'                => 13,
                'id_usuario_canaliza'                 => 13,
                'id_area_responsable_periodo_destino' => 13,
                'id_personal_responsable_destino'     => 13,
                'id_area_responsable_horario_destino' => 13,
                'fecha_canalizacion'                  => '2026-04-23 12:00:00',
                'estado'                              => 'Estado caso canalizaciones 13',
                'observaciones'                       => 'Observaciones caso canalizaciones 13',
                'created_at'                          => '2026-04-23 12:00:00',
                'updated_at'                          => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 14,
                'id_ar_caso'                          => 14,
                'id_area_origen'                      => 14,
                'id_area_destino'                     => 14,
                'id_causa_reprobacion'                => 14,
                'id_personal_canaliza'                => 14,
                'id_usuario_canaliza'                 => 14,
                'id_area_responsable_periodo_destino' => 14,
                'id_personal_responsable_destino'     => 14,
                'id_area_responsable_horario_destino' => 14,
                'fecha_canalizacion'                  => '2026-05-02 13:00:00',
                'estado'                              => 'Estado caso canalizaciones 14',
                'observaciones'                       => 'Observaciones caso canalizaciones 14',
                'created_at'                          => '2026-05-02 13:00:00',
                'updated_at'                          => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_caso_canalizacion'             => 15,
                'id_ar_caso'                          => 15,
                'id_area_origen'                      => 15,
                'id_area_destino'                     => 15,
                'id_causa_reprobacion'                => 15,
                'id_personal_canaliza'                => 15,
                'id_usuario_canaliza'                 => 15,
                'id_area_responsable_periodo_destino' => 15,
                'id_personal_responsable_destino'     => 15,
                'id_area_responsable_horario_destino' => 15,
                'fecha_canalizacion'                  => '2026-05-11 14:00:00',
                'estado'                              => 'Estado caso canalizaciones 15',
                'observaciones'                       => 'Observaciones caso canalizaciones 15',
                'created_at'                          => '2026-05-11 14:00:00',
                'updated_at'                          => '2026-05-11 14:00:00',
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
