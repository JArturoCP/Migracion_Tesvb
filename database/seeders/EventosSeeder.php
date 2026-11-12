<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `eventos`.
 */
class EventosSeeder extends Seeder
{
    /**
     * Pobla la tabla `eventos` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        $tabla = 'eventos';

        $llaves = [
            ['id_evento'],
        ];

        $registros = [
            [
                'id_evento'     => 1,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 1.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 1.',
                'fecha'         => '2026-01-05',
                'hora'          => '08:00:00',
            ],
            [
                'id_evento'     => 2,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 2.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 2.',
                'fecha'         => '2026-01-14',
                'hora'          => '09:00:00',
            ],
            [
                'id_evento'     => 3,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 3.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 3.',
                'fecha'         => '2026-01-23',
                'hora'          => '10:00:00',
            ],
            [
                'id_evento'     => 4,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 4.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 4.',
                'fecha'         => '2026-02-01',
                'hora'          => '11:00:00',
            ],
            [
                'id_evento'     => 5,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 5.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 5.',
                'fecha'         => '2026-02-10',
                'hora'          => '12:00:00',
            ],
            [
                'id_evento'     => 6,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 6.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 6.',
                'fecha'         => '2026-02-19',
                'hora'          => '13:00:00',
            ],
            [
                'id_evento'     => 7,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 7.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 7.',
                'fecha'         => '2026-02-28',
                'hora'          => '14:00:00',
            ],
            [
                'id_evento'     => 8,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 8.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 8.',
                'fecha'         => '2026-03-09',
                'hora'          => '15:00:00',
            ],
            [
                'id_evento'     => 9,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 9.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 9.',
                'fecha'         => '2026-03-18',
                'hora'          => '16:00:00',
            ],
            [
                'id_evento'     => 10,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 10.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 10.',
                'fecha'         => '2026-03-27',
                'hora'          => '17:00:00',
            ],
            [
                'id_evento'     => 11,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 11.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 11.',
                'fecha'         => '2026-04-05',
                'hora'          => '18:00:00',
            ],
            [
                'id_evento'     => 12,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 12.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 12.',
                'fecha'         => '2026-04-14',
                'hora'          => '07:00:00',
            ],
            [
                'id_evento'     => 13,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 13.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 13.',
                'fecha'         => '2026-04-23',
                'hora'          => '08:00:00',
            ],
            [
                'id_evento'     => 14,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 14.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 14.',
                'fecha'         => '2026-05-02',
                'hora'          => '09:00:00',
            ],
            [
                'id_evento'     => 15,
                'titulo_evento' => 'Titulo evento de eventos: registro de prueba número 15.',
                'desc_evento'   => 'Desc evento de eventos: registro de prueba número 15.',
                'fecha'         => '2026-05-11',
                'hora'          => '10:00:00',
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
