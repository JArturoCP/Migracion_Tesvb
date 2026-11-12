<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_unidad_administrativa`.
 */
class GnralUnidadAdministrativaSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_unidad_administrativa` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_unidad_administrativa';

        $llaves = [
            ['id_unidad_admin'],
        ];

        $registros = [
            [
                'id_unidad_admin'  => 1,
                'nom_departamento' => 'DOCENCIA',
                'jefe_descripcion' => 'María José Hernández Romero',
                'clave'            => 'CLV-001',
                'cod'              => 1,
                'updated_at'       => '2026-01-05 09:00:00',
                'created_at'       => '2026-01-05 09:00:00',
            ],
            [
                'id_unidad_admin'  => 2,
                'nom_departamento' => 'DIRECCIÓN GENERAL',
                'jefe_descripcion' => 'Jorge Alberto Sánchez Castillo',
                'clave'            => 'CLV-002',
                'cod'              => 2,
                'updated_at'       => '2026-01-14 10:00:00',
                'created_at'       => '2026-01-14 10:00:00',
            ],
            [
                'id_unidad_admin'  => 3,
                'nom_departamento' => 'JEFATURA DE DIVISIÓN',
                'jefe_descripcion' => 'Daniela Jiménez Torres',
                'clave'            => 'CLV-003',
                'cod'              => 3,
                'updated_at'       => '2026-01-23 11:00:00',
                'created_at'       => '2026-01-23 11:00:00',
            ],
            [
                'id_unidad_admin'  => 4,
                'nom_departamento' => 'PLANEACIÓN Y CONSULTAS',
                'jefe_descripcion' => 'Carlos Eduardo Pérez Aguilar',
                'clave'            => 'CLV-004',
                'cod'              => 4,
                'updated_at'       => '2026-02-01 12:00:00',
                'created_at'       => '2026-02-01 12:00:00',
            ],
            [
                'id_unidad_admin'  => 5,
                'nom_departamento' => 'DESARROLLO ACADÉMICO',
                'jefe_descripcion' => 'Valeria Vázquez Navarro',
                'clave'            => 'CLV-005',
                'cod'              => 5,
                'updated_at'       => '2026-02-10 13:00:00',
                'created_at'       => '2026-02-10 13:00:00',
            ],
            [
                'id_unidad_admin'  => 6,
                'nom_departamento' => 'CONTROL ESCOLAR',
                'jefe_descripcion' => 'Miguel Ángel Rodríguez Ruiz',
                'clave'            => 'CLV-006',
                'cod'              => 6,
                'updated_at'       => '2026-02-19 14:00:00',
                'created_at'       => '2026-02-19 14:00:00',
            ],
            [
                'id_unidad_admin'  => 7,
                'nom_departamento' => 'RECURSOS HUMANOS',
                'jefe_descripcion' => 'Fernanda Morales Reyes',
                'clave'            => 'CLV-007',
                'cod'              => 7,
                'updated_at'       => '2026-02-28 15:00:00',
                'created_at'       => '2026-02-28 15:00:00',
            ],
            [
                'id_unidad_admin'  => 8,
                'nom_departamento' => 'CENTRO DE CÓMPUTO',
                'jefe_descripcion' => 'José Antonio González Medina',
                'clave'            => 'CLV-008',
                'cod'              => 8,
                'updated_at'       => '2026-03-09 16:00:00',
                'created_at'       => '2026-03-09 16:00:00',
            ],
            [
                'id_unidad_admin'  => 9,
                'nom_departamento' => 'RESIDENCIAS PROFESIONALES',
                'jefe_descripcion' => 'Andrea Gómez Ortiz',
                'clave'            => 'CLV-009',
                'cod'              => 9,
                'updated_at'       => '2026-03-18 08:00:00',
                'created_at'       => '2026-03-18 08:00:00',
            ],
            [
                'id_unidad_admin'  => 10,
                'nom_departamento' => 'TITULACIÓN',
                'jefe_descripcion' => 'Diego López Mendoza',
                'clave'            => 'CLV-010',
                'cod'              => 10,
                'updated_at'       => '2026-03-27 09:00:00',
                'created_at'       => '2026-03-27 09:00:00',
            ],
            [
                'id_unidad_admin'  => 11,
                'nom_departamento' => 'FINANZAS',
                'jefe_descripcion' => 'Paola Flores Rojas',
                'clave'            => 'CLV-011',
                'cod'              => 11,
                'updated_at'       => '2026-04-05 10:00:00',
                'created_at'       => '2026-04-05 10:00:00',
            ],
            [
                'id_unidad_admin'  => 12,
                'nom_departamento' => 'DOCENCIA',
                'jefe_descripcion' => 'Ricardo Martínez Herrera',
                'clave'            => 'CLV-012',
                'cod'              => 12,
                'updated_at'       => '2026-04-14 11:00:00',
                'created_at'       => '2026-04-14 11:00:00',
            ],
            [
                'id_unidad_admin'  => 13,
                'nom_departamento' => 'DIRECCIÓN GENERAL',
                'jefe_descripcion' => 'Itzel Cruz Vega',
                'clave'            => 'CLV-013',
                'cod'              => 13,
                'updated_at'       => '2026-04-23 12:00:00',
                'created_at'       => '2026-04-23 12:00:00',
            ],
            [
                'id_unidad_admin'  => 14,
                'nom_departamento' => 'JEFATURA DE DIVISIÓN',
                'jefe_descripcion' => 'Ana Karen Martínez Ruiz',
                'clave'            => 'CLV-014',
                'cod'              => 14,
                'updated_at'       => '2026-05-02 13:00:00',
                'created_at'       => '2026-05-02 13:00:00',
            ],
            [
                'id_unidad_admin'  => 15,
                'nom_departamento' => 'PLANEACIÓN Y CONSULTAS',
                'jefe_descripcion' => 'Luis Fernando Cruz Reyes',
                'clave'            => 'CLV-015',
                'cod'              => 15,
                'updated_at'       => '2026-05-11 14:00:00',
                'created_at'       => '2026-05-11 14:00:00',
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
