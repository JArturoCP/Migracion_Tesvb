<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `resi_encuesta_residencia`.
 */
class ResiEncuestaResidenciaSeeder extends Seeder
{
    /**
     * Pobla la tabla `resi_encuesta_residencia` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            ResiAnteproyectoSeeder::class,
        ]);

        $tabla = 'resi_encuesta_residencia';

        $llaves = [
            ['id_encuesta'],
        ];

        $registros = [
            [
                'id_encuesta'     => 1,
                'id_anteproyecto' => 1,
                'pregunta1'       => 'V1',
                'pregunta2'       => 'V1',
                'pregunta3'       => 'V1',
                'pregunta4'       => 'V1',
                'pregunta5'       => 'V1',
                'pregunta6'       => 'V1',
                'pregunta7'       => 'V1',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 1.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 1.',
                'pregunta9'       => 'V1',
            ],
            [
                'id_encuesta'     => 2,
                'id_anteproyecto' => 2,
                'pregunta1'       => 'V2',
                'pregunta2'       => 'V2',
                'pregunta3'       => 'V2',
                'pregunta4'       => 'V2',
                'pregunta5'       => 'V2',
                'pregunta6'       => 'V2',
                'pregunta7'       => 'V2',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 2.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 2.',
                'pregunta9'       => 'V2',
            ],
            [
                'id_encuesta'     => 3,
                'id_anteproyecto' => 3,
                'pregunta1'       => 'V3',
                'pregunta2'       => 'V3',
                'pregunta3'       => 'V3',
                'pregunta4'       => 'V3',
                'pregunta5'       => 'V3',
                'pregunta6'       => 'V3',
                'pregunta7'       => 'V3',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 3.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 3.',
                'pregunta9'       => 'V3',
            ],
            [
                'id_encuesta'     => 4,
                'id_anteproyecto' => 4,
                'pregunta1'       => 'V4',
                'pregunta2'       => 'V4',
                'pregunta3'       => 'V4',
                'pregunta4'       => 'V4',
                'pregunta5'       => 'V4',
                'pregunta6'       => 'V4',
                'pregunta7'       => 'V4',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 4.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 4.',
                'pregunta9'       => 'V4',
            ],
            [
                'id_encuesta'     => 5,
                'id_anteproyecto' => 5,
                'pregunta1'       => 'V5',
                'pregunta2'       => 'V5',
                'pregunta3'       => 'V5',
                'pregunta4'       => 'V5',
                'pregunta5'       => 'V5',
                'pregunta6'       => 'V5',
                'pregunta7'       => 'V5',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 5.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 5.',
                'pregunta9'       => 'V5',
            ],
            [
                'id_encuesta'     => 6,
                'id_anteproyecto' => 6,
                'pregunta1'       => 'V6',
                'pregunta2'       => 'V6',
                'pregunta3'       => 'V6',
                'pregunta4'       => 'V6',
                'pregunta5'       => 'V6',
                'pregunta6'       => 'V6',
                'pregunta7'       => 'V6',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 6.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 6.',
                'pregunta9'       => 'V6',
            ],
            [
                'id_encuesta'     => 7,
                'id_anteproyecto' => 7,
                'pregunta1'       => 'V7',
                'pregunta2'       => 'V7',
                'pregunta3'       => 'V7',
                'pregunta4'       => 'V7',
                'pregunta5'       => 'V7',
                'pregunta6'       => 'V7',
                'pregunta7'       => 'V7',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 7.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 7.',
                'pregunta9'       => 'V7',
            ],
            [
                'id_encuesta'     => 8,
                'id_anteproyecto' => 8,
                'pregunta1'       => 'V8',
                'pregunta2'       => 'V8',
                'pregunta3'       => 'V8',
                'pregunta4'       => 'V8',
                'pregunta5'       => 'V8',
                'pregunta6'       => 'V8',
                'pregunta7'       => 'V8',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 8.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 8.',
                'pregunta9'       => 'V8',
            ],
            [
                'id_encuesta'     => 9,
                'id_anteproyecto' => 9,
                'pregunta1'       => 'V9',
                'pregunta2'       => 'V9',
                'pregunta3'       => 'V9',
                'pregunta4'       => 'V9',
                'pregunta5'       => 'V9',
                'pregunta6'       => 'V9',
                'pregunta7'       => 'V9',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 9.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 9.',
                'pregunta9'       => 'V9',
            ],
            [
                'id_encuesta'     => 10,
                'id_anteproyecto' => 10,
                'pregunta1'       => 'V10',
                'pregunta2'       => 'V10',
                'pregunta3'       => 'V10',
                'pregunta4'       => 'V10',
                'pregunta5'       => 'V10',
                'pregunta6'       => 'V10',
                'pregunta7'       => 'V10',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 10.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 10.',
                'pregunta9'       => 'V10',
            ],
            [
                'id_encuesta'     => 11,
                'id_anteproyecto' => 11,
                'pregunta1'       => 'V11',
                'pregunta2'       => 'V11',
                'pregunta3'       => 'V11',
                'pregunta4'       => 'V11',
                'pregunta5'       => 'V11',
                'pregunta6'       => 'V11',
                'pregunta7'       => 'V11',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 11.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 11.',
                'pregunta9'       => 'V11',
            ],
            [
                'id_encuesta'     => 12,
                'id_anteproyecto' => 12,
                'pregunta1'       => 'V12',
                'pregunta2'       => 'V12',
                'pregunta3'       => 'V12',
                'pregunta4'       => 'V12',
                'pregunta5'       => 'V12',
                'pregunta6'       => 'V12',
                'pregunta7'       => 'V12',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 12.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 12.',
                'pregunta9'       => 'V12',
            ],
            [
                'id_encuesta'     => 13,
                'id_anteproyecto' => 13,
                'pregunta1'       => 'V13',
                'pregunta2'       => 'V13',
                'pregunta3'       => 'V13',
                'pregunta4'       => 'V13',
                'pregunta5'       => 'V13',
                'pregunta6'       => 'V13',
                'pregunta7'       => 'V13',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 13.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 13.',
                'pregunta9'       => 'V13',
            ],
            [
                'id_encuesta'     => 14,
                'id_anteproyecto' => 14,
                'pregunta1'       => 'V14',
                'pregunta2'       => 'V14',
                'pregunta3'       => 'V14',
                'pregunta4'       => 'V14',
                'pregunta5'       => 'V14',
                'pregunta6'       => 'V14',
                'pregunta7'       => 'V14',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 14.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 14.',
                'pregunta9'       => 'V14',
            ],
            [
                'id_encuesta'     => 15,
                'id_anteproyecto' => 15,
                'pregunta1'       => 'V15',
                'pregunta2'       => 'V15',
                'pregunta3'       => 'V15',
                'pregunta4'       => 'V15',
                'pregunta5'       => 'V15',
                'pregunta6'       => 'V15',
                'pregunta7'       => 'V15',
                'comentario'      => 'Comentario de encuesta residencia: registro de prueba número 15.',
                'pregunta8'       => 'Pregunta8 de encuesta residencia: registro de prueba número 15.',
                'pregunta9'       => 'V15',
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
