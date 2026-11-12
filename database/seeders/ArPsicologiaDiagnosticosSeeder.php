<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `ar_psicologia_diagnosticos`.
 */
class ArPsicologiaDiagnosticosSeeder extends Seeder
{
    /**
     * Pobla la tabla `ar_psicologia_diagnosticos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ArAreasAtencionSeeder::class,
            ArCasoCanalizacionesSeeder::class,
            ArCasoCitasSeeder::class,
            ArCasosEstudiantesSeeder::class,
            GnralPersonalesSeeder::class,
        ]);

        $tabla = 'ar_psicologia_diagnosticos';

        $llaves = [
            ['id_ar_diagnostico'],
        ];

        $registros = [
            [
                'id_ar_diagnostico'           => 1,
                'id_ar_caso'                  => 1,
                'id_ar_caso_canalizacion'     => 1,
                'id_ar_cita'                  => 1,
                'id_area_atencion'            => 1,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 1'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 1'),
                'fecha_diagnostico'           => '2026-01-05 09:00:00',
                'id_personal_psicologia'      => 1,
                'id_usuario_registro'         => 1,
                'created_at'                  => '2026-01-05 09:00:00',
                'updated_at'                  => '2026-01-05 09:00:00',
            ],
            [
                'id_ar_diagnostico'           => 2,
                'id_ar_caso'                  => 2,
                'id_ar_caso_canalizacion'     => 2,
                'id_ar_cita'                  => 2,
                'id_area_atencion'            => 2,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 2'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 2'),
                'fecha_diagnostico'           => '2026-01-14 10:00:00',
                'id_personal_psicologia'      => 2,
                'id_usuario_registro'         => 2,
                'created_at'                  => '2026-01-14 10:00:00',
                'updated_at'                  => '2026-01-14 10:00:00',
            ],
            [
                'id_ar_diagnostico'           => 3,
                'id_ar_caso'                  => 3,
                'id_ar_caso_canalizacion'     => 3,
                'id_ar_cita'                  => 3,
                'id_area_atencion'            => 3,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 3'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 3'),
                'fecha_diagnostico'           => '2026-01-23 11:00:00',
                'id_personal_psicologia'      => 3,
                'id_usuario_registro'         => 3,
                'created_at'                  => '2026-01-23 11:00:00',
                'updated_at'                  => '2026-01-23 11:00:00',
            ],
            [
                'id_ar_diagnostico'           => 4,
                'id_ar_caso'                  => 4,
                'id_ar_caso_canalizacion'     => 4,
                'id_ar_cita'                  => 4,
                'id_area_atencion'            => 4,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 4'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 4'),
                'fecha_diagnostico'           => '2026-02-01 12:00:00',
                'id_personal_psicologia'      => 4,
                'id_usuario_registro'         => 4,
                'created_at'                  => '2026-02-01 12:00:00',
                'updated_at'                  => '2026-02-01 12:00:00',
            ],
            [
                'id_ar_diagnostico'           => 5,
                'id_ar_caso'                  => 5,
                'id_ar_caso_canalizacion'     => 5,
                'id_ar_cita'                  => 5,
                'id_area_atencion'            => 5,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 5'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 5'),
                'fecha_diagnostico'           => '2026-02-10 13:00:00',
                'id_personal_psicologia'      => 5,
                'id_usuario_registro'         => 5,
                'created_at'                  => '2026-02-10 13:00:00',
                'updated_at'                  => '2026-02-10 13:00:00',
            ],
            [
                'id_ar_diagnostico'           => 6,
                'id_ar_caso'                  => 6,
                'id_ar_caso_canalizacion'     => 6,
                'id_ar_cita'                  => 6,
                'id_area_atencion'            => 6,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 6'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 6'),
                'fecha_diagnostico'           => '2026-02-19 14:00:00',
                'id_personal_psicologia'      => 6,
                'id_usuario_registro'         => 6,
                'created_at'                  => '2026-02-19 14:00:00',
                'updated_at'                  => '2026-02-19 14:00:00',
            ],
            [
                'id_ar_diagnostico'           => 7,
                'id_ar_caso'                  => 7,
                'id_ar_caso_canalizacion'     => 7,
                'id_ar_cita'                  => 7,
                'id_area_atencion'            => 7,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 7'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 7'),
                'fecha_diagnostico'           => '2026-02-28 15:00:00',
                'id_personal_psicologia'      => 7,
                'id_usuario_registro'         => 7,
                'created_at'                  => '2026-02-28 15:00:00',
                'updated_at'                  => '2026-02-28 15:00:00',
            ],
            [
                'id_ar_diagnostico'           => 8,
                'id_ar_caso'                  => 8,
                'id_ar_caso_canalizacion'     => 8,
                'id_ar_cita'                  => 8,
                'id_area_atencion'            => 8,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 8'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 8'),
                'fecha_diagnostico'           => '2026-03-09 16:00:00',
                'id_personal_psicologia'      => 8,
                'id_usuario_registro'         => 8,
                'created_at'                  => '2026-03-09 16:00:00',
                'updated_at'                  => '2026-03-09 16:00:00',
            ],
            [
                'id_ar_diagnostico'           => 9,
                'id_ar_caso'                  => 9,
                'id_ar_caso_canalizacion'     => 9,
                'id_ar_cita'                  => 9,
                'id_area_atencion'            => 9,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 9'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 9'),
                'fecha_diagnostico'           => '2026-03-18 08:00:00',
                'id_personal_psicologia'      => 9,
                'id_usuario_registro'         => 9,
                'created_at'                  => '2026-03-18 08:00:00',
                'updated_at'                  => '2026-03-18 08:00:00',
            ],
            [
                'id_ar_diagnostico'           => 10,
                'id_ar_caso'                  => 10,
                'id_ar_caso_canalizacion'     => 10,
                'id_ar_cita'                  => 10,
                'id_area_atencion'            => 10,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 10'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 10'),
                'fecha_diagnostico'           => '2026-03-27 09:00:00',
                'id_personal_psicologia'      => 10,
                'id_usuario_registro'         => 10,
                'created_at'                  => '2026-03-27 09:00:00',
                'updated_at'                  => '2026-03-27 09:00:00',
            ],
            [
                'id_ar_diagnostico'           => 11,
                'id_ar_caso'                  => 11,
                'id_ar_caso_canalizacion'     => 11,
                'id_ar_cita'                  => 11,
                'id_area_atencion'            => 11,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 11'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 11'),
                'fecha_diagnostico'           => '2026-04-05 10:00:00',
                'id_personal_psicologia'      => 11,
                'id_usuario_registro'         => 11,
                'created_at'                  => '2026-04-05 10:00:00',
                'updated_at'                  => '2026-04-05 10:00:00',
            ],
            [
                'id_ar_diagnostico'           => 12,
                'id_ar_caso'                  => 12,
                'id_ar_caso_canalizacion'     => 12,
                'id_ar_cita'                  => 12,
                'id_area_atencion'            => 12,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 12'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 12'),
                'fecha_diagnostico'           => '2026-04-14 11:00:00',
                'id_personal_psicologia'      => 12,
                'id_usuario_registro'         => 12,
                'created_at'                  => '2026-04-14 11:00:00',
                'updated_at'                  => '2026-04-14 11:00:00',
            ],
            [
                'id_ar_diagnostico'           => 13,
                'id_ar_caso'                  => 13,
                'id_ar_caso_canalizacion'     => 13,
                'id_ar_cita'                  => 13,
                'id_area_atencion'            => 13,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 13'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 13'),
                'fecha_diagnostico'           => '2026-04-23 12:00:00',
                'id_personal_psicologia'      => 13,
                'id_usuario_registro'         => 13,
                'created_at'                  => '2026-04-23 12:00:00',
                'updated_at'                  => '2026-04-23 12:00:00',
            ],
            [
                'id_ar_diagnostico'           => 14,
                'id_ar_caso'                  => 14,
                'id_ar_caso_canalizacion'     => 14,
                'id_ar_cita'                  => 14,
                'id_area_atencion'            => 14,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 14'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 14'),
                'fecha_diagnostico'           => '2026-05-02 13:00:00',
                'id_personal_psicologia'      => 14,
                'id_usuario_registro'         => 14,
                'created_at'                  => '2026-05-02 13:00:00',
                'updated_at'                  => '2026-05-02 13:00:00',
            ],
            [
                'id_ar_diagnostico'           => 15,
                'id_ar_caso'                  => 15,
                'id_ar_caso_canalizacion'     => 15,
                'id_ar_cita'                  => 15,
                'id_area_atencion'            => 15,
                'diagnostico_encriptado'      => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 15'),
                'recomendaciones_encriptadas' => Crypt::encryptString('Psicologia diagnosticos confidencial del registro 15'),
                'fecha_diagnostico'           => '2026-05-11 14:00:00',
                'id_personal_psicologia'      => 15,
                'id_usuario_registro'         => 15,
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
