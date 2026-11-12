<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `hrs_extra_clase`.
 */
class HrsExtraClaseSeeder extends Seeder
{
    /**
     * Pobla la tabla `hrs_extra_clase` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            GnralHorariosSeeder::class,
            HrsActExtraClasesSeeder::class,
        ]);

        $tabla = 'hrs_extra_clase';

        $llaves = [
            ['id_extra_clase'],
        ];

        $registros = [
            [
                'id_extra_clase'      => 1,
                'id_act_extra_clase'  => 1,
                'id_horario_profesor' => 1,
                'grupo'               => 'Grupo extra clase 1',
                'created_at'          => '2026-01-05 09:00:00',
                'updated_at'          => '2026-01-05 09:00:00',
            ],
            [
                'id_extra_clase'      => 2,
                'id_act_extra_clase'  => 2,
                'id_horario_profesor' => 2,
                'grupo'               => 'Grupo extra clase 2',
                'created_at'          => '2026-01-14 10:00:00',
                'updated_at'          => '2026-01-14 10:00:00',
            ],
            [
                'id_extra_clase'      => 3,
                'id_act_extra_clase'  => 3,
                'id_horario_profesor' => 3,
                'grupo'               => 'Grupo extra clase 3',
                'created_at'          => '2026-01-23 11:00:00',
                'updated_at'          => '2026-01-23 11:00:00',
            ],
            [
                'id_extra_clase'      => 4,
                'id_act_extra_clase'  => 4,
                'id_horario_profesor' => 4,
                'grupo'               => 'Grupo extra clase 4',
                'created_at'          => '2026-02-01 12:00:00',
                'updated_at'          => '2026-02-01 12:00:00',
            ],
            [
                'id_extra_clase'      => 5,
                'id_act_extra_clase'  => 5,
                'id_horario_profesor' => 5,
                'grupo'               => 'Grupo extra clase 5',
                'created_at'          => '2026-02-10 13:00:00',
                'updated_at'          => '2026-02-10 13:00:00',
            ],
            [
                'id_extra_clase'      => 6,
                'id_act_extra_clase'  => 6,
                'id_horario_profesor' => 6,
                'grupo'               => 'Grupo extra clase 6',
                'created_at'          => '2026-02-19 14:00:00',
                'updated_at'          => '2026-02-19 14:00:00',
            ],
            [
                'id_extra_clase'      => 7,
                'id_act_extra_clase'  => 7,
                'id_horario_profesor' => 7,
                'grupo'               => 'Grupo extra clase 7',
                'created_at'          => '2026-02-28 15:00:00',
                'updated_at'          => '2026-02-28 15:00:00',
            ],
            [
                'id_extra_clase'      => 8,
                'id_act_extra_clase'  => 8,
                'id_horario_profesor' => 8,
                'grupo'               => 'Grupo extra clase 8',
                'created_at'          => '2026-03-09 16:00:00',
                'updated_at'          => '2026-03-09 16:00:00',
            ],
            [
                'id_extra_clase'      => 9,
                'id_act_extra_clase'  => 9,
                'id_horario_profesor' => 9,
                'grupo'               => 'Grupo extra clase 9',
                'created_at'          => '2026-03-18 08:00:00',
                'updated_at'          => '2026-03-18 08:00:00',
            ],
            [
                'id_extra_clase'      => 10,
                'id_act_extra_clase'  => 10,
                'id_horario_profesor' => 10,
                'grupo'               => 'Grupo extra clase 10',
                'created_at'          => '2026-03-27 09:00:00',
                'updated_at'          => '2026-03-27 09:00:00',
            ],
            [
                'id_extra_clase'      => 11,
                'id_act_extra_clase'  => 11,
                'id_horario_profesor' => 11,
                'grupo'               => 'Grupo extra clase 11',
                'created_at'          => '2026-04-05 10:00:00',
                'updated_at'          => '2026-04-05 10:00:00',
            ],
            [
                'id_extra_clase'      => 12,
                'id_act_extra_clase'  => 12,
                'id_horario_profesor' => 12,
                'grupo'               => 'Grupo extra clase 12',
                'created_at'          => '2026-04-14 11:00:00',
                'updated_at'          => '2026-04-14 11:00:00',
            ],
            [
                'id_extra_clase'      => 13,
                'id_act_extra_clase'  => 13,
                'id_horario_profesor' => 13,
                'grupo'               => 'Grupo extra clase 13',
                'created_at'          => '2026-04-23 12:00:00',
                'updated_at'          => '2026-04-23 12:00:00',
            ],
            [
                'id_extra_clase'      => 14,
                'id_act_extra_clase'  => 14,
                'id_horario_profesor' => 14,
                'grupo'               => 'Grupo extra clase 14',
                'created_at'          => '2026-05-02 13:00:00',
                'updated_at'          => '2026-05-02 13:00:00',
            ],
            [
                'id_extra_clase'      => 15,
                'id_act_extra_clase'  => 15,
                'id_horario_profesor' => 15,
                'grupo'               => 'Grupo extra clase 15',
                'created_at'          => '2026-05-11 14:00:00',
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
