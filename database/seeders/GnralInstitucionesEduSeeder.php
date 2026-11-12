<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_instituciones_edu`.
 */
class GnralInstitucionesEduSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_instituciones_edu` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_instituciones_edu';

        $llaves = [
            ['id_institucion'],
        ];

        $registros = [
            [
                'id_institucion' => 1,
                'cct'            => 'CLV-001',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 1.',
                'domicilio'      => 'Calle Juárez 10, Valle De Bravo',
                'municipio'      => 'Valle De Bravo',
                'localidad'      => 'Valle De Bravo',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 1.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 1.',
            ],
            [
                'id_institucion' => 2,
                'cct'            => 'CLV-002',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 2.',
                'domicilio'      => 'Calle Hidalgo 20, Amanalco',
                'municipio'      => 'Amanalco',
                'localidad'      => 'Amanalco',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 2.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 2.',
            ],
            [
                'id_institucion' => 3,
                'cct'            => 'CLV-003',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 3.',
                'domicilio'      => 'Calle Morelos 30, Donato Guerra',
                'municipio'      => 'Donato Guerra',
                'localidad'      => 'Donato Guerra',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 3.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 3.',
            ],
            [
                'id_institucion' => 4,
                'cct'            => 'CLV-004',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 4.',
                'domicilio'      => 'Calle Allende 40, Villa De Allende',
                'municipio'      => 'Villa De Allende',
                'localidad'      => 'Villa De Allende',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 4.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 4.',
            ],
            [
                'id_institucion' => 5,
                'cct'            => 'CLV-005',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 5.',
                'domicilio'      => 'Calle Zaragoza 50, Temascaltepec',
                'municipio'      => 'Temascaltepec',
                'localidad'      => 'Temascaltepec',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 5.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 5.',
            ],
            [
                'id_institucion' => 6,
                'cct'            => 'CLV-006',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 6.',
                'domicilio'      => 'Calle Independencia 60, Ixtapan Del Oro',
                'municipio'      => 'Ixtapan Del Oro',
                'localidad'      => 'Ixtapan Del Oro',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 6.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 6.',
            ],
            [
                'id_institucion' => 7,
                'cct'            => 'CLV-007',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 7.',
                'domicilio'      => 'Avenida Reforma 70, Santo Tomás',
                'municipio'      => 'Santo Tomás',
                'localidad'      => 'Santo Tomás',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 7.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 7.',
            ],
            [
                'id_institucion' => 8,
                'cct'            => 'CLV-008',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 8.',
                'domicilio'      => 'Calle Guerrero 80, Otzoloapan',
                'municipio'      => 'Otzoloapan',
                'localidad'      => 'Otzoloapan',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 8.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 8.',
            ],
            [
                'id_institucion' => 9,
                'cct'            => 'CLV-009',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 9.',
                'domicilio'      => 'Calle Juárez 90, Zacazonapan',
                'municipio'      => 'Zacazonapan',
                'localidad'      => 'Zacazonapan',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 9.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 9.',
            ],
            [
                'id_institucion' => 10,
                'cct'            => 'CLV-010',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 10.',
                'domicilio'      => 'Calle Hidalgo 100, Villa Victoria',
                'municipio'      => 'Villa Victoria',
                'localidad'      => 'Villa Victoria',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 10.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 10.',
            ],
            [
                'id_institucion' => 11,
                'cct'            => 'CLV-011',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 11.',
                'domicilio'      => 'Calle Morelos 110, Almoloya De Juárez',
                'municipio'      => 'Almoloya De Juárez',
                'localidad'      => 'Almoloya De Juárez',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 11.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 11.',
            ],
            [
                'id_institucion' => 12,
                'cct'            => 'CLV-012',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 12.',
                'domicilio'      => 'Calle Allende 120, Toluca',
                'municipio'      => 'Toluca',
                'localidad'      => 'Toluca',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 12.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 12.',
            ],
            [
                'id_institucion' => 13,
                'cct'            => 'CLV-013',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 13.',
                'domicilio'      => 'Calle Zaragoza 130, Zinacantepec',
                'municipio'      => 'Zinacantepec',
                'localidad'      => 'Zinacantepec',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 13.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 13.',
            ],
            [
                'id_institucion' => 14,
                'cct'            => 'CLV-014',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 14.',
                'domicilio'      => 'Calle Independencia 140, Tejupilco',
                'municipio'      => 'Tejupilco',
                'localidad'      => 'Tejupilco',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 14.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 14.',
            ],
            [
                'id_institucion' => 15,
                'cct'            => 'CLV-015',
                'nombre_escuela' => 'Nombre escuela de instituciones edu: registro de prueba número 15.',
                'domicilio'      => 'Avenida Reforma 150, San José Del Rincón',
                'municipio'      => 'San José Del Rincón',
                'localidad'      => 'San José Del Rincón',
                'turno'          => 'Turno de instituciones edu: registro de prueba número 15.',
                'servicio'       => 'Servicio de instituciones edu: registro de prueba número 15.',
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
