<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `oc_depend_domicilio`.
 */
class OcDependDomicilioSeeder extends Seeder
{
    /**
     * Pobla la tabla `oc_depend_domicilio` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralMunicipiosSeeder::class,
            OcOficioSeeder::class,
        ]);

        $tabla = 'oc_depend_domicilio';

        $llaves = [
            ['id_depend_domicilio'],
        ];

        $registros = [
            [
                'id_depend_domicilio' => 1,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 1.',
                'domicilio'           => 'Calle Juárez 10, Valle De Bravo',
                'id_oficio'           => 1,
                'id_municipio'        => 1,
                'updated_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_depend_domicilio' => 2,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 2.',
                'domicilio'           => 'Calle Hidalgo 20, Amanalco',
                'id_oficio'           => 2,
                'id_municipio'        => 2,
                'updated_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_depend_domicilio' => 3,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 3.',
                'domicilio'           => 'Calle Morelos 30, Donato Guerra',
                'id_oficio'           => 3,
                'id_municipio'        => 3,
                'updated_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_depend_domicilio' => 4,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 4.',
                'domicilio'           => 'Calle Allende 40, Villa De Allende',
                'id_oficio'           => 4,
                'id_municipio'        => 4,
                'updated_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_depend_domicilio' => 5,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 5.',
                'domicilio'           => 'Calle Zaragoza 50, Temascaltepec',
                'id_oficio'           => 5,
                'id_municipio'        => 5,
                'updated_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_depend_domicilio' => 6,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 6.',
                'domicilio'           => 'Calle Independencia 60, Ixtapan Del Oro',
                'id_oficio'           => 6,
                'id_municipio'        => 6,
                'updated_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_depend_domicilio' => 7,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 7.',
                'domicilio'           => 'Avenida Reforma 70, Santo Tomás',
                'id_oficio'           => 7,
                'id_municipio'        => 7,
                'updated_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_depend_domicilio' => 8,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 8.',
                'domicilio'           => 'Calle Guerrero 80, Otzoloapan',
                'id_oficio'           => 8,
                'id_municipio'        => 8,
                'updated_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_depend_domicilio' => 9,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 9.',
                'domicilio'           => 'Calle Juárez 90, Zacazonapan',
                'id_oficio'           => 9,
                'id_municipio'        => 9,
                'updated_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_depend_domicilio' => 10,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 10.',
                'domicilio'           => 'Calle Hidalgo 100, Villa Victoria',
                'id_oficio'           => 10,
                'id_municipio'        => 10,
                'updated_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_depend_domicilio' => 11,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 11.',
                'domicilio'           => 'Calle Morelos 110, Almoloya De Juárez',
                'id_oficio'           => 11,
                'id_municipio'        => 11,
                'updated_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_depend_domicilio' => 12,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 12.',
                'domicilio'           => 'Calle Allende 120, Toluca',
                'id_oficio'           => 12,
                'id_municipio'        => 12,
                'updated_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_depend_domicilio' => 13,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 13.',
                'domicilio'           => 'Calle Zaragoza 130, Zinacantepec',
                'id_oficio'           => 13,
                'id_municipio'        => 13,
                'updated_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_depend_domicilio' => 14,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 14.',
                'domicilio'           => 'Calle Independencia 140, Tejupilco',
                'id_oficio'           => 14,
                'id_municipio'        => 14,
                'updated_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_depend_domicilio' => 15,
                'dependencia'         => 'Dependencia de depend domicilio: registro de prueba número 15.',
                'domicilio'           => 'Avenida Reforma 150, San José Del Rincón',
                'id_oficio'           => 15,
                'id_municipio'        => 15,
                'updated_at'          => '2026-05-11 14:00:00',
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
