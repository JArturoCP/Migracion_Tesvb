<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `bitacora_elimina`.
 */
class BitacoraEliminaSeeder extends Seeder
{
    /**
     * Pobla la tabla `bitacora_elimina` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'bitacora_elimina';

        $llaves = [
            ['id_bitacora_elimina'],
        ];

        $registros = [
            [
                'id_bitacora_elimina' => 1,
                'tabla'               => 'Tabla bitacora elimina 1',
                'fecha'               => '2026-01-05 09:00:00',
            ],
            [
                'id_bitacora_elimina' => 2,
                'tabla'               => 'Tabla bitacora elimina 2',
                'fecha'               => '2026-01-14 10:00:00',
            ],
            [
                'id_bitacora_elimina' => 3,
                'tabla'               => 'Tabla bitacora elimina 3',
                'fecha'               => '2026-01-23 11:00:00',
            ],
            [
                'id_bitacora_elimina' => 4,
                'tabla'               => 'Tabla bitacora elimina 4',
                'fecha'               => '2026-02-01 12:00:00',
            ],
            [
                'id_bitacora_elimina' => 5,
                'tabla'               => 'Tabla bitacora elimina 5',
                'fecha'               => '2026-02-10 13:00:00',
            ],
            [
                'id_bitacora_elimina' => 6,
                'tabla'               => 'Tabla bitacora elimina 6',
                'fecha'               => '2026-02-19 14:00:00',
            ],
            [
                'id_bitacora_elimina' => 7,
                'tabla'               => 'Tabla bitacora elimina 7',
                'fecha'               => '2026-02-28 15:00:00',
            ],
            [
                'id_bitacora_elimina' => 8,
                'tabla'               => 'Tabla bitacora elimina 8',
                'fecha'               => '2026-03-09 16:00:00',
            ],
            [
                'id_bitacora_elimina' => 9,
                'tabla'               => 'Tabla bitacora elimina 9',
                'fecha'               => '2026-03-18 08:00:00',
            ],
            [
                'id_bitacora_elimina' => 10,
                'tabla'               => 'Tabla bitacora elimina 10',
                'fecha'               => '2026-03-27 09:00:00',
            ],
            [
                'id_bitacora_elimina' => 11,
                'tabla'               => 'Tabla bitacora elimina 11',
                'fecha'               => '2026-04-05 10:00:00',
            ],
            [
                'id_bitacora_elimina' => 12,
                'tabla'               => 'Tabla bitacora elimina 12',
                'fecha'               => '2026-04-14 11:00:00',
            ],
            [
                'id_bitacora_elimina' => 13,
                'tabla'               => 'Tabla bitacora elimina 13',
                'fecha'               => '2026-04-23 12:00:00',
            ],
            [
                'id_bitacora_elimina' => 14,
                'tabla'               => 'Tabla bitacora elimina 14',
                'fecha'               => '2026-05-02 13:00:00',
            ],
            [
                'id_bitacora_elimina' => 15,
                'tabla'               => 'Tabla bitacora elimina 15',
                'fecha'               => '2026-05-11 14:00:00',
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
