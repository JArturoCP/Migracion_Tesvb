<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_materias`.
 */
class GnralMateriasSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_materias` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralReticulasSeeder::class,
            GnralSemestresSeeder::class,
        ]);

        $tabla = 'gnral_materias';

        $llaves = [
            ['id_materia'],
        ];

        $registros = [
            [
                'id_materia'    => 1,
                'nombre'        => 'CÁLCULO DIFERENCIAL',
                'clave'         => 'ACF-0901',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 1,
                'id_semestre'   => 1,
                'creditos'      => 5,
                'unidades'      => 5,
                'especial'      => 0,
                'updated_at'    => '2026-01-05 09:00:00',
                'created_at'    => '2026-01-05 09:00:00',
            ],
            [
                'id_materia'    => 2,
                'nombre'        => 'FUNDAMENTOS DE PROGRAMACIÓN',
                'clave'         => 'SCD-1008',
                'hrs_practicas' => 3,
                'hrs_teoria'    => 2,
                'id_reticula'   => 2,
                'id_semestre'   => 2,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-01-14 10:00:00',
                'created_at'    => '2026-01-14 10:00:00',
            ],
            [
                'id_materia'    => 3,
                'nombre'        => 'TALLER DE ÉTICA',
                'clave'         => 'ACA-0907',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 3,
                'id_semestre'   => 3,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-01-23 11:00:00',
                'created_at'    => '2026-01-23 11:00:00',
            ],
            [
                'id_materia'    => 4,
                'nombre'        => 'MATEMÁTICAS DISCRETAS',
                'clave'         => 'AEF-1041',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 4,
                'id_semestre'   => 4,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-02-01 12:00:00',
                'created_at'    => '2026-02-01 12:00:00',
            ],
            [
                'id_materia'    => 5,
                'nombre'        => 'FUNDAMENTOS DE INVESTIGACIÓN',
                'clave'         => 'ACC-0906',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 5,
                'id_semestre'   => 5,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-02-10 13:00:00',
                'created_at'    => '2026-02-10 13:00:00',
            ],
            [
                'id_materia'    => 6,
                'nombre'        => 'CÁLCULO INTEGRAL',
                'clave'         => 'ACF-0902',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 6,
                'id_semestre'   => 6,
                'creditos'      => 5,
                'unidades'      => 5,
                'especial'      => 0,
                'updated_at'    => '2026-02-19 14:00:00',
                'created_at'    => '2026-02-19 14:00:00',
            ],
            [
                'id_materia'    => 7,
                'nombre'        => 'PROGRAMACIÓN ORIENTADA A OBJETOS',
                'clave'         => 'AED-1286',
                'hrs_practicas' => 3,
                'hrs_teoria'    => 2,
                'id_reticula'   => 7,
                'id_semestre'   => 7,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-02-28 15:00:00',
                'created_at'    => '2026-02-28 15:00:00',
            ],
            [
                'id_materia'    => 8,
                'nombre'        => 'ÁLGEBRA LINEAL',
                'clave'         => 'ACF-0903',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 8,
                'id_semestre'   => 8,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-03-09 16:00:00',
                'created_at'    => '2026-03-09 16:00:00',
            ],
            [
                'id_materia'    => 9,
                'nombre'        => 'ESTRUCTURA DE DATOS',
                'clave'         => 'AED-1026',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 9,
                'id_semestre'   => 9,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-03-18 08:00:00',
                'created_at'    => '2026-03-18 08:00:00',
            ],
            [
                'id_materia'    => 10,
                'nombre'        => 'BASES DE DATOS',
                'clave'         => 'AEF-1031',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 10,
                'id_semestre'   => 10,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-03-27 09:00:00',
                'created_at'    => '2026-03-27 09:00:00',
            ],
            [
                'id_materia'    => 11,
                'nombre'        => 'SISTEMAS OPERATIVOS',
                'clave'         => 'AEC-1061',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 11,
                'id_semestre'   => 11,
                'creditos'      => 5,
                'unidades'      => 5,
                'especial'      => 0,
                'updated_at'    => '2026-04-05 10:00:00',
                'created_at'    => '2026-04-05 10:00:00',
            ],
            [
                'id_materia'    => 12,
                'nombre'        => 'REDES DE COMPUTADORAS',
                'clave'         => 'SCD-1021',
                'hrs_practicas' => 3,
                'hrs_teoria'    => 2,
                'id_reticula'   => 12,
                'id_semestre'   => 12,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-04-14 11:00:00',
                'created_at'    => '2026-04-14 11:00:00',
            ],
            [
                'id_materia'    => 13,
                'nombre'        => 'INGENIERÍA DE SOFTWARE',
                'clave'         => 'SCD-1011',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 13,
                'id_semestre'   => 1,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-04-23 12:00:00',
                'created_at'    => '2026-04-23 12:00:00',
            ],
            [
                'id_materia'    => 14,
                'nombre'        => 'TALLER DE INVESTIGACIÓN I',
                'clave'         => 'ACA-0909',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 3,
                'id_reticula'   => 14,
                'id_semestre'   => 2,
                'creditos'      => 5,
                'unidades'      => 6,
                'especial'      => 0,
                'updated_at'    => '2026-05-02 13:00:00',
                'created_at'    => '2026-05-02 13:00:00',
            ],
            [
                'id_materia'    => 15,
                'nombre'        => 'PROGRAMACIÓN WEB',
                'clave'         => 'AEB-1055',
                'hrs_practicas' => 2,
                'hrs_teoria'    => 2,
                'id_reticula'   => 15,
                'id_semestre'   => 3,
                'creditos'      => 4,
                'unidades'      => 4,
                'especial'      => 0,
                'updated_at'    => '2026-05-11 14:00:00',
                'created_at'    => '2026-05-11 14:00:00',
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
