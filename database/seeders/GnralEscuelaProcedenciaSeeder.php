<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_escuela_procedencia`.
 */
class GnralEscuelaProcedenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_escuela_procedencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_escuela_procedencia';

        $llaves = [
            ['id_escuela_procedencia'],
        ];

        $registros = [
            [
                'id_escuela_procedencia' => 1,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 1.',
                'estado'                 => 'Estado escuela procedencia 1',
                'municipio'              => 'Valle De Bravo',
            ],
            [
                'id_escuela_procedencia' => 2,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 2.',
                'estado'                 => 'Estado escuela procedencia 2',
                'municipio'              => 'Amanalco',
            ],
            [
                'id_escuela_procedencia' => 3,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 3.',
                'estado'                 => 'Estado escuela procedencia 3',
                'municipio'              => 'Donato Guerra',
            ],
            [
                'id_escuela_procedencia' => 4,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 4.',
                'estado'                 => 'Estado escuela procedencia 4',
                'municipio'              => 'Villa De Allende',
            ],
            [
                'id_escuela_procedencia' => 5,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 5.',
                'estado'                 => 'Estado escuela procedencia 5',
                'municipio'              => 'Temascaltepec',
            ],
            [
                'id_escuela_procedencia' => 6,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 6.',
                'estado'                 => 'Estado escuela procedencia 6',
                'municipio'              => 'Ixtapan Del Oro',
            ],
            [
                'id_escuela_procedencia' => 7,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 7.',
                'estado'                 => 'Estado escuela procedencia 7',
                'municipio'              => 'Santo Tomás',
            ],
            [
                'id_escuela_procedencia' => 8,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 8.',
                'estado'                 => 'Estado escuela procedencia 8',
                'municipio'              => 'Otzoloapan',
            ],
            [
                'id_escuela_procedencia' => 9,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 9.',
                'estado'                 => 'Estado escuela procedencia 9',
                'municipio'              => 'Zacazonapan',
            ],
            [
                'id_escuela_procedencia' => 10,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 10.',
                'estado'                 => 'Estado escuela procedencia 10',
                'municipio'              => 'Villa Victoria',
            ],
            [
                'id_escuela_procedencia' => 11,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 11.',
                'estado'                 => 'Estado escuela procedencia 11',
                'municipio'              => 'Almoloya De Juárez',
            ],
            [
                'id_escuela_procedencia' => 12,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 12.',
                'estado'                 => 'Estado escuela procedencia 12',
                'municipio'              => 'Toluca',
            ],
            [
                'id_escuela_procedencia' => 13,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 13.',
                'estado'                 => 'Estado escuela procedencia 13',
                'municipio'              => 'Zinacantepec',
            ],
            [
                'id_escuela_procedencia' => 14,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 14.',
                'estado'                 => 'Estado escuela procedencia 14',
                'municipio'              => 'Tejupilco',
            ],
            [
                'id_escuela_procedencia' => 15,
                'nombre_escuela'         => 'Nombre escuela de escuela procedencia: registro de prueba número 15.',
                'estado'                 => 'Estado escuela procedencia 15',
                'municipio'              => 'San José Del Rincón',
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
