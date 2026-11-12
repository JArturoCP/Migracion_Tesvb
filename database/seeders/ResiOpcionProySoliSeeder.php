<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_opcion_proy_soli`.
 */
class ResiOpcionProySoliSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_opcion_proy_soli` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'resi_opcion_proy_soli';

        $llaves = [
            ['id_opcion_proy'],
        ];

        $registros = [
            [
                'id_opcion_proy' => 1,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 1.',
            ],
            [
                'id_opcion_proy' => 2,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 2.',
            ],
            [
                'id_opcion_proy' => 3,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 3.',
            ],
            [
                'id_opcion_proy' => 4,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 4.',
            ],
            [
                'id_opcion_proy' => 5,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 5.',
            ],
            [
                'id_opcion_proy' => 6,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 6.',
            ],
            [
                'id_opcion_proy' => 7,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 7.',
            ],
            [
                'id_opcion_proy' => 8,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 8.',
            ],
            [
                'id_opcion_proy' => 9,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 9.',
            ],
            [
                'id_opcion_proy' => 10,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 10.',
            ],
            [
                'id_opcion_proy' => 11,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 11.',
            ],
            [
                'id_opcion_proy' => 12,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 12.',
            ],
            [
                'id_opcion_proy' => 13,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 13.',
            ],
            [
                'id_opcion_proy' => 14,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 14.',
            ],
            [
                'id_opcion_proy' => 15,
                'nombre_opcion'  => 'Nombre opcion de opcion proy soli: registro de prueba número 15.',
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
