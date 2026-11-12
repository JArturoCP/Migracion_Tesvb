<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `gnral_municipios`.
 */
class GnralMunicipiosSeeder extends Seeder
{
    /**
     * Pobla la tabla `gnral_municipios` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralEstadosSeeder::class,
        ]);

        $tabla = 'gnral_municipios';

        $llaves = [
            ['id_municipio'],
        ];

        $registros = [
            [
                'id_municipio'     => 1,
                'nombre_municipio' => 'VALLE DE BRAVO',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 2,
                'nombre_municipio' => 'AMANALCO',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 3,
                'nombre_municipio' => 'DONATO GUERRA',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 4,
                'nombre_municipio' => 'VILLA DE ALLENDE',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 5,
                'nombre_municipio' => 'TEMASCALTEPEC',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 6,
                'nombre_municipio' => 'IXTAPAN DEL ORO',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 7,
                'nombre_municipio' => 'SANTO TOMÁS',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 8,
                'nombre_municipio' => 'OTZOLOAPAN',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 9,
                'nombre_municipio' => 'ZACAZONAPAN',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 10,
                'nombre_municipio' => 'VILLA VICTORIA',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 11,
                'nombre_municipio' => 'ALMOLOYA DE JUÁREZ',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 12,
                'nombre_municipio' => 'TOLUCA',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 13,
                'nombre_municipio' => 'ZINACANTEPEC',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 14,
                'nombre_municipio' => 'TEJUPILCO',
                'id_estado'        => 1,
            ],
            [
                'id_municipio'     => 15,
                'nombre_municipio' => 'SAN JOSÉ DEL RINCÓN',
                'id_estado'        => 1,
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
