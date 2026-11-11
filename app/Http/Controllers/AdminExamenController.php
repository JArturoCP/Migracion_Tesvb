<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminExamenController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORMULARIO
    |--------------------------------------------------------------------------
    */

    public function createCompleto()
    {
        $carreras = DB::table('gnral_carreras')
            ->whereIn('id_carrera', [6, 8])
            ->get();

        return view('examen_egel.admin.examenes.completo', compact('carreras'));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR EXAMEN COMPLETO
    |--------------------------------------------------------------------------
    */

    public function guardarCompleto(Request $request)
    {
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1. CREAR EXAMEN
            |--------------------------------------------------------------------------
            */

            $id_examen_egel = DB::table('egel_examenes')->insertGetId([
                'id_carrera' => $request->id_carrera,
                'nombre'     => $request->nombre,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            /*
            |--------------------------------------------------------------------------
            | 2. RECORRER SECCIONES
            |--------------------------------------------------------------------------
            */

            foreach ($request->secciones as $seccion) {

                /*
                |--------------------------------------------------------------------------
                | CREAR SECCION
                |--------------------------------------------------------------------------
                */

                $id_seccion = DB::table('egel_secciones')->insertGetId([
                    'nombre'         => $seccion['nombre'],
                    'id_examen_egel' => $id_examen_egel,
                    'created_at'     => now(),
                    'updated_at'     => now()
                ]);

                /*
                |--------------------------------------------------------------------------
                | 3. RECORRER MODULOS
                |--------------------------------------------------------------------------
                */

                foreach ($seccion['modulos'] as $modulo) {

                    /*
                    |--------------------------------------------------------------------------
                    | SI EL MODULO YA EXISTE -> USARLO
                    | SI NO EXISTE -> CREARLO
                    |--------------------------------------------------------------------------
                    */

                    if (!empty($modulo['id_modulo'])) {

                        // MODULO EXISTENTE
                        $id_modulo = $modulo['id_modulo'];

                    } else {

                        // MODULO NUEVO
                        $id_modulo = DB::table('egel_modulos')->insertGetId([
                            'nombre'     => $modulo['nombre'],
                            'seccion_id' => $id_seccion,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | OBTENER ULTIMO NUMERO DE PREGUNTA DEL MODULO
                    |--------------------------------------------------------------------------
                    */

                    $ultimoNumero = DB::table('egel_preguntas')
                        ->where('modulo_id', $id_modulo)
                        ->max('numero_pregunta');

                    $ultimoNumero = $ultimoNumero ?? 0;

                    /*
                    |--------------------------------------------------------------------------
                    | 4. RECORRER PREGUNTAS
                    |--------------------------------------------------------------------------
                    */

                    foreach ($modulo['preguntas'] as $pregunta) {

                        // CONTINUAR SECUENCIA
                        $ultimoNumero++;

                        $id_pregunta = DB::table('egel_preguntas')->insertGetId([
                            'pregunta'        => $pregunta['pregunta'],
                            'modulo_id'       => $id_modulo,
                            'seccion_id'      => $id_seccion,
                            'id_examen_egel'  => $id_examen_egel,
                            'numero_pregunta' => $ultimoNumero,
                            'created_at'      => now(),
                            'updated_at'      => now()
                        ]);

                        /*
                        |--------------------------------------------------------------------------
                        | 5. RESPUESTAS
                        |--------------------------------------------------------------------------
                        */

                        foreach ($pregunta['respuestas'] as $orden => $respuesta) {

                            DB::table('egel_respuestas')->insert([
                                'pregunta_id' => $id_pregunta,
                                'respuesta'   => $respuesta['texto'],
                                'es_correcta' => isset($respuesta['correcta']) ? 1 : 0,
                                'orden'       => $orden + 1,
                                'created_at'  => now(),
                                'updated_at'  => now()
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('examen_egel.admin.examen.completo')
                ->with('success', 'Examen creado correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}