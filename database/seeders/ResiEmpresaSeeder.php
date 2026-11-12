<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_empresa`.
 */
class ResiEmpresaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_empresa` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_empresa';

        $llaves = [
            ['id_empresa'],
        ];

        $registros = [
            [
                'id_empresa'  => 1,
                'nombre'      => 'Nombre de empresa: registro de prueba número 1.',
                'domicilio'   => 'Calle Juárez 10, Valle De Bravo',
                'tel_empresa' => '7262600001',
                'correo'      => 'empresa01@example.com',
                'dir_gral'    => 'Dir gral empresa 1',
            ],
            [
                'id_empresa'  => 2,
                'nombre'      => 'Nombre de empresa: registro de prueba número 2.',
                'domicilio'   => 'Calle Hidalgo 20, Amanalco',
                'tel_empresa' => '7262600002',
                'correo'      => 'empresa02@example.com',
                'dir_gral'    => 'Dir gral empresa 2',
            ],
            [
                'id_empresa'  => 3,
                'nombre'      => 'Nombre de empresa: registro de prueba número 3.',
                'domicilio'   => 'Calle Morelos 30, Donato Guerra',
                'tel_empresa' => '7262600003',
                'correo'      => 'empresa03@example.com',
                'dir_gral'    => 'Dir gral empresa 3',
            ],
            [
                'id_empresa'  => 4,
                'nombre'      => 'Nombre de empresa: registro de prueba número 4.',
                'domicilio'   => 'Calle Allende 40, Villa De Allende',
                'tel_empresa' => '7262600004',
                'correo'      => 'empresa04@example.com',
                'dir_gral'    => 'Dir gral empresa 4',
            ],
            [
                'id_empresa'  => 5,
                'nombre'      => 'Nombre de empresa: registro de prueba número 5.',
                'domicilio'   => 'Calle Zaragoza 50, Temascaltepec',
                'tel_empresa' => '7262600005',
                'correo'      => 'empresa05@example.com',
                'dir_gral'    => 'Dir gral empresa 5',
            ],
            [
                'id_empresa'  => 6,
                'nombre'      => 'Nombre de empresa: registro de prueba número 6.',
                'domicilio'   => 'Calle Independencia 60, Ixtapan Del Oro',
                'tel_empresa' => '7262600006',
                'correo'      => 'empresa06@example.com',
                'dir_gral'    => 'Dir gral empresa 6',
            ],
            [
                'id_empresa'  => 7,
                'nombre'      => 'Nombre de empresa: registro de prueba número 7.',
                'domicilio'   => 'Avenida Reforma 70, Santo Tomás',
                'tel_empresa' => '7262600007',
                'correo'      => 'empresa07@example.com',
                'dir_gral'    => 'Dir gral empresa 7',
            ],
            [
                'id_empresa'  => 8,
                'nombre'      => 'Nombre de empresa: registro de prueba número 8.',
                'domicilio'   => 'Calle Guerrero 80, Otzoloapan',
                'tel_empresa' => '7262600008',
                'correo'      => 'empresa08@example.com',
                'dir_gral'    => 'Dir gral empresa 8',
            ],
            [
                'id_empresa'  => 9,
                'nombre'      => 'Nombre de empresa: registro de prueba número 9.',
                'domicilio'   => 'Calle Juárez 90, Zacazonapan',
                'tel_empresa' => '7262600009',
                'correo'      => 'empresa09@example.com',
                'dir_gral'    => 'Dir gral empresa 9',
            ],
            [
                'id_empresa'  => 10,
                'nombre'      => 'Nombre de empresa: registro de prueba número 10.',
                'domicilio'   => 'Calle Hidalgo 100, Villa Victoria',
                'tel_empresa' => '7262600010',
                'correo'      => 'empresa10@example.com',
                'dir_gral'    => 'Dir gral empresa 10',
            ],
            [
                'id_empresa'  => 11,
                'nombre'      => 'Nombre de empresa: registro de prueba número 11.',
                'domicilio'   => 'Calle Morelos 110, Almoloya De Juárez',
                'tel_empresa' => '7262600011',
                'correo'      => 'empresa11@example.com',
                'dir_gral'    => 'Dir gral empresa 11',
            ],
            [
                'id_empresa'  => 12,
                'nombre'      => 'Nombre de empresa: registro de prueba número 12.',
                'domicilio'   => 'Calle Allende 120, Toluca',
                'tel_empresa' => '7262600012',
                'correo'      => 'empresa12@example.com',
                'dir_gral'    => 'Dir gral empresa 12',
            ],
            [
                'id_empresa'  => 13,
                'nombre'      => 'Nombre de empresa: registro de prueba número 13.',
                'domicilio'   => 'Calle Zaragoza 130, Zinacantepec',
                'tel_empresa' => '7262600013',
                'correo'      => 'empresa13@example.com',
                'dir_gral'    => 'Dir gral empresa 13',
            ],
            [
                'id_empresa'  => 14,
                'nombre'      => 'Nombre de empresa: registro de prueba número 14.',
                'domicilio'   => 'Calle Independencia 140, Tejupilco',
                'tel_empresa' => '7262600014',
                'correo'      => 'empresa14@example.com',
                'dir_gral'    => 'Dir gral empresa 14',
            ],
            [
                'id_empresa'  => 15,
                'nombre'      => 'Nombre de empresa: registro de prueba número 15.',
                'domicilio'   => 'Avenida Reforma 150, San José Del Rincón',
                'tel_empresa' => '7262600015',
                'correo'      => 'empresa15@example.com',
                'dir_gral'    => 'Dir gral empresa 15',
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
