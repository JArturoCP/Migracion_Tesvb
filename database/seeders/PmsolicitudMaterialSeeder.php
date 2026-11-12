<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `pmsolicitud_material`.
 */
class PmsolicitudMaterialSeeder extends Seeder
{
    /**
     * Pobla la tabla `pmsolicitud_material` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ActcompleJefaturasSeeder::class,
            PmprestamosMaterialesSeeder::class,
        ]);

        $tabla = 'pmsolicitud_material';

        $llaves = [
            ['id_solicitud'],
        ];

        $registros = [
            [
                'id_solicitud'  => 1,
                'id_material'   => 1,
                'codigo'        => 'CLV-001',
                'id_estudiante' => 1,
                'id_docente'    => 1,
                'id_jefatura'   => 1,
                'estatus'       => 'Estatus pmsolicitu 1',
                'fecha_salida'  => '2026-01-05',
                'fecha_entrega' => '2026-01-05',
                'responsable'   => 'María José Hernández Romero',
                'updated_at'    => '2026-01-05 09:00:00',
                'created_at'    => '2026-01-05 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 2,
                'id_material'   => 2,
                'codigo'        => 'CLV-002',
                'id_estudiante' => 2,
                'id_docente'    => 2,
                'id_jefatura'   => 2,
                'estatus'       => 'Estatus pmsolicitu 2',
                'fecha_salida'  => '2026-01-14',
                'fecha_entrega' => '2026-01-14',
                'responsable'   => 'Jorge Alberto Sánchez Castillo',
                'updated_at'    => '2026-01-14 10:00:00',
                'created_at'    => '2026-01-14 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 3,
                'id_material'   => 3,
                'codigo'        => 'CLV-003',
                'id_estudiante' => 3,
                'id_docente'    => 3,
                'id_jefatura'   => 3,
                'estatus'       => 'Estatus pmsolicitu 3',
                'fecha_salida'  => '2026-01-23',
                'fecha_entrega' => '2026-01-23',
                'responsable'   => 'Daniela Jiménez Torres',
                'updated_at'    => '2026-01-23 11:00:00',
                'created_at'    => '2026-01-23 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 4,
                'id_material'   => 4,
                'codigo'        => 'CLV-004',
                'id_estudiante' => 4,
                'id_docente'    => 4,
                'id_jefatura'   => 4,
                'estatus'       => 'Estatus pmsolicitu 4',
                'fecha_salida'  => '2026-02-01',
                'fecha_entrega' => '2026-02-01',
                'responsable'   => 'Carlos Eduardo Pérez Aguilar',
                'updated_at'    => '2026-02-01 12:00:00',
                'created_at'    => '2026-02-01 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 5,
                'id_material'   => 5,
                'codigo'        => 'CLV-005',
                'id_estudiante' => 5,
                'id_docente'    => 5,
                'id_jefatura'   => 5,
                'estatus'       => 'Estatus pmsolicitu 5',
                'fecha_salida'  => '2026-02-10',
                'fecha_entrega' => '2026-02-10',
                'responsable'   => 'Valeria Vázquez Navarro',
                'updated_at'    => '2026-02-10 13:00:00',
                'created_at'    => '2026-02-10 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 6,
                'id_material'   => 6,
                'codigo'        => 'CLV-006',
                'id_estudiante' => 6,
                'id_docente'    => 6,
                'id_jefatura'   => 6,
                'estatus'       => 'Estatus pmsolicitu 6',
                'fecha_salida'  => '2026-02-19',
                'fecha_entrega' => '2026-02-19',
                'responsable'   => 'Miguel Ángel Rodríguez Ruiz',
                'updated_at'    => '2026-02-19 14:00:00',
                'created_at'    => '2026-02-19 14:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 7,
                'id_material'   => 7,
                'codigo'        => 'CLV-007',
                'id_estudiante' => 7,
                'id_docente'    => 7,
                'id_jefatura'   => 7,
                'estatus'       => 'Estatus pmsolicitu 7',
                'fecha_salida'  => '2026-02-28',
                'fecha_entrega' => '2026-02-28',
                'responsable'   => 'Fernanda Morales Reyes',
                'updated_at'    => '2026-02-28 15:00:00',
                'created_at'    => '2026-02-28 15:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 8,
                'id_material'   => 8,
                'codigo'        => 'CLV-008',
                'id_estudiante' => 8,
                'id_docente'    => 8,
                'id_jefatura'   => 8,
                'estatus'       => 'Estatus pmsolicitu 8',
                'fecha_salida'  => '2026-03-09',
                'fecha_entrega' => '2026-03-09',
                'responsable'   => 'José Antonio González Medina',
                'updated_at'    => '2026-03-09 16:00:00',
                'created_at'    => '2026-03-09 16:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 9,
                'id_material'   => 9,
                'codigo'        => 'CLV-009',
                'id_estudiante' => 9,
                'id_docente'    => 9,
                'id_jefatura'   => 9,
                'estatus'       => 'Estatus pmsolicitu 9',
                'fecha_salida'  => '2026-03-18',
                'fecha_entrega' => '2026-03-18',
                'responsable'   => 'Andrea Gómez Ortiz',
                'updated_at'    => '2026-03-18 08:00:00',
                'created_at'    => '2026-03-18 08:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 10,
                'id_material'   => 10,
                'codigo'        => 'CLV-010',
                'id_estudiante' => 10,
                'id_docente'    => 10,
                'id_jefatura'   => 10,
                'estatus'       => 'Estatus pmsolicit 10',
                'fecha_salida'  => '2026-03-27',
                'fecha_entrega' => '2026-03-27',
                'responsable'   => 'Diego López Mendoza',
                'updated_at'    => '2026-03-27 09:00:00',
                'created_at'    => '2026-03-27 09:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 11,
                'id_material'   => 11,
                'codigo'        => 'CLV-011',
                'id_estudiante' => 11,
                'id_docente'    => 11,
                'id_jefatura'   => 11,
                'estatus'       => 'Estatus pmsolicit 11',
                'fecha_salida'  => '2026-04-05',
                'fecha_entrega' => '2026-04-05',
                'responsable'   => 'Paola Flores Rojas',
                'updated_at'    => '2026-04-05 10:00:00',
                'created_at'    => '2026-04-05 10:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 12,
                'id_material'   => 12,
                'codigo'        => 'CLV-012',
                'id_estudiante' => 12,
                'id_docente'    => 12,
                'id_jefatura'   => 12,
                'estatus'       => 'Estatus pmsolicit 12',
                'fecha_salida'  => '2026-04-14',
                'fecha_entrega' => '2026-04-14',
                'responsable'   => 'Ricardo Martínez Herrera',
                'updated_at'    => '2026-04-14 11:00:00',
                'created_at'    => '2026-04-14 11:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 13,
                'id_material'   => 13,
                'codigo'        => 'CLV-013',
                'id_estudiante' => 13,
                'id_docente'    => 13,
                'id_jefatura'   => 13,
                'estatus'       => 'Estatus pmsolicit 13',
                'fecha_salida'  => '2026-04-23',
                'fecha_entrega' => '2026-04-23',
                'responsable'   => 'Itzel Cruz Vega',
                'updated_at'    => '2026-04-23 12:00:00',
                'created_at'    => '2026-04-23 12:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 14,
                'id_material'   => 14,
                'codigo'        => 'CLV-014',
                'id_estudiante' => 14,
                'id_docente'    => 14,
                'id_jefatura'   => 14,
                'estatus'       => 'Estatus pmsolicit 14',
                'fecha_salida'  => '2026-05-02',
                'fecha_entrega' => '2026-05-02',
                'responsable'   => 'Ana Karen Martínez Ruiz',
                'updated_at'    => '2026-05-02 13:00:00',
                'created_at'    => '2026-05-02 13:00:00',
                'deleted_at'    => null,
            ],
            [
                'id_solicitud'  => 15,
                'id_material'   => 15,
                'codigo'        => 'CLV-015',
                'id_estudiante' => 15,
                'id_docente'    => 15,
                'id_jefatura'   => 15,
                'estatus'       => 'Estatus pmsolicit 15',
                'fecha_salida'  => '2026-05-11',
                'fecha_entrega' => '2026-05-11',
                'responsable'   => 'Luis Fernando Cruz Reyes',
                'updated_at'    => '2026-05-11 14:00:00',
                'created_at'    => '2026-05-11 14:00:00',
                'deleted_at'    => null,
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
