<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_departamentos`.
 */
class GnralDepartamentosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_departamentos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'gnral_departamentos';

        $llaves = [
            ['id_departamento'],
        ];

        $registros = [
            [
                'id_departamento'     => 0,
                'nombre_departamento' => 'DOCENCIA',
            ],
            [
                'id_departamento'     => 1,
                'nombre_departamento' => 'DIRECCIÓN GENERAL',
            ],
            [
                'id_departamento'     => 2,
                'nombre_departamento' => 'JEFATURA DE DIVISIÓN',
            ],
            [
                'id_departamento'     => 3,
                'nombre_departamento' => 'PLANEACIÓN Y CONSULTAS',
            ],
            [
                'id_departamento'     => 4,
                'nombre_departamento' => 'DESARROLLO ACADÉMICO',
            ],
            [
                'id_departamento'     => 5,
                'nombre_departamento' => 'CONTROL ESCOLAR',
            ],
            [
                'id_departamento'     => 6,
                'nombre_departamento' => 'RECURSOS HUMANOS',
            ],
            [
                'id_departamento'     => 7,
                'nombre_departamento' => 'CENTRO DE CÓMPUTO',
            ],
            [
                'id_departamento'     => 8,
                'nombre_departamento' => 'RESIDENCIAS PROFESIONALES',
            ],
            [
                'id_departamento'     => 9,
                'nombre_departamento' => 'TITULACIÓN',
            ],
            [
                'id_departamento'     => 10,
                'nombre_departamento' => 'FINANZAS',
            ],
        ];

        // El departamento 0 identifica al personal docente (HomeController); se habilita
        // NO_AUTO_VALUE_ON_ZERO solo en esta sesión para poder insertar el id 0 explícito.
        $modoSql = DB::selectOne('SELECT @@SESSION.sql_mode AS modo')->modo;
        DB::statement("SET SESSION sql_mode = CONCAT(@@SESSION.sql_mode, ',NO_AUTO_VALUE_ON_ZERO')");

        try {
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
        } finally {
            DB::statement('SET SESSION sql_mode = '.DB::getPdo()->quote($modoSql));
        }
    }
}
